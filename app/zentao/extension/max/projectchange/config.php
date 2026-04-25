<?php
global $lang, $app;
$app->loadLang('review');
$config->projectchange->create = new stdclass();
$config->projectchange->create->requiredFields = 'name,urgency,type,owner,reaason,desc';

$config->projectchange->edit = new stdclass();
$config->projectchange->edit->requiredFields = 'name,urgency,type,owner,reaason,desc';

$config->projectchange->editor = new stdclass();
$config->projectchange->editor->create = array('id' => 'desc', 'tools' => 'simpleTools');
$config->projectchange->editor->edit   = array('id' => 'desc', 'tools' => 'simpleTools');

$config->projectchange->actions = new stdclass();
$config->projectchange->actions->view = array();
$config->projectchange->actions->view['mainActions']   = array('submit', 'recall', 'assess', 'progress');
$config->projectchange->actions->view['suffixActions'] = array('edit', 'delete');

$config->projectchange->actionList = array();
$config->projectchange->actionList['submit']['icon']        = 'sub-review';
$config->projectchange->actionList['submit']['text']        = $lang->projectchange->submit;
$config->projectchange->actionList['submit']['hint']        = $lang->projectchange->submit;
$config->projectchange->actionList['submit']['url']         = array('module' => 'projectchange', 'method' => 'submit', 'params' => 'changeID={id}');
$config->projectchange->actionList['submit']['data-toggle'] = 'modal';

$config->projectchange->actionList['recall']['icon']         = 'back';
$config->projectchange->actionList['recall']['text']         = $lang->projectchange->recall;
$config->projectchange->actionList['recall']['hint']         = $lang->projectchange->recall;
$config->projectchange->actionList['recall']['url']          = array('module' => 'projectchange', 'method' => 'recall', 'params' => 'changeID={id}');
$config->projectchange->actionList['recall']['className']    = 'ajax-submit';
$config->projectchange->actionList['recall']['data-confirm'] = $lang->review->confirmRecall;

$config->projectchange->actionList['assess']['icon'] = 'glasses';
$config->projectchange->actionList['assess']['text'] = $lang->projectchange->review;
$config->projectchange->actionList['assess']['hint'] = $lang->projectchange->review;
$config->projectchange->actionList['assess']['url']  = array('module' => 'review', 'method' => 'assess', 'params' => 'id={reviewID}');

$config->projectchange->actionList['progress']['icon']         = 'list-alt';
$config->projectchange->actionList['progress']['text']         = $lang->projectchange->progress;
$config->projectchange->actionList['progress']['hint']         = $lang->projectchange->progress;
$config->projectchange->actionList['progress']['url']          = array('module' => 'approval', 'method' => 'progress', 'params' => 'approvalID={approval}');
$config->projectchange->actionList['progress']['data-toggle']  = 'modal';
$config->projectchange->actionList['progress']['notLoadModel'] = true;

$config->projectchange->actionList['edit']['icon'] = 'edit';
$config->projectchange->actionList['edit']['text'] = $lang->projectchange->edit;
$config->projectchange->actionList['edit']['hint'] = $lang->projectchange->edit;
$config->projectchange->actionList['edit']['url']  = array('module' => 'projectchange', 'method' => 'edit', 'params' => 'changeID={id}');

$config->projectchange->actionList['delete']['icon']         = 'trash';
$config->projectchange->actionList['delete']['text']         = $lang->projectchange->delete;
$config->projectchange->actionList['delete']['hint']         = $lang->projectchange->delete;
$config->projectchange->actionList['delete']['url']          = array('module' => 'projectchange', 'method' => 'delete', 'params' => 'changeID={id}');
$config->projectchange->actionList['delete']['className']    = 'ajax-submit';
$config->projectchange->actionList['delete']['data-confirm'] = array('message' => $lang->projectchange->confirmDelete, 'icon' => 'icon-exclamation-sign', 'iconClass' => 'warning-pale rounded-full icon-2x');
$config->projectchange->actionList['delete']['notInModal']   = true;
