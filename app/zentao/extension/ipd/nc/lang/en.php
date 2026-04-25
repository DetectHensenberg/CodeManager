<?php
$lang->nc->browse       = 'Non Conformity List';
$lang->nc->common       = 'Non conformity';
$lang->nc->create       = 'Create';
$lang->nc->createPriv   = 'Create';
$lang->nc->edit         = 'Edit';
$lang->nc->delete       = 'Delete';
$lang->nc->view         = 'View';
$lang->nc->resolve      = 'Resolve';
$lang->nc->close        = 'Close';
$lang->nc->export       = 'Export Data';
$lang->nc->assignTo     = 'Assign';
$lang->nc->activate     = 'Activate';
$lang->nc->exportAction = 'Export non conformity';

$lang->nc->id           = 'ID';
$lang->nc->auditplan    = 'Audit Plan';
$lang->nc->object       = 'Object';
$lang->nc->listID       = 'Checklist';
$lang->nc->title        = 'Title';
$lang->nc->desc         = 'Description';
$lang->nc->type         = 'Type';
$lang->nc->status       = 'Status';
$lang->nc->severity     = 'Severity';
$lang->nc->deadline     = 'Deadline';
$lang->nc->resolvedBy   = 'Resolved by';
$lang->nc->resolution   = 'Resolution';
$lang->nc->resolvedDate = 'Resolved Date';
$lang->nc->closedBy     = 'Closed by';
$lang->nc->closedDate   = 'Closed Date';
$lang->nc->assignedTo   = 'Assigned to';
$lang->nc->createdBy    = 'Created by';
$lang->nc->createdDate  = 'Created Date';
$lang->nc->execution    = $lang->execution->common;
$lang->nc->activateBy   = 'Activated by';
$lang->nc->activateDate = 'Activated Date';
$lang->nc->objectType   = 'Object Type';
$lang->nc->pageSummary  = 'Total: %total%, Active: %active%.';
$lang->nc->deliverable  = $lang->nc->auditplan;
$lang->nc->noAssigned   = 'Unassigned';

$lang->nc->basicInfo     = 'Basic Information';
$lang->nc->confirmDelete = 'Do you want to delete this bug?';

$lang->nc->severityList[0] = '';
$lang->nc->severityList[1] = '1';
$lang->nc->severityList[2] = '2';
$lang->nc->severityList[3] = '3';

$lang->nc->statusList['active']   = 'Activated';
$lang->nc->statusList['resolved'] = 'Resolved';
$lang->nc->statusList['closed']   = 'Closed';

$lang->nc->typeList[''] = '';

$lang->nc->resolutionList['']           = '';
$lang->nc->resolutionList['bydesign']   = 'As Designed';
$lang->nc->resolutionList['external']   = 'External';
$lang->nc->resolutionList['fixed']      = 'Resolved';
$lang->nc->resolutionList['notrepro']   = 'Irreproducible';
$lang->nc->resolutionList['postponed']  = 'Postponed';
$lang->nc->resolutionList['willnotfix'] = "Won't Fix";

$lang->nc->featureBar['browse']['all']          = 'All';
$lang->nc->featureBar['browse']['unclosed']     = 'Open';
$lang->nc->featureBar['browse']['assignedtome'] = 'Assigned to Me';
$lang->nc->featureBar['browse']['assignedbyme'] = 'Assigned by Me';

$lang->nc->action = new stdclass();
$lang->nc->action->resolved = array('main' => '$date, resolved by <strong>$actor</strong> ，<strong>$extra</strong>。', 'extra' => 'resolutionList');
$lang->nc->action->closed   = array('main' => '$date, closed by <strong>$actor</strong> 。');

$lang->nc->objectTypeList['auditplan']   = 'Audit Plan';
$lang->nc->objectTypeList['deliverable'] = 'Deliverable';
