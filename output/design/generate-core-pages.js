const fs = require('fs');
const path = require('path');

const outDir = __dirname;

const navItems = ['地盘', '产品', '项目', '执行', '测试', 'DevOps'];
const appItems = ['AI', 'BI', '看板', '文档'];
const settingItems = ['组织', '后台'];

const css = String.raw`
:root{--bg0:#050812;--bg1:#070b17;--bg2:#0b1024;--surface:rgba(31,35,64,.56);--surface2:rgba(38,43,78,.7);--soft:rgba(22,27,50,.36);--line:rgba(178,190,255,.18);--line2:rgba(198,207,255,.28);--text:#f4f7ff;--muted:#aab3d2;--muted2:#7680aa;--primary:#6264f4;--primary2:#7991ff;--blue:#5f9bff;--green:#18c99b;--yellow:#f3b73c;--red:#ff4f7a;--shadow:0 26px 80px rgba(0,0,0,.42);--glass:blur(22px) saturate(130%);font-family:Inter,"PingFang SC","Microsoft YaHei",system-ui,sans-serif;color-scheme:dark}
*{box-sizing:border-box}html{background:var(--bg0)}body{margin:0;min-width:1280px;min-height:100vh;color:var(--text);background:radial-gradient(circle at 8% 0%,rgba(31,77,123,.34),transparent 30%),radial-gradient(circle at 52% -12%,rgba(99,102,241,.28),transparent 34%),radial-gradient(circle at 94% 6%,rgba(42,32,96,.28),transparent 35%),radial-gradient(circle at 72% 56%,rgba(55,74,148,.16),transparent 44%),linear-gradient(135deg,#08151d 0%,var(--bg1) 38%,var(--bg2) 68%,var(--bg0) 100%);overflow-x:auto}body:before,body:after{content:"";position:fixed;inset:0;pointer-events:none;z-index:0}body:before{background:linear-gradient(90deg,rgba(255,255,255,.045) 1px,transparent 1px),linear-gradient(180deg,rgba(255,255,255,.035) 1px,transparent 1px);background-size:96px 96px;mask-image:linear-gradient(180deg,rgba(0,0,0,.55),transparent 64%);opacity:.35}body:after{background:radial-gradient(ellipse at 58% 18%,rgba(255,255,255,.08),transparent 18%),linear-gradient(180deg,rgba(255,255,255,.035),transparent 26%,rgba(0,0,0,.28));mix-blend-mode:screen;opacity:.44}button{border:0;color:inherit;font:inherit;cursor:pointer}h1,h2,h3,p{margin:0}a{color:inherit;text-decoration:none}
.app{position:relative;z-index:1;display:grid;grid-template-columns:250px minmax(1030px,1fr);min-height:100vh;padding-bottom:58px}.sidebar{position:sticky;top:0;height:calc(100vh - 58px);padding:30px 18px 24px;overflow-y:auto;background:linear-gradient(180deg,rgba(40,45,78,.84),rgba(27,32,57,.68)),radial-gradient(circle at 16% 5%,rgba(103,107,255,.18),transparent 32%);border-right:1px solid rgba(202,211,255,.1);box-shadow:22px 0 54px rgba(0,0,0,.22);backdrop-filter:var(--glass)}.brand{display:flex;align-items:center;gap:12px;margin:6px 10px 38px;font-size:22px;font-weight:850}.brand-mark{width:34px;height:34px;display:grid;place-items:center;border-radius:10px;background:linear-gradient(135deg,#5f75ff,#704dff);box-shadow:inset 0 0 0 2px rgba(255,255,255,.18);font-size:14px}.nav-section{margin:0 0 32px}.nav-title{display:flex;justify-content:space-between;padding:0 14px 12px;color:#8b94b6;font-size:13px;font-weight:850;letter-spacing:.04em;text-transform:uppercase}.nav-item{min-height:48px;display:flex;align-items:center;gap:14px;padding:0 14px;margin:4px 0;color:#b9c2df;border-radius:12px;font-size:18px;font-weight:700}.nav-item.active{color:#fff;background:linear-gradient(90deg,rgba(101,119,255,.82),rgba(92,127,183,.66));box-shadow:0 10px 24px rgba(81,98,255,.22)}.nav-icon{width:24px;text-align:center;opacity:.9}
.main{padding:32px 36px 140px;min-width:0}.topbar{height:58px;display:flex;align-items:center;gap:22px;margin-bottom:42px}.search-top{width:380px;height:48px;display:flex;align-items:center;gap:12px;padding:0 18px;border-radius:8px;color:#cbd3ee;background:rgba(42,48,84,.58);border:1px solid rgba(198,207,255,.13);box-shadow:inset 0 1px 0 rgba(255,255,255,.07),0 18px 42px rgba(0,0,0,.22);backdrop-filter:var(--glass);font-size:18px}.top-actions{margin-left:auto;display:flex;align-items:center;gap:16px}.icon-btn,.primary-btn,.ghost-btn,.filter,.small-btn,.select{height:48px;display:inline-flex;align-items:center;justify-content:center;gap:10px;border-radius:10px;background:rgba(44,51,92,.72);box-shadow:inset 0 1px 0 rgba(255,255,255,.08),0 14px 34px rgba(0,0,0,.24);backdrop-filter:var(--glass);font-weight:850}.icon-btn{width:48px}.primary-btn{padding:0 22px;background:linear-gradient(135deg,#6366f1,#6d6cff);box-shadow:0 14px 28px rgba(98,100,244,.26)}.ghost-btn{padding:0 18px}.small-btn{height:36px;padding:0 14px}.avatar{width:40px;height:40px;display:grid;place-items:center;border-radius:50%;color:#102135;background:#b5d777;font-size:20px;font-weight:900;box-shadow:0 0 0 3px rgba(255,255,255,.08)}.user{display:flex;align-items:center;gap:12px;font-weight:750}.crumbs{display:flex;gap:10px;margin-bottom:14px;color:#ccd4ef;font-size:13px;font-weight:750}.hero{display:flex;align-items:flex-end;justify-content:space-between;gap:28px;margin-bottom:28px}.hero h1{font-size:36px;line-height:1.15}.subtitle{margin-top:8px;color:var(--muted);font-size:16px;line-height:1.55}
.panel,.metric,.card,.lane,.detail-block{position:relative;overflow:hidden;background:linear-gradient(180deg,rgba(42,47,83,.62),rgba(24,29,53,.46)),radial-gradient(circle at 12% 0%,rgba(255,255,255,.08),transparent 28%);border:1px solid var(--line);border-radius:12px;box-shadow:var(--shadow),inset 0 1px 0 rgba(255,255,255,.06);backdrop-filter:var(--glass)}.panel:before,.metric:before,.card:before,.lane:before,.detail-block:before{content:"";position:absolute;inset:0;border-radius:inherit;pointer-events:none;background:linear-gradient(135deg,rgba(255,255,255,.1),transparent 32%,rgba(100,103,244,.07));opacity:.5}.panel>*,.metric>*,.card>*,.lane>*,.detail-block>*{position:relative;z-index:1}.metrics{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin-bottom:24px}.metric{padding:20px;min-height:112px}.metric .label{color:#8c96bc;font-size:13px;font-weight:900;text-transform:uppercase}.metric .value{margin-top:18px;font-size:28px;font-weight:900}.metric .hint{position:absolute;right:20px;top:20px;color:var(--green);font-weight:900}.toolbar{display:flex;align-items:center;justify-content:space-between;gap:18px;margin-bottom:22px}.filters,.actions{display:flex;align-items:center;gap:12px;flex-wrap:wrap}.filter{height:38px;padding:0 14px;color:#c8d1ef;background:rgba(35,41,74,.54);border:1px solid rgba(178,190,255,.13)}.filter.active{color:#07101f;background:#6970ff}.filter .count{height:20px;min-width:22px;padding:0 7px;display:inline-grid;place-items:center;border-radius:999px;background:#101628;color:#fff;font-size:12px}.disabled{opacity:.42}
.panel{padding:0}.panel.pad{padding:28px}.panel-head{display:flex;align-items:center;justify-content:space-between;gap:16px;margin-bottom:24px}.panel-title{font-size:21px;font-weight:900}.caption{margin-top:6px;color:var(--muted2);font-size:14px;font-weight:650;line-height:1.55}.table-wrap{overflow-x:auto}.data-table{width:100%;min-width:1120px;border-collapse:separate;border-spacing:0;color:#d9def2;font-size:15px}.data-table th{height:54px;background:rgba(60,66,112,.62);color:#e8edff;text-align:left;font-size:13px;text-transform:uppercase;border-bottom:1px solid var(--line2);font-weight:900}.data-table td{height:64px;border-bottom:1px solid rgba(154,170,226,.12);background:rgba(20,25,47,.18)}.data-table th,.data-table td{padding:0 16px;border-right:1px solid rgba(178,190,255,.12)}.data-table th:first-child,.data-table td:first-child{padding-left:20px}.check{width:18px;height:18px;border:2px solid #aeb7d9;border-radius:5px;display:inline-grid;place-items:center;color:#fff;font-size:11px}.name-main{font-weight:900;color:#eaf0ff}.name-sub{margin-top:4px;color:var(--muted2);font-size:12px}.num{text-align:center;font-variant-numeric:tabular-nums}.status{height:28px;display:inline-flex;align-items:center;padding:0 12px;border-radius:999px;color:var(--green);background:rgba(24,201,155,.14);font-size:12px;font-weight:900}.status.warn{color:var(--yellow);background:rgba(243,183,60,.16)}.status.danger{color:var(--red);background:rgba(255,79,122,.16)}.status.info{color:var(--primary2);background:rgba(99,102,241,.18)}.owner{display:flex;align-items:center;gap:8px;font-weight:850}.mini-avatar{width:32px;height:32px;display:grid;place-items:center;border-radius:50%;background:#74ca8b;color:#102135;font-weight:900}.progress{display:inline-flex;align-items:center;gap:10px}.track{width:54px;height:6px;border-radius:999px;background:rgba(237,242,251,.22);overflow:hidden}.fill{display:block;height:100%;border-radius:inherit;background:linear-gradient(90deg,var(--primary),var(--blue))}.footer-row{height:54px;display:flex;align-items:center;justify-content:space-between;padding:0 20px;color:var(--primary2);background:rgba(60,66,112,.45);border-top:1px solid rgba(178,190,255,.14);font-weight:850}.pager{display:flex;align-items:center;gap:18px;color:#7f8bb8}
.board{display:grid;grid-template-columns:repeat(4,minmax(240px,1fr));gap:16px;margin-bottom:30px}.lane{min-height:620px;padding:16px}.lane-head{height:64px;margin:-16px -16px 16px;display:flex;align-items:center;justify-content:space-between;padding:0 18px;border-bottom:1px solid var(--line2);background:rgba(60,66,112,.58);font-size:18px;font-weight:900}.lane-stack{display:grid;gap:14px}.card{padding:18px;min-height:142px}.card-top{display:flex;justify-content:space-between;gap:14px}.card-title{font-size:17px;font-weight:900}.card-sub{margin-top:5px;color:var(--muted2);font-size:12px;font-weight:750}.card-meta{display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin-top:14px;color:#dce4ff;font-weight:750}.card p{margin-top:14px;color:var(--muted);font-size:14px;line-height:1.5}
.grid-2{display:grid;grid-template-columns:1.05fr .95fr;gap:24px;margin-top:28px}.grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-top:28px}.detail-layout{display:grid;grid-template-columns:1.35fr .65fr;gap:24px}.detail-block{padding:28px;margin-bottom:24px}.kv{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-top:20px}.kv-item{padding:16px;border-radius:10px;background:rgba(18,23,44,.42);border:1px solid rgba(178,190,255,.13)}.kv-label{color:var(--muted2);font-size:12px;font-weight:850;text-transform:uppercase}.kv-value{margin-top:8px;font-size:18px;font-weight:900}.timeline{display:grid;gap:18px;margin-top:20px}.time-item{display:grid;grid-template-columns:82px 1fr;gap:18px}.time{color:var(--primary2);font-weight:900}.time-body{padding-left:18px;border-left:1px solid rgba(178,190,255,.18)}.time-body strong{display:block;margin-bottom:6px}.time-body span{color:var(--muted);font-size:14px;line-height:1.55}.rich{color:#dbe2f8;line-height:1.75}.rich h3{margin:22px 0 10px;font-size:18px}.rich ul{margin:10px 0 0 20px;color:var(--muted)}.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px}.field{display:grid;gap:8px}.field.full{grid-column:1/-1}.label{color:#bfc8e8;font-weight:850}.input,.textarea,.selectbox{min-height:46px;padding:12px 14px;border-radius:10px;background:rgba(18,23,44,.48);border:1px solid rgba(178,190,255,.16);color:#eaf0ff}.textarea{min-height:150px;line-height:1.65}.tree-layout{display:grid;grid-template-columns:280px 1fr;gap:24px}.tree{padding:20px}.tree-item{height:40px;display:flex;align-items:center;gap:10px;padding:0 12px;border-radius:9px;color:#c7d0ea;font-weight:750}.tree-item.active{background:rgba(99,102,241,.22);color:#fff}.doc-body{padding:34px;min-height:620px}.doc-title{font-size:32px;font-weight:900}.doc-meta{margin:10px 0 26px;color:var(--muted2)}.module-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:18px}.module-card{padding:20px;border-radius:12px;background:rgba(18,23,44,.42);border:1px solid rgba(178,190,255,.13)}.module-card h3{font-size:17px}.module-card p{margin-top:8px;color:var(--muted);font-size:14px;line-height:1.55}.switch{width:44px;height:24px;border-radius:999px;background:rgba(99,102,241,.8);position:relative}.switch:after{content:"";position:absolute;right:3px;top:3px;width:18px;height:18px;border-radius:50%;background:#fff}.switch.off{background:rgba(118,128,170,.36)}.switch.off:after{left:3px;right:auto}
.bottom-bar{position:fixed;left:0;right:0;bottom:0;z-index:10;height:58px;display:grid;grid-template-columns:250px 1fr 560px;align-items:center;color:#c7d0ea;background:rgba(13,20,34,.82);border-top:1px solid rgba(255,255,255,.08);backdrop-filter:blur(18px) saturate(130%);font-weight:850}.bottom-left,.bottom-center,.bottom-right{height:100%;display:flex;align-items:center;gap:18px;padding:0 24px}.bottom-left{justify-content:center;color:#8190ff;background:rgba(17,28,49,.78)}.bottom-right{justify-content:flex-end}.mini-search{width:220px;height:36px;display:flex;align-items:center;gap:10px;padding:0 14px;border-radius:8px;color:#7884aa;background:#edf2fb;font-weight:750}
@media(max-width:1400px){.metrics,.grid-3,.module-grid{grid-template-columns:repeat(2,1fr)}.grid-2,.detail-layout{grid-template-columns:1fr}.board{grid-template-columns:repeat(2,1fr)}}`;

