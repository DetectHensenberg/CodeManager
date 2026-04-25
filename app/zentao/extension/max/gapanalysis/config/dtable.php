<?php
$config->gapanalysis->actionList['edit']['icon'] = 'edit';
$config->gapanalysis->actionList['edit']['hint'] = $lang->edit;
$config->gapanalysis->actionList['edit']['url']  = array('module' => 'gapanalysis', 'method' => 'edit', 'params' => 'gapanalysisID={id}');

$config->gapanalysis->actionList['delete']['icon']         = 'trash';
$config->gapanalysis->actionList['delete']['hint']         = $lang->delete;
$config->gapanalysis->actionList['delete']['url']          = array('module' => 'gapanalysis', 'method' => 'delete', 'params' => 'gapanalysisID={id}');
$config->gapanalysis->actionList['delete']['className']    = 'ajax-submit';
$config->gapanalysis->actionList['delete']['data-confirm'] = array('message' => $lang->gapanalysis->confirmDelete, 'icon' => 'icon-exclamation-sign', 'iconClass' => 'warning-pale rounded-full icon-2x');

$config->gapanalysis->dtable = new stdclass();
$config->gapanalysis->dtable->fieldList['id']['title']    = $lang->idAB;
$config->gapanalysis->dtable->fieldList['id']['name']     = 'id';
$config->gapanalysis->dtable->fieldList['id']['type']     = 'checkID';
$config->gapanalysis->dtable->fieldList['id']['sortType'] = 'desc';
$config->gapanalysis->dtable->fieldList['id']['checkbox'] = true;
$config->gapanalysis->dtable->fieldList['id']['width']    = '80';
$config->gapanalysis->dtable->fieldList['id']['required'] = true;

$config->gapanalysis->dtable->fieldList['account']['title']    = $lang->gapanalysis->account;
$config->gapanalysis->dtable->fieldList['account']['name']     = 'account';
$config->gapanalysis->dtable->fieldList['account']['fixed']    = 'left';
$config->gapanalysis->dtable->fieldList['account']['type']     = 'user';
$config->gapanalysis->dtable->fieldList['account']['link']     = array('url' => helper::createLink('gapanalysis', 'view', 'gapanalysisID={id}'));
$config->gapanalysis->dtable->fieldList['account']['width']    = '38%';
$config->gapanalysis->dtable->fieldList['account']['sortType'] = true;
$config->gapanalysis->dtable->fieldList['account']['minWidth'] = '356';
$config->gapanalysis->dtable->fieldList['account']['required'] = true;

$config->gapanalysis->dtable->fieldList['role']['title']    = $lang->gapanalysis->role;
$config->gapanalysis->dtable->fieldList['role']['name']     = 'role';
$config->gapanalysis->dtable->fieldList['role']['type']     = 'desc';
$config->gapanalysis->dtable->fieldList['role']['sortType'] = true;
$config->gapanalysis->dtable->fieldList['role']['width']    = '300';
$config->gapanalysis->dtable->fieldList['role']['show']     = true;

$config->gapanalysis->dtable->fieldList['needTrain']['title']    = $lang->gapanalysis->needTrain;
$config->gapanalysis->dtable->fieldList['needTrain']['name']     = 'needTrain';
$config->gapanalysis->dtable->fieldList['needTrain']['type']     = 'desc';
$config->gapanalysis->dtable->fieldList['needTrain']['map']      = $lang->gapanalysis->needTrainList;;
$config->gapanalysis->dtable->fieldList['needTrain']['sortType'] = true;
$config->gapanalysis->dtable->fieldList['needTrain']['width']    = '160';
$config->gapanalysis->dtable->fieldList['needTrain']['show']     = true;

$config->gapanalysis->dtable->fieldList['actions']['name']     = 'actions';
$config->gapanalysis->dtable->fieldList['actions']['title']    = $lang->actions;
$config->gapanalysis->dtable->fieldList['actions']['fixed']    = 'right';
$config->gapanalysis->dtable->fieldList['actions']['required'] = true;
$config->gapanalysis->dtable->fieldList['actions']['width']    = 'auto';
$config->gapanalysis->dtable->fieldList['actions']['minWidth'] = 60;
$config->gapanalysis->dtable->fieldList['actions']['type']     = 'actions';
$config->gapanalysis->dtable->fieldList['actions']['menu']     = array('edit');
$config->gapanalysis->dtable->fieldList['actions']['list']     = $config->gapanalysis->actionList;

$config->gapanalysis->actions = new stdclass();
$config->gapanalysis->actions->view = array();
$config->gapanalysis->actions->view['suffixActions'] = array('edit', 'delete');