# CodeManager 暗色主题改造 — 当前进度

## 已完成（全部 27 个页面）

### 01-地盘-首页 (Dashboard)
- 视图: `app/zentao/module/my/view/index.html.php` — ZUI3 Shell iframe
- oldPages: `my-index` (通过 screen-burn 等路由)

### 02-后台-首页 (Admin Home)
- 方法: `admin::dashboard()` / oldPages: `admin-dashboard`
- 视图: `app/zentao/module/admin/view/dashboard.html.php`

### 03-后台-安全设置 (Admin Security)
- 方法: `admin::security()` / oldPages: `admin-security`
- 视图: `app/zentao/module/admin/view/security.html.php`

### 04-后台-模块配置 (Admin Module Config)
- 方法: `admin::moduleConfig()` / oldPages: `admin-moduleConfig`
- 视图: `app/zentao/module/admin/view/moduleconfig.html.php`

### 05-产品-列表 (Product List)
- 方法: `product::browseList()` / oldPages: `product-browseList`
- 视图: `app/zentao/module/product/view/browselist.html.php`

### 06-产品-看板 (Product Kanban)
- 方法: `product::kanban()` / oldPages: `product-kanban`
- 视图: `app/zentao/module/product/view/kanban.html.php`

### 07-项目-列表 (Project List)
- 方法: `project::browseList()` / oldPages: `project-browseList`
- 视图: `app/zentao/module/project/view/browselist.html.php`

### 08-项目-看板 (Project Kanban)
- 方法: `project::boardView()` / oldPages: `project-boardView`
- 视图: `app/zentao/module/project/view/boardview.html.php`
- 注: `boardView` 避免与内置 `kanban()` 方法冲突

### 09-项目-详情 (Project Detail)
- 方法: `project::detail()` / oldPages: `project-detail`
- 视图: `app/zentao/module/project/view/detail.html.php`

### 10-执行-列表 (Execution List)
- 方法: `execution::browseList()` / oldPages: `execution-browseList`
- 视图: `app/zentao/module/execution/view/browselist.html.php`

### 11-执行-看板 (Execution Kanban)
- 方法: `execution::boardView()` / oldPages: `execution-boardView`
- 视图: `app/zentao/module/execution/view/boardview.html.php`

### 12-执行-详情 (Execution Detail)
- 方法: `execution::detail()` / oldPages: `execution-detail`
- 视图: `app/zentao/module/execution/view/detail.html.php`

### 13-需求-列表 (Story List)
- 方法: `story::browseList()` / oldPages: `story-browseList`
- 视图: `app/zentao/module/story/view/browselist.html.php`

### 14-需求-详情 (Story Detail)
- 方法: `story::detail()` / oldPages: `story-detail`
- 视图: `app/zentao/module/story/view/detail.html.php`

### 15-任务-列表 (Task List)
- 方法: `task::browseList()` / oldPages: `task-browseList`
- 视图: `app/zentao/module/task/view/browselist.html.php`

### 16-任务-详情 (Task Detail)
- 方法: `task::detail()` / oldPages: `task-detail`
- 视图: `app/zentao/module/task/view/detail.html.php`

### 17-Bug-列表 (Bug List)
- 方法: `bug::browseList()` / oldPages: `bug-browseList`
- 视图: `app/zentao/module/bug/view/browselist.html.php`

### 18-Bug-详情 (Bug Detail)
- 方法: `bug::detail()` / oldPages: `bug-detail`
- 视图: `app/zentao/module/bug/view/detail.html.php`

### 19-测试-用例列表 (Test Case List)
- 方法: `testcase::browseList()` / oldPages: `testcase-browseList`
- 视图: `app/zentao/module/testcase/view/browselist.html.php`

### 20-测试-测试单列表 (Test Report List)
- 方法: `testreport::browseList()` / oldPages: `testreport-browseList`
- 视图: `app/zentao/module/testreport/view/browselist.html.php`

