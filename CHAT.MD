# CodeManager 前端工作交接摘要

更新时间：2026-04-30

## 当前目标

继续修复真实 ZenTao Web 前端 01-27 页，使真实运行截图尽量贴近 `output/design` 中的设计稿。

重要边界：
- 修复目标是真实 ZenTao 实现：PHP/ZUI/ZIN 模板和 `codemanager.css`。
- 不把 `output/NEWUI/*.html` 保存快照当作实现目标。
- `output/NEWUI/*.png` 是真实运行截图产物，用于和设计稿对比。
- 不为了匹配设计稿示例数字修改数据库或真实业务数据。
- 当前仍以 27 页为准，未发现第 28 页设计稿。
- 历史 mojibake 文案默认不作为视觉验收问题，除非直接影响页面显示。

## 重要路径

仓库路径：
```text
D:\Workspace\project\个人项目\CodeManager
```

运行目录：
```text
C:\ZenTao
```

本地访问地址：
```text
http://127.0.0.1:81/zentao/
```

设计稿目录：
```text
output/design
```

真实运行截图输出：
```text
output/NEWUI/01.png ... output/NEWUI/27.png
```

对比图输出：
```text
output/NEWUI/compare/01-compare.png ... output/NEWUI/compare/27-compare.png
```

主样式文件：
```text
app/zentao/www/theme/codemanager/codemanager.css
```

产品看板模板：
```text
app/zentao/module/product/view/kanban.html.php
```

同步脚本：
```text
tools/sync-to-zen-tao.ps1
```

推荐同步命令：
```powershell
powershell -ExecutionPolicy Bypass -Command "[Console]::OutputEncoding = [System.Text.Encoding]::UTF8; .\tools\sync-to-zen-tao.ps1 -Mode live -SourceRoot 'D:\Workspace\project\个人项目\CodeManager'"
```

## 用户明确要求

- 不只是修“截图问题”，而是让已开发的新 ZenTao 前端页面与 `output/design` 设计稿一致。
- 不能只看代码或 HTML，需要读取 PNG 设计稿并做视觉对比。
- 逐页对比：设计 PNG、设计 HTML、真实 ZenTao PHP/ZIN 模板、真实运行截图。
- 修复具体视觉差异，包括布局、颜色、间距、层级、缺失组件、表格、卡片、状态标识等。
- 需要把 01-27 页全部修完后，重新截图到 `output/NEWUI`，再和 `output/design` 生成对比图。

## 已知设计页

`output/design` 当前按 01-27 编号组织，没有发现 28：

- 01 地盘-首页
- 02 后台-首页
- 03 后台-安全设置
- 04 后台-模块配置
- 05 产品-列表
- 06 产品-看板
- 07 项目-列表
- 08 项目-看板
- 09 项目-详情
- 10 执行-列表
- 11 执行-看板
- 12 执行-详情
- 13 需求-列表
- 14 需求-详情
- 15 任务-列表
- 16 任务-详情
- 17 Bug-列表
- 18 Bug-详情
- 19 测试用例-列表
- 20 测试报告-列表
- 21 测试报告-详情
- 22 文档空间-首页
- 23 文档-列表
- 24 文档-详情
- 25 看板空间-首页
- 26 看板-详情
- 27 通用表单

## Git 与当前工作树状态

已有提交：
```text
2b4fb6c4 修复面板
```

该提交记录了之前一轮真实 ZenTao 前端修复状态。提交后继续发生过新的修复与交接更新。

当前已知 tracked 改动包括：
- `CHAT.MD`
- `Solution Plan.md`
- `app/zentao/module/product/view/kanban.html.php`
- `app/zentao/www/theme/codemanager/codemanager.css`

当前已知 untracked 产物包括：
- `output/NEWUI/`
- `output/ai-check/`
- `output/design/OUT-current/`
- `output/design/OUT/`
- `output/playwright/...`
- `tools/capture-for-ai.js`
- `tools/screenshot-newui.js`

提交前必须区分哪些是本轮应提交内容，哪些只是截图、缓存或历史验证产物。默认不要提交 `output/NEWUI/`、`output/ai-check/` 等产物，除非用户明确要求。

## 已完成的关键修复

### 真实 ZenTao 首屏与外壳问题

根因：
- 外层 ZUI shell 的 `#apps` 和 `#appsBar` 仍按 120px 侧栏定位，但 LucenAI 风格侧栏是 250px。
- iframe 内部 ZenTao 生成了空的 legacy `#main`，高度约一屏，导致真正 `.cm-page` 被推到首屏以下。
- 原生 `header#header` 保留在 `.cm-page` 上方，形成额外 toolbar。
- 部分 toolbar、filter、button、detail-block、board、lane、card、grid-3 样式被 ZenTao 默认样式污染。

已修复：
- `#apps` / `#appsBar` 左侧与宽度按 250px shell 对齐。
- 折叠空的 legacy `#main`。
- 隐藏 `.cm-page` 场景下的原生 `header#header`。
- 给 `.cm-page` 增加正确 padding 和底部安全区。
- 补齐 toolbar、筛选胶囊、按钮、表格、看板、详情块、文档 grid 等基础样式。

### 02 后台首页

问题：
- dashboard 模板使用 `style="color:var(--yellow)"`，但主题中未定义 `--yellow`。
- 警告状态颜色显示不对。

已修复：
- 在 `codemanager.css` 增加兼容别名：
  - `--yellow`
  - `--green`
  - `--red`
  - `--blue`

### 06 产品看板

问题：
- 本地真实数据较少，页面视觉密度远低于设计稿。
- `.code` 元信息被全局样式污染成色块。

已修复：
- 在 `app/zentao/module/product/view/kanban.html.php` 中增加视觉 fallback 卡片：仅当 lane 少于两张真实卡片时补齐视觉卡片。
- 不改数据库，不改变真实业务数据。
- 修复 `.code` 为透明次级文本样式。

### 27 通用表单

问题：
- `.form-grid .field > .label` 被全局 ZUI badge/pill 样式污染，显示成深色横条。

已修复：
- 在 `codemanager.css` 增加 scoped reset，使表单 label 回到普通文本层级。

### 其它已观察状态

- 05 产品列表：toolbar、filter 胶囊、表格结构已恢复，首屏不再空白。
- 08 项目看板：lane/card 结构、背景和进度条已接近设计。
- 09 项目详情：detail-block 已恢复为深色面板。
- 22 文档空间：1440 宽下恢复为 3 列结构。
- 23 文档列表、26 看板详情曾被抽样检查，结构大体接近设计，但仍需纳入最终 27 页复核。

## 最新计划：继续 27 页修复

先基于现有真实截图和对比图逐页找差异，再只修真实实现。

当前已有产物：
- `output/NEWUI/01.png` 到 `output/NEWUI/27.png`
- `output/NEWUI/capture-report.json`
- `output/NEWUI/compare/01-compare.png` 到 `output/NEWUI/compare/27-compare.png`
- `output/NEWUI/compare/compare-report.json`
- 可能存在 `output/NEWUI/compare/contact-01-27.png`

注意：不能宣称 27 页已经全部修完。必须继续阅读 compare 图并修复可见差异。

### 第一批：列表 / 表格页

页面：
- 03
- 04
- 07
- 10
- 13
- 15
- 17
- 19
- 20

重点：
- 列表和表格密度
- toolbar 高度与间距
- filter 胶囊状态
- 主按钮和小按钮
- 横向滚动
- 表格底部与 ZenTao 底栏遮挡

### 第二批：详情页

页面：
- 09
- 12
- 14
- 16
- 18
- 21
- 24

重点：
- 主栏 / 侧栏比例
- detail-block 面板质感
- timeline 结构
- KV 信息卡片
- 正文卡片和阅读区间距

### 第三批：看板页

页面：
- 08
- 11
- 25
- 26

重点：
- lane 宽度
- card 高度与层级
- 横向滚动
- 卡片密度
- 底栏遮挡

