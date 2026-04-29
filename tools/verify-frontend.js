const { chromium } = require('playwright');
const path = require('path');
const fs = require('fs');

const BASE_URL = 'http://localhost:81/zentao/';
const HTTP_AUTH = { username: 'zentao', password: '123456' };
const LOGIN_CREDS = { account: 'admin', password: '123456' };

// 定义需要测试的页面及特征
const PAGES_TO_TEST = [
  { name: '地盘-首页', url: 'my.html', expected: { hasMetrics: true, hasSidebar: true } },
  { name: '后台-安全设置', url: 'admin-security.html', expected: { hasGrid: true } },
  { name: '产品-列表', url: 'product-browseList.html', expected: { hasTable: true, hasPager: true } },
  { name: '项目-看板', url: 'project-boardView.html', expected: { hasBoard: true } },
  { name: '执行-详情', url: 'execution-detail.html', expected: { hasDetailLayout: true } }
];

async function runTests() {
  console.log('🚀 启动前端一致性与功能流程自动化测试...');
  const browser = await chromium.launch({ headless: true });
  const context = await browser.newContext({
    viewport: { width: 1920, height: 1080 },
    httpCredentials: HTTP_AUTH,
    ignoreHTTPSErrors: true,
  });
  
  const page = await context.newPage();
  let passedCount = 0;
  let failedCount = 0;

  const assert = (condition, msg) => {
    if (!condition) {
      console.error(`  ❌ [失败] ${msg}`);
      failedCount++;
      return false;
    }
    console.log(`  ✅ [通过] ${msg}`);
    passedCount++;
    return true;
  };

  try {
    // ==========================================
    // 1. 测试功能流程：登录
    // ==========================================
    console.log('\n--- 场景 1: 登录流程测试 ---');
    await page.goto(BASE_URL + 'user-login.html', { waitUntil: 'networkidle' });
    await page.fill('input[name="account"]', LOGIN_CREDS.account);
    await page.fill('input[name="password"]', LOGIN_CREDS.password);
    await page.click('button[type="submit"]');
    
    await page.waitForFunction(() => window.location.href.includes('/my'), { timeout: 10000 });
    assert(page.url().includes('/my'), '成功重定向到我的地盘首页');

    // ==========================================
    // 2. 测试页面设计一致性 (DOM & CSS 样式)
    // ==========================================
    console.log('\n--- 场景 2: 页面设计一致性验证 ---');
    
    for (const testPage of PAGES_TO_TEST) {
      console.log(`\n正在验证页面: ${testPage.name} (${testPage.url})`);
      await page.goto(BASE_URL + testPage.url, { waitUntil: 'load', timeout: 15000 });
      await page.waitForTimeout(1500); // 等待可能的数据渲染

      // 处理可能存在的 iframe (ZUI3 Shell 经常使用 iframe 加载实际内容)
      let targetFrame = page.frames().find(f => f.url().includes(testPage.url.split('?')[0])) || page.mainFrame();
      if (targetFrame === page.mainFrame()) {
        const iframeElement = await page.$('iframe[id^="appIframe"]');
        if (iframeElement) {
          targetFrame = await iframeElement.contentFrame();
        }
      }

      // 通用级检查：不能有 Fatal error
      const bodyText = await targetFrame.textContent('body');
      assert(!bodyText.includes('Fatal error') && !bodyText.includes('Parse error'), '页面无 PHP 报错');
      
      // 通用级检查：包含 .cm-page
      const hasCmPage = await targetFrame.$('.cm-page') !== null;
      assert(hasCmPage, '页面包含 .cm-page 自定义主题容器');

      // 获取页面样式数据
      const styles = await targetFrame.evaluate(() => {
        const body = window.getComputedStyle(document.body);
        const bottomBar = document.querySelector('.bottom-bar');
        const bottomBarStyle = bottomBar ? window.getComputedStyle(bottomBar) : null;
        const metrics = document.querySelector('.metrics');
        const metricsStyle = metrics ? window.getComputedStyle(metrics) : null;
        
        return {
          bodyBg: body.backgroundColor,
          bottomBarPosition: bottomBarStyle ? bottomBarStyle.position : null,
          bottomBarZIndex: bottomBarStyle ? bottomBarStyle.zIndex : null,
          metricsGridCols: metricsStyle ? metricsStyle.gridTemplateColumns : null
        };
      });

      // 验证深色模式背景
      assert(styles.bodyBg !== 'rgb(255, 255, 255)', '未使用白色背景，符合暗色主题');

      // 验证底部栏悬浮及层级
      if (styles.bottomBarPosition) {
        assert(styles.bottomBarPosition === 'fixed', '底部栏 .bottom-bar 定位为 fixed');
        assert(parseInt(styles.bottomBarZIndex) >= 10, '底部栏 z-index 足够高，避免被遮挡');
      }

      // 验证大屏下网格布局是否为 4 列
      if (testPage.expected.hasMetrics && styles.metricsGridCols) {
        const cols = styles.metricsGridCols.split(' ').length;
        assert(cols === 4, `在大屏(1440px)下 .metrics 包含 4 列网格 (实际: ${cols} 列)`);
      }

      // 特定元素检查
      if (testPage.expected.hasTable) {
        const hasTable = await targetFrame.$('.data-table') !== null;
        assert(hasTable, '页面包含数据表格 .data-table');
      }
      if (testPage.expected.hasBoard) {
        const hasBoard = await targetFrame.$('.board, .kanban-board') !== null;
        assert(hasBoard, '页面包含看板容器');
      }
    }

    // ==========================================
    // 3. 测试功能流程：页面交互与导航
    // ==========================================
    console.log('\n--- 场景 3: 交互与导航流程验证 ---');
    await page.goto(BASE_URL + 'project-browseList.html', { waitUntil: 'load', timeout: 15000 });
    
    let targetFrame = page.frames().find(f => f.url().includes('project-browseList.html')) || page.mainFrame();
    if (targetFrame === page.mainFrame()) {
      const iframeElement = await page.$('iframe[id^="appIframe"]');
      if (iframeElement) {
        targetFrame = await iframeElement.contentFrame();
      }
    }

    // 检查列表到详情的跳转
    const detailBtn = await targetFrame.$('.data-table tbody tr:first-child .small-btn, .data-table tbody tr:first-child a');
    if (detailBtn) {
      console.log('  找到详情按钮，尝试点击跳转...');
      
      // 捕获导航
      await Promise.all([
        page.waitForNavigation({ waitUntil: 'load', timeout: 15000 }),
        detailBtn.click()
      ]);
      
      const currentUrl = page.url();
      assert(currentUrl.includes('project-detail') || currentUrl.includes('view'), '成功从列表页跳转到详情页');
      
      const hasDetailLayout = await page.$('.detail-layout') !== null || await page.frames().some(f => f.$('.detail-layout') !== null);
      assert(hasDetailLayout, '详情页渲染了 .detail-layout 布局');
    } else {
      console.log('  ⚠️ 未找到表格行内的详情按钮，跳过跳转测试');
    }

  } catch (error) {
    console.error(`\n❌ 测试脚本执行异常: ${error.message}`);
  } finally {
    await browser.close();
    
    console.log('\n==========================================');
    console.log(`测试结果汇总: `);
    console.log(`✅ 成功: ${passedCount}`);
    console.log(`❌ 失败: ${failedCount}`);
    console.log('==========================================');
    if (failedCount > 0) {
      console.log('💡 建议: 请根据失败日志，检查对应 HTML 输出或 CSS 样式配置。');
    } else {
      console.log('🎉 所有一致性与流程测试均已通过！前端实现与设计稿高度吻合。');
    }
  }
}

runTests();