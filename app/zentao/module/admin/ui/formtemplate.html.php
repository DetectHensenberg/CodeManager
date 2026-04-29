<?php
/**
 * ZIN UI wrapper — CodeManager dark theme.
 * Replaces original ZenTao ui/formtemplate.html.php.
 */
global $app;
$cmCssFile = $app->getBasePath() . 'www/theme/codemanager/codemanager.css';
if(file_exists($cmCssFile)) {
    echo '<link rel="stylesheet" href="' . $app->getWebRoot() . 'theme/codemanager/codemanager.css?t=' . filemtime($cmCssFile) . '" id="codemanagerCSS">';
}
$zinContext = true;
include dirname(__FILE__, 2) . '/view/formtemplate.html.php';
