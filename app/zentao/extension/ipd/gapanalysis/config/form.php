<?php
$config->gapanalysis->form = new stdclass();
$config->gapanalysis->form->create['account']   = array('type' => 'string', 'required' => true,  'control' => 'select', 'default' => '');
$config->gapanalysis->form->create['role']      = array('type' => 'string', 'required' => false, 'control' => 'text',   'default' => '');
$config->gapanalysis->form->create['analysis']  = array('type' => 'string', 'required' => false, 'control' => 'editor', 'default' => '');
$config->gapanalysis->form->create['needTrain'] = array('type' => 'string', 'required' => false, 'control' => 'radio',  'default' => 'no');

$config->gapanalysis->form->edit['account']   = array('type' => 'string', 'required' => true,  'control' => 'select', 'default' => '');
$config->gapanalysis->form->edit['role']      = array('type' => 'string', 'required' => false, 'control' => 'text',   'default' => '');
$config->gapanalysis->form->edit['analysis']  = array('type' => 'string', 'required' => false, 'control' => 'editor', 'default' => '');
$config->gapanalysis->form->edit['needTrain'] = array('type' => 'string', 'required' => false, 'control' => 'radio',  'default' => 'no');