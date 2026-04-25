<?php
global $lang, $app;
$config->reviewcl->actionList = array();
$config->reviewcl->actionList['edit']['icon']        = 'edit';
$config->reviewcl->actionList['edit']['text']        = $lang->reviewcl->edit;
$config->reviewcl->actionList['edit']['hint']        = $lang->reviewcl->edit;
$config->reviewcl->actionList['edit']['url']         = array('module' => 'reviewcl', 'method' => 'edit', 'params' => 'reviewclID={id}');
$config->reviewcl->actionList['edit']['data-toggle'] = 'modal';
$config->reviewcl->actionList['edit']['data-size']   = 'sm';

$config->reviewcl->actionList['delete']['icon']         = 'trash';
$config->reviewcl->actionList['delete']['text']         = $lang->reviewcl->delete;
$config->reviewcl->actionList['delete']['hint']         = $lang->reviewcl->delete;
$config->reviewcl->actionList['delete']['url']          = array('module' => 'reviewcl', 'method' => 'delete', 'params' => 'reviewclID={id}');
$config->reviewcl->actionList['delete']['className']    = 'ajax-submit';
$config->reviewcl->actionList['delete']['data-confirm'] = array('message' => $lang->reviewcl->confirmDelete, 'icon' => 'icon-exclamation-sign', 'iconClass' => 'warning-pale rounded-full icon-2x');
