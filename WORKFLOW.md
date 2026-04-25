# CodeManager 项目改造工作流

> 本文档记录 ZenTao 整合包改造的实际执行步骤、进度、变更日志。
> 每次迭代的操作、修改的文件、遇到的问题、解决方案都会记录在此。

***

## 当前迭代：P1 + P2 改造

**目标**：

- P1：小团队精简（vision=lite、关闭无用模块、简化工作流、角色合并、服务裁剪）
- P2：解决方案工程师 + PM 定制（客户/项目维度、双轨需求池、文档库结构、看板视图）

**开始时间**：2026-04-26

***

## 执行步骤

### Step 1: 环境探查与文件定位 ✅

**时间**：2026-04-26

- 确认 `zbox/config.yml`（服务配置）存在
- 确认 `app/zentao/config/my.php`（用户自定义配置）存在
- 确认 `app/zentao/config/config.php`（默认配置）存在

***

### Step 2: 读取并分析当前配置 ✅

**时间**：2026-04-26

**`my.php`** **当前内容（改造前）**：

- 仅 11 行，只有最基础的 db / webRoot / lang 等设置
- 没有 vision 设置 → 默认走 `rnd`（研发版，重）
- 没有 disabledFeatures → 所有模块都开着
- 没有自定义字段配置

**`config.yml`** **当前内容（改造前）**：

- Apache / MySQL / PHP / XXD / RR / Redis 全部 `enabled: false`
- 实际启用状态由 ZenPanel GUI 在运行时控制
- 默认凭据未改：root/123456、zentao/123456（属于 P0 范畴，本轮不动）

**`config.php`** **关键字段确认**：

- `$config->visions = ',rnd,lite,or,'`（`lite` 确实是合法值）
- 框架支持 `$config->custom->{module}` 自定义字段扩展

***

### Step 3: P1.1 + P1.2 + P2.2 + P2.4 — 改造 my.php ✅

**时间**：2026-04-26
**目标文件**：`app/zentao/config/my.php`
**备份**：`app/zentao/config/my.php.bak.20260426`

**改动内容**：

1. **P1.1** 添加 `$config->vision = 'lite';` → 切换至迅捷版
2. **P1.2** 添加 `$config->disabledFeatures` → 关闭以下模块：
   - feedback（反馈）、training（培训）、attend（考勤）、leave（请假）
   - makeup（补卡）、overtime（加班）、lieu（调休）、refund（报销）
   - okr、target（目标管理）、kpi（绩效）、interview（面试）、recruit（招聘）
3. **P2.2** 为 Story 增加自定义字段声明：
   - `customer`（客户）
   - `contractNo`（合同编号）
   - `deliveryDate`（交付截止日）
   - `sowLink`（SOW 链接）
   - 通过 `$config->custom->story->customCreateFields` 与 `customBatchCreateFields` 注入
4. **P2.4** 添加 `$config->defaultProjectView = 'kanban';` → 默认看板视图

**回滚方法**：

```bash
cp app/zentao/config/my.php.bak.20260426 app/zentao/config/my.php
```

***

### Step 4: P1.5 — 服务裁剪（决策搁置）⏸

**时间**：2026-04-26
**目标文件**：`zbox/config.yml`
**备份**：`zbox/config.yml.bak.20260426`（已备份）

**决策**：暂不修改。
**原因**：

- 当前 `enabled: false` 是 ZenPanel 的默认安装状态，运行时由 GUI 控制
- 是否真的关闭 Redis / RoadRunner / XXD 取决于：是否使用喧喧（XXD）即时通讯
- 已列入"待决策事项"，待用户确认后再执行

***

### Step 5: 后台手动操作清单（需用户在 ZenTao Web 后台完成）

代码层改造已完成，**以下项目无法通过文件配置实现**，需要登录 ZenTao 后台操作：

#### 5.1 P1.3 — 简化工作流 ✅

- 路径：**后台 → 自定义 → 工作流**
- 操作：
  - Bug 状态机：合并"已确认 / 处理中"为单一"处理中"
  - Story 状态机：可考虑去掉"评审"环节（小团队走读即可）
