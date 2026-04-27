const { chromium } = require('playwright');
(async () => {
  const browser = await chromium.launch({headless: true});
  const context = await browser.newContext({viewport: {width: 1440, height: 1200}, httpCredentials: {username: 'zentao', password: '123456'}});
  const page = await context.newPage();
  await page.goto('http://127.0.0.1:81/zentao/', {waitUntil: 'domcontentloaded'});
  await page.locator('input[name="account"], input#account').first().fill('admin');
  await page.locator('input[name="password"], input#password').first().fill('Aa123456');
  await page.locator('button[type="submit"], input[type="submit"], #submit').first().click();
  await page.waitForLoadState('networkidle', {timeout: 15000}).catch(()=>{});
  await page.waitForTimeout(2500);
  console.log(JSON.stringify({url: page.url(), title: await page.title(), text: (await page.locator('body').innerText()).slice(0,300)}));
  await page.screenshot({path: 'output/playwright/zentao-dashboard-after-login.png', fullPage: true});
  await browser.close();
})();
