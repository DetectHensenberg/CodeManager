<?php
global $app;
$isEn = $app->getClientLang() == 'en';

$config->project->editor->copyproject = array('id' => 'desc', 'tools' => 'simpleTools');

$config->project->multiple['project'] .= ',other,auditplan,weekly,deliverable,';

$config->project->form->create['isTpl'] = array('type' => 'string', 'required' => false, 'default' => '0');

$config->project->form->editTemplate = $config->project->form->edit;
unset($config->project->form->editTemplate['products']);
unset($config->project->form->editTemplate['branch']);
unset($config->project->form->editTemplate['plans']);
unset($config->project->form->editTemplate['begin']);
unset($config->project->form->editTemplate['end']);
unset($config->project->form->editTemplate['days']);

$config->project->form->templatePriv['acl']       = array('type' => 'string', 'required' => false, 'default' => '');
$config->project->form->templatePriv['whitelist'] = array('type' => 'array',  'required' => false, 'default' => array(''), 'filter' => 'join');

if(helper::hasFeature('deliverable'))
{
    $config->project->form->deliverable['deliverable'] = array('type' => 'array', 'required' => false, 'default' => array());
    $config->project->form->close['deliverable']       = array('type' => 'array', 'required' => false, 'default' => array());
}

$config->project->actionList['publishTemplate']['icon']      = 'publish';
$config->project->actionList['publishTemplate']['hint']      = $lang->project->publishTemplate;
$config->project->actionList['publishTemplate']['text']      = $lang->project->publishTemplate;
$config->project->actionList['publishTemplate']['url']       = array('module' => 'project', 'method' => 'publishTemplate', 'params' => 'id={id}');
$config->project->actionList['publishTemplate']['className'] = 'ajax-submit';

$config->project->actionList['disableTemplate']['icon']         = 'pause';
$config->project->actionList['disableTemplate']['hint']         = $lang->project->disableTemplate;
$config->project->actionList['disableTemplate']['text']         = $lang->project->disableTemplate;
$config->project->actionList['disableTemplate']['url']          = array('module' => 'project', 'method' => 'disableTemplate', 'params' => 'id={id}');
$config->project->actionList['disableTemplate']['className']    = 'ajax-submit';
$config->project->actionList['disableTemplate']['data-confirm'] = $lang->project->confirmDisableTemplate;

$config->project->actionList['editTemplate']['url']         = helper::createLink('project', 'editTemplate', "id={id}");
$config->project->actionList['editTemplate']['hint']        = $lang->project->editTemplate;
$config->project->actionList['editTemplate']['icon']        = 'edit';
$config->project->actionList['editTemplate']['data-toggle'] = 'modal';
$config->project->actionList['editTemplate']['data-size']   = 'lg';

$config->project->actionList['deleteTemplate']['url']          = helper::createLink('project', 'deleteTemplate', "id={id}");
$config->project->actionList['deleteTemplate']['data-confirm'] = $lang->project->confirmDeleteTemplate;
$config->project->actionList['deleteTemplate']['hint']         = $lang->project->deleteTemplate;
$config->project->actionList['deleteTemplate']['className']    = 'ajax-submit';
$config->project->actionList['deleteTemplate']['icon']         = 'trash';

$config->project->actionList['templatePriv']['icon']        = 'private';
$config->project->actionList['templatePriv']['hint']        = $lang->project->templatePriv;
$config->project->actionList['templatePriv']['url']         = helper::createLink('project', 'templatePriv', 'projectID={id}');
$config->project->actionList['templatePriv']['data-toggle'] = 'modal';

$config->project->template = new stdclass();
$config->project->template->dtable = new stdclass();
$config->project->template->dtable->fieldList['id']['title']    = $lang->idAB;
$config->project->template->dtable->fieldList['id']['name']     = 'id';
$config->project->template->dtable->fieldList['id']['type']     = 'checkID';
$config->project->template->dtable->fieldList['id']['group']    = 1;
$config->project->template->dtable->fieldList['id']['required'] = true;

