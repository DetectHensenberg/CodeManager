# CodeManager 项目改造方案

> 本文档用于记录针对当前 ZenTao 整合包项目的审阅结论与修改方案。
> 适用对象：解决方案工程师 + 产品经理，团队规模 ≤ 10 人。
> 后续所有修改建议、配置示例、脚本等都将更新到本文件，而不在对话中直接展示。

---

## 一、整体评估

### 项目定位
- 当前项目是基于 **ZenPanel** 的 ZenTao 整合包（Apache 2.4.25 + MySQL/MariaDB 10.1.25 + PHP 7.4.30 + Redis 6.2.16 + RoadRunner 2.0.0 + XXD 9.6）。
- 默认 vision 为 `rnd`（研发版），流程偏重。

### 与你的角色匹配度
- **优势**：开源、私有化、需求/任务/Bug/文档全套，本地化好。
- **不匹配点**：
  - 研发流程偏重，10 人小团队会觉得"重"。
  - 产品经理视角下需求池 → 故事 → 任务链路过长。
  - 解决方案工程师需要的"客户 / 项目 / 交付物"维度并非一等公民。

---

## 二、修改优先级总览

| 优先级 | 主题 | 时间窗口 |
|---|---|---|
| **P0** | 安全加固：改密码、迁移路径、配置备份 | 本周 |
| **P1** | 小团队精简：vision=lite、关闭无用模块、简化工作流 | 两周内 |
| **P2** | 角色定制：客户/合同自定义字段、解决方案文档库结构 | 一个月内 |
| **P3** | 长期：PHP 8.x 升级或评估替代工具 | 持续 |

---

## 三、P0 — 安全与稳定性（必改）

### 3.1 修改默认密码
- **MySQL root**：默认 `123456`，必须修改。
- **Apache 认证账号**：默认 `zentao/123456`（如启用）。
- **ZenTao admin**：首次登录强制改强密码。

> 具体命令与脚本将在后续更新到本文件第 [七] 节"落地脚本"中。

