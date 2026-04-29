<?php
/**
 * The html browselist.html.php view file of task module of ZenTaoPMS.
 * Design: 15-任务-列表
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.cnezsoft.com)
 * @license     ZPL(http://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      CodeManager
 * @package     task
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

<header class="topbar"><div class="search-top">⌕ <span>搜索任务、负责人、状态、编号...</span></div><div class="top-actions"><button class="icon-btn">●</button><button class="icon-btn">!</button><button class="primary-btn">＋ 新建任务</button><div class="user"><span class="avatar"><?php echo $userInitial; ?></span><span><?php echo $userName; ?></span><span style="color:#6e789f">⌄</span></div></div></header>
    <section class="hero"><div><div class="crumbs"><span>任务</span><span>›</span><span>列表</span></div><h1>任务列表</h1><p class="subtitle">任务表格、负责人、优先级、工时、进度和状态。</p></div><button class="ghost-btn">视图设置 ⌄</button></section>
    <section class="metrics"><article class="metric"><div class="label">全部</div><div class="hint" style="">+6</div><div class="value">24</div></article><article class="metric"><div class="label">进行中</div><div class="hint" style="">+18%</div><div class="value">12</div></article><article class="metric"><div class="label">风险</div><div class="hint" style="color:var(--yellow)">关注</div><div class="value">3</div></article><article class="metric"><div class="label">完成率</div><div class="hint" style="">+8%</div><div class="value">76%</div></article></section><div class="toolbar"><div class="filters"><span class="filter ">全部</span><span class="filter active">未关闭 <span class="count">4</span></span><span class="filter ">我负责</span><span class="filter ">有风险</span></div><div class="actions"><button class="ghost-btn">⇧ 导出</button><button class="primary-btn">＋ 新建</button></div></div><section class="panel"><div class="table-wrap"><table class="data-table"><thead><tr><th><span class="check">✓</span></th><th>任务名称</th><th>负责人</th><th>类型</th><th>预计工时</th><th>进度</th><th>截止时间</th><th>状态</th><th>操作</th></tr></thead><tbody><tr><td><span class="check">✓</span></td><td><div class="name-main">生成核心页面 HTML</div><div class="name-sub">任务-001</div></td><td><div class="owner"><span class="mini-avatar"><?php echo $userInitial; ?></span><?php echo $userName; ?></div></td><td class="">前端</td><td class="">8h</td><td class="num"><span class="progress">76%<span class="track"><span class="fill" style="width:76%"></span></span></span></td><td class="">2026-04-30</td><td><span class="status ">进行中</span></td><td><button class="small-btn">详情</button></td></tr><tr><td><span class="check">✓</span></td><td><div class="name-main">补齐详情页组件</div><div class="name-sub">任务-002</div></td><td><div class="owner"><span class="mini-avatar">L</span>lucen</div></td><td class="">前端</td><td class="">6h</td><td class="num"><span class="progress">58%<span class="track"><span class="fill" style="width:58%"></span></span></span></td><td class="">2026-05-02</td><td><span class="status warn">待处理</span></td><td><button class="small-btn">详情</button></td></tr><tr><td><span class="check">✓</span></td><td><div class="name-main">Playwright 截图验收</div><div class="name-sub">任务-003</div></td><td><div class="owner"><span class="mini-avatar">Q</span>qa</div></td><td class="">测试</td><td class="">4h</td><td class="num"><span class="progress">32%<span class="track"><span class="fill" style="width:32%"></span></span></span></td><td class="">2026-05-03</td><td><span class="status ">未开始</span></td><td><button class="small-btn">详情</button></td></tr><tr><td><span class="check">✓</span></td><td><div class="name-main">同步设计 token</div><div class="name-sub">任务-004</div></td><td><div class="owner"><span class="mini-avatar">U</span>ui-team</div></td><td class="">设计</td><td class="">5h</td><td class="num"><span class="progress">91%<span class="track"><span class="fill" style="width:91%"></span></span></span></td><td class="">2026-05-01</td><td><span class="status ">正常</span></td><td><button class="small-btn">详情</button></td></tr></tbody></table></div><div class="footer-row"><span>共 4 项</span><div class="pager"><span>每页 20 项</span><span>1/1</span><span>‹</span><span>›</span></div></div></section><section class="grid-2"><article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">任务洞察</h2><p class="caption">用于辅助负责人快速判断当前优先级。</p></div></div><div class="timeline"><div class="time-item"><span class="time">今日</span><div class="time-body"><strong>高优先级事项集中</strong><span>建议优先处理风险、阻塞和即将到期项。</span></div></div><div class="time-item"><span class="time">本周</span><div class="time-body"><strong>完成率稳步提升</strong><span>主要收益来自统一页面结构和可复用设计组件。</span></div></div></div></article><article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">建议动作</h2><p class="caption">保持与 LucenAI 地盘首页一致的交互语言。</p></div></div><div class="module-grid" style="grid-template-columns:repeat(2,1fr)"><div class="module-card"><h3>补齐状态</h3><p>缺少负责人或截止日期的事项需要优先补全。</p></div><div class="module-card"><h3>同步文档</h3><p>关键决策沉淀到文档空间，方便团队复盘。</p></div></div></article></section>
</div>

<?php if (!isset($zinContext)): ?>
<?php include '../../common/view/footer.html.php';?>
<?php endif; ?>
