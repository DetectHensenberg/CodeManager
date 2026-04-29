<?php
/**
 * The html index.html.php view file of company module of ZenTaoPMS.
 * Design: 28-组织-首页
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.cnezsoft.com)
 * @license     ZPL(http://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      CodeManager
 * @package     company
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

<header class="topbar"><div class="search-top">⌕ <span>搜索用户、部门、权限组...</span></div><div class="top-actions"><button class="icon-btn">●</button><button class="icon-btn">!</button><button class="primary-btn">＋ 新建用户</button><div class="user"><span class="avatar"><?php echo $userInitial; ?></span><span><?php echo $userName; ?></span><span style="color:#6e789f">⌄</span></div></div></header>
    <section class="hero"><div><div class="crumbs"><span>组织</span><span>›</span><span>首页</span></div><h1>组织首页</h1><p class="subtitle">用户管理、部门结构、权限分配与动态概览。</p></div><button class="ghost-btn">视图设置 ⌄</button></section>
    <section class="metrics"><article class="metric"><div class="label">部门总数</div><div class="hint" style="">正常</div><div class="value">5</div></article><article class="metric"><div class="label">用户总数</div><div class="hint" style="">+3</div><div class="value">42</div></article><article class="metric"><div class="label">在线用户</div><div class="hint" style="">+4</div><div class="value">12</div></article><article class="metric"><div class="label">待审批</div><div class="hint" style="color:var(--yellow)">关注</div><div class="value">2</div></article></section><section class="panel pad"><div class="panel-head"><div><h2 class="panel-title">组织管理</h2><p class="caption">集中管理用户、部门、权限组和动态，便于管理员快速操作。</p></div></div><div class="module-grid"><div class="module-card"><div style="display:flex;justify-content:space-between;align-items:center;gap:16px"><h3>用户管理</h3><span class="switch "></span></div><p>浏览、创建、编辑和停用系统用户，管理账号、角色和联系方式。</p></div><div class="module-card"><div style="display:flex;justify-content:space-between;align-items:center;gap:16px"><h3>部门管理</h3><span class="switch "></span></div><p>维护公司组织架构树，支持多级部门、层级关系和部门负责人。</p></div><div class="module-card"><div style="display:flex;justify-content:space-between;align-items:center;gap:16px"><h3>权限组管理</h3><span class="switch "></span></div><p>定义权限组、分配模块访问权限和操作权限，控制角色可见范围。</p></div><div class="module-card"><div style="display:flex;justify-content:space-between;align-items:center;gap:16px"><h3>公司动态</h3><span class="switch "></span></div><p>查看全组织的操作日志、登录记录和关键变更，支持时间范围筛选。</p></div><div class="module-card"><div style="display:flex;justify-content:space-between;align-items:center;gap:16px"><h3>公司信息</h3><span class="switch "></span></div><p>维护公司基本信息：名称、地址、联系方式、LOGO 和备案信息。</p></div><div class="module-card"><div style="display:flex;justify-content:space-between;align-items:center;gap:16px"><h3>团队日历</h3><span class="switch "></span></div><p>查看团队成员的工作负载、请假和任务分配，辅助资源调度决策。</p></div></div></section><section class="grid-2"><article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">组织洞察</h2><p class="caption">用于辅助管理员快速判断当前组织状态。</p></div></div><div class="timeline"><div class="time-item"><span class="time">今日</span><div class="time-body"><strong>新增 3 名用户</strong><span>来自研发中心的新成员已完成账号创建和权限分配。</span></div></div><div class="time-item"><span class="time">本周</span><div class="time-body"><strong>部门结构调整</strong><span>产品部与设计部合并为产品设计中心，权限已同步更新。</span></div></div></div></article><article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">建议动作</h2><p class="caption">保持组织信息准确和权限安全。</p></div></div><div class="module-grid" style="grid-template-columns:repeat(2,1fr)"><div class="module-card"><h3>审查权限</h3><p>定期检查高权限账号，移除离职或转岗用户的敏感权限。</p></div><div class="module-card"><h3>完善信息</h3><p>补充用户联系方式、部门和直属上级，方便协作和通知。</p></div></div></article></section>
</div>

<?php if (!isset($zinContext)): ?>
<?php include '../../common/view/footer.html.php';?>
<?php endif; ?>
