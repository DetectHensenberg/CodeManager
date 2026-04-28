<?php
/**
 * The html template file of index method of my module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.cnezsoft.com)
 * @license     ZPL(http://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     ZenTaoPMS
 * @version     $Id: index.html.php 1947 2011-06-29 11:58:03Z wwccss $
 */
?>
<?php include '../../common/view/header.html.php';?>

<?php $cmCssFile = $this->app->getBasePath() . 'www/theme/codemanager/codemanager.css'; if(file_exists($cmCssFile)): ?>
<link rel="stylesheet" href="<?php echo $this->app->getWebRoot() . 'theme/codemanager/codemanager.css?t=' . filemtime($cmCssFile); ?>" id="codemanagerCSS">
<?php endif; ?>

<?php
$userName  = isset($app->user->realname) ? $app->user->realname : (isset($app->user->account) ? $app->user->account : 'admin');
$dateStr   = date('Y年m月d日');
$weekday   = array('日','一','二','三','四','五','六')[date('w')];
$dateFull  = $dateStr . ' 星期' . $weekday;
$greeting  = (int)date('H') < 12 ? '上午好' : ((int)date('H') < 18 ? '下午好' : '晚上好');

$metrics = array(
  array('label'=>'待我评审', 'value'=>12, 'badge'=>'+3',   'badgeColor'=>'green',  'link'=>'查看评审数',   'icon'=>'✓',  'iconColor'=>'#18c99b', 'iconBg'=>'rgba(24,201,155,.22)'),
  array('label'=>'任务数',   'value'=>38, 'badge'=>'-2%',  'badgeColor'=>'red',    'link'=>'查看全部任务', 'icon'=>'▢',  'iconColor'=>'#5bc4ff', 'iconBg'=>'rgba(91,196,255,.16)'),
  array('label'=>'Bug数',    'value'=>7,  'badge'=>'+1',   'badgeColor'=>'green',  'link'=>'查看详情',     'icon'=>'!',  'iconColor'=>'#f3b73c', 'iconBg'=>'rgba(243,183,60,.16)'),
  array('label'=>'研发需求', 'value'=>24, 'badge'=>'+5.2%','badgeColor'=>'green',  'link'=>'查看需求池',   'icon'=>'◇',  'iconColor'=>'#8da0ff', 'iconBg'=>'rgba(141,160,255,.16)'),
);

$todoItems = array(
  array('title'=>'产品需求池梳理',    'owner'=>'admin', 'progress'=>84, 'deadline'=>'2026/04/30', 'type'=>'需求', 'status'=>'进行中', 'statusClass'=>'active'),
  array('title'=>'仪表盘暗色适配',    'owner'=>'admin', 'progress'=>76, 'deadline'=>'2026/05/02', 'type'=>'任务', 'status'=>'进行中', 'statusClass'=>'active'),
  array('title'=>'Bug 列表按钮统一',   'owner'=>'admin', 'progress'=>62, 'deadline'=>'2026/05/04', 'type'=>'Bug',  'status'=>'待处理', 'statusClass'=>'warn'),
  array('title'=>'项目执行看板检查',   'owner'=>'admin', 'progress'=>58, 'deadline'=>'2026/05/06', 'type'=>'项目', 'status'=>'进行中', 'statusClass'=>'active'),
  array('title'=>'文档中心样式回归',   'owner'=>'admin', 'progress'=>42, 'deadline'=>'2026/05/08', 'type'=>'文档', 'status'=>'待处理', 'statusClass'=>'warn'),
  array('title'=>'后台配置页暗色审查', 'owner'=>'admin', 'progress'=>31, 'deadline'=>'2026/05/10', 'type'=>'后台', 'status'=>'阻塞',   'statusClass'=>'danger'),
);

$timelineItems = array(
  array('time'=>'09:30', 'title'=>'项目 A 完成阶段评审', 'desc'=>'需求拆分已同步到执行空间，等待研发确认排期。'),
  array('time'=>'11:10', 'title'=>'项目 B 新增 2 个风险', 'desc'=>'接口依赖和测试环境准备延期，需要项目经理跟进。'),
  array('time'=>'15:40', 'title'=>'项目 C 发布计划更新', 'desc'=>'版本窗口调整到本周五，关联 Bug 需要提前关闭。'),
);

