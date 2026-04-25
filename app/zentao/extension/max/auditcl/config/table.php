<?php
global $lang;
$config->auditcl->dtable = new stdClass();
$config->auditcl->dtable->fieldList['id']['title']    = $lang->idAB;
$config->auditcl->dtable->fieldList['id']['type']     = 'checkID';
$config->auditcl->dtable->fieldList['id']['fixed']    = 'left';
$config->auditcl->dtable->fieldList['id']['sortType'] = true;

$config->auditcl->dtable->fieldList['title']['title']    = $lang->auditcl->title;
$config->auditcl->dtable->fieldList['title']['type']     = 'title';
$config->auditcl->dtable->fieldList['title']['fixed']    = 'left';
$config->auditcl->dtable->fieldList['title']['sortType'] = true;

$config->auditcl->dtable->fieldList['process']['title']    = $lang->auditcl->process;
$config->auditcl->dtable->fieldList['process']['type']     = 'text';
$config->auditcl->dtable->fieldList['process']['sortType'] = false;

$config->auditcl->dtable->fieldList['activity']['title']    = $lang->auditcl->activity;
$config->auditcl->dtable->fieldList['activity']['type']     = 'text';
$config->auditcl->dtable->fieldList['activity']['sortType'] = false;

$config->auditcl->dtable->fieldList['createdBy']['title']    = $lang->auditcl->createdBy;
$config->auditcl->dtable->fieldList['createdBy']['type']     = 'user';
$config->auditcl->dtable->fieldList['createdBy']['sortType'] = true;

$config->auditcl->dtable->fieldList['createdDate']['title']    = $lang->auditcl->createdDate;
$config->auditcl->dtable->fieldList['createdDate']['type']     = 'date';
$config->auditcl->dtable->fieldList['createdDate']['sortType'] = true;

$config->auditcl->dtable->fieldList['actions']['title']    = $lang->actions;
$config->auditcl->dtable->fieldList['actions']['type']     = 'actions';
$config->auditcl->dtable->fieldList['actions']['sortType'] = false;
$config->auditcl->dtable->fieldList['actions']['fixed']    = 'right';
$config->auditcl->dtable->fieldList['actions']['list']     = $config->auditcl->actionList;
$config->auditcl->dtable->fieldList['actions']['menu']     = array('edit', 'delete');