$config->project->template->dtable->fieldList['name']['title']    = $lang->project->templateName;
$config->project->template->dtable->fieldList['name']['name']     = 'name';
$config->project->template->dtable->fieldList['name']['type']     = 'title';
$config->project->template->dtable->fieldList['name']['link']     = array('module' => 'project', 'method' => 'execution', 'params' => 'status=undone&projectID={id}');
$config->project->template->dtable->fieldList['name']['group']    = 1;
$config->project->template->dtable->fieldList['name']['required'] = true;

$config->project->template->dtable->fieldList['workflowGroup']['title']    = $lang->project->workflowGroup;
$config->project->template->dtable->fieldList['workflowGroup']['name']     = 'workflowGroup';
$config->project->template->dtable->fieldList['workflowGroup']['type']     = 'category';
$config->project->template->dtable->fieldList['workflowGroup']['show']     = true;
$config->project->template->dtable->fieldList['workflowGroup']['sortType'] = true;
$config->project->template->dtable->fieldList['workflowGroup']['group']    = 2;

$config->project->template->dtable->fieldList['desc']['title'] = $lang->project->templateDesc;
$config->project->template->dtable->fieldList['desc']['name']  = 'desc';
$config->project->template->dtable->fieldList['desc']['type']  = 'text';
$config->project->template->dtable->fieldList['desc']['show']  = true;
$config->project->template->dtable->fieldList['desc']['group'] = 3;

$config->project->template->dtable->fieldList['status']['title']     = $lang->project->status;
$config->project->template->dtable->fieldList['status']['name']      = 'status';
$config->project->template->dtable->fieldList['status']['type']      = 'status';
$config->project->template->dtable->fieldList['status']['statusMap'] = $lang->project->statusList;
$config->project->template->dtable->fieldList['status']['width']     = '80';
$config->project->template->dtable->fieldList['status']['show']      = true;
$config->project->template->dtable->fieldList['status']['group']     = 4;

$config->project->template->dtable->fieldList['openedBy']['title'] = $lang->project->openedBy;
$config->project->template->dtable->fieldList['openedBy']['name']  = 'openedBy';
$config->project->template->dtable->fieldList['openedBy']['type']  = 'user';
$config->project->template->dtable->fieldList['openedBy']['show']  = true;
$config->project->template->dtable->fieldList['openedBy']['group'] = 5;

$config->project->template->dtable->fieldList['openedDate']['title'] = $lang->project->openedDate;
$config->project->template->dtable->fieldList['openedDate']['name']  = 'openedDate';
$config->project->template->dtable->fieldList['openedDate']['type']  = 'date';
$config->project->template->dtable->fieldList['openedDate']['show']  = true;
$config->project->template->dtable->fieldList['openedDate']['group'] = 6;

$config->project->template->dtable->fieldList['actions']['name']  = 'actions';
$config->project->template->dtable->fieldList['actions']['title'] = $lang->actions;
$config->project->template->dtable->fieldList['actions']['type']  = 'actions';
$config->project->template->dtable->fieldList['actions']['width'] = '80';
$config->project->template->dtable->fieldList['actions']['list']  = $config->project->actionList;
$config->project->template->dtable->fieldList['actions']['menu']  = array('publishTemplate|disableTemplate', 'editTemplate', 'templatePriv', 'deleteTemplate');
$config->project->template->dtable->fieldList['actions']['show']  = true;

global $app;
$app->loadLang('deliverable');
$app->loadLang('review');

$config->project->actionList['submitDeliverable']['icon'] = 'sub-review';
$config->project->actionList['submitDeliverable']['hint'] = $lang->project->submitDeliverable;
$config->project->actionList['submitDeliverable']['text'] = $lang->project->submitDeliverable;
$config->project->actionList['submitDeliverable']['url']  = array('module' => 'review', 'method' => 'create', 'params' => 'projectID={project}&deliverableID={id}&reviewID={review}&type=deliverable&objectID=0&from=deliverable');

$config->project->actionList['submitReview']['icon']        = 'sub-review';
$config->project->actionList['submitReview']['hint']        = $lang->project->submitDeliverable;
$config->project->actionList['submitReview']['text']        = $lang->project->submitDeliverable;
$config->project->actionList['submitReview']['url']         = array('module' => 'review', 'method' => 'submit', 'params' => 'reviewID={review}&from=deliverable');
$config->project->actionList['submitReview']['data-toggle'] = 'modal';

