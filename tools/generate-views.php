<?php
/**
 * Generate PHP view files from design prototypes.
 * Extracts <main> content from each design HTML, wraps in PHP header/footer.
 */

$designDir = __DIR__ . '/../output/design/';
$viewsDir  = __DIR__ . '/../app/zentao/module/';

// Map design files to their view paths
$map = [
    '02-后台-首页.html'           => 'admin/view/dashboard.html.php',
    '03-后台-安全设置.html'       => 'admin/view/security.html.php',
    '04-后台-模块配置.html'       => 'admin/view/moduleconfig.html.php',
    '05-产品-列表.html'           => 'product/view/browselist.html.php',
    '07-项目-列表.html'           => 'project/view/browselist.html.php',
    '08-项目-看板.html'           => 'project/view/boardview.html.php',
    '09-项目-详情.html'           => 'project/view/detail.html.php',
    '10-执行-列表.html'           => 'execution/view/browselist.html.php',
    '11-执行-看板.html'           => 'execution/view/boardview.html.php',
    '12-执行-详情.html'           => 'execution/view/detail.html.php',
    '13-需求-列表.html'           => 'story/view/browselist.html.php',
    '14-需求-详情.html'           => 'story/view/detail.html.php',
    '15-任务-列表.html'           => 'task/view/browselist.html.php',
    '16-任务-详情.html'           => 'task/view/detail.html.php',
    '17-Bug-列表.html'            => 'bug/view/browselist.html.php',
    '18-Bug-详情.html'            => 'bug/view/detail.html.php',
    '19-测试-用例列表.html'       => 'testcase/view/browselist.html.php',
    '20-测试-测试单列表.html'     => 'testreport/view/browselist.html.php',
    '21-测试-测试单详情.html'     => 'testreport/view/detail.html.php',
    '22-文档-空间首页.html'       => 'doc/view/spaceindex.html.php',
    '23-文档-文档列表.html'       => 'doc/view/browselist.html.php',
    '24-文档-文档详情.html'       => 'doc/view/detail.html.php',
    '25-看板-空间.html'           => 'kanban/view/spaceindex.html.php',
    '26-看板-看板详情.html'       => 'kanban/view/boarddetail.html.php',
    '27-表单-创建编辑通用.html'   => 'admin/view/formtemplate.html.php',
];

$headerDepth = [
    'admin'     => '../../common/view/header.html.php',
    'product'   => '../../common/view/header.html.php',
    'project'   => '../../common/view/header.html.php',
    'execution'  => '../../common/view/header.html.php',
    'story'     => '../../common/view/header.html.php',
    'task'      => '../../common/view/header.html.php',
    'bug'       => '../../common/view/header.html.php',
    'testcase'  => '../../common/view/header.html.php',
    'testreport' => '../../common/view/header.html.php',
    'doc'       => '../../common/view/header.html.php',
    'kanban'    => '../../common/view/header.html.php',
];

$package = [
    'admin'     => 'admin',
    'product'   => 'product',
    'project'   => 'project',
    'execution' => 'execution',
    'story'     => 'story',
    'task'      => 'task',
    'bug'       => 'bug',
    'testcase'  => 'testcase',
    'testreport'=> 'testreport',
    'doc'       => 'doc',
    'kanban'    => 'kanban',
];

$count = 0;
foreach ($map as $designFile => $viewPath) {
    $designPath = $designDir . $designFile;
    if (!file_exists($designPath)) {
        echo "MISSING: $designFile\n";
        continue;
    }

    $html = file_get_contents($designPath);

    // Extract <main class="main">...</main> content
    if (!preg_match('/<main class="main">(.*?)<\/main>/s', $html, $matches)) {
        echo "NO MAIN: $designFile\n";
        continue;
    }

    $mainContent = $matches[1];

    // Trim whitespace
    $mainContent = trim($mainContent);

    // Extract module name from view path
    preg_match('#^([^/]+)/view/(.+)$#', $viewPath, $pathParts);
    $module = $pathParts[1];
    $viewName = $pathParts[2];

    $header = $headerDepth[$module];
    $pkg = $package[$module];

    // Get design title from filename
    preg_match('/^\d+-(.+?)\.html$/', $designFile, $titleMatches);
    $designTitle = $titleMatches[1];

    // Get number prefix
    preg_match('/^(\d+)-/', $designFile, $numMatches);
    $designNum = $numMatches[1];

    // Build PHP view using nowdoc to avoid interpolation
    $php = '<?php' . "\n";
    $php .= "/**\n";
    $php .= " * The html {$viewName} view file of {$module} module of ZenTaoPMS.\n";
    $php .= " * Design: {$designNum}-{$designTitle}\n";
    $php .= " *\n";
    $php .= " * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.cnezsoft.com)\n";
    $php .= " * @license     ZPL(http://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)\n";
    $php .= " * @author      CodeManager\n";
    $php .= " * @package     {$pkg}\n";
    $php .= " */\n";
    $php .= "?>\n";
    $php .= "<?php include '{$header}';?>\n\n";
    $php .= "<?php \$cmCssFile = \$this->app->getBasePath() . 'www/theme/codemanager/codemanager.css'; if(file_exists(\$cmCssFile)): ?>\n";
    $php .= '<link rel="stylesheet" href="<?php echo $this->app->getWebRoot() . \'theme/codemanager/codemanager.css?t=\' . filemtime($cmCssFile); ?>" id="codemanagerCSS">' . "\n";
    $php .= "<?php endif; ?>\n\n";
    $php .= "<?php\n";
    $php .= "\$userName  = isset(\$app->user->realname) ? \$app->user->realname : (isset(\$app->user->account) ? \$app->user->account : 'admin');\n";
    $php .= "\$userInitial = mb_substr(\$userName, 0, 1, 'UTF-8');\n";
    $php .= "?>\n\n";
    $php .= '<div class="cm-page">' . "\n\n";

    // Replace hardcoded user info with PHP variables in main content
    $mainContent = str_replace(
        ['<span class="avatar">A</span><span>admin</span>',
         '<span class="avatar">L</span><span>lucen</span>',
         '<span class="avatar">K</span><span>knowledge</span>',
         '<span class="avatar">U</span><span>ui-team</span>',
         '<span class="avatar">D</span><span>doc-team</span>',
         '<span class="avatar">Q</span><span>qa</span>',
         '<span class="avatar">R</span><span>release</span>',
         '<span class="avatar">B</span><span>bi-team</span>'],
        '<span class="avatar"><?php echo $userInitial; ?></span><span><?php echo $userName; ?></span>',
        $mainContent
    );

    // Also replace individual mini-avatars that use the same initial
    // Keep specific user names for mock data variety
    $mainContent = preg_replace(
        '/<span class="mini-avatar">A<\/span>admin/',
        '<span class="mini-avatar"><?php echo $userInitial; ?></span><?php echo $userName; ?>',
        $mainContent
    );

    $php .= $mainContent;

    $php .= "\n</div>\n\n<?php include '../../common/view/footer.html.php';?>\n";

    $fullPath = $viewsDir . $viewPath;
    $dir = dirname($fullPath);
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    file_put_contents($fullPath, $php);
    echo "OK: $designFile -> $viewPath\n";
    $count++;
}

echo "\nDone. Generated $count views.\n";
