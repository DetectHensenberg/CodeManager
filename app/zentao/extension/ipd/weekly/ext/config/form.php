<?php
$config->weekly->form = new stdclass();
$config->weekly->form->create = array();
$config->weekly->form->create['project']      = array('type' => 'int',    'required' => true,  'default' => 0);
$config->weekly->form->create['reportModule'] = array('type' => 'string', 'required' => false, 'default' => '');
$config->weekly->form->create['title']        = array('type' => 'string', 'required' => true,  'default' => '', 'filter' => 'trim');
$config->weekly->form->create['templateDesc'] = array('type' => 'string', 'required' => false, 'default' => '');
$config->weekly->form->create['acl']          = array('type' => 'string', 'required' => false, 'default' => 'open');
$config->weekly->form->create['readGroups']   = array('type' => 'array',  'required' => false, 'default' => '', 'filter' => 'join');
$config->weekly->form->create['readUsers']    = array('type' => 'array',  'required' => false, 'default' => '', 'filter' => 'join');
$config->weekly->form->create['groups']       = array('type' => 'array',  'required' => false, 'default' => '', 'filter' => 'join');
$config->weekly->form->create['users']        = array('type' => 'array',  'required' => false, 'default' => '', 'filter' => 'join');
$config->weekly->form->create['templateType'] = array('type' => 'string', 'required' => false, 'default' => 'projectReport');
$config->weekly->form->create['type']         = array('type' => 'string', 'required' => false, 'default' => 'text');
$config->weekly->form->create['status']       = array('type' => 'string', 'required' => false, 'default' => 'draft');

$config->weekly->form->ajaxsetbasic = array();
$config->weekly->form->ajaxsetbasic['reportModule'] = array('type' => 'string', 'required' => false, 'default' => '');
$config->weekly->form->ajaxsetbasic['templateDesc'] = array('type' => 'string', 'required' => false, 'default' => '');
$config->weekly->form->ajaxsetbasic['acl']          = array('type' => 'string', 'required' => false, 'default' => 'open');
$config->weekly->form->ajaxsetbasic['readGroups']   = array('type' => 'array',  'required' => false, 'default' => '', 'filter' => 'join');
$config->weekly->form->ajaxsetbasic['readUsers']    = array('type' => 'array',  'required' => false, 'default' => '', 'filter' => 'join');
$config->weekly->form->ajaxsetbasic['groups']       = array('type' => 'array',  'required' => false, 'default' => '', 'filter' => 'join');
$config->weekly->form->ajaxsetbasic['users']        = array('type' => 'array',  'required' => false, 'default' => '', 'filter' => 'join');

$config->weekly->form->edit = array();
$config->weekly->form->edit['title']       = array('type' => 'string', 'required' => true,  'default' => '', 'filter' => 'trim');
$config->weekly->form->edit['contentType'] = array('type' => 'string', 'required' => false, 'default' => 'doc');
$config->weekly->form->edit['type']        = array('type' => 'string', 'required' => false, 'default' => 'text');
$config->weekly->form->edit['status']      = array('type' => 'string', 'required' => false, 'default' => 'normal');
$config->weekly->form->edit['keywords']    = array('type' => 'string', 'required' => false, 'default' => '', 'filter' => 'trim');
$config->weekly->form->edit['parent']      = array('type' => 'int',    'required' => false, 'default' => 0);
$config->weekly->form->edit['content']     = array('type' => 'string', 'required' => false, 'default' => '', 'control' => 'editor', 'skipRequired' => true);
$config->weekly->form->edit['rawContent']  = array('type' => 'string', 'required' => false, 'default' => '', 'skipRequired' => true, 'specialchars' => 'no');

$config->weekly->form->addCategory = array();
$config->weekly->form->addCategory['name'] = array('type' => 'string', 'required' => true, 'default' => '', 'filter' => 'trim');
