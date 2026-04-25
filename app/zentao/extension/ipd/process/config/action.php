<?php
global $lang;

$config->process->actionList['createActivity']['icon'] = 'split';
$config->process->actionList['createActivity']['text'] = $lang->process->createActivity;
$config->process->actionList['createActivity']['hint'] = $lang->process->createActivity;
$config->process->actionList['createActivity']['url']  = array('module' => 'activity', 'method' => 'batchCreate', 'params' => 'groupID={workflowGroup}&processID={id}');

$config->process->actionList['activityList']['icon'] = 'list-alt';
$config->process->actionList['activityList']['text'] = $lang->process->activityList;
$config->process->actionList['activityList']['hint'] = $lang->process->activityList;
$config->process->actionList['activityList']['url']  = array('module' => 'activity', 'method' => 'browse', 'params' => 'groupID={workflowGroup}&browseType=byprocess&processID={id}');

$config->process->actionList['edit']['icon']        = 'edit';
$config->process->actionList['edit']['text']        = $lang->process->edit;
$config->process->actionList['edit']['hint']        = $lang->process->edit;
$config->process->actionList['edit']['url']         = array('module' => 'process', 'method' => 'edit', 'params' => 'processID={id}');
$config->process->actionList['edit']['data-toggle'] = 'modal';

$config->process->actionList['delete']['icon']         = 'trash';
$config->process->actionList['delete']['text']         = $lang->process->delete;
$config->process->actionList['delete']['hint']         = $lang->process->delete;
$config->process->actionList['delete']['className']    = 'ajax-submit';
$config->process->actionList['delete']['data-confirm'] = $lang->process->confirmDelete;
$config->process->actionList['delete']['url']          = array('module' => 'process', 'method' => 'delete', 'params' => 'processID={id}');
