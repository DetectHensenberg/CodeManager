<?php
if(helper::hasFeature('deliverable'))
{
    $config->execution->form->deliverable['deliverable']  = array('type' => 'array', 'required' => false, 'default' => array());
    $config->execution->form->close['deliverable']        = array('type' => 'array', 'required' => false, 'default' => array());
}

$config->execution->testtask->dtable->fieldList = array();
$config->execution->testtask->dtable->fieldList['id']['name']     = 'taskID';
$config->execution->testtask->dtable->fieldList['id']['title']    = $lang->idAB;
$config->execution->testtask->dtable->fieldList['id']['type']     = 'checkID';
$config->execution->testtask->dtable->fieldList['id']['checkbox'] = true;
$config->execution->testtask->dtable->fieldList['id']['group']    = '2';
$config->execution->testtask->dtable->fieldList['id']['fixed']    = 'left';

$config->execution->testtask->dtable->fieldList['title']['name']     = 'name';
$config->execution->testtask->dtable->fieldList['title']['title']    = $lang->testtask->name;
$config->execution->testtask->dtable->fieldList['title']['type']     = 'title';
$config->execution->testtask->dtable->fieldList['title']['link']     = array('module' => 'testtask', 'method' => 'cases', 'params' => 'taskID={id}');
$config->execution->testtask->dtable->fieldList['title']['group']    = '2';
$config->execution->testtask->dtable->fieldList['title']['fixed']    = 'left';
$config->execution->testtask->dtable->fieldList['title']['width']    = '356';
$config->execution->testtask->dtable->fieldList['title']['data-app'] = 'execution';

$config->execution->testtask->dtable->fieldList['pri']['name']  = 'pri';
$config->execution->testtask->dtable->fieldList['pri']['title'] = $lang->priAB;
$config->execution->testtask->dtable->fieldList['pri']['type']  = 'pri';
$config->execution->testtask->dtable->fieldList['pri']['show']  = true;

$config->execution->testtask->dtable->fieldList['product']['name']  = 'productName';
$config->execution->testtask->dtable->fieldList['product']['title'] = $lang->testtask->product;
$config->execution->testtask->dtable->fieldList['product']['type']  = 'text';
$config->execution->testtask->dtable->fieldList['product']['group'] = '1';

$config->execution->testtask->dtable->fieldList['build']['name']  = 'buildName';
$config->execution->testtask->dtable->fieldList['build']['title'] = $lang->testtask->build;
$config->execution->testtask->dtable->fieldList['build']['type']  = 'text';
$config->execution->testtask->dtable->fieldList['build']['link']  = array('module' => 'projectbuild', 'method' => 'view', 'params' => 'buildID={build}');
$config->execution->testtask->dtable->fieldList['build']['group'] = 'text';
$config->execution->testtask->dtable->fieldList['build']['group'] = '3';

$config->execution->testtask->dtable->fieldList['execution']['name']  = 'executionName';
$config->execution->testtask->dtable->fieldList['execution']['title'] = $lang->testtask->execution;
$config->execution->testtask->dtable->fieldList['execution']['type']  = 'text';
$config->execution->testtask->dtable->fieldList['execution']['group'] = 'text';
$config->execution->testtask->dtable->fieldList['execution']['group'] = '3';

$config->execution->testtask->dtable->fieldList['owner']['name']    = 'owner';
$config->execution->testtask->dtable->fieldList['owner']['title']   = $lang->testtask->owner;
$config->execution->testtask->dtable->fieldList['owner']['type']    = 'user';
$config->execution->testtask->dtable->fieldList['owner']['group']   = '4';

$config->execution->testtask->dtable->fieldList['begin']['name']  = 'begin';
$config->execution->testtask->dtable->fieldList['begin']['title'] = $lang->testtask->begin;
$config->execution->testtask->dtable->fieldList['begin']['type']  = 'date';
$config->execution->testtask->dtable->fieldList['begin']['group'] = '4';

$config->execution->testtask->dtable->fieldList['end']['name']  = 'end';
$config->execution->testtask->dtable->fieldList['end']['title'] = $lang->testtask->end;
$config->execution->testtask->dtable->fieldList['end']['type']  = 'date';
$config->execution->testtask->dtable->fieldList['end']['group'] = '4';

$config->execution->testtask->dtable->fieldList['status']['name']      = 'status';
$config->execution->testtask->dtable->fieldList['status']['title']     = $lang->testtask->status;
$config->execution->testtask->dtable->fieldList['status']['type']      = 'status';
$config->execution->testtask->dtable->fieldList['status']['statusMap'] = $lang->testtask->statusList;
$config->execution->testtask->dtable->fieldList['status']['group']     = '4';

$config->execution->testtask->dtable->fieldList['actions']['name']     = 'actions';
$config->execution->testtask->dtable->fieldList['actions']['title']    = $lang->actions;
$config->execution->testtask->dtable->fieldList['actions']['type']     = 'actions';
$config->execution->testtask->dtable->fieldList['actions']['sortType'] = false;
$config->execution->testtask->dtable->fieldList['actions']['fixed']    = 'right';
$config->execution->testtask->dtable->fieldList['actions']['list']     = $config->execution->testtaskActionList;
$config->execution->testtask->dtable->fieldList['actions']['menu']     = array(array('start', 'other' => array('activate', 'close')), 'cases', 'linkCase', 'report', 'view', 'edit', 'delete');
