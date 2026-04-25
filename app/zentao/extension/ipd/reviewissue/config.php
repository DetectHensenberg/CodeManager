<?php
$config->reviewissue->resolve = new stdClass();
$config->reviewissue->resolve->requiredFields = 'resolution';

$config->reviewissue->create = new stdClass();
$config->reviewissue->create->requiredFields = 'listID';

$config->reviewissue->edit = new stdClass();
$config->reviewissue->edit->requiredFields = 'title';

global $app, $lang;
$config->reviewissue->search['onMenuBar']              = 'yes';
$config->reviewissue->search['module']                 = 'reviewissue';
$config->reviewissue->search['fields']['title']        = $lang->reviewissue->title;
$config->reviewissue->search['fields']['id']           = $lang->reviewissue->id;
$config->reviewissue->search['fields']['review']       = $lang->reviewissue->review;
$config->reviewissue->search['fields']['opinion']      = $lang->reviewissue->opinion;
$config->reviewissue->search['fields']['status']       = $lang->reviewissue->status;
$config->reviewissue->search['fields']['resolution']   = $lang->reviewissue->resolution;
$config->reviewissue->search['fields']['type']         = $lang->reviewissue->type;
$config->reviewissue->search['fields']['assignedTo']   = $lang->reviewissue->assignedTo;
$config->reviewissue->search['fields']['assignedDate'] = $lang->reviewissue->assignedDate;
$config->reviewissue->search['fields']['createdBy']    = $lang->reviewissue->createdBy;
$config->reviewissue->search['fields']['createdDate']  = $lang->reviewissue->createdDate;

$config->reviewissue->search['params']['title']        = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->reviewissue->search['params']['id']           = array('operator' => '=',       'control' => 'input',  'values' => '');
$config->reviewissue->search['params']['review']       = array('operator' => '=',       'control' => 'select', 'values' => '');
$config->reviewissue->search['params']['opinion']      = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->reviewissue->search['params']['status']       = array('operator' => '=',       'control' => 'select', 'values' => '');
$config->reviewissue->search['params']['resolution']   = array('operator' => '=',       'control' => 'select', 'values' => $lang->reviewissue->resolutionList);
$config->reviewissue->search['params']['type']         = array('operator' => '=',       'control' => 'select', 'values' => '');
$config->reviewissue->search['params']['assignedTo']   = array('operator' => '=',       'control' => 'select', 'values' => 'users');
$config->reviewissue->search['params']['assignedDate'] = array('operator' => '=',       'control' => 'input',  'values' => '', 'class' => 'date');
$config->reviewissue->search['params']['createdBy']    = array('operator' => '=',       'control' => 'select', 'values' => 'users');
$config->reviewissue->search['params']['createdDate']  = array('operator' => '=',       'control' => 'input',  'values' => '', 'class' => 'date');

$config->reviewissue->actions = new stdclass();
$config->reviewissue->actions->view = array();
$config->reviewissue->actions->view['mainActions']   = array('assignTo', 'resolved', 'close', 'active');
$config->reviewissue->actions->view['suffixActions'] = array('edit', 'delete');

$config->reviewissue->actionList = array();
$config->reviewissue->actionList['edit']['icon']     = 'edit';
$config->reviewissue->actionList['edit']['text']     = $lang->reviewissue->edit;
$config->reviewissue->actionList['edit']['hint']     = $lang->reviewissue->edit;
$config->reviewissue->actionList['edit']['url']      = array('module' => 'reviewissue', 'method' => 'edit', 'params' => 'projectID={project}&issueID={id}');
$config->reviewissue->actionList['edit']['data-app'] = $app->tab;

$config->reviewissue->actionList['resolved']['icon']        = 'checked';
$config->reviewissue->actionList['resolved']['text']        = $lang->reviewissue->resolved;
$config->reviewissue->actionList['resolved']['hint']        = $lang->reviewissue->resolved;
$config->reviewissue->actionList['resolved']['url']         = array('module' => 'reviewissue', 'method' => 'resolved', 'params' => 'project={project}&issueID={id}');
$config->reviewissue->actionList['resolved']['data-toggle'] = 'modal';

$config->reviewissue->actionList['assignTo']['icon']         = 'hand-right';
$config->reviewissue->actionList['assignTo']['text']         = $lang->reviewissue->assignTo;
$config->reviewissue->actionList['assignTo']['hint']         = $lang->reviewissue->assignTo;
$config->reviewissue->actionList['assignTo']['url']          = array('module' => 'reviewissue', 'method' => 'assignTo', 'params' => 'issueID={id}');
$config->reviewissue->actionList['assignTo']['data-toggle']  = 'modal';

$config->reviewissue->actionList['close']['icon']         = 'off';
$config->reviewissue->actionList['close']['text']         = $lang->reviewissue->close;
$config->reviewissue->actionList['close']['hint']         = $lang->reviewissue->close;
$config->reviewissue->actionList['close']['url']          = array('module' => 'reviewissue', 'method' => 'close', 'params' => 'issueID={id}');
$config->reviewissue->actionList['close']['className']    = 'ajax-submit';
$config->reviewissue->actionList['close']['data-confirm'] = array('message' => $lang->reviewissue->confirmClose, 'icon' => 'icon-exclamation-sign', 'iconClass' => 'warning-pale rounded-full icon-2x');

$config->reviewissue->actionList['active']['icon']         = 'magic';
$config->reviewissue->actionList['active']['text']         = $lang->reviewissue->activation;
$config->reviewissue->actionList['active']['hint']         = $lang->reviewissue->activation;
$config->reviewissue->actionList['active']['url']          = array('module' => 'reviewissue', 'method' => 'active', 'params' => 'issueID={id}');
$config->reviewissue->actionList['active']['className']    = 'ajax-submit';
$config->reviewissue->actionList['active']['data-confirm'] = array('message' => $lang->reviewissue->confirmActive, 'icon' => 'icon-exclamation-sign', 'iconClass' => 'warning-pale rounded-full icon-2x');

$config->reviewissue->actionList['delete']['icon']         = 'trash';
$config->reviewissue->actionList['delete']['text']         = $lang->reviewissue->delete;
$config->reviewissue->actionList['delete']['hint']         = $lang->reviewissue->delete;
$config->reviewissue->actionList['delete']['url']          = array('module' => 'reviewissue', 'method' => 'delete', 'params' => 'issueID={id}&project={project}&confirm=yes');
$config->reviewissue->actionList['delete']['className']    = 'ajax-submit';
$config->reviewissue->actionList['delete']['data-confirm'] = array('message' => $lang->reviewissue->confirmDelete, 'icon' => 'icon-exclamation-sign', 'iconClass' => 'warning-pale rounded-full icon-2x');
$config->reviewissue->actionList['delete']['notInModal']   = true;
