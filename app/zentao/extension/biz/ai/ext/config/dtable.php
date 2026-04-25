<?php
global $lang, $config, $app;

if(!isset($config->ai->dtable))  $config->ai->dtable  = new stdclass();
if(!isset($config->ai->actions)) $config->ai->actions = new stdclass();
if(!isset($config->ai->actionList)) $config->ai->actionList = array();

/* 定义知识库对象列表操作按钮 */
$config->ai->actionList['knowledgeViewContent']['icon']        = 'search';
$config->ai->actionList['knowledgeViewContent']['text']        = $lang->ai->knowledgeLibs->viewContent;
$config->ai->actionList['knowledgeViewContent']['hint']        = $lang->ai->knowledgeLibs->viewContent;
$config->ai->actionList['knowledgeViewContent']['url']         = array('module' => 'ai', 'method' => 'knowledgeContentView', 'params' => 'id={id}');
$config->ai->actionList['knowledgeViewContent']['data-toggle'] = 'modal';
$config->ai->actionList['knowledgeViewContent']['data-size']   = 'md';

$config->ai->actions->knowledgeObject = array('knowledgeViewContent');

/* 知识库对象列表 - 通用操作 */
$config->ai->dtable->knowledgeObjectActions['name']     = 'actions';
$config->ai->dtable->knowledgeObjectActions['title']    = $lang->actions;
$config->ai->dtable->knowledgeObjectActions['type']     = 'actions';
$config->ai->dtable->knowledgeObjectActions['minWidth'] = 48;
$config->ai->dtable->knowledgeObjectActions['fixed']    = 'right';
$config->ai->dtable->knowledgeObjectActions['list']     = $config->ai->actionList;
$config->ai->dtable->knowledgeObjectActions['menu']     = $config->ai->actions->knowledgeObject;

/* 知识库对象列表 - 默认 */
$config->ai->dtable->knowledgeObjectCols = array();
$config->ai->dtable->knowledgeObjectCols['default'] = array();
$config->ai->dtable->knowledgeObjectCols['default']['id']['name']     = 'id';
$config->ai->dtable->knowledgeObjectCols['default']['id']['title']    = $lang->ai->knowledgeLibs->columnName['default']['id'];
$config->ai->dtable->knowledgeObjectCols['default']['id']['type']     = 'checkID';
$config->ai->dtable->knowledgeObjectCols['default']['id']['checkbox'] = true;
$config->ai->dtable->knowledgeObjectCols['default']['id']['width']    = '80';
$config->ai->dtable->knowledgeObjectCols['default']['id']['sortType'] = false;

$config->ai->dtable->knowledgeObjectCols['default']['title']['name']     = 'title';
$config->ai->dtable->knowledgeObjectCols['default']['title']['title']    = $lang->ai->knowledgeLibs->columnName['default']['title'];
$config->ai->dtable->knowledgeObjectCols['default']['title']['type']     = 'title';
$config->ai->dtable->knowledgeObjectCols['default']['title']['flex']     = 1;
$config->ai->dtable->knowledgeObjectCols['default']['title']['sortType'] = false;

/* 知识库对象列表 - 文档 */
$config->ai->dtable->knowledgeObjectCols['doc'] = array();
$config->ai->dtable->knowledgeObjectCols['doc']['id']['name']     = 'id';
$config->ai->dtable->knowledgeObjectCols['doc']['id']['title']    = $lang->ai->knowledgeLibs->columnName['default']['id'];
$config->ai->dtable->knowledgeObjectCols['doc']['id']['type']     = 'checkID';
$config->ai->dtable->knowledgeObjectCols['doc']['id']['checkbox'] = true;
$config->ai->dtable->knowledgeObjectCols['doc']['id']['width']    = '80';
$config->ai->dtable->knowledgeObjectCols['doc']['id']['sortType'] = false;

$config->ai->dtable->knowledgeObjectCols['doc']['title']['name']        = 'title';
$config->ai->dtable->knowledgeObjectCols['doc']['title']['title']       = $lang->ai->knowledgeLibs->columnName['doc']['title'];
$config->ai->dtable->knowledgeObjectCols['doc']['title']['type']        = 'title';
$config->ai->dtable->knowledgeObjectCols['doc']['title']['flex']        = 1;
$config->ai->dtable->knowledgeObjectCols['doc']['title']['sortType']    = false;
$config->ai->dtable->knowledgeObjectCols['doc']['title']['link']        = array('module' => 'doc', 'method' => 'view', 'params' => 'docID={objectID}');
$config->ai->dtable->knowledgeObjectCols['doc']['title']['data-toggle'] = 'modal';
$config->ai->dtable->knowledgeObjectCols['doc']['title']['data-size']   = 'lg';

