# 地盘主页设计对齐方案

## 背景

用户提供了更新后的设计稿 `lucenai-dashboard-effect.html`（1262行），要求地盘主页（`my/index.html.php`）与设计稿完全一致，并加入模拟数据。

## 当前状态

- 地盘主页通过 `my/index.html.php` 引入 `header/footer` + `$this->fetch('block', 'dashboard', 'dashboard=my')` 渲染
- `block/dashboard` 使用 ZUI3 的 `zui::dashboard` JS 网格组件，从数据库读取 block 配置
- 页面渲染在传统 `#header > #main > .container` 结构中，并被 ZUI3 Shell 以 iframe 方式嵌入
- CSS（`codemanager.css`）已完成三阶段基础样式对齐（按钮、面板、头像、排版等）

## 设计稿关键结构

设计稿包含以下区域（按顺序）：
1. **Hero** — 面包屑 + 仪表盘标题 + 副标题 + 日期药丸 + 教程按钮
2. **Metric Grid** — 4列指标卡（待评审数、任务数、Bug数、需求数）
3. **Grid-2** — 工作趋势图 + 项目地图
4. **Workflow** — 使用帮助 + 研发综合流程
5. **Table Panel** — 我的待处理列表
6. **Section Grid** — 项目动态 + 产品雷达 + 快捷入口
7. **Grid-2** — 产品与执行概览 + 最近文档
8. **Section Grid** — 我的贡献 + 风险提醒 + 系统状态

## 实施方案

### 修改文件清单

| 文件 | 操作 | 说明 |
|------|------|------|
| `app/zentao/module/my/view/index.html.php` | **重写** | 替换 ZUI dashboard 为自定义 HTML |
| `app/zentao/www/theme/codemanager/codemanager.css` | **追加** | 新增设计特定样式规则 |
| `C:\ZenTao\...` (运行目录) | **同步** | 两个文件同步到运行目录 |

### 1. 重写 `my/index.html.php`

**策略：** 保留 `header.html.php` / `footer.html.php` 包裹，用自定义 HTML 完全替换 `block/dashboard`。

**内容结构（对应设计稿）：**

```php
<!-- 模拟数据定义 (PHP) -->
<?php
$mockMetrics = [
  ['label'=>'待我评审', 'value'=>12, 'badge'=>'+3', 'link'=>'查看评审数', 'color'=>'green'],
  ['label'=>'任务数', 'value'=>38, 'badge'=>'-2%', 'link'=>'查看全部任务', 'color'=>'blue'],
  ['label'=>'Bug数', 'value'=>7, 'badge'=>'+1', 'link'=>'查看详情', 'color'=>'yellow'],
  ['label'=>'研发需求', 'value'=>24, 'badge'=>'+5.2%', 'link'=>'查看需求池', 'color'=>'purple'],
];
$mockTodoItems = [...];
$mockTimeline = [...];
$mockDocs = [...];
?>

<!-- Hero 区域 -->
<!-- Metric Grid -->
<!-- Grid-2: 趋势 + 地图 -->
<!-- Workflow -->
<!-- Table Panel -->
<!-- Section Grid -->
<!-- Grid-2 -->
<!-- Section Grid -->
```

**关键设计参数：**
- 面包屑：`地盘 › 仪表盘`
- Title font-size: 36px
- Date pill：`2026年04月28日 星期二`
- 图表区域使用 SVG（纯 CSS 无 JS 依赖）
- 表格使用 `<table>` 静态 HTML
- 所有数据均为 PHP 数组驱动的模拟数据

### 2. CSS 新增样式（`codemanager.css` 末尾追加）

需要新增/调整的设计特定 CSS：