$quickActions = array(
  array('label'=>'提需求', 'desc'=>'PRD / Story'),
  array('label'=>'建任务', 'desc'=>'Task'),
  array('label'=>'报 Bug',  'desc'=>'Issue'),
  array('label'=>'新项目', 'desc'=>'Project'),
  array('label'=>'写文档', 'desc'=>'Doc'),
  array('label'=>'看报表', 'desc'=>'BI'),
);

$flowRows = array(
  array('role'=>'管理员',   'steps'=>array('维护部门', '添加用户', '维护权限')),
  array('role'=>'产品经理', 'steps'=>array('创建产品', '维护模块', '维护计划', '维护需求', '创建发布')),
  array('role'=>'项目经理', 'steps'=>array('创建项目', '维护团队', '关联需求', '分解任务', '跟踪进度')),
  array('role'=>'研发人员', 'steps'=>array('领取任务', '设计方案', '提交代码', '更新状态', '完成任务')),
  array('role'=>'测试人员', 'steps'=>array('撰写用例', '执行用例', '提交Bug', '验证Bug', '关闭Bug')),
);

$prodOverviewItems = array(
  array('title'=>'CodeManager 前端重构', 'meta'=>'阶段：视觉验收 | 当前动作：地盘主页结构确认 | 负责人：admin'),
  array('title'=>'LucenAI 工作台',       'meta'=>'阶段：设计系统落地 | 当前动作：统一按钮、表格和弹窗暗色规范'),
  array('title'=>'RAG 知识系统',         'meta'=>'阶段：知识库流程验证 | 当前动作：同步透明玻璃层设计语言'),
);

$docItems = array(
  array('title'=>'地盘主页改造说明',  'meta'=>'admin 更新于 10 分钟前',          'status'=>'已更新', 'statusClass'=>'active'),
  array('title'=>'暗色组件设计规范',  'meta'=>'设计系统 / 前端基础组件',          'status'=>'需评审', 'statusClass'=>'warn'),
  array('title'=>'项目执行流程图',    'meta'=>'项目管理 / 研发流程',              'status'=>'已同步', 'statusClass'=>'active'),
  array('title'=>'后台配置页改造清单','meta'=>'后台 / 表单 / 权限配置',            'status'=>'待补充', 'statusClass'=>'danger'),
);

$contribItems = array(
  array('title'=>'已处理任务 18', 'meta'=>'较上周 +12%，集中在前端适配和验收反馈。'),
  array('title'=>'关闭 Bug 6',    'meta'=>'主要为按钮对比度、布局遮挡和白底残留。'),
);

$riskItems = array(
  array('title'=>'运行目录同步', 'meta'=>'代码仓库改动需要同步到 C:\ZenTao 才能在实例生效。'),
  array('title'=>'旧 CSS 残留',  'meta'=>'部分 iframe 页面仍需检查白底、浅色按钮和内联样式。'),
);

$sysStatusItems = array(
  array('title'=>'Web 服务正常', 'meta'=>'127.0.0.1:81 可访问，最近检查无错误。'),
  array('title'=>'通知队列正常', 'meta'=>'消息入口、提醒和用户菜单保持右上角固定。'),
);
?>

<div class="dashboard-design">

<!-- ===== 顶部导航栏 ===== -->
<header class="topbar">
  <div class="search">⌕ <span>搜索任务、Bug、需求、文档...</span></div>
  <div class="top-actions">
    <button class="icon-btn" aria-label="更多" title="更多">⋯</button>
    <button class="icon-btn" aria-label="通知" title="通知">!</button>
    <button class="primary-btn">＋ 添加</button>
    <button class="ghost-btn" aria-label="全屏" title="全屏">↗</button>
    <div class="user"><span class="avatar">A</span><span><?php echo $userName; ?></span><span style="color:#6e789f;font-size:12px">⌄</span></div>
  </div>
</header>