$config->ai->dtable->knowledgeObjectCols['doc']['addedBy']['name']     = 'addedBy';
$config->ai->dtable->knowledgeObjectCols['doc']['addedBy']['title']    = $lang->ai->knowledgeLibs->columnName['doc']['addedByAB'];
$config->ai->dtable->knowledgeObjectCols['doc']['addedBy']['type']     = 'user';
$config->ai->dtable->knowledgeObjectCols['doc']['addedBy']['width']    = '100';
$config->ai->dtable->knowledgeObjectCols['doc']['addedBy']['sortType'] = false;

$config->ai->dtable->knowledgeObjectCols['doc']['addedDate']['name']     = 'addedDate';
$config->ai->dtable->knowledgeObjectCols['doc']['addedDate']['title']    = $lang->ai->knowledgeLibs->columnName['doc']['addedDate'];
$config->ai->dtable->knowledgeObjectCols['doc']['addedDate']['type']     = 'date';
$config->ai->dtable->knowledgeObjectCols['doc']['addedDate']['width']    = '100';
$config->ai->dtable->knowledgeObjectCols['doc']['addedDate']['sortType'] = false;

$config->ai->dtable->knowledgeObjectCols['doc']['docEditedBy']['name']     = 'docEditedBy';
$config->ai->dtable->knowledgeObjectCols['doc']['docEditedBy']['title']    = $lang->ai->knowledgeLibs->columnName['doc']['editedBy'];
$config->ai->dtable->knowledgeObjectCols['doc']['docEditedBy']['type']     = 'user';
$config->ai->dtable->knowledgeObjectCols['doc']['docEditedBy']['width']    = '100';
$config->ai->dtable->knowledgeObjectCols['doc']['docEditedBy']['sortType'] = false;

$config->ai->dtable->knowledgeObjectCols['doc']['docEditedDate']['name']     = 'docEditedDate';
$config->ai->dtable->knowledgeObjectCols['doc']['docEditedDate']['title']    = $lang->ai->knowledgeLibs->columnName['doc']['editedDate'];
$config->ai->dtable->knowledgeObjectCols['doc']['docEditedDate']['type']     = 'date';
$config->ai->dtable->knowledgeObjectCols['doc']['docEditedDate']['width']    = '100';
$config->ai->dtable->knowledgeObjectCols['doc']['docEditedDate']['sortType'] = false;

/* 知识库对象列表 - 问题 */
$config->ai->dtable->knowledgeObjectCols['issue'] = array();
$config->ai->dtable->knowledgeObjectCols['issue']['id']['name']     = 'id';
$config->ai->dtable->knowledgeObjectCols['issue']['id']['title']    = $lang->ai->knowledgeLibs->columnName['default']['id'];
$config->ai->dtable->knowledgeObjectCols['issue']['id']['type']     = 'checkID';
$config->ai->dtable->knowledgeObjectCols['issue']['id']['checkbox'] = true;
$config->ai->dtable->knowledgeObjectCols['issue']['id']['width']    = '80';
$config->ai->dtable->knowledgeObjectCols['issue']['id']['sortType'] = false;

$config->ai->dtable->knowledgeObjectCols['issue']['title']['name']     = 'title';
$config->ai->dtable->knowledgeObjectCols['issue']['title']['title']    = $lang->ai->knowledgeLibs->columnName['issue']['title'];
$config->ai->dtable->knowledgeObjectCols['issue']['title']['type']     = 'title';
$config->ai->dtable->knowledgeObjectCols['issue']['title']['flex']     = 1;
$config->ai->dtable->knowledgeObjectCols['issue']['title']['sortType'] = false;
$config->ai->dtable->knowledgeObjectCols['issue']['title']['link']     = array('module' => 'assetlib', 'method' => 'issueView', 'params' => 'issueID={objectID}');

$config->ai->dtable->knowledgeObjectCols['issue']['pri']['name']      = 'pri';
$config->ai->dtable->knowledgeObjectCols['issue']['pri']['title']     = $lang->ai->knowledgeLibs->columnName['issue']['pri'];
$config->ai->dtable->knowledgeObjectCols['issue']['pri']['type']      = 'pri';
$config->ai->dtable->knowledgeObjectCols['issue']['pri']['width']     = '60';
$config->ai->dtable->knowledgeObjectCols['issue']['pri']['sortType']  = false;

