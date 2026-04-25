<?php
global $lang;
$config->deliverable = new stdclass();
$config->deliverable->create = new stdclass();
$config->deliverable->edit   = new stdclass();
$config->deliverable->create->requiredFields = 'name';
$config->deliverable->edit->requiredFields   = 'name,module,activity';

$config->deliverable->actionList = array();
$config->deliverable->actionList['enable']['icon']  = 'start';
$config->deliverable->actionList['enable']['text']  = $lang->deliverable->enable;
$config->deliverable->actionList['enable']['hint']  = $lang->deliverable->enable;
$config->deliverable->actionList['enable']['url']   = array('module' => 'deliverable', 'method' => 'enable', 'params' => 'id={id}');
$config->deliverable->actionList['enable']['class'] = 'ajax-submit';

$config->deliverable->actionList['disable']['icon']   = 'pause';
$config->deliverable->actionList['disable']['text']   = $lang->deliverable->disable;
$config->deliverable->actionList['disable']['hint']   = $lang->deliverable->disable;
$config->deliverable->actionList['disable']['url']    = array('module' => 'deliverable', 'method' => 'disable', 'params' => 'id={id}');
$config->deliverable->actionList['disable']['class']  = 'ajax-submit';

$config->deliverable->actionList['edit']['icon'] = 'edit';
$config->deliverable->actionList['edit']['text'] = $lang->deliverable->edit;
$config->deliverable->actionList['edit']['hint'] = $lang->deliverable->edit;
$config->deliverable->actionList['edit']['url']  = array('module' => 'deliverable', 'method' => 'edit', 'params' => 'id={id}');

$config->deliverable->actionList['delete']['icon']         = 'trash';
$config->deliverable->actionList['delete']['text']         = $lang->deliverable->delete;
$config->deliverable->actionList['delete']['hint']         = $lang->deliverable->delete;
$config->deliverable->actionList['delete']['url']          = array('module' => 'deliverable', 'method' => 'delete', 'params' => 'id={id}');
$config->deliverable->actionList['delete']['data-confirm'] = $lang->deliverable->confirmDelete;
$config->deliverable->actionList['delete']['class']        = 'ajax-submit';

$config->deliverable->actions = new stdclass();
$config->deliverable->actions->view = array();
$config->deliverable->actions->view['mainActions']   = array('enable', 'disable');
$config->deliverable->actions->view['suffixActions'] = array('edit', 'delete');

$config->deliverable->search['module']                   = 'deliverable';
$config->deliverable->search['fields']['module']         = $lang->deliverable->module;
$config->deliverable->search['fields']['name']           = $lang->deliverable->name;
$config->deliverable->search['fields']['status']         = $lang->deliverable->status;
$config->deliverable->search['fields']['activity']       = $lang->deliverable->activity;
$config->deliverable->search['fields']['trimmable']      = $lang->deliverable->trimmable;
$config->deliverable->search['fields']['trimRule']       = $lang->deliverable->trimRule;
$config->deliverable->search['fields']['createdBy']      = $lang->deliverable->createdBy;
$config->deliverable->search['fields']['createdDate']    = $lang->deliverable->createdDate;
$config->deliverable->search['fields']['lastEditedBy']   = $lang->deliverable->lastEditedBy;
$config->deliverable->search['fields']['id']             = $lang->idAB;

$config->deliverable->search['params']['module']         = array('operator' => '=',        'control' => 'select', 'values' => '');
$config->deliverable->search['params']['name']           = array('operator' => 'include',  'control' => 'input', 'values' => '');
$config->deliverable->search['params']['status']         = array('operator' => '=',        'control' => 'select', 'values' => $lang->deliverable->statusList);
$config->deliverable->search['params']['activity']       = array('operator' => '=',        'control' => 'select', 'values' => '');
$config->deliverable->search['params']['trimmable']      = array('operator' => '=',        'control' => 'select', 'values' => $lang->deliverable->trimmableList);
$config->deliverable->search['params']['trimRule']       = array('operator' => '=',        'control' => 'input',  'values' => '');
$config->deliverable->search['params']['createdBy']      = array('operator' => '=',        'control' => 'select', 'values' => 'users');
$config->deliverable->search['params']['createdDate']    = array('operator' => '=',        'control' => 'date',   'values' => '');
$config->deliverable->search['params']['lastEditedBy']   = array('operator' => '=',        'control' => 'select', 'values' => 'users');
$config->deliverable->search['params']['id']             = array('operator' => '=',        'control' => 'input',  'values' => '');
