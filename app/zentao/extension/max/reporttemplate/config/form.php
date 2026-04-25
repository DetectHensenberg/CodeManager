<?php
$config->reporttemplate->form = new stdclass();

$config->reporttemplate->form->addCategory['name'] = array('type' => 'string', 'required' => true,  'default' => '', 'filter' => 'trim');
$config->reporttemplate->form->addCategory['root'] = array('type' => 'int',    'required' => true,  'default' => 0);

$config->reporttemplate->form->editCategory['name'] = array('type' => 'string', 'required' => true,  'default' => '', 'filter' => 'trim');
$config->reporttemplate->form->editCategory['root'] = array('type' => 'int',    'required' => true,  'default' => 0);

$config->reporttemplate->form->create = array();
$config->reporttemplate->form->create['lib']          = array('type' => 'int',    'required' => true,  'default' => 0);
$config->reporttemplate->form->create['module']       = array('type' => 'int',    'required' => true,  'default' => 0);
$config->reporttemplate->form->create['objects']      = array('type' => 'array',  'required' => false, 'default' => '', 'filter' => 'join');
$config->reporttemplate->form->create['title']        = array('type' => 'string', 'required' => true,  'default' => '', 'filter' => 'trim');
$config->reporttemplate->form->create['templateDesc'] = array('type' => 'string', 'required' => false, 'default' => '');
$config->reporttemplate->form->create['acl']          = array('type' => 'string', 'required' => false, 'default' => 'open');
$config->reporttemplate->form->create['groups']       = array('type' => 'array',  'required' => false, 'default' => '', 'filter' => 'join');
$config->reporttemplate->form->create['users']        = array('type' => 'array',  'required' => false, 'default' => '', 'filter' => 'join');
$config->reporttemplate->form->create['contentType']  = array('type' => 'string', 'required' => false, 'default' => 'doc');
$config->reporttemplate->form->create['type']         = array('type' => 'string', 'required' => false, 'default' => 'text');
$config->reporttemplate->form->create['status']       = array('type' => 'string', 'required' => false, 'default' => 'draft');
$config->reporttemplate->form->create['parent']       = array('type' => 'int',    'required' => false, 'default' => 0);
$config->reporttemplate->form->create['content']      = array('type' => 'string', 'required' => false, 'default' => '', 'control' => 'editor', 'skipRequired' => true);
$config->reporttemplate->form->create['rawContent']   = array('type' => 'string', 'required' => false, 'default' => '', 'skipRequired' => true, 'specialchars' => 'no');
$config->reporttemplate->form->create['templateType'] = array('type' => 'string', 'required' => false, 'default' => 'reportTemplate');

$config->reporttemplate->form->ajaxSetBasic = array();
$config->reporttemplate->form->ajaxSetBasic['lib']          = array('type' => 'int',    'required' => true,  'default' => 0);
$config->reporttemplate->form->ajaxSetBasic['module']       = array('type' => 'int',    'required' => true,  'default' => 0);
$config->reporttemplate->form->ajaxSetBasic['objects']      = array('type' => 'array',  'required' => false, 'default' => '', 'filter' => 'join');
$config->reporttemplate->form->ajaxSetBasic['templateDesc'] = array('type' => 'string', 'required' => false, 'default' => '');
$config->reporttemplate->form->ajaxSetBasic['acl']          = array('type' => 'string', 'required' => false, 'default' => 'open');
$config->reporttemplate->form->ajaxSetBasic['groups']       = array('type' => 'array',  'required' => false, 'default' => '', 'filter' => 'join');
$config->reporttemplate->form->ajaxSetBasic['users']        = array('type' => 'array',  'required' => false, 'default' => '', 'filter' => 'join');

$config->reporttemplate->form->edit = array();
$config->reporttemplate->form->edit['title']       = array('type' => 'string', 'required' => true,  'default' => '', 'filter' => 'trim');
$config->reporttemplate->form->edit['contentType'] = array('type' => 'string', 'required' => false, 'default' => 'doc');
$config->reporttemplate->form->edit['type']        = array('type' => 'string', 'required' => false, 'default' => 'text');
$config->reporttemplate->form->edit['status']      = array('type' => 'string', 'required' => false, 'default' => 'normal');
$config->reporttemplate->form->edit['keywords']    = array('type' => 'string', 'required' => false, 'default' => '', 'filter' => 'trim');
$config->reporttemplate->form->edit['parent']      = array('type' => 'int',    'required' => false, 'default' => 0);
$config->reporttemplate->form->edit['content']     = array('type' => 'string', 'required' => false, 'default' => '', 'control' => 'editor', 'skipRequired' => true);
$config->reporttemplate->form->edit['rawContent']  = array('type' => 'string', 'required' => false, 'default' => '', 'skipRequired' => true, 'specialchars' => 'no');