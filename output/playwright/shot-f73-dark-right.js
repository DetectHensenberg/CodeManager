const { chromium } = require('playwright');
(async () => {
  const browser = await chromium.launch({headless:true});
  const context = await browser.newContext({viewport:{width:1440,height:1000}, httpCredentials:{username:'zentao', password:'123456'}});
  const page = await context.newPage();
  await page.goto('http://127.0.0.1:81/zentao/user-login.html', {waitUntil:'domcontentloaded'});
  await page.locator('input[name="account"], input#account').first().fill('admin');
  await page.locator('input[name="password"], input#password').first().fill('Aa123456');
  await page.locator('button[type="submit"], input[type="submit"], #submit').first().click();
  await page.waitForLoadState('networkidle', {timeout:15000}).catch(()=>{});
  await page.waitForTimeout(3000);
  const info = await page.evaluate(() => {
    const iframe = document.querySelector('iframe[id^="appIframe"]');
    const doc = iframe?.contentDocument;
    const sample = doc ? (doc.querySelector('.main-table,.panel,.cell,.table,.dtable,.btn,button') || doc.body) : document.body;
    const s = getComputedStyle(sample);
    return {
      url: location.href,
      links: [...(doc || document).querySelectorAll('link[rel="stylesheet"]')].map(l=>l.href),
      hasIframe: !!doc,
      bodyBg: doc ? getComputedStyle(doc.body).backgroundColor : getComputedStyle(document.body).backgroundColor,
      sampleClass: sample.className || sample.tagName,
      sampleBg: s.backgroundColor,
      sampleColor: s.color,
      text: (doc ? doc.body.innerText : document.body.innerText).slice(0, 200)
    };
  });
  console.log(JSON.stringify(info, null, 2));
  await page.screenshot({path:'output/playwright/zentao-f73-dark-right.png', fullPage:true});
  await browser.close();
})();