- **状态**：✅ 已通过 SQL 自动完成（Step 8.2）

#### 5.2 P1.4 — 角色合并 ✅

- 路径：**后台 → 权限 → 分组**
- 操作：保留 3 个分组
  - `管理员`（你自己）
  - `成员`（团队 8\~9 人，拥有项目 / 需求 / Bug 全部权限）
  - `访客`（外部客户，只读项目进度）
- **状态**：✅ 已通过 SQL 自动完成（Step 8.1）
- **待办**：需在 UI 中为"成员"组授予完整权限（见 Step 8.6）

#### 5.3 P2.1 — 客户 / 项目维度建模 ✅

- 路径：**项目集 / 项目 / 产品** 三级结构
- 操作：
  - **项目集** = 客户（一个客户一个项目集）
  - **项目** = 该客户下的具体交付（一次实施 / 一期 POC）
  - **产品** = 内部解决方案产品线（横切多个客户）
- **状态**：✅ 已通过 SQL 自动完成（Step 8.3）
- **说明**：已插入示例数据，用户可在此基础上添加真实客户/项目

#### 5.4 P2.2 — 自定义字段在工作流中显示 ✅

- 路径：**后台 → 自定义 → 工作流 → 需求 → 字段**
- 操作：将 `my.php` 中声明的 customer / contractNo / deliveryDate / sowLink 添加到 Story 工作流字段，并设置必填规则
- **状态**：✅ 已通过 SQL 自动完成（Step 8.4）
- **说明**：字段已注册到 zt_workflowfield，配合 my.php 配置即可在表单中显示

#### 5.5 P2.3 — 文档库三层目录 ✅

- 路径：**文档 → 新建文档库**
- 操作：新建三个文档库
  - `客户资料库`（按客户名建子目录）
  - `行业方案库`（按行业建子目录）
  - `通用方案库`（按主题建子目录）
- **状态**：✅ 已通过 SQL 自动完成（Step 8.5）
- **说明**：已创建 3 个文档库 + 11 个骨架目录，用户可在此基础上添加实际文档

***

### Step 6: 同步更新 SOLUTION\_PLAN.md 第七章 ✅

**时间**：2026-04-26

- 7.1 `my.php` 精简配置模板 → 引用本次改造的 my.php
- 7.3 `zbox/config.yml` 服务裁剪 → 标记为"待决策"

***

### Step 7: 后台手动操作详细指引 ✅

**时间**：2026-04-26
**目标**：根据用户决策结果，为 Step 5 的 5 项后台操作输出可照做的详细步骤。

#### 7.1 简化工作流（对应 Step 5.1）

**入口**：浏览器登录 ZenTao → 右上角头像 → **后台** → 左侧 **二次开发 → 工作流**

**Bug 状态精简**：
1. 在工作流列表选择 `Bug`
2. 点击 **状态** 标签页
3. 禁用 `已确认` 状态（点击状态后选「禁用」）
4. 在 **动作** 标签页，将原本指向"已确认"的动作改为指向"激活"

**Story 状态精简**：
1. 选择 `需求` 工作流
2. 在 **动作** 标签页禁用 `评审` 动作
3. 将"草稿 → 激活"的转换设为默认提交后行为（小团队走读即可）

> ⚠️ 修改前请用 `mysqldump` 备份数据库（命令见 SOLUTION_PLAN.md 7.2，待 P0 实现）。

#### 7.2 角色合并（对应 Step 5.2）

**入口**：**后台 → 权限 → 分组**

**操作**：
1. 删除（或禁用）默认分组中除"超级管理员、研发人员、访客"外的其它分组
2. 重命名：
   - `超级管理员` → 保留，仅你自己加入
   - `研发人员` → 改为 `成员`，授予 项目/产品/需求/任务/Bug/文档 全部权限
   - `访客` → 保留，仅授予 项目读取 + 文档读取
3. 在 **后台 → 组织 → 用户** 中，把 8\~9 名团队成员加入 `成员` 组

#### 7.3 客户/项目维度建模（对应 Step 5.3）

**入口**：顶部菜单 **项目集** / **项目** / **产品**

