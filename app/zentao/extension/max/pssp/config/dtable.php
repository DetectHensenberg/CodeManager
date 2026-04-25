<?php
global $lang, $app;

$config->pssp->dtable = new stdclass();
$config->pssp->dtable->fieldList['check']['name']     = 'check';
$config->pssp->dtable->fieldList['check']['title']    = $lang->pssp->tailor;
$config->pssp->dtable->fieldList['check']['type']     = 'trimCheckbox';
$config->pssp->dtable->fieldList['check']['fixed']    = 'left';
$config->pssp->dtable->fieldList['check']['sortType'] = false;
$config->pssp->dtable->fieldList['check']['show']     = true;
$config->pssp->dtable->fieldList['check']['group']    = 1;
if($app->getClientLang() == 'en') $config->pssp->dtable->fieldList['check']['width'] = 80;

$config->pssp->dtable->fieldList['name']['name']         = 'name';
$config->pssp->dtable->fieldList['name']['title']        = $lang->pssp->name;
$config->pssp->dtable->fieldList['name']['type']         = 'title';
$config->pssp->dtable->fieldList['name']['fixed']        = 'left';
$config->pssp->dtable->fieldList['name']['sortType']     = false;
$config->pssp->dtable->fieldList['name']['nestedToggle'] = true;
$config->pssp->dtable->fieldList['name']['show']         = true;
$config->pssp->dtable->fieldList['name']['group']        = 2;

$config->pssp->dtable->fieldList['type']['name']     = 'type';
$config->pssp->dtable->fieldList['type']['title']    = $lang->pssp->type;
$config->pssp->dtable->fieldList['type']['type']     = 'category';
$config->pssp->dtable->fieldList['type']['map']      = $lang->pssp->typeList;
$config->pssp->dtable->fieldList['type']['sortType'] = false;
$config->pssp->dtable->fieldList['type']['show']     = true;
$config->pssp->dtable->fieldList['type']['group']    = 3;

$config->pssp->dtable->fieldList['tailorNorm']['name']     = 'tailorNorm';
$config->pssp->dtable->fieldList['tailorNorm']['title']    = $lang->pssp->tailorNorm;
$config->pssp->dtable->fieldList['tailorNorm']['type']     = 'desc';
$config->pssp->dtable->fieldList['tailorNorm']['sortType'] = false;
$config->pssp->dtable->fieldList['tailorNorm']['show']     = true;
$config->pssp->dtable->fieldList['tailorNorm']['group']    = 4;

$config->pssp->dtable->fieldList['result']['name']     = 'result';
$config->pssp->dtable->fieldList['result']['title']    = $lang->pssp->result;
$config->pssp->dtable->fieldList['result']['type']     = 'category';
$config->pssp->dtable->fieldList['result']['map']      = $lang->pssp->resultList;
$config->pssp->dtable->fieldList['result']['sortType'] = false;
$config->pssp->dtable->fieldList['result']['show']     = true;
$config->pssp->dtable->fieldList['result']['group']    = 5;

$config->pssp->dtable->fieldList['createdBy']['name']     = 'createdBy';
$config->pssp->dtable->fieldList['createdBy']['title']    = $lang->pssp->createdBy;
$config->pssp->dtable->fieldList['createdBy']['type']     = 'user';
$config->pssp->dtable->fieldList['createdBy']['sortType'] = false;
$config->pssp->dtable->fieldList['createdBy']['show']     = true;
$config->pssp->dtable->fieldList['createdBy']['group']    = 6;

$config->pssp->dtable->fieldList['createdDate']['name']     = 'createdDate';
$config->pssp->dtable->fieldList['createdDate']['title']    = $lang->pssp->createdDate;
$config->pssp->dtable->fieldList['createdDate']['type']     = 'date';
$config->pssp->dtable->fieldList['createdDate']['sortType'] = false;
$config->pssp->dtable->fieldList['createdDate']['show']     = true;
$config->pssp->dtable->fieldList['createdDate']['group']    = 7;
