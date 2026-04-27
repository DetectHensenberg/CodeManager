const { chromium } = require('playwright');
(async()=>{
 const browser=await chromium.launch({headless:true});
 const context=await browser.newContext({viewport:{width:1440,height:1400},httpCredentials:{username:'zentao',password:'123456'}});
 const page=await context.newPage();
 await page.goto('http://127.0.0.1:81/zentao/user-login.html',{waitUntil:'domcontentloaded'});
 await page.locator('input[name="account"], input#account').first().fill('admin');
 await page.locator('input[name="password"], input#password').first().fill('Aa123456');
 await page.locator('button[type="submit"], input[type="submit"], #submit').first().click();
 await page.waitForTimeout(4500);
 await page.waitForFunction(() => document.querySelector('#appIframe-my')?.contentDocument?.querySelector('.cm-lucen-dashboard'), {timeout:15000});
 const data=await page.evaluate(() => {
  const doc=document.querySelector('#appIframe-my').contentDocument;
  const dash=doc.querySelector('.cm-lucen-dashboard');
  function info(el){const cs=doc.defaultView.getComputedStyle(el); const r=el.getBoundingClientRect(); return {tag:el.tagName,id:el.id,cls:el.className,text:(el.innerText||'').slice(0,60), rect:{x:r.x,y:r.y,w:r.width,h:r.height}, display:cs.display, pos:cs.position, marginTop:cs.marginTop, paddingTop:cs.paddingTop, height:cs.height};}
  const children=[...doc.body.children].map(info);
  const chain=[]; let el=dash; while(el){chain.push(info(el)); el=el.parentElement;}
  return {bodyClass:doc.body.className, children, chain, scrollY:doc.defaultView.scrollY, documentHeight:doc.documentElement.scrollHeight};
 });
 console.log(JSON.stringify(data,null,2));
 await browser.close();
})();
