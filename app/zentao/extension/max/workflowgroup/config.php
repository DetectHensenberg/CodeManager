<?php
global $lang;
$config->workflowgroup = new stdclass();

$designUrl = in_array($config->edition, array('max', 'ipd')) ? array('module' => 'workflowgroup', 'method' => 'report', 'params' => 'id={id}') : array('module' => 'workflowgroup', 'method' => 'design', 'params' => 'id={id}');
$config->workflowgroup->actionList['design']['icon'] = 'design';
$config->workflowgroup->actionList['design']['hint'] = $lang->workflowgroup->design;
$config->workflowgroup->actionList['design']['text'] = $lang->workflowgroup->design;
$config->workflowgroup->actionList['design']['url']  = $designUrl;

$config->workflowgroup->actionList['release']['icon'] = 'publish';
$config->workflowgroup->actionList['release']['hint'] = $lang->workflowgroup->release;
$config->workflowgroup->actionList['release']['text'] = $lang->workflowgroup->release;
$config->workflowgroup->actionList['release']['url']  = array('module' => 'workflowgroup', 'method' => 'release', 'params' => 'id={id}');

$config->workflowgroup->actionList['deactivate']['icon']         = 'pause';
$config->workflowgroup->actionList['deactivate']['hint']         = $lang->workflowgroup->deactivate;
$config->workflowgroup->actionList['deactivate']['text']         = $lang->workflowgroup->deactivate;
$config->workflowgroup->actionList['deactivate']['url']          = array('module' => 'workflowgroup', 'method' => 'deactivate', 'params' => 'id={id}');
$config->workflowgroup->actionList['deactivate']['data-confirm'] = $lang->workflowgroup->notice->confirmDeactivate;

$config->workflowgroup->actionList['copy']['icon']        = 'copy';
$config->workflowgroup->actionList['copy']['hint']        = $lang->workflowgroup->copy;
$config->workflowgroup->actionList['copy']['text']        = $lang->workflowgroup->copy;
$config->workflowgroup->actionList['copy']['url']         = array('module' => 'workflowgroup', 'method' => 'copy', 'params' => 'id={id}');
$config->workflowgroup->actionList['copy']['data-toggle'] = 'modal';

$config->workflowgroup->actionList['edit']['icon']        = 'edit';
$config->workflowgroup->actionList['edit']['hint']        = $lang->workflowgroup->edit;
$config->workflowgroup->actionList['edit']['text']        = $lang->workflowgroup->edit;
$config->workflowgroup->actionList['edit']['url']         = array('module' => 'workflowgroup', 'method' => 'edit', 'params' => 'id={id}');
$config->workflowgroup->actionList['edit']['data-toggle'] = 'modal';

$config->workflowgroup->actionList['delete']['icon'] = 'trash';
$config->workflowgroup->actionList['delete']['hint'] = $lang->workflowgroup->delete;
$config->workflowgroup->actionList['delete']['text'] = $lang->workflowgroup->delete;
$config->workflowgroup->actionList['delete']['url']  = array('module' => 'workflowgroup', 'method' => 'delete', 'params' => 'id={id}');

$config->workflowgroup->actionList['setExclusive']['hint']         = $lang->workflowgroup->setExclusiveAB;
$config->workflowgroup->actionList['setExclusive']['text']         = $lang->workflowgroup->setExclusiveAB;
$config->workflowgroup->actionList['setExclusive']['url']          = array('module' => 'workflowgroup', 'method' => 'setExclusive', 'params' => 'flowID={id}&groupID=%s');
$config->workflowgroup->actionList['setExclusive']['data-confirm'] = $lang->workflowgroup->notice->confirmExclusive;

$config->workflowgroup->actionList['designFlow']['icon'] = 'design';
$config->workflowgroup->actionList['designFlow']['hint'] = $lang->workflowgroup->abbr->design;
$config->workflowgroup->actionList['designFlow']['text'] = $lang->workflowgroup->abbr->design;
$config->workflowgroup->actionList['designFlow']['url']  = array('module' => 'workflowgroup', 'method' => 'designFlow', 'params' => 'groupID=%s');

$config->workflowgroup->actionList['activateFlow']['icon']      = 'start';
$config->workflowgroup->actionList['activateFlow']['hint']      = $lang->workflowgroup->activateFlow;
$config->workflowgroup->actionList['activateFlow']['text']      = $lang->workflowgroup->abbr->activate;
$config->workflowgroup->actionList['activateFlow']['url']       = array('module' => 'workflowgroup', 'method' => 'activateFlow', 'params' => 'module={module}&groupID=%s');
$config->workflowgroup->actionList['activateFlow']['className'] = 'ajax-submit';

$config->workflowgroup->actionList['deactivateFlow']['icon']      = 'pause';
$config->workflowgroup->actionList['deactivateFlow']['hint']      = $lang->workflowgroup->deactivateFlow;
$config->workflowgroup->actionList['deactivateFlow']['text']      = $lang->workflowgroup->abbr->deactivate;
$config->workflowgroup->actionList['deactivateFlow']['url']       = array('module' => 'workflowgroup', 'method' => 'deactivateFlow', 'params' => 'module={module}&groupID=%s');
$config->workflowgroup->actionList['deactivateFlow']['className'] = 'ajax-submit';

$config->workflowgroup->modules['product'] = array('product', 'epic', 'requirement', 'story', 'productplan', 'release', 'bug', 'testcase', 'testtask', 'feedback', 'ticket');
$config->workflowgroup->modules['project']['product'] = array('project', 'execution', 'task', 'build', 'risk', 'issue', 'opportunity');
$config->workflowgroup->modules['project']['project'] = array('project', 'execution', 'task', 'epic', 'requirement', 'story', 'productplan', 'build', 'release', 'bug', 'testcase', 'testtask', 'feedback', 'ticket', 'risk', 'issue', 'opportunity');
$config->workflowgroup->modules['project']['ipd']        = $config->workflowgroup->modules['project']['product'];
$config->workflowgroup->modules['project']['tpd']        = $config->workflowgroup->modules['project']['product'];
$config->workflowgroup->modules['project']['cbb']        = $config->workflowgroup->modules['project']['product'];
$config->workflowgroup->modules['project']['cpdproduct'] = $config->workflowgroup->modules['project']['product'];
$config->workflowgroup->modules['project']['cpdproject'] = array('project', 'execution', 'task', 'epic', 'requirement', 'story', 'build', 'release', 'bug', 'testcase', 'testtask', 'feedback', 'ticket', 'risk', 'issue', 'opportunity');

$config->workflowgroup->featureGroup['scrum']     = array('deliverable', 'process', 'auditplan');
$config->workflowgroup->featureGroup['waterfall'] = array('deliverable', 'cm', 'change', 'process', 'auditplan');
