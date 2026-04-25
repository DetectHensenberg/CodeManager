<?php
$config->auditcl = new stdClass();
$config->auditcl->requiredFields = 'title,practiceArea,type';

global $lang;
$config->auditcl->search['module']                 = 'auditcl';
$config->auditcl->search['fields']['id']           = $lang->auditcl->id;
$config->auditcl->search['fields']['activity']     = $lang->auditcl->activity;
$config->auditcl->search['fields']['process']      = $lang->auditcl->process;
$config->auditcl->search['fields']['title']        = $lang->auditcl->title;
$config->auditcl->search['fields']['createdBy']    = $lang->auditcl->createdBy;
$config->auditcl->search['fields']['createdDate']  = $lang->auditcl->createdDate;
$config->auditcl->search['fields']['editedBy']     = $lang->auditcl->editedBy;
$config->auditcl->search['fields']['editedDate']   = $lang->auditcl->editedDate;

$config->auditcl->search['params']['activity']     = array('operator' => '=', 'control' => 'select', 'values' => '');
$config->auditcl->search['params']['process']      = array('operator' => '=', 'control' => 'select', 'values' => '');
$config->auditcl->search['params']['title']        = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->auditcl->search['params']['createdBy']    = array('operator' => '=', 'control' => 'select', 'values' => 'users');
$config->auditcl->search['params']['createdDate']  = array('operator' => '=', 'control' => 'input', 'values' => '', 'class' => 'date');
$config->auditcl->search['params']['editedBy']     = array('operator' => '=', 'control' => 'select', 'values' => 'users');
$config->auditcl->search['params']['editedDate']   = array('operator' => '=', 'control' => 'input', 'values' => '', 'class' => 'date');
