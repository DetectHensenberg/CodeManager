<?php
global $lang, $app;
$isEn = $app->getClientLang() == 'en';

$config->auditplan->dtable = new stdclass();
$config->auditplan->dtable->fieldList['id']['name']     = 'id';
$config->auditplan->dtable->fieldList['id']['title']    = $lang->idAB;
$config->auditplan->dtable->fieldList['id']['type']     = 'checkID';
$config->auditplan->dtable->fieldList['id']['fixed']    = 'left';
$config->auditplan->dtable->fieldList['id']['sortType'] = true;
$config->auditplan->dtable->fieldList['id']['show']     = true;
$config->auditplan->dtable->fieldList['id']['group']    = 1;

$config->auditplan->dtable->fieldList['objectID']['name']     = 'objectID';
$config->auditplan->dtable->fieldList['objectID']['title']    = $lang->auditplan->objectID;
$config->auditplan->dtable->fieldList['objectID']['type']     = 'title';
$config->auditplan->dtable->fieldList['objectID']['fixed']    = 'left';
$config->auditplan->dtable->fieldList['objectID']['sortType'] = true;
$config->auditplan->dtable->fieldList['objectID']['link']     = array('module' => 'auditplan', 'method' => 'view', 'params' => 'auditplanID={id}');
$config->auditplan->dtable->fieldList['objectID']['show']     = true;
$config->auditplan->dtable->fieldList['objectID']['data-app'] = $app->tab;
$config->auditplan->dtable->fieldList['objectID']['group']    = 2;

$config->auditplan->dtable->fieldList['process']['name']     = 'process';
$config->auditplan->dtable->fieldList['process']['title']    = $lang->auditplan->process;
$config->auditplan->dtable->fieldList['process']['type']     = 'category';
$config->auditplan->dtable->fieldList['process']['sortType'] = true;
$config->auditplan->dtable->fieldList['process']['show']     = false;
$config->auditplan->dtable->fieldList['process']['group']    = 3;

$config->auditplan->dtable->fieldList['execution']['name']     = 'execution';
$config->auditplan->dtable->fieldList['execution']['title']    = $lang->auditplan->execution;
$config->auditplan->dtable->fieldList['execution']['type']     = 'category';
$config->auditplan->dtable->fieldList['execution']['sortType'] = true;
$config->auditplan->dtable->fieldList['execution']['show']     = true;
$config->auditplan->dtable->fieldList['execution']['width']    = 150;
$config->auditplan->dtable->fieldList['execution']['group']    = 4;
if($isEn) $config->auditplan->dtable->fieldList['execution']['width'] = 180;

$config->auditplan->dtable->fieldList['status']['name']      = 'status';
$config->auditplan->dtable->fieldList['status']['title']     = $lang->auditplan->status;
$config->auditplan->dtable->fieldList['status']['type']      = 'status';
$config->auditplan->dtable->fieldList['status']['statusMap'] = $lang->auditplan->statusList;
$config->auditplan->dtable->fieldList['status']['sortType']  = true;
$config->auditplan->dtable->fieldList['status']['show']      = true;
$config->auditplan->dtable->fieldList['status']['group']     = 5;

$config->auditplan->dtable->fieldList['createdBy']['name']     = 'createdBy';
$config->auditplan->dtable->fieldList['createdBy']['title']    = $lang->auditplan->createdBy;
$config->auditplan->dtable->fieldList['createdBy']['type']     = 'user';
$config->auditplan->dtable->fieldList['createdBy']['sortType'] = true;
$config->auditplan->dtable->fieldList['createdBy']['show']     = true;
$config->auditplan->dtable->fieldList['createdBy']['group']    = 6;
if($isEn) $config->auditplan->dtable->fieldList['createdBy']['width'] = 120;

$config->auditplan->dtable->fieldList['createdDate']['name']     = 'createdDate';
$config->auditplan->dtable->fieldList['createdDate']['title']    = $lang->auditplan->createdDate;
$config->auditplan->dtable->fieldList['createdDate']['type']     = 'date';
$config->auditplan->dtable->fieldList['createdDate']['sortType'] = true;
$config->auditplan->dtable->fieldList['createdDate']['show']     = true;
$config->auditplan->dtable->fieldList['createdDate']['group']    = 6;
if($isEn) $config->auditplan->dtable->fieldList['createdDate']['width'] = 120;

