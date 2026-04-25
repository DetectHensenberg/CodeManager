<?php
global $lang, $app;

$config->process->form = new stdclass();
$config->process->form->create['module']        = array('required' => true,  'type' => 'int',    'default' => 0);
$config->process->form->create['name']          = array('required' => true,  'type' => 'string', 'default' => '');
$config->process->form->create['abbr']          = array('required' => false, 'type' => 'string', 'default' => '');
$config->process->form->create['desc']          = array('required' => false, 'type' => 'string', 'default' => '', 'control' => 'editor');
$config->process->form->create['createdBy']     = array('required' => false, 'type' => 'string', 'default' => isset($app->user->account) ? $app->user->account : '');
$config->process->form->create['createdDate']   = array('required' => false, 'type' => 'string', 'default' => helper::now());
$config->process->form->create['workflowGroup'] = array('required' => false, 'type' => 'int',    'default' => 0);

$config->process->form->edit['module']     = array('required' => true,  'type' => 'int',    'default' => 0);
$config->process->form->edit['name']       = array('required' => true,  'type' => 'string', 'default' => '');
$config->process->form->edit['abbr']       = array('required' => false, 'type' => 'string', 'default' => '');
$config->process->form->edit['desc']       = array('required' => false, 'type' => 'string', 'default' => '', 'control' => 'editor');
$config->process->form->edit['editedBy']   = array('required' => false, 'type' => 'string', 'default' => isset($app->user->account) ? $app->user->account : '');
$config->process->form->edit['editedDate'] = array('required' => false, 'type' => 'string', 'default' => helper::now());

$config->process->form->manageModule['id']   = array('required' => false, 'type' => 'int',    'default' => 0);
$config->process->form->manageModule['name'] = array('required' => true,  'type' => 'string', 'default' => '', 'base' => true);
