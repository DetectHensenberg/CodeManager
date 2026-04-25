<?php
$now = helper::now();

$config->researchplan->form = new stdclass();
$config->researchplan->form->team = new stdclass();
$config->researchplan->form->testTask = new stdclass();

global $app;
$account = isset($app->user->account) ? $app->user->account : '';

$config->researchplan->form->create = array();
$config->researchplan->form->create['name']        = array('type' => 'string', 'required' => true,  'default' => '', 'filter' => 'trim');
$config->researchplan->form->create['customer']    = array('type' => 'string', 'required' => false, 'default' => '');
$config->researchplan->form->create['stakeholder'] = array('type' => 'array',  'required' => false, 'default' => '', 'filter' => 'join');
$config->researchplan->form->create['objective']   = array('type' => 'string', 'required' => false, 'default' => '');
$config->researchplan->form->create['begin']       = array('type' => 'string', 'required' => false, 'default' => '');
$config->researchplan->form->create['end']         = array('type' => 'string', 'required' => false, 'default' => '');
$config->researchplan->form->create['location']    = array('type' => 'string', 'required' => false, 'default' => '');
$config->researchplan->form->create['team']        = array('type' => 'array',  'required' => false, 'default' => '', 'filter' => 'join');
$config->researchplan->form->create['method']      = array('type' => 'string', 'required' => false, 'default' => '');
$config->researchplan->form->create['outline']     = array('type' => 'string', 'required' => false, 'default' => '');
$config->researchplan->form->create['schedule']    = array('type' => 'string', 'required' => false, 'default' => '');

$config->researchplan->form->edit = array();
$config->researchplan->form->edit['name']        = array('type' => 'string', 'required' => true,  'default' => '', 'filter' => 'trim');
$config->researchplan->form->edit['customer']    = array('type' => 'string', 'required' => false, 'default' => '');
$config->researchplan->form->edit['stakeholder'] = array('type' => 'array',  'required' => false, 'default' => '', 'filter' => 'join');
$config->researchplan->form->edit['objective']   = array('type' => 'string', 'required' => false, 'default' => '');
$config->researchplan->form->edit['begin']       = array('type' => 'string', 'required' => false, 'default' => '');
$config->researchplan->form->edit['end']         = array('type' => 'string', 'required' => false, 'default' => '');
$config->researchplan->form->edit['location']    = array('type' => 'string', 'required' => false, 'default' => '');
$config->researchplan->form->edit['team']        = array('type' => 'array',  'required' => false, 'default' => '', 'filter' => 'join');
$config->researchplan->form->edit['method']      = array('type' => 'string', 'required' => false, 'default' => '');
$config->researchplan->form->edit['outline']     = array('type' => 'string', 'required' => false, 'default' => '');
$config->researchplan->form->edit['schedule']    = array('type' => 'string', 'required' => false, 'default' => '');