function activeFor(type) {
  if (['项目'].includes(type)) return '项目';
  if (['执行'].includes(type)) return '执行';
  if (['测试'].includes(type)) return '测试';
  if (['文档'].includes(type)) return '文档';
  if (['看板'].includes(type)) return '看板';
  if (['后台'].includes(type)) return '后台';
  if (['需求', '任务', 'Bug', '表单'].includes(type)) return type === 'Bug' ? '测试' : '执行';
  return type;
}

function sidebar(active) {
  const row = (item, icon = '◌') => `<div class="nav-item ${item === active ? 'active' : ''}"><span class="nav-icon">${icon}</span>${item}</div>`;
  return `<aside class="sidebar">
    <div class="brand"><span class="brand-mark">◎</span>LucenAI</div>
    <div class="nav-section"><div class="nav-title"><span>Pages</span><span>+</span></div>${navItems.map((n, i) => row(n, ['⌂','◌','△','⌁','∞','∞'][i])).join('')}</div>
    <div class="nav-section"><div class="nav-title"><span>Apps</span><span>+</span></div>${appItems.map((n, i) => row(n, ['□','▣','☷','▤'][i])).join('')}</div>
    <div class="nav-section"><div class="nav-title"><span>Settings</span></div>${settingItems.map((n, i) => row(n, ['☷','⚙'][i])).join('')}</div>
  </aside>`;
}

