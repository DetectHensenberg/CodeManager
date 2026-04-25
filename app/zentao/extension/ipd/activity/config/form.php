<?php
global $lang, $app;

$config->activity->form = new stdclass();
$config->activity->form->create['process']       = array('required' => true,  'type' => 'int',    'default' => 0);
$config->activity->form->create['name']          = array('required' => true,  'type' => 'string', 'default' => '');
$config->activity->form->create['optional']      = array('required' => false, 'type' => 'string', 'default' => 'no');
$config->activity->form->create['tailorNorm']    = array('required' => false, 'type' => 'string', 'default' => '');
$config->activity->form->create['content']       = array('required' => false, 'type' => 'string', 'default' => '', 'control' => 'editor');
$config->activity->form->create['createdBy']     = array('required' => false, 'type' => 'string', 'default' => isset($app->user->account) ? $app->user->account : '');
$config->activity->form->create['createdDate']   = array('required' => false, 'type' => 'string', 'default' => helper::now());
$config->activity->form->create['workflowGroup'] = array('required' => false, 'type' => 'int',    'default' => 0);

$config->activity->form->edit['process']    = array('required' => true,  'type' => 'int',    'default' => 0);
$config->activity->form->edit['name']       = array('required' => true,  'type' => 'string', 'default' => '');
$config->activity->form->edit['optional']   = array('required' => false, 'type' => 'string');
$config->activity->form->edit['tailorNorm'] = array('required' => false, 'type' => 'string', 'default' => '');
$config->activity->form->edit['content']    = array('required' => false, 'type' => 'string', 'default' => '', 'control' => 'editor');
$config->activity->form->edit['editedBy']   = array('required' => false, 'type' => 'string', 'default' => isset($app->user->account) ? $app->user->account : '');
$config->activity->form->edit['editedDate'] = array('required' => false, 'type' => 'string', 'default' => helper::now());