$config->auditplan->dtable->fieldList['assignedTo']['name']       = 'assignedTo';
$config->auditplan->dtable->fieldList['assignedTo']['title']      = $lang->auditplan->assignedTo;
$config->auditplan->dtable->fieldList['assignedTo']['type']       = 'assign';
$config->auditplan->dtable->fieldList['assignedTo']['assignLink'] = array('module' => 'auditplan', 'method' => 'assignTo', 'params' => 'auditplanID={id}');
$config->auditplan->dtable->fieldList['assignedTo']['sortType']   = true;
$config->auditplan->dtable->fieldList['assignedTo']['show']       = true;
$config->auditplan->dtable->fieldList['assignedTo']['group']      = 7;
if($isEn) $config->auditplan->dtable->fieldList['assignedTo']['width'] = 150;

$config->auditplan->dtable->fieldList['checkDate']['name']     = 'checkDate';
$config->auditplan->dtable->fieldList['checkDate']['title']    = $lang->auditplan->checkDate;
$config->auditplan->dtable->fieldList['checkDate']['type']     = 'date';
$config->auditplan->dtable->fieldList['checkDate']['sortType'] = true;
$config->auditplan->dtable->fieldList['checkDate']['show']     = true;
$config->auditplan->dtable->fieldList['checkDate']['group']    = 8;

$config->auditplan->dtable->fieldList['realCheckDate']['name']     = 'realCheckDate';
$config->auditplan->dtable->fieldList['realCheckDate']['title']    = $lang->auditplan->realCheckDate;
$config->auditplan->dtable->fieldList['realCheckDate']['type']     = 'date';
$config->auditplan->dtable->fieldList['realCheckDate']['sortType'] = true;
$config->auditplan->dtable->fieldList['realCheckDate']['show']     = true;
$config->auditplan->dtable->fieldList['realCheckDate']['group']    = 8;

$config->auditplan->dtable->fieldList['pass']['name']     = 'pass';
$config->auditplan->dtable->fieldList['pass']['title']    = $lang->auditplan->pass;
$config->auditplan->dtable->fieldList['pass']['type']     = 'category';
$config->auditplan->dtable->fieldList['pass']['sortType'] = false;
$config->auditplan->dtable->fieldList['pass']['show']     = true;
$config->auditplan->dtable->fieldList['pass']['group']    = 9;
if($isEn) $config->auditplan->dtable->fieldList['pass']['width'] = 120;

$config->auditplan->dtable->fieldList['nc']['name']        = 'nc';
$config->auditplan->dtable->fieldList['nc']['title']       = $lang->auditplan->nc;
$config->auditplan->dtable->fieldList['nc']['link']        = array('module' => 'auditplan', 'method' => 'nc', 'params' => 'auditplanID={id}');
$config->auditplan->dtable->fieldList['nc']['data-toggle'] = 'modal';
$config->auditplan->dtable->fieldList['nc']['type']        = 'category';
$config->auditplan->dtable->fieldList['nc']['sortType']    = false;
$config->auditplan->dtable->fieldList['nc']['show']        = true;
$config->auditplan->dtable->fieldList['nc']['group']       = 10;
if($isEn) $config->auditplan->dtable->fieldList['nc']['width'] = 140;

$config->auditplan->dtable->fieldList['actions']['title']    = $lang->actions;
$config->auditplan->dtable->fieldList['actions']['type']     = 'actions';
$config->auditplan->dtable->fieldList['actions']['fixed']    = 'right';
$config->auditplan->dtable->fieldList['actions']['sortType'] = false;
$config->auditplan->dtable->fieldList['actions']['show']     = true;
$config->auditplan->dtable->fieldList['actions']['width']    = 100;
$config->auditplan->dtable->fieldList['actions']['list']     = $config->auditplan->actionList;
$config->auditplan->dtable->fieldList['actions']['menu']     = array('check', 'result', 'createNc', 'edit', 'delete');

