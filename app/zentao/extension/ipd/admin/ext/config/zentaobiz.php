<?php
$config->admin->navsGroup['feature']['feedback'] = ',feedback,ticket,';

$config->admin->menuGroup['projectflow']  = array('workflowgroup|project', 'workflowgroup|design', 'workflowgroup|report', 'process', 'activity', 'stage|browse', 'stage|batchcreate');
$config->admin->menuGroup['productflow']  = array('workflowgroup|product', 'workflowgroup|design', 'workflowgroup|report');
$config->admin->menuGroup['workflow']     = array('workflow', 'workflowdatasource', 'workflowrule');
$config->admin->menuGroup['approvalflow'] = array('approvalflow');

$config->admin->menuGroup['feature'][] = 'custom|browserelation';
$config->admin->menuGroup['feature'][] = 'custom|setcharterinfo';

$config->admin->menuModuleGroup['feature']['custom|required'][] = 'ticket';
