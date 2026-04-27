const { chromium } = require('playwright');
(async () => {
  const browser = await chromium.launch({headless: true});
  const context = await browser.newContext({viewport: {width: 1440, height: 1400}, deviceScaleFactor: 1, httpCredentials: {username: 'zentao', password: '123456'}});
  const page = await context.newPage();
  await page.goto('http://127.0.0.1:81/zentao/user-login.html', {waitUntil: 'domcontentloaded'});
  await page.locator('input[name="account"], input#account').first().fill('admin');
  await page.locator('input[name="password"], input#password').first().fill('Aa123456');
  await page.locator('button[type="submit"], input[type="submit"], #submit').first().click();
  await page.waitForLoadState('networkidle', {timeout: 15000}).catch(()=>{});
  await page.waitForTimeout(4500);
  await page.waitForFunction(() => {
    const iframe = document.querySelector('#appIframe-my');
    return iframe && iframe.contentDocument && iframe.contentDocument.querySelector('.cm-lucen-dashboard');
  }, {timeout: 15000});
  await page.locator('#appIframe-my').screenshot({path:'output/playwright/zentao-dashboard-iframe-rewrite.png'});
  await page.screenshot({path:'output/playwright/zentao-dashboard-full-rewrite.png', fullPage:true});
  const metrics = await page.evaluate(() => {
    const doc = document.querySelector('#appIframe-my').contentDocument;
    const el = doc.querySelector('.cm-lucen-dashboard');
    const card = doc.querySelector('.cm-lu-kpi');
    return {
      iframeText: doc.body.innerText.slice(0, 200),
      dashboardRect: (() => { const r = el.getBoundingClientRect(); return {x:r.x,y:r.y,w:r.width,h:r.height}; })(),
      kpiRect: (() => { const r = card.getBoundingClientRect(); return {x:r.x,y:r.y,w:r.width,h:r.height}; })(),
      bg: getComputedStyle(el).backgroundColor,
      cardBg: getComputedStyle(card).backgroundColor,
      cardBorder: getComputedStyle(card).borderColor
    };
  });
  console.log(JSON.stringify(metrics, null, 2));
  await browser.close();
})();
