<?php
/**
 * The html detail.html.php view file of doc module of ZenTaoPMS.
 * Design: 24-文档-文档详情
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
    <section class="hero"><div><div class="crumbs"><span>文档</span><span>›</span><span>文档详情</span></div><h1>文档详情</h1><p class="subtitle">文档阅读页包含目录、正文、版本、附件和评论区。</p></div><button class="ghost-btn">视图设置 ⌄</button></section>
    <section class="tree-layout"><aside class="panel tree"><div class="tree-item active"># 概览</div><div class="tree-item "># 设计原则</div><div class="tree-item "># 组件规范</div><div class="tree-item "># 验收清单</div><div class="tree-item "># 评论</div></aside><article class="panel doc-body"><div class="doc-title">LucenAI 暗色前端设计规范</div><div class="doc-meta">作者 admin · 更新于 2026-04-28 · 版本 v1.3</div><div class="rich"><h3>设计目标</h3><p>所有核心业务页面统一为蓝紫深色玻璃风格，保持低对比边框、透明层次和稳定的信息密度。</p><h3>组件要求</h3><ul><li>列表页必须包含筛选、指标、表格和分页。</li><li>看板页必须包含列、卡片、状态和负责人。</li><li>详情页必须包含概览、关联对象和时间线。</li></ul><h3>附件</h3><p><span class="status info">dashboard-reference.png</span> <span class="status info">product-list.png</span></p></div></article></section>
</div>

<?php if (!isset($zinContext)): ?>
<?php include '../../common/view/footer.html.php';?>
<?php endif; ?>
