<?php
global $lang, $app;

$config->projectchange->form = new stdclass();
$config->projectchange->form->create['name']        = array('required' => true,  'type' => 'string', 'default' => '');
$config->projectchange->form->create['urgency']     = array('required' => true,  'type' => 'string', 'default' => '');
$config->projectchange->form->create['type']        = array('required' => true, 'type' => 'string', 'default' => '');
$config->projectchange->form->create['deliverable'] = array('required' => false, 'type' => 'array',  'default' => array(''), 'filter' => 'join');
$config->projectchange->form->create['owner']       = array('required' => true,  'type' => 'string', 'default' => '');
$config->projectchange->form->create['reason']      = array('required' => true,  'type' => 'string', 'default' => '');
$config->projectchange->form->create['desc']        = array('required' => true,  'type' => 'string', 'default' => '', 'control' => 'editor');
$config->projectchange->form->create['deadline']    = array('required' => false, 'type' => 'date',   'default' => null);
$config->projectchange->form->create['createdBy']   = array('required' => false, 'type' => 'string', 'default' => isset($app->user->account) ? $app->user->account : '');
$config->projectchange->form->create['createdDate'] = array('required' => false, 'type' => 'string', 'default' => helper::now());
$config->projectchange->form->create['comment']     = array('required' => false, 'type' => 'string', 'default' => '', 'control' => 'editor');
$config->projectchange->form->create['uid']         = array('required' => false, 'type' => 'string', 'default' => '');

$config->projectchange->form->edit['name']        = array('required' => true,  'type' => 'string', 'default' => '');
$config->projectchange->form->edit['urgency']     = array('required' => true,  'type' => 'string', 'default' => '');
$config->projectchange->form->edit['type']        = array('required' => true, 'type' => 'string', 'default' => '');
$config->projectchange->form->edit['deliverable'] = array('required' => false, 'type' => 'array',  'default' => array(''), 'filter' => 'join');
$config->projectchange->form->edit['owner']       = array('required' => true,  'type' => 'string', 'default' => '');
$config->projectchange->form->edit['reason']      = array('required' => true,  'type' => 'string', 'default' => '');
$config->projectchange->form->edit['desc']        = array('required' => true,  'type' => 'string', 'default' => '', 'control' => 'editor');
$config->projectchange->form->edit['deadline']    = array('required' => false, 'type' => 'date',   'default' => null);
$config->projectchange->form->edit['editedBy']    = array('required' => false, 'type' => 'string', 'default' => isset($app->user->account) ? $app->user->account : '');
$config->projectchange->form->edit['editedDate']  = array('required' => false, 'type' => 'string', 'default' => helper::now());
$config->projectchange->form->edit['comment']     = array('required' => false, 'type' => 'string', 'default' => '', 'control' => 'editor');
$config->projectchange->form->edit['uid']         = array('required' => false, 'type' => 'string', 'default' => '');
$config->projectchange->form->edit['deleteFiles'] = array('required' => false, 'type' => 'array',  'default' => array());
$config->projectchange->form->edit['renameFiles'] = array('required' => false, 'type' => 'array',  'default' => array());

$config->projectchange->form->submit['ids']      = array('required' => false, 'type' => 'array',  'default' => array(''));
$config->projectchange->form->submit['ccer']     = array('required' => false, 'type' => 'array',  'default' => array(''));
$config->projectchange->form->submit['reviewer'] = array('required' => false, 'type' => 'array',  'default' => array(''));
