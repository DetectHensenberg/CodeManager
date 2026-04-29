/**
 * verify-routes.js — Step 2 of the automated verification workflow.
 * Uses Playwright with HTTP basic auth (no form login needed for page access).
 * Asserts: HTTP 200, contains .cm-page, no PHP fatal/parse errors.
 */
const { chromium } = require('playwright');

const BASE_URL = 'http://localhost:81/zentao/';
const HTTP_AUTH = { username: 'zentao', password: '123456' };

function sleep(ms) { return new Promise(r => setTimeout(r, ms)); }

const ROUTES = [
  ['01',  '地盘-首页',           'my.html'],
  ['02',  '后台-首页',           'admin-dashboard.html'],
  ['03',  '后台-安全设置',       'admin-security.html'],
  ['04',  '后台-模块配置',       'admin-moduleConfig.html'],
  ['05',  '产品-列表',           'product-browseList.html'],
  ['06',  '产品-看板',           'product-kanban.html'],
  ['07',  '项目-列表',           'project-browseList.html'],
  ['08',  '项目-看板',           'project-boardView.html'],
  ['09',  '项目-详情',           'project-detail.html'],
  ['10',  '执行-列表',           'execution-browseList.html'],
  ['11',  '执行-看板',           'execution-boardView.html'],
  ['12',  '执行-详情',           'execution-detail.html'],
  ['13',  '需求-列表',           'story-browseList.html'],
  ['14',  '需求-详情',           'story-detail.html'],
  ['15',  '任务-列表',           'task-browseList.html'],
  ['16',  '任务-详情',           'task-detail.html'],
  ['17',  'Bug-列表',            'bug-browseList.html'],
  ['18',  'Bug-详情',            'bug-detail.html'],
  ['19',  '测试-用例列表',       'testcase-browseList.html'],
  ['20',  '测试-测试单列表',     'testreport-browseList.html'],
  ['21',  '测试-测试单详情',     'testreport-detail.html'],
  ['22',  '文档-空间首页',       'doc-spaceIndex.html'],
  ['23',  '文档-文档列表',       'doc-browseList.html'],
  ['24',  '文档-文档详情',       'doc-detail.html'],
  ['25',  '看板-空间',           'kanban-spaceIndex.html'],
  ['26',  '看板-看板详情',       'kanban-boardDetail.html'],
  ['27',  '表单-创建编辑通用',   'admin-formTemplate.html'],
  ['28',  '组织-首页',           'company-index.html'],
];

const ENTRY_ROUTES = [
  ['admin',   'admin.html'],
  ['doc',     'doc.html'],
  ['product', 'product.html'],
  ['project', 'project.html'],
];

const PHP_ERRORS = [
  'Fatal error', 'Parse error', 'Call to undefined',
  'Uncaught Error', '<b>Warning</b>', '<b>Fatal error</b>', '<b>Notice</b>',
];

const LOGIN_CREDS = { account: 'admin', password: '123456' };

(async () => {
  const browser = await chromium.launch({ headless: true });
  const context = await browser.newContext({
    httpCredentials: HTTP_AUTH,
    ignoreHTTPSErrors: true,
  });
  const page = await context.newPage();

  let passed = 0, failed = 0;
  const failures = [];

  try {
    // --- Login ---
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
      if (bodyText.includes('密码尝试次数太多') || bodyText.includes('超过次数')) {
        throw new Error('Account locked — too many login attempts. Unlock via DB first.');
      }
    }
    await sleep(1000);
    console.log('Logged in.\n');

    // --- Check all 28 custom pages ---
    console.log('--- Custom pages (28 routes) ---\n');
    for (const [num, name, url] of ROUTES) {
      try {
        const resp = await page.goto(BASE_URL + url, { waitUntil: 'networkidle', timeout: 20000 });
        await sleep(200);

        const body = await page.content();
        const bodyText = await page.evaluate(() => document.body ? document.body.innerText : '');

        const checks = [];
        if (resp.status() !== 200) checks.push(`HTTP ${resp.status()}`);
        if (!body.includes('cm-page')) checks.push('Missing cm-page');
        // Reject login page fallback
        if (bodyText.includes('系统登录已过期')) checks.push('Login page fallback (no session)');
        if (bodyText.includes('密码尝试次数太多')) checks.push('Account locked');
        for (const pat of PHP_ERRORS) {
          if (body.includes(pat)) { checks.push(`PHP error: "${pat}"`); break; }
        }

        if (checks.length === 0) {
          console.log(`  ✓ [${num}] ${name}`);
          passed++;
        } else {
          console.log(`  ✗ [${num}] ${name}: ${checks.join('; ')}`);
          failed++;
          failures.push({ num, name, errors: checks });
        }
      } catch (err) {
        console.log(`  ✗ [${num}] ${name}: ${err.message}`);
        failed++;
        failures.push({ num, name, errors: [err.message] });
      }
    }

    // --- Check entry points ---
    console.log(`\n--- Entry points (sidebar nav) ---\n`);
    for (const [label, url] of ENTRY_ROUTES) {
      try {
        const resp = await page.goto(BASE_URL + url, { waitUntil: 'networkidle', timeout: 20000 });
        await sleep(200);

        const body = await page.content();
        const bodyText = await page.evaluate(() => document.body ? document.body.innerText : '');

        const checks = [];
        if (resp.status() !== 200) checks.push(`HTTP ${resp.status()}`);
        if (!body.includes('cm-page')) checks.push('Missing cm-page');
        if (bodyText.includes('系统登录已过期')) checks.push('Login page fallback');
        for (const pat of PHP_ERRORS) {
          if (body.includes(pat)) { checks.push(`PHP error: "${pat}"`); break; }
        }

        if (checks.length === 0) {
          console.log(`  ✓ [${label}] entry`);
          passed++;
        } else {
          console.log(`  ✗ [${label}] entry: ${checks.join('; ')}`);
          failed++;
          failures.push({ num: '--', name: `${label} entry`, errors: checks });
        }
      } catch (err) {
        console.log(`  ✗ [${label}] entry: ${err.message}`);
        failed++;
        failures.push({ num: '--', name: `${label} entry`, errors: [err.message] });
      }
    }

    const total = passed + failed;
    console.log(`\n========================================`);
    console.log(`RESULTS: ${passed}/${total} passed, ${failed} failed`);
    if (failures.length > 0) {
      console.log(`\nFAILURES:`);
      failures.forEach(f => console.log(`  [${f.num}] ${f.name}: ${f.errors.join('; ')}`));
    }
    console.log(`========================================`);
  } finally {
    await browser.close();
  }

  process.exit(failed > 0 ? 1 : 0);
})().catch(err => {
  console.error('Fatal:', err.message);
  process.exit(1);
});