<!-- ===== Hero 区域 ===== -->
<section class="hero-row">
  <div>
    <div class="crumbs"><span>地盘</span><span>›</span><span>仪表盘</span></div>
    <h1>仪表盘</h1>
    <p class="subtitle">集中查看待办、项目状态、流程帮助、文档更新和近期活动。</p>
    <div class="date-pill"><?php echo $dateFull; ?></div>
  </div>
  <button class="btn btn-primary" style="height:48px;min-height:48px;border-radius:10px;padding:0 20px;font-weight:850;">进入使用教程</button>
</section>

<!-- ===== Metric Grid ===== -->
<section class="metric-grid" aria-label="关键指标">
  <?php foreach ($metrics as $m): ?>
  <article class="panel metric">
    <div class="metric-top"><span><?php echo $m['label']; ?></span><span class="metric-badge <?php echo $m['badgeColor']; ?>"><?php echo $m['badge']; ?></span></div>
    <div class="metric-value"><?php echo $m['value']; ?></div>
    <div class="metric-link"><?php echo $m['link']; ?></div>
    <div class="metric-icon" style="color:<?php echo $m['iconColor']; ?>;background:<?php echo $m['iconBg']; ?>"><?php echo $m['icon']; ?></div>
  </article>
  <?php endforeach; ?>
</section>

<!-- ===== Grid-2: 工作趋势 + 项目地图 ===== -->
<section class="grid-2" aria-label="趋势和项目地图">
  <article class="panel large">
    <div class="panel-head">
      <div>
        <h2 class="panel-title">工作趋势</h2>
        <p class="panel-caption">任务、需求和 Bug 的本周处理走势</p>
      </div>
      <div class="select">本周 <span>⌄</span></div>
    </div>
    <div class="chart-stats">
      <div><b>36</b><span>任务</span></div>
      <div><b style="color:#fff">12</b><span>需求</span></div>
      <div><b style="color:#fff">3.5%</b><span>完成率</span></div>
    </div>
    <div class="chart">
      <div class="axis"></div>
      <div class="axis-x"></div>
      <div class="bars">
        <div class="bar" style="height:92px"></div>
        <div class="bar" style="height:124px"></div>
        <div class="bar" style="height:112px"></div>
        <div class="bar" style="height:58px"></div>
        <div class="bar" style="height:126px"></div>
        <div class="bar" style="height:64px"></div>
        <div class="bar" style="height:150px"></div>
      </div>
      <div class="curve">
        <svg viewBox="0 0 600 170" preserveAspectRatio="none">
          <path d="M0,145 C50,20 75,130 120,72 C170,0 205,156 258,92 C322,2 355,150 420,75 C480,20 520,142 600,36" stroke="#f3b73c" fill="none" stroke-width="2"/>
        </svg>
      </div>
      <div class="curve2">
        <svg viewBox="0 0 600 170" preserveAspectRatio="none">
          <path d="M0,98 C80,78 78,66 120,98 C180,132 212,24 270,50 C336,78 358,20 410,54 C480,78 540,74 600,42" stroke="#667088" fill="none" stroke-width="2" opacity=".68"/>
        </svg>
      </div>
    </div>
    <div class="legend center"><span><i class="dot"></i>任务</span><span><i class="dot" style="background:#f3b73c"></i>需求</span><span><i class="dot" style="background:#667088"></i>Bug</span></div>
  </article>

  <article class="panel large">
    <div class="panel-head">
      <div>
        <h2 class="panel-title">项目实施地图</h2>
        <p class="panel-caption">按产品线和项目群观察工作分布</p>
      </div>
      <button class="icon-btn">↓</button>
    </div>
    <div class="map">
      <svg viewBox="0 0 580 300" preserveAspectRatio="xMidYMid meet">
        <path d="M96 116 L132 64 L197 84 L245 45 L321 73 L390 54 L481 94 L526 155 L489 225 L390 242 L325 212 L252 256 L178 221 L101 228 L61 168 Z" stroke="#35527d" stroke-width="3" fill="none"/>
        <path d="M197 84 L182 142 L224 176 L252 256 M321 73 L300 139 L340 184 L325 212 M390 54 L404 132 L481 94 M101 228 L224 176 L340 184 L489 225" stroke="#314b73" stroke-width="2" fill="none"/>
      </svg>
      <span class="pin" style="left:39%;top:36%"></span>
      <span class="pin red" style="left:55%;top:42%"></span>
      <span class="pin" style="left:58%;top:72%"></span>
      <span class="pin" style="left:28%;top:50%"></span>
      <span class="map-label" style="left:41%;top:35%">产品线</span>
      <span class="map-label" style="left:57%;top:41%">项目群</span>
      <span class="map-label" style="left:60%;top:71%">测试</span>
      <span class="map-label" style="left:30%;top:49%">研发</span>
    </div>
    <div class="legend" style="margin-top:20px"><span><i class="dot"></i>89%</span><span><i class="dot" style="background:#18c99b"></i>60%</span><span><i class="dot" style="background:#6f7899"></i>48%</span><span><i class="dot" style="background:#ff4f7a"></i>30%</span></div>
  </article>