$config->project->actionList['recallDeliverable']['icon']         = 'back';
$config->project->actionList['recallDeliverable']['hint']         = $lang->project->recallDeliverable;
$config->project->actionList['recallDeliverable']['text']         = $lang->project->recallDeliverable;
$config->project->actionList['recallDeliverable']['url']          = array('module' => 'review', 'method' => 'recall', 'params' => 'reviewID={review}');
$config->project->actionList['recallDeliverable']['className']    = 'ajax-submit';
$config->project->actionList['recallDeliverable']['data-confirm'] = $lang->review->confirmRecall;

$config->project->actionList['reviewDeliverable']['icon']        = 'glasses';
$config->project->actionList['reviewDeliverable']['hint']        = $lang->project->reviewDeliverable;
$config->project->actionList['reviewDeliverable']['text']        = $lang->project->reviewDeliverable;
$config->project->actionList['reviewDeliverable']['url']         = array('module' => 'review', 'method' => 'assess', 'params' => 'reviewID={review}');

$config->project->actionList['editDeliverable']['icon']        = 'edit';
$config->project->actionList['editDeliverable']['hint']        = $lang->project->editDeliverable;
$config->project->actionList['editDeliverable']['text']        = $lang->project->editDeliverable;
$config->project->actionList['editDeliverable']['url']         = array('module' => 'project', 'method' => 'deliverable', 'params' => 'id={id}');
$config->project->actionList['editDeliverable']['data-toggle'] = 'modal';

$config->project->actionList['deleteDeliverable']['icon']         = 'trash';
$config->project->actionList['deleteDeliverable']['hint']         = $lang->project->deleteDeliverable;
$config->project->actionList['deleteDeliverable']['text']         = $lang->project->deleteDeliverable;
$config->project->actionList['deleteDeliverable']['url']          = array('module' => 'project', 'method' => 'deleteDeliverable', 'params' => 'id={id}');
$config->project->actionList['deleteDeliverable']['className']    = 'ajax-submit';
$config->project->actionList['deleteDeliverable']['data-confirm'] = $lang->project->confirmDeleteDeliverable;

$config->project->deliverable = new stdclass();
$config->project->deliverable->dtable = new stdclass();
$config->project->deliverable->dtable->fieldList['id']['title']    = $lang->idAB;
$config->project->deliverable->dtable->fieldList['id']['name']     = 'id';
$config->project->deliverable->dtable->fieldList['id']['type']     = 'checkID';
$config->project->deliverable->dtable->fieldList['id']['sortType'] = true;
$config->project->deliverable->dtable->fieldList['id']['checkbox'] = true;
$config->project->deliverable->dtable->fieldList['id']['width']    = '80';
$config->project->deliverable->dtable->fieldList['id']['required'] = true;

$config->project->deliverable->dtable->fieldList['title']['title']    = $lang->deliverable->title;
$config->project->deliverable->dtable->fieldList['title']['name']     = 'title';
$config->project->deliverable->dtable->fieldList['title']['type']     = 'title';
$config->project->deliverable->dtable->fieldList['title']['width']    = '276';
$config->project->deliverable->dtable->fieldList['title']['fixed']    = 'left';
$config->project->deliverable->dtable->fieldList['title']['link']     = array('module' => 'project', 'method' => 'viewDeliverable', 'params' => 'id={id}');
$config->project->deliverable->dtable->fieldList['title']['sortType'] = true;

$config->project->deliverable->dtable->fieldList['name']['title']    = $lang->deliverable->name;
$config->project->deliverable->dtable->fieldList['name']['name']     = 'name';
$config->project->deliverable->dtable->fieldList['name']['type']     = 'text';
$config->project->deliverable->dtable->fieldList['name']['width']    = '136';
$config->project->deliverable->dtable->fieldList['name']['fixed']    = 'left';
$config->project->deliverable->dtable->fieldList['name']['show']     = true;
$config->project->deliverable->dtable->fieldList['name']['sortType'] = true;
if($isEn) $config->project->deliverable->dtable->fieldList['name']['width'] = '160';

