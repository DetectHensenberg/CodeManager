<?php
global $lang;

$config->activity->dtable = new stdclass();
$config->activity->dtable->fieldList['id']['title']    = $lang->idAB;
$config->activity->dtable->fieldList['id']['type']     = 'checkID';
$config->activity->dtable->fieldList['id']['fixed']    = 'left';
$config->activity->dtable->fieldList['id']['sortType'] = true;
$config->activity->dtable->fieldList['id']['show']     = true;
$config->activity->dtable->fieldList['id']['group']    = 1;

$config->activity->dtable->fieldList['order']['title']    = $lang->activity->sort;
$config->activity->dtable->fieldList['order']['fixed']    = 'left';
$config->activity->dtable->fieldList['order']['sortType'] = true;
$config->activity->dtable->fieldList['order']['show']     = true;
$config->activity->dtable->fieldList['order']['group']    = 1;
$config->activity->dtable->fieldList['order']['width']    = '50px';

$config->activity->dtable->fieldList['process']['title']    = $lang->activity->process;
$config->activity->dtable->fieldList['process']['type']     = 'category';
$config->activity->dtable->fieldList['process']['fixed']    = 'left';
$config->activity->dtable->fieldList['process']['sortType'] = true;
$config->activity->dtable->fieldList['process']['show']     = true;
$config->activity->dtable->fieldList['process']['group']    = 1;
$config->activity->dtable->fieldList['process']['width']    = '100px';

$config->activity->dtable->fieldList['name']['title']    = $lang->activity->name;
$config->activity->dtable->fieldList['name']['type']     = 'title';
$config->activity->dtable->fieldList['name']['fixed']    = 'left';
$config->activity->dtable->fieldList['name']['link']     = array('module' => 'activity', 'method' => 'view', 'params' => "activityID={id}");
$config->activity->dtable->fieldList['name']['sortType'] = true;
$config->activity->dtable->fieldList['name']['show']     = true;
$config->activity->dtable->fieldList['name']['required'] = true;
$config->activity->dtable->fieldList['name']['group']    = 1;

$config->activity->dtable->fieldList['optional']['title']    = $lang->activity->optional;
$config->activity->dtable->fieldList['optional']['type']     = 'category';
$config->activity->dtable->fieldList['optional']['map']      = $lang->activity->optionalList;
$config->activity->dtable->fieldList['optional']['sortType'] = true;
$config->activity->dtable->fieldList['optional']['show']     = true;
$config->activity->dtable->fieldList['optional']['group']    = 2;

$config->activity->dtable->fieldList['tailorNorm']['title']    = $lang->activity->tailorNorm;
$config->activity->dtable->fieldList['tailorNorm']['type']     = 'category';
$config->activity->dtable->fieldList['tailorNorm']['sortType'] = true;
$config->activity->dtable->fieldList['tailorNorm']['show']     = true;
$config->activity->dtable->fieldList['tailorNorm']['group']    = 3;

$config->activity->dtable->fieldList['createdBy']['title']    = $lang->activity->createdBy;
$config->activity->dtable->fieldList['createdBy']['type']     = 'user';
$config->activity->dtable->fieldList['createdBy']['sortType'] = true;
$config->activity->dtable->fieldList['createdBy']['show']     = true;
$config->activity->dtable->fieldList['createdBy']['group']    = 4;

$config->activity->dtable->fieldList['createdDate']['title']    = $lang->activity->createdDate;
$config->activity->dtable->fieldList['createdDate']['type']     = 'date';
$config->activity->dtable->fieldList['createdDate']['sortType'] = true;
$config->activity->dtable->fieldList['createdDate']['show']     = true;
$config->activity->dtable->fieldList['createdDate']['group']    = 5;

$config->activity->dtable->fieldList['actions']['title']    = $lang->actions;
$config->activity->dtable->fieldList['actions']['type']     = 'actions';
$config->activity->dtable->fieldList['actions']['fixed']    = 'right';
$config->activity->dtable->fieldList['actions']['sortType'] = false;
$config->activity->dtable->fieldList['actions']['show']     = true;
$config->activity->dtable->fieldList['actions']['width']    = 100;
$config->activity->dtable->fieldList['actions']['list']     = $config->activity->actionList;
$config->activity->dtable->fieldList['actions']['menu']     = array('edit', 'delete');
