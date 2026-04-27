const { chromium } = require('playwright');

(async () => {
  const browser = await chromium.launch({
    headless: true,
    args: ['--no-sandbox', '--disable-setuid-sandbox', '--disable-dev-shm-usage'],
  });
  const context = await browser.newContext({
    viewport: { width: 1920, height: 1080 },
    deviceScaleFactor: 1,
    httpCredentials: { username: 'zentao', password: '123456' },
    ignoreHTTPSErrors: true,
  });
  const page = await context.newPage();

  // Simple approach: just screenshot the login page
  try {
    console.log('Loading login page...');
    await page.goto('http://127.0.0.1:81/zentao/user-login.html', {
      waitUntil: 'domcontentloaded',
      timeout: 10000,
    });
    console.log('URL:', page.url());
    console.log('Title:', await page.title());

    await page.waitForTimeout(2000);

    // Check CSS variables
    const cmVars = await page.evaluate(() => {
      const rootStyle = getComputedStyle(document.documentElement);
      const vars = [
        '--cm-lu-bg', '--cm-lu-primary', '--cm-lu-text', '--cm-lu-surface',
        '--cm-bg', '--cm-primary'  // check if old names still exist
      ];
      const result = {};
      vars.forEach(v => {
        result[v] = rootStyle.getPropertyValue(v).trim() || '(empty)';
      });
      return result;
    });
    console.log('CSS variables:', JSON.stringify(cmVars, null, 2));

    // Check for ZIN injected --cm-* variables
    const zinStyle = await page.evaluate(() => {
      const el = document.querySelector('style.zin-page-css');
      return el ? el.textContent.substring(0, 500) : 'NO ZIN STYLE';
    });
    console.log('ZIN injected style:', zinStyle.substring(0, 300));

    await page.screenshot({
      path: 'D:/Workspace/project/个人项目/CodeManager/output/screenshot-login.png',
      fullPage: false,
      timeout: 5000,
    });
    console.log('Login page screenshot saved.');

  } catch (err) {
    console.error('Error:', err.message);
  }

  await browser.close();
  console.log('Done.');
})();