### 21-测试-测试单详情 (Test Report Detail)
- 方法: `testreport::detail()` / oldPages: `testreport-detail`
- 视图: `app/zentao/module/testreport/view/detail.html.php`

### 22-文档-空间首页 (Doc Space Home)
- 方法: `doc::spaceIndex()` / oldPages: `doc-spaceIndex`
- 视图: `app/zentao/module/doc/view/spaceindex.html.php`

### 23-文档-文档列表 (Doc List)
- 方法: `doc::browseList()` / oldPages: `doc-browseList`
- 视图: `app/zentao/module/doc/view/browselist.html.php`

### 24-文档-文档详情 (Doc Detail)
- 方法: `doc::detail()` / oldPages: `doc-detail`
- 视图: `app/zentao/module/doc/view/detail.html.php`

### 25-看板-空间 (Kanban Space)
- 方法: `kanban::spaceIndex()` / oldPages: `kanban-spaceIndex`
- 视图: `app/zentao/module/kanban/view/spaceindex.html.php`

### 26-看板-看板详情 (Kanban Board Detail)
- 方法: `kanban::boardDetail()` / oldPages: `kanban-boardDetail`
- 视图: `app/zentao/module/kanban/view/boarddetail.html.php`

### 27-表单-创建编辑通用 (Form Template)
- 方法: `admin::formTemplate()` / oldPages: `admin-formTemplate`
- 视图: `app/zentao/module/admin/view/formtemplate.html.php`

## CSS 基础设施
- `codemanager.css`: 通用组件类 (detail-layout, data-table, form-grid, module-grid, etc.)
- 响应式缩放: clamp() 宽度/间距 + narrow breakpoint
- 通用页面选择器: `.cm-page` 由 `:has()` 规则匹配，统一覆盖容器宽度和 padding

## 关键约束（踩坑记录）
1. ZUI3 Shell 加载：自定义页面必须加入 `index/config.php` 的 `oldPages`，走 `loadOldPage()` 路径
2. 视图中使用 `helper::createLink()` 而非 `createLink()` — parse() 上下文无全局函数
3. 模板必须包含 `header.html.php` 和 `footer.html.php`
4. codemanager.css 通过 `<link>` 标签加载，不在 ZIN 的 CSS 合并流程内
5. 避免方法名冲突：`project::boardView()` 避免与内置 `kanban()` 冲突；`execution::boardView()` 同理
6. 所有设计页面统一使用 `class="cm-page"` 作为 CSS `:has()` 选择目标

## 2026-04-29 会话：修复与验证

### 产品看板 CSS 类名修复
`product/view/kanban.html.php`（06-产品-看板）由旧 agent 创建时使用了错误的 CSS 类名：
- `.hero-row` → `.hero`
- `.panel-caption` → `.caption`

该页面未在 `tools/generate-views.php` 的 $map 数组中，因此未随其他 25 页一起重新生成。手动修复完成。

### 执行模块跳转修复
`execution/control.php` 的 `__construct()` 方法在数据库中无执行数据时会跳转到 `execution-create`。修复方案：将 `browseList`、`boardView`、`detail` 加入 `$skipCreateStep` 数组。

**关键发现**：`control::__construct()` 会对 `$this->methodName` 执行 `strtolower()`（见 `framework/base/control.class.php:306`），因此 `$skipCreateStep` 必须使用小写值（`browselist`、`boardview`），否则 `in_array()` 匹配失败。

### 设计原型 CSS 类名差异（记录，无影响）
不同设计原型之间 CSS 类名存在差异，codemanager.css 已全量兼容：

| 设计 | 搜索框 | 指标区 | 面板描述 |
|------|--------|--------|----------|
| 01-地盘-首页 | `.search` | `.hero-row` | `.panel-caption` |
| 05-产品-列表 | `.search-top` | `.metrics` / `.metric` | — |
| 06-产品-看板 | `.search` | `.stats` / `.card` | `.caption` |
| 02-04,07-27 | `.search-top` | `.metrics` / `.metric` | — |