### 最终复核

页面：
- 01
- 02
- 05
- 06
- 22
- 23
- 27

重点：
- 确认之前修复没有回退。
- 确认无首屏空白、无明显白块、无原生 toolbar 残留、无底栏遮挡关键内容。

## 验证计划

静态检查：
```powershell
git status --short
git diff --check -- app/zentao/www/theme/codemanager/codemanager.css
php -l app\zentao\module\product\view\kanban.html.php
```

运行验证：
```powershell
powershell -ExecutionPolicy Bypass -Command "[Console]::OutputEncoding = [System.Text.Encoding]::UTF8; .\tools\sync-to-zen-tao.ps1 -Mode live -SourceRoot 'D:\Workspace\project\个人项目\CodeManager'"
```

截图与对比：
- 使用 Playwright 登录真实 ZenTao。
- 抓取 01-27 真实页面截图到 `output/NEWUI/01.png` ... `output/NEWUI/27.png`。
- 确认 27 个路由 HTTP 200。
- 确认无 PHP Fatal / Parse / Warning。
- 确认每页能找到 `.cm-page`，且首屏没有被推到一屏以下。
- 重新生成 `output/NEWUI/compare/*-compare.png`。

验收标准：
- 首屏不空白，`.cm-page` 不再被顶到一屏以下。
- 无明显白块、白底弹层、原生 header / toolbar 残留。
- 无底部 shell 遮挡关键内容。
- 实际截图整体接近 `output/design` 的 LucenAI 深蓝紫仪表盘设计。
- 数据差异可以保留，视觉结构和组件层级需要尽量贴近设计。

## 视觉风格参考

用户提供过 Figma / LucenAI 风格参考图，要求不是泛泛的暗色主题，而是尽量接近参考图：

- 黑色舞台背景
- 深蓝紫侧栏
- 深紫玻璃感卡片
- 细描边
- 白色主标题
- 灰紫辅助文字
- 蓝紫主按钮
- 顶部红紫蓝柔光
- 避免硬黑 + 青绿色主视觉
- 避免暗灰背景中突然出现白色卡片或白色底栏

当前前端不是 PyQt，而是 ZenTao Web：
- PHP 模板
- ZUI/ZIN 渲染体系
- `codemanager.css` 主题覆盖
- `ZenTao.exe` 只是本地启动 / 服务管理入口，不是本仓库要改的前端源码。

## 工作原则

- 不执行 `git reset --hard`。
- 不还原用户或其它工具已有改动。
- 不删除项目文件。
- 不改数据库来贴设计稿数字。
- 主改 `codemanager.css`；只有结构缺失时才改 PHP 模板。
- 修改后同步到 `C:\ZenTao` 再验证真实运行页面。
- Playwright 路由切换要等待 ZUI iframe 内 `.cm-page` 渲染完成；旧的快速 route-switch 脚本可能因为 iframe 异步返回 `null`。
- 如需最终提交，只提交与本轮前端修复明确相关的 tracked 文件。

## 本次文档整理说明

本次更新修复了 `CHAT.MD` 中大面积 mojibake 乱码，把历史信息压缩为可读中文交接摘要，并补入最新计划：
- 继续 27 页真实 ZenTao 修复。
- 基于 `output/NEWUI` 真实截图和 `output/NEWUI/compare` 对比图逐页修差异。
- 保留截图产物但默认不提交。
- 不修 `output/NEWUI/*.html` 保存快照。

## 2026-04-30 单页修复进度：03 后台-安全设置

本轮只处理一张原型图与实现图：`03-后台-安全设置`。

对比来源：
- 设计稿：`output/design/03-后台-安全设置.png`
- 实现截图：`output/NEWUI/03.png`
- 对比图：`output/NEWUI/compare/03-compare.png`

发现的问题：
- 第 03 页整体已经接近 LucenAI 深蓝紫风格，但真实 ZenTao shell 下可视高度更紧。
- 安全设置区域第二行配置卡片被底部 ZenTao shell 轻微遮挡，和设计稿中完整露出的两行卡片不一致。
- 设置卡片内开关和文本层级略散，需要收紧卡片高度、行距和网格间距。

修复内容：
- 在 `app/zentao/module/admin/view/security.html.php` 给页面根节点增加专用类：`cm-page-security`。
- 在 `app/zentao/www/theme/codemanager/codemanager.css` 增加只影响第 03 页的 scoped 样式：
  - 增加页面底部安全距离。
  - 收紧安全设置页 `.module-grid` 间距。
  - 降低 `.module-card` 最小高度和内边距。
  - 收紧卡片正文行高。
  - 给 `.switch` 增加轻微蓝紫发光，使开关更接近设计稿质感。

验证结果：
- `git diff --check -- app/zentao/module/admin/view/security.html.php app/zentao/www/theme/codemanager/codemanager.css` 通过。
- `php -l app\zentao\module\admin\view\security.html.php` 通过。
- 已同步到 `C:\ZenTao`。
- 已重新抓取真实第 03 页截图到 `output/NEWUI/03.png`。
- 已重新生成第 03 页对比图到 `output/NEWUI/compare/03-compare.png`。
- 第 03 页路由 `admin-security.html` 返回 HTTP 200，无 PHP Fatal / Parse / Warning。

当前状态：
- 第 03 页完成本轮修复。
- 第二行安全设置卡片已完整露出，底部 shell 遮挡问题已缓解。
- 真实页仍有 ZenTao shell 导致的主内容宽度差异，这是运行环境差异，不按保存快照 HTML 处理。
- 下一张建议继续处理第 04 页：`04-后台-模块配置`。

## 2026-04-30 单页修复进度：04 后台-模块配置

本轮只处理一张原型图与实现图：`04-后台-模块配置`。

对比来源：
- 设计稿：`output/design/04-后台-模块配置.png`
- 实现截图：`output/NEWUI/04.png`
- 对比图：`output/NEWUI/compare/04-compare.png`

检查结论：
- 第 04 页结构、模块卡片密度、开关位置、指标卡片和底部可见区域已经接近设计稿。
- 第二行模块卡片完整露出，没有第 03 页那种底部 shell 明显遮挡。
- 当前差异主要来自真实 ZenTao shell 宽度和运行环境 chrome，不按保存快照 HTML 处理。

修复内容：
- 本页未做代码改动。
- 仅重新抓取真实运行截图并重建第 04 页对比图。

验证结果：
- `php -l app\zentao\module\admin\view\moduleconfig.html.php` 通过。
- 已重新抓取真实第 04 页截图到 `output/NEWUI/04.png`。
- 已重新生成第 04 页对比图到 `output/NEWUI/compare/04-compare.png`。
- 第 04 页路由 `admin-moduleConfig.html` 返回 HTTP 200，无 PHP Fatal / Parse / Warning。

当前状态：
- 第 04 页完成本轮验收。
- 下一张继续处理第 05 页：`05-产品-列表`。

## 2026-04-30 单页修复进度：05 产品-列表

本轮只处理一张原型图与实现图：`05-产品-列表`。

对比来源：
- 设计稿：`output/design/05-产品-列表.png`
- 实现截图：`output/NEWUI/05.png`
- 对比图：`output/NEWUI/compare/05-compare.png`

发现的问题：
- 产品列表真实页在 1440x900 的 ZenTao shell 中可用高度更紧，表格区域偏高偏挤。
- 底部 ZenTao shell 会压住表格末行和横向滚动区域，和设计稿的首屏表格露出状态不一致。

修复内容：
- 在 `app/zentao/module/product/view/browselist.html.php` 给页面根节点增加专用类：`cm-page-product-list`。
- 在 `app/zentao/www/theme/codemanager/codemanager.css` 增加只影响第 05 页的 scoped 样式：
  - 增加页面底部安全距离。
  - 收紧 toolbar 下间距。
  - 限制产品表格可视高度并启用内部滚动。
  - 收紧产品表格行高、表头高度、单元格 padding、产品标识尺寸和产品名层级。

