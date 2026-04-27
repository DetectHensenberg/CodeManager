const { chromium } = require('playwright');
const fs = require('fs');

const BASE = 'http://127.0.0.1:81/zentao';
const USER = 'admin';
const PASS = 'Admin@123456';
const OUT = 'D:/Workspace/project/个人项目/CodeManager/output';

(async () => {
  const browser = await chromium.launch({
    headless: true,
    args: ['--no-sandbox', '--disable-setuid-sandbox'],
  });
  const ctx = await browser.newContext({
    viewport: { width: 1920, height: 1080 },
    deviceScaleFactor: 1,
    httpCredentials: { username: 'zentao', password: '123456' },
  });
  await ctx.route('**/*', (r) => {
    if (/poll|sse|stream|notify|message[-?]/i.test(r.request().url())) return r.abort();
    return r.continue();
  });
  const page = await ctx.newPage();

  try {
    await page.goto(`${BASE}/user-login.html`, { waitUntil: 'domcontentloaded', timeout: 15000 });
    await page.fill('input[name="account"]', USER);
    await page.fill('input[name="password"]', PASS);
    await Promise.all([
      page.waitForNavigation({ waitUntil: 'domcontentloaded', timeout: 15000 }).catch(() => {}),
      page.click('button[type="submit"]'),
    ]);

    // Try the SHELL — that's where the right-side toolbar lives
    console.log('Loading shell...');
    await page.goto(`${BASE}/`, { waitUntil: 'domcontentloaded', timeout: 15000 });
    await page.waitForSelector('#menu', { timeout: 10000 });
    await page.waitForTimeout(5000); // let iframe settle

    // Full-page shell screenshot
    await page.screenshot({ path: `${OUT}/diag-shell.png`, fullPage: false });
    console.log('✓ diag-shell.png');

    // Crop top-right corner
    await page.screenshot({
      path: `${OUT}/diag-topright.png`,
      clip: { x: 1500, y: 0, width: 420, height: 200 },
    });
    console.log('✓ diag-topright.png');

    // Crop top bar full width (top 80px)
    await page.screenshot({
      path: `${OUT}/diag-topbar.png`,
      clip: { x: 0, y: 0, width: 1920, height: 100 },
    });
    console.log('✓ diag-topbar.png');

    // ---- DOM DIAGNOSIS ----
    const shellInfo = await page.evaluate(() => {
      const pick = (sel) => {
        const els = Array.from(document.querySelectorAll(sel));
        return els.slice(0, 5).map((el) => {
          const cs = getComputedStyle(el);
          const r = el.getBoundingClientRect();
          return {
            tag: el.tagName,
            id: el.id,
            class: el.className,
            position: cs.position,
            zIndex: cs.zIndex,
            top: cs.top,
            right: cs.right,
            bg: cs.backgroundColor,
            display: cs.display,
            rect: { x: Math.round(r.x), y: Math.round(r.y), w: Math.round(r.width), h: Math.round(r.height) },
            text: (el.textContent || '').trim().slice(0, 40),
          };
        });
      };
      return {
        body: pick('body'),
        appsBar: pick('#appsBar'),
        appsToolbar: pick('#appsToolbar'),
        mainHeader: pick('#mainHeader'),
        // Common ZenTao top-right widgets
        chatBtn: pick('#chatBtn, .chat-btn, [data-chat]'),
        globalSearch: pick('#globalSearch, .global-search'),
        userAvatar: pick('#userAvatar, .header-account, .user-avatar-trigger'),
        // Anything fixed at the top right
        fixedTop: Array.from(document.querySelectorAll('body *'))
          .filter((el) => {
            const cs = getComputedStyle(el);
            const r = el.getBoundingClientRect();
            return cs.position === 'fixed' && r.top < 100 && r.right < 100 && r.width < 300;
          })
          .slice(0, 8)
          .map((el) => ({
            tag: el.tagName,
            id: el.id,
            class: el.className.toString().slice(0, 80),
            zIndex: getComputedStyle(el).zIndex,
            rect: el.getBoundingClientRect().toJSON(),
          })),
      };
    });
    fs.writeFileSync(`${OUT}/diag-shell.json`, JSON.stringify(shellInfo, null, 2));
    console.log('✓ diag-shell.json');

    // ---- iframe DIAGNOSIS (the dashboard inside #apps) ----
    const frames = page.frames();
    const dashFrame = frames.find((f) => /my\.html|my-index|index-index|dashboard/.test(f.url()));
    if (dashFrame) {
      console.log('Dashboard iframe URL:', dashFrame.url());
      const innerInfo = await dashFrame.evaluate(() => {
        const inspect = (sel, max = 6) => {
          const els = Array.from(document.querySelectorAll(sel));
          return els.slice(0, max).map((el) => {
            const cs = getComputedStyle(el);
            const r = el.getBoundingClientRect();
            return {
              class: el.className.toString().slice(0, 140),
              tag: el.tagName,
              id: el.id || '',
              bg: cs.backgroundColor,
              bgImg: cs.backgroundImage.slice(0, 60),
              border: cs.border,
              borderRadius: cs.borderRadius,
              boxShadow: cs.boxShadow.slice(0, 80),
              color: cs.color,
              fontSize: cs.fontSize,
              fontWeight: cs.fontWeight,
              position: cs.position,
              zIndex: cs.zIndex,
              top: cs.top,
              right: cs.right,
              rect: { x: Math.round(r.x), y: Math.round(r.y), w: Math.round(r.width), h: Math.round(r.height) },
              text: (el.textContent || '').trim().slice(0, 40),
            };
          });
        };
        return {
          // iframe top-right floating toolbar (the +/bell/avatar cluster)
          allFixedTopRight: Array.from(document.querySelectorAll('body *'))
            .filter((el) => {
              const cs = getComputedStyle(el);
              const r = el.getBoundingClientRect();
              return ['fixed', 'absolute'].includes(cs.position)
                && r.top < 200 && r.right < window.innerWidth
                && r.right > window.innerWidth - 400 && r.width < 400 && r.width > 30;
            })
            .slice(0, 12)
            .map((el) => ({
              tag: el.tagName,
              id: el.id || '',
              class: el.className.toString().slice(0, 100),
              position: getComputedStyle(el).position,
              zIndex: getComputedStyle(el).zIndex,
              top: getComputedStyle(el).top,
              right: getComputedStyle(el).right,
              rect: el.getBoundingClientRect().toJSON(),
            })),
          welcomeNum: inspect('.block-welcome .num, .block-welcome .text-3xl', 10),
          welcomeCell: inspect('.block-welcome .cell', 10),
          welcomeRow: inspect('.block-welcome .row .cell', 10),
          panelHeading: inspect('.panel-heading', 4),
          flowItem: inspect('.flow-item', 8),
          tutorialBtn: inspect('.tutorialBtn', 4),
          // common ZUI3 top-right widgets
          headerAccount: inspect('.header-account, [class*="header-right"], [class*="user-account"], .my-info', 6),
          chatBtn: inspect('.chat-btn, #chatBtn, [class*="chat-trigger"]', 4),
          headerActions: inspect('[class*="header-action"], [class*="header-tool"], header .toolbar, .navbar-actions', 6),
          // ALL elements in the top-right zone (regardless of position)
          topRightZone: Array.from(document.querySelectorAll('body *'))
            .filter((el) => {
              const r = el.getBoundingClientRect();
              return r.top < 120 && r.right > window.innerWidth - 350 && r.right < window.innerWidth + 5
                && r.width > 20 && r.height > 20 && r.width < 400 && r.height < 80;
            })
            .slice(0, 18)
            .map((el) => ({
              tag: el.tagName,
              id: el.id || '',
              class: (el.className.toString() || '').slice(0, 100),
              rect: { x: Math.round(el.getBoundingClientRect().x), y: Math.round(el.getBoundingClientRect().y), w: Math.round(el.getBoundingClientRect().width), h: Math.round(el.getBoundingClientRect().height) },
              parentClass: el.parentElement ? (el.parentElement.className.toString() || '').slice(0, 60) : '',
              text: (el.textContent || '').trim().slice(0, 30),
            })),
          // pageActions / mainHeader inside iframe
          pageHeader: inspect('#mainHeader, .main-header, #pageHeader, .page-header, [class*="page-actions"]', 4),
          // header right region of welcome
          welcomeHeader: inspect('.block-welcome .panel-heading, .block-welcome .panel-heading > *', 8),
        };
      });
      fs.writeFileSync(`${OUT}/diag-dashboard.json`, JSON.stringify(innerInfo, null, 2));
      console.log('✓ diag-dashboard.json (inner iframe DOM)');

      // Crop the welcome block inside iframe via shell coords
      const frameRect = await page.evaluate(() => {
        const ifr = document.querySelector('#apps iframe');
        return ifr ? ifr.getBoundingClientRect().toJSON() : null;
      });
      if (frameRect) {
        await page.screenshot({
          path: `${OUT}/diag-welcome-area.png`,
          clip: {
            x: Math.max(0, frameRect.x),
            y: Math.max(0, frameRect.y),
            width: Math.min(1920 - frameRect.x, frameRect.width),
            height: 220,
          },
        });
        console.log('✓ diag-welcome-area.png');
      }
    } else {
      console.log('⚠ No dashboard iframe found');
      console.log('Frames:', frames.map((f) => f.url()));
    }
  } catch (e) {
    console.error('FATAL:', e.message);
    try {
      await page.screenshot({ path: `${OUT}/diag-error.png` });
    } catch {}
  }
  await browser.close();
})();
