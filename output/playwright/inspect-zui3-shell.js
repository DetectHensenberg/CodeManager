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
 await page.waitForTimeout(3000);
 const data = await page.evaluate(() => {
   const pick = sel => [...document.querySelectorAll(sel)].map((el,i)=>{ const r=el.getBoundingClientRect(); const s=getComputedStyle(el); return {i, tag:el.tagName, id:el.id, cls:el.className, text:(el.innerText||el.textContent||'').trim().slice(0,120), rect:{x:r.x,y:r.y,w:r.width,h:r.height}, display:s.display, pos:s.position, z:s.zIndex}; });
   return {
    url:location.href,
    body:document.body.className,
    nodes: pick('#appsToolbar,#appsBar,#appTabs,#visionSwitcher,#menu,#apps,#chat-btn-container,#userMenu,#userNav,[data-name="search"],button,.btn').slice(0,80)
   };
 });
 console.log(JSON.stringify(data,null,2));
 require('fs').writeFileSync('output/playwright/zui3-shell-inspect.json', JSON.stringify(data,null,2));
 await browser.close();
})();
