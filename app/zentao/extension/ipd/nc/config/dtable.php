<?php
global $lang, $app;
$config->nc->dtable = new stdclass();
$config->nc->dtable->fieldList['id']['title'] = $lang->idAB;
$config->nc->dtable->fieldList['id']['fixed'] = 'left';
$config->nc->dtable->fieldList['id']['width'] = '70';
$config->nc->dtable->fieldList['id']['type']  = 'id';
$config->nc->dtable->fieldList['id']['show']  = true;

$config->nc->dtable->fieldList['title']['title']    = $lang->nc->title;
$config->nc->dtable->fieldList['title']['fixed']    = 'left';
$config->nc->dtable->fieldList['title']['type']     = 'title';
$config->nc->dtable->fieldList['title']['link']     = array('module' => 'nc', 'method' => 'view', 'params' => "id={id}");
$config->nc->dtable->fieldList['title']['data-app'] = $app->tab;
$config->nc->dtable->fieldList['title']['show']     = true;

$config->nc->dtable->fieldList['severity']['title'] = $lang->nc->severity;
$config->nc->dtable->fieldList['severity']['type']  = 'severity';
$config->nc->dtable->fieldList['severity']['show']  = true;

$config->nc->dtable->fieldList['status']['title']     = $lang->nc->status;
$config->nc->dtable->fieldList['status']['type']      = 'status';
$config->nc->dtable->fieldList['status']['show']      = true;
$config->nc->dtable->fieldList['status']['statusMap'] = $lang->nc->statusList;

$config->nc->dtable->fieldList['type']['title']    = $lang->nc->type;
$config->nc->dtable->fieldList['type']['type']     = 'category';
$config->nc->dtable->fieldList['type']['sortType'] = true;
$config->nc->dtable->fieldList['type']['show']     = true;
$config->nc->dtable->fieldList['type']['map']      = $lang->nc->typeList;

$config->nc->dtable->fieldList['auditplan']['title']    = $lang->nc->auditplan;
$config->nc->dtable->fieldList['auditplan']['width']    = '150';
$config->nc->dtable->fieldList['auditplan']['type']     = 'text';
$config->nc->dtable->fieldList['auditplan']['sortType'] = true;
$config->nc->dtable->fieldList['auditplan']['show']     = true;

$config->nc->dtable->fieldList['createdBy']['title'] = $lang->nc->createdBy;
$config->nc->dtable->fieldList['createdBy']['width'] = '120';
$config->nc->dtable->fieldList['createdBy']['type']  = 'user';

$config->nc->dtable->fieldList['createdDate']['title'] = $lang->nc->createdDate;
$config->nc->dtable->fieldList['createdDate']['width'] = '120';
$config->nc->dtable->fieldList['createdDate']['type']  = 'date';
$config->nc->dtable->fieldList['createdDate']['show']  = true;

$config->nc->dtable->fieldList['assignedTo']['title']      = $lang->nc->assignedTo;
$config->nc->dtable->fieldList['assignedTo']['width']      = '120';
$config->nc->dtable->fieldList['assignedTo']['type']       = 'assign';
$config->nc->dtable->fieldList['assignedTo']['assignLink'] = array('module' => 'nc', 'method' => 'assignTo', 'params' => "id={id}");
$config->nc->dtable->fieldList['assignedTo']['show']       = true;

$config->nc->dtable->fieldList['deadline']['title'] = $lang->nc->deadline;
$config->nc->dtable->fieldList['deadline']['width'] = '120';
$config->nc->dtable->fieldList['deadline']['type']  = 'date';
$config->nc->dtable->fieldList['deadline']['show']  = true;

$config->nc->dtable->fieldList['resolution']['title'] = $lang->nc->resolution;
$config->nc->dtable->fieldList['resolution']['width'] = '100';
$config->nc->dtable->fieldList['resolution']['map']   = $lang->nc->resolutionList;
$config->nc->dtable->fieldList['resolution']['type']  = 'text';

$config->nc->dtable->fieldList['resolvedBy']['title'] = $lang->nc->resolvedBy;
$config->nc->dtable->fieldList['resolvedBy']['width'] = '120';
$config->nc->dtable->fieldList['resolvedBy']['type']  = 'user';

$config->nc->dtable->fieldList['resolvedDate']['title'] = $lang->nc->resolvedDate;
$config->nc->dtable->fieldList['resolvedDate']['width'] = '120';
$config->nc->dtable->fieldList['resolvedDate']['type']  = 'date';

$config->nc->dtable->fieldList['closedBy']['title'] = $lang->nc->closedBy;
$config->nc->dtable->fieldList['closedBy']['width'] = '120';
$config->nc->dtable->fieldList['closedBy']['type']  = 'user';

$config->nc->dtable->fieldList['closedDate']['title'] = $lang->nc->closedDate;
$config->nc->dtable->fieldList['closedDate']['width'] = '120';
$config->nc->dtable->fieldList['closedDate']['type']  = 'date';

$config->nc->dtable->fieldList['actions']['title'] = $lang->actions;
$config->nc->dtable->fieldList['actions']['fixed'] = 'right';
$config->nc->dtable->fieldList['actions']['width'] = '140';
$config->nc->dtable->fieldList['actions']['type']  = 'actions';
$config->nc->dtable->fieldList['actions']['list']  = $config->nc->actionList;
$config->nc->dtable->fieldList['actions']['menu']  = array('resolve', 'activate', 'edit', 'close', 'delete');
