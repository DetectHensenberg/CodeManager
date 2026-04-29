<?php
/**
 * The html moduleconfig.html.php view file of admin module of ZenTaoPMS.
 * Design: 04-后台-模块配置
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.cnezsoft.com)
 * @license     ZPL(http://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      CodeManager
 * @package     admin
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

<header class="topbar"><div class="search-top">⌕ <span>搜索后台、负责人、状态、编号...</span></div><div class="top-actions"><button class="icon-btn">●</button><button class="icon-btn">!</button><button class="primary-btn">＋ 新建后台</button><div class="user"><span class="avatar"><?php echo $userInitial; ?></span><span><?php echo $userName; ?></span><span style="color:#6e789f">⌄</span></div></div></header>
    <section class="hero"><div><div class="crumbs"><span>后台</span><span>›</span><span>模块配置</span></div><h1>后台模块配置</h1><p class="subtitle">模块开关、导航配置和功能启用状态。</p></div><button class="ghost-btn">视图设置 ⌄</button></section>
    <section class="metrics"><article class="metric"><div class="label">健康度</div><div class="hint" style="">正常</div><div class="value">92%</div></article><article class="metric"><div class="label">安全提醒</div><div class="hint" style="color:var(--yellow)">关注</div><div class="value">3</div></article><article class="metric"><div class="label">启用模块</div><div class="hint" style="">+2</div><div class="value">8</div></article><article class="metric"><div class="label">在线用户</div><div class="hint" style="">+4</div><div class="value">12</div></article></section><section class="panel pad"><div class="panel-head"><div><h2 class="panel-title">模块配置</h2><p class="caption">后台页面采用更高密度的配置卡片和状态开关，便于管理员快速扫描。</p></div></div><div class="module-grid"><div class="module-card"><div style="display:flex;justify-content:space-between;align-items:center;gap:16px"><h3>产品</h3><span class="switch "></span></div><p>产品 当前已纳入 LucenAI 管理后台统一配置视图，支持状态查看、快速进入和风险提示。</p></div><div class="module-card"><div style="display:flex;justify-content:space-between;align-items:center;gap:16px"><h3>项目</h3><span class="switch "></span></div><p>项目 当前已纳入 LucenAI 管理后台统一配置视图，支持状态查看、快速进入和风险提示。</p></div><div class="module-card"><div style="display:flex;justify-content:space-between;align-items:center;gap:16px"><h3>执行</h3><span class="switch "></span></div><p>执行 当前已纳入 LucenAI 管理后台统一配置视图，支持状态查看、快速进入和风险提示。</p></div><div class="module-card"><div style="display:flex;justify-content:space-between;align-items:center;gap:16px"><h3>测试</h3><span class="switch "></span></div><p>测试 当前已纳入 LucenAI 管理后台统一配置视图，支持状态查看、快速进入和风险提示。</p></div><div class="module-card"><div style="display:flex;justify-content:space-between;align-items:center;gap:16px"><h3>文档</h3><span class="switch "></span></div><p>文档 当前已纳入 LucenAI 管理后台统一配置视图，支持状态查看、快速进入和风险提示。</p></div><div class="module-card"><div style="display:flex;justify-content:space-between;align-items:center;gap:16px"><h3>看板</h3><span class="switch "></span></div><p>看板 当前已纳入 LucenAI 管理后台统一配置视图，支持状态查看、快速进入和风险提示。</p></div><div class="module-card"><div style="display:flex;justify-content:space-between;align-items:center;gap:16px"><h3>DevOps</h3><span class="switch "></span></div><p>DevOps 当前已纳入 LucenAI 管理后台统一配置视图，支持状态查看、快速进入和风险提示。</p></div><div class="module-card"><div style="display:flex;justify-content:space-between;align-items:center;gap:16px"><h3>AI 助手</h3><span class="switch "></span></div><p>AI 助手 当前已纳入 LucenAI 管理后台统一配置视图，支持状态查看、快速进入和风险提示。</p></div></div></section><section class="grid-2"><article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">后台洞察</h2><p class="caption">用于辅助负责人快速判断当前优先级。</p></div></div><div class="timeline"><div class="time-item"><span class="time">今日</span><div class="time-body"><strong>高优先级事项集中</strong><span>建议优先处理风险、阻塞和即将到期项。</span></div></div><div class="time-item"><span class="time">本周</span><div class="time-body"><strong>完成率稳步提升</strong><span>主要收益来自统一页面结构和可复用设计组件。</span></div></div></div></article><article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">建议动作</h2><p class="caption">保持与 LucenAI 地盘首页一致的交互语言。</p></div></div><div class="module-grid" style="grid-template-columns:repeat(2,1fr)"><div class="module-card"><h3>补齐状态</h3><p>缺少负责人或截止日期的事项需要优先补全。</p></div><div class="module-card"><h3>同步文档</h3><p>关键决策沉淀到文档空间，方便团队复盘。</p></div></div></article></section>
</div>

<?php if (!isset($zinContext)): ?>
<?php include '../../common/view/footer.html.php';?>
<?php endif; ?>