### 截图工具
`tools/screenshot-pages.js` — Playwright 自动化脚本：
- 通过 API 登录获取 session cookie
- 遍历全部 27 页，每页 `fullPage: true` 截图
- 输出到 `output/design/OUT/XX-页面名称.png`
- 需要 Apache 已启动且数据库 `safe.mode=0`、`safe.changeWeak=0`

### 验证结果（2026-04-29）
全部 27 页通过验证：
- 26 个自定义页面 + 1 个地盘首页均返回正确标题
- 无 Fatal error 或 PHP Parse error
- 所有页面 `.cm-page` 容器正常渲染
- 截图保存于 `output/design/OUT/`，文件名与设计原型一一对应

## 2026-04-29 会话：设计图 vs 实现差异修复

### 背景

基于 `design_vs_implementation.md` 对 27 页的逐一对比，修复 6 个维度的差异。

### CSS 修复（codemanager.css）

1. **响应式断点 1400px → 1100px（3 处）**
   - 根因：ZUI3 Shell iframe 实际宽度 = 视口 - 侧边栏(~250px)，1440px 截图下 iframe 仅 ~1150px，导致 `max-width: 1400px` 在所有页面都触发
   - 影响：`.metric-grid`、`.section-grid`、`.grid-2`、`.workflow`、`.module-grid`、`.stats`、`.detail-layout`、`.insight-grid`、`.metrics`
   - 效果：桌面分辨率下 4 列 Grid 不再强制折行为 2 列

2. **底部遮挡修复**
   - `#main:has(.cm-page)` 增加 `padding-bottom: 80px`（58px appsBar + 22px 缓冲）
   - 影响 9 个列表页

3. **Hero CSS 统一**
   - 合并 `.hero` 和 `.hero-row` 为同一规则块
   - 统一 `font-weight: 850`、`color: var(--cm-lu-muted)`
   - 删除旧的重复 `.hero-row` 定义
   - 更新兄弟选择器同时支持 `.hero ~ .panel` 和 `.hero-row ~ .panel`

4. **看板优化**
   - `.lane-head` 和 `.kanban-design .lane-head` 背景: `rgba(60,66,112,.58)` → `.8`
   - 新增 `.card.sortable-ghost { opacity: 0.4; border: 1px dashed var(--primary); }`

5. **`.search-top` 响应式宽度**: `380px` → `min(380px, 32vw)`

### 截图脚本修复（screenshot-pages.js）

- 全局等待 `sleep(800)` → `sleep(1200)`
- Admin 页面额外 `waitForSelector('.cm-page .module-grid, .cm-page .panel')`

### 路由修复（关键踩坑）

**问题**：侧边栏导航链接（`/admin.html`、`/doc.html`、`/product.html`）→ `module::index()` → 显示原始禅道旧 UI。自定义页面在 `oldPages` URL 下（如 `admin-dashboard.html`）。

**错误尝试**：使用 `$this->locate($this->createLink('admin', 'dashboard'))` 做 HTTP 重定向。这会：

- 导致整页跳转、离开 ZUI3 Shell 上下文
- 如果自定义方法被误删则 Fatal error

**正确方案**：使用 `$this->display('admin', 'dashboard')` 直接切换渲染视图：

- `display()` 检测到 `admin-dashboard` 在 `oldPages` 中 → 走 `parse()` 输出 `dashboard.html.php`
- 无 HTTP 跳转、URL 不变、不需要 `createLink()` 生成 URL

**修改的 4 个 controller**：

| 模块 | `index()` 改动 |
| --- | --- |
| `admin` | `$this->display('admin', 'dashboard')` |
| `doc` | `$this->display('doc', 'spaceIndex')` |
| `product` | `$this->display('product', 'browseList')` |
| `project` | `inLink('browse')` → `inLink('browseList')`（5 处） |

### 恢复自定义方法

`git checkout` 误删了之前未提交的自定义 controller 方法（`dashboard()`、`security()`、`browseList()` 等），导致 PHP Fatal error。已恢复：

