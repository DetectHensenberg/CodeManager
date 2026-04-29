<?php
/**
 * ZIN UI wrapper for execution/detail.
 * Sets $zinContext flag so view file skips header/footer includes.
 */
global $app;
$cmCssFile = $app->getBasePath() . 'www/theme/codemanager/codemanager.css';
if(file_exists($cmCssFile)) {
    echo '<link rel="stylesheet" href="' . $app->getWebRoot() . 'theme/codemanager/codemanager.css?t=' . filemtime($cmCssFile) . '" id="codemanagerCSS">';
}
$zinContext = true;
include dirname(__FILE__, 2) . '/view/detail.html.php';