function shell(page) {
  const active = activeFor(page.type);
  return `<!doctype html><html lang="zh-CN"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1" /><title>LucenAI ${page.type}${page.subtype}</title><style>${css}</style></head><body>
  <div class="app">${sidebar(active)}<main class="main">
    <header class="topbar"><div class="search-top">⌕ <span>搜索${page.type}、负责人、状态、编号...</span></div><div class="top-actions"><button class="icon-btn">●</button><button class="icon-btn">!</button><button class="primary-btn">＋ 新建${page.type}</button><div class="user"><span class="avatar">A</span><span>admin</span><span style="color:#6e789f">⌄</span></div></div></header>
    <section class="hero"><div><div class="crumbs"><span>${page.type}</span><span>›</span><span>${page.subtype}</span></div><h1>${page.type}${page.subtype}</h1><p class="subtitle">${page.subtitle}</p></div><button class="ghost-btn">${page.heroAction || '视图设置'} ⌄</button></section>
    ${page.content}
  </main></div><footer class="bottom-bar"><div class="bottom-left">▣ 研发综合界面 ⌃</div><div class="bottom-center">地盘 <span>${page.type}</span></div><div class="bottom-right"><div class="mini-search">⌕ 搜索</div><span>●</span><span style="background:#202a4b;border-radius:8px;padding:8px 14px">开源版22.1</span><span>升级 ↑</span></div></footer>
  </body></html>`;
}