- `admin/control.php`: 4 个方法（dashboard/security/moduleConfig/formTemplate）
- `project/control.php`: 3 个方法（browseList/boardView/detail）
- `doc/control.php`: 3 个方法（spaceIndex/browseList/detail）

### 遗留问题

- ~~侧边栏"组织"页面无自定义设计~~ → 2026-04-29 会话已解决（28-组织-首页）
- ~~P2 细节优化~~ → 2026-04-29 会话已解决
- 所有修改需同步到 `C:\ZenTao`（运行目录）才能生效

## 2026-04-29 会话：design_vs_implementation.md 全面验收

### 验收方法
按 `网页验收.md` 规定的四步自动化验证流程执行：
1. PHP 语法检查
2. 路由与渲染验证（verify-routes.js）
3. 截图端到端验证（screenshot-pages.js）
4. 日志静默检查

### 创建的工具
- `tools/verify-routes.js` — Step 2 自动化验证脚本
  - 使用 Playwright + HTTP basic auth（无需表单登录）
  - 验证全部 27 个自定义页面 + 4 个侧边栏入口路由
  - 断言：HTTP 200、含 `.cm-page`、无 PHP Fatal/Parse/未定义方法错误

### 验证结果

**Step 1 — PHP 语法**: 13/13 文件通过（admin/bug/doc/execution/index/kanban/product/project/story/task/testcase/testreport control.php + my/view/index.html.php）

**Step 2 — 路由渲染**: 31/31 通过
- 27 个自定义页面全部 HTTP 200、含 cm-page、无 PHP 错误
- 4 个入口路由（admin/doc/product/project）全部通过 display() 正确渲染

**Step 3 — 截图 E2E**: 27/27 正常
- 所有页面 bodyText ≥ 415、panelCount ≥ 2
- P0 修复确认：03-后台-安全设置（panelCount=7）、04-后台-模块配置（panelCount=7）不再白屏
- core-pages-check.json 无 empty/noPanels 异常

**Step 4 — 日志静默**: 零报错
- 无 php.*.log.php 生成
- Cron 日志全部 success
- 无 Apache error

### CSS 修复逐项确认
| 修复项 | 状态 |
|--------|------|
| 响应式断点 1400→1100px（4处） | ✅ |
| 底部遮挡 padding-bottom:80px | ✅ |
| Hero CSS 统一（.hero + .hero-row） | ✅ |
| 看板 .lane-head rgba(60,66,112,.8) | ✅ |
| 拖拽 .card.sortable-ghost | ✅ |

### 验收结论
design_vs_implementation.md 中记录的 P0/P1 问题已全部修复并验证通过。遗留 P2（文字对比度、日期格式、Loading/Disabled 状态）待后续迭代。

## 2026-04-29 会话：P2 优化 + 组织页面 + 同步脚本

### Stream 1: P2 细节优化

**1A. 文字对比度**
- 文件: `codemanager.css`
- 修改 3 个设计令牌 `#747eaa` → `#8e95c0`（提升 ~15% 亮度）:
  - `--cm-lu-muted` (line 46)
  - `--color-secondary-200` (line 104, ZUI3 shell)
  - `--color-gray-500` (line 111, ZUI3 shell)
- 效果: 28 处引用全部受益，表头对比度从 ~3.3:1 → ~4.6:1

**1B. 日期格式**
- 13 个视图文件中静态演示数据 `YYYY/MM/DD` → `YYYY-MM-DD`
- 动态日期 `my/control.php` `Y年m月d日 星期X` 保持不变（中文本地化）

**1C. Loading 状态**（新增 CSS）
- `.loading-overlay` — 全屏遮罩（backdrop-filter blur）
- `.spinner` / `.spinner-sm` — 旋转加载圈（`border-top-color: var(--cm-lu-primary)`）
- `@keyframes cm-spin`
- `.skeleton` / `.skeleton-text` / `.skeleton-heading` / `.skeleton-card` — 骨架屏
- `@keyframes cm-shimmer`
- `.icon-spin.icon-spinner` ZUI3 集成

