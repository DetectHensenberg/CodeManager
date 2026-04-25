<?php
global $lang;
$config->weekly->actionList = array();
$config->weekly->actionList['edit']['icon'] = 'edit';
$config->weekly->actionList['edit']['text'] = $lang->weekly->editAction;
$config->weekly->actionList['edit']['hint'] = $lang->weekly->editAction;
$config->weekly->actionList['edit']['url']  = array('module' => 'weekly', 'method' => 'edit', 'params' => 'reportID={id}');

$config->weekly->actionList['delete']['icon']         = 'trash';
$config->weekly->actionList['delete']['hint']         = $lang->weekly->deleteAction;
$config->weekly->actionList['delete']['text']         = $lang->weekly->deleteAction;
$config->weekly->actionList['delete']['url']          = array('module' => 'weekly', 'method' => 'delete', 'params' => 'reportID={id}');
$config->weekly->actionList['delete']['data-confirm'] = array('message' => $lang->weekly->confirmDelete, 'icon' => 'icon-exclamation-sign', 'iconClass' => 'warning-pale rounded-full icon-2x');
$config->weekly->actionList['delete']['class']        = 'ajax-submit';
$config->weekly->actionList['delete']['notInModal']   = true;

$config->weekly->dtable = new stdclass();
$config->weekly->dtable->fieldList['id']['title']    = $lang->idAB;
$config->weekly->dtable->fieldList['id']['type']     = 'id';
$config->weekly->dtable->fieldList['id']['required'] = true;

$config->weekly->dtable->fieldList['title']['title']    = $lang->weekly->title;
$config->weekly->dtable->fieldList['title']['type']     = 'title';
$config->weekly->dtable->fieldList['title']['link']     = array('module' => 'weekly', 'method' => 'view', 'params' => "reportID={id}");
$config->weekly->dtable->fieldList['title']['required'] = true;

$config->weekly->dtable->fieldList['addedDate']['title']    = $lang->weekly->addedDate;
$config->weekly->dtable->fieldList['addedDate']['type']     = 'datetime';
$config->weekly->dtable->fieldList['addedDate']['required'] = true;

$config->weekly->dtable->fieldList['addedBy']['title']    = $lang->weekly->addedBy;
$config->weekly->dtable->fieldList['addedBy']['type']     = 'user';
$config->weekly->dtable->fieldList['addedBy']['width']    = '100';
$config->weekly->dtable->fieldList['addedBy']['required'] = true;

$config->weekly->dtable->fieldList['editedDate']['title']    = $lang->weekly->editedDate;
$config->weekly->dtable->fieldList['editedDate']['type']     = 'datetime';
$config->weekly->dtable->fieldList['editedDate']['required'] = true;

$config->weekly->dtable->fieldList['editedBy']['title']    = $lang->weekly->editedBy;
$config->weekly->dtable->fieldList['editedBy']['type']     = 'user';
$config->weekly->dtable->fieldList['editedBy']['width']    = '120';
$config->weekly->dtable->fieldList['editedBy']['required'] = true;

$config->weekly->dtable->fieldList['templateDesc']['title']    = $lang->weekly->desc;
$config->weekly->dtable->fieldList['templateDesc']['type']     = 'desc';
$config->weekly->dtable->fieldList['templateDesc']['sortType'] = true;

$config->weekly->dtable->fieldList['actions']['title'] = $lang->actions;
$config->weekly->dtable->fieldList['actions']['type']  = 'actions';
$config->weekly->dtable->fieldList['actions']['width'] = '100';
$config->weekly->dtable->fieldList['actions']['list']  = $config->weekly->actionList;
$config->weekly->dtable->fieldList['actions']['menu']  = array('edit', 'delete');
