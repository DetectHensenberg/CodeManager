const { chromium } = require('playwright');
(async () => {
  const browser = await chromium.launch({headless:true});
  const context = await browser.newContext({viewport:{width:2048,height:768}, httpCredentials:{username:'zentao', password:'123456'}});
  const page = await context.newPage();
  await page.goto('http://127.0.0.1:81/zentao/user-login.html', {waitUntil:'domcontentloaded'});
  await page.locator('input[name="account"], input#account').first().fill('admin');
  await page.locator('input[name="password"], input#password').first().fill('Aa123456');
  await page.locator('button[type="submit"], input[type="submit"], #submit').first().click();
  await page.waitForLoadState('networkidle', {timeout:15000}).catch(()=>{});
  await page.waitForTimeout(2500);
  const info = await page.evaluate(() => {
    const rect = sel => { const el = document.querySelector(sel); if(!el) return null; const r = el.getBoundingClientRect(); return {x:r.x,y:r.y,w:r.width,h:r.height,text:(el.innerText||'').trim().slice(0,80)}; };
    return {toolbar: rect('#toolbar'), userNav: rect('#userNav'), subNavbar: rect('#subNavbar'), pageNav: rect('#pageNav'), header: rect('#header')};
  });
  console.log(JSON.stringify(info, null, 2));
  await page.screenshot({path:'output/playwright/zentao-toolbar-fix.png', fullPage:true});
  await browser.close();
})();