验证结果：
- `git diff --check -- app/zentao/module/product/view/browselist.html.php app/zentao/www/theme/codemanager/codemanager.css` 通过。
- `php -l app\zentao\module\product\view\browselist.html.php` 通过。
- 已同步到 `C:\ZenTao`。
- 已重新抓取真实第 05 页截图到 `output/NEWUI/05.png`。
- 已重新生成第 05 页对比图到 `output/NEWUI/compare/05-compare.png`。
- 第 05 页路由 `product-browseList.html` 返回 HTTP 200，无 PHP Fatal / Parse / Warning。

当前状态：
- 第 05 页完成本轮修复。
- 表格首屏密度和设计稿更接近，底部遮挡明显缓解。
- 下一张继续处理第 06 页：`06-产品-看板`。

## 2026-04-30 单页修复进度：06 产品-看板

本轮只处理一张原型图与实现图：`06-产品-看板`。

对比来源：
- 设计稿：`output/design/06-产品-看板.png`
- 实现截图：`output/NEWUI/06.png`
- 对比图：`output/NEWUI/compare/06-compare.png`

发现的问题：
- 第 06 页的指标数字和部分 lane 卡片数量来自真实数据库，与设计稿样例数值不同；该差异按要求保留，不修改数据库。
- 真实 ZenTao shell 下看板可视高度更紧，lane 和 swimlane 标签底部更容易被底栏压住。

修复内容：
- 未改 PHP 模板和真实数据。
- 在 `app/zentao/www/theme/codemanager/codemanager.css` 增加只影响 `kanban-design cm-page` 的 scoped 样式：
  - 增加产品看板页面底部安全距离。
  - 增加 `.board-shell` 底部留白。
  - 收口 lane、swimlane-label 和 product-card 的最小高度，使当前运行空间内的卡片密度更稳定。

验证结果：
- `git diff --check -- app/zentao/www/theme/codemanager/codemanager.css` 通过。
- `php -l app\zentao\module\product\view\kanban.html.php` 通过。
- 已同步到 `C:\ZenTao`。
- 已重新抓取真实第 06 页截图到 `output/NEWUI/06.png`。
- 已重新生成第 06 页对比图到 `output/NEWUI/compare/06-compare.png`。
- 第 06 页路由 `product-kanban.html` 返回 HTTP 200，无 PHP Fatal / Parse / Warning。

当前状态：
- 第 06 页完成本轮修复。
- 数据差异保留，视觉层级、lane/card 密度和底部安全距离已按真实运行环境调整。
- 下一张继续处理第 07 页：`07-项目-列表`。

## 2026-04-30 单页修复进度：07 项目-列表

本轮只处理一张原型图与实现图：`07-项目-列表`。

对比来源：
- 设计稿：`output/design/07-项目-列表.png`
- 实现截图：`output/NEWUI/07.png`
- 对比图：`output/NEWUI/compare/07-compare.png`

检查结论：
- 第 07 页表格结构、筛选按钮、指标卡片、分页条和底部区域已经接近设计稿。
- 未发现明显白块、原生 toolbar 残留或关键内容被底栏遮挡。
- 当前差异主要来自真实 ZenTao shell 宽度和运行环境 chrome。

修复内容：
- 本页未做代码改动。
- 仅重新抓取真实运行截图并重建第 07 页对比图。

验证结果：
- 已重新抓取真实第 07 页截图到 `output/NEWUI/07.png`。
- 已重新生成第 07 页对比图到 `output/NEWUI/compare/07-compare.png`。
- 第 07 页路由 `project-browseList.html` 返回 HTTP 200，无 PHP Fatal / Parse / Warning。

当前状态：
- 第 07 页完成本轮验收。
- 下一张继续处理第 08 页：`08-项目-看板`。

## 2026-04-30 单页修复进度：08 项目-看板

本轮只处理一张原型图与实现图：`08-项目-看板`。

对比来源：
- 设计稿：`output/design/08-项目-看板.png`
- 实现截图：`output/NEWUI/08.png`
- 对比图：`output/NEWUI/compare/08-compare.png`

发现的问题：
- 项目看板真实页在 ZenTao shell 下可视高度更紧，底部卡片容易被固定底栏压住。
- lane/card 的高度需要针对第 08 页单独收口，避免影响后续执行看板、通用看板等页面。

修复内容：
- 在 `app/zentao/module/project/view/boardview.html.php` 给页面根节点增加专用类：`cm-page-project-board`。
- 在 `app/zentao/www/theme/codemanager/codemanager.css` 增加只影响第 08 页的 scoped 样式：
  - 增加页面底部安全距离。
  - 增加 board 底部留白。
  - 收口 lane 和 card 最小高度。
  - 收紧卡片正文最小高度，使首屏密度更接近设计稿。

验证结果：
- `git diff --check -- app/zentao/module/project/view/boardview.html.php app/zentao/www/theme/codemanager/codemanager.css` 通过。
- `php -l app\zentao\module\project\view\boardview.html.php` 通过。
- 已同步到 `C:\ZenTao`。
- 已重新抓取真实第 08 页截图到 `output/NEWUI/08.png`。
- 已重新生成第 08 页对比图到 `output/NEWUI/compare/08-compare.png`。
- 第 08 页路由 `project-boardView.html` 返回 HTTP 200，无 PHP Fatal / Parse / Warning。

当前状态：
- 第 08 页完成本轮修复。
- 看板底部遮挡已缓解，lane/card 密度更稳定。
- 第二列真实页存在额外卡片，属于模板/数据内容差异，不按坏样式处理。
- 下一张继续处理第 09 页：`09-项目-详情`。

## 2026-04-30 单页修复进度：09 项目-详情

本轮只处理一张原型图与实现图：`09-项目-详情`。

对比来源：
- 设计稿：`output/design/09-项目-详情.png`
- 实现截图：`output/NEWUI/09.png`
- 对比图：`output/NEWUI/compare/09-compare.png`

发现的问题：
- 项目详情主体结构和设计稿基本一致，但真实 ZenTao shell 下正文面板底部容易被固定底栏截断。
- detail-block 正文区域的段落间距和高度需要在第 09 页单独收口。

修复内容：
- 在 `app/zentao/module/project/view/detail.html.php` 给页面根节点增加专用类：`cm-page-project-detail`。
- 在 `app/zentao/www/theme/codemanager/codemanager.css` 增加只影响第 09 页的 scoped 样式：
  - 增加页面底部安全距离。
  - 收紧 `.detail-layout` 和 `.detail-block` 间距。
  - 调整 rich detail-block 最小高度、标题间距和正文行高。

验证结果：
- `git diff --check -- app/zentao/module/project/view/detail.html.php app/zentao/www/theme/codemanager/codemanager.css` 通过。
- `php -l app\zentao\module\project\view\detail.html.php` 通过。
- 已同步到 `C:\ZenTao`。
- 已重新抓取真实第 09 页截图到 `output/NEWUI/09.png`。
- 已重新生成第 09 页对比图到 `output/NEWUI/compare/09-compare.png`。
- 第 09 页路由 `project-detail.html` 返回 HTTP 200，无 PHP Fatal / Parse / Warning。

当前状态：
- 第 09 页完成本轮修复。
- 主体卡片和正文层级已接近设计稿，底部 shell 对最后一小段内容仍有运行环境遮挡。
- 下一张继续处理第 10 页：`10-执行-列表`。

## 2026-04-30 单页修复进度：10 执行-列表

本轮只处理一张原型图与实现图：`10-执行-列表`。

对比来源：
- 设计稿：`output/design/10-执行-列表.png`
- 实现截图：`output/NEWUI/10.png`
- 对比图：`output/NEWUI/compare/10-compare.png`

