<?php
global $lang, $app;
$app->loadLang('approval');
$config->review->actionList = array();
$config->review->actionList['submit']['icon']        = 'sub-review';
$config->review->actionList['submit']['text']        = $lang->review->submit;
$config->review->actionList['submit']['hint']        = $lang->review->submit;
$config->review->actionList['submit']['url']         = array('module' => 'review', 'method' => 'submit', 'params' => 'reviewID={id}');
$config->review->actionList['submit']['data-toggle'] = 'modal';

$config->review->actionList['recall']['icon']         = 'back';
$config->review->actionList['recall']['text']         = $lang->review->recall;
$config->review->actionList['recall']['hint']         = $lang->review->recall;
$config->review->actionList['recall']['url']          = array('module' => 'review', 'method' => 'recall', 'params' => 'reviewID={id}');
$config->review->actionList['recall']['className']    = 'ajax-submit';
$config->review->actionList['recall']['data-confirm'] = $lang->review->confirmRecall;

$config->review->actionList['assess']['icon'] = 'glasses';
$config->review->actionList['assess']['text'] = $lang->review->assess;
$config->review->actionList['assess']['hint'] = $lang->review->assess;
$config->review->actionList['assess']['url']  = array('module' => 'review', 'method' => 'assess', 'params' => 'reviewID={id}');

$config->review->actionList['progress']['icon']         = 'list-alt';
$config->review->actionList['progress']['text']         = $lang->approval->progress;
$config->review->actionList['progress']['hint']         = $lang->approval->progress;
$config->review->actionList['progress']['url']          = array('module' => 'approval', 'method' => 'progress', 'params' => 'approvalID={approval}');
$config->review->actionList['progress']['data-toggle']  = 'modal';
$config->review->actionList['progress']['notLoadModel'] = 'true';

$config->review->actionList['report']['icon'] = 'bar-chart';
$config->review->actionList['report']['text'] = $lang->review->reviewReport;
$config->review->actionList['report']['hint'] = $lang->review->reviewReport;
$config->review->actionList['report']['url']  = array('module' => 'review', 'method' => 'report', 'params' => 'reviewID={id}');

$config->review->actionList['edit']['icon']        = 'edit';
$config->review->actionList['edit']['text']        = $lang->review->edit;
$config->review->actionList['edit']['hint']        = $lang->review->edit;
$config->review->actionList['edit']['data-toggle'] = 'modal';
$config->review->actionList['edit']['url']         = array('module' => 'review', 'method' => 'edit', 'params' => 'reviewID={id}');

$config->review->admin = new stdclass();
$config->review->admin->actionList['reviewcl']['icon']        = 'audit';
$config->review->admin->actionList['reviewcl']['text']        = $lang->review->reviewcl;
$config->review->admin->actionList['reviewcl']['hint']        = $lang->review->reviewcl;
$config->review->admin->actionList['reviewcl']['url']         = array('module' => 'reviewcl', 'method' => 'browse', 'params' => 'groupID={root}&browseType=byreview&param={id}');

$config->review->admin->actionList['edit']['icon']        = 'edit';
$config->review->admin->actionList['edit']['text']        = $lang->edit;
$config->review->admin->actionList['edit']['hint']        = $lang->edit;
$config->review->admin->actionList['edit']['url']         = array('module' => 'review', 'method' => 'editFlow', 'params' => 'groupID={root}&flowID={id}&objectType={objectID}');
$config->review->admin->actionList['edit']['data-toggle'] = 'modal';
$config->review->admin->actionList['edit']['data-size']   = 'sm';

$config->review->admin->actionList['delete']['icon']         = 'trash';
$config->review->admin->actionList['delete']['text']         = $lang->delete;
$config->review->admin->actionList['delete']['hint']         = $lang->delete;
$config->review->admin->actionList['delete']['className']    = 'ajax-submit';
$config->review->admin->actionList['delete']['data-confirm'] = $lang->review->confirmDeleteFlow;
$config->review->admin->actionList['delete']['url']          = array('module' => 'review', 'method' => 'deleteFlow', 'params' => 'flowID={id}');
