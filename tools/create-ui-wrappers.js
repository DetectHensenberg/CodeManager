const fs = require('fs');
const path = require('path');
const base = 'd:/Workspace/project/个人项目/CodeManager/app/zentao/module';

// UI wrappers to create: [module, method, viewFile]
const wrappers = [
  ['admin', 'dashboard', 'dashboard'],
  ['admin', 'moduleconfig', 'moduleconfig'],
  ['admin', 'formtemplate', 'formtemplate'],
  ['project', 'browselist', 'browselist'],
  ['project', 'boardview', 'boardview'],
  ['project', 'detail', 'detail'],
  ['execution', 'browselist', 'browselist'],
  ['execution', 'boardview', 'boardview'],
  ['story', 'browselist', 'browselist'],
  ['story', 'detail', 'detail'],
  ['task', 'browselist', 'browselist'],
  ['task', 'detail', 'detail'],
  ['bug', 'browselist', 'browselist'],
  ['bug', 'detail', 'detail'],
  ['testcase', 'browselist', 'browselist'],
  ['testreport', 'browselist', 'browselist'],
  ['testreport', 'detail', 'detail'],
  ['doc', 'spaceindex', 'spaceindex'],
  ['doc', 'browselist', 'browselist'],
  ['doc', 'detail', 'detail'],
  ['kanban', 'spaceindex', 'spaceindex'],
  ['kanban', 'boarddetail', 'boarddetail'],
  ['company', 'index', 'index'],
];

const uiTemplate = (mod, method, viewFile) => `<?php
/**
 * ZIN UI wrapper — CodeManager dark theme.
 * Replaces original ZenTao ui/${method}.html.php.
 */
global $app;
$cmCssFile = $app->getBasePath() . 'www/theme/codemanager/codemanager.css';
if(file_exists($cmCssFile)) {
    echo '<link rel="stylesheet" href="' . $app->getWebRoot() . 'theme/codemanager/codemanager.css?t=' . filemtime($cmCssFile) . '" id="codemanagerCSS">';
}
$zinContext = true;
include dirname(__FILE__, 2) . '/view/${viewFile}.html.php';
`;

let created = 0;
let addedZinCheck = 0;

wrappers.forEach(([mod, method, viewFile]) => {
  // Create UI wrapper
  const uiDir = path.join(base, mod, 'ui');
  const uiFile = path.join(uiDir, method + '.html.php');
  if (!fs.existsSync(uiDir)) fs.mkdirSync(uiDir, { recursive: true });
  fs.writeFileSync(uiFile, uiTemplate(mod, method, viewFile));
  console.log('CREATED: ' + mod + '/ui/' + method + '.html.php');
  created++;

  // Add $zinContext check to view file if not already there
  const viewPath = path.join(base, mod, 'view', viewFile + '.html.php');
  if (fs.existsSync(viewPath)) {
    let content = fs.readFileSync(viewPath, 'utf8');
    if (!content.includes('$zinContext')) {
      // Wrap header include
      content = content.replace(
        /^(<\?php include ['"].*?header\.html\.php['"];\?>)$/m,
        '<?php if (!isset($zinContext)): ?>\n$1\n<?php endif; ?>'
      );
      // Wrap footer include
      content = content.replace(
        /^(<\?php include ['"].*?footer\.html\.php['"];\?>)$/m,
        '<?php if (!isset($zinContext)): ?>\n$1\n<?php endif; ?>'
      );
      fs.writeFileSync(viewPath, content);
      console.log('  +zinContext: ' + mod + '/view/' + viewFile + '.html.php');
      addedZinCheck++;
    }
  }
});

console.log(`\nCreated ${created} UI wrappers, added zinContext to ${addedZinCheck} views`);