$config->ai->dtable->knowledgeObjectCols['issue']['severity']['name']         = 'severity';
$config->ai->dtable->knowledgeObjectCols['issue']['severity']['title']        = $lang->ai->knowledgeLibs->columnName['issue']['severity'];
$config->ai->dtable->knowledgeObjectCols['issue']['severity']['type']         = 'severity';
$config->ai->dtable->knowledgeObjectCols['issue']['severity']['severityList'] = $lang->ai->knowledgeLibs->columnValueMap['issue']['severity'];
$config->ai->dtable->knowledgeObjectCols['issue']['severity']['width']        = '100';
$config->ai->dtable->knowledgeObjectCols['issue']['severity']['sortType']     = false;

$config->ai->dtable->knowledgeObjectCols['issue']['status']['name']      = 'status';
$config->ai->dtable->knowledgeObjectCols['issue']['status']['title']     = $lang->ai->knowledgeLibs->columnName['issue']['status'];
$config->ai->dtable->knowledgeObjectCols['issue']['status']['type']      = 'status';
$config->ai->dtable->knowledgeObjectCols['issue']['status']['statusMap'] = $lang->ai->knowledgeLibs->columnValueMap['issue']['status'];
$config->ai->dtable->knowledgeObjectCols['issue']['status']['width']     = '100';
$config->ai->dtable->knowledgeObjectCols['issue']['status']['sortType']  = false;

$config->ai->dtable->knowledgeObjectCols['issue']['type']['name']     = 'issueType';
$config->ai->dtable->knowledgeObjectCols['issue']['type']['title']    = $lang->ai->knowledgeLibs->columnName['issue']['issueType'];
$config->ai->dtable->knowledgeObjectCols['issue']['type']['type']     = 'category';
$config->ai->dtable->knowledgeObjectCols['issue']['type']['map']      = $lang->ai->knowledgeLibs->columnValueMap['issue']['issueType'];
$config->ai->dtable->knowledgeObjectCols['issue']['type']['width']    = '80';
$config->ai->dtable->knowledgeObjectCols['issue']['type']['sortType'] = false;

$config->ai->dtable->knowledgeObjectCols['issue']['createdBy']['name']     = 'assetCreatedBy';
$config->ai->dtable->knowledgeObjectCols['issue']['createdBy']['title']    = $lang->ai->knowledgeLibs->columnName['issue']['assetCreatedBy'];
$config->ai->dtable->knowledgeObjectCols['issue']['createdBy']['type']     = 'user';
$config->ai->dtable->knowledgeObjectCols['issue']['createdBy']['width']    = '100';
$config->ai->dtable->knowledgeObjectCols['issue']['createdBy']['sortType'] = false;

$config->ai->dtable->knowledgeObjectCols['issue']['createdDate']['name']     = 'assetCreatedDate';
$config->ai->dtable->knowledgeObjectCols['issue']['createdDate']['title']    = $lang->ai->knowledgeLibs->columnName['issue']['assetCreatedDate'];
$config->ai->dtable->knowledgeObjectCols['issue']['createdDate']['type']     = 'date';
$config->ai->dtable->knowledgeObjectCols['issue']['createdDate']['width']    = '100';
$config->ai->dtable->knowledgeObjectCols['issue']['createdDate']['sortType'] = false;

$config->ai->dtable->knowledgeObjectCols['issue']['assignedTo']['name']     = 'assignedTo';
$config->ai->dtable->knowledgeObjectCols['issue']['assignedTo']['title']    = $lang->ai->knowledgeLibs->columnName['issue']['assignedTo'];
$config->ai->dtable->knowledgeObjectCols['issue']['assignedTo']['type']     = 'user';
$config->ai->dtable->knowledgeObjectCols['issue']['assignedTo']['width']    = '100';
$config->ai->dtable->knowledgeObjectCols['issue']['assignedTo']['sortType'] = false;

$config->ai->dtable->knowledgeObjectCols['issue']['approvedDate']['name']     = 'approvedDate';
$config->ai->dtable->knowledgeObjectCols['issue']['approvedDate']['title']    = $lang->ai->knowledgeLibs->columnName['issue']['approvedDate'];
$config->ai->dtable->knowledgeObjectCols['issue']['approvedDate']['type']     = 'date';
$config->ai->dtable->knowledgeObjectCols['issue']['approvedDate']['width']    = '100';
$config->ai->dtable->knowledgeObjectCols['issue']['approvedDate']['sortType'] = false;

