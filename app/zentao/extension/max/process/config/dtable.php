<?php
global $lang;

$config->process->dtable = new stdclass();

$config->process->dtable->fieldList['id']['title']    = $lang->idAB;
$config->process->dtable->fieldList['id']['type']     = 'checkID';
$config->process->dtable->fieldList['id']['fixed']    = 'left';
$config->process->dtable->fieldList['id']['sortType'] = true;
$config->process->dtable->fieldList['id']['required'] = true;
$config->process->dtable->fieldList['id']['show']     = true;
$config->process->dtable->fieldList['id']['group']    = 1;

$config->process->dtable->fieldList['sort']['title'] = $lang->process->updateOrder;
$config->process->dtable->fieldList['sort']['fixed'] = 'left';
$config->process->dtable->fieldList['sort']['align'] = 'center';
$config->process->dtable->fieldList['sort']['group'] = 1;
$config->process->dtable->fieldList['sort']['show']  = true;
$config->process->dtable->fieldList['sort']['width'] = 60;

$config->process->dtable->fieldList['module']['title']    = $lang->process->module;
$config->process->dtable->fieldList['module']['fixed']    = 'left';
$config->process->dtable->fieldList['module']['align']    = 'left';
$config->process->dtable->fieldList['module']['sortType'] = true;
$config->process->dtable->fieldList['module']['group']    = 1;
$config->process->dtable->fieldList['module']['show']     = true;
$config->process->dtable->fieldList['module']['width']    = 120;
$config->process->dtable->fieldList['module']['type']     = 'category';

$config->process->dtable->fieldList['name']['title'] = $lang->process->name;
$config->process->dtable->fieldList['name']['fixed'] = 'left';
$config->process->dtable->fieldList['name']['type']  = 'title';
$config->process->dtable->fieldList['name']['group'] = 1;
$config->process->dtable->fieldList['name']['show']  = true;
$config->process->dtable->fieldList['name']['width'] = 300;
$config->process->dtable->fieldList['name']['link']  = array('module' => 'process', 'method' => 'view', 'params' => 'processID={id}');

$config->process->dtable->fieldList['abbr']['title'] = $lang->process->abbr;
$config->process->dtable->fieldList['abbr']['align'] = 'center';
$config->process->dtable->fieldList['abbr']['group'] = 5;
$config->process->dtable->fieldList['abbr']['type']  = 'text';
$config->process->dtable->fieldList['abbr']['width'] = 60;
$config->process->dtable->fieldList['abbr']['show']  = true;

$config->process->dtable->fieldList['desc']['title'] = $lang->process->desc;
$config->process->dtable->fieldList['desc']['align'] = 'left';
$config->process->dtable->fieldList['desc']['group'] = 6;
$config->process->dtable->fieldList['desc']['type']  = 'text';
$config->process->dtable->fieldList['desc']['show']  = true;

$config->process->dtable->fieldList['createdBy']['title'] = $lang->process->createdBy;
$config->process->dtable->fieldList['createdBy']['align'] = 'center';
$config->process->dtable->fieldList['createdBy']['group'] = 7;
$config->process->dtable->fieldList['createdBy']['type']  = 'user';
$config->process->dtable->fieldList['createdBy']['show']  = true;
$config->process->dtable->fieldList['createdBy']['width'] = 120;

$config->process->dtable->fieldList['createdDate']['title'] = $lang->process->createdDate;
$config->process->dtable->fieldList['createdDate']['align'] = 'center';
$config->process->dtable->fieldList['createdDate']['group'] = 7;
$config->process->dtable->fieldList['createdDate']['type']  = 'date';
$config->process->dtable->fieldList['createdDate']['show']  = true;
$config->process->dtable->fieldList['createdDate']['width'] = 120;

$config->process->dtable->fieldList['actions']['title']    = $lang->actions;
$config->process->dtable->fieldList['actions']['type']     = 'actions';
$config->process->dtable->fieldList['actions']['fixed']    = 'right';
$config->process->dtable->fieldList['actions']['sortType'] = false;
$config->process->dtable->fieldList['actions']['show']     = true;
$config->process->dtable->fieldList['actions']['width']    = 100;
$config->process->dtable->fieldList['actions']['list']     = $config->process->actionList;
$config->process->dtable->fieldList['actions']['menu']     = array('createActivity', 'activityList', 'edit', 'delete');
