const { chromium } = require('playwright');
const fs = require('fs');

const BASE = 'http://127.0.0.1:81/zentao';
const OUT = 'D:/Workspace/project/个人项目/CodeManager/output';

(async () => {
  const browser = await chromium.launch({ headless: true, args: ['--no-sandbox'] });
  const ctx = await browser.newContext({
    viewport: { width: 1920, height: 1080 },
    httpCredentials: { username: 'zentao', password: '123456' },
  });
  await ctx.route('**/*', (r) => {
    if (/poll|sse|stream|notify/i.test(r.request().url())) return r.abort();
    return r.continue();
  });
  const page = await ctx.newPage();

  try {
    await page.goto(`${BASE}/user-login.html`, { waitUntil: 'domcontentloaded' });
    await page.fill('input[name="account"]', 'admin');
    await page.fill('input[name="password"]', 'Admin@123456');
    await Promise.all([
      page.waitForNavigation({ waitUntil: 'domcontentloaded' }).catch(() => {}),
      page.click('button[type="submit"]'),
    ]);

    await page.goto(`${BASE}/my.html`, { waitUntil: 'domcontentloaded' });
    await page.waitForSelector('#appIframe-my', { timeout: 10000 });
    await page.waitForTimeout(5000); // let iframe load fully

    // The iframe might be about:blank with content injected via document.write
    // Use about:blank frame if that's the case
    const frames = page.frames();
    console.log('All frames:', frames.map((f) => f.url()).join(' | '));
    const useFrame = frames.find((f) => f !== page.mainFrame()) || page.mainFrame();
    console.log('Using frame URL:', useFrame.url());

    const info = await useFrame.evaluate(() => {
      const css = (e) => {
        const r = e.getBoundingClientRect();
        const c = getComputedStyle(e);
        return {
          tag: e.tagName,
          id: e.id || '',
          class: e.className.toString().slice(0, 130),
          bg: c.backgroundColor,
          border: c.border,
          shadow: c.boxShadow.slice(0, 60),
          radius: c.borderRadius,
          color: c.color,
          pos: c.position,
          z: c.zIndex,
          top: c.top,
          right: c.right,
          rect: { x: Math.round(r.x), y: Math.round(r.y), w: Math.round(r.width), h: Math.round(r.height) },
        };
      };
      const inspect = (sel, n = 8) =>
        Array.from(document.querySelectorAll(sel)).slice(0, n).map(css);

      // Trace welcome block hierarchy
      const welcomeRoot = document.querySelector('.block-welcome');
      let welcomeTree = null;
      if (welcomeRoot) {
        const walk = (el, depth = 0) => {
          if (depth > 4) return null;
          return {
            tag: el.tagName,
            class: el.className.toString().slice(0, 100),
            text: (el.textContent || '').trim().slice(0, 30),
            rect: el.getBoundingClientRect().toJSON(),
            children: Array.from(el.children).slice(0, 8).map((c) => walk(c, depth + 1)).filter(Boolean),
          };
        };
        welcomeTree = walk(welcomeRoot);
      }

      // Top-right elements in iframe
      const topRight = Array.from(document.querySelectorAll('body *'))
        .filter((el) => {
          const r = el.getBoundingClientRect();
          return r.top < 100 && r.right > window.innerWidth - 350 && r.right < window.innerWidth + 5
            && r.width > 30 && r.height > 25 && r.width < 400;
        })
        .slice(0, 12)
        .map(css);

      return {
        url: location.href,
        bodyClass: document.body.className,
        welcomeTree,
        nums: inspect('.num, .text-3xl, [class*="text-3xl"]', 12),
        cells: inspect('.block-welcome .cell', 12),
        topRight,
        // common ZenTao header right
        possibleTopRight: inspect('.header-toolbar, .page-actions, .actions-bar, [class*="dashboard-action"], [class*="dashboard-menu"], .scoreNotice, .score-notice', 8),
      };
    });
    fs.writeFileSync(`${OUT}/iframe-dom.json`, JSON.stringify(info, null, 2));
    console.log('✓ iframe-dom.json');
    console.log('Iframe URL:', info.url);
    console.log('Iframe body class:', info.bodyClass);
    console.log('Top-right elements:', info.topRight.length);

    // Now query SHELL (parent frame) for top-right buttons at 1920 viewport
    const shellInfo = await page.evaluate(() => {
      // Get ALL elements at right side of screen y < 200
      const top = Array.from(document.querySelectorAll('body *'))
        .filter((el) => {
          const r = el.getBoundingClientRect();
          if (r.width === 0 || r.height === 0) return false;
          return r.top < 150 && r.right > window.innerWidth - 500 && r.left > window.innerWidth - 500
            && r.height < 200 && r.height > 15 && r.width > 15;
        })
        .slice(0, 30)
        .map((el) => {
          const r = el.getBoundingClientRect();
          const c = getComputedStyle(el);
          return {
            tag: el.tagName,
            id: el.id || '',
            class: el.className.toString().slice(0, 120),
            parent: el.parentElement ? (el.parentElement.tagName + '.' + el.parentElement.className.toString().slice(0, 60)) : '',
            pos: c.position,
            z: c.zIndex,
            top: c.top,
            right: c.right,
            bg: c.backgroundColor,
            rect: { x: Math.round(r.x), y: Math.round(r.y), w: Math.round(r.width), h: Math.round(r.height) },
            text: (el.textContent || '').trim().slice(0, 40),
          };
        });
      return { topRightShell: top };
    });
    fs.writeFileSync(`${OUT}/shell-topright.json`, JSON.stringify(shellInfo, null, 2));
    console.log('✓ shell-topright.json — found', shellInfo.topRightShell.length);

    // Crop wider top region
    await page.screenshot({
      path: `${OUT}/iframe-toprightzone.png`,
      clip: { x: 1500, y: 0, width: 420, height: 200 },
    });
    console.log('✓ iframe-toprightzone.png');

    // Access iframe contentDocument from main frame and query top-right
    const iframeTopRight = await page.evaluate(() => {
      const iframe = document.querySelector('#appIframe-my');
      if (!iframe || !iframe.contentDocument) return { err: 'no contentDocument', iframeRect: iframe ? iframe.getBoundingClientRect().toJSON() : null };
      const doc = iframe.contentDocument;
      const win = iframe.contentWindow;
      const els = Array.from(doc.querySelectorAll('body *'))
        .filter((el) => {
          const r = el.getBoundingClientRect();
          if (r.width === 0 || r.height === 0) return false;
          return r.top < 200 && r.right > win.innerWidth - 350
            && r.height < 100 && r.height > 15 && r.width > 25;
        })
        .slice(0, 25)
        .map((el) => {
          const r = el.getBoundingClientRect();
          const c = win.getComputedStyle(el);
          return {
            tag: el.tagName,
            id: el.id || '',
            class: el.className.toString().slice(0, 130),
            parent: el.parentElement ? (el.parentElement.tagName + '.' + el.parentElement.className.toString().slice(0, 60)) : '',
            pos: c.position,
            z: c.zIndex,
            top: c.top,
            right: c.right,
            bg: c.backgroundColor,
            border: c.border,
            radius: c.borderRadius,
            shadow: c.boxShadow.slice(0, 60),
            rect: { x: Math.round(r.x), y: Math.round(r.y), w: Math.round(r.width), h: Math.round(r.height) },
            text: (el.textContent || '').trim().slice(0, 30),
          };
        });
      return {
        iframeRect: iframe.getBoundingClientRect().toJSON(),
        innerWidth: win.innerWidth,
        innerHeight: win.innerHeight,
        bodyClass: doc.body.className,
        elements: els,
      };
    });
    fs.writeFileSync(`${OUT}/iframe-topright-real.json`, JSON.stringify(iframeTopRight, null, 2));
    console.log('✓ iframe-topright-real.json — found', iframeTopRight.elements ? iframeTopRight.elements.length : 0);
  } catch (e) {
    console.error('FATAL:', e.message);
  }
  await browser.close();
})();
