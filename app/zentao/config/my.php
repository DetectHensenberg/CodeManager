<?php
/**
 * ZenTao 用户自定义配置
 *
 * 本文件由 CodeManager 改造方案自动管理。
 * 修改前已备份至 my.php.bak.20260426
 *
 * 改造目标（详见 WORKFLOW.md / SOLUTION_PLAN.md）：
 *   - P1：切换为 lite 视图、关闭无用模块
 *   - P2：为 Story 增加客户/合同等自定义字段
 */

/* ===== 原有基础配置（保持不变） ===== */
$config->installed     = true;
$config->debug         = false;
$config->requestType   = 'PATH_INFO';
$config->db->host      = '127.0.0.1';
$config->db->prefix    = 'zt_';
$config->webRoot       = getWebRoot();
$config->db->name      = 'zentao';
$config->default->lang = 'zh-cn';

/* ===== P1.1 切换 vision 为 rnd（研发版） =====
 * 原计划用 lite，但 lite 会隐藏"产品→需求"等核心功能。
 * 改用 rnd + disabledFeatures 组合精简（已关闭 13 个模块）。
 * 可选值：rnd | lite | or
 */
$config->vision = 'rnd';

/* ===== P1.2 关闭无用模块 =====
 * 通过 disabledFeatures 关闭 HR / OKR / 反馈 / 培训 等模块。
 * 注意：禅道版本不同，部分 feature key 可能略有差异；
 *       若启用后台「禁用功能」面板找不到对应模块，可在此手动追加。
 * 格式：以英文逗号分隔的特性列表。
 */
$config->disabledFeatures = ''
    . 'feedback'         // 反馈
    . ',training'        // 培训
    . ',attend'          // 考勤
    . ',leave'           // 请假
    . ',makeup'          // 补卡
    . ',overtime'        // 加班
    . ',lieu'            // 调休
    . ',refund'          // 报销
    . ',okr'             // OKR
    . ',target'          // 目标管理
    . ',kpi'             // 绩效
    . ',interview'       // 面试
    . ',recruit';        // 招聘

/* ===== P1.4 角色精简（提示用） =====
 * 真正的角色权限需要在「后台 → 权限 → 分组」中操作，
 * 此处仅作为标记：建议合并为 admin / member / guest 三类。
 */

/* ===== P2.2 双轨需求池 - Story 自定义字段 =====
 * 为研发需求增加"解决方案 / 客户交付"维度。
 *
 * 注意：
 *   1. 自定义字段还需在「后台 → 自定义 → 工作流 → 需求」中配置显示与必填。
 *   2. 这里只是声明字段在表单中的可见性。
 *   3. 实际数据存储于 zt_story 扩展表或 effort/extension 字段，
 *      复杂字段建议通过禅道后台的「自定义工作流」可视化添加，
 *      本文件仅做默认显示项的声明。
 */
$config->custom = new stdclass();
$config->custom->story = new stdclass();
// 在 Story 列表/表单中默认显示这些字段（需配合后台工作流配置生效）
$config->custom->story->customCreateFields  = 'pri,estimate,plan,duplicateStory,assignedTo,keywords,mailto,customer,contractNo,deliveryDate,sowLink';
$config->custom->story->customBatchCreateFields = 'pri,plan,assignedTo,keywords,customer,contractNo,deliveryDate';

/* ===== P2.4 启用看板视图 =====
 * lite 模式下默认即支持看板，此处显式声明默认视图。
 */
$config->defaultProjectView = 'kanban';

/* ===== 数据库配置（保持原样） ===== */
include 'mysql.php';
