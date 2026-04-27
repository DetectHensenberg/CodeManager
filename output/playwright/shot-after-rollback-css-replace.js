const { chromium } = require('playwright');
(async () => {
  const browser = await chromium.launch({headless: true});
  const context = await browser.newContext({viewport: {width: 1440, height: 1100}, httpCredentials: {username:'zentao', password:'123456'}});
  const page = await context.newPage();
  await page.goto('http://127.0.0.1:81/zentao/user-login.html', {waitUntil:'domcontentloaded'});
  await page.locator('input[name="account"], input#account').first().fill('admin');
  await page.locator('input[name="password"], input#password').first().fill('Aa123456');
  await page.locator('button[type="submit"], input[type="submit"], #submit').first().click();
  await page.waitForLoadState('networkidle', {timeout: 15000}).catch(()=>{});
  await page.waitForTimeout(2500);
  const data = await page.evaluate(() => ({
    url: location.href,
    links: [...document.querySelectorAll('link[rel="stylesheet"]')].map(l => l.href),
    bodyClass: document.body.className,
    bg: getComputedStyle(document.body).backgroundColor,
    text: document.body.innerText.slice(0, 200)
  }));
  console.log(JSON.stringify(data, null, 2));
  await page.screenshot({path:'output/playwright/zentao-after-rollback-css-replace.png', fullPage:true});
  await browser.close();
})();
