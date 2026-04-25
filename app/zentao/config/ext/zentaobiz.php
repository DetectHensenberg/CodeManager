<?php
$config->bizVersion = '13.1';

$filter->file->ajaxwopifiles = new stdclass();
$filter->file->ajaxwopifiles->get['access_token'] = 'code';
$filter->doc->default->cookie['checkedItem']      = 'reg::checked';
$filter->doc->default->cookie['checkedFileItem']  = 'reg::checked';

$filter->traincourse = new stdclass();
$filter->traincourse->browse = new stdclass();
$filter->traincourse->browse->cookie['courseModule'] = 'int';
$filter->traincourse->admin = new stdclass();
$filter->traincourse->admin->cookie['courseModule'] = 'int';

if(!defined('TABLE_TRAINCOURSE'))       define('TABLE_TRAINCOURSE', '`' . $config->db->prefix . 'traincourse`');
if(!defined('TABLE_TRAINCONTENTS'))     define('TABLE_TRAINCONTENTS', '`' . $config->db->prefix . 'traincontents`');
if(!defined('TABLE_TRAINCATEGORY'))     define('TABLE_TRAINCATEGORY', '`' . $config->db->prefix . 'traincategory`');
if(!defined('TABLE_TRAINRECORDS'))      define('TABLE_TRAINRECORDS', '`' . $config->db->prefix . 'trainrecords`');
if(!defined('TABLE_PRACTICE'))          define('TABLE_PRACTICE', '`' . $config->db->prefix . 'practice`');
if(!defined('TABLE_AI_KNOWLEDGELIB'))   define('TABLE_AI_KNOWLEDGELIB', '`' . $config->db->prefix . 'ai_knowledgelib`');
if(!defined('TABLE_AI_KNOWLEDGEITEM'))  define('TABLE_AI_KNOWLEDGEITEM', '`' . $config->db->prefix . 'ai_knowledgeitem`');

$config->objectTables['traincourse']        = TABLE_TRAINCOURSE;
$config->objectTables['traincategory']      = TABLE_TRAINCATEGORY;
$config->objectTables['traincontents']      = TABLE_TRAINCONTENTS;
$config->objectTables['trainrecords']       = TABLE_TRAINRECORDS;
$config->objectTables['practice']           = TABLE_PRACTICE;
$config->objectTables['dimension']          = TABLE_DIMENSION;
$config->objectTables['screen']             = TABLE_SCREEN;
$config->objectTables['chart']              = TABLE_CHART;
$config->objectTables['pivot']              = TABLE_PIVOT;
$config->objectTables['dashboard']          = TABLE_DASHBOARD;
$config->objectTables['chartgroup']         = TABLE_MODULE;
$config->objectTables['approvalflowobject'] = TABLE_APPROVALFLOWOBJECT;

$config->openMethods[] = 'file.ajaxwopifiles';
$config->openMethods[] = 'traincourse.downloadcourse';

$config->logonMethods[] = 'traincourse.playvideo';
$config->logonMethods[] = 'traincourse.viewpdf';
$config->logonMethods[] = 'metric.downloadtemplate';
$config->logonMethods[] = 'metric.publish';
$config->logonMethods[] = 'sqlbuilder.index';
$config->logonMethods[] = 'charter.loadroadmapstories';
$config->logonMethods[] = 'task.exportchart';
$config->logonMethods[] = 'story.exportchart';
$config->logonMethods[] = 'execution.exportchart';
$config->logonMethods[] = 'doc.buildzentaoconfig';
$config->logonMethods[] = 'testcase.exportchart';
$config->logonMethods[] = 'project.exportchart';
$config->logonMethods[] = 'ai.promptassignrole';
$config->logonMethods[] = 'ai.promptselectdatasource';
$config->logonMethods[] = 'ai.promptsetpurpose';
$config->logonMethods[] = 'ai.promptsettargetform';
$config->logonMethods[] = 'ai.promptfinalize';
$config->logonMethods[] = 'ai.promptaudit';
$config->logonMethods[] = 'ai.knowledgelibview';
$config->logonMethods[] = 'ai.createtextknowledge';
$config->logonMethods[] = 'ai.createfileknowledge';
$config->logonMethods[] = 'ai.adddoc';
$config->logonMethods[] = 'ai.knowledgecontentview';
$config->logonMethods[] = 'ai.selectknowledgelib';
$config->logonMethods[] = 'ai.batchdeleteknowledgeitem';

if($config->edition != 'open')
{
    $config->featureGroup->other = array_merge($config->featureGroup->other, array('OA', 'traincourse'));
}

$config->excludeDropmenuList = array_merge($config->excludeDropmenuList, array('charter-browse', 'charter-create', 'charter-view', 'charter-edit', 'charter-completionapproval', 'charter-cancelprojectapproval', 'ticket-batchclose'));

$config->cneExternalUrl = function_exists('getEnvData') ? getEnvData('CNE_EXTERNAL_URL', '') : '';

if(!isset($filter->task->report)) $filter->task->report = new stdclass();
$filter->task->report->cookie['productBrowseParam'] = 'int';
$filter->task->report->cookie['moduleBrowseParam']  = 'int';
