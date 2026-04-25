<?php
global $app, $lang;

$config->ai->form = new stdclass();

$config->ai->form->createPrompt         = array();
$config->ai->form->createPrompt['name'] = array('type' => 'string', 'filter' => 'trim');
$config->ai->form->createPrompt['desc'] = array('type' => 'string', 'filter' => 'trim');

$config->ai->form->knowledgeLib = new stdclass();

$config->ai->form->knowledgeLib->create                = array();
$config->ai->form->knowledgeLib->create['name']        = array('required' => true, 'type' => 'string', 'label' => $lang->ai->knowledgeLibs->knowledgeLibName);
$config->ai->form->knowledgeLib->create['desc']        = array('required' => false, 'type' => 'string', 'default' => '');
$config->ai->form->knowledgeLib->create['acl']         = array('required' => false, 'type' => 'string', 'default' => 'open');
$config->ai->form->knowledgeLib->create['groups']      = array('type' => 'array', 'required' => false, 'default' => '', 'filter' => 'join');
$config->ai->form->knowledgeLib->create['users']       = array('type' => 'array', 'required' => false, 'default' => '', 'filter' => 'join');
$config->ai->form->knowledgeLib->create['createdBy']   = array('required' => false, 'type' => 'string', 'default' => isset($app->user->account) ? $app->user->account : '');
$config->ai->form->knowledgeLib->create['createdDate'] = array('required' => false, 'type' => 'date',   'default' => helper::now());

$config->ai->form->knowledgeLib->edit                = array();
$config->ai->form->knowledgeLib->edit['name']        = array('required' => true, 'type' => 'string', 'label' => $lang->ai->knowledgeLibs->knowledgeLibName);
$config->ai->form->knowledgeLib->edit['desc']        = array('required' => false, 'type' => 'string', 'default' => '');
$config->ai->form->knowledgeLib->edit['acl']         = array('required' => false, 'type' => 'string', 'default' => 'open');
$config->ai->form->knowledgeLib->edit['groups']      = array('type' => 'array', 'required' => false, 'default' => '', 'filter' => 'join');
$config->ai->form->knowledgeLib->edit['users']       = array('type' => 'array', 'required' => false, 'default' => '', 'filter' => 'join');
$config->ai->form->knowledgeLib->edit['editedBy']    = array('required' => false, 'type' => 'string', 'default' => isset($app->user->account) ? $app->user->account : '');
$config->ai->form->knowledgeLib->edit['editedDate']  = array('required' => false, 'type' => 'date',   'default' => helper::now());

$config->ai->form->knowledgeLib->importFromDoc = array();
$config->ai->form->knowledgeLib->importFromDoc['importID']    = array('required' => true, 'type' => 'int', 'label' => $lang->ai->knowledgeLibs->selectedDocLibrary);
$config->ai->form->knowledgeLib->importFromDoc['name']        = array('required' => false, 'type' => 'string');
$config->ai->form->knowledgeLib->importFromDoc['createdBy']   = array('required' => false, 'type' => 'string', 'default' => isset($app->user->account) ? $app->user->account : '');
$config->ai->form->knowledgeLib->importFromDoc['createdDate'] = array('required' => false, 'type' => 'date',   'default' => helper::now());

$config->ai->form->knowledgeLib->importFromAsset = array();
$config->ai->form->knowledgeLib->importFromAsset['assetType']   = array('required' => true, 'type' => 'string');
$config->ai->form->knowledgeLib->importFromAsset['importID']    = array('required' => true, 'type' => 'int');
$config->ai->form->knowledgeLib->importFromAsset['createdBy']   = array('required' => false, 'type' => 'string', 'default' => isset($app->user->account) ? $app->user->account : '');
$config->ai->form->knowledgeLib->importFromAsset['createdDate'] = array('required' => false, 'type' => 'date',   'default' => helper::now());

$config->ai->form->knowledgeLib->search = array();
$config->ai->form->knowledgeLib->search['content'] = array('type' => 'string', 'filter' => 'trim');

$config->ai->form->knowledge = new stdclass();
$config->ai->form->knowledge->createText                = array();
$config->ai->form->knowledge->createText['title']       = array('required' => false, 'type' => 'string', 'filter' => 'trim');
$config->ai->form->knowledge->createText['content']     = array('required' => false, 'type' => 'string', 'default' => '', 'specialchars' => 'no');
$config->ai->form->knowledge->createText['type']        = array('required' => false, 'type' => 'string', 'default' => 'text');
$config->ai->form->knowledge->createText['contentType'] = array('required' => false, 'type' => 'string', 'default' => 'markdown');
$config->ai->form->knowledge->createText['createdBy']   = array('required' => false, 'type' => 'string', 'default' => isset($app->user->account) ? $app->user->account : '');
$config->ai->form->knowledge->createText['createdDate'] = array('required' => false, 'type' => 'datetime', 'default' => helper::now());

$config->ai->form->knowledge->editText                = array();
$config->ai->form->knowledge->editText['title']       = array('required' => false, 'type' => 'string', 'filter' => 'trim');
$config->ai->form->knowledge->editText['content']     = array('required' => false, 'type' => 'string', 'default' => '', 'specialchars' => 'no');
$config->ai->form->knowledge->editText['type']        = array('required' => false, 'type' => 'string', 'default' => 'text');
$config->ai->form->knowledge->editText['contentType'] = array('required' => false, 'type' => 'string', 'default' => 'markdown');

$config->ai->form->knowledge->importZentao['type']   = array('type' => 'string', 'filter' => 'trim');
$config->ai->form->knowledge->importZentao['data']   = array('type' => 'string');
$config->ai->form->knowledge->importZentao['idList'] = array('type' => 'string');
