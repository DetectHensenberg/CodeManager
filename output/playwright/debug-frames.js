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
  await page.waitForTimeout(4000);
  console.log('main', page.url());
  console.log('frames', page.frames().map(f => f.url()));
  const iframes = await page.locator('iframe').evaluateAll(nodes => nodes.map(n => ({id:n.id, name:n.name, src:n.src, rect:(()=>{const r=n.getBoundingClientRect();return {x:r.x,y:r.y,w:r.width,h:r.height}})()})));
  console.log(JSON.stringify(iframes, null, 2));
  for (const f of page.frames()) {
    if (f === page.mainFrame()) continue;
    console.log('FRAMEURL', f.url());
    try { console.log(await f.evaluate(() => ({title:document.title, has:!!document.querySelector('.cm-lucen-dashboard'), text:document.body.innerText.slice(0,500), html:document.body.innerHTML.slice(0,200)}))); } catch(e) { console.log('ERR', e.message); }
  }
  await browser.close();
})();
