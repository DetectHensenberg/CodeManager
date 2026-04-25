<?php
$config->cm = new stdclass();
$config->cm->create = new stdclass();
$config->cm->create->requiredFields = 'title,category,version';

$config->cm->edit = new stdclass();
$config->cm->edit->requiredFields = 'title,category,version';

$config->cm->actions = new stdclass();
$config->cm->actions->view = array();
$config->cm->actions->view['mainActions']   = array('submit', 'recall', 'assess', 'progress');
$config->cm->actions->view['suffixActions'] = array('edit', 'delete');
