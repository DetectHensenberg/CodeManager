<?php
global $lang, $app;
$app->loadLang('review');
$config->cm->actionList = array();
$config->cm->actionList['submit']['icon']        = 'sub-review';
$config->cm->actionList['submit']['text']        = $lang->cm->submit;
$config->cm->actionList['submit']['hint']        = $lang->cm->submit;
$config->cm->actionList['submit']['url']         = array('module' => 'cm', 'method' => 'submit', 'params' => 'baselineID={id}');
$config->cm->actionList['submit']['data-toggle'] = 'modal';

$config->cm->actionList['recall']['icon']         = 'back';
$config->cm->actionList['recall']['text']         = $lang->cm->recall;
$config->cm->actionList['recall']['hint']         = $lang->cm->recall;
$config->cm->actionList['recall']['url']          = array('module' => 'cm', 'method' => 'recall', 'params' => 'baselineID={id}');
$config->cm->actionList['recall']['className']    = 'ajax-submit';
$config->cm->actionList['recall']['data-confirm'] = $lang->review->confirmRecall;

$config->cm->actionList['assess']['icon'] = 'glasses';
$config->cm->actionList['assess']['text'] = $lang->cm->review;
$config->cm->actionList['assess']['hint'] = $lang->cm->review;
$config->cm->actionList['assess']['url']  = array('module' => 'review', 'method' => 'assess', 'params' => 'id={reviewID}');

$config->cm->actionList['progress']['icon']         = 'list-alt';
$config->cm->actionList['progress']['text']         = $lang->cm->progress;
$config->cm->actionList['progress']['hint']         = $lang->cm->progress;
$config->cm->actionList['progress']['url']          = array('module' => 'approval', 'method' => 'progress', 'params' => 'approvalID={approval}');
$config->cm->actionList['progress']['data-toggle']  = 'modal';
$config->cm->actionList['progress']['notLoadModel'] = true;

$config->cm->actionList['edit']['icon']        = 'edit';
$config->cm->actionList['edit']['text']        = $lang->edit;
$config->cm->actionList['edit']['hint']        = $lang->edit;
$config->cm->actionList['edit']['url']         = array('module' => 'cm', 'method' => 'edit', 'params' => 'baselineID={id}');
$config->cm->actionList['edit']['data-toggle'] = 'modal';

$config->cm->actionList['delete']['icon']         = 'trash';
$config->cm->actionList['delete']['text']         = $lang->delete;
$config->cm->actionList['delete']['hint']         = $lang->delete;
$config->cm->actionList['delete']['className']    = 'ajax-submit';
$config->cm->actionList['delete']['data-confirm'] = $lang->cm->confirmDelete;
$config->cm->actionList['delete']['url']          = array('module' => 'cm', 'method' => 'delete', 'params' => 'baselineID={id}');