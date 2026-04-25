<?php
global $lang, $app;

$config->review->form = new stdclass();
$config->review->form->createFlow['objectID']    = array('required' => true,  'type' => 'int',    'default' => 0);
$config->review->form->createFlow['flow']        = array('required' => true,  'type' => 'int',    'default' => 0);
$config->review->form->createFlow['objectType']  = array('required' => false, 'type' => 'string', 'default' => 'deliverable');
$config->review->form->createFlow['relatedBy']   = array('required' => false, 'type' => 'string', 'default' => isset($app->user->account) ? $app->user->account : '');
$config->review->form->createFlow['relatedDate'] = array('required' => false, 'type' => 'string', 'default' => helper::now());
$config->review->form->createFlow['extra']       = array('required' => false, 'type' => 'string', 'default' => 'review');

$config->review->form->editFlow['flow']        = array('required' => true,  'type' => 'int',    'default' => 0);
$config->review->form->editFlow['relatedBy']   = array('required' => false, 'type' => 'string', 'default' => isset($app->user->account) ? $app->user->account : '');
$config->review->form->editFlow['relatedDate'] = array('required' => false, 'type' => 'string', 'default' => helper::now());
