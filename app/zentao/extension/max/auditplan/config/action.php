<?php
$config->auditplan->actionList['check']['icon']        = 'confirm';
$config->auditplan->actionList['check']['text']        = $lang->auditplan->check;
$config->auditplan->actionList['check']['hint']        = $lang->auditplan->check;
$config->auditplan->actionList['check']['url']         = array('module' => 'auditplan', 'method' => 'check', 'params' => 'auditplanID={id}');
$config->auditplan->actionList['check']['data-toggle'] = 'modal';

$config->auditplan->actionList['result']['icon']        = 'list-alt';
$config->auditplan->actionList['result']['text']        = $lang->auditplan->result;
$config->auditplan->actionList['result']['hint']        = $lang->auditplan->result;
$config->auditplan->actionList['result']['url']         = array('module' => 'auditplan', 'method' => 'result', 'params' => 'auditplanID={id}');
$config->auditplan->actionList['result']['data-toggle'] = 'modal';

$config->auditplan->actionList['createNc']['icon']        = 'plus';
$config->auditplan->actionList['createNc']['text']        = $lang->auditplan->createNc;
$config->auditplan->actionList['createNc']['hint']        = $lang->auditplan->createNc;
$config->auditplan->actionList['createNc']['url']         = array('module' => 'nc', 'method' => 'create', 'params' => 'project={project}&auditplanID={id}');
$config->auditplan->actionList['createNc']['data-toggle'] = 'modal';
$config->auditplan->actionList['createNc']['data-size']   = 'lg';

$config->auditplan->actionList['edit']['icon']         = 'edit';
$config->auditplan->actionList['edit']['text']         = $lang->auditplan->edit;
$config->auditplan->actionList['edit']['hint']         = $lang->auditplan->edit;
$config->auditplan->actionList['edit']['url']          = array('module' => 'auditplan', 'method' => 'edit', 'params' => 'auditplanID={id}');
$config->auditplan->actionList['edit']['data-toggle']  = 'modal';

$config->auditplan->actionList['delete']['icon']         = 'trash';
$config->auditplan->actionList['delete']['text']         = $lang->auditplan->delete;
$config->auditplan->actionList['delete']['hint']         = $lang->auditplan->delete;
$config->auditplan->actionList['delete']['className']    = 'ajax-submit';
$config->auditplan->actionList['delete']['data-confirm'] = $lang->auditplan->confirmDelete;
$config->auditplan->actionList['delete']['url']          = array('module' => 'auditplan', 'method' => 'delete', 'params' => 'auditplanID={id}');