$config->auditplan->result = new stdclass();
$config->auditplan->result->dtable = new stdclass();
$config->auditplan->result->dtable->fieldList['id']['name']     = 'id';
$config->auditplan->result->dtable->fieldList['id']['title']    = $lang->idAB;
$config->auditplan->result->dtable->fieldList['id']['type']     = 'id';
$config->auditplan->result->dtable->fieldList['id']['fixed']    = 'left';
$config->auditplan->result->dtable->fieldList['id']['sortType'] = false;
$config->auditplan->result->dtable->fieldList['id']['show']     = true;
$config->auditplan->result->dtable->fieldList['id']['group']    = 0;

$config->auditplan->result->dtable->fieldList['content']['name']     = 'content';
$config->auditplan->result->dtable->fieldList['content']['title']    = $lang->auditplan->content;
$config->auditplan->result->dtable->fieldList['content']['type']     = 'title';
$config->auditplan->result->dtable->fieldList['content']['fixed']    = false;
$config->auditplan->result->dtable->fieldList['content']['sortType'] = false;
$config->auditplan->result->dtable->fieldList['content']['width']    = 160;
$config->auditplan->result->dtable->fieldList['content']['show']     = true;
$config->auditplan->result->dtable->fieldList['content']['group']    = 1;

$config->auditplan->result->dtable->fieldList['result']['name']     = 'result';
$config->auditplan->result->dtable->fieldList['result']['title']    = $lang->auditplan->result;
$config->auditplan->result->dtable->fieldList['result']['type']     = 'category';
$config->auditplan->result->dtable->fieldList['result']['map']      = $lang->auditplan->resultList;
$config->auditplan->result->dtable->fieldList['result']['sortType'] = false;
$config->auditplan->result->dtable->fieldList['result']['show']     = true;
$config->auditplan->result->dtable->fieldList['result']['group']    = 2;

$config->auditplan->result->dtable->fieldList['checkedBy']['name']     = 'checkedBy';
$config->auditplan->result->dtable->fieldList['checkedBy']['title']    = $lang->auditplan->checkedBy;
$config->auditplan->result->dtable->fieldList['checkedBy']['type']     = 'user';
$config->auditplan->result->dtable->fieldList['checkedBy']['sortType'] = false;
$config->auditplan->result->dtable->fieldList['checkedBy']['show']     = true;
$config->auditplan->result->dtable->fieldList['checkedBy']['group']    = 3;

$config->auditplan->result->dtable->fieldList['checkedDate']['name']     = 'checkedDate';
$config->auditplan->result->dtable->fieldList['checkedDate']['title']    = $lang->auditplan->date;
$config->auditplan->result->dtable->fieldList['checkedDate']['type']     = 'date';
$config->auditplan->result->dtable->fieldList['checkedDate']['sortType'] = false;
$config->auditplan->result->dtable->fieldList['checkedDate']['show']     = true;
$config->auditplan->result->dtable->fieldList['checkedDate']['group']    = 3;

$config->auditplan->result->dtable->fieldList['comment']['name']     = 'comment';
$config->auditplan->result->dtable->fieldList['comment']['title']    = $lang->auditplan->comment;
$config->auditplan->result->dtable->fieldList['comment']['type']     = 'desc';
$config->auditplan->result->dtable->fieldList['comment']['sortType'] = false;
$config->auditplan->result->dtable->fieldList['comment']['show']     = true;
$config->auditplan->result->dtable->fieldList['comment']['group']    = 4;

$app->loadLang('nc');
$config->auditplan->nc = new stdclass();
$config->auditplan->nc->dtable = new stdclass();
$config->auditplan->nc->dtable->fieldList['id']['name']     = 'id';
$config->auditplan->nc->dtable->fieldList['id']['title']    = $lang->idAB;
$config->auditplan->nc->dtable->fieldList['id']['type']     = 'id';
$config->auditplan->nc->dtable->fieldList['id']['fixed']    = false;
$config->auditplan->nc->dtable->fieldList['id']['sortType'] = false;
$config->auditplan->nc->dtable->fieldList['id']['show']     = true;
$config->auditplan->nc->dtable->fieldList['id']['group']    = 1;

$config->auditplan->nc->dtable->fieldList['content']['name']     = 'content';
$config->auditplan->nc->dtable->fieldList['content']['title']    = $lang->nc->listID;
$config->auditplan->nc->dtable->fieldList['content']['type']     = 'shorttitle';
$config->auditplan->nc->dtable->fieldList['content']['width']    = 160;
$config->auditplan->nc->dtable->fieldList['content']['sortType'] = false;
$config->auditplan->nc->dtable->fieldList['content']['show']     = true;
$config->auditplan->nc->dtable->fieldList['content']['group']    = 3;

