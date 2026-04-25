<?php
$config->budget = new stdclass();
$config->budget->editor = new stdclass();
$config->budget->create = new stdclass();
$config->budget->edit   = new stdclass();

$config->budget->editor->create = array('id' => 'desc', 'tools' => 'simpleTools');
$config->budget->editor->edit   = array('id' => 'desc', 'tools' => 'simpleTools');

$config->budget->create->requiredFields = 'stage,subject,name';
$config->budget->edit->requiredFields   = 'stage,subject,name';

$config->budget->actions = new stdclass();
$config->budget->actions->view = array();
$config->budget->actions->view['mainActions']   = array();
$config->budget->actions->view['suffixActions'] = array('edit', 'delete');