const rows = {
  项目: [
    ['CodeManager 重构', 'admin', 'Data Platform', '84%', '2026/05/18', '高', '进行中'],
    ['LucenAI 工作台', 'lucen', 'LucenAI', '66%', '2026/05/28', '中', '关注'],
    ['RAG 知识系统', 'knowledge', 'RAG-KOS', '58%', '2026/06/02', '中', '评审'],
    ['暗色设计系统', 'ui-team', 'UI-DS', '91%', '2026/05/12', '低', '正常'],
  ],
  执行: [
    ['前端壳层适配', 'admin', 'CodeManager', '31', '58%', '2026/05/10', '执行中'],
    ['产品列表改造', 'admin', 'Data Platform', '18', '76%', '2026/05/07', '进行中'],
    ['文档中心重绘', 'doc-team', 'Knowledge OS', '14', '42%', '2026/05/15', '待处理'],
    ['测试流转联调', 'qa', 'LucenAI', '21', '64%', '2026/05/20', '关注'],
  ],
  需求: [
    ['统一深色表格规范', 'admin', 'CodeManager', '高', '评审中', 'UI-DS', '进行中'],
    ['产品看板信息密度优化', 'lucen', 'Data Platform', '中', '激活', 'PLAN-22', '进行中'],
    ['知识库摄取流程', 'knowledge', 'RAG-KOS', '高', '草稿', 'PLAN-23', '待评审'],
    ['后台安全策略可视化', 'security', 'Admin', '中', '变更中', 'PLAN-24', '关注'],
  ],
  任务: [
    ['生成核心页面 HTML', 'admin', '前端', '8h', '76%', '2026/04/30', '进行中'],
    ['补齐详情页组件', 'lucen', '前端', '6h', '58%', '2026/05/02', '待处理'],
    ['Playwright 截图验收', 'qa', '测试', '4h', '32%', '2026/05/03', '未开始'],
    ['同步设计 token', 'ui-team', '设计', '5h', '91%', '2026/05/01', '正常'],
  ],
  Bug: [
    ['产品列表横向溢出', 'admin', '严重', '高', '激活', 'CSS', '待修复'],
    ['底部栏遮挡表格分页', 'qa', '一般', '中', '已解决', '布局', '待验证'],
    ['弹窗按钮仍为白底', 'ui-team', '严重', '高', '激活', '按钮', '待修复'],
    ['文档详情目录对比度低', 'doc-team', '轻微', '低', '确认中', '文档', '处理中'],
  ],
  用例: [
    ['登录后进入地盘', 'qa', 'P1', '自动化', '通过', '地盘', '95%'],
    ['产品列表筛选未关闭', 'qa', 'P1', '手工', '通过', '产品', '88%'],
    ['Bug 详情查看复现步骤', 'qa', 'P2', '手工', '失败', '测试', '64%'],
    ['文档详情版本切换', 'doc-team', 'P2', '自动化', '阻塞', '文档', '52%'],
  ]
};

function metrics(items = [['全部', '24', '+6'], ['进行中', '12', '+18%'], ['风险', '3', '关注'], ['完成率', '76%', '+8%']]) {
  return `<section class="metrics">${items.map(([label, value, hint], i) => `<article class="metric"><div class="label">${label}</div><div class="hint" style="${String(hint).includes('风险') || String(hint).includes('关注') ? 'color:var(--yellow)' : ''}">${hint}</div><div class="value">${value}</div></article>`).join('')}</section>`;
}

function toolbar(filters = ['全部', '未关闭', '我负责', '有风险']) {
  return `<div class="toolbar"><div class="filters">${filters.map((f, i) => `<span class="filter ${i === 1 ? 'active' : ''}">${f}${i === 1 ? ' <span class="count">4</span>' : ''}</span>`).join('')}</div><div class="actions"><button class="ghost-btn">⇧ 导出</button><button class="primary-btn">＋ 新建</button></div></div>`;
}

