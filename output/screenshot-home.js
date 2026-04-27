const { chromium } = require('playwright');
const fs = require('fs');

const BASE = 'http://127.0.0.1:81/zentao';
const USER = 'admin';
const PASS = 'Admin@123456';
const OUT_DIR = 'D:/Workspace/project/个人项目/CodeManager/output';

(async () => {
  const browser = await chromium.launch({
    headless: true,
    args: ['--no-sandbox', '--disable-setuid-sandbox', '--disable-dev-shm-usage'],
  });
  const context = await browser.newContext({
    viewport: { width: 1440, height: 900 },
    deviceScaleFactor: 1,
    httpCredentials: { username: 'zentao', password: '123456' },
    ignoreHTTPSErrors: true,
  });

  // Block long-poll/SSE-style requests so ZUI3 shell load event fires.
  await context.route('**/*', (route) => {
    const url = route.request().url();
    if (/poll|sse|stream|notify|message[-?]/i.test(url)) {
      return route.abort();
    }
    return route.continue();
  });

  const page = await context.newPage();
  page.on('pageerror', (e) => console.error('[pageerror]', e.message));
  page.on('console', (m) => {
    if (m.type() === 'error') console.log('[console.error]', m.text());
  });

  try {
    console.log('1. Login page...');
    await page.goto(`${BASE}/user-login.html`, { waitUntil: 'domcontentloaded', timeout: 15000 });
    await page.waitForSelector('input[name="account"]', { timeout: 8000 });
    await page.fill('input[name="account"]', USER);
    await page.fill('input[name="password"]', PASS);

    await Promise.all([
      page.waitForNavigation({ waitUntil: 'domcontentloaded', timeout: 15000 }).catch(() => {}),
      page.click('button[type="submit"]'),
    ]);
    console.log('   URL after submit:', page.url());

    // ZUI3 shell loads dashboard inside #apps iframe — navigate the
    // iframe URL directly, which is what we actually care about.
    console.log('2. Navigate dashboard (my-index)...');
    await page.goto(`${BASE}/my-index.html`, { waitUntil: 'domcontentloaded', timeout: 15000 });
    await page.waitForTimeout(2500);

    // Inject codemanager.css stylesheet check
    const cssLoaded = await page.evaluate(() => {
      const link = Array.from(document.querySelectorAll('link[rel="stylesheet"]'))
        .find((l) => /codemanager\.css/.test(l.href));
      return link ? link.href : null;
    });
    console.log('   codemanager.css:', cssLoaded || '(NOT LOADED - need to inject manually)');

    // If codemanager.css not loaded on inner page, inject it
    if (!cssLoaded) {
      console.log('   Injecting codemanager.css...');
      await page.addStyleTag({ url: `${BASE}/theme/codemanager/codemanager.css` });
      await page.waitForTimeout(800);
    }

    await page.screenshot({
      path: `${OUT_DIR}/home-dashboard.png`,
      fullPage: false,
      timeout: 10000,
    });
    console.log('   ✓ home-dashboard.png saved');

    await page.screenshot({
      path: `${OUT_DIR}/home-dashboard-full.png`,
      fullPage: true,
      timeout: 10000,
    });
    console.log('   ✓ home-dashboard-full.png saved');

    // Try the shell too — if it loads fine, we get the real layout
    console.log('3. Try ZUI3 shell...');
    try {
      await page.goto(`${BASE}/`, { waitUntil: 'domcontentloaded', timeout: 15000 });
      await page.waitForSelector('#menu', { timeout: 8000 });
      await page.waitForTimeout(3500);
      await page.screenshot({
        path: `${OUT_DIR}/home-shell.png`,
        fullPage: false,
        timeout: 8000,
      });
      console.log('   ✓ home-shell.png saved');
    } catch (e) {
      console.log('   ⚠ shell screenshot failed:', e.message.split('\n')[0]);
    }

    // Capture computed styles on key elements for analysis
    await page.goto(`${BASE}/my-index.html`, { waitUntil: 'domcontentloaded', timeout: 15000 });
    await page.waitForTimeout(2000);
    const elementInfo = await page.evaluate(() => {
      const pick = (sel) => {
        const el = document.querySelector(sel);
        if (!el) return null;
        const cs = getComputedStyle(el);
        return {
          selector: sel,
          tag: el.tagName,
          class: el.className,
          bg: cs.backgroundColor,
          color: cs.color,
          rect: el.getBoundingClientRect().toJSON(),
        };
      };
      return {
        flowItems: Array.from(document.querySelectorAll('.flow-item')).map((e, i) => ({
          idx: i,
          class: e.className,
          bg: getComputedStyle(e).backgroundColor,
          bgImg: getComputedStyle(e).backgroundImage.substring(0, 80),
          color: getComputedStyle(e).color,
          text: e.textContent.trim().substring(0, 30),
        })),
        tutorialBtn: pick('.tutorialBtn'),
        welcomeAvatar: pick('.welcome-avatar'),
        welcomeBlockHeading: pick('.block-welcome .panel-heading'),
        countCells: Array.from(document.querySelectorAll('.cell .num, .cell .text-3xl')).slice(0, 6).map((e) => ({
          text: e.textContent.trim().substring(0, 20),
          bg: getComputedStyle(e).backgroundColor,
          parentBg: getComputedStyle(e.parentElement).backgroundColor,
          color: getComputedStyle(e).color,
        })),
      };
    });
    fs.writeFileSync(`${OUT_DIR}/home-elements.json`, JSON.stringify(elementInfo, null, 2));
    console.log('   ✓ home-elements.json saved');
  } catch (err) {
    console.error('FATAL:', err.message);
    try {
      await page.screenshot({ path: `${OUT_DIR}/home-error.png`, fullPage: false, timeout: 5000 });
    } catch {}
  }

  await browser.close();
  console.log('Done.');
})();
