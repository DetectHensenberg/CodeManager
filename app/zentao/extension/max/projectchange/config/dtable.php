<?php
global $lang, $app;
$app->loadLang('deliverable');

$config->projectchange->dtable = new stdclass();
$config->projectchange->dtable->fieldList['id']['title'] = $lang->idAB;
$config->projectchange->dtable->fieldList['id']['name']  = 'id';
$config->projectchange->dtable->fieldList['id']['type']  = 'id';

$config->projectchange->dtable->fieldList['name']['title'] = $lang->projectchange->name;
$config->projectchange->dtable->fieldList['name']['name']  = 'name';
$config->projectchange->dtable->fieldList['name']['type']  = 'title';
$config->projectchange->dtable->fieldList['name']['link']  = array('module' => 'projectchange', 'method' => 'view', 'params' => 'id={id}');

$config->projectchange->dtable->fieldList['urgency']['title'] = $lang->projectchange->urgency;
$config->projectchange->dtable->fieldList['urgency']['name']  = 'urgency';
$config->projectchange->dtable->fieldList['urgency']['type']  = 'category';
$config->projectchange->dtable->fieldList['urgency']['map']   = $lang->projectchange->urgencyList;

$config->projectchange->dtable->fieldList['type']['title'] = $lang->projectchange->type;
$config->projectchange->dtable->fieldList['type']['name']  = 'type';
$config->projectchange->dtable->fieldList['type']['type']  = 'category';
$config->projectchange->dtable->fieldList['type']['map']   = $lang->projectchange->typeList;

$config->projectchange->dtable->fieldList['deliverable']['title']   = $lang->projectchange->deliverable;
$config->projectchange->dtable->fieldList['deliverable']['name']    = 'deliverable';
$config->projectchange->dtable->fieldList['deliverable']['type']    = 'text';
$config->projectchange->dtable->fieldList['deliverable']['control'] = 'multiple';

$config->projectchange->dtable->fieldList['owner']['title']   = $lang->projectchange->owner;
$config->projectchange->dtable->fieldList['owner']['name']    = 'owner';
$config->projectchange->dtable->fieldList['owner']['type']    = 'user';

$config->projectchange->dtable->fieldList['status']['title'] = $lang->projectchange->status;
$config->projectchange->dtable->fieldList['status']['name']  = 'status';
$config->projectchange->dtable->fieldList['status']['type']  = 'status';
$config->projectchange->dtable->fieldList['status']['statusMap'] = $lang->projectchange->statusList;

$config->projectchange->dtable->fieldList['deadline']['title'] = $lang->projectchange->deadline;
$config->projectchange->dtable->fieldList['deadline']['name']  = 'deadline';
$config->projectchange->dtable->fieldList['deadline']['type']  = 'date';

$config->projectchange->dtable->fieldList['createdBy']['title'] = $lang->projectchange->createdBy;
$config->projectchange->dtable->fieldList['createdBy']['name']  = 'createdBy';
$config->projectchange->dtable->fieldList['createdBy']['type']  = 'user';

$config->projectchange->dtable->fieldList['createdDate']['title'] = $lang->projectchange->createdDate;
$config->projectchange->dtable->fieldList['createdDate']['name']  = 'createdDate';
$config->projectchange->dtable->fieldList['createdDate']['type']  = 'date';

$config->projectchange->dtable->fieldList['actions']['title']    = $lang->actions;
$config->projectchange->dtable->fieldList['actions']['type']     = 'actions';
$config->projectchange->dtable->fieldList['actions']['width']    = '140';
$config->projectchange->dtable->fieldList['actions']['list']     = $config->projectchange->actionList;
$config->projectchange->dtable->fieldList['actions']['menu']     = array('submit|recall', 'assess', 'progress', 'edit', 'delete');

$config->projectchange->deliverable = new stdclass();
$config->projectchange->deliverable->dtable = new stdclass();
$config->projectchange->deliverable->dtable->fieldList['name']['name']     = 'name';
$config->projectchange->deliverable->dtable->fieldList['name']['title']    = $lang->deliverable->title;
$config->projectchange->deliverable->dtable->fieldList['name']['type']     = 'category';
$config->projectchange->deliverable->dtable->fieldList['name']['hint']     = true;
$config->projectchange->deliverable->dtable->fieldList['name']['sortType'] = false;
$config->projectchange->deliverable->dtable->fieldList['name']['group']    = 1;

$config->projectchange->deliverable->dtable->fieldList['version']['name']     = 'version';
$config->projectchange->deliverable->dtable->fieldList['version']['title']    = $lang->deliverable->common . $lang->deliverable->version;
$config->projectchange->deliverable->dtable->fieldList['version']['type']     = 'category';
$config->projectchange->deliverable->dtable->fieldList['version']['sortType'] = false;
$config->projectchange->deliverable->dtable->fieldList['version']['group']    = 2;

$config->projectchange->deliverable->dtable->fieldList['baseline']['name']     = 'baseline';
$config->projectchange->deliverable->dtable->fieldList['baseline']['title']    = $lang->deliverable->baseline;
$config->projectchange->deliverable->dtable->fieldList['baseline']['type']     = 'category';
$config->projectchange->deliverable->dtable->fieldList['baseline']['sortType'] = false;
$config->projectchange->deliverable->dtable->fieldList['baseline']['group']    = 3;

$config->projectchange->deliverable->dtable->fieldList['baselineVersion']['name']     = 'baselineVersion';
$config->projectchange->deliverable->dtable->fieldList['baselineVersion']['title']    = $lang->deliverable->baselineVersion;
$config->projectchange->deliverable->dtable->fieldList['baselineVersion']['type']     = 'category';
$config->projectchange->deliverable->dtable->fieldList['baselineVersion']['sortType'] = false;
$config->projectchange->deliverable->dtable->fieldList['baselineVersion']['group']    = 4;
