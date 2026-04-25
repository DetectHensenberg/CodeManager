<?php
global $lang;

$config->trainplan->dtable = new stdclass();
$config->trainplan->dtable->fieldList['id']['name']     = 'id';
$config->trainplan->dtable->fieldList['id']['title']    = $lang->trainplan->id;
$config->trainplan->dtable->fieldList['id']['type']     = 'checkID';
$config->trainplan->dtable->fieldList['id']['fixed']    = 'left';
$config->trainplan->dtable->fieldList['id']['sortType'] = true;
$config->trainplan->dtable->fieldList['id']['group']    = 1;

$config->trainplan->dtable->fieldList['name']['name']     = 'name';
$config->trainplan->dtable->fieldList['name']['title']    = $lang->trainplan->name;
$config->trainplan->dtable->fieldList['name']['type']     = 'title';
$config->trainplan->dtable->fieldList['name']['fixed']    = 'left';
$config->trainplan->dtable->fieldList['name']['sortType'] = true;
$config->trainplan->dtable->fieldList['name']['link']     = array('module' => 'trainplan', 'method' => 'view', 'params' => 'trainplanID={id}');
$config->trainplan->dtable->fieldList['name']['group']    = 2;

$config->trainplan->dtable->fieldList['begin']['name']     = 'begin';
$config->trainplan->dtable->fieldList['begin']['title']    = $lang->trainplan->begin;
$config->trainplan->dtable->fieldList['begin']['type']     = 'date';
$config->trainplan->dtable->fieldList['begin']['sortType'] = true;
$config->trainplan->dtable->fieldList['begin']['group']    = 3;

$config->trainplan->dtable->fieldList['end']['name']     = 'end';
$config->trainplan->dtable->fieldList['end']['title']    = $lang->trainplan->end;
$config->trainplan->dtable->fieldList['end']['type']     = 'date';
$config->trainplan->dtable->fieldList['end']['sortType'] = true;
$config->trainplan->dtable->fieldList['end']['group']    = 4;

$config->trainplan->dtable->fieldList['place']['name']  = 'place';
$config->trainplan->dtable->fieldList['place']['title'] = $lang->trainplan->place;
$config->trainplan->dtable->fieldList['place']['type']  = 'desc';
$config->trainplan->dtable->fieldList['place']['group'] = 5;

$config->trainplan->dtable->fieldList['trainee']['name']     = 'trainee';
$config->trainplan->dtable->fieldList['trainee']['title']    = $lang->trainplan->trainee;
$config->trainplan->dtable->fieldList['trainee']['type']     = 'category';
$config->trainplan->dtable->fieldList['trainee']['sortType'] = true;
$config->trainplan->dtable->fieldList['trainee']['group']    = 6;

$config->trainplan->dtable->fieldList['lecturer']['name']  = 'lecturer';
$config->trainplan->dtable->fieldList['lecturer']['title'] = $lang->trainplan->lecturer;
$config->trainplan->dtable->fieldList['lecturer']['type']  = 'desc';
$config->trainplan->dtable->fieldList['lecturer']['group'] = 7;

$config->trainplan->dtable->fieldList['type']['name']  = 'type';
$config->trainplan->dtable->fieldList['type']['title'] = $lang->trainplan->type;
$config->trainplan->dtable->fieldList['type']['type']  = 'category';
$config->trainplan->dtable->fieldList['type']['map']   = $lang->trainplan->typeList;
$config->trainplan->dtable->fieldList['type']['group'] = 8;

$config->trainplan->dtable->fieldList['status']['name']      = 'status';
$config->trainplan->dtable->fieldList['status']['title']     = $lang->trainplan->status;
$config->trainplan->dtable->fieldList['status']['type']      = 'status';
$config->trainplan->dtable->fieldList['status']['statusMap'] = $lang->trainplan->statusList;
$config->trainplan->dtable->fieldList['status']['group']     = 9;

$config->trainplan->dtable->fieldList['actions']['title']    = $lang->actions;
$config->trainplan->dtable->fieldList['actions']['type']     = 'actions';
$config->trainplan->dtable->fieldList['actions']['fixed']    = 'right';
$config->trainplan->dtable->fieldList['actions']['sortType'] = false;
$config->trainplan->dtable->fieldList['actions']['show']     = true;
$config->trainplan->dtable->fieldList['actions']['width']    = 100;
$config->trainplan->dtable->fieldList['actions']['list']     = $config->trainplan->actionList;
$config->trainplan->dtable->fieldList['actions']['menu']     = array('edit', 'finish', 'summary');