</section>

<!-- ===== Workflow ===== -->
<section class="workflow" aria-label="使用帮助">
  <article class="panel">
    <h2 class="panel-title">使用帮助</h2>
    <p class="panel-caption">按角色快速理解工作流</p>
    <div class="help-tabs">
      <span>流程图</span>
      <span>运行模式</span>
      <span>界面切换</span>
      <span>主题切换</span>
    </div>
  </article>
  <article class="panel">
    <div class="panel-head" style="margin-bottom:22px">
      <div>
        <h2 class="panel-title">研发综合流程</h2>
        <p class="panel-caption">从管理员配置到测试关闭 Bug 的完整链路</p>
      </div>
    </div>
    <div class="flow-grid">
      <?php foreach ($flowRows as $row): ?>
      <div class="flow-row"><span class="step role"><?php echo $row['role']; ?></span><?php foreach ($row['steps'] as $s): ?><span class="step"><?php echo $s; ?></span><?php endforeach; ?></div>
      <?php endforeach; ?>
    </div>
  </article>
</section>

<!-- ===== Table Panel ===== -->
<section class="panel table-panel" aria-label="我的待处理">
  <div class="table-head">
    <div>
      <h2 class="panel-title">我的待处理</h2>
      <p class="panel-caption">聚合任务、需求、Bug、项目和文档待办</p>
    </div>
    <div class="select">待办 <span>⌄</span></div>
  </div>
  <table>
    <thead>
      <tr><th><div class="checkbox"></div></th><th>事项</th><th>负责人</th><th>进度</th><th>截止时间</th><th>类型</th><th>状态</th></tr>
    </thead>
    <tbody>
      <?php foreach ($todoItems as $item): ?>
      <tr>
        <td><div class="checkbox"></div></td>
        <td class="link"><?php echo $item['title']; ?></td>
        <td><?php echo $item['owner']; ?></td>
        <td><span class="progress"><?php echo $item['progress']; ?>% <span class="track"><span class="fill" style="width:<?php echo $item['progress']; ?>%"></span></span></span></td>
        <td><?php echo $item['deadline']; ?></td>
        <td><?php echo $item['type']; ?></td>
        <td><span class="status <?php echo $item['statusClass']; ?>"><?php echo $item['status']; ?></span></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</section>

<!-- ===== Section Grid: 动态 + 雷达 + 快捷入口 ===== -->
<section class="section-grid" aria-label="动态概览">
  <article class="panel">
    <div class="panel-head">
      <div>
        <h2 class="panel-title">项目动态</h2>
        <p class="panel-caption">最近项目推进和风险状态</p>
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
        <h2 class="panel-title">产品雷达</h2>
        <p class="panel-caption">需求、计划、发布、缺陷健康度</p>
      </div>
    </div>
    <div class="radar">
      <svg viewBox="0 0 300 250">
        <polygon points="150,24 256,86 232,196 150,230 68,196 44,86" stroke="#334d78" fill="none"/>
        <polygon points="150,58 222,100 204,176 150,204 96,176 78,100" stroke="#334d78" fill="none" opacity=".65"/>
        <polygon points="150,88 196,114 184,160 150,178 116,160 104,114" stroke="#334d78" fill="none" opacity=".45"/>
        <polygon points="150,54 220,106 190,180 150,202 90,168 86,102" fill="rgba(99,102,244,.24)" stroke="#6f72ff"/>
        <circle cx="150" cy="54" r="4" fill="#18c99b"/>
        <circle cx="220" cy="106" r="4" fill="#5f9bff"/>
        <circle cx="190" cy="180" r="4" fill="#f3b73c"/>
        <circle cx="90" cy="168" r="4" fill="#ff4f7a"/>
        <text x="137" y="18" fill="#cbd3ee" font-size="12">需求</text>
        <text x="236" y="92" fill="#cbd3ee" font-size="12">计划</text>
        <text x="208" y="206" fill="#cbd3ee" font-size="12">发布</text>
        <text x="48" y="206" fill="#cbd3ee" font-size="12">缺陷</text>
      </svg>
    </div>
  </article>

  <article class="panel">
    <div class="panel-head">
      <div>
        <h2 class="panel-title">快捷入口</h2>
        <p class="panel-caption">高频创建和查询操作</p>
      </div>
    </div>
    <div class="quick-grid">
      <?php foreach ($quickActions as $q): ?>
      <div class="quick"><?php echo $q['label']; ?><span><?php echo $q['desc']; ?></span></div>
      <?php endforeach; ?>
    </div>
  </article>
