<?php
$config->trainplan->actionList['edit']['icon']        = 'edit';
$config->trainplan->actionList['edit']['text']        = $lang->trainplan->edit;
$config->trainplan->actionList['edit']['hint']        = $lang->trainplan->edit;
$config->trainplan->actionList['edit']['url']         = array('module' => 'trainplan', 'method' => 'edit', 'params' => 'trainplanID={id}');
$config->trainplan->actionList['edit']['data-toggle'] = 'modal';
$config->trainplan->actionList['edit']['data-size']   = 'sm';

$config->trainplan->actionList['finish']['icon']        = 'checked';
$config->trainplan->actionList['finish']['text']        = $lang->trainplan->finish;
$config->trainplan->actionList['finish']['hint']        = $lang->trainplan->finish;
$config->trainplan->actionList['finish']['url']         = array('module' => 'trainplan', 'method' => 'finish', 'params' => 'trainplanID={id}');
$config->trainplan->actionList['finish']['data-toggle'] = 'modal';
$config->trainplan->actionList['finish']['data-size']   = 'sm';

$config->trainplan->actionList['summary']['icon']        = 'summary';
$config->trainplan->actionList['summary']['text']        = $lang->trainplan->summary;
$config->trainplan->actionList['summary']['hint']        = $lang->trainplan->summary;
$config->trainplan->actionList['summary']['url']         = array('module' => 'trainplan', 'method' => 'summary', 'params' => 'trainplanID={id}');
$config->trainplan->actionList['summary']['data-toggle'] = 'modal';
$config->trainplan->actionList['summary']['data-size']   = 'sm';

$config->trainplan->actionList['delete']['icon']         = 'trash';
$config->trainplan->actionList['delete']['text']         = $lang->trainplan->delete;
$config->trainplan->actionList['delete']['hint']         = $lang->trainplan->delete;
$config->trainplan->actionList['delete']['className']    = 'ajax-submit';
$config->trainplan->actionList['delete']['data-confirm'] = $lang->trainplan->confirmDelete;
$config->trainplan->actionList['delete']['url']          = array('module' => 'trainplan', 'method' => 'delete', 'params' => 'trainplanID={id}');
