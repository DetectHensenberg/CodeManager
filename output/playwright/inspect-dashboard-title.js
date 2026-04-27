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
  const nodes=[...doc.querySelectorAll('body *')].filter(el => (el.innerText||'').trim()==='Dashboard' || (el.textContent||'').trim()==='Dashboard');
  return nodes.map(el => { const r=el.getBoundingClientRect(); const cs=doc.defaultView.getComputedStyle(el); return {tag:el.tagName,id:el.id,cls:el.className, text:el.innerText||el.textContent, rect:{x:r.x,y:r.y,w:r.width,h:r.height}, display:cs.display, pos:cs.position, font:cs.fontSize, parent:{tag:el.parentElement?.tagName,id:el.parentElement?.id,cls:el.parentElement?.className}}; });
 });
 console.log(JSON.stringify(data,null,2));
 await browser.close();
})();
