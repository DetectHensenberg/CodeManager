<?php
$lang->block->default['waterfallproject'][] = array('title' => 'Estimate',                                       'module' => 'waterfallproject', 'code' => 'waterfallestimate',      'width' => '1');
$lang->block->default['waterfallproject'][] = array('title' => $lang->projectCommon . ' Weekly',                 'module' => 'waterfallproject', 'code' => 'waterfallreport',        'width' => '2');
$lang->block->default['waterfallproject'][] = array('title' => 'Recent Activity',                                'module' => 'waterfallproject', 'code' => 'projectdynamic',         'width' => '1');
if(helper::hasFeature('project_issue')) $lang->block->default['waterfallproject'][] = array('title' => $lang->projectCommon . ' Issue',                  'module' => 'waterfallproject', 'code' => 'waterfallissue',         'width' => '2', 'params' => array('type' => 'all', 'count' => '15', 'orderBy' => 'id_desc'));
if(helper::hasFeature('project_risk'))  $lang->block->default['waterfallproject'][] = array('title' => $lang->projectCommon . ' Risk',                   'module' => 'waterfallproject', 'code' => 'waterfallrisk',          'width' => '2', 'params' => array('type' => 'all', 'count' => '15', 'orderBy' => 'id_desc'));

if(helper::hasFeature('project_issue')) $lang->block->default['scrumproject'][] = array('title' => $lang->projectCommon . ' Issue', 'module' => 'scrumproject', 'code' => 'scrumissue', 'width' => '2', 'params' => array('type' => 'all', 'count' => '15', 'orderBy' => 'id_desc'));
if(helper::hasFeature('project_risk'))  $lang->block->default['scrumproject'][] = array('title' => $lang->projectCommon . ' Risk',  'module' => 'scrumproject', 'code' => 'scrumrisk',  'width' => '2', 'params' => array('type' => 'all', 'count' => '15', 'orderBy' => 'id_desc'));

$lang->block->modules['waterfallproject']->availableBlocks['waterfallestimate']      = "Estimate";
$lang->block->modules['waterfallproject']->availableBlocks['waterfallreport']        = "{$lang->projectCommon} Weekly";
$lang->block->modules['waterfallproject']->availableBlocks['waterfallprogress']      = "{$lang->projectCommon} Progress Trends So far";
if(helper::hasFeature('project_issue')) $lang->block->modules['waterfallproject']->availableBlocks['waterfallissue'] = "{$lang->projectCommon} Issue";
if(helper::hasFeature('project_risk'))  $lang->block->modules['waterfallproject']->availableBlocks['waterfallrisk']  = "{$lang->projectCommon} Risk";

if(helper::hasFeature('project_issue')) $lang->block->modules['scrumproject']->availableBlocks['scrumissue'] = "{$lang->projectCommon} Issue";
if(helper::hasFeature('project_risk'))  $lang->block->modules['scrumproject']->availableBlocks['scrumrisk']  = "{$lang->projectCommon} Risk";

$lang->block->welcome->assignList['issue']       = 'Issue';
$lang->block->welcome->assignList['risk']        = 'Risk';
$lang->block->welcome->assignList['reviewissue'] = 'Review Issue';
$lang->block->welcome->assignList['auditplan']   = 'QA';

$lang->block->welcome->reviewList['case'] = 'Case';
$lang->block->welcome->reviewList['line'] = 'Line';