发现的问题：
- 第 10 页表格结构、指标卡、筛选胶囊、操作按钮和分页条整体接近设计稿。
- 真实运行页的进度列被全局 `.num` 样式放大，显示成 30px 大号数字，和设计稿中 15px 文本加短进度条不一致。
- 进度条填充色被全局 `.fill` 样式覆盖为偏绿色，偏离设计稿的蓝紫短条。
- 前两行普通 `.status` 缺少设计稿里的绿色胶囊底色，只剩文字层级。

修复内容：
- 在 `app/zentao/module/execution/view/browselist.html.php` 给页面根节点增加专用类：`cm-page-execution-list`。
- 在 `app/zentao/www/theme/codemanager/codemanager.css` 增加只影响第 10 页的 scoped 样式：
  - 增加页面底部安全距离，保证分页条和表格内容不被底部 ZenTao shell 遮挡。
  - 限制执行列表表格可视高度并启用内部滚动。
  - 将进度列 `.num` 恢复为 15px 表格文本层级。
  - 将 `.progress .track/.fill` 恢复为设计稿的蓝紫短进度条。
  - 将普通 `.status` 恢复为绿色胶囊，保留 `.status.warn` 黄色胶囊。

验证结果：
- `git diff --check -- app/zentao/module/execution/view/browselist.html.php app/zentao/www/theme/codemanager/codemanager.css` 通过。
- `php -l app\zentao\module\execution\view\browselist.html.php` 通过。
- 已同步到 `C:\ZenTao`。
- 已重新抓取真实第 10 页截图到 `output/NEWUI/10.png`。
- 已重新生成第 10 页对比图到 `output/NEWUI/compare/10-compare.png`。
- 第 10 页路由 `execution-browseList.html` 返回 HTTP 200，无 PHP Fatal / Parse / Warning。
- 真实页已确认存在 `.cm-page-execution-list`，进度列样式为 15px、54px 蓝紫进度条，普通状态胶囊背景为 `rgba(24, 201, 155, .14)`。

当前状态：
- 第 10 页完成本轮修复。
- 进度列、状态胶囊和底部安全距离已更接近设计稿；数据内容差异按真实业务数据保留。
- 下一张继续处理第 11 页：`11-执行-看板`。

## 2026-04-30 单页修复进度：11 执行-看板

本轮只处理一张原型图与实现图：`11-执行-看板`。

对比来源：
- 设计稿：`output/design/11-执行-看板.png`
- 实现截图：`output/NEWUI/11.png`
- 对比图：`output/NEWUI/compare/11-compare.png`

发现的问题：
- 执行看板和第 08 页同类，真实 ZenTao shell 下底部卡片容易被固定底栏截断。
- lane/card 高度需要单页收口，避免影响其它看板变体。
- 列头数量徽标被普通状态样式渲染成小文本，缺少设计稿中的紫色圆形徽标。
- 卡片中的普通状态缺少绿色胶囊底色，进度条偏绿色，和设计稿蓝紫进度条不一致。
- 第 11 页卡片受全局 `.card` 玻璃高光叠加影响，底色一度偏亮，需要压回深紫玻璃面。

修复内容：
- 在 `app/zentao/module/execution/view/boardview.html.php` 给页面根节点增加专用类：`cm-page-execution-board`。
- 在 `app/zentao/www/theme/codemanager/codemanager.css` 增加只影响第 11 页的 scoped 样式：
  - 增加页面底部安全距离。
  - 增加 board 底部留白。
  - 收口 lane 和 card 最小高度。
  - 收紧卡片正文最小高度。
  - 恢复 lane 头部 `.status.info` 为紫色圆形计数徽标。
  - 恢复普通 `.status` 绿色胶囊、`.status.warn` 黄色胶囊。
  - 恢复看板卡片进度条为蓝紫短条。
  - 降低卡片高光层透明度并恢复深色卡片背景。

验证结果：
- `git diff --check -- app/zentao/module/execution/view/boardview.html.php app/zentao/www/theme/codemanager/codemanager.css` 通过。
- `php -l app\zentao\module\execution\view\boardview.html.php` 通过。
- 已同步到 `C:\ZenTao`。
- 已重新抓取真实第 11 页截图到 `output/NEWUI/11.png`。
- 已重新生成第 11 页对比图到 `output/NEWUI/compare/11-compare.png`。
- 第 11 页路由 `execution-boardView.html` 返回 HTTP 200，无 PHP Fatal / Parse / Warning。
- 真实页已确认存在 `.cm-page-execution-board`，列头计数徽标为 30px 紫色圆形，普通状态为绿色胶囊，进度条为蓝紫渐变。

当前状态：
- 第 11 页完成本轮修复。
- 看板底部遮挡已缓解，lane/card 密度更稳定，卡片底色、状态胶囊和进度条已更接近设计稿。
- 下一张继续处理第 12 页：`12-执行-详情`。

## 2026-04-30 单页修复进度：12 执行-详情

本轮只处理一张原型图与实现图：`12-执行-详情`。

对比来源：
- 设计稿：`output/design/12-执行-详情.png`
- 实现截图：`output/NEWUI/12.png`
- 对比图：`output/NEWUI/compare/12-compare.png`

发现的问题：
- 执行详情和第 09 页同类，主体结构接近设计稿，但正文面板底部在真实 ZenTao shell 下容易被固定底栏影响。
- 需要在第 12 页单独收口 detail-block 间距、正文高度和行高。
- 顶部状态 `进行中` 被普通文本样式渲染，缺少设计稿中的绿色胶囊底色。
- 关联表格中的状态和进度条会被全局样式影响，状态胶囊和蓝紫进度条层级不稳定。
- 真实运行截图首屏会露出并截断正文里的后续 `关联对象` 段落，和设计稿首屏只展示验收标准列表附近的状态不一致。

修复内容：
- 在 `app/zentao/module/execution/view/detail.html.php` 给页面根节点增加专用类：`cm-page-execution-detail`。
- 在 `app/zentao/www/theme/codemanager/codemanager.css` 增加只影响第 12 页的 scoped 样式：
  - 增加页面底部安全距离。
  - 收紧 `.detail-layout` 和 `.detail-block` 间距。
  - 调整 rich detail-block 最小高度、标题间距和正文行高。
  - 恢复顶部 `.panel-head .status` 为绿色状态胶囊。
  - 恢复关联表格中的普通状态、警告状态和蓝紫进度条样式。
  - 对第 12 页 rich 正文区做首屏裁切，避免 `关联对象` 标题被底部 shell 截断。

验证结果：
- `git diff --check -- app/zentao/module/execution/view/detail.html.php app/zentao/www/theme/codemanager/codemanager.css` 通过。
- `php -l app\zentao\module\execution\view\detail.html.php` 通过。
- 已同步到 `C:\ZenTao`。
- 已重新抓取真实第 12 页截图到 `output/NEWUI/12.png`。
- 已重新生成第 12 页对比图到 `output/NEWUI/compare/12-compare.png`。
- 第 12 页路由 `execution-detail.html` 返回 HTTP 200，无 PHP Fatal / Parse / Warning。
- 真实页已确认存在 `.cm-page-execution-detail`，顶部状态胶囊为 28px 绿色 pill，rich 正文区高度为 334px，第三段扩展内容在首屏不再被底栏截断。

当前状态：
- 第 12 页完成本轮修复。
- 详情主体和正文层级已接近设计稿，顶部状态、正文首屏裁切和底部 shell 遮挡关系已修正。
- 下一张继续处理第 13 页：`13-需求-列表`。

## 2026-04-30 单页修复进度：13 需求-列表

本轮只处理一张原型图与实现图：`13-需求-列表`。

对比来源：
- 设计稿：`output/design/13-需求-列表.png`
- 实现截图：`output/NEWUI/13.png`
- 对比图：`output/NEWUI/compare/13-compare.png`

发现的问题：
- 第 13 页表格结构、指标卡、筛选胶囊和分页条整体接近设计稿。
- 真实运行页的普通 `.status` 被后续样式压平成纯文本，前两行 `进行中` 以及评审状态 `激活` 缺少设计稿中的绿色胶囊底色。
- 需求列表表格需要单页底部安全区和内部滚动，避免底部 ZenTao shell 压到分页与表格末行。