function listPage(type, subtype, subtitle, headings, data, metricItems) {
  return {
    type, subtype, subtitle,
    content: `${metrics(metricItems)}${toolbar()}<section class="panel"><div class="table-wrap"><table class="data-table"><thead><tr><th><span class="check">✓</span></th>${headings.map(h => `<th>${h}</th>`).join('')}<th>操作</th></tr></thead><tbody>${data.map((r, i) => `<tr><td><span class="check">✓</span></td>${r.map((c, j) => {
      if (j === 0) return `<td><div class="name-main">${c}</div><div class="name-sub">${type}-${String(i + 1).padStart(3, '0')}</div></td>`;
      if (j === 1) return `<td><div class="owner"><span class="mini-avatar">${String(c)[0].toUpperCase()}</span>${c}</div></td>`;
      if (String(c).includes('%')) return `<td class="num"><span class="progress">${c}<span class="track"><span class="fill" style="width:${c}"></span></span></span></td>`;
      if (['正常','进行中','执行中','待处理','待修复','待验证','关注','评审','待评审','未开始','处理中','激活','已解决','确认中','通过','失败','阻塞'].includes(c)) return `<td><span class="status ${['关注','待处理','待评审','确认中','阻塞'].includes(c) ? 'warn' : ['待修复','失败'].includes(c) ? 'danger' : ''}">${c}</span></td>`;
      return `<td class="${/^\d+$/.test(String(c)) ? 'num' : ''}">${c}</td>`;
    }).join('')}<td><button class="small-btn">详情</button></td></tr>`).join('')}</tbody></table></div><div class="footer-row"><span>共 ${data.length} 项</span><div class="pager"><span>每页 20 项</span><span>1/1</span><span>‹</span><span>›</span></div></div></section>${insights(type)}`,
  };
}

function boardPage(type, subtype, subtitle, lanes) {
  return {
    type, subtype, subtitle,
    content: `${metrics()}${toolbar(['全部','我负责','本周','有风险'])}<section class="board">${lanes.map(l => `<div class="lane"><div class="lane-head"><span>${l.name}</span><span class="status info">${l.cards.length}</span></div><div class="lane-stack">${l.cards.map(c => `<article class="card"><div class="card-top"><div><div class="card-title">${c.title}</div><div class="card-sub">${c.code}</div></div><span class="status ${c.statusClass || ''}">${c.status}</span></div><div class="card-meta"><span class="mini-avatar">${c.owner[0].toUpperCase()}</span>${c.owner}<span>·</span><span>${c.date}</span></div><p>${c.desc}</p><div class="card-meta"><span class="progress">${c.progress}<span class="track"><span class="fill" style="width:${c.progress}"></span></span></span></div></article>`).join('')}</div></div>`).join('')}</section>${insights(type)}`,
  };
}

function detailPage(type, subtype, subtitle, title, blocks = []) {
  const defaultBlocks = blocks.length ? blocks : ['目标与范围', '验收标准', '关联对象'];
  return {
    type, subtype, subtitle, heroAction: '更多操作',
    content: `<section class="detail-layout"><div>
      <article class="detail-block"><div class="panel-head"><div><h2 class="panel-title">${title}</h2><p class="caption">${type}编号 ${type.toUpperCase()}-2026-001 · 负责人 admin · 更新时间 2026/04/28</p></div><span class="status">进行中</span></div><div class="kv"><div class="kv-item"><div class="kv-label">进度</div><div class="kv-value">76%</div></div><div class="kv-item"><div class="kv-label">优先级</div><div class="kv-value">高</div></div><div class="kv-item"><div class="kv-label">截止日期</div><div class="kv-value">2026/05/18</div></div></div></article>
      <article class="detail-block rich">${defaultBlocks.map((b, i) => `<h3>${b}</h3><p>${detailCopy(type, i)}</p>${i === 1 ? '<ul><li>关键路径清晰，状态变化可追踪。</li><li>表格、按钮、弹窗在深色背景下保持可读。</li><li>所有关联对象保留可进入详情的操作。</li></ul>' : ''}`).join('')}</article>
      <article class="panel"><div class="table-wrap"><table class="data-table"><thead><tr><th>关联项</th><th>负责人</th><th>状态</th><th>进度</th></tr></thead><tbody>${['需求拆分','任务实现','Bug 验证','文档同步'].map((n, i) => `<tr><td><div class="name-main">${n}</div><div class="name-sub">REL-${i + 1}</div></td><td><div class="owner"><span class="mini-avatar">A</span>admin</div></td><td><span class="status ${i === 2 ? 'warn' : ''}">${i === 2 ? '待处理' : '进行中'}</span></td><td><span class="progress">${[84,66,42,91][i]}%<span class="track"><span class="fill" style="width:${[84,66,42,91][i]}%"></span></span></span></td></tr>`).join('')}</tbody></table></div></article>
    </div><aside><article class="detail-block"><h2 class="panel-title">近期动态</h2><div class="timeline">${['创建并分配负责人','完成第一轮评审','补充验收标准','等待最终确认'].map((n, i) => `<div class="time-item"><span class="time">${['09:20','11:45','15:30','17:10'][i]}</span><div class="time-body"><strong>${n}</strong><span>系统记录来自 admin 的操作，保持后续审计可追踪。</span></div></div>`).join('')}</div></article></aside></section>`,
  };
}

function detailCopy(type, i) {
  const copies = {
    项目: ['项目聚焦 CodeManager 的核心体验改造，覆盖地盘、产品、执行和测试工作流。', '项目验收以截图一致性、页面完整性和操作入口可识别为准。', '关联产品 Data Platform，关联执行前端壳层适配和暗色组件库。'],
    执行: ['执行围绕一个迭代周期组织任务、需求、Bug 和测试反馈。', '燃尽图、任务看板、风险提醒必须同时可见。', '关联 CodeManager 项目和 LucenAI 工作台产品。'],
    需求: ['需求描述业务背景、用户目标、范围边界和验收口径。', '评审通过后进入计划，并自动拆分任务。', '关联任务、Bug、用例和产品计划。'],
    任务: ['任务说明实现目标、工作拆分和交付结果。', '工时记录、子任务和状态流转必须清晰。', '关联需求、提交、Bug 和文档。'],
    Bug: ['Bug 详情记录复现环境、步骤、实际结果和期望结果。', '解决后需要测试验证并保留修复记录。', '关联影响版本、用例和代码提交。'],
  };
  return (copies[type] || ['该页面用于承载核心对象的完整信息。', '验收关注可读性、状态反馈和关联对象。', '关联业务对象以表格和时间线呈现。'])[i];
}