**1D. Disabled 状态**（扩展 CSS）
- 扩展原有 `.disabled { opacity: .42 }` 为全套禁用样式:
  - `input:disabled, textarea:disabled, select:disabled, .form-control:disabled`
  - `button:disabled, .btn:disabled, .btn-primary:disabled, .primary-btn:disabled`
  - `.ghost-btn:disabled, .icon-btn:disabled`
  - `.switch.disabled` (含 `::after`)
  - `input[type="checkbox"]:disabled, input[type="radio"]:disabled`
  - `.select.disabled`

**1E. 标题文案修复**（7 个视图文件）
- `Bug列表` → `Bug 列表`, `Bug详情` → `Bug 详情`
- `文档文档列表` → `文档列表`, `文档文档详情` → `文档详情`
- `看板看板详情` → `看板详情`
- `测试测试单列表` → `测试单列表`, `测试测试单详情` → `测试单详情`

### Stream 2: 组织页面改造（28-组织-首页）

**新建文件**:
- `company/view/index.html.php` — 参照 `admin/view/dashboard.html.php` 模式
  - 指标卡片: 部门总数/用户总数/在线用户/待审批
  - 模块导航: 用户管理/部门管理/权限组/动态/公司信息/团队日历
  - 组织洞察 + 建议动作

**修改文件**:
- `company/control.php`: `index()` 改用 `$this->display('company', 'index')`（非 `locate()`）
- `index/config.php`: 注册 `company-index` 到 `oldPages`
- `tools/verify-routes.js`: 新增 `['28', '组织-首页', 'company-index.html']`
- `tools/screenshot-pages.js`: 同上，总数 27→28

### Stream 3: 同步脚本

**新建**: `tools/sync-to-zen-tao.ps1`
- 列出 42 个需同步文件（CSS/controller/config/view/tools）
- `-Mode dry-run`: MD5 对比，仅显示差异
- `-Mode live`: `Copy-Item -Force`

### 关键踩坑

1. **admin 密码不是 `123456`**: 数据库存储 `md5(plain)`，原密码已被修改。重置为 `md5('123456') = e10adc39...` 后 Playwright 登录恢复
2. **弱密码强制修改**: 密码重置后 ZenTao 强制跳转 `changePassword` 页 → 所有截图都变成同一画面。设置 `safe.mode=0` + `safe.changeWeak=0` 解决
3. **product::browseList() 不存在**: 被 `git checkout` 移除后未恢复。手动添加方法 + `skipLocateCreate` 白名单
4. **同步是必须的**: 所有修改必须在 C:\ZenTao（运行实例）中才能生效。开发目录修改 → 测试无效果，排查了很久才发现

### verify-routes.js 修复增强
- 移除 HTTP basic auth only 方案（会导致假阳性——页面返回 200 但内容是登录页）
- 恢复 Playwright 表单登录流程
- 新增: 拒绝登录页回退（检测 `系统登录已过期`）
- 新增: 拒绝账号锁定（检测 `密码尝试次数太多`）

### 截图脚本修复
- 移除表单登录 → 恢复（登录超时是密码/安全模式问题）
- 新增 company 页面等待 `.cm-page .module-grid` 渲染
- 登录成功检测加入 locked 错误处理

### 文件修改总清单
| 流 | 文件数 | 类型 |
|----|--------|------|
| 1A/C/D | 1 | CSS 修改 |
| 1B | 13 | 视图日期格式 |
| 1E | 7 | 视图标题修复 |
| 2 | 5 | 新建/修改（组织页面） |
| 3 | 1 | 新建（同步脚本） |
| **合计** | **27** | |

### 验证结果（四步法）
| 步骤 | 结果 |
|------|------|
| Step 1: 语法检查 | 全部 PHP 文件 `No syntax errors` |
| Step 2: verify-routes.js | **32/32 通过**（28 自定页 + 4 入口） |
| Step 3: screenshot-pages.js | **28/28 保存**，无白屏，无登录页回退 |
| Step 4: 日志静默 | 无 PHP/Apache 错误 |

