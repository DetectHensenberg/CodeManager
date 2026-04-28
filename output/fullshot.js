const { chromium } = require('playwright');

(async () => {
  const browser = await chromium.launch({ headless: true, args: ['--no-sandbox'] });
  const ctx = await browser.newContext({
    viewport: { width: 1920, height: 1080 },
    httpCredentials: { username: 'zentao', password: '123456' },
  });
  ctx.route('**/*', (r) => {
    if (/poll|sse|stream|notify/i.test(r.request().url())) return r.abort();
    return r.continue();
  });
  const page = await ctx.newPage();

  await page.goto('http://127.0.0.1:81/zentao/user-login.html', { waitUntil: 'domcontentloaded' });
  await page.waitForTimeout(1000);
  await page.fill('input[name="account"]', 'admin');
  await page.fill('input[name="password"]', 'Admin@123456');
  await Promise.all([
    page.waitForNavigation({ waitUntil: 'domcontentloaded' }).catch(() => {}),
    page.click('button[type="submit"]'),
  ]);

  await page.goto('http://127.0.0.1:81/zentao/my.html', { waitUntil: 'domcontentloaded' });
  await page.waitForTimeout(6000);

  // Take full-page screenshot
  await page.screenshot({
    path: 'D:/Workspace/project/个人项目/CodeManager/output/full-dashboard.png',
    fullPage: true,
  });
  console.log('✓ Full page screenshot saved');

  // Verify iframe content summary
  const iframeHandle = await page.$('#appIframe-my');
  if (iframeHandle) {
    const iframe = await iframeHandle.contentFrame();
    if (iframe) {
      const summary = await iframe.evaluate(() => {
        const sections = Array.from(document.querySelectorAll('section'));
        const panels = Array.from(document.querySelectorAll('.panel'));
        const heroH1 = document.querySelector('.hero-row h1');
        const crumbs = document.querySelector('.crumbs');
        const metrics = Array.from(document.querySelectorAll('.metric .metric-value')).map(m => m.textContent);
        const tableRows = Array.from(document.querySelectorAll('.table-panel tbody tr'));
        return {
          totalSections: sections.length,
          totalPanels: panels.length,
          heroTitle: heroH1 ? heroH1.textContent : 'N/A',
          hasCrumbs: !!crumbs,
          metricValues: metrics,
          tableRowCount: tableRows.length,
          hasCSS: !!document.getElementById('codemanagerCSS'),
        };
      });
      console.log(JSON.stringify(summary, null, 2));
    }
  }

  await browser.close();
})();