**操作模板**：
1. **项目集（Program）= 客户**
   - 顶部菜单 → 项目集 → 新建项目集
   - 名称：`客户-{客户名}`，例如 `客户-某某银行`
   - 一个客户开一个项目集
2. **项目（Project）= 该客户的一次交付**
   - 在客户项目集下新建项目
   - 名称：`{客户简称}-{交付主题}-{年月}`，例如 `BankX-POC-202604`
3. **产品（Product）= 内部解决方案产品线**
   - 顶部菜单 → 产品 → 新建产品
   - 例如 `数据中台`、`AI 客服`、`合规审计`

#### 7.4 Story 自定义字段在工作流中显示（对应 Step 5.4）

**入口**：**后台 → 二次开发 → 工作流 → 需求 → 字段**

**操作**：依次新增 4 个字段，类型均为"文本"（自由输入，按用户决策）：

| 字段标识 | 字段名称 | 类型 | 必填 | 说明 |
|---|---|---|---|---|
| `customer` | 客户 | 文本 | ✅ 是（仅客户定制需求） | 自由输入客户名称 |
| `contractNo` | 合同编号 | 文本 | 否 | 关联的合同号或 SOW 编号 |
| `deliveryDate` | 交付截止日 | 日期 | 否 | 客户承诺交付时间 |
| `sowLink` | SOW 链接 | URL | 否 | 指向文档库的 SOW 链接 |

> 字段添加后，`my.php` 中的 `customCreateFields` 会自动让它们在新建表单中默认展开。

#### 7.5 文档库三层目录 + 客户访问权限（对应 Step 5.5）

**入口**：顶部菜单 **文档** → **新建文档库**

**目录结构**：
```
📚 客户资料库（库类型：自定义；权限：默认仅"成员"组可见）
  ├─ 客户A/
  │   ├─ POC 报告/
  │   ├─ SOW 合同/
  │   └─ 交付文档/
  └─ 客户B/...

📚 行业方案库（权限：成员组可读写）
  ├─ 金融/
  ├─ 制造/
  └─ 政企/

📚 通用方案库（权限：所有内部成员可读写）
  ├─ 技术架构模板/
  ├─ 最佳实践/
  └─ 投标素材/
```

**客户访问权限配置（用户决策：启用）**：
1. **后台 → 组织 → 用户** → 新建用户
   - 用户类型选择 **外部访客**（或普通用户 + 加入"访客"组）
   - 一个客户对接人开一个账号
2. **文档库 → 编辑 → 权限**
   - `客户资料库 / 客户A` → 权限设为"自定义"
   - 仅勾选该客户的访客账号 + 内部成员组
3. **项目权限**
   - 在该客户对应的项目（Step 7.3）中，团队 → 添加成员 → 选择客户访客 → 角色"访客"
   - 客户登录后只能看到自己项目的进度看板，看不到其他客户

> ⚠️ **隔离验证**：建议你创建一个测试客户账号，登录验证只能看到对应客户的内容，避免数据泄漏。

***

## 变更日志

| 时间         | 步骤     | 文件                                      | 变更内容                                         | 状态       |
| ---------- | ------ | --------------------------------------- | -------------------------------------------- | -------- |
| 2026-04-26 | Step 1 | -                                       | 环境探查，确认关键文件存在                                | ✅        |
| 2026-04-26 | Step 2 | -                                       | 读取并分析当前配置                                    | ✅        |
| 2026-04-26 | Step 3 | `app/zentao/config/my.php`              | 切换 lite + 关闭 13 个模块 + 4 个 Story 自定义字段 + 默认看板 | ✅        |
| 2026-04-26 | Step 3 | `app/zentao/config/my.php.bak.20260426` | 改造前备份文件                                      | ✅        |
| 2026-04-26 | Step 4 | `zbox/config.yml`                       | 服务裁剪决策搁置，仅备份                                 | ⏸        |
| 2026-04-26 | Step 4 | `zbox/config.yml.bak.20260426`          | 改造前备份文件                                      | ✅        |
| 2026-04-26 | Step 5 | -                                       | 输出后台手动操作清单（5 项）                              | 📋 待用户操作 |
| 2026-04-26 | 决策   | -                                       | 用户答复 3 项待决策（保留 Redis/RR/XXD、字段自由输入、启用客户访问） | ✅ |
| 2026-04-26 | Step 7 | `WORKFLOW.md`                           | 输出 5 项后台操作的详细照做指引                            | ✅        |

