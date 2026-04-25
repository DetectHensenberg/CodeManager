<?php
global $lang, $app;
$app->loadLang('deliverable');

$config->cm->dtable = new stdclass();
$config->cm->dtable->fieldList['id']['title']    = $lang->idAB;
$config->cm->dtable->fieldList['id']['type']     = 'id';
$config->cm->dtable->fieldList['id']['fixed']    = 'left';
$config->cm->dtable->fieldList['id']['sortType'] = true;
$config->cm->dtable->fieldList['id']['required'] = true;
$config->cm->dtable->fieldList['id']['group']    = 1;

$config->cm->dtable->fieldList['title']['title']    = $lang->cm->title;
$config->cm->dtable->fieldList['title']['type']     = 'title';
$config->cm->dtable->fieldList['title']['fixed']    = 'left';
$config->cm->dtable->fieldList['title']['link']     = array('module' => 'cm', 'method' => 'view', 'params' => "baselineID={id}");
$config->cm->dtable->fieldList['title']['required'] = true;
$config->cm->dtable->fieldList['title']['sortType'] = true;
$config->cm->dtable->fieldList['title']['group']    = 1;

$config->cm->dtable->fieldList['version']['title']    = $lang->cm->version;
$config->cm->dtable->fieldList['version']['type']     = 'status';
$config->cm->dtable->fieldList['version']['show']     = true;
$config->cm->dtable->fieldList['version']['sortType'] = true;
$config->cm->dtable->fieldList['version']['required'] = false;
$config->cm->dtable->fieldList['version']['group']    = 2;

$config->cm->dtable->fieldList['status']['title']     = $lang->cm->status;
$config->cm->dtable->fieldList['status']['type']      = 'status';
$config->cm->dtable->fieldList['status']['statusMap'] = $lang->cm->statusList;
$config->cm->dtable->fieldList['status']['show']      = true;
$config->cm->dtable->fieldList['status']['sortType']  = true;
$config->cm->dtable->fieldList['status']['required']  = false;
$config->cm->dtable->fieldList['status']['group']     = 3;

$config->cm->dtable->fieldList['category']['name']     = 'category';
$config->cm->dtable->fieldList['category']['title']    = $lang->cm->category;
$config->cm->dtable->fieldList['category']['type']     = 'text';
$config->cm->dtable->fieldList['category']['show']     = true;
$config->cm->dtable->fieldList['category']['sortType'] = true;
$config->cm->dtable->fieldList['category']['required'] = false;
$config->cm->dtable->fieldList['category']['group']    = 4;

$config->cm->dtable->fieldList['createdBy']['name']     = 'createdBy';
$config->cm->dtable->fieldList['createdBy']['title']    = $lang->cm->createdBy;
$config->cm->dtable->fieldList['createdBy']['width']    = '120';
$config->cm->dtable->fieldList['createdBy']['show']     = true;
$config->cm->dtable->fieldList['createdBy']['type']     = 'user';
$config->cm->dtable->fieldList['createdBy']['required'] = false;
$config->cm->dtable->fieldList['createdBy']['group']    = 5;

$config->cm->dtable->fieldList['createdDate']['name']     = 'createdDate';
$config->cm->dtable->fieldList['createdDate']['title']    = $lang->cm->createdDate;
$config->cm->dtable->fieldList['createdDate']['width']    = '120';
$config->cm->dtable->fieldList['createdDate']['show']     = true;
$config->cm->dtable->fieldList['createdDate']['type']     = 'date';
$config->cm->dtable->fieldList['createdDate']['required'] = false;
$config->cm->dtable->fieldList['createdDate']['group']    = 5;

$config->cm->dtable->fieldList['actions']['title']    = $lang->actions;
$config->cm->dtable->fieldList['actions']['type']     = 'actions';
$config->cm->dtable->fieldList['actions']['fixed']    = 'right';
$config->cm->dtable->fieldList['actions']['sortType'] = false;
$config->cm->dtable->fieldList['actions']['show']     = true;
$config->cm->dtable->fieldList['actions']['width']    = 100;
$config->cm->dtable->fieldList['actions']['list']     = $config->cm->actionList;
$config->cm->dtable->fieldList['actions']['menu']     = array('submit|recall', 'assess', 'progress', 'edit', 'delete');