$config->project->deliverable->dtable->fieldList['version']['title']    = $lang->deliverable->version;
$config->project->deliverable->dtable->fieldList['version']['name']     = 'version';
$config->project->deliverable->dtable->fieldList['version']['type']     = 'text';
$config->project->deliverable->dtable->fieldList['version']['sortType'] = true;
$config->project->deliverable->dtable->fieldList['version']['show']     = true;

$config->project->deliverable->dtable->fieldList['versionStatus']['title']    = $lang->deliverable->versionStatus;
$config->project->deliverable->dtable->fieldList['versionStatus']['name']     = 'versionStatus';
$config->project->deliverable->dtable->fieldList['versionStatus']['type']     = 'text';
$config->project->deliverable->dtable->fieldList['versionStatus']['map']      = $lang->deliverable->versionStatusList;
$config->project->deliverable->dtable->fieldList['versionStatus']['sortType'] = false;
$config->project->deliverable->dtable->fieldList['versionStatus']['show']     = true;

$config->project->deliverable->dtable->fieldList['isBaseline']['title']    = $lang->deliverable->isBaseline;
$config->project->deliverable->dtable->fieldList['isBaseline']['name']     = 'isBaseline';
$config->project->deliverable->dtable->fieldList['isBaseline']['type']     = 'category';
$config->project->deliverable->dtable->fieldList['isBaseline']['sortType'] = true;
$config->project->deliverable->dtable->fieldList['isBaseline']['map']      = $lang->deliverable->baselineList;
$config->project->deliverable->dtable->fieldList['isBaseline']['width']    = '90';
$config->project->deliverable->dtable->fieldList['isBaseline']['show']     = true;

$config->project->deliverable->dtable->fieldList['hasApproval']['title']    = $lang->project->hasApproval;
$config->project->deliverable->dtable->fieldList['hasApproval']['name']     = 'hasApproval';
$config->project->deliverable->dtable->fieldList['hasApproval']['type']     = 'category';
$config->project->deliverable->dtable->fieldList['hasApproval']['sortType'] = true;
$config->project->deliverable->dtable->fieldList['hasApproval']['map']      = $lang->project->hasApprovalList;
$config->project->deliverable->dtable->fieldList['hasApproval']['width']    = '120';
$config->project->deliverable->dtable->fieldList['hasApproval']['show']     = true;

$config->project->deliverable->dtable->fieldList['status']['title']     = $lang->deliverable->reviewStatus;
$config->project->deliverable->dtable->fieldList['status']['name']      = 'status';
$config->project->deliverable->dtable->fieldList['status']['type']      = 'status';
$config->project->deliverable->dtable->fieldList['status']['width']     = '120';
$config->project->deliverable->dtable->fieldList['status']['sortType']  = true;
$config->project->deliverable->dtable->fieldList['status']['show']      = true;

$config->project->deliverable->dtable->fieldList['submitFrom']['title']    = $lang->project->submitFrom;
$config->project->deliverable->dtable->fieldList['submitFrom']['name']     = 'submitFrom';
$config->project->deliverable->dtable->fieldList['submitFrom']['type']     = 'category';
$config->project->deliverable->dtable->fieldList['submitFrom']['show']     = true;
$config->project->deliverable->dtable->fieldList['submitFrom']['width']    = '120';

$config->project->deliverable->dtable->fieldList['createdBy']['title']    = $lang->project->submitedBy;
$config->project->deliverable->dtable->fieldList['createdBy']['name']     = 'createdBy';
$config->project->deliverable->dtable->fieldList['createdBy']['type']     = 'user';
$config->project->deliverable->dtable->fieldList['createdBy']['sortType'] = true;
$config->project->deliverable->dtable->fieldList['createdBy']['show']     = true;
$config->project->deliverable->dtable->fieldList['createdBy']['width']    = '120';

