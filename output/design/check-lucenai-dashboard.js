const { chromium } = require('playwright');
const path = require('path');

(async () => {
  const browser = await chromium.launch({ headless: true });
  const page = await browser.newPage({ viewport: { width: 1440, height: 900 }, deviceScaleFactor: 1 });
  const filePath = path.resolve(__dirname, 'lucenai-dashboard-effect.html');
  await page.goto(`file:///${filePath.replace(/\\/g, '/')}`);
  await page.screenshot({ path: path.resolve(__dirname, 'lucenai-dashboard-scroll-top.png'), fullPage: false });
  const metricsTop = await page.evaluate(() => ({
    innerHeight,
    scrollHeight: document.documentElement.scrollHeight,
    bodyHeight: document.body.scrollHeight,
    canScroll: document.documentElement.scrollHeight > innerHeight,
    bottomBar: getComputedStyle(document.querySelector('.bottom-bar')).position,
  }));
  await page.evaluate(() => window.scrollTo(0, document.documentElement.scrollHeight));
  await page.waitForTimeout(200);
  await page.screenshot({ path: path.resolve(__dirname, 'lucenai-dashboard-scroll-bottom.png'), fullPage: false });
  const metricsBottom = await page.evaluate(() => ({
    scrollY,
    viewportBottom: window.scrollY + innerHeight,
    scrollHeight: document.documentElement.scrollHeight,
  }));
  console.log(JSON.stringify({ metricsTop, metricsBottom }, null, 2));
  await browser.close();
})();