/* 知识库对象列表 - 风险 */
$config->ai->dtable->knowledgeObjectCols['risk'] = array();
$config->ai->dtable->knowledgeObjectCols['risk']['id']['name']     = 'id';
$config->ai->dtable->knowledgeObjectCols['risk']['id']['title']    = $lang->ai->knowledgeLibs->columnName['default']['id'];
$config->ai->dtable->knowledgeObjectCols['risk']['id']['type']     = 'checkID';
$config->ai->dtable->knowledgeObjectCols['risk']['id']['checkbox'] = true;
$config->ai->dtable->knowledgeObjectCols['risk']['id']['width']    = '80';
$config->ai->dtable->knowledgeObjectCols['risk']['id']['sortType'] = false;

$config->ai->dtable->knowledgeObjectCols['risk']['name']['name']     = 'name';
$config->ai->dtable->knowledgeObjectCols['risk']['name']['title']    = $lang->ai->knowledgeLibs->columnName['risk']['title'];
$config->ai->dtable->knowledgeObjectCols['risk']['name']['type']     = 'title';
$config->ai->dtable->knowledgeObjectCols['risk']['name']['flex']     = 1;
$config->ai->dtable->knowledgeObjectCols['risk']['name']['sortType'] = false;
$config->ai->dtable->knowledgeObjectCols['risk']['name']['link']     = array('module' => 'assetlib', 'method' => 'riskView', 'params' => 'riskID={objectID}');

$config->ai->dtable->knowledgeObjectCols['risk']['pri']['name']     = 'pri';
$config->ai->dtable->knowledgeObjectCols['risk']['pri']['title']    = $lang->ai->knowledgeLibs->columnName['risk']['pri'];
$config->ai->dtable->knowledgeObjectCols['risk']['pri']['type']     = 'pri';
$config->ai->dtable->knowledgeObjectCols['risk']['pri']['priList']  = $lang->ai->knowledgeLibs->columnValueMap['risk']['pri'];
$config->ai->dtable->knowledgeObjectCols['risk']['pri']['width']    = '60';
$config->ai->dtable->knowledgeObjectCols['risk']['pri']['sortType'] = false;

$config->ai->dtable->knowledgeObjectCols['risk']['status']['name']      = 'status';
$config->ai->dtable->knowledgeObjectCols['risk']['status']['title']     = $lang->ai->knowledgeLibs->columnName['risk']['status'];
$config->ai->dtable->knowledgeObjectCols['risk']['status']['type']      = 'status';
$config->ai->dtable->knowledgeObjectCols['risk']['status']['statusMap'] = $lang->ai->knowledgeLibs->columnValueMap['risk']['status'];
$config->ai->dtable->knowledgeObjectCols['risk']['status']['width']     = '100';
$config->ai->dtable->knowledgeObjectCols['risk']['status']['sortType']  = false;

$config->ai->dtable->knowledgeObjectCols['risk']['strategy']['name']     = 'strategy';
$config->ai->dtable->knowledgeObjectCols['risk']['strategy']['title']    = $lang->ai->knowledgeLibs->columnName['risk']['strategy'];
$config->ai->dtable->knowledgeObjectCols['risk']['strategy']['type']     = 'category';
$config->ai->dtable->knowledgeObjectCols['risk']['strategy']['map']      = $lang->ai->knowledgeLibs->columnValueMap['risk']['strategy'];
$config->ai->dtable->knowledgeObjectCols['risk']['strategy']['width']    = '100';
$config->ai->dtable->knowledgeObjectCols['risk']['strategy']['sortType'] = false;

$config->ai->dtable->knowledgeObjectCols['risk']['assetCreatedBy']['name']     = 'assetCreatedBy';
$config->ai->dtable->knowledgeObjectCols['risk']['assetCreatedBy']['title']    = $lang->ai->knowledgeLibs->columnName['risk']['assetCreatedBy'];
$config->ai->dtable->knowledgeObjectCols['risk']['assetCreatedBy']['type']     = 'user';
$config->ai->dtable->knowledgeObjectCols['risk']['assetCreatedBy']['width']    = '100';
$config->ai->dtable->knowledgeObjectCols['risk']['assetCreatedBy']['sortType'] = false;

