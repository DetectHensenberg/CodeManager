<?php
/**
 * The html browselist.html.php view file of product module of ZenTaoPMS.
 * Design: 05-产品-列表
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.cnezsoft.com)
 * @license     ZPL(http://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      CodeManager
 * @package     product
 */
?>
<?php if (!isset($zinContext)): ?>
<?php include '../../common/view/header.html.php';?>

<?php $cmCssFile = $this->app->getBasePath() . 'www/theme/codemanager/codemanager.css'; if(file_exists($cmCssFile)): ?>
<link rel="stylesheet" href="<?php echo $this->app->getWebRoot() . 'theme/codemanager/codemanager.css?t=' . filemtime($cmCssFile); ?>" id="codemanagerCSS">
<?php endif; ?>
<?php endif; ?>

<?php
$userName  = isset($app->user->realname) ? $app->user->realname : (isset($app->user->account) ? $app->user->account : 'admin');
$userInitial = mb_substr($userName, 0, 1, 'UTF-8');
?>

<div class="cm-page">

<header class="topbar"><div class="search-top">⌕ <span>搜索产品、负责人、代号...</span></div><div class="top-actions"><button class="icon-btn">●</button><button class="icon-btn">!</button><button class="primary-btn">＋ 添加产品</button><div class="user"><span class="avatar"><?php echo $userInitial; ?></span><span><?php echo $userName; ?></span><span style="color:#6e789f">⌄</span></div></div></header>
      <section class="hero"><div><div class="crumbs"><span>产品</span><span>›</span><span>产品列表</span></div><h1>产品列表</h1><p class="subtitle">集中查看产品负责人、需求、计划、执行、质量和发布状态。</p></div><button class="ghost-btn">导出数据</button></section>
      <section class="metrics"><article class="metric"><div class="label">全部产品</div><div class="hint">+4</div><div class="value">5</div></article><article class="metric"><div class="label">未关闭</div><div class="hint">80%</div><div class="value">4</div></article><article class="metric"><div class="label">活跃需求</div><div class="hint">+36</div><div class="value">68</div></article><article class="metric"><div class="label">Bug 激活</div><div class="hint" style="color:var(--yellow)">9</div><div class="value">9</div></article></section>
      <div class="toolbar"><div class="filters"><span class="filter">全部产品</span><span class="filter active">未关闭 <span class="count">4</span></span><span class="filter">结束</span><span class="filter">我负责</span><span class="filter">有风险</span></div><div class="actions"><button class="ghost-btn disabled">⇧ 导出</button><button class="primary-btn">＋ 添加产品</button></div></div>
      <section class="panel">
        <div class="table-wrap">
          <table class="product-table data-table">
            <thead>
              <tr><th rowspan="2"><span class="check">✓</span></th><th rowspan="2">产品名称</th><th rowspan="2">负责人</th><th class="group" colspan="5">研发需求</th><th rowspan="2">计划</th><th rowspan="2">执行</th><th rowspan="2">用例覆盖率</th><th rowspan="2">Bug激活</th><th rowspan="2">修复率</th><th rowspan="2">状态</th><th rowspan="2">操作</th></tr>
              <tr><th>草稿</th><th>激活</th><th>变更中</th><th>评审中</th><th>完成率</th></tr>
            </thead>
            <tbody>
              <tr><td><span class="check">✓</span></td><td><div class="name-cell"><span class="product-mark">D</span><div><div class="product-name">Data Platform</div><div class="product-code">DATA-MID · 真实库数据</div></div></div></td><td><div class="owner"><span class="mini-avatar"><?php echo $userInitial; ?></span><?php echo $userName; ?></div></td><td class="num">4</td><td class="num">18</td><td class="num">2</td><td class="num">3</td><td class="num"><span class="circle">72</span></td><td class="num">3</td><td class="num">5</td><td class="num"><span class="circle">76</span></td><td class="num">2</td><td class="num"><span class="circle">84</span></td><td><span class="status">正常</span></td><td><button class="small-btn">详情</button></td></tr>
              <tr><td><span class="check">✓</span></td><td><div class="name-cell"><span class="product-mark">C</span><div><div class="product-name">CodeManager</div><div class="product-code">CODE-MGR · 前端重构</div></div></div></td><td><div class="owner"><span class="mini-avatar"><?php echo $userInitial; ?></span><?php echo $userName; ?></div></td><td class="num">3</td><td class="num">16</td><td class="num">1</td><td class="num">2</td><td class="num"><span class="circle">84</span></td><td class="num">4</td><td class="num">6</td><td class="num"><span class="circle">89</span></td><td class="num">6</td><td class="num"><span class="circle">78</span></td><td><span class="status warn">关注</span></td><td><button class="small-btn">详情</button></td></tr>
              <tr><td><span class="check">✓</span></td><td><div class="name-cell"><span class="product-mark">L</span><div><div class="product-name">LucenAI Workbench</div><div class="product-code">LUCEN-WB · AI 工作台</div></div></div></td><td><div class="owner"><span class="mini-avatar">L</span>lucen</div></td><td class="num">7</td><td class="num">22</td><td class="num">4</td><td class="num">5</td><td class="num"><span class="circle">66</span></td><td class="num">5</td><td class="num">8</td><td class="num"><span class="circle">71</span></td><td class="num">1</td><td class="num"><span class="circle">91</span></td><td><span class="status">正常</span></td><td><button class="small-btn">详情</button></td></tr>
              <tr><td><span class="check">✓</span></td><td><div class="name-cell"><span class="product-mark">R</span><div><div class="product-name">RAG Knowledge OS</div><div class="product-code">RAG-KOS · 知识系统</div></div></div></td><td><div class="owner"><span class="mini-avatar">K</span>knowledge</div></td><td class="num">5</td><td class="num">14</td><td class="num">2</td><td class="num">6</td><td class="num"><span class="circle">58</span></td><td class="num">2</td><td class="num">3</td><td class="num"><span class="circle">64</span></td><td class="num">0</td><td class="num"><span class="circle">100</span></td><td><span class="status warn">评审</span></td><td><button class="small-btn">详情</button></td></tr>
              <tr><td><span class="check">✓</span></td><td><div class="name-cell"><span class="product-mark">U</span><div><div class="product-name">Dark UI Design System</div><div class="product-code">UI-DS · 组件规范</div></div></div></td><td><div class="owner"><span class="mini-avatar">U</span>ui-team</div></td><td class="num">2</td><td class="num">8</td><td class="num">1</td><td class="num">1</td><td class="num"><span class="circle">91</span></td><td class="num">1</td><td class="num">4</td><td class="num"><span class="circle">96</span></td><td class="num">0</td><td class="num"><span class="circle">100</span></td><td><span class="status">正常</span></td><td><button class="small-btn">详情</button></td></tr>
            </tbody>
          </table>
        </div>
        <div class="footer-row"><span>共 5 项</span><div class="pager"><span>每页 20 项</span><span>1/1</span><span>‹</span><span>›</span></div></div>
      </section>
      <section class="insight-grid">
        <article class="panel insight"><h2>列表阅读辅助</h2><p>产品列表不仅展示产品名称，还把需求、计划、执行、用例、Bug 和修复率放到同一张表，方便产品负责人做横向比较。</p><div class="mini-list"><div class="mini-row"><span>最高完成率</span><span class="status">Dark UI 91%</span></div><div class="mini-row"><span>最多活跃需求</span><span class="status warn">LucenAI 22</span></div><div class="mini-row"><span>最多激活 Bug</span><span class="status danger">CodeManager 6</span></div></div></article>
        <article class="panel insight"><h2>建议动作</h2><p>保留原有复杂表头，但用分组表头、圆形指标和状态胶囊降低阅读负担。真实实现时可按权限隐藏导出和添加按钮。</p><div class="mini-list"><div class="mini-row"><span>Data Platform</span><span class="status">补充计划</span></div><div class="mini-row"><span>CodeManager</span><span class="status warn">修复白底残留</span></div><div class="mini-row"><span>RAG Knowledge OS</span><span class="status">完成评审</span></div></div></article>
      </section>
</div>

<?php if (!isset($zinContext)): ?>
<?php include '../../common/view/footer.html.php';?>
<?php endif; ?>
