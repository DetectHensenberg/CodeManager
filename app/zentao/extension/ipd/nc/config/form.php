<?php
global $app;

$config->nc->form = new stdclass();
$config->nc->form->edit['title']        = array('required' => true,  'type' => 'string',   'default' => '');
$config->nc->form->edit['type']         = array('required' => false, 'type' => 'string',   'default' => '');
$config->nc->form->edit['execution']    = array('required' => false, 'type' => 'int',      'default' => 0);
$config->nc->form->edit['auditplan']    = array('required' => false, 'type' => 'int',      'default' => 0);
$config->nc->form->edit['deliverable']  = array('required' => false, 'type' => 'int',      'default' => 0);
$config->nc->form->edit['listID']       = array('required' => false, 'type' => 'int',      'default' => 0);
$config->nc->form->edit['severity']     = array('required' => true,  'type' => 'string',   'default' => '');
$config->nc->form->edit['assignedTo']   = array('required' => false, 'type' => 'string',   'default' => '');
$config->nc->form->edit['assignedDate'] = array('required' => false, 'type' => 'string',   'default' => helper::today());
$config->nc->form->edit['uid']          = array('required' => false, 'type' => 'string',   'default' => '');
$config->nc->form->edit['desc']         = array('required' => false, 'type' => 'string',   'default' => '', 'control' => 'editor');
$config->nc->form->edit['deadline']     = array('required' => false, 'type' => 'date',     'default' => null);
$config->nc->form->edit['editedBy']     = array('required' => false, 'type' => 'string',   'default' => isset($app->user->account) ? $app->user->account : '');
$config->nc->form->edit['editedDate']   = array('required' => false, 'type' => 'datetime', 'default' => helper::now());

$config->nc->form->assignTo['assignedTo']   = array('required' => false, 'type' => 'string',   'default' => '');
$config->nc->form->assignTo['assignedDate'] = array('required' => false, 'type' => 'string',   'default' => helper::today());
$config->nc->form->assignTo['uid']          = array('required' => false, 'type' => 'string',   'default' => '');
$config->nc->form->assignTo['comment']      = array('required' => false, 'type' => 'string',   'default' => '', 'control' => 'editor');
$config->nc->form->assignTo['editedBy']     = array('required' => false, 'type' => 'string',   'default' => isset($app->user->account) ? $app->user->account : '');
$config->nc->form->assignTo['editedDate']   = array('required' => false, 'type' => 'datetime', 'default' => helper::now());

$config->nc->form->resolve['status']       = array('required' => false, 'type' => 'string',   'default' => 'resolved');
$config->nc->form->resolve['resolution']   = array('required' => false, 'type' => 'string',   'default' => 'fixed');
$config->nc->form->resolve['resolvedBy']   = array('required' => false, 'type' => 'string',   'default' => isset($app->user->account) ? $app->user->account : '');
$config->nc->form->resolve['resolvedDate'] = array('required' => false, 'type' => 'date',     'default' => helper::today());
$config->nc->form->resolve['assignedTo']   = array('required' => false, 'type' => 'string',   'default' => '');
$config->nc->form->resolve['assignedDate'] = array('required' => false, 'type' => 'string',   'default' => helper::today());
$config->nc->form->resolve['uid']          = array('required' => false, 'type' => 'string',   'default' => '');
$config->nc->form->resolve['desc']         = array('required' => false, 'type' => 'string',   'default' => '', 'control' => 'editor');
$config->nc->form->resolve['editedBy']     = array('required' => false, 'type' => 'string',   'default' => isset($app->user->account) ? $app->user->account : '');
$config->nc->form->resolve['editedDate']   = array('required' => false, 'type' => 'datetime', 'default' => helper::now());

$config->nc->form->activate['status']       = array('required' => false, 'type' => 'string',   'default' => 'active');
$config->nc->form->activate['assignedTo']   = array('required' => false, 'type' => 'string',   'default' => '');
$config->nc->form->activate['assignedDate'] = array('required' => false, 'type' => 'string',   'default' => helper::today());
$config->nc->form->activate['uid']          = array('required' => false, 'type' => 'string',   'default' => '');
$config->nc->form->activate['comment']      = array('required' => false, 'type' => 'string',   'default' => '', 'control' => 'editor');
$config->nc->form->activate['activateDate'] = array('required' => false, 'type' => 'date',     'default' => helper::today());
$config->nc->form->activate['resolution']   = array('required' => false, 'type' => 'string',   'default' => '');
$config->nc->form->activate['resolvedBy']   = array('required' => false, 'type' => 'string',   'default' => '');
$config->nc->form->activate['resolvedDate'] = array('required' => false, 'type' => 'date',     'default' => null);
$config->nc->form->activate['editedBy']     = array('required' => false, 'type' => 'string',   'default' => isset($app->user->account) ? $app->user->account : '');
$config->nc->form->activate['editedDate']   = array('required' => false, 'type' => 'datetime', 'default' => helper::now());

$config->nc->form->close['status']     = array('required' => false, 'type' => 'string',   'default' => 'closed');
$config->nc->form->close['uid']        = array('required' => false, 'type' => 'string',   'default' => '');
$config->nc->form->close['comment']    = array('required' => false, 'type' => 'string',   'default' => '', 'control' => 'editor');
$config->nc->form->close['closedBy']   = array('required' => false, 'type' => 'string',   'default' => isset($app->user->account) ? $app->user->account : '');
$config->nc->form->close['closedDate'] = array('required' => false, 'type' => 'date',      'default' => helper::today());
$config->nc->form->close['editedBy']   = array('required' => false, 'type' => 'string',   'default' => isset($app->user->account) ? $app->user->account : '');
$config->nc->form->close['editedDate'] = array('required' => false, 'type' => 'datetime', 'default' => helper::now());
