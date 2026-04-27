const { chromium } = require('playwright');
(async () => {
 const browser = await chromium.launch({headless:true});
 const context = await browser.newContext({viewport:{width:2048,height:768}, httpCredentials:{username:'zentao', password:'123456'}});
 const page = await context.newPage();
 await page.goto('http://127.0.0.1:81/zentao/user-login.html', {waitUntil:'domcontentloaded'});
 await page.locator('input[name="account"], input#account').first().fill('admin');
 await page.locator('input[name="password"], input#password').first().fill('Aa123456');
 await page.locator('button[type="submit"], input[type="submit"], #submit').first().click();
 await page.waitForTimeout(3500);
 const frame = page.frames().find(f => f.url().includes('/my.html'));
 const data = await frame.evaluate(() => {
  const r = el => { const b=el.getBoundingClientRect(); const s=getComputedStyle(el); return {tag:el.tagName,id:el.id,cls:el.className,text:(el.innerText||el.textContent||'').trim().slice(0,100),rect:{x:b.x,y:b.y,w:b.width,h:b.height},display:s.display,pos:s.position,flex:s.flexDirection,align:s.alignItems,justify:s.justifyContent,margin:s.margin,padding:s.padding}; };
  return {
   headerChildren:[...document.querySelectorAll('#header, #header *')].slice(0,60).map(r),
   toolbarChildren:[...document.querySelectorAll('#toolbar, #toolbar *')].slice(0,60).map(r)
  };
 });
 console.log(JSON.stringify(data,null,2));
 await browser.close();
})();
