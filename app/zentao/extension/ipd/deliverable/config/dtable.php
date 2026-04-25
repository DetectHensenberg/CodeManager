<?php
global $lang;
$config->deliverable->dtable = new stdclass();

$config->deliverable->dtable->fieldList['id']['title']    = $lang->idAB;
$config->deliverable->dtable->fieldList['id']['name']     = 'id';
$config->deliverable->dtable->fieldList['id']['type']     = 'checkID';
$config->deliverable->dtable->fieldList['id']['sortType'] = true;
$config->deliverable->dtable->fieldList['id']['checkbox'] = true;
$config->deliverable->dtable->fieldList['id']['width']    = '80';
$config->deliverable->dtable->fieldList['id']['required'] = true;

$config->deliverable->dtable->fieldList['name']['title']    = $lang->deliverable->name;
$config->deliverable->dtable->fieldList['name']['name']     = 'name';
$config->deliverable->dtable->fieldList['name']['type']     = 'title';
$config->deliverable->dtable->fieldList['name']['width']    = '176';
$config->deliverable->dtable->fieldList['name']['fixed']    = 'left';
$config->deliverable->dtable->fieldList['name']['link']     = array('module' => 'deliverable', 'method' => 'view', 'params' => 'id={id}');
$config->deliverable->dtable->fieldList['name']['sortType'] = true;

$config->deliverable->dtable->fieldList['status']['title']    = $lang->deliverable->status;
$config->deliverable->dtable->fieldList['status']['name']     = 'status';
$config->deliverable->dtable->fieldList['status']['type']     = 'category';
$config->deliverable->dtable->fieldList['status']['map']      = $lang->deliverable->statusList;
$config->deliverable->dtable->fieldList['status']['sortType'] = true;
$config->deliverable->dtable->fieldList['status']['show']     = true;

$config->deliverable->dtable->fieldList['activity']['title']    = $lang->deliverable->activity;
$config->deliverable->dtable->fieldList['activity']['name']     = 'activity';
$config->deliverable->dtable->fieldList['activity']['type']     = 'text';
$config->deliverable->dtable->fieldList['activity']['sortType'] = true;
$config->deliverable->dtable->fieldList['activity']['show']     = true;

$config->deliverable->dtable->fieldList['trimmable']['title']    = $lang->deliverable->trimmable;
$config->deliverable->dtable->fieldList['trimmable']['name']     = 'trimmable';
$config->deliverable->dtable->fieldList['trimmable']['type']     = 'category';
$config->deliverable->dtable->fieldList['trimmable']['sortType'] = true;
$config->deliverable->dtable->fieldList['trimmable']['width']    = '120';
$config->deliverable->dtable->fieldList['trimmable']['map']      = $lang->deliverable->trimmableList;
$config->deliverable->dtable->fieldList['trimmable']['show']     = true;

$config->deliverable->dtable->fieldList['trimRule']['title']    = $lang->deliverable->trimRule;
$config->deliverable->dtable->fieldList['trimRule']['name']     = 'trimRule';
$config->deliverable->dtable->fieldList['trimRule']['type']     = 'text';
$config->deliverable->dtable->fieldList['trimRule']['sortType'] = true;
$config->deliverable->dtable->fieldList['trimRule']['width']    = '120';
$config->deliverable->dtable->fieldList['trimRule']['show']     = true;

$config->deliverable->dtable->fieldList['stage']['title']    = $lang->deliverable->when;
$config->deliverable->dtable->fieldList['stage']['name']     = 'stage';
$config->deliverable->dtable->fieldList['stage']['type']     = 'text';
$config->deliverable->dtable->fieldList['stage']['sortType'] = false;
$config->deliverable->dtable->fieldList['stage']['width']    = '120';
$config->deliverable->dtable->fieldList['stage']['show']     = true;

$config->deliverable->dtable->fieldList['required']['title']    = $lang->deliverable->required;
$config->deliverable->dtable->fieldList['required']['name']     = 'required';
$config->deliverable->dtable->fieldList['required']['type']     = 'text';
$config->deliverable->dtable->fieldList['required']['sortType'] = false;
$config->deliverable->dtable->fieldList['required']['width']    = '100';
$config->deliverable->dtable->fieldList['required']['show']     = true;

$config->deliverable->dtable->fieldList['createdBy']['title']    = $lang->deliverable->createdByAB;
$config->deliverable->dtable->fieldList['createdBy']['name']     = 'createdBy';
$config->deliverable->dtable->fieldList['createdBy']['type']     = 'user';
$config->deliverable->dtable->fieldList['createdBy']['sortType'] = true;
$config->deliverable->dtable->fieldList['createdBy']['width']    = '120';

$config->deliverable->dtable->fieldList['createdDate']['title']    = $lang->deliverable->createdDate;
$config->deliverable->dtable->fieldList['createdDate']['name']     = 'createdDate';
$config->deliverable->dtable->fieldList['createdDate']['type']     = 'date';
$config->deliverable->dtable->fieldList['createdDate']['sortType'] = true;
$config->deliverable->dtable->fieldList['createdDate']['width']    = '120';

$config->deliverable->dtable->fieldList['actions']['title']    = $lang->actions;
$config->deliverable->dtable->fieldList['actions']['type']     = 'actions';
$config->deliverable->dtable->fieldList['actions']['fixed']    = 'right';
$config->deliverable->dtable->fieldList['actions']['width']    = '100px';
$config->deliverable->dtable->fieldList['actions']['list']     = $config->deliverable->actionList;
$config->deliverable->dtable->fieldList['actions']['menu']     = array('enable|disable', 'edit', 'delete');
$config->deliverable->dtable->fieldList['actions']['sortType'] = false;