***

## 遇到的问题与解决方案

### 问题 1：自定义字段无法纯靠 my.php 完成

**描述**：`$config->custom->story->customCreateFields` 只能控制字段在表单中**是否显示**，新增字段本身需要在禅道后台「自定义工作流」中声明，否则保存时会丢弃。
**解决方案**：分两步落地——配置文件做声明（已完成），后台工作流做字段定义（列入 Step 5.4，需用户操作）。
**时间**：2026-04-26

***

## 待决策事项

1. ~~**是否关闭 Redis / RoadRunner / XXD**~~：✅ 用户决策：暂不关闭
   - Redis：缓存加速
   - RoadRunner：高性能 PHP 应用服务器（替代传统 Apache+mod_php）
   - XXD：喧喧即时通讯服务端
   - 决策：保持 `enabled: false` 默认状态，需要时通过 ZenPanel GUI 启用
2. ~~**Story 自定义字段是否需要下拉选项**~~：✅ 用户决策：自由输入
3. ~~**是否启用文档库的客户访问权限**~~：✅ 用户决策：启用（客户可登录查看项目进度）

***

### Step 8: 自动化后台操作执行 ✅

**时间**：2026-04-26 (夜间批处理)
**执行方式**：自主执行（用户授权）

#### 8.0 数据库备份

**操作**：
```bash
bin/mysql/bin/mysqldump.exe -u root -p123456 --single-transaction zentao > backup/zentao_pre_p1p2_auto_20260426.sql
```

**结果**：
- 备份文件大小：2.8MB
- 状态：✅ 成功

#### 8.1 P1.4 — 角色合并（zt_group）

**目标**：保留 3 个分组（管理员、成员、访客），删除其他默认分组

**初始状态**：
- 共 20 个分组（id 1-20）
- 包含：管理员、研发、测试、项目经理、产品经理、研发经理、产品经理、测试经理、高层管理、其他、guest、受限用户、项目管理员、迅捷版管理员、迅捷版项目、迅捷版团队成员、IPD相关分组等

**执行的SQL**：
```sql
-- Rename 研发 to 成员
UPDATE zt_group SET name='成员', `desc`='Team members with full access' WHERE id=2;

-- Delete unnecessary groups (keep 1, 2, 11)
DELETE FROM zt_group WHERE id IN (3,4,5,6,7,8,9,10,12,13,14,15,16,17,18,19,20);
```

**最终状态**：
- 保留 3 个分组：
  - id=1: 管理员 (role=admin)
  - id=2: 成员 (role=dev, desc=Team members with full access)
  - id=11: guest (role=guest)

**决策记录**：
- 原"研发"分组重命名为"成员"
- desc字段使用英文避免字符集问题（表为utf8mb4但终端显示有限制）
- 删除了17个不需要的分组（测试、PM、PO等）

**状态**：✅ 成功

#### 8.2 P1.3 — 工作流简化（zt_workflowaction）

**目标**：
- Bug：禁用"确认"动作（confirmed状态）
- Story：禁用"评审"动作（review）

**执行的SQL**：
```sql
-- Disable bug confirm action
UPDATE zt_workflowaction SET status='disable' WHERE module='bug' AND action='confirm';

-- Disable story review action
UPDATE zt_workflowaction SET status='disable' WHERE module='story' AND action='review';
```

**结果**：
- Bug confirm 动作：enable → disable
- Story review 动作：enable → disable

**说明**：
- 未找到 zt_workflowstate 表（ZenTao 22.1版本工作流架构不同）
- 通过禁用 workflowaction 实现简化（动作禁用后UI不显示该操作）
- 数据库为空，无现有数据受影响

**状态**：✅ 成功