$config->ai->dtable->knowledgeObjectCols['risk']['assetCreatedDate']['name']     = 'assetCreatedDate';
$config->ai->dtable->knowledgeObjectCols['risk']['assetCreatedDate']['title']    = $lang->ai->knowledgeLibs->columnName['risk']['assetCreatedDate'];
$config->ai->dtable->knowledgeObjectCols['risk']['assetCreatedDate']['type']     = 'date';
$config->ai->dtable->knowledgeObjectCols['risk']['assetCreatedDate']['width']    = '100';
$config->ai->dtable->knowledgeObjectCols['risk']['assetCreatedDate']['sortType'] = false;

$config->ai->dtable->knowledgeObjectCols['risk']['assignedTo']['name']     = 'assignedTo';
$config->ai->dtable->knowledgeObjectCols['risk']['assignedTo']['title']    = $lang->ai->knowledgeLibs->columnName['risk']['assignedTo'];
$config->ai->dtable->knowledgeObjectCols['risk']['assignedTo']['type']     = 'user';
$config->ai->dtable->knowledgeObjectCols['risk']['assignedTo']['width']    = '100';
$config->ai->dtable->knowledgeObjectCols['risk']['assignedTo']['sortType'] = false;

$config->ai->dtable->knowledgeObjectCols['risk']['approvedDate']['name']     = 'approvedDate';
$config->ai->dtable->knowledgeObjectCols['risk']['approvedDate']['title']    = $lang->ai->knowledgeLibs->columnName['risk']['approvedDate'];
$config->ai->dtable->knowledgeObjectCols['risk']['approvedDate']['type']     = 'date';
$config->ai->dtable->knowledgeObjectCols['risk']['approvedDate']['width']    = '100';
$config->ai->dtable->knowledgeObjectCols['risk']['approvedDate']['sortType'] = false;

/* 知识库对象列表 - 机会 */
$config->ai->dtable->knowledgeObjectCols['opportunity'] = array();
$config->ai->dtable->knowledgeObjectCols['opportunity']['id']['name']     = 'id';
$config->ai->dtable->knowledgeObjectCols['opportunity']['id']['title']    = $lang->ai->knowledgeLibs->columnName['default']['id'];
$config->ai->dtable->knowledgeObjectCols['opportunity']['id']['type']     = 'checkID';
$config->ai->dtable->knowledgeObjectCols['opportunity']['id']['checkbox'] = true;
$config->ai->dtable->knowledgeObjectCols['opportunity']['id']['width']    = '80';
$config->ai->dtable->knowledgeObjectCols['opportunity']['id']['sortType'] = false;

$config->ai->dtable->knowledgeObjectCols['opportunity']['name']['name']     = 'name';
$config->ai->dtable->knowledgeObjectCols['opportunity']['name']['title']    = $lang->ai->knowledgeLibs->columnName['opportunity']['name'];
$config->ai->dtable->knowledgeObjectCols['opportunity']['name']['type']     = 'title';
$config->ai->dtable->knowledgeObjectCols['opportunity']['name']['flex']     = 1;
$config->ai->dtable->knowledgeObjectCols['opportunity']['name']['sortType'] = false;
$config->ai->dtable->knowledgeObjectCols['opportunity']['name']['link']     = array('module' => 'assetlib', 'method' => 'opportunityView', 'params' => 'opportunityID={objectID}');

$config->ai->dtable->knowledgeObjectCols['opportunity']['pri']['name']     = 'pri';
$config->ai->dtable->knowledgeObjectCols['opportunity']['pri']['title']    = $lang->ai->knowledgeLibs->columnName['opportunity']['pri'];
$config->ai->dtable->knowledgeObjectCols['opportunity']['pri']['type']     = 'pri';
$config->ai->dtable->knowledgeObjectCols['opportunity']['pri']['priList']  = $lang->ai->knowledgeLibs->columnValueMap['opportunity']['pri'];
$config->ai->dtable->knowledgeObjectCols['opportunity']['pri']['width']    = '60';
$config->ai->dtable->knowledgeObjectCols['opportunity']['pri']['sortType'] = false;

$config->ai->dtable->knowledgeObjectCols['opportunity']['status']['name']      = 'status';
$config->ai->dtable->knowledgeObjectCols['opportunity']['status']['title']     = $lang->ai->knowledgeLibs->columnName['opportunity']['status'];
$config->ai->dtable->knowledgeObjectCols['opportunity']['status']['type']      = 'status';
$config->ai->dtable->knowledgeObjectCols['opportunity']['status']['statusMap'] = $lang->ai->knowledgeLibs->columnValueMap['opportunity']['status'];
$config->ai->dtable->knowledgeObjectCols['opportunity']['status']['width']     = '100';
$config->ai->dtable->knowledgeObjectCols['opportunity']['status']['sortType']  = false;

