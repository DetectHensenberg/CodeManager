<?php
$config->auditplan = new stdclass();
$config->auditplan->editor = new stdclass();
$config->auditplan->editor->create   = array('id' => 'comment', 'tools' => 'simpleTools');
$config->auditplan->editor->edit     = array('id' => 'comment', 'tools' => 'simpleTools');
$config->auditplan->editor->assignto = array('id' => 'comment', 'tools' => 'simpleTools');

$config->auditplan->actions = new stdclass();
$config->auditplan->actions->view = array();
$config->auditplan->actions->view['mainActions']   = array('check');
$config->auditplan->actions->view['suffixActions'] = array('edit', 'delete');

global $lang;
$config->auditplan->objectTypeList = array('activity' => $lang->auditplan->activity, 'zoutput' =>$lang->auditplan->zoutput);
$config->auditplan->search['onMenuBar']               = 'yes';
$config->auditplan->search['module']                  = 'auditplan';
$config->auditplan->search['fields']['objectID']      = $lang->auditplan->objectID;
$config->auditplan->search['fields']['id']            = $lang->auditplan->id;
$config->auditplan->search['fields']['status']        = $lang->auditplan->status;
$config->auditplan->search['fields']['assignedTo']    = $lang->auditplan->assignedTo;
$config->auditplan->search['fields']['process']       = $lang->auditplan->process;
$config->auditplan->search['fields']['execution']     = $lang->auditplan->execution;
$config->auditplan->search['fields']['checkDate']     = $lang->auditplan->checkDate;
$config->auditplan->search['fields']['realCheckDate'] = $lang->auditplan->realCheckDate;
$config->auditplan->search['fields']['createdBy']     = $lang->auditplan->createdBy;
$config->auditplan->search['fields']['createdDate']   = $lang->auditplan->createdDate;
$config->auditplan->search['fields']['checkedBy']     = $lang->auditplan->checkedBy;

$config->auditplan->search['params']['objectID']      = array('operator' => '=', 'control' => 'select', 'values' => '');
$config->auditplan->search['params']['id']            = array('operator' => '=', 'control' => 'input',  'values' => '');
$config->auditplan->search['params']['status']        = array('operator' => '=', 'control' => 'select', 'values' => '');
$config->auditplan->search['params']['assignedTo']    = array('operator' => '=', 'control' => 'select', 'values' => 'users');
$config->auditplan->search['params']['process']       = array('operator' => '=', 'control' => 'select', 'values' => '');
$config->auditplan->search['params']['execution']     = array('operator' => '=', 'control' => 'select', 'values' => '');
$config->auditplan->search['params']['checkDate']     = array('operator' => '=', 'control' => 'input',  'values' => '', 'class' => 'date');
$config->auditplan->search['params']['realCheckDate'] = array('operator' => '=', 'control' => 'input',  'values' => '', 'class' => 'date');
$config->auditplan->search['params']['createdBy']     = array('operator' => '=', 'control' => 'select', 'values' => 'users');
$config->auditplan->search['params']['createdDate']   = array('operator' => '=', 'control' => 'input',  'values' => '', 'class' => 'date');
$config->auditplan->search['params']['checkedBy']     = array('operator' => '=', 'control' => 'select', 'values' => 'users');

