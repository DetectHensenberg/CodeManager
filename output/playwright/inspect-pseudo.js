const { chromium } = require('playwright');
(async()=>{
 const browser=await chromium.launch({headless:true});
 const context=await browser.newContext({viewport:{width:1440,height:1200},httpCredentials:{username:'zentao',password:'123456'}});
 const page=await context.newPage();
 await page.goto('http://127.0.0.1:81/zentao/user-login.html',{waitUntil:'domcontentloaded'});
 await page.locator('input[name="account"], input#account').first().fill('admin');
 await page.locator('input[name="password"], input#password').first().fill('Aa123456');
 await page.locator('button[type="submit"], input[type="submit"], #submit').first().click();
 await page.waitForTimeout(4500);
 await page.waitForFunction(() => document.querySelector('#appIframe-my')?.contentDocument?.querySelector('.cm-lucen-dashboard'), {timeout:15000});
 const data=await page.evaluate(() => {
  const doc=document.querySelector('#appIframe-my').contentDocument;
  const c=doc.querySelector('main#main > .container') || doc.querySelector('.container');
  const main=doc.querySelector('main#main');
  const dash=doc.querySelector('.cm-lucen-dashboard');
  const cs=(el,pseudo)=>doc.defaultView.getComputedStyle(el,pseudo);
  return {
    bodyClass: doc.body.className,
    containerClass: c?.className,
    before: {content: cs(c,'::before').content, display: cs(c,'::before').display, font: cs(c,'::before').fontSize},
    after: {content: cs(c,'::after').content, display: cs(c,'::after').display, font: cs(c,'::after').fontSize, top: cs(c,'::after').top, left: cs(c,'::after').left},
    mainBefore: {content: cs(main,'::before').content, display: cs(main,'::before').display},
    dashBefore: {content: cs(dash,'::before').content, display: cs(dash,'::before').display},
    cssLinks: [...doc.querySelectorAll('link[rel="stylesheet"]')].map(l=>l.href)
  };
 });
 console.log(JSON.stringify(data,null,2));
 await browser.close();
})();