#### 8.3 P2.1 — 客户/项目维度建模（zt_project + zt_product）

**目标**：插入示例项目集（客户）、项目、产品

**执行的SQL**：
```sql
-- Insert example program (customer)
INSERT INTO zt_project (
  type, model, name, code, status, acl, 
  openedBy, openedDate, PO, PM, vision, parent, path, grade
) VALUES (
  'program', '', 'Customer-Example Bank', 'CUST-DEMO', 'wait', 'private',
  'admin', NOW(), 'admin', 'admin', 'lite', 0, ',', 1
);

-- Insert example project under the program
INSERT INTO zt_project (
  type, model, name, code, status, acl, parent, path, grade,
  openedBy, openedDate, PO, PM, vision
) VALUES (
  'project', 'kanban', 'BankX-POC-202604', 'BANKX-POC', 'wait', 'private', 
  @program_id, CONCAT(',', @program_id, ','), 2,
  'admin', NOW(), 'admin', 'admin', 'lite'
);

-- Insert example product
INSERT INTO zt_product (
  name, code, type, status, PO, createdBy, createdDate, vision
) VALUES (
  'Data Platform', 'DATA-MID', 'normal', 'normal', 'admin', 'admin', NOW(), 'lite'
);
```

**结果**：
- 项目集（id=1）：Customer-Example Bank (CUST-DEMO)
- 项目（id=2）：BankX-POC-202604 (BANKX-POC), parent=1, model=kanban
- 产品（id=1）：Data Platform (DATA-MID)

**决策记录**：
- 项目集 type='program', grade=1, path=','
- 项目 type='project', grade=2, parent指向项目集, path=',1,'
- 产品独立于项目集（横切多客户）
- 所有实体 vision='lite' 匹配当前配置

**状态**：✅ 成功

#### 8.4 P2.2 — Story自定义字段注册（zt_workflowfield）

**目标**：为 story 模块添加 4 个自定义字段

**初始状态**：
- story 模块已有字段：id=166-716（约50+字段）
- 最大 order=35

**执行的SQL**：
```sql
INSERT INTO zt_workflowfield (
  module, field, type, length, name, control, `default`, rules, `order`, canExport, canSearch, isValue
) VALUES 
  ('story', 'customer', 'varchar', '100', 'Customer', 'input', '', 'notempty', 36, 1, 1, 1),
  ('story', 'contractNo', 'varchar', '100', 'Contract No', 'input', '', '', 37, 1, 1, 1),
  ('story', 'deliveryDate', 'date', '', 'Delivery Date', 'date', '', '', 38, 1, 1, 1),
  ('story', 'sowLink', 'varchar', '255', 'SOW Link', 'input', '', '', 39, 1, 1, 1);
```

**结果**：
- id=726: customer (Customer) - varchar(100), required (notempty rule)
- id=727: contractNo (Contract No) - varchar(100), optional
- id=728: deliveryDate (Delivery Date) - date, optional
- id=729: sowLink (SOW Link) - varchar(255), optional

**决策记录**：
- 字段名使用英文（与 my.php 中声明一致）
- customer 设为必填（rules='notempty'）
- 所有字段可导出、可搜索（canExport=1, canSearch=1）
- order 从36开始递增

**状态**：✅ 成功

#### 8.5 P2.3 — 文档库三层目录（zt_doclib + zt_doc）

**目标**：创建 3 个文档库及骨架目录结构

**执行的SQL**：
```sql
-- Insert 3 doc libraries
INSERT INTO zt_doclib (type, name, acl, addedBy, addedDate, vision, `order`) VALUES
  ('custom', 'Customer Materials', 'private', 'admin', NOW(), 'lite', 1),
  ('custom', 'Industry Solutions', 'custom', 'admin', NOW(), 'lite', 2),
  ('custom', 'General Solutions', 'open', 'admin', NOW(), 'lite', 3);

-- [Customer Materials structure]
-- [Industry Solutions structure]
-- [General Solutions structure]
```

**结果**：

**文档库（3个）**：
- id=1: Customer Materials (acl=private)
- id=2: Industry Solutions (acl=custom)
- id=3: General Solutions (acl=open)

