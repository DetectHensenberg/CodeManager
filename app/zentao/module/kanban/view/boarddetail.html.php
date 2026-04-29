<?php
/**
 * The html boarddetail.html.php view file of kanban module of ZenTaoPMS.
 * Design: 26-看板-看板详情
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.cnezsoft.com)
 * @license     ZPL(http://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      CodeManager
 * @package     kanban
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

<header class="topbar"><div class="search-top">⌕ <span>搜索看板、负责人、状态、编号...</span></div><div class="top-actions"><button class="icon-btn">●</button><button class="icon-btn">!</button><button class="primary-btn">＋ 新建看板</button><div class="user"><span class="avatar"><?php echo $userInitial; ?></span><span><?php echo $userName; ?></span><span style="color:#6e789f">⌄</span></div></div></header>
    <section class="hero"><div><div class="crumbs"><span>看板</span><span>›</span><span>看板详情</span></div><h1>看板详情</h1><p class="subtitle">泳道、列、卡片、WIP、标签和成员头像。</p></div><button class="ghost-btn">视图设置 ⌄</button></section>
    <section class="metrics"><article class="metric"><div class="label">全部</div><div class="hint" style="">+6</div><div class="value">24</div></article><article class="metric"><div class="label">进行中</div><div class="hint" style="">+18%</div><div class="value">12</div></article><article class="metric"><div class="label">风险</div><div class="hint" style="color:var(--yellow)">关注</div><div class="value">3</div></article><article class="metric"><div class="label">完成率</div><div class="hint" style="">+8%</div><div class="value">76%</div></article></section><div class="toolbar"><div class="filters"><span class="filter ">全部</span><span class="filter active">我负责 <span class="count">4</span></span><span class="filter ">本周</span><span class="filter ">有风险</span></div><div class="actions"><button class="ghost-btn">⇧ 导出</button><button class="primary-btn">＋ 新建</button></div></div><section class="board"><div class="lane"><div class="lane-head"><span>需求池</span><span class="status info">1</span></div><div class="lane-stack"><article class="card"><div class="card-top"><div><div class="card-title">统一深色表格规范</div><div class="card-sub">STORY-001</div></div><span class="status warn">评审</span></div><div class="card-meta"><span class="mini-avatar"><?php echo $userInitial; ?></span><?php echo $userName; ?><span>·</span><span>05/05</span></div><p>列表、分页、筛选、批量操作。</p><div class="card-meta"><span class="progress">72%<span class="track"><span class="fill" style="width:72%"></span></span></span></div></article></div></div><div class="lane"><div class="lane-head"><span>设计中</span><span class="status info">1</span></div><div class="lane-stack"><article class="card"><div class="card-top"><div><div class="card-title">文档详情阅读页</div><div class="card-sub">DOC-UI</div></div><span class="status ">进行中</span></div><div class="card-meta"><span class="mini-avatar">D</span>doc-team<span>·</span><span>05/08</span></div><p>目录、正文、版本、评论。</p><div class="card-meta"><span class="progress">58%<span class="track"><span class="fill" style="width:58%"></span></span></span></div></article></div></div><div class="lane"><div class="lane-head"><span>开发中</span><span class="status info">1</span></div><div class="lane-stack"><article class="card"><div class="card-top"><div><div class="card-title">执行看板交互</div><div class="card-sub">KAN-002</div></div><span class="status ">进行中</span></div><div class="card-meta"><span class="mini-avatar">U</span>ui-team<span>·</span><span>05/10</span></div><p>列、卡片、WIP 和拖拽状态。</p><div class="card-meta"><span class="progress">64%<span class="track"><span class="fill" style="width:64%"></span></span></span></div></article></div></div><div class="lane"><div class="lane-head"><span>已发布</span><span class="status info">1</span></div><div class="lane-stack"><article class="card"><div class="card-top"><div><div class="card-title">产品看板效果稿</div><div class="card-sub">PROD-KAN</div></div><span class="status ">完成</span></div><div class="card-meta"><span class="mini-avatar"><?php echo $userInitial; ?></span><?php echo $userName; ?><span>·</span><span>04/28</span></div><p>产品生命周期看板。</p><div class="card-meta"><span class="progress">100%<span class="track"><span class="fill" style="width:100%"></span></span></span></div></article></div></div></section><section class="grid-2"><article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">看板洞察</h2><p class="caption">用于辅助负责人快速判断当前优先级。</p></div></div><div class="timeline"><div class="time-item"><span class="time">今日</span><div class="time-body"><strong>高优先级事项集中</strong><span>建议优先处理风险、阻塞和即将到期项。</span></div></div><div class="time-item"><span class="time">本周</span><div class="time-body"><strong>完成率稳步提升</strong><span>主要收益来自统一页面结构和可复用设计组件。</span></div></div></div></article><article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">建议动作</h2><p class="caption">保持与 LucenAI 地盘首页一致的交互语言。</p></div></div><div class="module-grid" style="grid-template-columns:repeat(2,1fr)"><div class="module-card"><h3>补齐状态</h3><p>缺少负责人或截止日期的事项需要优先补全。</p></div><div class="module-card"><h3>同步文档</h3><p>关键决策沉淀到文档空间，方便团队复盘。</p></div></div></article></section>
</div>

<?php if (!isset($zinContext)): ?>
<?php include '../../common/view/footer.html.php';?>
<?php endif; ?>
