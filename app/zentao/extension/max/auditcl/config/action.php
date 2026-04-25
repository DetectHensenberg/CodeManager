<?php
global $lang;
$config->auditcl->actionList['edit']['icon'] = 'edit';
$config->auditcl->actionList['edit']['text'] = $lang->auditcl->edit;
$config->auditcl->actionList['edit']['hint'] = $lang->auditcl->edit;
$config->auditcl->actionList['edit']['url']  = array('module' => 'auditcl', 'method' => 'edit', 'params' => 'auditclID={id}');

$config->auditcl->actionList['delete']['icon']          = 'trash';
$config->auditcl->actionList['delete']['text']          = $lang->auditcl->delete;
$config->auditcl->actionList['delete']['hint']          = $lang->auditcl->delete;
$config->auditcl->actionList['delete']['url']           = array('module' => 'auditcl', 'method' => 'delete', 'params' => 'auditclID={id}');
$config->auditcl->actionList['delete']['className']     = 'ajax-submit';
$config->auditcl->actionList['delete']['data-confirm']  = $lang->auditcl->confirmDelete;