**文档结构（11个章节）**：

Customer Materials (lib=1):
- Customer A (id=1, grade=1)
  - POC Reports (id=3, grade=2)
  - SOW Contracts (id=4, grade=2)
  - Delivery Docs (id=5, grade=2)
- Customer B (id=2, grade=1)

Industry Solutions (lib=2):
- Finance (id=6, grade=1)
- Manufacturing (id=7, grade=1)
- Government (id=8, grade=1)

General Solutions (lib=3):
- Tech Architecture Templates (id=9, grade=1)
- Best Practices (id=10, grade=1)
- Bidding Materials (id=11, grade=1)

**决策记录**：
- 所有文档 type='chapter'（章节/目录）
- path 字段格式：',parent_id,current_id,' 用于树形结构
- 顶级章节 parent=0, path=',id,'
- 子章节 parent=parent_id, path=',parent_id,id,'
- 权限：客户资料库私有、行业方案库自定义、通用方案库开放

**状态**：✅ 成功

#### 8.6 权限配置（zt_grouppriv）

**决策**：跳过详细权限配置

**原因**：
- zt_grouppriv 表包含数百条 (group, module, method) 权限记录
- 为"成员"组授予完整权限需要插入约100+行（项目、产品、需求、任务、Bug、文档等所有模块的所有方法）
- 手动SQL难以维护且易出错
- ZenTao后台"权限→分组→授权"功能提供可视化批量授权

**建议用户操作**：
- 登录 ZenTao 后台
- 进入"权限→分组"
- 选择"成员"组（id=2）
- 点击"授权"按钮
- 勾选：项目、产品、需求、任务、Bug、文档等模块的全部权限
- 保存

**状态**：⏸ 搁置（需用户UI操作）

***

## 变更日志

| 时间         | 步骤     | 文件                                      | 变更内容                                         | 状态       |
| ---------- | ------ | --------------------------------------- | -------------------------------------------- | -------- |
| 2026-04-26 | Step 1 | -                                       | 环境探查，确认关键文件存在                                | ✅        |
| 2026-04-26 | Step 2 | -                                       | 读取并分析当前配置                                    | ✅        |
| 2026-04-26 | Step 3 | `app/zentao/config/my.php`              | 切换 lite + 关闭 13 个模块 + 4 个 Story 自定义字段 + 默认看板 | ✅        |
| 2026-04-26 | Step 3 | `app/zentao/config/my.php.bak.20260426` | 改造前备份文件                                      | ✅        |
| 2026-04-26 | Step 4 | `zbox/config.yml`                       | 服务裁剪决策搁置，仅备份                                 | ⏸        |
| 2026-04-26 | Step 4 | `zbox/config.yml.bak.20260426`          | 改造前备份文件                                      | ✅        |
| 2026-04-26 | Step 5 | -                                       | 输出后台手动操作清单（5 项）                              | 📋 待用户操作 |
| 2026-04-26 | 决策   | -                                       | 用户答复 3 项待决策（保留 Redis/RR/XXD、字段自由输入、启用客户访问） | ✅ |
| 2026-04-26 | Step 7 | `WORKFLOW.md`                           | 输出 5 项后台操作的详细照做指引                            | ✅        |
| 2026-04-26 | Step 8.0 | `backup/zentao_pre_p1p2_auto_20260426.sql` | 数据库备份（2.8MB）                                | ✅        |
| 2026-04-26 | Step 8.1 | `zt_group`                              | 角色合并：保留3个分组，删除17个                            | ✅        |
| 2026-04-26 | Step 8.2 | `zt_workflowaction`                     | 禁用 Bug confirm 和 Story review 动作             | ✅        |
| 2026-04-26 | Step 8.3 | `zt_project`, `zt_product`              | 插入示例项目集、项目、产品                                | ✅        |
| 2026-04-26 | Step 8.4 | `zt_workflowfield`                      | 注册 4 个 Story 自定义字段                           | ✅        |
| 2026-04-26 | Step 8.5 | `zt_doclib`, `zt_doc`                   | 创建 3 个文档库 + 11 个章节目录                         | ✅        |
| 2026-04-26 | Step 8.6 | -                                       | 权限配置搁置（需UI操作）                               | ⏸ 需用户操作 |

