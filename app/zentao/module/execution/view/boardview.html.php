<?php
/**
 * The html boardview.html.php view file of execution module of ZenTaoPMS.
 * Design: 11-执行-看板
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.cnezsoft.com)
 * @license     ZPL(http://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      CodeManager
 * @package     execution
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

<div class="cm-page">

<header class="topbar"><div class="search-top">⌕ <span>搜索执行、负责人、状态、编号...</span></div><div class="top-actions"><button class="icon-btn">●</button><button class="icon-btn">!</button><button class="primary-btn">＋ 新建执行</button><div class="user"><span class="avatar"><?php echo $userInitial; ?></span><span><?php echo $userName; ?></span><span style="color:#6e789f">⌄</span></div></div></header>
    <section class="hero"><div><div class="crumbs"><span>执行</span><span>›</span><span>看板</span></div><h1>执行看板</h1><p class="subtitle">按待处理、进行中、待验证、已完成组织执行任务流。</p></div><button class="ghost-btn">视图设置 ⌄</button></section>
    <section class="metrics"><article class="metric"><div class="label">全部</div><div class="hint" style="">+6</div><div class="value">24</div></article><article class="metric"><div class="label">进行中</div><div class="hint" style="">+18%</div><div class="value">12</div></article><article class="metric"><div class="label">风险</div><div class="hint" style="color:var(--yellow)">关注</div><div class="value">3</div></article><article class="metric"><div class="label">完成率</div><div class="hint" style="">+8%</div><div class="value">76%</div></article></section><div class="toolbar"><div class="filters"><span class="filter ">全部</span><span class="filter active">我负责 <span class="count">4</span></span><span class="filter ">本周</span><span class="filter ">有风险</span></div><div class="actions"><button class="ghost-btn">⇧ 导出</button><button class="primary-btn">＋ 新建</button></div></div><section class="board"><div class="lane"><div class="lane-head"><span>待处理</span><span class="status info">1</span></div><div class="lane-stack"><article class="card"><div class="card-top"><div><div class="card-title">补齐详情页组件</div><div class="card-sub">TASK-021</div></div><span class="status warn">待处理</span></div><div class="card-meta"><span class="mini-avatar">L</span>lucen<span>·</span><span>05/02</span></div><p>详情页概览、关联对象和时间线。</p><div class="card-meta"><span class="progress">12%<span class="track"><span class="fill" style="width:12%"></span></span></span></div></article></div></div><div class="lane"><div class="lane-head"><span>进行中</span><span class="status info">2</span></div><div class="lane-stack"><article class="card"><div class="card-top"><div><div class="card-title">生成核心页面 HTML</div><div class="card-sub">TASK-018</div></div><span class="status ">进行中</span></div><div class="card-meta"><span class="mini-avatar"><?php echo $userInitial; ?></span><?php echo $userName; ?><span>·</span><span>04/30</span></div><p>批量生成核心闭环页面。</p><div class="card-meta"><span class="progress">76%<span class="track"><span class="fill" style="width:76%"></span></span></span></div></article><article class="card"><div class="card-top"><div><div class="card-title">产品列表改造</div><div class="card-sub">TASK-014</div></div><span class="status ">进行中</span></div><div class="card-meta"><span class="mini-avatar"><?php echo $userInitial; ?></span><?php echo $userName; ?><span>·</span><span>05/07</span></div><p>复杂表头和分页视觉统一。</p><div class="card-meta"><span class="progress">66%<span class="track"><span class="fill" style="width:66%"></span></span></span></div></article></div></div><div class="lane"><div class="lane-head"><span>待验证</span><span class="status info">1</span></div><div class="lane-stack"><article class="card"><div class="card-top"><div><div class="card-title">Playwright 截图验收</div><div class="card-sub">TASK-020</div></div><span class="status warn">验证</span></div><div class="card-meta"><span class="mini-avatar">Q</span>qa<span>·</span><span>05/03</span></div><p>截图检查空白、遮挡和横向溢出。</p><div class="card-meta"><span class="progress">42%<span class="track"><span class="fill" style="width:42%"></span></span></span></div></article></div></div><div class="lane"><div class="lane-head"><span>已完成</span><span class="status info">1</span></div><div class="lane-stack"><article class="card"><div class="card-top"><div><div class="card-title">地盘主页完整原型</div><div class="card-sub">TASK-001</div></div><span class="status ">完成</span></div><div class="card-meta"><span class="mini-avatar"><?php echo $userInitial; ?></span><?php echo $userName; ?><span>·</span><span>04/27</span></div><p>可滚动主页 HTML 与截图。</p><div class="card-meta"><span class="progress">100%<span class="track"><span class="fill" style="width:100%"></span></span></span></div></article></div></div></section><section class="grid-2"><article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">执行洞察</h2><p class="caption">用于辅助负责人快速判断当前优先级。</p></div></div><div class="timeline"><div class="time-item"><span class="time">今日</span><div class="time-body"><strong>高优先级事项集中</strong><span>建议优先处理风险、阻塞和即将到期项。</span></div></div><div class="time-item"><span class="time">本周</span><div class="time-body"><strong>完成率稳步提升</strong><span>主要收益来自统一页面结构和可复用设计组件。</span></div></div></div></article><article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">建议动作</h2><p class="caption">保持与 LucenAI 地盘首页一致的交互语言。</p></div></div><div class="module-grid" style="grid-template-columns:repeat(2,1fr)"><div class="module-card"><h3>补齐状态</h3><p>缺少负责人或截止日期的事项需要优先补全。</p></div><div class="module-card"><h3>同步文档</h3><p>关键决策沉淀到文档空间，方便团队复盘。</p></div></div></article></section>
</div>

<?php if (!isset($zinContext)): ?>
<?php include '../../common/view/footer.html.php';?>
<?php endif; ?>
