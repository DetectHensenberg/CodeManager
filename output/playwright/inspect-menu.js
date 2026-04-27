const { chromium } = require('playwright');
(async () => {
  const browser = await chromium.launch({headless: true});
  const context = await browser.newContext({viewport: {width: 2048, height: 1152}, httpCredentials: {username:'zentao', password:'123456'}});
  const page = await context.newPage();
  await page.goto('http://127.0.0.1:81/zentao/user-login.html', {waitUntil:'domcontentloaded'});
  await page.locator('input[name="account"], input#account').first().fill('admin');
  await page.locator('input[name="password"], input#password').first().fill('Aa123456');
  await page.locator('button[type="submit"], input[type="submit"], #submit').first().click();
  await page.waitForTimeout(4500);
  const data = await page.evaluate(() => {
    const cs = el => getComputedStyle(el);
    const rect = el => { const r = el.getBoundingClientRect(); return {x:r.x,y:r.y,w:r.width,h:r.height}; };
    const menuItems = [...document.querySelectorAll('#menu .nav > li')].map((li, i) => {
      const a = li.querySelector('a'); const s = cs(li); const as = a ? cs(a) : null;
      return {i, cls:li.className, text:(li.innerText||'').trim(), rect:rect(li), display:s.display, margin:s.margin, height:s.height, aRect:a?rect(a):null, aDisplay:as?.display};
    });
    const menuChildren = [...document.querySelectorAll('#menu > *')].map((el,i)=>({i, tag:el.tagName, id:el.id, cls:el.className, text:(el.innerText||'').trim().slice(0,80), rect:rect(el), display:cs(el).display, margin:cs(el).margin, height:cs(el).height}));
    return {url:location.href, menuRect:rect(document.querySelector('#menu')), menuChildren, menuItems};
  });
  require('fs').writeFileSync('output/playwright/menu-inspect.json', JSON.stringify(data,null,2));
  console.log(JSON.stringify({items:data.menuItems.map(x=>({i:x.i,text:x.text,y:x.rect.y,h:x.rect.h,cls:x.cls})), children:data.menuChildren}, null, 2));
  await browser.close();
})();