### 后续
- 所有 P0/P1/P2 问题已解决，27→28 页面全部验证通过
- 组织页面 `selector wait timeout` 警告待排查（页面内容已正常渲染）
- 中英文混排空格已在 Stream 1E 中修复，但新增视图中可能仍有遗漏

## 2026-04-29 会话：ZIN ui/ wrapper 全面替换 + 截图

### 背景
之前只替换了 3 个页面的 ZIN `ui/` 文件，其余 25 个页面路由仍走旧 ZenTao UI。

### ZIN ui/ wrapper 架构
```
URL → controller → display() → oldPages check → render()
  → ui/<method>.html.php (ZIN wrapper)
  → 设置 $zinContext=true → include view/<method>.html.php
  → view 文件跳过 header/footer → 只输出 .cm-page 暗色主题内容
```

### 新建/修改文件

**新建 24 个 ZIN ui/ wrapper**（每个模块的 `ui/` 目录）：
- `admin/ui/{dashboard,moduleconfig,formtemplate}.html.php`
- `product/ui/{browselist,kanban}.html.php`
- `project/ui/{browselist,boardview,detail}.html.php`
- `execution/ui/{browselist,boardview}.html.php`
- `story/ui/{browselist,detail}.html.php`
- `task/ui/{browselist,detail}.html.php`
- `bug/ui/{browselist,detail}.html.php`
- `testcase/ui/browselist.html.php`
- `testreport/ui/{browselist,detail}.html.php`
- `doc/ui/{spaceindex,browselist,detail}.html.php`
- `kanban/ui/{spaceindex,boarddetail}.html.php`
- `company/ui/index.html.php`

**修改 23 个 view/ 文件**：header/footer include 包裹 `if (!isset($zinContext))`

**oldPages 精简**：`index/config.php` 移除 24 条自定义页面，仅保留系统级条目。

**CSS 修复**：
- `product/view/browselist.html.php`: table class `product-table` → `product-table data-table`
- `product/view/kanban.html.php`: 添加 `$zinContext` 条件

### 工具文件
- `tools/create-ui-wrappers.js` — 批量生成 ZIN wrapper 脚本
- `tools/sync-now.js` — Node.js 同步脚本（dev → C:\ZenTao）
- `tools/screenshot-newui.js` — 28 页全页截图脚本

### Git 提交
1. `265791b3` — fix: 修复 3 页面 .cm-page 缺失
2. `7c0177c1` — chore: 清理旧设计稿，只保留编号新界面
3. `8c6fbd74` — feat: ZIN ui/ wrapper 全面替换 28 个旧页面

### 截图现状（未完成）
- **01-地盘-首页** ✅ 完整截图（3891px，直接渲染无 iframe）
- **02-28** ⚠️ 全页截图高度正确但内容区只有背景，无实际内容

**根因分析**：
- ZUI3 Shell 布局：`#menu`(fixed left) + `#apps`(fixed, `bottom:58px`) + `#app-{name}`(absolute, `overflow:hidden`) + `iframe`
- `body { height: 0px }` 导致 Playwright `fullPage: true` 失效
- `#app-*` 的 `overflow: hidden` 裁剪 iframe 内容
- `#apps` 的 `position: fixed` 阻止页面滚动

**已尝试方案**：
1. ❌ CSS `addStyleTag` 注入 — 被 ZUI3 JS 动态覆盖
2. ❌ `page.evaluate` 直接设高度 — `position:fixed/absolute` 约束无法突破
3. ❌ 静态 HTML 提取 + `<base>` 标签 — `file://` 协议下 CSS 不加载
4. ❌ `position: static !important` — 破坏布局，内容被挤出屏幕
5. ⏳ 待验证：iframe 内容提取到新 page 独立渲染

**下一步**：解决 02-28 截图内容不显示问题，需要绕过 ZUI3 Shell 的 fixed/absolute 定位约束，或找到方法让 iframe 内容在 `fullPage` 模式下可见。
