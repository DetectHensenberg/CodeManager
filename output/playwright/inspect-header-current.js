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
 const frames = [];
 for (const f of page.frames()) {
  try {
   frames.push(await f.evaluate(() => {
    const get = (sel) => [...document.querySelectorAll(sel)].map((el, i) => {
      const r = el.getBoundingClientRect(); const s = getComputedStyle(el);
      return {i, tag:el.tagName, id:el.id, cls:String(el.className), text:(el.innerText||el.textContent||'').trim().slice(0,120), rect:{x:r.x,y:r.y,w:r.width,h:r.height}, display:s.display, visibility:s.visibility, opacity:s.opacity, pos:s.position, z:s.zIndex, color:s.color, bg:s.backgroundColor};
    });
    return {
      url: location.href,
      body: document.body.className,
      header: get('#header,#mainHeader,#heading,#navbar,#navbar .nav,#navbar .nav > li,#toolbar,#userNav,#userNav > li,#globalCreate,#messageBar,#userDropDownMenu,#subHeader,#subNavbar,#subNavbar .nav,#subNavbar .nav > li,#main'),
      textNodes: get('*').filter(x => x.text === '???' || x.text.includes('???')).slice(0,20)
    };
   }));
  } catch(e) { frames.push({url:f.url(), error:e.message}); }
 }
 console.log(JSON.stringify(frames, null, 2));
 require('fs').writeFileSync('output/playwright/header-current-inspect.json', JSON.stringify(frames,null,2));
 await browser.close();
})();