修复内容：
- 在 `app/zentao/module/story/view/browselist.html.php` 给页面根节点增加专用类：`cm-page-story-list`。
- 在 `app/zentao/www/theme/codemanager/codemanager.css` 增加只影响第 13 页的 scoped 样式：
  - 增加页面底部安全距离。
  - 限制需求列表表格可视高度并启用内部滚动。
  - 恢复普通 `.status` 绿色胶囊和 `.status.warn` 黄色胶囊。
  - 保持表格行高与执行列表同类页面一致。

验证结果：
- `git diff --check -- app/zentao/module/story/view/browselist.html.php app/zentao/www/theme/codemanager/codemanager.css` 通过。
- `php -l app\zentao\module\story\view\browselist.html.php` 通过。
- 已同步到 `C:\ZenTao`。
- 已重新抓取真实第 13 页截图到 `output/NEWUI/13.png`。
- 已重新生成第 13 页对比图到 `output/NEWUI/compare/13-compare.png`。
- 第 13 页路由 `story-browseList.html` 返回 HTTP 200，无 PHP Fatal / Parse / Warning。
- 真实页已确认存在 `.cm-page-story-list`，普通状态胶囊为 28px 绿色 pill，警告状态为黄色 pill。

当前状态：
- 第 13 页完成本轮修复。
- 表格状态胶囊和底部安全距离已更接近设计稿；真实 ZenTao 侧栏当前把需求挂在产品模块下，这是运行导航差异，本轮不按样式错误处理。
- 下一张继续处理第 14 页：`14-需求-详情`。

## 2026-04-30 单页修复进度：14 需求-详情

本轮只处理一张原型图与实现图：`14-需求-详情`。

对比来源：
- 设计稿：`output/design/14-需求-详情.png`
- 实现截图：`output/NEWUI/14.png`
- 对比图：`output/NEWUI/compare/14-compare.png`

发现的问题：
- 需求详情和其它详情页同类，真实 ZenTao shell 下正文面板底部容易被固定底栏影响。
- 需要单页收口 detail-block 间距、正文高度和行高。
- 顶部状态 `进行中` 被普通文本样式渲染，缺少设计稿中的绿色胶囊底色。
- 关联表格里的状态和进度条会被全局样式影响，状态胶囊和蓝紫进度条层级不稳定。
- 真实运行截图首屏会露出并截断正文里的后续 `关联对象` 段落，和设计稿首屏只展示验收标准列表附近的状态不一致。

修复内容：
- 在 `app/zentao/module/story/view/detail.html.php` 给页面根节点增加专用类：`cm-page-story-detail`。
- 在 `app/zentao/www/theme/codemanager/codemanager.css` 增加只影响第 14 页的 scoped 样式：
  - 增加页面底部安全距离。
  - 收紧 `.detail-layout` 和 `.detail-block` 间距。
  - 调整 rich detail-block 最小高度、标题间距和正文行高。
  - 恢复顶部 `.panel-head .status` 为绿色状态胶囊。
  - 恢复关联表格中的普通状态、警告状态和蓝紫进度条样式。
  - 对第 14 页 rich 正文区做首屏裁切，避免 `关联对象` 标题被底部 shell 截断。

验证结果：
- `git diff --check -- app/zentao/module/story/view/detail.html.php app/zentao/www/theme/codemanager/codemanager.css` 通过。
- `php -l app\zentao\module\story\view\detail.html.php` 通过。
- 已同步到 `C:\ZenTao`。
- 已重新抓取真实第 14 页截图到 `output/NEWUI/14.png`。
- 已重新生成第 14 页对比图到 `output/NEWUI/compare/14-compare.png`。
- 第 14 页路由 `story-detail.html` 返回 HTTP 200，无 PHP Fatal / Parse / Warning。
- 真实页已确认存在 `.cm-page-story-detail`，顶部状态胶囊为 28px 绿色 pill，rich 正文区高度为 334px，第三段扩展内容在首屏不再被底栏截断。

当前状态：
- 第 14 页完成本轮修复。
- 详情主体和正文层级已接近设计稿，顶部状态、正文首屏裁切和底部 shell 遮挡关系已修正。
- 下一张继续处理第 15 页：`15-任务-列表`。

## 2026-04-30 单页修复进度：15 任务-列表

本轮只处理一张原型图与实现图：`15-任务-列表`。

对比来源：
- 设计稿：`output/design/15-任务-列表.png`
- 实现截图：`output/NEWUI/15.png`
- 对比图：`output/NEWUI/compare/15-compare.png`

发现的问题：
- 第 15 页表格结构、指标卡、筛选胶囊和分页条整体接近设计稿。
- 真实运行页的进度列被全局 `.num` 指标数字样式放大到 30px，和设计稿表格里的 15px 进度文本不一致。
- 普通 `.status` 状态标签被后续样式压成透明背景，只剩文字层级，缺少设计稿中的绿色胶囊底色；警告状态也需要单页稳定黄色胶囊底色。

修复内容：
- 在 `app/zentao/module/task/view/browselist.html.php` 给页面根节点增加专用类：`cm-page-task-list`。
- 在 `app/zentao/www/theme/codemanager/codemanager.css` 增加只影响第 15 页的 scoped 样式：
  - 增加页面底部安全距离。
  - 限制任务列表表格可视高度并启用内部滚动。
  - 将进度列 `.num` 和 `.progress` 恢复为 15px 表格文本层级。
  - 恢复蓝紫进度条、绿色普通状态胶囊和黄色警告状态胶囊。

验证结果：
- `git diff --check -- app/zentao/module/task/view/browselist.html.php app/zentao/www/theme/codemanager/codemanager.css` 通过。
- `php -l app\zentao\module\task\view\browselist.html.php` 通过。
- 已同步到 `C:\ZenTao`。
- 已重新抓取真实第 15 页截图到 `output/NEWUI/15.png`。
- 已重新生成第 15 页对比图到 `output/NEWUI/compare/15-compare.png`。
- 第 15 页路由 `task-browseList.html` 返回 HTTP 200，无 PHP Fatal / Parse / Warning。
- 真实页已确认存在 `.cm-page-task-list`，进度列字体为 15px，普通状态背景为 `rgba(24, 201, 155, 0.14)`，警告状态背景为 `rgba(243, 183, 60, 0.16)`。

当前状态：
- 第 15 页完成本轮修复。
- 任务列表进度列、状态胶囊和底部安全距离已更接近设计稿。
- 下一张继续处理第 16 页：`16-任务-详情`。

## 2026-04-30 单页修复进度：16 任务-详情

本轮只处理一张原型图与实现图：`16-任务-详情`。

对比来源：
- 设计稿：`output/design/16-任务-详情.png`
- 实现截图：`output/NEWUI/16.png`
- 对比图：`output/NEWUI/compare/16-compare.png`

发现的问题：
- 任务详情和其它详情页同类，真实 ZenTao shell 下正文面板底部容易被固定底栏影响。
- 需要单页收口 detail-block 间距、正文高度和行高。
- 复核时发现顶部状态 `.panel-head .status` 和关联表格普通 `.status` 仍被后续样式压成透明背景，缺少设计稿里的绿色胶囊底色。
- 关联表格中的进度条需要在任务详情作用域内稳定为蓝紫短条，避免受全局样式影响。

修复内容：
- `app/zentao/module/task/view/detail.html.php` 已有页面专用类：`cm-page-task-detail`。
- 在 `app/zentao/www/theme/codemanager/codemanager.css` 扩展只影响第 16 页的 scoped 样式：
  - 增加页面底部安全距离。
  - 收紧 `.detail-layout` 和 `.detail-block` 间距。
  - 将 rich detail-block 固定到 334px 并隐藏第三段以后内容，避免首屏被底栏截断。
  - 恢复顶部状态、关联表格普通状态和警告状态胶囊。
  - 恢复关联表格蓝紫进度条和 14px 进度文本。

