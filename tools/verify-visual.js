const { chromium } = require('playwright');
const path = require('path');
const fs = require('fs');

const BASE_URL = 'http://localhost:81/zentao/';
const HTTP_AUTH = { username: 'zentao', password: '123456' };
const LOGIN_CREDS = { account: 'admin', password: '123456' };

// 对应截图脚本中的部分核心页面进行快速对比
const PAGES = [
  { id: '01', name: '地盘-首页', url: 'my.html' },
  { id: '05', name: '产品-列表', url: 'product-browseList.html' },
  { id: '08', name: '项目-看板', url: 'project-boardView.html' },
];

async function runVisualTests() {
  console.log('📸 启动前端视觉对比截图测试...');
  const browser = await chromium.launch({ headless: true });
  const context = await browser.newContext({
    viewport: { width: 1920, height: 1080 },
    httpCredentials: HTTP_AUTH,
    ignoreHTTPSErrors: true,
  });
  
  const page = await context.newPage();
  
  try {
    // 登录
    await page.goto(BASE_URL + 'user-login.html', { waitUntil: 'networkidle' });
    await page.fill('input[name="account"]', LOGIN_CREDS.account);
    await page.fill('input[name="password"]', LOGIN_CREDS.password);
    await page.click('button[type="submit"]');
    await page.waitForTimeout(2000); // 确保登录完成
    
    for (const p of PAGES) {
      console.log(`\n正在验证并截图页面: ${p.name}`);
      await page.goto(BASE_URL + p.url, { waitUntil: 'networkidle' });
      await page.waitForTimeout(1500); // 确保动画和异步渲染完成
      
      const shotPath = path.join(__dirname, `../output/test-reports/actual-${p.id}.png`);
      fs.mkdirSync(path.dirname(shotPath), { recursive: true });
      
      await page.screenshot({ path: shotPath, fullPage: true });
      console.log(`  ✅ 截图已保存至: ${shotPath}`);
      
      // 可以在此处接入 pixelmatch 或直接告知用户查看对比
      console.log(`  💡 请与 output/design/${p.id}-${p.name}.png 进行比对验证`);
    }
  } catch (error) {
    console.error(`\n❌ 视觉测试异常: ${error.message}`);
  } finally {
    await browser.close();
    console.log('\n🎉 视觉截图测试结束！');
  }
}

runVisualTests();