<?php
global $lang, $app;
$config->review->dtable = new stdclass();
$config->review->dtable->defaultField = array('id', 'deliverable', 'version', 'status', 'reviewedBy', 'reviewer', 'createdBy', 'createdDate', 'deadline', 'lastReviewedDate', 'result', 'actions');

$config->review->dtable->fieldList['id']['title']    = $lang->idAB;
$config->review->dtable->fieldList['id']['type']     = 'id';
$config->review->dtable->fieldList['id']['fixed']    = 'left';
$config->review->dtable->fieldList['id']['sortType'] = true;
$config->review->dtable->fieldList['id']['required'] = true;
$config->review->dtable->fieldList['id']['group']    = 1;

$config->review->dtable->fieldList['title']['title']    = $lang->review->title;
$config->review->dtable->fieldList['title']['type']     = 'title';
$config->review->dtable->fieldList['title']['fixed']    = 'left';
$config->review->dtable->fieldList['title']['link']     = array('module' => 'review', 'method' => 'view', 'params' => "reviewID={id}");
$config->review->dtable->fieldList['title']['required'] = true;
$config->review->dtable->fieldList['title']['group']    = 1;
$config->review->dtable->fieldList['title']['data-app'] = $app->tab;
$config->review->dtable->fieldList['title']['sortType'] = true;

$config->review->dtable->fieldList['category']['name']     = 'category';
$config->review->dtable->fieldList['category']['title']    = $lang->review->object;
$config->review->dtable->fieldList['category']['width']    = '180';
$config->review->dtable->fieldList['category']['show']     = true;
$config->review->dtable->fieldList['category']['required'] = false;
$config->review->dtable->fieldList['category']['sortType'] = true;

$config->review->dtable->fieldList['version']['name']     = 'version';
$config->review->dtable->fieldList['version']['title']    = $lang->review->version;
$config->review->dtable->fieldList['version']['width']    = '180';
$config->review->dtable->fieldList['version']['show']     = true;
$config->review->dtable->fieldList['version']['required'] = false;
$config->review->dtable->fieldList['version']['sortType'] = true;

$config->review->dtable->fieldList['status']['name']      = 'status';
$config->review->dtable->fieldList['status']['title']     = $lang->review->status;
$config->review->dtable->fieldList['status']['width']     = '100';
$config->review->dtable->fieldList['status']['show']      = true;
$config->review->dtable->fieldList['status']['required']  = false;
$config->review->dtable->fieldList['status']['type']      = 'status';
$config->review->dtable->fieldList['status']['statusMap'] = $lang->review->statusList;
$config->review->dtable->fieldList['status']['sortType']  = true;

$config->review->dtable->fieldList['createdBy']['name']     = 'createdBy';
$config->review->dtable->fieldList['createdBy']['title']    = $lang->review->createdBy;
$config->review->dtable->fieldList['createdBy']['width']    = '120';
$config->review->dtable->fieldList['createdBy']['show']     = true;
$config->review->dtable->fieldList['createdBy']['type']     = 'user';
$config->review->dtable->fieldList['createdBy']['required'] = false;

$config->review->dtable->fieldList['createdDate']['name']     = 'createdDate';
$config->review->dtable->fieldList['createdDate']['title']    = $lang->review->createdDate;
$config->review->dtable->fieldList['createdDate']['width']    = '120';
$config->review->dtable->fieldList['createdDate']['show']     = true;
$config->review->dtable->fieldList['createdDate']['type']     = 'date';
$config->review->dtable->fieldList['createdDate']['required'] = false;

$config->review->dtable->fieldList['deadline']['name']     = 'deadline';
$config->review->dtable->fieldList['deadline']['title']    = $lang->review->deadline;
$config->review->dtable->fieldList['deadline']['width']    = '120';
$config->review->dtable->fieldList['deadline']['show']     = true;
$config->review->dtable->fieldList['deadline']['type']     = 'date';
$config->review->dtable->fieldList['deadline']['required'] = false;

$config->review->dtable->fieldList['lastReviewedDate']['name']     = 'lastReviewedDate';
$config->review->dtable->fieldList['lastReviewedDate']['title']    = $lang->review->lastReviewedDate;
$config->review->dtable->fieldList['lastReviewedDate']['width']    = '120';
$config->review->dtable->fieldList['lastReviewedDate']['show']     = true;
$config->review->dtable->fieldList['lastReviewedDate']['type']     = 'date';
$config->review->dtable->fieldList['lastReviewedDate']['required'] = false;

$config->review->dtable->fieldList['reviewedBy']['name']     = 'reviewedBy';
$config->review->dtable->fieldList['reviewedBy']['title']    = $lang->review->reviewedBy;
$config->review->dtable->fieldList['reviewedBy']['width']    = '150';
$config->review->dtable->fieldList['reviewedBy']['show']     = true;
$config->review->dtable->fieldList['reviewedBy']['type']     = 'text';
$config->review->dtable->fieldList['reviewedBy']['required'] = false;
$config->review->dtable->fieldList['reviewedBy']['sortType'] = true;

$config->review->dtable->fieldList['actions']['title']    = $lang->actions;
$config->review->dtable->fieldList['actions']['type']     = 'actions';
$config->review->dtable->fieldList['actions']['width']    = '140';
$config->review->dtable->fieldList['actions']['sortType'] = false;
$config->review->dtable->fieldList['actions']['fixed']    = 'right';
$config->review->dtable->fieldList['actions']['list']     = $config->review->actionList;
$config->review->dtable->fieldList['actions']['menu']     = array('submit', 'recall', 'assess', 'progress', 'report', 'edit');

