<?php
global $lang;

$config->researchplan->actionList['edit']['icon']  = 'edit';
$config->researchplan->actionList['edit']['hint']  = $lang->researchplan->edit;
$config->researchplan->actionList['edit']['text']  = $lang->researchplan->edit;
$config->researchplan->actionList['edit']['url']   = array('module' => 'researchplan', 'method' => 'edit', 'params' => 'id={id}');
$config->researchplan->actionList['edit']['order'] = 5;

$config->researchplan->actionList['createReport']['icon']  = 'summary';
$config->researchplan->actionList['createReport']['hint']  = $lang->researchplan->createReport;
$config->researchplan->actionList['createReport']['text']  = $lang->researchplan->createReport;
$config->researchplan->actionList['createReport']['url']   = array('module' => 'researchreport', 'method' => 'create', 'params' => 'projectID={project}&id={id}');
$config->researchplan->actionList['createReport']['order'] = 5;

$config->researchplan->actionList['delete']['icon']         = 'trash';
$config->researchplan->actionList['delete']['hint']         = $lang->researchplan->delete;
$config->researchplan->actionList['delete']['text']         = $lang->researchplan->delete;
$config->researchplan->actionList['delete']['url']          = array('module' => 'researchplan', 'method' => 'delete', 'params' => 'id={id}&confirm=yes');
$config->researchplan->actionList['delete']['order']        = 10;
$config->researchplan->actionList['delete']['className']    = 'ajax-submit';
$config->researchplan->actionList['delete']['data-confirm'] = array('message' => $lang->researchplan->confirmDelete, 'icon' => 'icon-exclamation-sign', 'iconClass' => 'warning-pale rounded-full icon-2x');

$config->researchplan->dtable = new stdclass();
$config->researchplan->dtable->fieldList['id']['title']    = $lang->idAB;
$config->researchplan->dtable->fieldList['id']['type']     = 'checkID';
$config->researchplan->dtable->fieldList['id']['sortType'] = true;
$config->researchplan->dtable->fieldList['id']['checkbox'] = false;
$config->researchplan->dtable->fieldList['id']['required'] = true;

$config->researchplan->dtable->fieldList['name']['title']        = $lang->researchplan->name;
$config->researchplan->dtable->fieldList['name']['fixed']        = 'left';
$config->researchplan->dtable->fieldList['name']['flex']         = 1;
$config->researchplan->dtable->fieldList['name']['type']         = 'nestedTitle';
$config->researchplan->dtable->fieldList['name']['nestedToggle'] = false;
$config->researchplan->dtable->fieldList['name']['sortType']     = true;
$config->researchplan->dtable->fieldList['name']['link']         = array('url' => array('module' => 'researchplan', 'method' => 'view', 'params' => 'id={id}'));
$config->researchplan->dtable->fieldList['name']['required']     = true;

$config->researchplan->dtable->fieldList['customer']['title']    = $lang->researchplan->customer;
$config->researchplan->dtable->fieldList['customer']['type']     = 'text';
$config->researchplan->dtable->fieldList['customer']['sortType'] = true;
$config->researchplan->dtable->fieldList['customer']['show']     = true;
$config->researchplan->dtable->fieldList['customer']['group']    = 1;

$config->researchplan->dtable->fieldList['begin']['title']     = $lang->researchplan->begin;
$config->researchplan->dtable->fieldList['begin']['type']      = 'date';
$config->researchplan->dtable->fieldList['begin']['sortType']  = true;
$config->researchplan->dtable->fieldList['begin']['show']      = true;
$config->researchplan->dtable->fieldList['begin']['group']     = 1;

$config->researchplan->dtable->fieldList['end']['title']    = $lang->researchplan->end;
$config->researchplan->dtable->fieldList['end']['type']     = 'date';
$config->researchplan->dtable->fieldList['end']['sortType'] = true;
$config->researchplan->dtable->fieldList['end']['show']      = true;
$config->researchplan->dtable->fieldList['end']['group']    = 1;

$config->researchplan->dtable->fieldList['location']['title']    = $lang->researchplan->location;
$config->researchplan->dtable->fieldList['location']['type']     = 'text';
$config->researchplan->dtable->fieldList['location']['sortType'] = true;
$config->researchplan->dtable->fieldList['location']['show']    = '1';
$config->researchplan->dtable->fieldList['location']['group']    = 1;

$config->researchplan->dtable->fieldList['method']['title']    = $lang->researchplan->method;
$config->researchplan->dtable->fieldList['method']['type']     = 'category';
$config->researchplan->dtable->fieldList['method']['map']      = $lang->researchplan->methodList;
$config->researchplan->dtable->fieldList['method']['sortType'] = true;

$config->researchplan->dtable->fieldList['actions']['type']     = 'actions';
$config->researchplan->dtable->fieldList['actions']['list']     = $config->researchplan->actionList;
$config->researchplan->dtable->fieldList['actions']['menu']     = array('edit', 'createReport');
$config->researchplan->dtable->fieldList['actions']['required'] = true;
