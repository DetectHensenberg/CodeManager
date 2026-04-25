<?php
/**
 * AI 模块配置扩展。
 * AI module configuration extension.
 */

global $lang, $app;
if(!isset($lang->ai)) $app->loadLang('ai');

/* 我的知识库搜索配置 */
$config->ai->myknowledgelib = new stdclass();
$config->ai->myknowledgelib->search = array();
$config->ai->myknowledgelib->search['module'] = 'myknowledgelib';

$config->ai->myknowledgelib->search['fields']['name']        = $lang->ai->knowledgeLibs->knowledgeLibName;
$config->ai->myknowledgelib->search['fields']['published']   = $lang->ai->knowledgeLibs->status;
$config->ai->myknowledgelib->search['fields']['importType']  = $lang->ai->knowledgeLibs->importType;
$config->ai->myknowledgelib->search['fields']['desc']        = $lang->ai->knowledgeLibs->knowledgeLibDesc;
$config->ai->myknowledgelib->search['fields']['createdBy']   = $lang->ai->knowledgeLibs->creator;
$config->ai->myknowledgelib->search['fields']['createdDate'] = $lang->ai->knowledgeLibs->createdDate;

$config->ai->myknowledgelib->search['params']['name']        = array('operator' => 'include', 'control' => 'input', 'values' => '');
$config->ai->myknowledgelib->search['params']['desc']        = array('operator' => 'include', 'control' => 'input', 'values' => '');
$config->ai->myknowledgelib->search['params']['published']   = array('operator' => '=', 'control' => 'select', 'values' => $lang->ai->knowledgeLibs->publishedList);
$config->ai->myknowledgelib->search['params']['importType']  = array('operator' => '=', 'control' => 'select', 'values' => $lang->ai->knowledgeLibs->importTypeList);
$config->ai->myknowledgelib->search['params']['createdBy']   = array('operator' => '=', 'control' => 'select', 'values' => 'users');
$config->ai->myknowledgelib->search['params']['createdDate'] = array('operator' => '>=', 'control' => 'input', 'class' => 'date', 'values' => '');

/* 团队知识库搜索配置 */
$config->ai->teamknowledgelib = new stdclass();
$config->ai->teamknowledgelib->search = $config->ai->myknowledgelib->search;
$config->ai->teamknowledgelib->search['module'] = 'teamknowledgelib';

$config->ai->myknowledgelib->acceptFileTypes = '.pdf,.docx,.doc,.xlsx,.xls,.csv,.ppt,.pptx,.json,.yaml,.yml,.txt,.md';

$config->ai->queryModule = [];
$config->ai->queryModule['myknowledgelib']   = 'myknowledgelib';
$config->ai->queryModule['teamknowledgelib'] = 'teamknowledgelib';