### 3.2 迁移到纯英文路径
- 当前路径 `D:\Workspace\project\个人项目\CodeManager\` **包含中文** "个人项目"。
- 违反 `CLAUDE.md` 中要求："Installation path must contain only alphanumeric characters and underscores"。
- **建议目标路径**：`D:\CodeManager\`。
- 风险：附件上传、SVN/Git 集成、AI 模块可能因中文路径出现异常。

### 3.3 网络暴露面收敛
- 确认 Apache 仅监听 `127.0.0.1` 或内网 IP。
- 如需远程访问，前面套 HTTPS 反代（Caddy / Nginx）。

### 3.4 自动备份
- 用 `bin/mysql/bin/mysqldump.exe` 写每日 Windows 计划任务。
- 输出到 `backup/`，按日期命名，保留 7~30 天滚动。

---

## 四、P1 — 面向小团队的精简

### 4.1 切换 vision 为 lite
- 在 `app/zentao/config/my.php` 中设置 `$config->vision = 'lite';`
- 砍掉大量企业级流程，10 人团队体验显著改善。

### 4.2 关闭无用模块
- 通过 `$config->disabledFeatures` 关闭：OKR、反馈、考勤、培训、招聘等 HR 模块。

### 4.3 简化工作流
- 禅道默认 Bug / Story 状态机过长，在「后台 → 工作流」中精简。

### 4.4 角色合并
- 推荐 3 类角色：**管理员 / 成员 / 访客**，不再细分 PO/PM/QA/Dev/PMO。

### 4.5 关闭不用的服务
- 编辑 `zbox/config.yml`，关闭未使用的 Redis / RoadRunner / XXD（如不用即时通讯）。

---

## 五、P2 — 解决方案工程师 + PM 定制

### 5.1 客户 / 项目维度
- 项目集（Program）= 客户
- 项目（Project）= 该客户下的交付
- 产品（Product）= 内部解决方案产品线

### 5.2 双轨需求池
- **内部产品需求** → 标准 Story
- **客户定制需求** → Story + 自定义字段：`客户`、`合同编号`、`交付截止日`、`SOW 链接`
- 通过 `my.php` 的 `$config->custom` 扩展字段。

### 5.3 解决方案文档库结构
建议三层目录：
- `客户 / {客户名}` — 单客户专属资料（POC、SOW、交付报告）
- `行业 / {行业名}` — 行业方案模板
- `通用 / {主题}` — 通用技术方案、最佳实践

### 5.4 看板视图
- 启用 Kanban，比甘特图更适合 10 人节奏。

---

## 六、P3 — 长期演进

### 6.1 运行时升级
- 当前 PHP 7.4 / MySQL 10.1 / Apache 2.4.25 **均已 EOL**。
- 选项 A：升级到禅道官方新版整合包（PHP 8.x）。
- 选项 B：迁移至禅道官方 Docker 镜像，运维成本最低。

### 6.2 是否更换工具的评估
| 维度 | 继续用 ZenTao | 迁移至飞书项目 / Teambition / Linear |
|---|---|---|
| 数据私有化 | ✅ | ❌ |
| 离线可用 | ✅ | ❌ |
| 客户协作（外部访客） | 一般 | ✅ |
| 维护成本 | 高（自维护 LAMP 栈） | 低 |
| 流程灵活度 | 高 | 中 |

> 决策建议：核心诉求若是**私有化 + 离线**，留 ZenTao 走 P0/P1；若是**效率 + 客户协作**，迁移更优。

---

## 七、落地脚本与配置（后续填充）

### 7.1 `my.php` 精简配置模板 ✅
- 已落地于 `app/zentao/config/my.php`
- 备份：`app/zentao/config/my.php.bak.20260426`
- 包含：vision=lite、disabledFeatures（13 项）、Story 自定义字段（4 个）、默认看板视图
- 详见 `WORKFLOW.md` Step 3

### 7.2 每日 MySQL 备份脚本（含 Windows 计划任务）
> P0 范畴，本轮未执行。后续启动 P0 时填充。

### 7.3 `zbox/config.yml` 服务裁剪 diff ⏸
- 决策搁置：等待用户确认是否使用 XXD 即时通讯
- 已备份原文件：`zbox/config.yml.bak.20260426`
- 详见 `WORKFLOW.md` Step 4

### 7.4 路径迁移操作步骤
> P0 范畴，本轮未执行。

---

## 八、变更日志

| 日期 | 变更内容 |
|---|---|
| 2026-04-26 | 初始化方案文档，完成审阅与优先级划分 |
| 2026-04-26 | 完成 P1+P2 代码层改造（my.php），输出后台手动操作清单。详见 `WORKFLOW.md` |
| 2026-04-27 | 前端改造第一轮回退，新增第九节重新规划 |

---

## 九、前端视觉改造方案（LucenAI 主题）

> **状态**：待审批  
> **参考图**：`C:\Users\admin\Pictures\Dashboard.png`、`C:\Users\admin\Pictures\Hero section 7.png`  
> **目标文件**：`app/zentao/www/theme/codemanager/codemanager.css`（主）+ 可能涉及 PHP 模板

---

### 9.1 上一轮为什么失败

| 问题 | 根因 |
|---|---|
| 白块、灰块残留 | 在浅色主题上叠加深色层，原始变量和新变量同时生效，互相干扰 |
| 底部白条消不掉 | 没有事先确认真实 DOM class 名，CSS 选择器打偏了 |
| 侧栏形态改不了 | ZenTao 侧栏结构与参考图不同，纯 CSS 无法重排 HTML 结构 |
| CSS 越写越乱 | `!important` 堆叠，后来的规则不断压前面的规则 |
| 改完看不到效果 | 忘记同步到 `C:\ZenTao` 运行目录，浏览器验证滞后 |

---

### 9.2 视觉目标（来自参考图）

| 区域 | 颜色 / 效果 |
|---|---|
| 页面底色 | `#03040a`（接近纯黑） |
| 侧栏背景 | `#20243f`（深蓝紫） |
| 顶部导航 | `#20243f` 或与侧栏同色，无分割线感 |
| 卡片 / 面板 | `#20233f`，低对比细边框 `rgba(123,132,186,.24)` |
| 主文字 | `#f8f8ff` 白 |
| 辅助文字 | `#8c93ad` 灰紫 |
| 主按钮 / 强调色 | `#6257ff` 蓝紫 |
| 成功 / 在线 | `#00c99a` |
| 危险 / 告警 | `#ff3472` |
| 环境氛围光 | 红紫蓝柔性 radial-gradient，作为 body 背景层 |

---

### 9.3 执行方案（四阶段）

#### 阶段 0 — 摸清 DOM 地图（不改代码）

**目标**：拿到每个视觉区域对应的真实 HTML class / id，不靠猜测。

- [ ] grep ZenTao 布局模板，确认以下 class 的真实名称：
  - 顶部主导航容器
  - 左侧栏容器
  - 底部工具栏 / 状态栏（上次白条来源）
  - 主内容区
  - 卡片 / panel / block
- [ ] 整理输出到本节 9.5「DOM 映射表」（摸完填进去）

**产出**：DOM 映射表（9.5 节），零代码改动。

---

#### 阶段 1 — 重写 CSS（主体工作）

**目标**：把 `codemanager.css` 的 `:root` 直接换成深色 token，而不是在后面追加覆盖层。

**原则**：
- `:root` 里只写一套 token，深色版本。不保留浅色变量。
- 不用 `!important`，靠选择器优先级自然覆盖 ZenTao 默认样式。
- 按区域逐块写、逐块验证，顺序：`body/html` → header → sidebar → main content → cards → forms → tables → buttons → bottom bar。
- 每块完成后立即同步 `C:\ZenTao`，用户 Ctrl+F5 验收后再做下一块。

