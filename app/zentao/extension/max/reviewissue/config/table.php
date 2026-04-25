<?php
global $lang, $app;
$config->reviewissue->dtable = new stdclass();

$config->reviewissue->dtable->fieldList['id']['title']    = $lang->idAB;
$config->reviewissue->dtable->fieldList['id']['type']     = 'text';
$config->reviewissue->dtable->fieldList['id']['fixed']    = 'left';
$config->reviewissue->dtable->fieldList['id']['sortType'] = true;
$config->reviewissue->dtable->fieldList['id']['required'] = true;
$config->reviewissue->dtable->fieldList['id']['width']    = '80';
$config->reviewissue->dtable->fieldList['id']['group']    = 1;

$config->reviewissue->dtable->fieldList['title']['title']    = $lang->reviewissue->title;
$config->reviewissue->dtable->fieldList['title']['type']     = 'title';
$config->reviewissue->dtable->fieldList['title']['fixed']    = 'left';
$config->reviewissue->dtable->fieldList['title']['link']     = array('module' => 'reviewissue', 'method' => 'view', 'params' => "issueID={id}");
$config->reviewissue->dtable->fieldList['title']['required'] = true;
$config->reviewissue->dtable->fieldList['title']['width']    = '220';
$config->reviewissue->dtable->fieldList['title']['group']    = 1;
$config->reviewissue->dtable->fieldList['title']['data-app'] = $app->tab;
$config->reviewissue->dtable->fieldList['title']['sortType'] = true;

$config->reviewissue->dtable->fieldList['reviewtitle']['title']    = $lang->reviewissue->review;
$config->reviewissue->dtable->fieldList['reviewtitle']['type']     = 'title';
$config->reviewissue->dtable->fieldList['reviewtitle']['link']     = array('module' => 'reviewissue', 'method' => 'view', 'params' => "issueID={id}");
$config->reviewissue->dtable->fieldList['reviewtitle']['group']    = 2;
$config->reviewissue->dtable->fieldList['reviewtitle']['width']    = '220';
$config->reviewissue->dtable->fieldList['reviewtitle']['data-app'] = $app->tab;
$config->reviewissue->dtable->fieldList['reviewtitle']['sortType'] = true;

$config->reviewissue->dtable->fieldList['opinion']['title']    = $lang->reviewissue->opinion;
$config->reviewissue->dtable->fieldList['opinion']['type']     = 'text';
$config->reviewissue->dtable->fieldList['opinion']['link']     = array('module' => 'reviewissue', 'method' => 'view', 'params' => "issueID={id}");
$config->reviewissue->dtable->fieldList['opinion']['show']     = true;
$config->reviewissue->dtable->fieldList['opinion']['group']    = 2;
$config->reviewissue->dtable->fieldList['opinion']['sortType'] = true;

$config->reviewissue->dtable->fieldList['status']['title']     = $lang->reviewissue->status;
$config->reviewissue->dtable->fieldList['status']['type']      = 'status';
$config->reviewissue->dtable->fieldList['status']['statusMap'] = $lang->reviewissue->statusList;
$config->reviewissue->dtable->fieldList['status']['show']      = true;
$config->reviewissue->dtable->fieldList['status']['group']     = 2;
$config->reviewissue->dtable->fieldList['status']['sortType']  = true;

$config->reviewissue->dtable->fieldList['assignedTo']['title']       = $lang->reviewissue->assignedTo;
$config->reviewissue->dtable->fieldList['assignedTo']['type']        = 'assign';
$config->reviewissue->dtable->fieldList['assignedTo']['assignLink']  = array('module' => 'reviewissue', 'method' => 'assignTo', 'params' => 'issueID={id}');
$config->reviewissue->dtable->fieldList['assignedTo']['show']        = true;
$config->reviewissue->dtable->fieldList['assignedTo']['width']       = '120';
$config->reviewissue->dtable->fieldList['assignedTo']['group']       = 2;
$config->reviewissue->dtable->fieldList['assignedTo']['data-toggle'] = 'modal';
$config->reviewissue->dtable->fieldList['assignedTo']['sortType']    = true;

$config->reviewissue->dtable->fieldList['resolution']['title']     = $lang->reviewissue->resolution;
$config->reviewissue->dtable->fieldList['resolution']['type']      = 'category';
$config->reviewissue->dtable->fieldList['resolution']['map']       = $lang->reviewissue->resolutionList;
$config->reviewissue->dtable->fieldList['resolution']['show']      = true;
$config->reviewissue->dtable->fieldList['resolution']['group']     = 2;
$config->reviewissue->dtable->fieldList['resolution']['sortType']  = true;

$config->reviewissue->dtable->fieldList['createdBy']['title']    = $lang->reviewissue->createdBy;
$config->reviewissue->dtable->fieldList['createdBy']['type']     = 'user';
$config->reviewissue->dtable->fieldList['createdBy']['show']     = true;
$config->reviewissue->dtable->fieldList['createdBy']['width']    = '80';
$config->reviewissue->dtable->fieldList['createdBy']['group']    = 4;
$config->reviewissue->dtable->fieldList['createdBy']['sortType'] = true;

$config->reviewissue->dtable->fieldList['createdDate']['title']    = $lang->reviewissue->createdDate;
$config->reviewissue->dtable->fieldList['createdDate']['type']     = 'date';
$config->reviewissue->dtable->fieldList['createdDate']['show']     = true;
$config->reviewissue->dtable->fieldList['createdDate']['group']    = 4;
$config->reviewissue->dtable->fieldList['createdDate']['sortType'] = 'date';

$config->reviewissue->dtable->fieldList['actions']['title']    = $lang->actions;
$config->reviewissue->dtable->fieldList['actions']['type']     = 'actions';
$config->reviewissue->dtable->fieldList['actions']['width']    = 'auto';
$config->reviewissue->dtable->fieldList['actions']['sortType'] = false;
$config->reviewissue->dtable->fieldList['actions']['fixed']    = 'right';
$config->reviewissue->dtable->fieldList['actions']['list']     = $config->reviewissue->actionList;
$config->reviewissue->dtable->fieldList['actions']['menu']     = array('edit', 'resolved', 'close', 'active', 'delete');