<?php
/**
 * The html browselist.html.php view file of doc module of ZenTaoPMS.
 * Design: 23-文档-文档列表
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

<div class="cm-page cm-page-doc-list">

<header class="topbar"><div class="search-top">⌕ <span>搜索文档、负责人、状态、编号...</span></div><div class="top-actions"><button class="icon-btn">●</button><button class="icon-btn">!</button><button class="primary-btn">＋ 新建文档</button><div class="user"><span class="avatar"><?php echo $userInitial; ?></span><span><?php echo $userName; ?></span><span style="color:#6e789f">⌄</span></div></div></header>
    <section class="hero"><div><div class="crumbs"><span>文档</span><span>›</span><span>文档列表</span></div><h1>文档列表</h1><p class="subtitle">左侧目录树与右侧文档列表并列，适合浏览团队知识库。</p></div><button class="ghost-btn">视图设置 ⌄</button></section>
    <section class="tree-layout"><aside class="panel tree"><div class="tree-item active">▤ 全部文档</div><div class="tree-item ">▤ 产品文档</div><div class="tree-item ">▤ 项目文档</div><div class="tree-item ">▤ 测试报告</div><div class="tree-item ">▤ 后台规范</div><div class="tree-item ">▤ 收藏</div></aside><section class="panel"><div class="table-wrap"><table class="data-table"><thead><tr><th>文档标题</th><th>空间</th><th>作者</th><th>更新时间</th><th>状态</th><th>操作</th></tr></thead><tbody><tr><td><div class="name-main">地盘主页改造说明</div><div class="name-sub">DOC-1</div></td><td>产品空间</td><td><div class="owner"><span class="mini-avatar"><?php echo $userInitial; ?></span><?php echo $userName; ?></div></td><td>2026-04-28</td><td><span class="status ">已更新</span></td><td><button class="small-btn">打开</button></td></tr><tr><td><div class="name-main">产品列表设计规范</div><div class="name-sub">DOC-2</div></td><td>产品空间</td><td><div class="owner"><span class="mini-avatar"><?php echo $userInitial; ?></span><?php echo $userName; ?></div></td><td>2026-04-27</td><td><span class="status ">已更新</span></td><td><button class="small-btn">打开</button></td></tr><tr><td><div class="name-main">Bug 处理流程</div><div class="name-sub">DOC-3</div></td><td>测试空间</td><td><div class="owner"><span class="mini-avatar"><?php echo $userInitial; ?></span><?php echo $userName; ?></div></td><td>2026-04-26</td><td><span class="status ">已更新</span></td><td><button class="small-btn">打开</button></td></tr><tr><td><div class="name-main">后台安全策略</div><div class="name-sub">DOC-4</div></td><td>后台空间</td><td><div class="owner"><span class="mini-avatar"><?php echo $userInitial; ?></span><?php echo $userName; ?></div></td><td>2026-04-25</td><td><span class="status warn">待评审</span></td><td><button class="small-btn">打开</button></td></tr><tr><td><div class="name-main">测试用例模板</div><div class="name-sub">DOC-5</div></td><td>模板中心</td><td><div class="owner"><span class="mini-avatar"><?php echo $userInitial; ?></span><?php echo $userName; ?></div></td><td>2026-04-24</td><td><span class="status ">已更新</span></td><td><button class="small-btn">打开</button></td></tr></tbody></table></div></section></section>
</div>

<?php if (!isset($zinContext)): ?>
<?php include '../../common/view/footer.html.php';?>
<?php endif; ?>
