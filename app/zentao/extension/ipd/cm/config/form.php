<?php
global $lang, $app;

$config->cm->form = new stdclass();
$config->cm->form->create['title']       = array('required' => true,  'type' => 'string', 'default' => '');
$config->cm->form->create['version']     = array('required' => false, 'type' => 'string', 'default' => '');
$config->cm->form->create['category']    = array('required' => false, 'type' => 'array',  'default' => array(''), 'filter' => 'join');
$config->cm->form->create['end']         = array('required' => false, 'type' => 'date',   'default' => null);
$config->cm->form->create['product']     = array('required' => false, 'type' => 'int',    'default' => 0);
$config->cm->form->create['comment']     = array('required' => false, 'type' => 'string', 'default' => '', 'control' => 'editor');
$config->cm->form->create['type']        = array('required' => false, 'type' => 'string', 'default' => 'taged');
$config->cm->form->create['status']      = array('required' => false, 'type' => 'string', 'default' => 'wait');
$config->cm->form->create['createdBy']   = array('required' => false, 'type' => 'string', 'default' => isset($app->user->account) ? $app->user->account : '');
$config->cm->form->create['createdDate'] = array('required' => false, 'type' => 'string', 'default' => helper::now());

$config->cm->form->edit['title']    = array('required' => true,  'type' => 'string', 'default' => '');
$config->cm->form->edit['version']  = array('required' => false, 'type' => 'string', 'default' => '');
$config->cm->form->edit['category'] = array('required' => false, 'type' => 'array',  'default' => array(''), 'filter' => 'join');
$config->cm->form->edit['end']      = array('required' => false, 'type' => 'date',   'default' => null);
$config->cm->form->edit['comment']  = array('required' => false, 'type' => 'string', 'default' => '', 'control' => 'editor');

$config->cm->form->submit['ids']      = array('required' => false, 'type' => 'array',  'default' => array(''));
$config->cm->form->submit['ccer']     = array('required' => false, 'type' => 'array',  'default' => array(''));
$config->cm->form->submit['reviewer'] = array('required' => false, 'type' => 'array',  'default' => array(''));

$config->cm->form->review['setReviewer']   = array('required' => false, 'type' => 'string',  'default' => '');
$config->cm->form->review['reviewResult']  = array('required' => true,  'type' => 'string',  'default' => '');
$config->cm->form->review['reviewOpinion'] = array('required' => false, 'type' => 'string',  'default' => '', 'control' => 'editor');

$config->cm->form->diff['baseline1'] = array('required' => true, 'type' => 'int', 'default' => 0);
$config->cm->form->diff['baseline2'] = array('required' => true, 'type' => 'int', 'default' => 0);