$config->auditplan->nc->dtable->fieldList['title']['name']     = 'title';
$config->auditplan->nc->dtable->fieldList['title']['title']    = $lang->nc->title;
$config->auditplan->nc->dtable->fieldList['title']['type']     = 'title';
$config->auditplan->nc->dtable->fieldList['title']['width']    = 160;
$config->auditplan->nc->dtable->fieldList['title']['fixed']    = false;
$config->auditplan->nc->dtable->fieldList['title']['sortType'] = false;
$config->auditplan->nc->dtable->fieldList['title']['show']     = true;
$config->auditplan->nc->dtable->fieldList['title']['group']    = 2;

$config->auditplan->nc->dtable->fieldList['status']['name']      = 'status';
$config->auditplan->nc->dtable->fieldList['status']['title']     = $lang->nc->status;
$config->auditplan->nc->dtable->fieldList['status']['type']      = 'status';
$config->auditplan->nc->dtable->fieldList['status']['statusMap'] = $lang->nc->statusList;
$config->auditplan->nc->dtable->fieldList['status']['sortType']  = false;
$config->auditplan->nc->dtable->fieldList['status']['show']      = true;
$config->auditplan->nc->dtable->fieldList['status']['group']     = 4;

$config->auditplan->nc->dtable->fieldList['severity']['name']         = 'severity';
$config->auditplan->nc->dtable->fieldList['severity']['title']        = $lang->nc->severity;
$config->auditplan->nc->dtable->fieldList['severity']['type']         = 'severity';
$config->auditplan->nc->dtable->fieldList['severity']['severityList'] = $lang->nc->severityList;
$config->auditplan->nc->dtable->fieldList['severity']['sortType']     = false;
$config->auditplan->nc->dtable->fieldList['severity']['show']         = true;
$config->auditplan->nc->dtable->fieldList['severity']['group']        = 5;

$config->auditplan->nc->dtable->fieldList['type']['name']     = 'type';
$config->auditplan->nc->dtable->fieldList['type']['title']    = $lang->nc->type;
$config->auditplan->nc->dtable->fieldList['type']['type']     = 'category';
$config->auditplan->nc->dtable->fieldList['type']['map']      = $lang->nc->typeList;
$config->auditplan->nc->dtable->fieldList['type']['sortType'] = false;
$config->auditplan->nc->dtable->fieldList['type']['show']     = true;
$config->auditplan->nc->dtable->fieldList['type']['group']    = 6;

$config->auditplan->nc->dtable->fieldList['assignedTo']['name']     = 'assignedTo';
$config->auditplan->nc->dtable->fieldList['assignedTo']['title']    = $lang->nc->assignedTo;
$config->auditplan->nc->dtable->fieldList['assignedTo']['type']     = 'user';
$config->auditplan->nc->dtable->fieldList['assignedTo']['sortType'] = false;
$config->auditplan->nc->dtable->fieldList['assignedTo']['show']     = true;
$config->auditplan->nc->dtable->fieldList['assignedTo']['group']    = 7;

$config->auditplan->nc->dtable->fieldList['deadline']['name']     = 'deadline';
$config->auditplan->nc->dtable->fieldList['deadline']['title']    = $lang->nc->deadline;
$config->auditplan->nc->dtable->fieldList['deadline']['type']     = 'date';
$config->auditplan->nc->dtable->fieldList['deadline']['sortType'] = false;
$config->auditplan->nc->dtable->fieldList['deadline']['show']     = true;
$config->auditplan->nc->dtable->fieldList['deadline']['group']    = 8;

$config->auditplan->nc->dtable->fieldList['resolvedDate']['name']     = 'resolvedDate';
$config->auditplan->nc->dtable->fieldList['resolvedDate']['title']    = $lang->nc->resolvedDate;
$config->auditplan->nc->dtable->fieldList['resolvedDate']['type']     = 'date';
$config->auditplan->nc->dtable->fieldList['resolvedDate']['sortType'] = false;
$config->auditplan->nc->dtable->fieldList['resolvedDate']['show']     = true;
$config->auditplan->nc->dtable->fieldList['resolvedDate']['group']    = 9;
