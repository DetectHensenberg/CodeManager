<?php
global $lang, $app;
$config->reviewcl->dtable = new stdclass();
$config->reviewcl->dtable->fieldList['id']['title']    = $lang->idAB;
$config->reviewcl->dtable->fieldList['id']['type']     = 'id';
$config->reviewcl->dtable->fieldList['id']['fixed']    = 'left';
$config->reviewcl->dtable->fieldList['id']['sortType'] = true;
$config->reviewcl->dtable->fieldList['id']['required'] = true;
$config->reviewcl->dtable->fieldList['id']['group']    = 1;

$config->reviewcl->dtable->fieldList['object']['name']     = 'object';
$config->reviewcl->dtable->fieldList['object']['title']    = $lang->reviewcl->object;
$config->reviewcl->dtable->fieldList['object']['fixed']    = 'left';
$config->reviewcl->dtable->fieldList['object']['type']     = 'category';
$config->reviewcl->dtable->fieldList['object']['show']     = true;
$config->reviewcl->dtable->fieldList['object']['sortType'] = true;
$config->reviewcl->dtable->fieldList['object']['width']    = 150;
$config->reviewcl->dtable->fieldList['object']['group']    = 1;

$config->reviewcl->dtable->fieldList['title']['title']    = $lang->reviewcl->title;
$config->reviewcl->dtable->fieldList['title']['type']     = 'title';
$config->reviewcl->dtable->fieldList['title']['fixed']    = 'left';
$config->reviewcl->dtable->fieldList['title']['link']     = array('module' => 'reviewcl', 'method' => 'view', 'params' => "reviewclID={id}");
$config->reviewcl->dtable->fieldList['title']['required'] = true;
$config->reviewcl->dtable->fieldList['title']['sortType'] = true;
$config->reviewcl->dtable->fieldList['title']['group']    = 1;

$config->reviewcl->dtable->fieldList['category']['name']     = 'category';
$config->reviewcl->dtable->fieldList['category']['title']    = $lang->reviewcl->category;
$config->reviewcl->dtable->fieldList['category']['type']     = 'category';
$config->reviewcl->dtable->fieldList['category']['show']     = true;
$config->reviewcl->dtable->fieldList['category']['sortType'] = true;
$config->reviewcl->dtable->fieldList['category']['required'] = false;
$config->reviewcl->dtable->fieldList['category']['group']    = 2;

$config->reviewcl->dtable->fieldList['createdBy']['name']     = 'createdBy';
$config->reviewcl->dtable->fieldList['createdBy']['title']    = $lang->review->createdBy;
$config->reviewcl->dtable->fieldList['createdBy']['width']    = '120';
$config->reviewcl->dtable->fieldList['createdBy']['show']     = true;
$config->reviewcl->dtable->fieldList['createdBy']['type']     = 'user';
$config->reviewcl->dtable->fieldList['createdBy']['required'] = false;
$config->reviewcl->dtable->fieldList['createdBy']['group']    = 3;

$config->reviewcl->dtable->fieldList['createdDate']['name']     = 'createdDate';
$config->reviewcl->dtable->fieldList['createdDate']['title']    = $lang->reviewcl->createdDate;
$config->reviewcl->dtable->fieldList['createdDate']['width']    = '120';
$config->reviewcl->dtable->fieldList['createdDate']['show']     = true;
$config->reviewcl->dtable->fieldList['createdDate']['type']     = 'date';
$config->reviewcl->dtable->fieldList['createdDate']['required'] = false;
$config->reviewcl->dtable->fieldList['createdDate']['group']    = 3;

$config->reviewcl->dtable->fieldList['actions']['title']    = $lang->actions;
$config->reviewcl->dtable->fieldList['actions']['type']     = 'actions';
$config->reviewcl->dtable->fieldList['actions']['fixed']    = 'right';
$config->reviewcl->dtable->fieldList['actions']['sortType'] = false;
$config->reviewcl->dtable->fieldList['actions']['show']     = true;
$config->reviewcl->dtable->fieldList['actions']['width']    = 100;
$config->reviewcl->dtable->fieldList['actions']['list']     = $config->reviewcl->actionList;
$config->reviewcl->dtable->fieldList['actions']['menu']     = array('edit', 'delete');