function insights(type) {
  return `<section class="grid-2"><article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">${type}洞察</h2><p class="caption">用于辅助负责人快速判断当前优先级。</p></div></div><div class="timeline"><div class="time-item"><span class="time">今日</span><div class="time-body"><strong>高优先级事项集中</strong><span>建议优先处理风险、阻塞和即将到期项。</span></div></div><div class="time-item"><span class="time">本周</span><div class="time-body"><strong>完成率稳步提升</strong><span>主要收益来自统一页面结构和可复用设计组件。</span></div></div></div></article><article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">建议动作</h2><p class="caption">保持与 LucenAI 地盘首页一致的交互语言。</p></div></div><div class="module-grid" style="grid-template-columns:repeat(2,1fr)"><div class="module-card"><h3>补齐状态</h3><p>缺少负责人或截止日期的事项需要优先补全。</p></div><div class="module-card"><h3>同步文档</h3><p>关键决策沉淀到文档空间，方便团队复盘。</p></div></div></article></section>`;
}

function docSpacePage(type, subtype, subtitle) {
  return {type, subtype, subtitle, content: `${metrics([['空间', '4', '+1'], ['文档', '128', '+18'], ['收藏', '32', '+6'], ['本周更新', '24', '+9']])}<section class="grid-3">${['个人空间','产品空间','项目空间','团队空间','API 文档','模板中心'].map((n,i)=>`<article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">${n}</h2><p class="caption">${['我的草稿、收藏和最近访问','产品需求、计划和发布说明','项目章程、会议纪要和交付件','团队规范、流程和知识库','接口结构、调试记录和版本','PRD、测试报告和复盘模板'][i]}</p></div><span class="status ${i===5?'warn':''}">${[18,32,26,41,8,12][i]} 篇</span></div></article>`).join('')}</section>`};
}

function docListPage() {
  return {type:'文档', subtype:'文档列表', subtitle:'左侧目录树与右侧文档列表并列，适合浏览团队知识库。', content: `<section class="tree-layout"><aside class="panel tree">${['全部文档','产品文档','项目文档','测试报告','后台规范','收藏'].map((n,i)=>`<div class="tree-item ${i===0?'active':''}">▤ ${n}</div>`).join('')}</aside><section class="panel"><div class="table-wrap"><table class="data-table"><thead><tr><th>文档标题</th><th>空间</th><th>作者</th><th>更新时间</th><th>状态</th><th>操作</th></tr></thead><tbody>${['地盘主页改造说明','产品列表设计规范','Bug 处理流程','后台安全策略','测试用例模板'].map((n,i)=>`<tr><td><div class="name-main">${n}</div><div class="name-sub">DOC-${i+1}</div></td><td>${['产品空间','产品空间','测试空间','后台空间','模板中心'][i]}</td><td><div class="owner"><span class="mini-avatar">A</span>admin</div></td><td>2026/04/${28-i}</td><td><span class="status ${i===3?'warn':''}">${i===3?'待评审':'已更新'}</span></td><td><button class="small-btn">打开</button></td></tr>`).join('')}</tbody></table></div></section></section>`};
}

function docDetailPage() {
  return {type:'文档', subtype:'文档详情', subtitle:'文档阅读页包含目录、正文、版本、附件和评论区。', content: `<section class="tree-layout"><aside class="panel tree">${['概览','设计原则','组件规范','验收清单','评论'].map((n,i)=>`<div class="tree-item ${i===0?'active':''}"># ${n}</div>`).join('')}</aside><article class="panel doc-body"><div class="doc-title">LucenAI 暗色前端设计规范</div><div class="doc-meta">作者 admin · 更新于 2026/04/28 · 版本 v1.3</div><div class="rich"><h3>设计目标</h3><p>所有核心业务页面统一为蓝紫深色玻璃风格，保持低对比边框、透明层次和稳定的信息密度。</p><h3>组件要求</h3><ul><li>列表页必须包含筛选、指标、表格和分页。</li><li>看板页必须包含列、卡片、状态和负责人。</li><li>详情页必须包含概览、关联对象和时间线。</li></ul><h3>附件</h3><p><span class="status info">dashboard-reference.png</span> <span class="status info">product-list.png</span></p></div></article></section>`};
}

function kanbanSpacePage() {
  return {type:'看板', subtype:'空间', subtitle:'展示团队看板空间、最近访问、成员和卡片统计。', content: `${metrics([['空间', '6', '+2'], ['看板', '18', '+5'], ['卡片', '246', '+41'], ['WIP 告警', '3', '关注']])}<section class="grid-3">${['研发流程','产品规划','测试验证','发布准备','后台配置','知识沉淀'].map((n,i)=>`<article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">${n}</h2><p class="caption">${[42,36,28,19,17,31][i]} 张卡片 · ${[6,5,4,3,4,8][i]} 名成员</p></div><span class="status ${i===2?'warn':''}">${i===2?'关注':'正常'}</span></div><div class="module-grid" style="grid-template-columns:repeat(2,1fr)"><div class="module-card"><h3>进行中</h3><p>${[12,9,7,5,4,8][i]} 张</p></div><div class="module-card"><h3>已完成</h3><p>${[24,18,14,9,7,16][i]} 张</p></div></div></article>`).join('')}</section>`};
}

function adminPage(type, subtype, subtitle, kind) {
  const modules = kind === '安全设置'
    ? ['密码复杂度','登录失败锁定','弱口令检查','SSO 登录','IP 白名单','操作审计','会话超时','二次验证']
    : kind === '模块配置'
      ? ['产品','项目','执行','测试','文档','看板','DevOps','AI 助手']
      : ['系统信息','安全中心','模块配置','用户权限','通知服务','备份策略','升级检查','日志审计'];
  return {type, subtype, subtitle, content: `${metrics([['健康度','92%','正常'],['安全提醒','3','关注'],['启用模块','8','+2'],['在线用户','12','+4']])}<section class="panel pad"><div class="panel-head"><div><h2 class="panel-title">${subtype}</h2><p class="caption">后台页面采用更高密度的配置卡片和状态开关，便于管理员快速扫描。</p></div></div><div class="module-grid">${modules.map((n,i)=>`<div class="module-card"><div style="display:flex;justify-content:space-between;align-items:center;gap:16px"><h3>${n}</h3><span class="switch ${i===2&&kind==='安全设置'?'off':''}"></span></div><p>${adminCopy(n)}</p></div>`).join('')}</div></section>${insights('后台')}`};
}

function adminCopy(n){return `${n} 当前已纳入 LucenAI 管理后台统一配置视图，支持状态查看、快速进入和风险提示。`;}

function formPage() {
  return {type:'表单', subtype:'创建编辑通用', subtitle:'覆盖产品、项目、执行、需求、任务、Bug、文档等创建编辑场景。', heroAction:'保存模板', content: `<section class="detail-layout"><article class="panel pad"><div class="panel-head"><div><h2 class="panel-title">创建 / 编辑对象</h2><p class="caption">统一表单样式：深色输入、清晰标签、强焦点、底部操作。</p></div><span class="status info">Draft</span></div><div class="form-grid"><div class="field"><div class="label">名称</div><div class="input">仪表盘暗色适配</div></div><div class="field"><div class="label">负责人</div><div class="selectbox">admin</div></div><div class="field"><div class="label">所属产品</div><div class="selectbox">Data Platform</div></div><div class="field"><div class="label">优先级</div><div class="selectbox">高</div></div><div class="field"><div class="label">开始日期</div><div class="input">2026/04/28</div></div><div class="field"><div class="label">截止日期</div><div class="input">2026/05/18</div></div><div class="field full"><div class="label">描述 / 富文本</div><div class="textarea">补齐业务背景、实现范围、验收标准和附件说明。文本区域在深色背景下保持足够对比，并为工具栏预留空间。</div></div><div class="field full"><div class="label">附件</div><div class="input">＋ 上传截图、设计稿或需求文档</div></div></div><div class="actions" style="margin-top:24px;justify-content:flex-end"><button class="ghost-btn">取消</button><button class="primary-btn">保存</button></div></article><aside><article class="detail-block"><h2 class="panel-title">表单规范</h2><div class="timeline"><div class="time-item"><span class="time">01</span><div class="time-body"><strong>标签始终可见</strong><span>不依赖 placeholder 作为唯一说明。</span></div></div><div class="time-item"><span class="time">02</span><div class="time-body"><strong>状态反馈明确</strong><span>错误、必填和禁用状态必须有颜色与文字双重提示。</span></div></div><div class="time-item"><span class="time">03</span><div class="time-body"><strong>操作区固定语义</strong><span>主按钮只保留一个，取消和更多操作弱化。</span></div></div></div></article></aside></section>`};
}

const lanes = {
  project: [
    {name:'规划中', cards:[{title:'RAG 知识系统',code:'PRJ-003',owner:'knowledge',date:'06/02',status:'评审',statusClass:'warn',progress:'58%',desc:'知识库摄取流程与 Wiki 发布链路。'}]},
    {name:'进行中', cards:[{title:'CodeManager 重构',code:'PRJ-001',owner:'admin',date:'05/18',status:'健康',progress:'84%',desc:'公共壳层、地盘、产品、执行页面改造。'},{title:'LucenAI 工作台',code:'PRJ-002',owner:'lucen',date:'05/28',status:'关注',statusClass:'warn',progress:'66%',desc:'AI 工作台和知识入口融合。'}]},
    {name:'验收中', cards:[{title:'暗色组件库',code:'PRJ-004',owner:'ui-team',date:'05/12',status:'正常',progress:'91%',desc:'按钮、表格、弹窗、表单统一。'}]},
    {name:'已完成', cards:[{title:'产品原型第一轮',code:'PRJ-000',owner:'admin',date:'04/28',status:'完成',progress:'100%',desc:'产品列表和产品看板效果稿。'}]},
  ],
  execution: [
    {name:'待处理', cards:[{title:'补齐详情页组件',code:'TASK-021',owner:'lucen',date:'05/02',status:'待处理',statusClass:'warn',progress:'12%',desc:'详情页概览、关联对象和时间线。'}]},
    {name:'进行中', cards:[{title:'生成核心页面 HTML',code:'TASK-018',owner:'admin',date:'04/30',status:'进行中',progress:'76%',desc:'批量生成核心闭环页面。'},{title:'产品列表改造',code:'TASK-014',owner:'admin',date:'05/07',status:'进行中',progress:'66%',desc:'复杂表头和分页视觉统一。'}]},
    {name:'待验证', cards:[{title:'Playwright 截图验收',code:'TASK-020',owner:'qa',date:'05/03',status:'验证',statusClass:'warn',progress:'42%',desc:'截图检查空白、遮挡和横向溢出。'}]},
    {name:'已完成', cards:[{title:'地盘主页完整原型',code:'TASK-001',owner:'admin',date:'04/27',status:'完成',progress:'100%',desc:'可滚动主页 HTML 与截图。'}]},
  ],
  kanban: [
    {name:'需求池', cards:[{title:'统一深色表格规范',code:'STORY-001',owner:'admin',date:'05/05',status:'评审',statusClass:'warn',progress:'72%',desc:'列表、分页、筛选、批量操作。'}]},
    {name:'设计中', cards:[{title:'文档详情阅读页',code:'DOC-UI',owner:'doc-team',date:'05/08',status:'进行中',progress:'58%',desc:'目录、正文、版本、评论。'}]},
    {name:'开发中', cards:[{title:'执行看板交互',code:'KAN-002',owner:'ui-team',date:'05/10',status:'进行中',progress:'64%',desc:'列、卡片、WIP 和拖拽状态。'}]},
    {name:'已发布', cards:[{title:'产品看板效果稿',code:'PROD-KAN',owner:'admin',date:'04/28',status:'完成',progress:'100%',desc:'产品生命周期看板。'}]},
  ],
};

const pages = [
  listPage('项目','列表','项目筛选、健康度、负责人、进度、风险和截止时间集中展示。',['项目名称','负责人','关联产品','进度','截止时间','风险','状态'],rows.项目,[['项目总数','12','+3'],['进行中','7','+2'],['高风险','2','关注'],['完成率','76%','+8%']]),
  boardPage('项目','看板','按阶段展示项目卡片，快速识别规划、进行、验收和完成状态。',lanes.project),
  detailPage('项目','详情','项目概览、里程碑、成员、关联产品和近期动态。','CodeManager 前端重构项目'),
  listPage('执行','列表','执行列表、周期、任务数、燃尽状态和风险集中展示。',['执行名称','负责人','所属项目','任务数','进度','截止时间','状态'],rows.执行),
  boardPage('执行','看板','按待处理、进行中、待验证、已完成组织执行任务流。',lanes.execution),
  detailPage('执行','详情','执行概况、燃尽图、任务分布、团队负载和关联需求。','前端壳层适配执行'),
  listPage('需求','列表','需求池表格、状态筛选、优先级、评审状态和关联计划。',['需求名称','负责人','所属产品','优先级','评审状态','关联计划','状态'],rows.需求),
  detailPage('需求','详情','需求描述、验收标准、生命周期、关联任务和 Bug。','统一深色表格规范'),
  listPage('任务','列表','任务表格、负责人、优先级、工时、进度和状态。',['任务名称','负责人','类型','预计工时','进度','截止时间','状态'],rows.任务),
  detailPage('任务','详情','任务说明、工时记录、子任务和操作历史。','生成核心页面 HTML'),
  listPage('Bug','列表','Bug 表格、严重程度、优先级、解决方案和激活状态。',['Bug 标题','负责人','严重程度','优先级','状态','模块','处理状态'],rows.Bug,[['Bug 总数','24','+6'],['激活','9','关注'],['已解决','11','+4'],['修复率','78%','+12%']]),
  detailPage('Bug','详情','复现步骤、影响版本、解决记录、关联用例和提交。','产品列表横向溢出'),
  listPage('测试','用例列表','用例库、场景树、优先级、执行结果和覆盖率。',['用例标题','负责人','优先级','类型','结果','模块','覆盖率'],rows.用例,[['用例','128','+18'],['自动化','64','+9'],['失败','7','关注'],['覆盖率','88%','+6%']]),
  listPage('测试','测试单列表','测试单状态、通过率、失败数、负责人和版本。',['测试单','负责人','版本','用例数','通过率','失败数','状态'],[['LucenAI 22.1 回归','qa','22.1','86','82%','7','进行中'],['产品模块冒烟','qa','22.1','24','95%','1','正常'],['文档中心回归','doc-team','22.1','18','64%','4','关注'],['后台安全测试','security','22.1','31','76%','3','进行中']]),
  detailPage('测试','测试单详情','测试进度、用例执行表、缺陷联动和结果统计。','LucenAI 22.1 回归测试单'),
  docSpacePage('文档','空间首页','个人空间、产品空间、项目空间和团队空间入口。'),
  docListPage(),
  docDetailPage(),
  kanbanSpacePage(),
  boardPage('看板','看板详情','泳道、列、卡片、WIP、标签和成员头像。',lanes.kanban),
  adminPage('后台','首页','系统概览、安全提醒、模块入口和服务状态。','首页'),
  adminPage('后台','安全设置','密码策略、登录限制、弱口令检查和 SSO 状态。','安全设置'),
  adminPage('后台','模块配置','模块开关、导航配置和功能启用状态。','模块配置'),
  formPage(),
];

for (const page of pages) {
  const name = `${page.type}-${page.subtype}.html`;
  fs.writeFileSync(path.join(outDir, name), shell(page), 'utf8');
}

const aliases = [
  ['lucenai-dashboard-effect.html', '地盘-首页.html'],
  ['lucenai-product-board.html', '产品-看板.html'],
  ['lucenai-product-list.html', '产品-列表.html'],
];

for (const [src, dest] of aliases) {
  const srcPath = path.join(outDir, src);
  if (fs.existsSync(srcPath)) fs.copyFileSync(srcPath, path.join(outDir, dest));
}

console.log(`Generated ${pages.length + aliases.length} HTML files in ${outDir}`);