</section>

<!-- ===== Grid-2: 产品概览 + 文档 ===== -->
<section class="grid-2" aria-label="产品和文档">
  <article class="panel">
    <div class="panel-head">
      <div>
        <h2 class="panel-title">产品与执行概览</h2>
        <p class="panel-caption">按产品线追踪当前阶段和下一步动作</p>
      </div>
      <div class="select">全部产品 <span>⌄</span></div>
    </div>
    <div class="stack">
      <?php foreach ($prodOverviewItems as $p): ?>
      <div class="mini-card"><div class="mini-title"><?php echo $p['title']; ?></div><div class="mini-meta"><?php echo $p['meta']; ?></div></div>
      <?php endforeach; ?>
    </div>
  </article>

  <article class="panel">
    <div class="panel-head">
      <div>
        <h2 class="panel-title">最近文档</h2>
        <p class="panel-caption">团队近期更新和待阅读内容</p>
      </div>
      <button class="ghost-btn">全部文档</button>
    </div>
    <div class="doc-list">
      <?php foreach ($docItems as $d): ?>
      <div class="doc-row"><div><div class="doc-title"><?php echo $d['title']; ?></div><div class="doc-meta"><?php echo $d['meta']; ?></div></div><span class="status <?php echo $d['statusClass']; ?>"><?php echo $d['status']; ?></span></div>
      <?php endforeach; ?>
    </div>
  </article>
</section>

<!-- ===== Section Grid: 贡献 + 风险 + 系统状态 ===== -->
<section class="section-grid" aria-label="底部补充信息">
  <article class="panel">
    <h2 class="panel-title">我的贡献</h2>
    <p class="panel-caption">本周创建、处理和关闭事项</p>
    <div class="stack" style="margin-top:20px">
      <?php foreach ($contribItems as $c): ?>
      <div class="mini-card"><div class="mini-title"><?php echo $c['title']; ?></div><div class="mini-meta"><?php echo $c['meta']; ?></div></div>
      <?php endforeach; ?>
    </div>
  </article>
  <article class="panel">
    <h2 class="panel-title">风险提醒</h2>
    <p class="panel-caption">需要今天确认的阻塞点</p>
    <div class="stack" style="margin-top:20px">
      <?php foreach ($riskItems as $r): ?>
      <div class="mini-card"><div class="mini-title"><?php echo $r['title']; ?></div><div class="mini-meta"><?php echo $r['meta']; ?></div></div>
      <?php endforeach; ?>
    </div>
  </article>
  <article class="panel">
    <h2 class="panel-title">系统状态</h2>
    <p class="panel-caption">服务、构建和通知健康度</p>
    <div class="stack" style="margin-top:20px">
      <?php foreach ($sysStatusItems as $s): ?>
      <div class="mini-card"><div class="mini-title"><?php echo $s['title']; ?></div><div class="mini-meta"><?php echo $s['meta']; ?></div></div>
      <?php endforeach; ?>
    </div>
  </article>
</section>

</div><!-- .dashboard-design -->

<?php include '../../common/view/footer.html.php';?>
