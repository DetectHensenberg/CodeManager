const { chromium } = require('playwright');
(async () => {
  const browser = await chromium.launch({headless: true});
  const context = await browser.newContext({
    viewport: {width: 1440, height: 1200},
    deviceScaleFactor: 1,
    httpCredentials: {username: 'zentao', password: '123456'}
  });
  const page = await context.newPage();
  await page.goto('http://127.0.0.1:81/zentao/user-login.html', {waitUntil: 'domcontentloaded'});
  const account = page.locator('input[name="account"], input#account').first();
  if (await account.count()) {
    await account.fill('admin');
    await page.locator('input[name="password"], input#password').first().fill('Aa123456');
    await page.locator('button[type="submit"], input[type="submit"], #submit').first().click();
  }
  await page.waitForLoadState('networkidle', {timeout: 15000}).catch(() => {});
  await page.waitForTimeout(2500);
  await page.goto('http://127.0.0.1:81/zentao/my-index.html', {waitUntil: 'domcontentloaded'}).catch(() => {});
  await page.waitForLoadState('networkidle', {timeout: 15000}).catch(() => {});
  await page.waitForTimeout(2500);
  const info = await page.evaluate(() => ({
    url: location.href,
    title: document.title,
    hasDashboard: !!document.querySelector('.cm-lucen-dashboard'),
    bodyClass: document.body.className,
    sample: document.body.innerText.slice(0, 300)
  }));
  console.log(JSON.stringify(info, null, 2));
  await page.screenshot({path: 'output/playwright/zentao-dashboard-rewrite.png', fullPage: true});
  await browser.close();
})();
