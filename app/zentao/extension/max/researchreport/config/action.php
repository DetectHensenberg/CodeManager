<?php
global $lang;
$config->researchreport->actionList = array();

$config->researchreport->actionList['edit']['icon'] = 'edit';
$config->researchreport->actionList['edit']['text'] = $lang->researchreport->edit;
$config->researchreport->actionList['edit']['hint'] = $lang->researchreport->edit;
$config->researchreport->actionList['edit']['url']  = array('module' => 'researchreport', 'method' => 'edit', 'params' => 'researchreportID={id}');

$config->researchreport->actionList['delete']['icon']         = 'trash';
$config->researchreport->actionList['delete']['text']         = $lang->researchreport->delete;
$config->researchreport->actionList['delete']['hint']         = $lang->researchreport->delete;
$config->researchreport->actionList['delete']['url']          = array('module' => 'researchreport', 'method' => 'delete', 'params' => 'researchreportID={id}&confirm=yes');
$config->researchreport->actionList['delete']['data-confirm'] = array('message' => $lang->researchreport->confirmDelete);
$config->researchreport->actionList['delete']['class']        = 'ajax-submit';