$config->review->admin->dtable = new stdclass();
$config->review->admin->dtable->defaultField = array();

$config->review->admin->dtable->fieldList['id']['title']    = $lang->idAB;
$config->review->admin->dtable->fieldList['id']['type']     = 'id';
$config->review->admin->dtable->fieldList['id']['fixed']    = 'left';
$config->review->admin->dtable->fieldList['id']['sortType'] = true;
$config->review->admin->dtable->fieldList['id']['show']     = true;
$config->review->admin->dtable->fieldList['id']['group']    = 1;

$config->review->admin->dtable->fieldList['objectID']['title']    = $lang->review->approval;
$config->review->admin->dtable->fieldList['objectID']['type']     = 'title';
$config->review->admin->dtable->fieldList['objectID']['fixed']    = 'left';
$config->review->admin->dtable->fieldList['objectID']['sortType'] = true;
$config->review->admin->dtable->fieldList['objectID']['show']     = true;
$config->review->admin->dtable->fieldList['objectID']['group']    = 1;

$config->review->admin->dtable->fieldList['flow']['title']    = $lang->review->flow;
$config->review->admin->dtable->fieldList['flow']['type']     = 'category';
$config->review->admin->dtable->fieldList['flow']['sortType'] = true;
$config->review->admin->dtable->fieldList['flow']['show']     = true;
$config->review->admin->dtable->fieldList['flow']['group']    = 2;

$config->review->admin->dtable->fieldList['relatedBy']['title']    = $lang->review->relatedBy;
$config->review->admin->dtable->fieldList['relatedBy']['type']     = 'user';
$config->review->admin->dtable->fieldList['relatedBy']['sortType'] = true;
$config->review->admin->dtable->fieldList['relatedBy']['show']     = true;
$config->review->admin->dtable->fieldList['relatedBy']['group']    = 3;

$config->review->admin->dtable->fieldList['relatedDate']['title']    = $lang->review->relatedDate;
$config->review->admin->dtable->fieldList['relatedDate']['type']     = 'datetime';
$config->review->admin->dtable->fieldList['relatedDate']['sortType'] = true;
$config->review->admin->dtable->fieldList['relatedDate']['show']     = true;
$config->review->admin->dtable->fieldList['relatedDate']['group']    = 3;

$config->review->admin->dtable->fieldList['actions']['title']    = $lang->actions;
$config->review->admin->dtable->fieldList['actions']['type']     = 'actions';
$config->review->admin->dtable->fieldList['actions']['fixed']    = 'right';
$config->review->admin->dtable->fieldList['actions']['sortType'] = false;
$config->review->admin->dtable->fieldList['actions']['show']     = true;
$config->review->admin->dtable->fieldList['actions']['width']    = 100;
$config->review->admin->dtable->fieldList['actions']['list']     = $config->review->admin->actionList;
$config->review->admin->dtable->fieldList['actions']['menu']     = array('reviewcl', 'edit', 'delete');

$app->loadLang('reviewissue');
$config->review->issue = new stdclass();
$config->review->issue->dtable = new stdclass();
$config->review->issue->dtable->fieldList['id']['title'] = $lang->idAB;
$config->review->issue->dtable->fieldList['id']['type']  = 'id';
$config->review->issue->dtable->fieldList['id']['fixed'] = 'left';
$config->review->issue->dtable->fieldList['id']['group'] = 1;

$config->review->issue->dtable->fieldList['listID']['title'] = $lang->review->listCategory;
$config->review->issue->dtable->fieldList['listID']['type']  = 'text';
$config->review->issue->dtable->fieldList['listID']['name']  = 'listID';
$config->review->issue->dtable->fieldList['listID']['fixed'] = 'left';
$config->review->issue->dtable->fieldList['listID']['group'] = 2;

$config->review->issue->dtable->fieldList['title']['title'] = $lang->review->listItem;
$config->review->issue->dtable->fieldList['title']['type']  = 'title';
$config->review->issue->dtable->fieldList['title']['group'] = 3;
$config->review->issue->dtable->fieldList['title']['width'] = '220';

$config->review->issue->dtable->fieldList['opinion']['title']       = $lang->reviewissue->opinion;
$config->review->issue->dtable->fieldList['opinion']['type']        = 'text';
$config->review->issue->dtable->fieldList['opinion']['link']        = array('module' => 'reviewissue', 'method' => 'view', 'params' => "issueID={id}");
$config->review->issue->dtable->fieldList['opinion']['group']       = 4;
$config->review->issue->dtable->fieldList['opinion']['data-toggle'] = 'modal';
$config->review->issue->dtable->fieldList['opinion']['data-size']   = 'lg';

$config->review->issue->dtable->fieldList['status']['title']     = $lang->reviewissue->status;
$config->review->issue->dtable->fieldList['status']['type']      = 'status';
$config->review->issue->dtable->fieldList['status']['statusMap'] = $lang->reviewissue->statusList;
$config->review->issue->dtable->fieldList['status']['group']     = 5;

$config->review->issue->dtable->fieldList['createdBy']['title'] = $lang->reviewissue->createdBy;
$config->review->issue->dtable->fieldList['createdBy']['type']  = 'user';
$config->review->issue->dtable->fieldList['createdBy']['width'] = '80';
$config->review->issue->dtable->fieldList['createdBy']['group'] = 6;