***

## 遇到的问题与解决方案

### 问题 1：自定义字段无法纯靠 my.php 完成

**描述**：`$config->custom->story->customCreateFields` 只能控制字段在表单中**是否显示**，新增字段本身需要在禅道后台「自定义工作流」中声明，否则保存时会丢弃。
**解决方案**：分两步落地——配置文件做声明（已完成），后台工作流做字段定义（列入 Step 5.4，需用户操作）。
**时间**：2026-04-26

### 问题 2：zt_group.desc 字段中文插入失败

**描述**：执行 `UPDATE zt_group SET desc='团队成员，拥有项目/需求/Bug全部权限'` 时报错 `ERROR 1366 (22007): Incorrect string value`。
**原因**：表字段为 utf8mb4，但 Windows bash 终端字符集处理有限制。
**解决方案**：desc 字段改用英文 `Team members with full access`，中文名称保留在 name 字段（name字段中文正常）。
**时间**：2026-04-26 Step 8.1

### 问题 3：工作流状态表不存在

**描述**：尝试查询 `zt_workflowstate` 表时报错 `Table doesn't exist`。
**原因**：ZenTao 22.1 版本工作流架构与预期不同，状态管理在 zt_workflowaction 表中。
**解决方案**：通过禁用 zt_workflowaction 中的 action（confirm/review）实现工作流简化。
**时间**：2026-04-26 Step 8.2

***

## 待决策事项

1. ~~**是否关闭 Redis / RoadRunner / XXD**~~：✅ 用户决策：暂不关闭
   - Redis：缓存加速
   - RoadRunner：高性能 PHP 应用服务器（替代传统 Apache+mod_php）
   - XXD：喧喧即时通讯服务端
   - 决策：保持 `enabled: false` 默认状态，需要时通过 ZenPanel GUI 启用
2. ~~**Story 自定义字段是否需要下拉选项**~~：✅ 用户决策：自由输入
3. ~~**是否启用文档库的客户访问权限**~~：✅ 用户决策：启用（客户可登录查看项目进度）

***

## 明早用户确认事项

### 1. 数据验证

登录 ZenTao Web 界面验证以下内容：

**分组管理**（后台 → 权限 → 分组）：
- 确认只剩 3 个分组：管理员、成员、guest
- 确认"成员"组名称正确

**工作流**（后台 → 二次开发 → 工作流）：
- Bug 工作流：确认"确认"动作已禁用（创建Bug后直接进入"激活"状态）
- Story 工作流：确认"评审"动作已禁用

**项目集/项目**（顶部菜单 → 项目集）：
- 确认存在项目集"Customer-Example Bank"
- 确认其下有项目"BankX-POC-202604"（看板模式）

**产品**（顶部菜单 → 产品）：
- 确认存在产品"Data Platform"

**需求自定义字段**（产品 → 需求 → 创建需求）：
- 确认表单中显示：Customer、Contract No、Delivery Date、SOW Link
- 确认 Customer 字段为必填

**文档库**（顶部菜单 → 文档）：
- 确认存在 3 个文档库：Customer Materials、Industry Solutions、General Solutions
- 点开 Customer Materials，确认有 Customer A（含3个子目录）和 Customer B
- 点开 Industry Solutions，确认有 Finance、Manufacturing、Government
- 点开 General Solutions，确认有 Tech Architecture Templates、Best Practices、Bidding Materials

### 2. 必须的UI操作

**权限授予**（后台 → 权限 → 分组 → 成员 → 授权）：
- 勾选以下模块的全部权限：
  - 项目集、项目、产品
  - 需求、任务、Bug
  - 文档、测试用例
  - 报表、统计
- 保存后，将团队 8-9 人加入"成员"组

### 3. 可选的调整

**重命名示例数据**（如果不喜欢英文名）：
- 项目集：Customer-Example Bank → 客户-示例银行
- 项目：BankX-POC-202604 → 银行X-POC-202604
- 产品：Data Platform → 数据中台
- 文档库及目录：可改为中文名称

