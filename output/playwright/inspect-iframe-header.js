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
 await page.waitForTimeout(3500);
 const data = [];
 for (const f of page.frames()) {
  if (f === page.mainFrame()) continue;
  try {
   data.push(await f.evaluate(() => {
    const rect = el => { const r=el.getBoundingClientRect(); const s=getComputedStyle(el); return {tag:el.tagName,id:el.id,cls:el.className,text:(el.innerText||el.textContent||'').trim().slice(0,120),rect:{x:r.x,y:r.y,w:r.width,h:r.height},display:s.display,pos:s.position,z:s.zIndex}; };
    const pick = sel => [...document.querySelectorAll(sel)].map(rect);
    return {url:location.href, body:document.body.className, links:[...document.querySelectorAll('link[rel="stylesheet"]')].map(l=>l.href), nodes: pick('#header,#mainHeader,#toolbar,#userNav,#globalCreate,#userDropDownMenu,#subHeader,#subNavbar,#pageNav,#main')};
   }));
  } catch(e) { data.push({error:e.message, url:f.url()}); }
 }
 console.log(JSON.stringify(data,null,2));
 require('fs').writeFileSync('output/playwright/iframe-header-inspect.json', JSON.stringify(data,null,2));
 await browser.close();
})();