```css
/* === 地盘设计布局 === */

/* Hero 区域 */
.hero-row { display: flex; align-items: flex-end; justify-content: space-between; gap: 28px; margin-bottom: 28px; }
.hero-row h1 { font-size: 36px; font-weight: 850; }
.hero-row .subtitle { margin-top: 8px; color: var(--cm-lu-muted); font-size: 16px; }
.date-pill { height: 42px; display: inline-flex; align-items: center; gap: 10px; padding: 0 18px; margin-top: 18px; border-radius: 999px; background: rgba(42,48,84,.72); border: 1px solid rgba(142,158,223,.18); font-weight: 850; }

/* Metric Grid */
.metric-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 24px; margin-bottom: 28px; }
.metric { min-height: 150px; padding: 22px 24px; position: relative; overflow: hidden; }
.metric-top { display: flex; justify-content: space-between; color: #8c96bc; font-size: 14px; font-weight: 900; text-transform: uppercase; }
.metric-value { margin: 24px 0 20px; font-size: 32px; font-weight: 850; }
.metric-link { color: var(--cm-lu-primary-h); font-size: 15px; font-weight: 750; }
.metric-badge { font-weight: 900; }
.metric-badge.green { color: #18c99b; }
.metric-badge.red { color: #ff4f7a; }
.metric-badge.yellow { color: #f3b73c; }
.metric-icon { position: absolute; right: 24px; bottom: 22px; width: 44px; height: 44px; display: grid; place-items: center; border-radius: 8px; }
.metric:after { content: ""; position: absolute; right: -38px; bottom: -50px; width: 140px; height: 140px; border-radius: 50%; background: rgba(99,102,241,.12); }

/* 响应式：2列 */
@media (max-width: 1400px) {
  .metric-grid, .section-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
  .grid-2, .workflow { grid-template-columns: 1fr; }
}

/* Grid-2 / Section Grid */
.grid-2 { display: grid; grid-template-columns: 1.08fr .92fr; gap: 24px; margin-bottom: 36px; }
.section-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 24px; margin-bottom: 36px; }

/* Panel 头部增强 */
.panel-head { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 28px; }
.panel-title { font-size: 21px; font-weight: 850; }
.panel-caption { margin-top: 6px; color: #7680aa; font-size: 14px; font-weight: 650; }

/* 图表区域 */
.chart-stats { display: flex; gap: 48px; margin-bottom: 28px; }
.chart-stats b { color: #6971ff; font-size: 30px; font-weight: 850; }
.chart { height: 260px; position: relative; padding: 22px 8px 0 62px; }
.axis { /* Y轴 */ }
.bar { width: 34px; background: linear-gradient(180deg, #6f72ff, #5356df); border-radius: 4px 4px 0 0; box-shadow: 0 -18px 36px rgba(99,102,241,.14); }

/* 地图 */
.map { height: 288px; border: 1px solid rgba(178,190,255,.08); border-radius: 8px; background: radial-gradient(...); }
.map-label { position: absolute; color: #bfc8e8; font-size: 12px; font-weight: 850; }
.pin { position: absolute; width: 9px; height: 9px; border-radius: 50%; background: #18c99b; box-shadow: 0 0 0 5px rgba(24,201,155,.12); }

/* 流程图 */
.workflow { display: grid; grid-template-columns: 170px minmax(0, 1fr); gap: 24px; margin-bottom: 36px; }
.step { height: 38px; min-width: 122px; padding: 0 16px; display: inline-flex; align-items: center; clip-path: polygon(0 0, calc(100% - 14px) 0, 100% 50%, calc(100% - 14px) 100%, 0 100%, 12px 50%); color: #30394f; background: rgba(173,184,204,.92); font-size: 15px; font-weight: 850; }
.step.role { min-width: 148px; color: #fff; background: #5b95e8; clip-path: polygon(0 0, calc(100% - 12px) 0, 100% 50%, calc(100% - 12px) 100%, 0 100%); }

/* 表格面板 */
.table-panel { padding: 0; margin-bottom: 36px; }
.table-head { min-height: 78px; padding: 0 28px; display: flex; align-items: center; justify-content: space-between; gap: 16px; }
td { height: 58px; border-bottom: 1px solid rgba(154,170,226,.12); background: rgba(20,25,47,.18); }
.status { display: inline-flex; height: 28px; align-items: center; padding: 0 14px; border-radius: 999px; font-weight: 850; }
.status.active { color: #18c99b; background: rgba(24,201,155,.14); }
.status.warn { color: #f3b73c; background: rgba(243,183,60,.16); }
.status.danger { color: #ff4f7a; background: rgba(255,79,122,.16); }
.progress { display: inline-flex; align-items: center; gap: 10px; }
.track { width: 44px; height: 4px; border-radius: 999px; background: #eef2ff; overflow: hidden; }
.fill { display: block; height: 100%; background: #18c99b; }

/* 迷你卡片 */
.stack { display: grid; gap: 16px; }
.mini-card { min-height: 96px; padding: 20px; }
.mini-title { color: #e9eeff; font-size: 16px; font-weight: 850; }
.mini-meta { margin-top: 8px; color: var(--cm-lu-muted); font-size: 14px; line-height: 1.55; }

/* 时间线 */
.timeline { display: grid; gap: 18px; }
.time-item { display: grid; grid-template-columns: 84px 1fr; gap: 18px; }
.time { color: var(--cm-lu-primary-h); font-weight: 850; }
.time-body { padding-left: 18px; border-left: 1px solid rgba(178,190,255,.18); }
.time-body strong { display: block; margin-bottom: 6px; font-size: 16px; }

/* 雷达 */
.radar { height: 260px; display: grid; place-items: center; border-radius: 10px; background: rgba(9,14,29,.18); border: 1px solid rgba(178,190,255,.08); }

/* 快捷入口 */
.quick-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 14px; }
.quick { height: 82px; padding: 16px; display: flex; flex-direction: column; justify-content: space-between; border-radius: 10px; background: rgba(18,23,44,.42); border: 1px solid rgba(178,190,255,.13); color: #eef3ff; font-weight: 850; }
.quick span { color: #7680aa; font-size: 12px; font-weight: 750; }

/* 文档列表 */
.doc-list { display: grid; gap: 14px; }
.doc-row { display: grid; grid-template-columns: 1fr auto; gap: 18px; align-items: center; padding: 16px 0; border-bottom: 1px solid rgba(178,190,255,.12); }
.doc-title { font-weight: 850; }
.doc-meta { margin-top: 5px; color: var(--cm-lu-muted); font-size: 13px; }

/* 帮助标签 */
.help-tabs { display: flex; flex-direction: column; gap: 12px; margin-top: 20px; font-size: 18px; font-weight: 750; }
.help-tabs span:first-child { color: #6670ff; }

/* 面包屑 */
.crumbs { display: flex; gap: 10px; margin-bottom: 14px; color: #ccd4ef; font-size: 13px; font-weight: 750; }
```