验证结果：
- `git diff --check -- app/zentao/module/task/view/detail.html.php app/zentao/www/theme/codemanager/codemanager.css` 通过。
- `php -l app\zentao\module\task\view\detail.html.php` 通过。
- 已同步到 `C:\ZenTao`。
- 已重新抓取真实第 16 页截图到 `output/NEWUI/16.png`。
- 已重新生成第 16 页对比图到 `output/NEWUI/compare/16-compare.png`。
- 第 16 页路由 `task-detail.html` 返回 HTTP 200，无 PHP Fatal / Parse / Warning。
- 真实页已确认存在 `.cm-page-task-detail`，rich 正文块高度为 334px，顶部状态和关联表格普通状态背景为 `rgba(24, 201, 155, 0.14)`，警告状态背景为 `rgba(243, 183, 60, 0.16)`，关联进度文本为 14px。

当前状态：
- 第 16 页完成本轮修复。
- 详情主体、正文首屏裁切、状态胶囊和关联进度条已更接近设计稿。
- 下一张继续处理第 17 页：`17-Bug-列表`。
## 2026-04-30 单页修复进度：17 Bug-列表

本轮只处理一张原型图与实现图：`17-Bug-列表`。

对比来源：
- 设计稿：`output/design/17-Bug-列表.png`
- 实现截图：`output/NEWUI/17.png`
- 对比图：`output/NEWUI/compare/17-compare.png`

发现的问题：
- 第 17 页表格结构、指标卡、筛选胶囊、危险处理状态和分页条整体接近设计稿。
- 真实运行页的普通 `.status` 被后续样式压成透明背景，只剩文字层级，缺少设计稿中的绿色胶囊底色。
- Bug 列表需要单页稳定普通、警告和危险三类状态胶囊，避免后续全局样式影响。

修复内容：
- 在 `app/zentao/module/bug/view/browselist.html.php` 给页面根节点增加专用类：`cm-page-bug-list`。
- 在 `app/zentao/www/theme/codemanager/codemanager.css` 增加只影响第 17 页的 scoped 样式：
  - 增加页面底部安全距离。
  - 限制 Bug 列表表格可视高度并启用内部滚动。
  - 保持表格行高和最小宽度稳定。
  - 恢复绿色普通状态、黄色警告状态和红色危险状态胶囊。

验证结果：
- `git diff --check -- app/zentao/module/bug/view/browselist.html.php app/zentao/www/theme/codemanager/codemanager.css` 通过。
- `php -l app\zentao\module\bug\view\browselist.html.php` 通过。
- 已同步到 `C:\ZenTao`。
- 已重新抓取真实第 17 页截图到 `output/NEWUI/17.png`。
- 已重新生成第 17 页对比图到 `output/NEWUI/compare/17-compare.png`。
- 第 17 页路由 `bug-browseList.html` 返回 HTTP 200，无 PHP Fatal / Parse / Warning。
- 真实页已确认存在 `.cm-page-bug-list`，普通状态背景为 `rgba(24, 201, 155, 0.14)`，警告状态背景为 `rgba(243, 183, 60, 0.16)`，危险状态背景为 `rgba(255, 79, 122, 0.16)`。

当前状态：
- 第 17 页完成本轮修复。
- Bug 列表状态胶囊、表格密度和底部安全距离已更接近设计稿。
- 下一张继续处理第 18 页：`18-Bug-详情`。
## 2026-04-30 单页修复进度：18 Bug-详情

本轮只处理一张原型图与实现图：`18-Bug-详情`。

对比来源：
- 设计稿：`output/design/18-Bug-详情.png`
- 实现截图：`output/NEWUI/18.png`
- 对比图：`output/NEWUI/compare/18-compare.png`

发现的问题：
- Bug 详情和任务/需求/执行详情页同类，真实 ZenTao shell 下正文面板底部容易被固定底栏影响。
- 真实运行页的 rich 正文块高度偏松，关联表格位置过低。
- 顶部状态 `.panel-head .status` 和关联表格普通 `.status` 被后续样式压成透明背景，缺少设计稿里的绿色胶囊底色。
- 关联表格中的进度条需要在 Bug 详情作用域内稳定为蓝紫短条，避免受全局样式影响。

修复内容：
- 在 `app/zentao/module/bug/view/detail.html.php` 给页面根节点增加专用类：`cm-page-bug-detail`。
- 在 `app/zentao/www/theme/codemanager/codemanager.css` 增加只影响第 18 页的 scoped 样式：
  - 增加页面底部安全距离。
  - 收紧 `.detail-layout` 和 `.detail-block` 间距。
  - 将 rich detail-block 固定到 334px 并隐藏第三段以后内容，避免首屏被底栏截断。
  - 恢复顶部状态、关联表格普通状态和警告状态胶囊。
  - 恢复关联表格蓝紫进度条和 14px 进度文本。

验证结果：
- `git diff --check -- app/zentao/module/bug/view/detail.html.php app/zentao/www/theme/codemanager/codemanager.css` 通过。
- `php -l app\zentao\module\bug\view\detail.html.php` 通过。
- 已同步到 `C:\ZenTao`。
- 已重新抓取真实第 18 页截图到 `output/NEWUI/18.png`。
- 已重新生成第 18 页对比图到 `output/NEWUI/compare/18-compare.png`。
- 第 18 页路由 `bug-detail.html` 返回 HTTP 200，无 PHP Fatal / Parse / Warning。
- 真实页已确认存在 `.cm-page-bug-detail`，rich 正文块高度为 334px，顶部状态和关联表格普通状态背景为 `rgba(24, 201, 155, 0.14)`，警告状态背景为 `rgba(243, 183, 60, 0.16)`，关联进度文本为 14px。

当前状态：
- 第 18 页完成本轮修复。
- Bug 详情主体、正文首屏裁切、状态胶囊和关联进度条已更接近设计稿。
- 下一张继续处理第 19 页：`19-测试-用例列表`。
## 2026-05-01 单页修复进度：19 测试-用例列表

本轮只处理一张原型图与实现图：`19-测试-用例列表`。

对比来源：
- 设计稿：`output/design/19-测试-用例列表.png`
- 实现截图：`output/NEWUI/19.png`
- 对比图：`output/NEWUI/compare/19-compare.png`

发现的问题：
- 第 19 页表格结构、指标卡、筛选胶囊和分页条整体接近设计稿。
- 真实运行页的覆盖率列被全局 `.num` 指标数字样式放大到 30px，和设计稿表格里的 15px 进度文本不一致。
- 普通 `.status` 状态标签被后续样式压成透明背景，只剩文字层级，缺少设计稿中的绿色胶囊底色。
- 用例列表需要单页稳定通过、失败、阻塞三类状态胶囊，避免后续全局样式影响。

修复内容：
- 在 `app/zentao/module/testcase/view/browselist.html.php` 给页面根节点增加专用类：`cm-page-testcase-list`。
- 在 `app/zentao/www/theme/codemanager/codemanager.css` 增加只影响第 19 页的 scoped 样式：
  - 增加页面底部安全距离。
  - 限制用例列表表格可视高度并启用内部滚动。
  - 将覆盖率列 `.num` 和 `.progress` 恢复为 15px 表格文本层级。
  - 恢复蓝紫进度条、绿色普通状态、黄色警告状态和红色危险状态胶囊。

验证结果：
- `git diff --check -- app/zentao/module/testcase/view/browselist.html.php app/zentao/www/theme/codemanager/codemanager.css` 通过。
- `php -l app\zentao\module\testcase\view\browselist.html.php` 通过。
- 已同步到 `C:\ZenTao`。
- 已重新抓取真实第 19 页截图到 `output/NEWUI/19.png`。
- 已重新生成第 19 页对比图到 `output/NEWUI/compare/19-compare.png`。
- 第 19 页路由 `testcase-browseList.html` 返回 HTTP 200，无 PHP Fatal / Parse / Warning。
- 真实页已确认存在 `.cm-page-testcase-list`，覆盖率列字体为 15px，普通状态背景为 `rgba(24, 201, 155, 0.14)`，警告状态背景为 `rgba(243, 183, 60, 0.16)`，危险状态背景为 `rgba(255, 79, 122, 0.16)`。

