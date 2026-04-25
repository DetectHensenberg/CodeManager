<?php
global $lang;

$config->reviewissue->form = new stdclass();

$config->reviewissue->form->create = array();
$config->reviewissue->form->create['review']     = array('required' => false, 'label' => $lang->reviewissue->review,     'type' => 'int',    'default' => 0);
$config->reviewissue->form->create['category']   = array('required' => false, 'label' => $lang->reviewissue->listType,   'type' => 'int',    'default' => 0);
$config->reviewissue->form->create['listID']     = array('required' => true,  'label' => $lang->reviewissue->checklist,  'type' => 'int',    'default' => 0);
$config->reviewissue->form->create['assignedTo'] = array('required' => false, 'label' => $lang->reviewissue->assignedTo, 'type' => 'string', 'default' => '');
$config->reviewissue->form->create['opinion']    = array('required' => false, 'label' => $lang->reviewissue->opinion,    'type' => 'string', 'default' => '');
$config->reviewissue->form->create['status']     = array('required' => false, 'label' => $lang->reviewissue->status,     'type' => 'string', 'default' => 'active');

$config->reviewissue->form->edit = array();
$config->reviewissue->form->edit['title']      = array('required' => true,  'label' => $lang->reviewissue->title,      'type' => 'string', 'default' => '');
$config->reviewissue->form->edit['assignedTo'] = array('required' => false, 'label' => $lang->reviewissue->assignedTo, 'type' => 'string', 'default' => '');
$config->reviewissue->form->edit['opinion']    = array('required' => false, 'label' => $lang->reviewissue->opinion,    'type' => 'string', 'default' => '');

$config->reviewissue->form->resolved['resolution'] = array('required' => true, 'label' => $lang->reviewissue->resolution, 'type' => 'string', 'default' => '');

$config->reviewissue->form->assignTo['assignedTo'] = array('required' => false, 'label' => $lang->reviewissue->assignedTo, 'type' => 'string', 'default' => '');
$config->reviewissue->form->assignTo['comment']    = array('required' => false, 'label' => $lang->comment,                 'type' => 'string', 'default' => '', 'control' => 'editor');
