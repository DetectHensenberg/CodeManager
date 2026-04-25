<?php
namespace zin;

$productID = data('productID');
$storyType = data('storyType');
if(hasPriv('report', 'export'))
{
    global $lang;

    $exportBtn = btn(set(array('type' => 'primary', 'text' => $lang->export, 'url' => createLink('report', 'export', "module=story&productID=$productID&taskID=&storyType={$storyType}"), 'data-toggle' => 'modal')));
    query('.detail-header')->append($exportBtn);
}
