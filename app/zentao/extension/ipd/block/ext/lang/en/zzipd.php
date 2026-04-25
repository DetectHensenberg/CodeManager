<?php
$lang->block->visionTitle            = 'The user interface of ZenTao is divided into [R&D interface] and [Operations Management Interface].';
$lang->block->visions = array();
$lang->block->visions['rnd']         = new stdclass();
$lang->block->visions['rnd']->key    = 'rnd';
$lang->block->visions['rnd']->title  = 'IPD Interface';
$lang->block->visions['rnd']->text   = "Integrates Programs, {$lang->productCommon}, {$lang->projectCommon}, Executions,  test, etc. into one platform, providing  a lifecycle {$lang->projectCommon} management solution.";
$lang->block->visions['or']          = new stdclass();
$lang->block->visions['or']->key     = 'or';
$lang->block->visions['or']->title   = 'OR & MM Interface';
$lang->block->visions['or']->text    = "Doing the right thing, integrates demand pool, demand, {$lang->productCommon}, roadmap planning, project initiation, and market management functions.";
$lang->block->visions['lite']        = new stdclass();
$lang->block->visions['lite']->key   = 'lite';
$lang->block->visions['lite']->title = 'Operations Management Interface';
$lang->block->visions['lite']->text  = "Tailored for non-R&D teams, featuring an intuitive and visual Kanban model for {$lang->projectCommon} management.";