$config->project->deliverable->dtable->fieldList['createdDate']['title']    = $lang->project->submitedDate;
$config->project->deliverable->dtable->fieldList['createdDate']['name']     = 'createdDate';
$config->project->deliverable->dtable->fieldList['createdDate']['type']     = 'date';
$config->project->deliverable->dtable->fieldList['createdDate']['show']     = true;
$config->project->deliverable->dtable->fieldList['createdDate']['sortType'] = true;
$config->project->deliverable->dtable->fieldList['createdDate']['width']    = '120';

$config->project->deliverable->dtable->fieldList['actions']['title']    = $lang->actions;
$config->project->deliverable->dtable->fieldList['actions']['type']     = 'actions';
$config->project->deliverable->dtable->fieldList['actions']['fixed']    = 'right';
$config->project->deliverable->dtable->fieldList['actions']['width']    = '100px';
$config->project->deliverable->dtable->fieldList['actions']['list']     = $config->project->actionList;
$config->project->deliverable->dtable->fieldList['actions']['menu']     = array('submitDeliverable|submitReview|recallDeliverable', 'reviewDeliverable', 'editDeliverable', 'deleteDeliverable');
$config->project->deliverable->dtable->fieldList['actions']['sortType'] = false;

$config->project->deliverablechecklist = new stdclass();
$config->project->deliverablechecklist->dtable = new stdclass();
$config->project->deliverablechecklist->dtable->fieldList['process']['title']    = $lang->process->common;
$config->project->deliverablechecklist->dtable->fieldList['process']['name']     = 'process';
$config->project->deliverablechecklist->dtable->fieldList['process']['type']     = 'category';
$config->project->deliverablechecklist->dtable->fieldList['process']['sortType'] = false;
$config->project->deliverablechecklist->dtable->fieldList['process']['show']     = true;

$config->project->deliverablechecklist->dtable->fieldList['activity']['title']    = $lang->project->activity;
$config->project->deliverablechecklist->dtable->fieldList['activity']['name']     = 'activity';
$config->project->deliverablechecklist->dtable->fieldList['activity']['type']     = 'category';
$config->project->deliverablechecklist->dtable->fieldList['activity']['sortType'] = false;
$config->project->deliverablechecklist->dtable->fieldList['activity']['show']     = true;

$config->project->deliverablechecklist->dtable->fieldList['deliverableType']['title']    = $lang->deliverable->name;
$config->project->deliverablechecklist->dtable->fieldList['deliverableType']['name']     = 'deliverableType';
$config->project->deliverablechecklist->dtable->fieldList['deliverableType']['type']     = 'category';
$config->project->deliverablechecklist->dtable->fieldList['deliverableType']['sortType'] = false;
$config->project->deliverablechecklist->dtable->fieldList['deliverableType']['show']     = true;

$config->project->deliverablechecklist->dtable->fieldList['deliverableID']['title']    = $lang->deliverable->common;
$config->project->deliverablechecklist->dtable->fieldList['deliverableID']['name']     = 'deliverableID';
$config->project->deliverablechecklist->dtable->fieldList['deliverableID']['type']     = 'category';
$config->project->deliverablechecklist->dtable->fieldList['deliverableID']['sortType'] = false;
$config->project->deliverablechecklist->dtable->fieldList['deliverableID']['show']     = true;

$config->project->deliverablechecklist->dtable->fieldList['project']['title']    = $lang->project->submitFrom;
$config->project->deliverablechecklist->dtable->fieldList['project']['name']     = 'project';
$config->project->deliverablechecklist->dtable->fieldList['project']['type']     = 'category';
$config->project->deliverablechecklist->dtable->fieldList['project']['sortType'] = false;
$config->project->deliverablechecklist->dtable->fieldList['project']['show']     = true;

$config->project->deliverablechecklist->dtable->fieldList['createdBy']['title']    = $lang->project->submitedBy;
$config->project->deliverablechecklist->dtable->fieldList['createdBy']['name']     = 'createdBy';
$config->project->deliverablechecklist->dtable->fieldList['createdBy']['type']     = 'user';
$config->project->deliverablechecklist->dtable->fieldList['createdBy']['sortType'] = false;
$config->project->deliverablechecklist->dtable->fieldList['createdBy']['show']     = true;
if($isEn) $config->project->deliverablechecklist->dtable->fieldList['createdBy']['width'] = '120';

