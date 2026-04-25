<?php
global $lang;
$config->weekly->search['module']                 = 'weekly';
$config->weekly->search['fields']['title']        = $lang->weekly->title;
$config->weekly->search['fields']['status']       = $lang->weekly->status;
$config->weekly->search['fields']['reportModule'] = $lang->weekly->module;
$config->weekly->search['fields']['addedDate']    = $lang->weekly->addedDate;
$config->weekly->search['fields']['addedBy']      = $lang->weekly->addedBy;
$config->weekly->search['fields']['editedDate']   = $lang->weekly->editedDate;
$config->weekly->search['fields']['editedBy']     = $lang->weekly->editedBy;
$config->weekly->search['fields']['templateDesc'] = $lang->weekly->desc;
$config->weekly->search['fields']['template']     = $lang->weekly->template;
$config->weekly->search['fields']['id']           = $lang->idAB;

$config->weekly->search['params']['title']        = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->weekly->search['params']['status']       = array('operator' => '=', 'control' => 'select',  'values' => $lang->weekly->statusList);
$config->weekly->search['params']['reportModule'] = array('operator' => '=', 'control' => 'select',  'values' => '');
$config->weekly->search['params']['addedDate']    = array('operator' => '=', 'control' => 'input',  'values' => '', 'class' => 'date');
$config->weekly->search['params']['addedBy']      = array('operator' => '=', 'control' => 'select',  'values' => 'users');
$config->weekly->search['params']['editedDate']   = array('operator' => '=', 'control' => 'input',  'values' => '', 'class' => 'date');
$config->weekly->search['params']['editedBy']     = array('operator' => '=', 'control' => 'select',  'values' => 'users');
$config->weekly->search['params']['templateDesc'] = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->weekly->search['params']['template']     = array('operator' => '=', 'control' => 'select',  'values' => '');
