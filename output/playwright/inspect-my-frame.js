const { chromium } = require('playwright');
(async () => {
  const browser = await chromium.launch({headless: true});
  const context = await browser.newContext({viewport: {width: 1440, height: 1200}, httpCredentials: {username: 'zentao', password: '123456'}});
  const page = await context.newPage();
  await page.goto('http://127.0.0.1:81/zentao/user-login.html', {waitUntil: 'domcontentloaded'});
  await page.locator('input[name="account"], input#account').first().fill('admin');
  await page.locator('input[name="password"], input#password').first().fill('Aa123456');
  await page.locator('button[type="submit"], input[type="submit"], #submit').first().click();
  await page.waitForLoadState('networkidle', {timeout: 15000}).catch(()=>{});
  await page.waitForTimeout(1500);
  const frame = page.frames().find(f => f.url().includes('/my.html'));
  const data = await frame.evaluate(() => {
    const pick = sel => [...document.querySelectorAll(sel)].slice(0,40).map(el => ({tag:el.tagName,id:el.id,cls:el.className,text:(el.innerText||'').trim().slice(0,120), rect:(()=>{const r=el.getBoundingClientRect(); return {x:r.x,y:r.y,w:r.width,h:r.height}})()}));
    return {url:location.href, bodyClass:document.body.className, links:[...document.querySelectorAll('link[rel="stylesheet"]')].map(l=>l.href), ids:pick('[id]'), headers:pick('header,#header,#mainHeader,#subHeader,#main,.page,.page-header,.toolbar,.tabs,.nav,.dashboard,.panel,.block')};
  });
  require('fs').writeFileSync('output/playwright/my-frame-dom.json', JSON.stringify(data,null,2));
  await browser.close();
})();