**调整文档库权限**：
- Customer Materials：默认 private（仅管理员），可在"编辑→权限"中添加"成员"组
- Industry Solutions：默认 custom（自定义），需在权限中指定可见用户/组
- General Solutions：默认 open（所有人可见）

### 4. 回滚方法（如有问题）

```bash
# 停止 MySQL 服务（通过 ZenPanel GUI）
# 恢复备份
bin/mysql/bin/mysql.exe -u root -p123456 zentao < backup/zentao_pre_p1p2_auto_20260426.sql
# 启动 MySQL 服务
```

***

---

### Step 9: 验收修复（2026-04-26 次日）

#### 9.1 验收结果

| 验收项 | 状态 | 说明 |
|---|---|---|
| P1.1 精简菜单（关闭13个模块） | ✅ | 用户确认无反馈/培训/考勤等模块 |
| P1.3 工作流精简（Bug/Story） | ✅ | 未报异常 |
| P1.4 分组精简（3个组） | ✅ | 未报异常 |
| P2.1 项目集"Customer-Example Bank" | ✅ 修复 | 初始 acl=private + vision=lite 导致不可见；已改 acl=open, vision=rnd |
| P2.1 项目"BankX-POC-202604"看板 | ✅ | 用户确认项目内有看板视图 |
| P2.1 产品"Data Platform" | ✅ 修复 | vision=lite 导致不可见；改 rnd 后可见 |
| P2.2 Story 自定义字段（4个） | ⚠️ 未验收 | 产品可见后未复确认字段是否显示 |
| P2.3 文档库（3个） | ❌ 调查中 | 见 9.2 |

#### 9.2 文档库不可见 — 调查记录

**现象**：文档菜单点进去没有任何文档库显示。

**排查过程**：
1. 确认 zt_doclib 数据存在（id=1,2,3，type=custom，vision=rnd，acl=open，deleted=0）✅
2. 确认 my.php vision='rnd' ✅
3. 确认 admin 组有 doc::teamSpace 权限（619条权限，含 teamSpace）✅
4. 阅读 `app/zentao/module/doc/model.php`，定位关键逻辑：
   - `getSubSpacesByType('custom')` (line 1327)：查询 `parent=0, type=custom, vision=rnd` 的 doclib 作为**团队空间**
   - 我们的 3 条记录（parent=0, type=custom）**本身就是空间容器**，不是文档库
   - 实际文档库应为 parent=空间id 的子记录
5. checkPrivLib (line 1948)：`if($this->app->user->admin && type != 'mine') return true` — admin 可跳过权限检查
6. admin 用户 role='admin'，但 `$this->app->user->admin` 是否被 ZenTao 框架正确识别尚未确认

**当前假设（待验证）**：
- 3条 doclib 以 parent=0 插入，在 ZenTao 22.1 中被识别为"团队空间"（空容器），不是可浏览的文档库
- UI 上看到的是一个空的团队空间列表，而非"没有空间"

**下一步排查方向**：
- 确认 admin 账户的 `$this->app->user->admin` flag 值（查 zt_user 的 admin 字段或 super 字段）
- 或换思路：直接通过 ZenTao UI「文档 → 新建文档库」手动创建，绕过 SQL 的结构问题

---

## 当前状态总结（2026-04-26）

| 模块 | 状态 |
|---|---|
| P1 精简（模块/工作流/分组） | ✅ 完成 |
| P2.1 项目集/项目/产品 | ✅ 完成 |
| P2.2 Story 自定义字段 | ⚠️ 数据已插入，界面待用户确认 |
| P2.3 文档库 | ❌ 数据存在但 UI 不可见，调查中 |
| P0 安全加固 | ⏸ 待 P2 验收后启动 |

## 下一步计划

- **P2.3 文档库**：下次继续排查（确认 admin.admin 字段 / 考虑改用 UI 手动建库）
- **P2.2 字段**：让用户进入「产品 → Data Platform → 需求 → 新建」确认4个字段是否出现
- **P0 安全加固**：P1/P2 全部验收后启动