### 3. 模拟数据

```php
$userName = $app->user->realname ?: $app->user->account;
$dateStr = date('Y年m月d日');
$weekday = ['日','一','二','三','四','五','六'][date('w')];
$dateFull = $dateStr . ' 星期' . $weekday;

$metrics = [
  ['label'=>'待我评审', 'value'=>12, 'badge'=>'+3', 'badgeColor'=>'green', 'link'=>'查看评审数'],
  ['label'=>'任务数',   'value'=>38, 'badge'=>'-2%','badgeColor'=>'red',   'link'=>'查看全部任务'],
  ['label'=>'Bug数',    'value'=>7,  'badge'=>'+1', 'badgeColor'=>'green', 'link'=>'查看详情'],
  ['label'=>'研发需求', 'value'=>24, 'badge'=>'+5.2%','badgeColor'=>'green','link'=>'查看需求池'],
];

// ... 更多模拟数据
```

## 执行顺序

1. **写 PHP 模板** — 重写 `my/index.html.php`，加入完整设计HTML + 模拟数据
2. **写 CSS** — 在 `codemanager.css` 末尾追加设计特定样式
3. **同步到 C:\ZenTao** — 复制两个文件到运行目录
4. **Playwright 验证** — 截图对比设计稿
5. **用户验收** — Ctrl+F5 刷新查看

## 风险评估

- **风险：低** — 仅修改 `my/index.html.php` 这一个页面模板，不修改框架代码
- **可恢复性：高** — 原文件仅 2 行业务代码（header + block/dashboard + footer），可随时回滚
- **影响范围：小** — 仅影响地盘主页（`/my/`），其他页面不受影响

## 验证方法

1. 访问 `http://127.0.0.1:81/zentao/my/` 查看地盘页面
2. Playwright 截图与设计稿对比
3. 检查各区域布局是否与设计稿一致
4. 检查暗色主题是否有白色残留
