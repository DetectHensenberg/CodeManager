<?php
global $app;

$config->auditplan->form = new stdclass();
$config->auditplan->form->create['execution']   = array('required' => false, 'type' => 'int',      'default' => 0);
$config->auditplan->form->create['process']     = array('required' => true,  'type' => 'int',      'default' => 0);
$config->auditplan->form->create['objectID']    = array('required' => true,  'type' => 'int',      'default' => 0);
$config->auditplan->form->create['objectType']  = array('required' => false, 'type' => 'string',   'default' => 'activity');
$config->auditplan->form->create['status']      = array('required' => false, 'type' => 'string',   'default' => 'wait');
$config->auditplan->form->create['createdBy']   = array('required' => false, 'type' => 'string',   'default' => isset($app->user->account) ? $app->user->account : '');
$config->auditplan->form->create['createdDate'] = array('required' => false, 'type' => 'datetime', 'default' => helper::now());

$config->auditplan->form->edit['execution']      = array('required' => false, 'type' => 'int',      'default' => 0);
$config->auditplan->form->edit['process']        = array('required' => true,  'type' => 'int',      'default' => 0);
$config->auditplan->form->edit['objectID']       = array('required' => true,  'type' => 'int',      'default' => 0);
$config->auditplan->form->edit['objectType']     = array('required' => false, 'type' => 'string',   'default' => 'activity');
$config->auditplan->form->edit['assignedTo']     = array('required' => false, 'type' => 'string',   'default' => '');
$config->auditplan->form->edit['uid']            = array('required' => false, 'type' => 'string',   'default' => '');
$config->auditplan->form->edit['comment']        = array('required' => false, 'type' => 'string',   'default' => '', 'control' => 'editor');
$config->auditplan->form->edit['editedBy']       = array('required' => false, 'type' => 'string',   'default' => isset($app->user->account) ? $app->user->account : '');
$config->auditplan->form->edit['editedDate']     = array('required' => false, 'type' => 'datetime', 'default' => helper::now());

$config->auditplan->form->assignTo['checkDate']  = array('required' => true,  'type' => 'date',     'default' => NULL);
$config->auditplan->form->assignTo['assignedTo'] = array('required' => false, 'type' => 'string',   'default' => '');
$config->auditplan->form->assignTo['uid']        = array('required' => false, 'type' => 'string',   'default' => '');
$config->auditplan->form->assignTo['comment']    = array('required' => false, 'type' => 'string',   'default' => '', 'control' => 'editor');
$config->auditplan->form->assignTo['editedBy']   = array('required' => false, 'type' => 'string',   'default' => isset($app->user->account) ? $app->user->account : '');
$config->auditplan->form->assignTo['editedDate'] = array('required' => false, 'type' => 'datetime', 'default' => helper::now());

$config->auditplan->form->check['resultID']    = array('required' => false, 'type' => 'string', 'default' => '0');
$config->auditplan->form->check['listID']      = array('required' => false, 'type' => 'string', 'default' => '0');
$config->auditplan->form->check['status']      = array('required' => false, 'type' => 'string', 'default' => 'normal');
$config->auditplan->form->check['auditplan']   = array('required' => false, 'type' => 'int',    'default' => 0);
$config->auditplan->form->check['result']      = array('required' => true,  'type' => 'string', 'default' => 'pass', 'base' => true);
$config->auditplan->form->check['comment']     = array('required' => false, 'type' => 'string', 'default' => '');
$config->auditplan->form->check['severity']    = array('required' => false, 'type' => 'int',    'default' => 0);
$config->auditplan->form->check['checkedBy']   = array('required' => false, 'type' => 'string', 'default' => isset($app->user->account) ? $app->user->account : '');
$config->auditplan->form->check['checkedDate'] = array('required' => false, 'type' => 'date',   'default' => helper::today());

$config->auditplan->form->batchCreate['process']     = array('required' => true,  'type' => 'int',      'default' => 0, 'base' => true);
$config->auditplan->form->batchCreate['execution']   = array('required' => false, 'type' => 'int',      'default' => 0);
$config->auditplan->form->batchCreate['objectID']    = array('required' => true,  'type' => 'int',      'default' => 0);
$config->auditplan->form->batchCreate['checkDate']   = array('required' => true,  'type' => 'date',     'default' => NULL);
$config->auditplan->form->batchCreate['assignedTo']  = array('required' => false, 'type' => 'string',   'default' => '');
$config->auditplan->form->batchCreate['status']      = array('required' => false, 'type' => 'string',   'default' => 'wait');
$config->auditplan->form->batchCreate['objectType']  = array('required' => false, 'type' => 'string',   'default' => 'activity');
$config->auditplan->form->batchCreate['createdBy']   = array('required' => false, 'type' => 'string',   'default' => isset($app->user->account) ? $app->user->account : '');
$config->auditplan->form->batchCreate['createdDate'] = array('required' => false, 'type' => 'datetime', 'default' => helper::now());

$config->auditplan->form->batchEdit['id']         = array('required' => true,  'type' => 'int',      'default' => 0, 'base' => true);
$config->auditplan->form->batchEdit['process']    = array('required' => true,  'type' => 'int',      'default' => 0);
$config->auditplan->form->batchEdit['execution']  = array('required' => false, 'type' => 'int',      'default' => 0);
$config->auditplan->form->batchEdit['objectID']   = array('required' => true,  'type' => 'int',      'default' => 0);
$config->auditplan->form->batchEdit['checkDate']  = array('required' => true,  'type' => 'date',     'default' => NULL);
$config->auditplan->form->batchEdit['assignedTo'] = array('required' => false, 'type' => 'string',   'default' => '');
$config->auditplan->form->batchEdit['editedBy']   = array('required' => false, 'type' => 'string',   'default' => isset($app->user->account) ? $app->user->account : '');
$config->auditplan->form->batchEdit['editedDate'] = array('required' => false, 'type' => 'datetime', 'default' => helper::now());
