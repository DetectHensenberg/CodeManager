<?php
/**
 * The html spaceindex.html.php view file of doc module of ZenTaoPMS.
 * Design: 22-文档-空间首页
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.cnezsoft.com)
 * @license     ZPL(http://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      CodeManager
 * @package     doc
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

<header class="topbar"><div class="search-top">⌕ <span>搜索文档、负责人、状态、编号...</span></div><div class="top-actions"><button class="icon-btn">●</button><button class="icon-btn">!</button><button class="primary-btn">＋ 新建文档</button><div class="user"><span class="avatar"><?php echo $userInitial; ?></span><span><?php echo $userName; ?></span><span style="color:#6e789f">⌄</span></div></div></header>
    <section class="hero"><div><div class="crumbs"><span>文档</span><span>›</span><span>空间首页</span></div><h1>文档空间首页</h1><p class="subtitle">个人空间、产品空间、项目空间和团队空间入口。</p></div><button class="ghost-btn">视图设置 ⌄</button></section>
    <section class="metrics"><article class="metric"><div class="label">空间</div><div class="hint" style="">+1</div><div class="value">4</div></article><article class="metric"><div class="label">文档</div><div class="hint" style="">+18</div><div class="value">128</div></article><article class="metric"><div class="label">收藏</div><div class="hint" style="">+6</div><div class="value">32</div></article><article class="metric"><div class="label">本周更新</div><div class="hint" style="">+9</div><div class="value">24</div></article></section><section class="grid-3"><article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">个人空间</h2><p class="caption">我的草稿、收藏和最近访问</p></div><span class="status ">18 篇</span></div></article><article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">产品空间</h2><p class="caption">产品需求、计划和发布说明</p></div><span class="status ">32 篇</span></div></article><article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">项目空间</h2><p class="caption">项目章程、会议纪要和交付件</p></div><span class="status ">26 篇</span></div></article><article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">团队空间</h2><p class="caption">团队规范、流程和知识库</p></div><span class="status ">41 篇</span></div></article><article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">API 文档</h2><p class="caption">接口结构、调试记录和版本</p></div><span class="status ">8 篇</span></div></article><article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">模板中心</h2><p class="caption">PRD、测试报告和复盘模板</p></div><span class="status warn">12 篇</span></div></article></section>
</div>

<?php if (!isset($zinContext)): ?>
<?php include '../../common/view/footer.html.php';?>
<?php endif; ?>