**涉及文件**：
- `app/zentao/www/theme/codemanager/codemanager.css`（完整重写，不是追加）

**不涉及**：PHP 逻辑、数据库、服务配置。

**同步命令**（每次改完执行）：
```powershell
$rel = 'app\zentao\www\theme\codemanager\codemanager.css'
Copy-Item -LiteralPath (Join-Path (Get-Location) $rel) `
          -Destination (Join-Path 'C:\ZenTao' $rel) -Force
```

---

#### 阶段 2 — PHP 模板补充（视 CSS 效果决定是否执行）

**触发条件**：阶段 1 完成后，侧栏形态或顶部导航形态仍与参考图差距明显，且确认是 HTML 结构问题而非 CSS 问题。

**目标**：修改 ZenTao 布局 PHP 模板，调整 sidebar / header 的 HTML 结构。

**涉及文件**（仅限布局壳，不动业务逻辑）：
- `app/zentao/module/common/view/` 下的 layout 模板

**风险**：低–中。改结构模板会影响所有页面，但只改外壳 class / wrapper，不动数据渲染。

**决策**：阶段 1 审批通过并完成后，再由用户决定是否执行阶段 2。

---

#### 阶段 3 — 仪表盘布局结构（可选，高风险）

**触发条件**：用户明确要让「我的地盘」的卡片 + 图表 + 表格布局接近 `Dashboard.png` 参考图。

**目标**：改写 my 模块 dashboard 视图模板，实现统计卡 + 图表 + 表格的网格布局。

**涉及文件**：
- `app/zentao/module/my/view/` 下的仪表盘模板

**风险**：中–高。改视图模板需要了解 ZenTao 数据绑定方式，改错会导致数据不显示。

**决策**：独立立项，阶段 1+2 完成后用户单独审批。

---

### 9.4 各阶段审批节点

```
阶段 0 完成 → 提交 DOM 映射表 → 用户确认后开始阶段 1
阶段 1 完成 → 用户 Ctrl+F5 验收 → 决定是否执行阶段 2
阶段 2 完成 → 用户验收 → 决定是否执行阶段 3
```

**现在的审批请求**：请确认以下两点后，我开始执行阶段 0：

1. **当前 3 个 `M` 文件**（`codemanager.css`、`login.ui.css`、`login.html.php`）是保留还是丢弃（`git checkout -- .` 清掉）？
2. **阶段 3（仪表盘结构）** 是现在列入计划，还是 CSS 做好再说？

---

### 9.5 DOM 映射表 ✅

ZenTao 有两套渲染上下文，CSS 需同时覆盖。

**A — ZUI3 Shell（index 主页，`/zentao/`）**

| 视觉区域 | ID | 控制 CSS 变量 |
|---|---|---|
| 左侧栏 | `#menu` | `--zt-menu-bg`（默认 `var(--color-primary-600)`） |
| 主内容 iframe 区 | `#apps` | `--zt-page-bg` |
| **底部白条** | `#appsBar` | `--zt-apps-bar-bg`（默认 `var(--color-canvas)` = 白） |
| 底部 tab 列表 | `#appTabs` | 继承 `#appsBar` |
| 底部右侧工具栏 | `#appsToolbar` | 继承 `#appsBar` |
| 侧栏 nav item | `#menuMainNav > li > a` | `--zt-menu-hover-bg` / `--zt-menu-active-bg` |

**B — 传统 ZenTao 子页面（iframe 内，PHP 渲染）**

| 视觉区域 | selector | 覆盖方式 |
|---|---|---|
| 顶部主导航 | `#mainHeader` | 直接 CSS |
| 顶部 nav 项 | `#navbar .nav > li > a` | 直接 CSS |
| 子导航栏 | `#subHeader` | 直接 CSS |
| 主内容区 | `#main` | 直接 CSS |
| 左侧栏 | `.side`, `.leftmenu`, `.nav-primary` | 直接 CSS |
| 卡片 / 面板 | `.panel`, `.block`, `.cell`, `.module-block` | 直接 CSS |
| 表格 | `.table`, `.dtable`, `.main-table` | 直接 CSS |
| 模态框 | `.modal-content`, `.modal-header` | 直接 CSS |

**关键 CSS 变量（在 `:root` 统一覆盖）**

| 变量 | 新值 | 说明 |
|---|---|---|
| `--zt-apps-bar-bg` | `#20243f` | 修底部白条 |
| `--zt-menu-bg` | `#20243f` | 修左侧栏 |
| `--zt-page-bg` | `#111322` | 修 iframe 背景 |
| `--color-canvas` | `#111322` | ZUI3 全局画布色（影响范围广） |
| `--color-primary-500` | `#6257ff` | 统一主色为蓝紫 |
