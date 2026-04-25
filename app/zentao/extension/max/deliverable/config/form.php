<?php
$config->deliverable->form = new stdclass();
$config->deliverable->form->create = array();
$config->deliverable->form->create['name']      = array('type' => 'string', 'required' => true, 'filter' => 'trim');
$config->deliverable->form->create['module']    = array('type' => 'int', 'required' => false);
$config->deliverable->form->create['activity']  = array('type' => 'int', 'required' => false);
$config->deliverable->form->create['trimmable'] = array('type' => 'int', 'required' => false);
$config->deliverable->form->create['trimRule']  = array('type' => 'string', 'required' => false);
$config->deliverable->form->create['desc']      = array('type' => 'string', 'required' => false, 'control' => 'editor');

$config->deliverable->form->edit = array();
$config->deliverable->form->edit['name']      = array('type' => 'string', 'required' => true, 'filter' => 'trim');
$config->deliverable->form->edit['module']    = array('type' => 'int', 'required' => true);
$config->deliverable->form->edit['activity']  = array('type' => 'int', 'required' => true);
$config->deliverable->form->edit['trimmable'] = array('type' => 'int', 'required' => false);
$config->deliverable->form->edit['trimRule']  = array('type' => 'string', 'required' => false);
$config->deliverable->form->edit['desc']      = array('type' => 'string', 'required' => false, 'control' => 'editor');