$config->ai->dtable->knowledgeObjectCols['opportunity']['opportunityType']['name']     = 'opportunityType';
$config->ai->dtable->knowledgeObjectCols['opportunity']['opportunityType']['title']    = $lang->ai->knowledgeLibs->columnName['opportunity']['opportunityType'];
$config->ai->dtable->knowledgeObjectCols['opportunity']['opportunityType']['type']     = 'category';
$config->ai->dtable->knowledgeObjectCols['opportunity']['opportunityType']['map']      = $lang->ai->knowledgeLibs->columnValueMap['opportunity']['opportunityType'];
$config->ai->dtable->knowledgeObjectCols['opportunity']['opportunityType']['width']    = '100';
$config->ai->dtable->knowledgeObjectCols['opportunity']['opportunityType']['sortType'] = false;

$config->ai->dtable->knowledgeObjectCols['opportunity']['assetCreatedBy']['name']     = 'assetCreatedBy';
$config->ai->dtable->knowledgeObjectCols['opportunity']['assetCreatedBy']['title']    = $lang->ai->knowledgeLibs->columnName['opportunity']['assetCreatedBy'];
$config->ai->dtable->knowledgeObjectCols['opportunity']['assetCreatedBy']['type']     = 'user';
$config->ai->dtable->knowledgeObjectCols['opportunity']['assetCreatedBy']['width']    = '100';
$config->ai->dtable->knowledgeObjectCols['opportunity']['assetCreatedBy']['sortType'] = false;

$config->ai->dtable->knowledgeObjectCols['opportunity']['assetCreatedDate']['name']     = 'assetCreatedDate';
$config->ai->dtable->knowledgeObjectCols['opportunity']['assetCreatedDate']['title']    = $lang->ai->knowledgeLibs->columnName['opportunity']['assetCreatedDate'];
$config->ai->dtable->knowledgeObjectCols['opportunity']['assetCreatedDate']['type']     = 'date';
$config->ai->dtable->knowledgeObjectCols['opportunity']['assetCreatedDate']['width']    = '100';
$config->ai->dtable->knowledgeObjectCols['opportunity']['assetCreatedDate']['sortType'] = false;

$config->ai->dtable->knowledgeObjectCols['opportunity']['assignedTo']['name']     = 'assignedTo';
$config->ai->dtable->knowledgeObjectCols['opportunity']['assignedTo']['title']    = $lang->ai->knowledgeLibs->columnName['opportunity']['assignedTo'];
$config->ai->dtable->knowledgeObjectCols['opportunity']['assignedTo']['type']     = 'user';
$config->ai->dtable->knowledgeObjectCols['opportunity']['assignedTo']['width']    = '100';
$config->ai->dtable->knowledgeObjectCols['opportunity']['assignedTo']['sortType'] = false;

$config->ai->dtable->knowledgeObjectCols['opportunity']['approvedDate']['name']     = 'approvedDate';
$config->ai->dtable->knowledgeObjectCols['opportunity']['approvedDate']['title']    = $lang->ai->knowledgeLibs->columnName['opportunity']['approvedDate'];
$config->ai->dtable->knowledgeObjectCols['opportunity']['approvedDate']['type']     = 'date';
$config->ai->dtable->knowledgeObjectCols['opportunity']['approvedDate']['width']    = '100';
$config->ai->dtable->knowledgeObjectCols['opportunity']['approvedDate']['sortType'] = false;

/* 知识库对象列表 - 最佳实践 */
$config->ai->dtable->knowledgeObjectCols['practice'] = $config->ai->dtable->knowledgeObjectCols['doc'];
$config->ai->dtable->knowledgeObjectCols['practice']['title']['link'] = array('module' => 'assetlib', 'method' => 'practiceView', 'params' => 'objectID={objectID}');
unset($config->ai->dtable->knowledgeObjectCols['practice']['title']['data-toggle']);
unset($config->ai->dtable->knowledgeObjectCols['practice']['title']['data-size']);

/* 知识库对象列表 - 组件 */
$config->ai->dtable->knowledgeObjectCols['component'] = $config->ai->dtable->knowledgeObjectCols['doc'];
$config->ai->dtable->knowledgeObjectCols['component']['title']['link'] = array('module' => 'assetlib', 'method' => 'componentView', 'params' => 'objectID={objectID}');
unset($config->ai->dtable->knowledgeObjectCols['component']['title']['data-toggle']);
unset($config->ai->dtable->knowledgeObjectCols['component']['title']['data-size']);