$config->project->deliverablechecklist->dtable->fieldList['createdDate']['title']    = $lang->project->submitedDate;
$config->project->deliverablechecklist->dtable->fieldList['createdDate']['name']     = 'createdDate';
$config->project->deliverablechecklist->dtable->fieldList['createdDate']['type']     = 'date';
$config->project->deliverablechecklist->dtable->fieldList['createdDate']['sortType'] = false;
$config->project->deliverablechecklist->dtable->fieldList['createdDate']['show']     = true;
if($isEn) $config->project->deliverablechecklist->dtable->fieldList['createdDate']['width'] = '120';

$config->project->deliverableSearch['module']                = 'projectDeliverable';
$config->project->deliverableSearch['fields']['name']        = $lang->deliverable->title;
$config->project->deliverableSearch['fields']['version']     = $lang->deliverable->version;
$config->project->deliverableSearch['fields']['module']      = $lang->deliverable->module;
$config->project->deliverableSearch['fields']['activity']    = $lang->deliverable->activity;
$config->project->deliverableSearch['fields']['deliverable'] = $lang->deliverable->name;
$config->project->deliverableSearch['fields']['submitFrom']  = $lang->project->submitFrom;
$config->project->deliverableSearch['fields']['status']      = $lang->deliverable->reviewStatus;
$config->project->deliverableSearch['fields']['isBaseline']  = $lang->deliverable->isBaseline;
$config->project->deliverableSearch['fields']['createdBy']   = $lang->project->submitedBy;
$config->project->deliverableSearch['fields']['createdDate'] = $lang->project->submitedDate;
$config->project->deliverableSearch['fields']['id']          = $lang->idAB;

$config->project->deliverableSearch['params']['name']        = array('operator' => 'include', 'control' => 'input', 'values' => '');
$config->project->deliverableSearch['params']['version']     = array('operator' => 'include', 'control' => 'input', 'values' => '');
$config->project->deliverableSearch['params']['module']      = array('operator' => '=', 'control' => 'select', 'values' => '');
$config->project->deliverableSearch['params']['activity']    = array('operator' => '=', 'control' => 'select', 'values' => '');
$config->project->deliverableSearch['params']['deliverable'] = array('operator' => '=', 'control' => 'select', 'values' => '');
$config->project->deliverableSearch['params']['submitFrom']  = array('operator' => '=', 'control' => 'select', 'values' => '');
$config->project->deliverableSearch['params']['status']      = array('operator' => '=', 'control' => 'select', 'values' => $lang->review->statusList);
$config->project->deliverableSearch['params']['isBaseline']  = array('operator' => '=', 'control' => 'select', 'values' => $lang->deliverable->baselineList);
$config->project->deliverableSearch['params']['createdBy']   = array('operator' => '=', 'control' => 'select', 'values' => 'users');
$config->project->deliverableSearch['params']['createdDate'] = array('operator' => '=', 'control' => 'date', 'values' => '');
$config->project->deliverableSearch['params']['id']          = array('operator' => '=', 'control' => 'input', 'values' => '');

$config->project->waitDeliverable = new stdclass();
$config->project->waitDeliverable->dtable = new stdclass();
$config->project->waitDeliverable->actionList['submit']['icon']        = 'plus';
$config->project->waitDeliverable->actionList['submit']['hint']        = $lang->project->createDeliverable;
$config->project->waitDeliverable->actionList['submit']['text']        = $lang->project->createDeliverable;
$config->project->waitDeliverable->actionList['submit']['url']         = array('module' => 'project', 'method' => 'createDeliverable', 'params' => 'projectID={project}&id={id}');
$config->project->waitDeliverable->actionList['submit']['data-toggle'] = 'modal';

