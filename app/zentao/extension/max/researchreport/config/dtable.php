<?php
global $app;
$config->researchreport->dtable = new stdclass();

$config->researchreport->dtable->fieldList['id']['title'] = $lang->idAB;
$config->researchreport->dtable->fieldList['id']['type']  = 'checkID';

$config->researchreport->dtable->fieldList['title']['link']     = array('url' => array('module' => 'researchreport', 'method' => 'view', 'params' => 'reportID={id}'));
$config->researchreport->dtable->fieldList['title']['width']    = '800';
$config->researchreport->dtable->fieldList['title']['sortType'] = true;

$config->researchreport->dtable->fieldList['author']['type']     = 'user';
$config->researchreport->dtable->fieldList['author']['sortType'] = true;

$config->researchreport->dtable->fieldList['createdDate']['type']     = 'datetime';
$config->researchreport->dtable->fieldList['createdDate']['sortType'] = true;

$config->researchreport->dtable->fieldList['actions']['type']  = 'actions';
$config->researchreport->dtable->fieldList['actions']['title'] = $lang->actions;
$config->researchreport->dtable->fieldList['actions']['width'] = '50';
$config->researchreport->dtable->fieldList['actions']['menu']  = array('edit');
$config->researchreport->dtable->fieldList['actions']['list']  = $config->researchreport->actionList;