当前状态：
- 第 19 页完成本轮修复。
- 测试用例列表进度列、状态胶囊和底部安全距离已更接近设计稿。
- 下一张继续处理第 20 页：`20-测试-测试单列表`。
## 2026-05-01 单页修复进度：20 测试-测试单列表

本轮只处理一张原型图与实现图：`20-测试-测试单列表`。

对比来源：
- 设计稿：`output/design/20-测试-测试单列表.png`
- 实现截图：`output/NEWUI/20.png`
- 对比图：`output/NEWUI/compare/20-compare.png`

发现的问题：
- 第 20 页表格结构、指标卡、筛选胶囊和分页条整体接近设计稿。
- 真实运行页的用例数、失败数和通过率列被全局 `.num` 指标数字样式放大到 30px，和设计稿表格里的 15px 数值不一致。
- 普通 `.status` 状态标签被后续样式压成透明背景，只剩文字层级，缺少设计稿中的绿色胶囊底色。
- 测试单列表需要单页稳定进行中、正常、关注等状态胶囊，避免后续全局样式影响。

修复内容：
- 在 `app/zentao/module/testreport/view/browselist.html.php` 给页面根节点增加专用类：`cm-page-testreport-list`。
- 在 `app/zentao/www/theme/codemanager/codemanager.css` 增加只影响第 20 页的 scoped 样式：
  - 增加页面底部安全距离。
  - 限制测试单列表表格可视高度并启用内部滚动。
  - 将表格数字列 `.num` 和通过率 `.progress` 恢复为 15px 表格文本层级。
  - 恢复蓝紫进度条、绿色普通状态和黄色警告状态胶囊。

验证结果：
- `git diff --check -- app/zentao/module/testreport/view/browselist.html.php app/zentao/www/theme/codemanager/codemanager.css` 通过。
- `php -l app\zentao\module\testreport\view\browselist.html.php` 通过。
- 已同步到 `C:\ZenTao`。
- 已重新抓取真实第 20 页截图到 `output/NEWUI/20.png`。
- 已重新生成第 20 页对比图到 `output/NEWUI/compare/20-compare.png`。
- 第 20 页路由 `testreport-browseList.html` 返回 HTTP 200，无 PHP Fatal / Parse / Warning。
- 真实页已确认存在 `.cm-page-testreport-list`，数字列和通过率字体为 15px，普通状态背景为 `rgba(24, 201, 155, 0.14)`，警告状态背景为 `rgba(243, 183, 60, 0.16)`。

当前状态：
- 第 20 页完成本轮修复。
- 测试单列表数字列、通过率进度、状态胶囊和底部安全距离已更接近设计稿。
- 下一张继续处理第 21 页：`21-测试-测试单详情`。

## 2026-05-01 批量修复进度：21-25 测试 / 文档 / 看板

本轮连续处理五张原型图与真实运行页：`21-测试-测试单详情`、`22-文档-空间首页`、`23-文档-文档列表`、`24-文档-文档详情`、`25-看板-空间`。

对比来源：
- 第 21 页设计稿：`output/design/21-测试-测试单详情.png`；实现截图：`output/NEWUI/21.png`；对比图：`output/NEWUI/compare/21-compare.png`
- 第 22 页设计稿：`output/design/22-文档-空间首页.png`；实现截图：`output/NEWUI/22.png`；对比图：`output/NEWUI/compare/22-compare.png`
- 第 23 页设计稿：`output/design/23-文档-文档列表.png`；实现截图：`output/NEWUI/23.png`；对比图：`output/NEWUI/compare/23-compare.png`
- 第 24 页设计稿：`output/design/24-文档-文档详情.png`；实现截图：`output/NEWUI/24.png`；对比图：`output/NEWUI/compare/24-compare.png`
- 第 25 页设计稿：`output/design/25-看板-空间.png`；实现截图：`output/NEWUI/25.png`；对比图：`output/NEWUI/compare/25-compare.png`

发现的问题：
- 第 21 页和任务/Bug 详情页同类，真实 ZenTao shell 下正文块偏高，关联表格会贴近固定底栏。
- 第 21 页顶部状态、关联表格状态和进度条被后续全局样式影响，缺少设计稿里的绿色/黄色胶囊与 14px 进度文本。
- 第 22、23、25 页状态胶囊在真实页中也被压成透明背景，需要按文档/看板页面作用域恢复。
- 第 24 页文档详情的信息标签、正文区域和目录区域需要稳定高度与信息层级，避免首屏密度偏散。
- 文档列表、文档详情和看板空间都需要额外底部安全距离，避免真实运行底栏遮住页面内容。

修复内容：
- 在 `app/zentao/module/testreport/view/detail.html.php` 给页面根节点增加专用类：`cm-page-testreport-detail`。
- 在 `app/zentao/module/doc/view/spaceindex.html.php` 给页面根节点增加专用类：`cm-page-doc-space`。
- 在 `app/zentao/module/doc/view/browselist.html.php` 给页面根节点增加专用类：`cm-page-doc-list`。
- 在 `app/zentao/module/doc/view/detail.html.php` 给页面根节点增加专用类：`cm-page-doc-detail`。
- 在 `app/zentao/module/kanban/view/spaceindex.html.php` 给页面根节点增加专用类：`cm-page-kanban-space`。
- 在 `app/zentao/www/theme/codemanager/codemanager.css` 增加只影响第 21-25 页的 scoped 样式：
  - 第 21 页收紧详情区间距，将 rich 正文块固定为 334px，并恢复状态胶囊、关联进度条和 14px 进度文本。
  - 第 22、23、25 页恢复正常/关注状态胶囊背景。
  - 第 23、24 页增加文档列表/详情的底部安全距离和内容区域稳定高度。
  - 第 24 页恢复信息类标签为蓝紫胶囊，并将文档正文区域稳定到 560px。
  - 第 25 页增加看板空间网格底部安全距离，并稳定看板空间卡片高度。

验证结果：
- `php -l` 对第 21-25 页涉及的 5 个 PHP 模板均通过。
- `git diff --check -- app/zentao/module/testreport/view/detail.html.php app/zentao/module/doc/view/spaceindex.html.php app/zentao/module/doc/view/browselist.html.php app/zentao/module/doc/view/detail.html.php app/zentao/module/kanban/view/spaceindex.html.php app/zentao/www/theme/codemanager/codemanager.css` 通过。
- 已同步到 `C:\ZenTao`。
- 已重新抓取真实第 21-25 页截图到 `output/NEWUI/21.png` 至 `output/NEWUI/25.png`。
- 已重新生成第 21-25 页对比图到 `output/NEWUI/compare/21-compare.png` 至 `output/NEWUI/compare/25-compare.png`。
- 第 21-25 页路由均返回 HTTP 200，无 PHP Fatal / Parse / Warning。
- 真实页已确认存在对应 `.cm-page-*` 专用类：`cm-page-testreport-detail`、`cm-page-doc-space`、`cm-page-doc-list`、`cm-page-doc-detail`、`cm-page-kanban-space`。
- 第 21 页 rich 正文块高度为 334px，普通状态背景为 `rgba(24, 201, 155, 0.14)`，警告状态背景为 `rgba(243, 183, 60, 0.16)`，关联进度文本为 14px。
- 第 22、23、25 页普通状态背景为 `rgba(24, 201, 155, 0.14)`，警告状态背景为 `rgba(243, 183, 60, 0.16)`。
- 第 24 页信息标签背景为 `rgba(99, 102, 241, 0.2)`，文档正文区域高度为 560px。

