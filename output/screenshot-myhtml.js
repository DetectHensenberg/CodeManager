const { chromium } = require('playwright');
const fs = require('fs');

const BASE = 'http://127.0.0.1:81/zentao';
const OUT = 'D:/Workspace/project/个人项目/CodeManager/output';

(async () => {
  const browser = await chromium.launch({
    headless: true,
    args: ['--no-sandbox', '--disable-setuid-sandbox'],
  });
  const ctx = await browser.newContext({
    viewport: { width: 1620, height: 900 },
    deviceScaleFactor: 1,
    httpCredentials: { username: 'zentao', password: '123456' },
  });
  await ctx.route('**/*', (r) => {
    if (/poll|sse|stream|notify/i.test(r.request().url())) return r.abort();
    return r.continue();
  });
  const page = await ctx.newPage();

  try {
    // Login
    await page.goto(`${BASE}/user-login.html`, { waitUntil: 'domcontentloaded' });
    await page.fill('input[name="account"]', 'admin');
    await page.fill('input[name="password"]', 'Admin@123456');
    await Promise.all([
      page.waitForNavigation({ waitUntil: 'domcontentloaded' }).catch(() => {}),
      page.click('button[type="submit"]'),
    ]);
    console.log('Logged in. URL:', page.url());

    // Load my.html shell, then find the inner iframe's URL and screenshot that
    console.log('Load my.html shell...');
    await page.goto(`${BASE}/my.html`, { waitUntil: 'domcontentloaded', timeout: 15000 });
    await page.waitForSelector('#appIframe-my', { timeout: 10000 });
    await page.waitForTimeout(4000);

    // Find iframe URL
    const innerUrl = await page.evaluate(() => {
      const ifr = document.querySelector('#appIframe-my');
      return ifr ? ifr.src : null;
    });
    console.log('Inner iframe URL:', innerUrl);
    if (innerUrl && !innerUrl.includes('about:blank')) {
      await page.goto(innerUrl, { waitUntil: 'domcontentloaded', timeout: 15000 });
      await page.waitForTimeout(3500);
      console.log('Now on inner page:', page.url());
    }

    await page.screenshot({ path: `${OUT}/myhtml-full.png`, fullPage: false });
    console.log('✓ myhtml-full.png');

    // Crop top
    await page.screenshot({
      path: `${OUT}/myhtml-top.png`,
      clip: { x: 0, y: 0, width: 1620, height: 250 },
    });
    console.log('✓ myhtml-top.png');

    // Dump body class + key region structure
    const dom = await page.evaluate(() => {
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
          rect: { x: Math.round(r.x), y: Math.round(r.y), w: Math.round(r.width), h: Math.round(r.height) },
        };
      };
      const inspect = (sel, n = 8) =>
        Array.from(document.querySelectorAll(sel)).slice(0, n).map(css);

      return {
        bodyClass: document.body.className,
        bodyChildren: Array.from(document.body.children).map((el) => ({
          tag: el.tagName,
          id: el.id || '',
          class: el.className.toString().slice(0, 100),
          rect: el.getBoundingClientRect().toJSON(),
        })),
        // The big "0" wrappers in welcome block
        welcomeStruct: inspect('.block-welcome', 4),
        welcomeRows: inspect('.block-welcome .row', 4),
        welcomeCells: inspect('.block-welcome .cell', 12),
        nums: inspect('.num, .text-3xl, [class*="text-3xl"]', 12),
        // Top-right area — anything visible at top-right
        topRightAll: Array.from(document.querySelectorAll('body *'))
          .filter((el) => {
            const r = el.getBoundingClientRect();
            return r.top < 130 && r.right > window.innerWidth - 350 && r.right < window.innerWidth + 5
              && r.width > 20 && r.height > 20;
          })
          .slice(0, 15)
          .map(css),
        // Left avatar (the welcome avatar)
        avatars: inspect('.avatar, .welcome-avatar, .user-avatar', 6),
      };
    });
    fs.writeFileSync(`${OUT}/myhtml-dom.json`, JSON.stringify(dom, null, 2));
    console.log('✓ myhtml-dom.json');
    console.log('Body class:', dom.bodyClass);
    console.log('Top-right elements found:', dom.topRightAll.length);
  } catch (e) {
    console.error('FATAL:', e.message);
  }
  await browser.close();
})();
