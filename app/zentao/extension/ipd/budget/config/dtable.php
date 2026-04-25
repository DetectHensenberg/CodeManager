<?php
global $lang;
$config->budget->dtable = new stdclass();

$config->budget->dtable->fieldList['id']['title']    = $lang->idAB;
$config->budget->dtable->fieldList['id']['name']     = 'id';
$config->budget->dtable->fieldList['id']['type']     = 'checkID';
$config->budget->dtable->fieldList['id']['sortType'] = true;
$config->budget->dtable->fieldList['id']['width']    = '80';
$config->budget->dtable->fieldList['id']['required'] = true;

$config->budget->dtable->fieldList['name']['title']    = $lang->budget->name;
$config->budget->dtable->fieldList['name']['name']     = 'name';
$config->budget->dtable->fieldList['name']['type']     = 'title';
$config->budget->dtable->fieldList['name']['flex']     = 1;
$config->budget->dtable->fieldList['name']['fixed']    = 'left';
$config->budget->dtable->fieldList['name']['link']     = array('module' => 'budget', 'method' => 'view', 'params' => 'id={id}');
$config->budget->dtable->fieldList['name']['sortType'] = true;

$config->budget->dtable->fieldList['stage']['title']    = $lang->budget->stage;
$config->budget->dtable->fieldList['stage']['name']     = 'stage';
$config->budget->dtable->fieldList['stage']['type']     = 'text';
$config->budget->dtable->fieldList['stage']['sortType'] = true;

$config->budget->dtable->fieldList['subject']['title']    = $lang->budget->subject;
$config->budget->dtable->fieldList['subject']['name']     = 'subject';
$config->budget->dtable->fieldList['subject']['type']    = 'text';
$config->budget->dtable->fieldList['subject']['sortType'] = true;

$config->budget->dtable->fieldList['amount']['title']    = $lang->budget->amount;
$config->budget->dtable->fieldList['amount']['name']     = 'amount';
$config->budget->dtable->fieldList['amount']['type']     = 'text';
$config->budget->dtable->fieldList['amount']['sortType'] = true;

$config->budget->dtable->fieldList['actions']['title']    = $lang->actions;
$config->budget->dtable->fieldList['actions']['name']     = 'actions';
$config->budget->dtable->fieldList['actions']['type']     = 'actions';
$config->budget->dtable->fieldList['actions']['fixed']    = 'right';
$config->budget->dtable->fieldList['actions']['width']    = '120';
$config->budget->dtable->fieldList['actions']['list']     = $config->budget->actionList;
$config->budget->dtable->fieldList['actions']['menu']     = array('edit', 'delete');
$config->budget->dtable->fieldList['actions']['sortType'] = false;
