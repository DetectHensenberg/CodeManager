<?php
$config->nc = new stdclass();
$config->nc->datatable = new stdclass();
$config->nc->editor    = new stdclass();
$config->nc->editor->edit     = array('id' => 'desc', 'tools' => 'simpleTools');
$config->nc->editor->resolve  = array('id' => 'desc', 'tools' => 'simpleTools');
$config->nc->editor->close    = array('id' => 'comment', 'tools' => 'simpleTools');
$config->nc->editor->activate = array('id' => 'comment', 'tools' => 'simpleTools');
$config->nc->editor->assignto = array('id' => 'comment', 'tools' => 'simpleTools');

$config->nc->create = new stdclass();
$config->nc->edit   = new stdclass();
$config->nc->create->requiredFields = 'title,auditplan,listID,severity';
$config->nc->edit->requiredFields   = 'title,auditplan,listID,severity';

$config->nc->list = new stdclass();
$config->nc->list->exportFields = 'id,severity,title,type,status,execution,auditplan,listID,desc,
    assignedTo,createdBy,createdDate,deadline,
    resolvedBy,resolvedDate,resolution,
    activateDate,closedBy,closedDate';

$config->nc->actions = new stdclass();
$config->nc->actions->view = array();
$config->nc->actions->view['mainActions']   = array('assignTo', 'resolve', 'activate', 'close');
$config->nc->actions->view['suffixActions'] = array('edit', 'delete');

global $lang, $app;
$config->nc->actionList = array();
$config->nc->actionList['resolve']['icon']        = 'checked';
$config->nc->actionList['resolve']['text']        = $lang->nc->resolve;
$config->nc->actionList['resolve']['hint']        = $lang->nc->resolve;
$config->nc->actionList['resolve']['url']         = array('module' => 'nc', 'method' => 'resolve', 'params' => 'id={id}');
$config->nc->actionList['resolve']['data-toggle'] = 'modal';

$config->nc->actionList['activate']['icon']        = 'magic';
$config->nc->actionList['activate']['text']        = $lang->nc->activate;
$config->nc->actionList['activate']['hint']        = $lang->nc->activate;
$config->nc->actionList['activate']['url']         = array('module' => 'nc', 'method' => 'activate', 'params' => 'id={id}');
$config->nc->actionList['activate']['data-toggle'] = 'modal';

$config->nc->actionList['assignTo']['icon']        = 'hand-right';
$config->nc->actionList['assignTo']['text']        = $lang->nc->assignTo;
$config->nc->actionList['assignTo']['hint']        = $lang->nc->assignTo;
$config->nc->actionList['assignTo']['url']         = array('module' => 'nc', 'method' => 'assignTo', 'params' => 'id={id}');
$config->nc->actionList['assignTo']['data-toggle'] = 'modal';

$config->nc->actionList['edit']['icon']     = 'edit';
$config->nc->actionList['edit']['text']     = $lang->nc->edit;
$config->nc->actionList['edit']['hint']     = $lang->nc->edit;
$config->nc->actionList['edit']['url']      = array('module' => 'nc', 'method' => 'edit', 'params' => 'id={id}');
$config->nc->actionList['edit']['data-app'] = $app->tab;

$config->nc->actionList['close']['icon']        = 'off';
$config->nc->actionList['close']['text']        = $lang->nc->close;
$config->nc->actionList['close']['hint']        = $lang->nc->close;
$config->nc->actionList['close']['url']         = array('module' => 'nc', 'method' => 'close', 'params' => 'id={id}');
$config->nc->actionList['close']['data-toggle'] = 'modal';

$config->nc->actionList['delete']['icon']         = 'trash';
$config->nc->actionList['delete']['text']         = $lang->nc->delete;
$config->nc->actionList['delete']['hint']         = $lang->nc->delete;
$config->nc->actionList['delete']['url']          = array('module' => 'nc', 'method' => 'delete', 'params' => 'id={id}');
$config->nc->actionList['delete']['data-confirm'] = $lang->nc->confirmDelete;
$config->nc->actionList['delete']['className']    = 'ajax-submit';

global $lang;
$config->nc->search['onMenuBar']              = 'yes';
$config->nc->search['module']                 = 'nc';
$config->nc->search['fields']['title']        = $lang->nc->title;
$config->nc->search['fields']['id']           = $lang->nc->id;
$config->nc->search['fields']['status']       = $lang->nc->status;
$config->nc->search['fields']['severity']     = $lang->nc->severity;
$config->nc->search['fields']['execution']    = $lang->nc->execution;
$config->nc->search['fields']['auditplan']    = $lang->nc->auditplan;
$config->nc->search['fields']['type']         = $lang->nc->type;
$config->nc->search['fields']['deadline']     = $lang->nc->deadline;
$config->nc->search['fields']['assignedTo']   = $lang->nc->assignedTo;
$config->nc->search['fields']['desc']         = $lang->nc->desc;
$config->nc->search['fields']['createdBy']    = $lang->nc->createdBy;
$config->nc->search['fields']['createdDate']  = $lang->nc->createdDate;
$config->nc->search['fields']['resolvedBy']   = $lang->nc->resolvedBy;
$config->nc->search['fields']['resolution']   = $lang->nc->resolution;
$config->nc->search['fields']['resolvedDate'] = $lang->nc->resolvedDate;
$config->nc->search['fields']['closedBy']     = $lang->nc->closedBy;
$config->nc->search['fields']['closedDate']   = $lang->nc->closedDate;

$config->nc->search['params']['title']        = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->nc->search['params']['id']           = array('operator' => '=',       'control' => 'input',  'values' => '');
$config->nc->search['params']['status']       = array('operator' => '=',       'control' => 'select', 'values' => '');
$config->nc->search['params']['severity']     = array('operator' => '=',       'control' => 'select', 'values' => $lang->nc->severityList);
$config->nc->search['params']['execution']    = array('operator' => '=',       'control' => 'select', 'values' => '');
$config->nc->search['params']['auditplan']    = array('operator' => '=',       'control' => 'select', 'values' => '');
$config->nc->search['params']['type']         = array('operator' => '=',       'control' => 'select', 'values' => $lang->nc->typeList);
$config->nc->search['params']['deadline']     = array('operator' => '=',       'control' => 'input',  'values' => '', 'class' => 'date');
$config->nc->search['params']['assignedTo']   = array('operator' => '=',       'control' => 'select', 'values' => 'users');
$config->nc->search['params']['desc']         = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->nc->search['params']['createdBy']    = array('operator' => '=',       'control' => 'select', 'values' => 'users');
$config->nc->search['params']['createdDate']  = array('operator' => '=',       'control' => 'input',  'values' => '', 'class' => 'date');
$config->nc->search['params']['resolvedBy']   = array('operator' => '=',       'control' => 'select', 'values' => 'users');
$config->nc->search['params']['resolution']   = array('operator' => '=',       'control' => 'select', 'values' => $lang->nc->resolutionList);
$config->nc->search['params']['resolvedDate'] = array('operator' => '=',       'control' => 'input',  'values' => '', 'class' => 'date');
$config->nc->search['params']['closedBy']     = array('operator' => '=',       'control' => 'select', 'values' => 'users');
$config->nc->search['params']['closedDate']   = array('operator' => '=',       'control' => 'input',  'values' => '', 'class' => 'date');
