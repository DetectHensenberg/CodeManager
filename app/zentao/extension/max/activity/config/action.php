<?php
global $lang;

$config->activity->actionList['edit']['icon']        = 'edit';
$config->activity->actionList['edit']['text']        = $lang->activity->edit;
$config->activity->actionList['edit']['hint']        = $lang->activity->edit;
$config->activity->actionList['edit']['url']         = array('module' => 'activity', 'method' => 'edit', 'params' => 'activityID={id}');
$config->activity->actionList['edit']['data-toggle'] = 'modal';

$config->activity->actionList['delete']['icon']         = 'trash';
$config->activity->actionList['delete']['text']         = $lang->activity->delete;
$config->activity->actionList['delete']['hint']         = $lang->activity->delete;
$config->activity->actionList['delete']['className']    = 'ajax-submit';
$config->activity->actionList['delete']['data-confirm'] = $lang->activity->confirmDelete;
$config->activity->actionList['delete']['url']          = array('module' => 'activity', 'method' => 'delete', 'params' => 'activityID={id}');
