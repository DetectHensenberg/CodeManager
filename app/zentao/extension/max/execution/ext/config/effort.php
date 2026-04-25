<?php
global $app;
$app->loadLang('effort');
$app->loadConfig('effort');

$config->execution->effort = new stdclass();
$config->execution->effort->dtable = new stdclass();

$config->execution->effort->dtable->fieldList['id']['name']  = 'id';
$config->execution->effort->dtable->fieldList['id']['title'] = $lang->idAB;
$config->execution->effort->dtable->fieldList['id']['type']  = 'checkID';

$config->execution->effort->dtable->fieldList['date']['name']     = 'date';
$config->execution->effort->dtable->fieldList['date']['title']    = $lang->effort->date;
$config->execution->effort->dtable->fieldList['date']['type']     = 'date';
$config->execution->effort->dtable->fieldList['date']['fixed']    = 'left';
$config->execution->effort->dtable->fieldList['date']['show']     = true;
$config->execution->effort->dtable->fieldList['date']['required'] = true;

$config->execution->effort->dtable->fieldList['account']['name']  = 'account';
$config->execution->effort->dtable->fieldList['account']['title'] = $lang->effort->account;
$config->execution->effort->dtable->fieldList['account']['type']  = 'user';
$config->execution->effort->dtable->fieldList['account']['fixed'] = 'left';
$config->execution->effort->dtable->fieldList['account']['show']  = true;

$config->execution->effort->dtable->fieldList['work']['name']        = 'work';
$config->execution->effort->dtable->fieldList['work']['title']       = $lang->effort->work;
$config->execution->effort->dtable->fieldList['work']['type']        = 'title';
$config->execution->effort->dtable->fieldList['work']['link']        = array('module' => 'effort', 'method' => 'view', 'params' => 'id={id}&from=my');
$config->execution->effort->dtable->fieldList['work']['data-toggle'] = 'modal';
$config->execution->effort->dtable->fieldList['work']['data-size']   = 'lg';

$config->execution->effort->dtable->fieldList['consumed']['name']  = 'consumed';
$config->execution->effort->dtable->fieldList['consumed']['title'] = $lang->effort->consumed;
$config->execution->effort->dtable->fieldList['consumed']['type']  = 'number';
$config->execution->effort->dtable->fieldList['consumed']['show']  = true;

$config->execution->effort->dtable->fieldList['left']['name']  = 'left';
$config->execution->effort->dtable->fieldList['left']['title'] = $lang->effort->left;
$config->execution->effort->dtable->fieldList['left']['type']  = 'number';
$config->execution->effort->dtable->fieldList['left']['show']  = true;

$config->execution->effort->dtable->fieldList['objectTitle']['name']  = 'objectTitle';
$config->execution->effort->dtable->fieldList['objectTitle']['title'] = $lang->effort->objectType;
$config->execution->effort->dtable->fieldList['objectTitle']['type']  = 'text';
$config->execution->effort->dtable->fieldList['objectTitle']['show']  = true;