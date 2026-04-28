<?php
/**
 * The html kanban view file of product module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.cnezsoft.com)
 * @license     ZPL(http://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      CodeManager
 * @package     product
 */
?>
<?php include '../../common/view/header.html.php';?>

<?php $cmCssFile = $this->app->getBasePath() . 'www/theme/codemanager/codemanager.css'; if(file_exists($cmCssFile)): ?>
<link rel="stylesheet" href="<?php echo $this->app->getWebRoot() . 'theme/codemanager/codemanager.css?t=' . filemtime($cmCssFile); ?>" id="codemanagerCSS">
<?php endif; ?>

<?php
echo '<!-- DIAG: kanban template executing -->';
/* ── Data extraction ── */
$userName  = isset($app->user->realname) ? $app->user->realname : (isset($app->user->account) ? $app->user->account : 'admin');
$userInitial = mb_substr($userName, 0, 1, 'UTF-8');

$region         = !empty($kanbanList) ? reset($kanbanList) : null;
$swimlaneTitle  = $region ? $region['heading']->title : '';
$regionKey      = $region ? $region['key'] : 0;
$group          = !empty($region['items'][0]['data']) ? $region['items'][0]['data'] : null;
$lanes          = $group ? $group['lanes'] : [];
$columns        = $group ? $group['cols'] : [];
$items          = $group ? $group['items'] : [];
$productCount   = count($lanes);

/* Lanes indexed by name for lookup */
$laneMap = [];
foreach ($lanes as $lane) $laneMap[$lane['name']] = $lane['title'];

/* Column order and tag strategy */
$columnOrder  = ['unexpiredPlan', 'doingProject', 'doingExecution', 'normalRelease'];
$columnLabels = [
  'unexpiredPlan'  => $lang->product->unexpiredPlan,
  'doingProject'   => $lang->product->doingProject,
  'doingExecution' => $lang->product->doingExecution,
  'normalRelease'  => $lang->product->normalRelease,
];
$columnSubLabels = [
  'doingProject'   => $lang->product->doingProject,
  'doingExecution' => $lang->product->doingExecution,
];

/* Stats: aggregate card counts per column across all lanes */
$statCounts = ['unexpiredPlan'=>0, 'doingProject'=>0, 'doingExecution'=>0, 'normalRelease'=>0];
$totalProjectCount = 0;
$totalStoryCount = 0;
foreach ($items as $laneKey => $cols) {
  foreach ($cols as $colKey => $cards) {
    if (isset($statCounts[$colKey])) $statCounts[$colKey] += count($cards);
    if ($colKey === 'doingProject' || $colKey === 'doingExecution') $totalProjectCount += count($cards);
    if ($colKey === 'unexpiredPlan') $totalStoryCount += count($cards);
  }
}
$totalReleaseCount = $statCounts['normalRelease'];

/* Tag logic: determine tag class and text from card status/delay */
function kanbanTagClass($card) {
  if (!empty($card['delay']) && $card['delay'] > 0) return 'red';
  $status = isset($card['status']) ? $card['status'] : '';
  if (in_array($status, ['done', 'closed', 'normal', 'released', 'active'])) return 'green';
  if (in_array($status, ['wait', 'pause', 'suspended'])) return 'warn';
  return '';
}
function kanbanTagText($card) {
  if (!empty($card['delay']) && $card['delay'] > 0) return '已延期';
  $status = isset($card['status']) ? $card['status'] : '';
  $map = ['done'=>'已完成', 'closed'=>'已关闭', 'normal'=>'正常', 'released'=>'已发布', 'active'=>'进行中', 'wait'=>'待处理', 'pause'=>'已暂停', 'suspended'=>'已挂起', 'doing'=>'进行中'];
  return isset($map[$status]) ? $map[$status] : $status;
}

/* Progress value helper */
function safeProgress($card) {
  $p = isset($card['progress']) ? intval($card['progress']) : 0;
  return max(0, min(100, $p));
}

/* Marker as secondary bar value */
function safeMarker($card) {
  $m = isset($card['marker']) ? intval($card['marker']) : 0;
  return max(0, $m);
}

/* Get lane owner/name for card display */
function getCardOwner($card, $laneMap) {
  /* card['id'] is productID/projectID/executionID/releaseID — use lane lookup for the product name */
  return '';
}

