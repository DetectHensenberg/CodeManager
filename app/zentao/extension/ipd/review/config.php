<?php
$config->review = new stdclass();
$config->review->editor = new stdclass();
$config->review->editor->create  = array('id' => 'comment', 'tools' => 'simpleTools');
$config->review->editor->edit    = array('id' => 'comment', 'tools' => 'simpleTools');
$config->review->editor->submit  = array('id' => 'comment', 'tools' => 'simpleTools');
$config->review->editor->toaudit = array('id' => 'comment', 'tools' => 'simpleTools');
$config->review->editor->assess  = array('id' => 'opinion', 'tools' => 'simpleTools');
$config->review->editor->audit   = array('id' => 'opinion', 'tools' => 'simpleTools');

$config->review->create = new stdclass();
$config->review->create->requiredFields = 'type';

$config->review->edit = new stdclass();
$config->review->edit->requiredFields = 'type';

$config->review->assess = new stdclass();
$config->review->assess->requiredFields = '';

global $lang;
$config->review->search['module'] = 'review';

$config->review->search['fields']['title']            = $lang->review->title;
$config->review->search['fields']['type']             = $lang->review->type;
$config->review->search['fields']['object']           = $lang->review->object;
$config->review->search['fields']['status']           = $lang->review->status;
$config->review->search['fields']['reviewedBy']       = $lang->review->reviewedBy;
$config->review->search['fields']['createdBy']        = $lang->review->createdBy;
$config->review->search['fields']['createdDate']      = $lang->review->createdDate;
$config->review->search['fields']['version']          = $lang->review->version;
$config->review->search['fields']['deadline']         = $lang->review->deadline;
$config->review->search['fields']['lastReviewedDate'] = $lang->review->lastReviewedDate;
$config->review->search['fields']['id']               = $lang->review->id;

$config->review->search['params']['title']            = array('operator' => 'include', 'control' => 'input', 'values' => '');
$config->review->search['params']['type']             = array('operator' => 'include', 'control' => 'select', 'values' => '');
$config->review->search['params']['object']           = array('operator' => 'include', 'control' => 'select', 'values' => '');
$config->review->search['params']['status']           = array('operator' => 'include', 'control' => 'select', 'values' => arrayUnion(array('' => ''), $lang->review->statusList));
$config->review->search['params']['reviewedBy']       = array('operator' => 'include', 'control' => 'select', 'values' => 'users');
$config->review->search['params']['createdBy']        = array('operator' => 'include', 'control' => 'select', 'values' => 'users');
$config->review->search['params']['createdDate']      = array('operator' => '=', 'control' => 'input', 'values' => '', 'class' => 'date');
$config->review->search['params']['version']          = array('operator' => 'include', 'control' => 'input', 'values' => '');
$config->review->search['params']['deadline']         = array('operator' => '=', 'control' => 'input', 'values' => '', 'class' => 'date');
$config->review->search['params']['lastReviewedDate'] = array('operator' => '=', 'control' => 'input', 'values' => '', 'class' => 'date');

$config->review->actions = new stdclass();
$config->review->actions->view = array();
$config->review->actions->view['mainActions']   = array('submit' => 'submit', 'recall' => 'recall', 'assess' => 'assess', 'progress' => 'progress');
$config->review->actions->view['suffixActions'] = array('edit');
