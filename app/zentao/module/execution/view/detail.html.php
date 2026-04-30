<?php
/**
 * The html detail.html.php view file of execution module of ZenTaoPMS.
 * Design: 12-执行-详情
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.cnezsoft.com)
 * @license     ZPL(http://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      CodeManager
 * @package     execution
 */
?>
<?php if (!isset($zinContext)): ?>
<?php include '../../common/view/header.html.php';?>

<?php $cmCssFile = $this->app->getBasePath() . 'www/theme/codemanager/codemanager.css'; if(file_exists($cmCssFile)): ?>
<link rel="stylesheet" href="<?php echo $this->app->getWebRoot() . 'theme/codemanager/codemanager.css?t=' . filemtime($cmCssFile); ?>" id="codemanagerCSS">
<?php endif; ?>
<?php endif; ?>

<?php
$userName  = isset($app->user->realname) ? $app->user->realname : (isset($app->user->account) ? $app->user->account : 'admin');
$userInitial = mb_substr($userName, 0, 1, 'UTF-8');
?>

<div class="cm-page cm-page-execution-detail">

<header class="topbar"><div class="search-top">⌕ <span>搜索执行、负责人、状态、编号...</span></div><div class="top-actions"><button class="icon-btn">●</button><button class="icon-btn">!</button><button class="primary-btn">＋ 新建执行</button><div class="user"><span class="avatar"><?php echo $userInitial; ?></span><span><?php echo $userName; ?></span><span style="color:#6e789f">⌄</span></div></div></header>
    <section class="hero"><div><div class="crumbs"><span>执行</span><span>›</span><span>详情</span></div><h1>执行详情</h1><p class="subtitle">执行概况、燃尽图、任务分布、团队负载和关联需求。</p></div><button class="ghost-btn">更多操作 ⌄</button></section>
    <section class="detail-layout"><div>
      <article class="detail-block"><div class="panel-head"><div><h2 class="panel-title">前端壳层适配执行</h2><p class="caption">执行编号 执行-2026-001 · 负责人 admin · 更新时间 2026-04-28</p></div><span class="status">进行中</span></div><div class="kv"><div class="kv-item"><div class="kv-label">进度</div><div class="kv-value">76%</div></div><div class="kv-item"><div class="kv-label">优先级</div><div class="kv-value">高</div></div><div class="kv-item"><div class="kv-label">截止日期</div><div class="kv-value">2026-05-18</div></div></div></article>
      <article class="detail-block rich"><h3>目标与范围</h3><p>执行围绕一个迭代周期组织任务、需求、Bug 和测试反馈。</p><h3>验收标准</h3><p>燃尽图、任务看板、风险提醒必须同时可见。</p><ul><li>关键路径清晰，状态变化可追踪。</li><li>表格、按钮、弹窗在深色背景下保持可读。</li><li>所有关联对象保留可进入详情的操作。</li></ul><h3>关联对象</h3><p>关联 CodeManager 项目和 LucenAI 工作台产品。</p></article>
      <article class="panel"><div class="table-wrap"><table class="data-table"><thead><tr><th>关联项</th><th>负责人</th><th>状态</th><th>进度</th></tr></thead><tbody><tr><td><div class="name-main">需求拆分</div><div class="name-sub">REL-1</div></td><td><div class="owner"><span class="mini-avatar"><?php echo $userInitial; ?></span><?php echo $userName; ?></div></td><td><span class="status ">进行中</span></td><td><span class="progress">84%<span class="track"><span class="fill" style="width:84%"></span></span></span></td></tr><tr><td><div class="name-main">任务实现</div><div class="name-sub">REL-2</div></td><td><div class="owner"><span class="mini-avatar"><?php echo $userInitial; ?></span><?php echo $userName; ?></div></td><td><span class="status ">进行中</span></td><td><span class="progress">66%<span class="track"><span class="fill" style="width:66%"></span></span></span></td></tr><tr><td><div class="name-main">Bug 验证</div><div class="name-sub">REL-3</div></td><td><div class="owner"><span class="mini-avatar"><?php echo $userInitial; ?></span><?php echo $userName; ?></div></td><td><span class="status warn">待处理</span></td><td><span class="progress">42%<span class="track"><span class="fill" style="width:42%"></span></span></span></td></tr><tr><td><div class="name-main">文档同步</div><div class="name-sub">REL-4</div></td><td><div class="owner"><span class="mini-avatar"><?php echo $userInitial; ?></span><?php echo $userName; ?></div></td><td><span class="status ">进行中</span></td><td><span class="progress">91%<span class="track"><span class="fill" style="width:91%"></span></span></span></td></tr></tbody></table></div></article>
    </div><aside><article class="detail-block"><h2 class="panel-title">近期动态</h2><div class="timeline"><div class="time-item"><span class="time">09:20</span><div class="time-body"><strong>创建并分配负责人</strong><span>系统记录来自 admin 的操作，保持后续审计可追踪。</span></div></div><div class="time-item"><span class="time">11:45</span><div class="time-body"><strong>完成第一轮评审</strong><span>系统记录来自 admin 的操作，保持后续审计可追踪。</span></div></div><div class="time-item"><span class="time">15:30</span><div class="time-body"><strong>补充验收标准</strong><span>系统记录来自 admin 的操作，保持后续审计可追踪。</span></div></div><div class="time-item"><span class="time">17:10</span><div class="time-body"><strong>等待最终确认</strong><span>系统记录来自 admin 的操作，保持后续审计可追踪。</span></div></div></div></article></aside></section>
</div>

<?php if (!isset($zinContext)): ?>
<?php include '../../common/view/footer.html.php';?>
<?php endif; ?>
