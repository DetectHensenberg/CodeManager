/**
 * Screenshot all 27 design pages from the running ZenTao instance.
 * Output: output/design/OUT/ (filenames match design prototypes)
 */
const { chromium } = require('playwright');
const path = require('path');
const fs = require('fs');

const BASE_URL = 'http://localhost:81/zentao/';
const HTTP_AUTH = { username: 'zentao', password: '123456' };
const LOGIN_CREDS = { account: 'admin', password: '123456' };
const OUT_DIR = path.resolve(__dirname, '../output/design/OUT');

// Map: number prefix -> [design name, URL path, viewport width (null=default 1440)]
const PAGES = [
  ['01', '地盘-首页',            'my.html'],
  ['02', '后台-首页',            'admin-dashboard.html'],
  ['03', '后台-安全设置',         'admin-security.html'],
  ['04', '后台-模块配置',         'admin-moduleConfig.html'],
  ['05', '产品-列表',            'product-browseList.html'],
  ['06', '产品-看板',            'product-kanban.html'],
  ['07', '项目-列表',            'project-browseList.html'],
  ['08', '项目-看板',            'project-boardView.html'],
  ['09', '项目-详情',            'project-detail.html'],
  ['10', '执行-列表',            'execution-browseList.html'],
  ['11', '执行-看板',            'execution-boardView.html'],
  ['12', '执行-详情',            'execution-detail.html'],
  ['13', '需求-列表',            'story-browseList.html'],
  ['14', '需求-详情',            'story-detail.html'],
  ['15', '任务-列表',            'task-browseList.html'],
  ['16', '任务-详情',            'task-detail.html'],
  ['17', 'Bug-列表',             'bug-browseList.html'],
  ['18', 'Bug-详情',             'bug-detail.html'],
  ['19', '测试-用例列表',         'testcase-browseList.html'],
  ['20', '测试-测试单列表',       'testreport-browseList.html'],
  ['21', '测试-测试单详情',       'testreport-detail.html'],
  ['22', '文档-空间首页',         'doc-spaceIndex.html'],
  ['23', '文档-文档列表',         'doc-browseList.html'],
  ['24', '文档-文档详情',         'doc-detail.html'],
  ['25', '看板-空间',            'kanban-spaceIndex.html'],
  ['26', '看板-看板详情',         'kanban-boardDetail.html'],
  ['27', '表单-创建编辑通用',     'admin-formTemplate.html'],
  ['28', '组织-首页',            'company-index.html'],
];

async function sleep(ms) {
  return new Promise(r => setTimeout(r, ms));
}

(async () => {
  if (!fs.existsSync(OUT_DIR)) fs.mkdirSync(OUT_DIR, { recursive: true });

  const browser = await chromium.launch({ headless: true });
  const context = await browser.newContext({
    viewport: { width: 1440, height: 900 },
    // Pass HTTP basic auth via URL encoding
    httpCredentials: HTTP_AUTH,
    ignoreHTTPSErrors: true,
  });
  const page = await context.newPage();

  try {
    // Step 1: Login to ZenTao
    console.log('Logging in...');
    await page.goto(BASE_URL + 'user-login.html', { waitUntil: 'networkidle', timeout: 30000 });
    await page.fill('input[name="account"]', LOGIN_CREDS.account);
    await page.fill('input[name="password"]', LOGIN_CREDS.password);
    await page.click('button[type="submit"]');
    try {
      await page.waitForFunction(() => {
        const url = window.location.href;
        return url.includes('/my') && !url.includes('login') && !url.includes('changePassword');
      }, { timeout: 15000 });
    } catch {
      const bodyText = await page.evaluate(() => document.body ? document.body.innerText : '');
      if (bodyText.includes('密码尝试次数太多') || bodyText.includes('locked')) {
        throw new Error('Account locked — too many login attempts');
      }
      console.log('  Warning: login redirect not detected, but proceeding');
    }
    await sleep(1000);
    console.log('Logged in.\n');

    // Step 2: Screenshot each page
    for (const [num, name, url] of PAGES) {
      const filename = `${num}-${name}.png`;
      const filepath = path.join(OUT_DIR, filename);

      try {
        console.log(`[${num}/28] ${name} → ${url}`);
        await page.goto(BASE_URL + url, { waitUntil: 'networkidle', timeout: 20000 });
        await sleep(1200); // let any animations settle

        // Admin / Company pages: wait for module-grid content to render
        const needsGridWait = url.includes('admin-') || url.includes('company-');
        if (needsGridWait) {
          try {
            await page.waitForSelector('.cm-page .module-grid, .cm-page .panel', { timeout: 8000 });
            await sleep(500);
          } catch {
            console.log(`  ⚠️ Selector wait timeout for ${name}, proceeding with screenshot`);
          }
        }

        // Check for fatal errors
        const bodyText = await page.textContent('body');
        if (bodyText && bodyText.includes('Fatal error')) {
          console.log(`  ⚠️ FATAL ERROR on page, saving error screenshot`);
        }

        await page.screenshot({ path: filepath, fullPage: true });
        console.log(`  ✓ Saved: ${filename}`);
      } catch (err) {
        console.log(`  ✗ Failed: ${err.message}`);
        // Take a screenshot of whatever is visible
        try {
          await page.screenshot({ path: filepath, fullPage: true });
          console.log(`  ! Error screenshot saved: ${filename}`);
        } catch (e2) {
          console.log(`  ✗ Could not save screenshot: ${e2.message}`);
        }
      }
    }

    console.log(`\nDone. Screenshots saved to: ${OUT_DIR}`);
    console.log(`Total: ${PAGES.length} pages`);
  } catch (err) {
    console.error('Fatal error:', err.message);
  } finally {
    await browser.close();
  }
})();
