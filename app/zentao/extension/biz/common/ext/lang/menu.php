<?php
$lang->devops->homeMenu->deploy = array('link' => "{$lang->deployment->common}|deploy|browse", 'alias' => 'steps,managestep,create,edit,browse,view,scope,cases,treemap', 'subModule' => 'host,deploy,env,publishtemplate,tree,serverroom');

$lang->devops->homeMenu->deploy['subMenu'] = new stdclass();
$lang->devops->homeMenu->deploy['subMenu']->deploy = array('link' => "{$lang->devops->deploy}|deploy|browse", 'subModule' => 'deploy');
$lang->devops->homeMenu->deploy['subMenu']->host   = array('link' => "{$lang->devops->host}|host|browse", 'alias' => 'treemap,create,edit,tree,view,tree-browse', 'subModule' => 'tree,serverroom');

$lang->devops->homeMenu->deploy['menuOrder'][10] = 'deploy';
$lang->devops->homeMenu->deploy['menuOrder'][25] = 'host';

$lang->navGroup->workflow           = 'admin';
$lang->navGroup->workflowrule       = 'admin';
$lang->navGroup->workflowaction     = 'admin';
$lang->navGroup->workflowhook       = 'admin';
$lang->navGroup->workflowlinkage    = 'admin';
$lang->navGroup->workflowlayout     = 'admin';
$lang->navGroup->workflowlabel      = 'admin';
$lang->navGroup->workflowfield      = 'admin';
$lang->navGroup->workflowdatasource = 'admin';
$lang->navGroup->workflowcondition  = 'admin';
$lang->navGroup->workflowrelation   = 'admin';
$lang->navGroup->workflowreport     = 'admin';
$lang->navGroup->workflowgroup      = 'admin';

$lang->navGroup->approvalflow = 'admin';

$lang->scrum->menu->settings['alias'] .= ',workflowgroup';

$lang->waterfall->menu->settings['subMenu']->workflow = array('link' => "{$lang->projectFlow->common}|project|workflowgroup|project=%s", 'alias' => 'workflowgroup');
$lang->waterfall->menu->settings['alias'] .= ',workflowgroup';

$lang->aiapp->menu->knowledgelib = array('link' => "{$lang->ai->knowledgeLib}|ai|myknowledgelib", 'alias' => 'myknowledgelib,teamknowledgelib,knowledgelibview,searchknowledgelib');

$lang->aiapp->menuOrder[17] = 'knowledgelib';
$lang->aiapp->dividerMenu   = ',zentaoAgent,knowledgelib,';

$lang->navGroup->knowledgelib = 'aiapp';

$lang->aiapp->menu->knowledgelib['subMenu'] = new stdclass();
$lang->aiapp->menu->knowledgelib['subMenu']->myknowledgelib   = array('link' => "{$lang->ai->myKnowledgeLib}|ai|myknowledgelib");
$lang->aiapp->menu->knowledgelib['subMenu']->teamknowledgelib = array('link' => "{$lang->ai->teamKnowledgeLib}|ai|teamknowledgelib");

$lang->aiapp->menu->knowledgelib['menuOrder'][5]  = 'myknowledgelib';
$lang->aiapp->menu->knowledgelib['menuOrder'][10] = 'teamknowledgelib';

global $config;
if($config->edition != 'ipd' && !helper::hasFeature('program')) unset($lang->createObjects['charter'], $lang->searchObjects['charter']);
if(!helper::hasFeature('devops')) unset($lang->searchObjects['service'], $lang->searchObjects['deploy'], $lang->searchObjects['deploystep']);
