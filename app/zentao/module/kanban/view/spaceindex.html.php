<?php
/**
 * The html spaceindex.html.php view file of kanban module of ZenTaoPMS.
 * Design: 25-看板-空间
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

<div class="cm-page cm-page-kanban-space">

<header class="topbar"><div class="search-top">⌕ <span>搜索看板、负责人、状态、编号...</span></div><div class="top-actions"><button class="icon-btn">●</button><button class="icon-btn">!</button><button class="primary-btn">＋ 新建看板</button><div class="user"><span class="avatar"><?php echo $userInitial; ?></span><span><?php echo $userName; ?></span><span style="color:#6e789f">⌄</span></div></div></header>
    <section class="hero"><div><div class="crumbs"><span>看板</span><span>›</span><span>空间</span></div><h1>看板空间</h1><p class="subtitle">展示团队看板空间、最近访问、成员和卡片统计。</p></div><button class="ghost-btn">视图设置 ⌄</button></section>
    <section class="metrics"><article class="metric"><div class="label">空间</div><div class="hint" style="">+2</div><div class="value">6</div></article><article class="metric"><div class="label">看板</div><div class="hint" style="">+5</div><div class="value">18</div></article><article class="metric"><div class="label">卡片</div><div class="hint" style="">+41</div><div class="value">246</div></article><article class="metric"><div class="label">WIP 告警</div><div class="hint" style="color:var(--yellow)">关注</div><div class="value">3</div></article></section><section class="grid-3"><article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">研发流程</h2><p class="caption">42 张卡片 · 6 名成员</p></div><span class="status ">正常</span></div><div class="module-grid" style="grid-template-columns:repeat(2,1fr)"><div class="module-card"><h3>进行中</h3><p>12 张</p></div><div class="module-card"><h3>已完成</h3><p>24 张</p></div></div></article><article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">产品规划</h2><p class="caption">36 张卡片 · 5 名成员</p></div><span class="status ">正常</span></div><div class="module-grid" style="grid-template-columns:repeat(2,1fr)"><div class="module-card"><h3>进行中</h3><p>9 张</p></div><div class="module-card"><h3>已完成</h3><p>18 张</p></div></div></article><article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">测试验证</h2><p class="caption">28 张卡片 · 4 名成员</p></div><span class="status warn">关注</span></div><div class="module-grid" style="grid-template-columns:repeat(2,1fr)"><div class="module-card"><h3>进行中</h3><p>7 张</p></div><div class="module-card"><h3>已完成</h3><p>14 张</p></div></div></article><article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">发布准备</h2><p class="caption">19 张卡片 · 3 名成员</p></div><span class="status ">正常</span></div><div class="module-grid" style="grid-template-columns:repeat(2,1fr)"><div class="module-card"><h3>进行中</h3><p>5 张</p></div><div class="module-card"><h3>已完成</h3><p>9 张</p></div></div></article><article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">后台配置</h2><p class="caption">17 张卡片 · 4 名成员</p></div><span class="status ">正常</span></div><div class="module-grid" style="grid-template-columns:repeat(2,1fr)"><div class="module-card"><h3>进行中</h3><p>4 张</p></div><div class="module-card"><h3>已完成</h3><p>7 张</p></div></div></article><article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">知识沉淀</h2><p class="caption">31 张卡片 · 8 名成员</p></div><span class="status ">正常</span></div><div class="module-grid" style="grid-template-columns:repeat(2,1fr)"><div class="module-card"><h3>进行中</h3><p>8 张</p></div><div class="module-card"><h3>已完成</h3><p>16 张</p></div></div></article></section>
</div>

<?php if (!isset($zinContext)): ?>
<?php include '../../common/view/footer.html.php';?>
<?php endif; ?>
