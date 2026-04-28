const { chromium } = require('playwright');
const fs = require('fs');
const path = require('path');

const outDir = __dirname;
const pages = [
  '地盘-首页.html',
  '产品-看板.html',
  '产品-列表.html',
  '项目-列表.html',
  '项目-看板.html',
  '项目-详情.html',
  '执行-列表.html',
  '执行-看板.html',
  '执行-详情.html',
  '需求-列表.html',
  '需求-详情.html',
  '任务-列表.html',
  '任务-详情.html',
  'Bug-列表.html',
  'Bug-详情.html',
  '测试-用例列表.html',
  '测试-测试单列表.html',
  '测试-测试单详情.html',
  '文档-空间首页.html',
  '文档-文档列表.html',
  '文档-文档详情.html',
  '看板-空间.html',
  '看板-看板详情.html',
  '后台-首页.html',
  '后台-安全设置.html',
  '后台-模块配置.html',
  '表单-创建编辑通用.html',
];

(async () => {
  const browser = await chromium.launch({ headless: true });
  const results = [];
  for (const file of pages) {
    const page = await browser.newPage({ viewport: { width: 1440, height: 900 }, deviceScaleFactor: 1 });
    const filePath = path.join(outDir, file);
    await page.goto(`file:///${filePath.replace(/\\/g, '/')}`);
    await page.screenshot({ path: path.join(outDir, file.replace(/\.html$/, '.png')), fullPage: false });
    const metrics = await page.evaluate(() => ({
      title: document.title,
      bodyText: document.body.innerText.length,
      scrollHeight: document.documentElement.scrollHeight,
      innerHeight,
      canScroll: document.documentElement.scrollHeight > innerHeight,
      fixedBottom: getComputedStyle(document.querySelector('.bottom-bar')).position,
      panelCount: document.querySelectorAll('.panel,.metric,.card,.lane,.detail-block').length,
    }));
    results.push({ file, ...metrics });
    await page.close();
  }
  await browser.close();
  fs.writeFileSync(path.join(outDir, 'core-pages-check.json'), JSON.stringify(results, null, 2), 'utf8');
  console.log(JSON.stringify({
    checked: results.length,
    empty: results.filter(r => r.bodyText < 200).map(r => r.file),
    noPanels: results.filter(r => r.panelCount === 0).map(r => r.file),
    fixedBottomIssues: results.filter(r => r.fixedBottom !== 'fixed').map(r => r.file),
  }, null, 2));
})();
