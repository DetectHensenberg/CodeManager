<?php
global $lang;

$config->budget->actionList['edit']['icon']       = 'edit';
$config->budget->actionList['edit']['text']       = $lang->budget->edit;
$config->budget->actionList['edit']['hint']       = $lang->budget->edit;
$config->budget->actionList['edit']['url']        = array('module' => 'budget', 'method' => 'edit', 'params' => 'id={id}');
$config->budget->actionList['edit']['notInModal'] = true;

$config->budget->actionList['delete']['icon']         = 'trash';
$config->budget->actionList['delete']['text']         = $lang->budget->delete;
$config->budget->actionList['delete']['hint']         = $lang->budget->delete;
$config->budget->actionList['delete']['url']          = array('module' => 'budget', 'method' => 'delete', 'params' => 'budgetID={id}&confirm=no');
$config->budget->actionList['delete']['data-confirm'] = $lang->budget->confirmDelete;
$config->budget->actionList['delete']['class']        = 'ajax-submit';
$config->budget->actionList['delete']['notInModal']   = true;