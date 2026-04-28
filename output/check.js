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

  const iframeHandle = await page.$('#appIframe-my');
  const iframe = iframeHandle ? await iframeHandle.contentFrame() : null;

  // === SHELL CHECKS ===
  console.log('=== SHELL ===');

  // Check logo
  const logo = await page.evaluate(() => {
    const h = document.getElementById('spaceHeading');
    const t = h ? h.querySelector('.text') : null;
    return { text: t ? t.textContent : 'N/A', hasBrandMark: !!document.querySelector('.cm-brand-mark') };
  });
  console.log('Logo:', JSON.stringify(logo));

  // Check sidebar menu items (项目, 执行)
  const menuItems = await page.evaluate(() => {
    const items = Array.from(document.querySelectorAll('#menuMainNav > li:not(.cm-nav-label)'));
    return items.map(li => {
      const a = li.querySelector('a');
      const text = a ? a.textContent.trim().substring(0, 10) : '';
      const hasSub = li.classList.contains('dropdown') || li.classList.contains('has-sub');
      return { text, classes: li.className.substring(0, 80), hasArrow: !!li.querySelector('.arrow, .caret, .icon-arrow, [class*="arrow"], [class*="caret"]') };
    });
  });
  console.log('Menu items:', JSON.stringify(menuItems, null, 2));

  // Shell top-right buttons (toolbar area)
  const shellTopRight = await page.evaluate(() => {
    const els = Array.from(document.querySelectorAll('body *')).filter(el => {
      const r = el.getBoundingClientRect();
      return r.top < 80 && r.right > 1500 && r.width > 20 && r.width < 200 && r.height > 20 && r.height < 80;
    }).map(el => ({
      tag: el.tagName,
      class: el.className.toString().substring(0, 80),
      text: (el.textContent || '').trim().substring(0, 20),
      rect: { x: Math.round(el.getBoundingClientRect().x), y: Math.round(el.getBoundingClientRect().y), w: Math.round(el.getBoundingClientRect().width), h: Math.round(el.getBoundingClientRect().height) },
    }));
    return els;
  });
  console.log('Shell top-right elements:', JSON.stringify(shellTopRight, null, 2));

  // === IFRAME CHECKS ===
  if (iframe) {
    console.log('\n=== IFRAME ===');

    // Check metric grid layout
    const grid = await iframe.evaluate(() => {
      const g = document.querySelector('.metric-grid');
      if (!g) return 'NO METRIC GRID';
      const cs = getComputedStyle(g);
      return {
        display: cs.gridTemplateColumns,
        gap: cs.gap,
        children: g.children.length,
      };
    });
    console.log('Metric grid:', JSON.stringify(grid));

    // Check topbar buttons
    const topbarBtns = await iframe.evaluate(() => {
      const actions = document.querySelector('.top-actions');
      if (!actions) return 'NO TOP-ACTIONS';
      return Array.from(actions.children).map(c => ({
        tag: c.tagName,
        class: c.className.toString().substring(0, 60),
        text: c.textContent.trim().substring(0, 20),
      }));
    });
    console.log('Topbar buttons:', JSON.stringify(topbarBtns));

    // Check if work-trend and project-map exist
    const sections = await iframe.evaluate(() => {
      return Array.from(document.querySelectorAll('section')).map(s => ({
        class: s.className,
        ariaLabel: s.getAttribute('aria-label'),
        childCount: s.children.length,
      }));
    });
    console.log('Sections:', JSON.stringify(sections, null, 2));

    // Check bottom area
    const bottom = await iframe.evaluate(() => {
      const bar = document.querySelector('.bottom-bar, #appsBar');
      if (!bar) return 'NO BOTTOM BAR in iframe';
      return {
        class: bar.className,
        height: getComputedStyle(bar).height,
        children: Array.from(bar.children).map(c => c.className.toString().substring(0, 60)),
      };
    });
    console.log('Bottom bar (iframe):', JSON.stringify(bottom));
  }

  // Shell bottom bar
  const shellBottom = await page.evaluate(() => {
    const bar = document.getElementById('appsBar');
    if (!bar) return 'NO appsBar';
    const toolbar = document.getElementById('appsToolbar');
    return {
      height: getComputedStyle(bar).height,
      toolbarChildren: toolbar ? Array.from(toolbar.children).map(c => ({
        tag: c.tagName,
        class: c.className.toString().substring(0, 60),
        text: c.textContent.trim().substring(0, 30),
        style: c.getAttribute('style'),
      })) : [],
    };
  });
  console.log('\nShell bottom bar:', JSON.stringify(shellBottom, null, 2));

  await browser.close();
})();
