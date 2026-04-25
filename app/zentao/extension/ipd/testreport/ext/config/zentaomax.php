<?php
global $lang, $app;

$app->loadLang('story');
$app->loadModuleConfig('story');
$config->testreport->story->dtable->fieldList = array();
$config->testreport->story->dtable->fieldList['id']['name']  = 'id';
$config->testreport->story->dtable->fieldList['id']['title'] = $lang->idAB;
$config->testreport->story->dtable->fieldList['id']['type']  = 'id';
$config->testreport->story->dtable->fieldList['id']['sort']  = false;

$config->testreport->story->dtable->fieldList['title']      = $config->story->dtable->fieldList['title'];
$config->testreport->story->dtable->fieldList['product']    = $config->story->dtable->fieldList['product'];
$config->testreport->story->dtable->fieldList['pri']        = $config->story->dtable->fieldList['pri'];
$config->testreport->story->dtable->fieldList['openedBy']   = $config->story->dtable->fieldList['openedBy'];
$config->testreport->story->dtable->fieldList['assignedTo'] = $config->story->dtable->fieldList['assignedTo'];
$config->testreport->story->dtable->fieldList['estimate']   = $config->story->dtable->fieldList['estimate'];
$config->testreport->story->dtable->fieldList['status']     = $config->story->dtable->fieldList['status'];
$config->testreport->story->dtable->fieldList['stage']      = $config->story->dtable->fieldList['stage'];

$config->testreport->story->dtable->fieldList['title']['sort']      = false;
$config->testreport->story->dtable->fieldList['pri']['sort']        = false;
$config->testreport->story->dtable->fieldList['openedBy']['sort']   = false;
$config->testreport->story->dtable->fieldList['assignedTo']['sort'] = false;
$config->testreport->story->dtable->fieldList['estimate']['sort']   = false;
$config->testreport->story->dtable->fieldList['status']['sort']     = false;
$config->testreport->story->dtable->fieldList['stage']['sort']      = false;

$config->testreport->story->dtable->fieldList['title']['nestedToggle'] = false;
$config->testreport->story->dtable->fieldList['assignedTo']['type']    = 'user';
$config->testreport->story->dtable->fieldList['product']['type']       = 'category';
$config->testreport->story->dtable->fieldList['pri']['fixed']          = false;

$app->loadLang('bug');
$app->loadModuleConfig('bug');
$config->testreport->bug->dtable->fieldList = array();
$config->testreport->bug->dtable->fieldList['id']['name']  = 'id';
$config->testreport->bug->dtable->fieldList['id']['title'] = $lang->idAB;
$config->testreport->bug->dtable->fieldList['id']['type']  = 'id';
$config->testreport->bug->dtable->fieldList['id']['sort']  = false;

$config->testreport->bug->dtable->fieldList['title']        = $config->bug->dtable->fieldList['title'];
$config->testreport->bug->dtable->fieldList['product']      = $config->bug->dtable->fieldList['product'];
$config->testreport->bug->dtable->fieldList['severity']     = $config->bug->dtable->fieldList['severity'];
$config->testreport->bug->dtable->fieldList['pri']          = $config->bug->dtable->fieldList['pri'];
$config->testreport->bug->dtable->fieldList['status']       = $config->bug->dtable->fieldList['status'];
$config->testreport->bug->dtable->fieldList['openedBy']     = $config->bug->dtable->fieldList['openedBy'];
$config->testreport->bug->dtable->fieldList['resolvedBy']   = $config->bug->dtable->fieldList['resolvedBy'];
$config->testreport->bug->dtable->fieldList['resolution']   = $config->bug->dtable->fieldList['resolution'];
$config->testreport->bug->dtable->fieldList['resolvedDate'] = $config->bug->dtable->fieldList['resolvedDate'];

$config->testreport->bug->dtable->fieldList['title']['sort']        = false;
$config->testreport->bug->dtable->fieldList['severity']['sort']     = false;
$config->testreport->bug->dtable->fieldList['pri']['sort']          = false;
$config->testreport->bug->dtable->fieldList['status']['sort']       = false;
$config->testreport->bug->dtable->fieldList['openedBy']['sort']     = false;
$config->testreport->bug->dtable->fieldList['resolvedBy']['sort']   = false;
$config->testreport->bug->dtable->fieldList['resolution']['sort']   = false;
$config->testreport->bug->dtable->fieldList['resolvedDate']['sort'] = false;

$config->testreport->bug->dtable->fieldList['product']['type'] = 'category';

$app->loadLang('testcase');
$app->loadModuleConfig('testcase');
$config->testreport->testcase->dtable->fieldList = array();
$config->testreport->testcase->dtable->fieldList['id']['name']  = 'id';
$config->testreport->testcase->dtable->fieldList['id']['title'] = $lang->idAB;
$config->testreport->testcase->dtable->fieldList['id']['type']  = 'id';
$config->testreport->testcase->dtable->fieldList['id']['sort']  = false;

$config->testreport->testcase->dtable->fieldList['title']   = $config->testcase->dtable->fieldList['title'];
$config->testreport->testcase->dtable->fieldList['product'] = $config->testcase->dtable->fieldList['product'];
$config->testreport->testcase->dtable->fieldList['pri']     = $config->testcase->dtable->fieldList['pri'];
$config->testreport->testcase->dtable->fieldList['status']  = $config->testcase->dtable->fieldList['status'];
$config->testreport->testcase->dtable->fieldList['type']    = $config->testcase->dtable->fieldList['type'];

$config->testreport->testcase->dtable->fieldList['title']['sort']  = false;
$config->testreport->testcase->dtable->fieldList['pri']['sort']    = false;
$config->testreport->testcase->dtable->fieldList['status']['sort'] = false;
$config->testreport->testcase->dtable->fieldList['type']['sort']   = false;

$config->testreport->testcase->dtable->fieldList['assignedTo']['title'] = $lang->testcase->assignedTo;
$config->testreport->testcase->dtable->fieldList['assignedTo']['type']  = 'user';
$config->testreport->testcase->dtable->fieldList['assignedTo']['sort']  = false;

$config->testreport->testcase->dtable->fieldList['lastRunner']    = $config->testcase->dtable->fieldList['lastRunner'];
$config->testreport->testcase->dtable->fieldList['lastRunDate']   = $config->testcase->dtable->fieldList['lastRunDate'];
$config->testreport->testcase->dtable->fieldList['lastRunResult'] = $config->testcase->dtable->fieldList['lastRunResult'];

$config->testreport->testcase->dtable->fieldList['lastRunner']['sort']    = false;
$config->testreport->testcase->dtable->fieldList['lastRunDate']['sort']   = false;
$config->testreport->testcase->dtable->fieldList['lastRunResult']['sort'] = false;

$config->testreport->testcase->dtable->fieldList['title']['nestedToggle'] = false;
$config->testreport->testcase->dtable->fieldList['product']['hidden']     = false;
$config->testreport->testcase->dtable->fieldList['product']['type']       = 'category';