$isEn = $app->getClientLang() == 'en';
$config->cm->deliverable = new stdclass();
$config->cm->deliverable->dtable = new stdclass();
$config->cm->deliverable->dtable->fieldList['id']['name']     = 'id';
$config->cm->deliverable->dtable->fieldList['id']['title']    = $lang->idAB;
$config->cm->deliverable->dtable->fieldList['id']['type']     = 'id';
$config->cm->deliverable->dtable->fieldList['id']['sortType'] = false;

$config->cm->deliverable->dtable->fieldList['title']['name']     = 'title';
$config->cm->deliverable->dtable->fieldList['title']['title']    = $lang->cm->deliverable->title;
$config->cm->deliverable->dtable->fieldList['title']['type']     = 'title';
$config->cm->deliverable->dtable->fieldList['title']['link']     = array('module' => 'project', 'method' => 'viewDeliverable', 'params' => 'id={id}&reviewID={review}', 'target' => '_blank');
$config->cm->deliverable->dtable->fieldList['title']['sortType'] = false;
if($isEn) $config->cm->deliverable->dtable->fieldList['title']['width'] = '200';

$config->cm->deliverable->dtable->fieldList['name']['name']     = 'name';
$config->cm->deliverable->dtable->fieldList['name']['title']    = $lang->cm->deliverable->name;
$config->cm->deliverable->dtable->fieldList['name']['type']     = 'status';
$config->cm->deliverable->dtable->fieldList['name']['hint']     = true;
$config->cm->deliverable->dtable->fieldList['name']['sortType'] = false;
if($isEn) $config->cm->deliverable->dtable->fieldList['name']['width'] = '150';

$config->cm->deliverable->dtable->fieldList['version']['name']     = 'version';
$config->cm->deliverable->dtable->fieldList['version']['title']    = $lang->deliverable->version;
$config->cm->deliverable->dtable->fieldList['version']['type']     = 'status';
$config->cm->deliverable->dtable->fieldList['version']['sortType'] = false;

$config->cm->deliverable->dtable->fieldList['createdBy']['name']     = 'createdBy';
$config->cm->deliverable->dtable->fieldList['createdBy']['title']    = $lang->deliverable->createdBy;
$config->cm->deliverable->dtable->fieldList['createdBy']['type']     = 'user';
$config->cm->deliverable->dtable->fieldList['createdBy']['sortType'] = false;

$config->cm->deliverable->dtable->fieldList['createdDate']['name']     = 'createdDate';
$config->cm->deliverable->dtable->fieldList['createdDate']['title']    = $lang->deliverable->createdDate;
$config->cm->deliverable->dtable->fieldList['createdDate']['type']     = 'date';
$config->cm->deliverable->dtable->fieldList['createdDate']['sortType'] = false;

$config->cm->diff = new stdclass();
$config->cm->diff->dtable = new stdclass();
$config->cm->diff->dtable->fieldList['name']['name']     = 'name';
$config->cm->diff->dtable->fieldList['name']['title']    = $lang->cm->deliverable->name;
$config->cm->diff->dtable->fieldList['name']['type']     = 'status';
$config->cm->diff->dtable->fieldList['name']['sortType'] = false;
$config->cm->diff->dtable->fieldList['name']['group']    = 1;

$config->cm->diff->dtable->fieldList['title']['name']     = 'title';
$config->cm->diff->dtable->fieldList['title']['title']    = $lang->cm->deliverable->title;
$config->cm->diff->dtable->fieldList['title']['type']     = 'status';
$config->cm->diff->dtable->fieldList['title']['sortType'] = false;
$config->cm->diff->dtable->fieldList['title']['group']    = 2;

$config->cm->diff->dtable->fieldList['baseline1']['name']     = 'baseline1';
$config->cm->diff->dtable->fieldList['baseline1']['title']    = '';
$config->cm->diff->dtable->fieldList['baseline1']['type']     = 'status';
$config->cm->diff->dtable->fieldList['baseline1']['sortType'] = false;
$config->cm->diff->dtable->fieldList['baseline1']['group']    = 3;

$config->cm->diff->dtable->fieldList['baseline2']['name']     = 'baseline2';
$config->cm->diff->dtable->fieldList['baseline2']['title']    = '';
$config->cm->diff->dtable->fieldList['baseline2']['type']     = 'status';
$config->cm->diff->dtable->fieldList['baseline2']['sortType'] = false;
$config->cm->diff->dtable->fieldList['baseline2']['group']    = 4;
