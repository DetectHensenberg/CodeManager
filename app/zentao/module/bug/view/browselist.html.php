<?php
/**
 * The html browselist.html.php view file of bug module of ZenTaoPMS.
 * Design: 17-Bug-列表
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.cnezsoft.com)
 * @license     ZPL(http://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      CodeManager
 * @package     bug
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

<div class="cm-page cm-page-bug-list">

<header class="topbar"><div class="search-top">⌕ <span>搜索Bug、负责人、状态、编号...</span></div><div class="top-actions"><button class="icon-btn">●</button><button class="icon-btn">!</button><button class="primary-btn">＋ 新建Bug</button><div class="user"><span class="avatar"><?php echo $userInitial; ?></span><span><?php echo $userName; ?></span><span style="color:#6e789f">⌄</span></div></div></header>
    <section class="hero"><div><div class="crumbs"><span>Bug</span><span>›</span><span>列表</span></div><h1>Bug 列表</h1><p class="subtitle">Bug 表格、严重程度、优先级、解决方案和激活状态。</p></div><button class="ghost-btn">视图设置 ⌄</button></section>
    <section class="metrics"><article class="metric"><div class="label">Bug 总数</div><div class="hint" style="">+6</div><div class="value">24</div></article><article class="metric"><div class="label">激活</div><div class="hint" style="color:var(--yellow)">关注</div><div class="value">9</div></article><article class="metric"><div class="label">已解决</div><div class="hint" style="">+4</div><div class="value">11</div></article><article class="metric"><div class="label">修复率</div><div class="hint" style="">+12%</div><div class="value">78%</div></article></section><div class="toolbar"><div class="filters"><span class="filter ">全部</span><span class="filter active">未关闭 <span class="count">4</span></span><span class="filter ">我负责</span><span class="filter ">有风险</span></div><div class="actions"><button class="ghost-btn">⇧ 导出</button><button class="primary-btn">＋ 新建</button></div></div><section class="panel"><div class="table-wrap"><table class="data-table"><thead><tr><th><span class="check">✓</span></th><th>Bug 标题</th><th>负责人</th><th>严重程度</th><th>优先级</th><th>状态</th><th>模块</th><th>处理状态</th><th>操作</th></tr></thead><tbody><tr><td><span class="check">✓</span></td><td><div class="name-main">产品列表横向溢出</div><div class="name-sub">Bug-001</div></td><td><div class="owner"><span class="mini-avatar"><?php echo $userInitial; ?></span><?php echo $userName; ?></div></td><td class="">严重</td><td class="">高</td><td><span class="status ">激活</span></td><td class="">CSS</td><td><span class="status danger">待修复</span></td><td><button class="small-btn">详情</button></td></tr><tr><td><span class="check">✓</span></td><td><div class="name-main">底部栏遮挡表格分页</div><div class="name-sub">Bug-002</div></td><td><div class="owner"><span class="mini-avatar">Q</span>qa</div></td><td class="">一般</td><td class="">中</td><td><span class="status ">已解决</span></td><td class="">布局</td><td><span class="status ">待验证</span></td><td><button class="small-btn">详情</button></td></tr><tr><td><span class="check">✓</span></td><td><div class="name-main">弹窗按钮仍为白底</div><div class="name-sub">Bug-003</div></td><td><div class="owner"><span class="mini-avatar">U</span>ui-team</div></td><td class="">严重</td><td class="">高</td><td><span class="status ">激活</span></td><td class="">按钮</td><td><span class="status danger">待修复</span></td><td><button class="small-btn">详情</button></td></tr><tr><td><span class="check">✓</span></td><td><div class="name-main">文档详情目录对比度低</div><div class="name-sub">Bug-004</div></td><td><div class="owner"><span class="mini-avatar">D</span>doc-team</div></td><td class="">轻微</td><td class="">低</td><td><span class="status warn">确认中</span></td><td class="">文档</td><td><span class="status ">处理中</span></td><td><button class="small-btn">详情</button></td></tr></tbody></table></div><div class="footer-row"><span>共 4 项</span><div class="pager"><span>每页 20 项</span><span>1/1</span><span>‹</span><span>›</span></div></div></section><section class="grid-2"><article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">Bug洞察</h2><p class="caption">用于辅助负责人快速判断当前优先级。</p></div></div><div class="timeline"><div class="time-item"><span class="time">今日</span><div class="time-body"><strong>高优先级事项集中</strong><span>建议优先处理风险、阻塞和即将到期项。</span></div></div><div class="time-item"><span class="time">本周</span><div class="time-body"><strong>完成率稳步提升</strong><span>主要收益来自统一页面结构和可复用设计组件。</span></div></div></div></article><article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">建议动作</h2><p class="caption">保持与 LucenAI 地盘首页一致的交互语言。</p></div></div><div class="module-grid" style="grid-template-columns:repeat(2,1fr)"><div class="module-card"><h3>补齐状态</h3><p>缺少负责人或截止日期的事项需要优先补全。</p></div><div class="module-card"><h3>同步文档</h3><p>关键决策沉淀到文档空间，方便团队复盘。</p></div></div></article></section>
</div>

<?php if (!isset($zinContext)): ?>
<?php include '../../common/view/footer.html.php';?>
<?php endif; ?>