$config->project->waitDeliverable->dtable->fieldList['name']['title']    = $lang->deliverable->title;
$config->project->waitDeliverable->dtable->fieldList['name']['name']     = 'name';
$config->project->waitDeliverable->dtable->fieldList['name']['type']     = 'title';
$config->project->waitDeliverable->dtable->fieldList['name']['width']    = '276';
$config->project->waitDeliverable->dtable->fieldList['name']['fixed']    = 'left';
$config->project->waitDeliverable->dtable->fieldList['name']['link']     = array('module' => 'deliverable', 'method' => 'view', 'params' => 'id={id}');
$config->project->waitDeliverable->dtable->fieldList['name']['sortType'] = true;

$config->project->waitDeliverable->dtable->fieldList['activity']['title']    = $lang->deliverable->activity;
$config->project->waitDeliverable->dtable->fieldList['activity']['name']     = 'activity';
$config->project->waitDeliverable->dtable->fieldList['activity']['type']     = 'category';
$config->project->waitDeliverable->dtable->fieldList['activity']['sortType'] = true;
$config->project->waitDeliverable->dtable->fieldList['activity']['show']     = true;

$config->project->waitDeliverable->dtable->fieldList['stage']['title']    = $lang->deliverable->when;
$config->project->waitDeliverable->dtable->fieldList['stage']['name']     = 'stage';
$config->project->waitDeliverable->dtable->fieldList['stage']['type']     = 'category';
$config->project->waitDeliverable->dtable->fieldList['stage']['sortType'] = false;
$config->project->waitDeliverable->dtable->fieldList['stage']['width']    = '120';
$config->project->waitDeliverable->dtable->fieldList['stage']['show']     = true;

$config->project->waitDeliverable->dtable->fieldList['required']['title']    = $lang->deliverable->required;
$config->project->waitDeliverable->dtable->fieldList['required']['name']     = 'required';
$config->project->waitDeliverable->dtable->fieldList['required']['type']     = 'category';
$config->project->waitDeliverable->dtable->fieldList['required']['sortType'] = false;
$config->project->waitDeliverable->dtable->fieldList['required']['width']    = '100';
$config->project->waitDeliverable->dtable->fieldList['required']['show']     = true;

$config->project->waitDeliverable->dtable->fieldList['desc']['title']    = $lang->deliverable->desc;
$config->project->waitDeliverable->dtable->fieldList['desc']['name']     = 'desc';
$config->project->waitDeliverable->dtable->fieldList['desc']['type']     = 'text';
$config->project->waitDeliverable->dtable->fieldList['desc']['sortType'] = false;

$config->project->waitDeliverable->dtable->fieldList['actions']['title']    = $lang->actions;
$config->project->waitDeliverable->dtable->fieldList['actions']['type']     = 'actions';
$config->project->waitDeliverable->dtable->fieldList['actions']['fixed']    = 'right';
$config->project->waitDeliverable->dtable->fieldList['actions']['width']    = '100px';
$config->project->waitDeliverable->dtable->fieldList['actions']['list']     = $config->project->waitDeliverable->actionList;
$config->project->waitDeliverable->dtable->fieldList['actions']['menu']     = array('submit');
$config->project->waitDeliverable->dtable->fieldList['actions']['sortType'] = false;

$config->project->actions->viewdeliverable = array();
$config->project->actions->viewdeliverable['mainActions']   = array('submitDeliverable', 'submitReview','recallDeliverable', 'reviewDeliverable');
$config->project->actions->viewdeliverable['suffixActions'] = array('editDeliverable', 'deleteDeliverable');

$config->project->dtable->testtask->fieldList = array();
$config->project->dtable->testtask->fieldList['id']['name']     = 'idName';
$config->project->dtable->testtask->fieldList['id']['title']    = $lang->idAB;
$config->project->dtable->testtask->fieldList['id']['type']     = 'checkID';
$config->project->dtable->testtask->fieldList['id']['checkbox'] = true;
$config->project->dtable->testtask->fieldList['id']['group']    = '2';
$config->project->dtable->testtask->fieldList['id']['fixed']    = 'left';