/* ── Mock data for panels not yet driven by live data ── */
$timelineItems = [
  ['time'=>'09:20', 'title'=>'Data Platform 新增 3 条数据治理需求', 'desc'=>'来自数据资产盘点，已进入未过期计划。'],
  ['time'=>'11:45', 'title'=>'CodeManager 完成产品列表暗色原型', 'desc'=>'等待页面结构和表格字段验收。'],
  ['time'=>'16:10', 'title'=>'LucenAI Workbench 发布窗口确认', 'desc'=>'本周五合并地盘、产品、项目三组页面。'],
];

$riskItems = [
  ['title'=>'旧表格样式残留', 'tag'=>'高', 'tagClass'=>'red', 'desc'=>'产品列表字段多，必须避免白底、边框过亮、按钮和分页不可读。'],
  ['title'=>'看板空态信息不足', 'tag'=>'中', 'tagClass'=>'warn', 'desc'=>'即使真实库只有一个产品，也应展示产品生命周期里应该看到的计划、项目、执行和发布。'],
  ['title'=>'运行目录同步', 'tag'=>'提醒', 'tagClass'=>'', 'desc'=>'最终实现需要同步到 C:\ZenTao，否则浏览器实例不会生效。'],
];

/* Tabs */
$tabs = [
  ['value'=>'my',    'label'=>$lang->product->myProduct,    'url'=>createLink('product','kanban','browseType=my')],
  ['value'=>'other', 'label'=>$lang->product->otherProduct, 'url'=>createLink('product','kanban','browseType=other')],
];
?>

<div class="kanban-design">

<!-- ===== Topbar ===== -->
<header class="topbar">
  <div class="search">⌕ <span>搜索产品、计划、项目、发布...</span></div>
  <div class="top-actions">
    <button class="icon-btn" aria-label="更多" title="更多">⋯</button>
    <button class="icon-btn" aria-label="通知" title="通知">!</button>
    <button class="primary-btn">＋ 添加产品</button>
    <div class="user"><span class="avatar"><?php echo $userInitial; ?></span><span><?php echo $userName; ?></span><span style="color:#6e789f;font-size:12px">⌄</span></div>
  </div>
</header>

<!-- ===== Hero + Tabs ===== -->
<section class="hero-row">
  <div>
    <div class="crumbs"><span>产品</span><span>›</span><span>产品看板</span></div>
    <h1><?php echo $this->view->title; ?></h1>
    <p class="subtitle">以产品为中心查看计划、项目、执行和发布的流转状态。</p>
    <div class="tabs">
      <?php foreach ($tabs as $tab): ?>
      <a class="tab<?php if($browseType == $tab['value']) echo ' active'; ?>" href="<?php echo $tab['url']; ?>"><?php echo $tab['label']; ?></a>
      <?php endforeach; ?>
    </div>
  </div>
  <button class="ghost-btn" style="height:48px;border-radius:10px;font-weight:850;">视图设置 ⌄</button>
</section>

<?php if(empty($kanbanList)): ?>
<!-- ===== Empty state ===== -->
<section class="panel" style="text-align:center;padding:60px 24px">
  <p style="color:var(--cm-lu-muted);font-size:16px"><?php echo $lang->noData; ?></p>
</section>
<?php else: ?>

<!-- ===== Stats ===== -->
<section class="stats" aria-label="关键指标">
  <article class="card">
    <div class="label">全部产品</div>
    <div class="delta"><?php echo $productCount; ?> 个</div>
    <div class="value"><?php echo $productCount; ?></div>
    <div class="hint"><?php echo $swimlaneTitle; ?> 项目集</div>
  </article>
  <article class="card">
    <div class="label">进行中项目</div>
    <div class="delta"><?php echo $totalProjectCount; ?> 个</div>
    <div class="value"><?php echo $totalProjectCount; ?></div>
    <div class="hint">跨产品项目联动</div>
  </article>
  <article class="card">
    <div class="label">活跃需求</div>
    <div class="delta"><?php echo $totalStoryCount; ?> 条</div>
    <div class="value"><?php echo $totalStoryCount; ?></div>
    <div class="hint">未过期计划需求池</div>
  </article>
  <article class="card">
    <div class="label">正常发布</div>
    <div class="delta"><?php echo $totalReleaseCount; ?> 个</div>
    <div class="value"><?php echo $totalReleaseCount; ?></div>
    <div class="hint">发布管理</div>
  </article>
