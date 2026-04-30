<?php
/**
 * The html formtemplate.html.php view file of admin module of ZenTaoPMS.
 * Design: 27-表单-创建编辑通用
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.cnezsoft.com)
 * @license     ZPL(http://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      CodeManager
 * @package     admin
 */
?>
<?php if (!isset($zinContext)): ?>
<?php include '../../common/view/header.html.php';?>
<?php endif; ?>

<?php $cmCssFile = $this->app->getBasePath() . 'www/theme/codemanager/codemanager.css'; if(file_exists($cmCssFile)): ?>
<link rel="stylesheet" href="<?php echo $this->app->getWebRoot() . 'theme/codemanager/codemanager.css?t=' . filemtime($cmCssFile); ?>" id="codemanagerCSS">
<?php endif; ?>

<?php
$userName  = isset($app->user->realname) ? $app->user->realname : (isset($app->user->account) ? $app->user->account : 'admin');
$userInitial = mb_substr($userName, 0, 1, 'UTF-8');
?>

<div class="cm-page cm-page-form-template">

<header class="topbar"><div class="search-top">⌕ <span>搜索表单、负责人、状态、编号...</span></div><div class="top-actions"><button class="icon-btn">●</button><button class="icon-btn">!</button><button class="primary-btn">＋ 新建表单</button><div class="user"><span class="avatar"><?php echo $userInitial; ?></span><span><?php echo $userName; ?></span><span style="color:#6e789f">⌄</span></div></div></header>
    <section class="hero"><div><div class="crumbs"><span>表单</span><span>›</span><span>创建编辑通用</span></div><h1>表单创建编辑通用</h1><p class="subtitle">覆盖产品、项目、执行、需求、任务、Bug、文档等创建编辑场景。</p></div><button class="ghost-btn">保存模板 ⌄</button></section>
    <section class="detail-layout"><article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">创建 / 编辑对象</h2><p class="caption">统一表单样式：深色输入、清晰标签、强焦点、底部操作。</p></div><span class="status info">Draft</span></div><div class="form-grid"><div class="field"><div class="label">名称</div><div class="input">仪表盘暗色适配</div></div><div class="field"><div class="label">负责人</div><div class="selectbox">admin</div></div><div class="field"><div class="label">所属产品</div><div class="selectbox">Data Platform</div></div><div class="field"><div class="label">优先级</div><div class="selectbox">高</div></div><div class="field"><div class="label">开始日期</div><div class="input">2026-04-28</div></div><div class="field"><div class="label">截止日期</div><div class="input">2026-05-18</div></div><div class="field full"><div class="label">描述 / 富文本</div><div class="textarea">补齐业务背景、实现范围、验收标准和附件说明。文本区域在深色背景下保持足够对比，并为工具栏预留空间。</div></div><div class="field full"><div class="label">附件</div><div class="input">＋ 上传截图、设计稿或需求文档</div></div></div><div class="actions" style="margin-top:24px;justify-content:flex-end"><button class="ghost-btn">取消</button><button class="primary-btn">保存</button></div></article><aside><article class="detail-block"><h2 class="panel-title">表单规范</h2><div class="timeline"><div class="time-item"><span class="time">01</span><div class="time-body"><strong>标签始终可见</strong><span>不依赖 placeholder 作为唯一说明。</span></div></div><div class="time-item"><span class="time">02</span><div class="time-body"><strong>状态反馈明确</strong><span>错误、必填和禁用状态必须有颜色与文字双重提示。</span></div></div><div class="time-item"><span class="time">03</span><div class="time-body"><strong>操作区固定语义</strong><span>主按钮只保留一个，取消和更多操作弱化。</span></div></div></div></article></aside></section>
</div>

<?php if (!isset($zinContext)): ?>
<?php include '../../common/view/footer.html.php';?>
<?php endif; ?>