$config->project->dtable->testtask->fieldList['title']['name']     = 'name';
$config->project->dtable->testtask->fieldList['title']['title']    = $lang->testtask->name;
$config->project->dtable->testtask->fieldList['title']['type']     = 'title';
$config->project->dtable->testtask->fieldList['title']['link']     = array('module' => 'testtask', 'method' => 'cases', 'params' => 'taskID={id}');
$config->project->dtable->testtask->fieldList['title']['group']    = '2';
$config->project->dtable->testtask->fieldList['title']['fixed']    = 'left';
$config->project->dtable->testtask->fieldList['title']['width']    = '356';
$config->project->dtable->testtask->fieldList['title']['data-app'] = 'project';

$config->project->dtable->testtask->fieldList['pri']['name']  = 'pri';
$config->project->dtable->testtask->fieldList['pri']['title'] = $lang->priAB;
$config->project->dtable->testtask->fieldList['pri']['type']  = 'pri';
$config->project->dtable->testtask->fieldList['pri']['show']  = true;

$config->project->dtable->testtask->fieldList['product']['name']  = 'productName';
$config->project->dtable->testtask->fieldList['product']['title'] = $lang->testtask->product;
$config->project->dtable->testtask->fieldList['product']['type']  = 'text';
$config->project->dtable->testtask->fieldList['product']['group'] = '1';

$config->project->dtable->testtask->fieldList['build']['name']  = 'buildName';
$config->project->dtable->testtask->fieldList['build']['title'] = $lang->testtask->build;
$config->project->dtable->testtask->fieldList['build']['type']  = 'text';
$config->project->dtable->testtask->fieldList['build']['link']  = array('module' => 'projectbuild', 'method' => 'view', 'params' => 'buildID={build}');
$config->project->dtable->testtask->fieldList['build']['group'] = 'text';
$config->project->dtable->testtask->fieldList['build']['group'] = '3';

$config->project->dtable->testtask->fieldList['execution']['name']  = 'executionName';
$config->project->dtable->testtask->fieldList['execution']['title'] = $lang->testtask->execution;
$config->project->dtable->testtask->fieldList['execution']['type']  = 'text';
$config->project->dtable->testtask->fieldList['execution']['group'] = 'text';
$config->project->dtable->testtask->fieldList['execution']['group'] = '3';

$config->project->dtable->testtask->fieldList['owner']['name']    = 'owner';
$config->project->dtable->testtask->fieldList['owner']['title']   = $lang->testtask->owner;
$config->project->dtable->testtask->fieldList['owner']['type']    = 'user';
$config->project->dtable->testtask->fieldList['owner']['group']   = '4';

$config->project->dtable->testtask->fieldList['begin']['name']  = 'begin';
$config->project->dtable->testtask->fieldList['begin']['title'] = $lang->testtask->begin;
$config->project->dtable->testtask->fieldList['begin']['type']  = 'date';
$config->project->dtable->testtask->fieldList['begin']['group'] = '4';

$config->project->dtable->testtask->fieldList['end']['name']  = 'end';
$config->project->dtable->testtask->fieldList['end']['title'] = $lang->testtask->end;
$config->project->dtable->testtask->fieldList['end']['type']  = 'date';
$config->project->dtable->testtask->fieldList['end']['group'] = '4';

$config->project->dtable->testtask->fieldList['status']['name']      = 'status';
$config->project->dtable->testtask->fieldList['status']['title']     = $lang->testtask->status;
$config->project->dtable->testtask->fieldList['status']['type']      = 'status';
$config->project->dtable->testtask->fieldList['status']['statusMap'] = $lang->testtask->statusList;
$config->project->dtable->testtask->fieldList['status']['group']     = '4';

$config->project->dtable->testtask->fieldList['actions']['name']     = 'actions';
$config->project->dtable->testtask->fieldList['actions']['title']    = $lang->actions;
$config->project->dtable->testtask->fieldList['actions']['type']     = 'actions';
$config->project->dtable->testtask->fieldList['actions']['sortType'] = false;
$config->project->dtable->testtask->fieldList['actions']['fixed']    = 'right';
$config->project->dtable->testtask->fieldList['actions']['list']     = $config->testtask->actionList;
$config->project->dtable->testtask->fieldList['actions']['menu']     = array(array('start', 'other' => array('activate', 'close')), 'cases', 'linkCase', 'report', 'edit', 'delete');
