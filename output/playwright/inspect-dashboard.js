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
  const data = await page.evaluate(() => {
    const pick = sel => [...document.querySelectorAll(sel)].slice(0,20).map(el => ({tag: el.tagName, id: el.id, cls: el.className, text: (el.innerText||'').trim().slice(0,80)}));
    return {
      url: location.href,
      title: document.title,
      links: [...document.querySelectorAll('link[rel="stylesheet"]')].map(l => l.href),
      scripts: [...document.querySelectorAll('script[src]')].slice(0,20).map(s => s.src),
      bodyClass: document.body.className,
      ids: pick('[id]'),
      navs: pick('nav, aside, header, footer, .sidebar, .side, .app, .zen, .main, .toolbar, .dock, .bottom, .footer'),
      firstHtml: document.body.outerHTML.slice(0,12000)
    };
  });
  require('fs').writeFileSync('output/playwright/zentao-dashboard-dom.json', JSON.stringify(data, null, 2));
  await browser.close();
})();