</section>

<!-- ===== Board Shell ===== -->
<section class="board-shell" aria-label="看板">
  <div class="swimlane-label"><?php echo $swimlaneTitle; ?></div>

  <?php foreach ($columnOrder as $colKey): ?>
  <div class="lane">
    <div class="lane-head"><?php echo $columnLabels[$colKey]; ?></div>
    <?php if (isset($columnSubLabels[$colKey])): ?>
    <div class="lane-sub"><?php echo $columnSubLabels[$colKey]; ?></div>
    <?php endif; ?>
    <div class="lane-stack">
      <?php foreach ($items as $laneKey => $cols): ?>
        <?php if (empty($cols[$colKey])) continue; ?>
        <?php foreach ($cols[$colKey] as $card): ?>
        <?php
          $cardTagClass = kanbanTagClass($card);
          $cardTagText  = kanbanTagText($card);
          $laneTitle    = isset($laneMap[$laneKey]) ? $laneMap[$laneKey] : '';
          $cardOwner    = $laneTitle;
          $progress     = safeProgress($card);
          $marker       = safeMarker($card);
        ?>
        <article class="product-card">
          <div class="product-top">
            <div>
              <div class="product-name"><?php echo $laneTitle; ?></div>
              <div class="code"><?php echo $card['title']; ?></div>
            </div>
            <?php if ($cardTagText): ?><span class="tag<?php echo $cardTagClass ? ' ' . $cardTagClass : ''; ?>"><?php echo $cardTagText; ?></span><?php endif; ?>
          </div>
          <?php if ($cardOwner): ?>
          <div class="owner"><span class="mini-avatar"><?php echo mb_substr($cardOwner, 0, 1, 'UTF-8'); ?></span><?php echo $cardOwner; ?></div>
          <?php endif; ?>
          <div class="bars">
            <div class="bar-row"><span>进度</span><span class="track"><span class="fill" style="width:<?php echo $progress; ?>%"></span></span><b><?php echo $progress; ?>%</b></div>
            <?php if ($marker > 0): ?>
            <div class="bar-row"><span>指标</span><span class="track"><span class="fill" style="width:<?php echo min(100, $marker); ?>%;background:linear-gradient(90deg,var(--cm-lu-warning),var(--cm-lu-danger))"></span></span><b><?php echo $marker; ?></b></div>
            <?php endif; ?>
          </div>
        </article>
        <?php endforeach; ?>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endforeach; ?>
</section>
<?php endif; ?>

<!-- ===== Grid-2: 产品动态 + 风险与动作 ===== -->
<section class="grid-2" aria-label="动态和风险">
  <article class="panel">
    <div class="panel-head">
      <div>
        <h2 class="panel-title">产品动态</h2>
        <p class="panel-caption">跨产品最近活动</p>
      </div>
    </div>
    <div class="timeline">
      <?php foreach ($timelineItems as $t): ?>
      <div class="time-item"><span class="time"><?php echo $t['time']; ?></span><div class="time-body"><strong><?php echo $t['title']; ?></strong><span><?php echo $t['desc']; ?></span></div></div>
      <?php endforeach; ?>
    </div>
  </article>
  <article class="panel">
    <div class="panel-head">
      <div>
        <h2 class="panel-title">风险与动作</h2>
        <p class="panel-caption">产品负责人今天需要处理</p>
      </div>
    </div>
    <div class="risk-list">
      <?php foreach ($riskItems as $r): ?>
      <div class="risk"><strong><?php echo $r['title']; ?><?php if ($r['tag']): ?> <span class="tag<?php echo $r['tagClass'] ? ' ' . $r['tagClass'] : ''; ?>"><?php echo $r['tag']; ?></span><?php endif; ?></strong><p><?php echo $r['desc']; ?></p></div>
      <?php endforeach; ?>
    </div>
  </article>
</section>

</div><!-- .kanban-design -->

<?php include '../../common/view/footer.html.php';?>