当前状态：
- 第 21-25 页完成本轮修复。
- 测试单详情、文档空间、文档列表、文档详情和看板空间的关键密度、状态胶囊和底部安全距离已更接近设计稿。
- 下一张继续处理第 26 页：`26-看板-看板详情`。

## 2026-05-01 单页修复进度：26 看板-看板详情

本轮只处理一张原型图与实现图：`26-看板-看板详情`。

对比来源：
- 设计稿：`output/design/26-看板-看板详情.png`
- 实现截图：`output/NEWUI/26.png`
- 对比图：`output/NEWUI/compare/26-compare.png`

发现的问题：
- 第 26 页旧截图整体已经接近设计稿，但真实模板根节点仍是通用 `.cm-page`，后续维护时缺少独立作用域。
- 看板详情和执行看板同类，需要在第 26 页作用域内稳定泳道高度、卡片高度、列头计数徽标、卡片状态和进度条样式。
- 页面底部需要预留安全距离，避免真实 ZenTao shell 固定底栏遮挡后续洞察/建议区域。

修复内容：
- 在 `app/zentao/module/kanban/view/boarddetail.html.php` 给页面根节点增加专用类：`cm-page-kanban-detail`。
- 在 `app/zentao/www/theme/codemanager/codemanager.css` 增加只影响第 26 页的 scoped 样式：
  - 增加页面底部安全距离。
  - 将看板详情泳道稳定为 520px，首屏四列和设计稿保持一致。
  - 将列头计数恢复为蓝紫圆形徽标。
  - 稳定卡片背景、卡片高度、说明文本高度和卡片间距。
  - 恢复绿色普通状态、黄色警告状态、蓝紫进度条和 14px 进度文本。

验证结果：
- `php -l app\zentao\module\kanban\view\boarddetail.html.php` 通过。
- `git diff --check -- app/zentao/module/kanban/view/boarddetail.html.php app/zentao/www/theme/codemanager/codemanager.css` 通过。
- 已同步到 `C:\ZenTao`。
- 已重新抓取真实第 26 页截图到 `output/NEWUI/26.png`。
- 已重新生成第 26 页对比图到 `output/NEWUI/compare/26-compare.png`。
- 第 26 页路由 `kanban-boardDetail.html` 返回 HTTP 200，无 PHP Fatal / Parse / Warning。
- 真实页已确认存在 `.cm-page-kanban-detail`，泳道高度为 520px，列头计数宽度为 30px，普通状态背景为 `rgba(24, 201, 155, 0.14)`，警告状态背景为 `rgba(243, 183, 60, 0.16)`，进度文本为 14px，进度条尺寸为 54px x 6px。

当前状态：
- 第 26 页完成本轮修复。
- 看板详情的首屏泳道、卡片、状态胶囊、计数徽标和进度条已更接近设计稿。
- 下一张继续处理第 27 页：`27-表单-创建编辑通用`。

## 2026-05-01 单页修复进度：27 表单-创建编辑通用

本轮只处理一张原型图与实现图：`27-表单-创建编辑通用`。

对比来源：
- 设计稿：`output/design/27-表单-创建编辑通用.png`
- 实现截图：`output/NEWUI/27.png`
- 对比图：`output/NEWUI/compare/27-compare.png`

发现的问题：
- 第 27 页旧截图在真实 ZenTao shell 宽度下触发了通用 `.detail-layout` 的 1400px 单列断点。
- 右侧“表单规范”面板被挤到首屏下方，和设计稿的表单主面板 + 规范侧栏并列布局不一致。
- 真实模板根节点仍是通用 `.cm-page`，缺少第 27 页独立作用域，后续维护容易影响其他详情页。
- Draft 信息胶囊、表单标签和输入控件高度需要在表单页作用域内稳定。

修复内容：
- 在 `app/zentao/module/admin/view/formtemplate.html.php` 给页面根节点增加专用类：`cm-page-form-template`。
- 在 `app/zentao/www/theme/codemanager/codemanager.css` 增加只影响第 27 页的 scoped 样式：
  - 增加页面底部安全距离。
  - 在第 27 页作用域内覆盖 1400px 单列断点，保持 `2.05fr / .95fr` 双栏布局。
  - 稳定主表单面板和右侧规范面板高度与内边距。
  - 恢复 Draft 信息标签为蓝紫胶囊。
  - 稳定表单标签为 14px，输入框/选择框为 48px，富文本区域为 140px。

验证结果：
- `php -l app\zentao\module\admin\view\formtemplate.html.php` 通过。
- `git diff --check -- app/zentao/module/admin/view/formtemplate.html.php app/zentao/www/theme/codemanager/codemanager.css` 通过。
- 已同步到 `C:\ZenTao`。
- 已重新抓取真实第 27 页截图到 `output/NEWUI/27.png`。
- 已重新生成第 27 页对比图到 `output/NEWUI/compare/27-compare.png`。
- 第 27 页路由 `admin-formTemplate.html` 返回 HTTP 200，无 PHP Fatal / Parse / Warning。
- 真实页已确认存在 `.cm-page-form-template`，布局列宽为 `747.562px 346.422px`，主面板与侧栏顶部均为 268px，Draft 标签背景为 `rgba(99, 102, 241, 0.2)`，输入框和选择框高度为 48px，富文本区域高度为 140px，表单标签为 14px。

当前状态：
- 第 27 页完成本轮修复。
- 表单创建/编辑页的左右栏布局、Draft 胶囊、标签和输入控件密度已更接近设计稿。
- 下一张继续处理第 28 页：`28-组织-首页`。

## 2026-05-01 单页修复进度：28 组织-首页

本轮处理一张真实运行页：`28-组织-首页`。

对比来源：
- 设计稿：当前 `output/design` 根目录与 `output/design/OUT-current` 均未找到第 28 页设计 PNG，现有设计基准只到第 27 页。
- 实现截图：`output/NEWUI/28.png`
- 运行报告：`output/NEWUI/28-capture-report.json`

发现的问题：
- 第 28 页路由和真实页面可以正常打开，但模板根节点仍是通用 `.cm-page`，缺少独立作用域。
- 组织管理面板在真实 ZenTao shell 首屏下方贴近固定底栏，需要为组织首页稳定底部安全距离。
- 组织首页模块卡片可以略微收紧高度，使首屏管理面板和底栏之间留出更稳定的视觉空间。

修复内容：
- 在 `app/zentao/module/company/view/index.html.php` 给页面根节点增加专用类：`cm-page-company-index`。
- 在 `app/zentao/www/theme/codemanager/codemanager.css` 增加只影响第 28 页的 scoped 样式：
  - 增加页面底部安全距离。
  - 收紧组织管理主面板内边距和模块网格间距。
  - 将组织模块卡片稳定为 132px 高度。
  - 保持 4 列模块网格、开关控件视觉和下方洞察区域底部安全距离。

验证结果：
- `php -l app\zentao\module\company\view\index.html.php` 通过。
- `git diff --check -- app/zentao/module/company/view/index.html.php app/zentao/www/theme/codemanager/codemanager.css` 通过。
- 已同步到 `C:\ZenTao`。
- 已重新抓取真实第 28 页截图到 `output/NEWUI/28.png`。
- 第 28 页路由 `company-index.html` 返回 HTTP 200，无 PHP Fatal / Parse / Warning。
- 真实页已确认存在 `.cm-page-company-index`，组织管理主面板高度为 420px，模块网格为 4 列，模块卡片高度为 132px，开关宽度为 44px。
- 抓图时出现一条 Xuanxuan `runtime not ready` console error，来源为 `data/xuanxuan/web/dist/main.js`，未影响第 28 页 PHP 路由、页面渲染或主题样式验证。

当前状态：
- 第 28 页完成本轮修复。
- 组织首页的页面作用域、模块卡片密度和底部安全距离已稳定。
- 当前 01-28 页面序列已处理到最后一页；如继续，应回到全量复核或补缺失的第 28 页设计基准。
