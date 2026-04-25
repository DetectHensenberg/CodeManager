<?php
$lang->project->approval               = 'Approval';
$lang->project->previous               = 'Previous';
$lang->project->deliverable            = 'Deliverable List';
$lang->project->deliverableAbbr        = 'Deliverable';
$lang->project->template               = 'Template';
$lang->project->templateList           = 'Template Browse';
$lang->project->templateName           = 'Template Name';
$lang->project->createTemplate         = 'Create Template';
$lang->project->editTemplate           = 'Edit Template';
$lang->project->publishTemplate        = 'Publish Template';
$lang->project->disableTemplate        = 'Disable Template';
$lang->project->createTemplateAbbr     = 'Create Template';
$lang->project->copyProjectID          = 'Select Project';
$lang->project->model                  = 'Management Type';
$lang->project->newProject             = 'New Project';
$lang->project->deleteTemplate         = 'Delete Template';
$lang->project->inUse                  = 'In Use';
$lang->project->noDesc                 = 'No Description';
$lang->project->needRelease            = 'Need Release';
$lang->project->templatePriv           = 'Set Template Priv';
$lang->project->tplAcl                 = 'Permission To Edit And Use';
$lang->project->disabled               = 'Disabled';
$lang->project->baseline               = 'Baseline';
$lang->project->templateDesc           = 'Description';
$lang->project->createDeliverable      = 'Submit Deliverable';
$lang->project->createDeliverableAbbr  = 'Submit';
$lang->project->submitDeliverable      = 'Submit Deliverable';
$lang->project->recallDeliverable      = 'Recall Deliverable';
$lang->project->reviewDeliverable      = 'Review Deliverable';
$lang->project->editDeliverable        = 'Edit Deliverable';
$lang->project->viewDeliverable        = 'Deliverable Details';
$lang->project->deleteDeliverable      = 'Delete Deliverable';
$lang->project->editApproval           = 'Edit Approval';
$lang->project->flow                   = 'Approval Flow';
$lang->project->deliverableChecklist   = 'Deliverable Checklist';
$lang->project->needConfirm            = 'Not Confirmed';
$lang->project->confirmed              = 'Confirmed';
$lang->project->hasApproval            = 'Has Approval';
$lang->project->updateVersion          = 'Update Version';

$lang->project->templateAclList['open']    = 'Public (authorized users can view and use)';
$lang->project->templateAclList['private'] = 'Private (only creators and whitelist users can edit and use)';

$lang->project->approvalflow = new stdclass();
$lang->project->approvalflow->flow   = 'Approval Flow';
$lang->project->approvalflow->object = 'Apporval Object';

$lang->project->approvalflow->objectList[''] = '';
$lang->project->approvalflow->objectList['stage'] = 'Stage';
$lang->project->approvalflow->objectList['task']  = 'Task';

$lang->project->deliverableList['create'] = 'Create Deliverables';
$lang->project->deliverableList['close']  = 'Close Deliverables';

$lang->project->hasApprovalList[1] = 'Need Approval';
$lang->project->hasApprovalList[0] = 'No Approval';

$lang->project->copyProjectConfirm       = "Complete {$lang->projectCommon} Information";
$lang->project->executionInfoConfirm     = 'Complete Execution Information';
$lang->project->stageInfoConfirm         = 'Complete Stage Information';
$lang->project->kanbanInfoConfirm        = 'Complete Kanban Information';
$lang->project->confirmDeleteTemplate    = 'Are you sure to delete the project template?';
$lang->project->confirmDisableTemplate   = 'Are you sure to disable this project template?';
$lang->project->cannotPublishTemplate    = 'The project flow status under the project template is disabled/deleted, and cannot be published.';
$lang->project->confirmDeleteDeliverable = 'After deleting the deliverable, the original document will not be deleted.';

$lang->project->executionInfoTips     = "To avoid repetition, modify the {$lang->executionCommon} name and {$lang->executionCommon} code, and set the planned start time and planned finish time.";
$lang->project->executionInfoTipsAbbr = "To avoid repetition, modify the {$lang->executionCommon} name and {$lang->executionCommon} code.";
$lang->project->deliverableTips       = 'Deliverable submission ratio = number of submitted deliverables / total number of required and submitted deliverables';
$lang->project->whenClosedTips        = '(Deliverables are not strictly validated when the project is closed)';
$lang->project->deliverableFrozenTips = 'After the deliverable are baselined, edit is not allowed.';

$lang->project->chosenProductStage = 'Please select the stage of "%s" ' . $lang->productCommon . 'to copy';
$lang->project->notCopyStage       = 'Not Copy';
$lang->project->completeCopy       = 'Complete Copy';
$lang->project->noTemplateData     = 'No Data';
$lang->project->notSubmit          = 'Not submit ';

$lang->project->copyProject->code                = '『' . $lang->projectCommon . '』Cannot be repeated.';
$lang->project->copyProject->executionCode       = '『' . $lang->executionCommon . '』Cannot be repeated.';
$lang->project->copyProject->select              = 'Select';
$lang->project->copyProject->confirmData         = 'Confirm';
$lang->project->copyProject->improveData         = 'Improve';
$lang->project->copyProject->completeData        = 'Complete';
$lang->project->copyProject->selectPlz           = 'Please select the ' . $lang->projectCommon;
$lang->project->copyProject->cancel              = 'Cancel';
$lang->project->copyProject->all                 = 'All data';
$lang->project->copyProject->basic               = 'Basic data';
$lang->project->copyProject->allList             = array($lang->projectCommon . ' data', '%s data', 'Project/%s doc lib and catalog', 'Task data', 'QA', 'Process', 'Team member and permission');
$lang->project->copyProject->noSprintList        = array($lang->projectCommon . ' data', 'Task data', $lang->projectCommon . ' doc lib and catalog', 'Team member and permission');
$lang->project->copyProject->ipdAllList          = array($lang->projectCommon . ' data', '%s data', 'Project/%s doc lib and catalog', 'Task data', 'Team member and permission');
$lang->project->copyProject->kanbanAllList       = array($lang->projectCommon . ' data', 'Kanban data', 'Project/Kanban doc lib and catalog', 'Task data', 'Team member');
$lang->project->copyProject->toComplete          = 'To complete';
$lang->project->copyProject->selectProjectPlz    = $lang->projectCommon;
$lang->project->copyProject->confirmCopyDataTip  = 'Make sure you want to copy the data:';
$lang->project->copyProject->basicInfo           = $lang->projectCommon . ' data (Program, Project name, Project code, ' . $lang->productCommon . ')';
$lang->project->copyProject->selectProgram       = 'Program';
$lang->project->copyProject->sprint              = $lang->executionCommon;
$lang->project->copyProject->planFinishSmall     = 'The "Plan Finish" must be > the "Plan Begin".';
$lang->project->copyProject->errorExecutionBegin = "The plan begin of {$lang->executionCommon} cannot be less than the start date of the {$lang->projectCommon} %s.";
$lang->project->copyProject->errorExecutionEnd   = "The plan finish of {$lang->executionCommon} cannot be more than the end date of the {$lang->projectCommon} %s.";
$lang->project->copyProject->errorStageBegin     = "The plan begin of stage cannot be less than the start date of the {$lang->projectCommon} %s.";
$lang->project->copyProject->errorStageEnd       = "The plan finish of stage cannot be more than the end date of the {$lang->projectCommon} %s.";
$lang->project->copyProject->errorKanbanBegin    = "The plan begin of kanban cannot be less than the start date of the {$lang->projectCommon} %s.";
$lang->project->copyProject->errorKanbanEnd      = "The plan finish of kanban cannot be more than the end date of the {$lang->projectCommon} %s.";

$lang->project->action->managedeliverable = '$date, managed deliverable by <strong>$actor</strong>.';
$lang->project->action->disabled          = '$date, disabled template by <strong>$actor</strong>.';

$lang->project->featureBar['template']['all'] = 'All';

$lang->project->featureBar['deliverable']['wait']       = 'Not Submitted';
$lang->project->featureBar['deliverable']['normal']     = 'Submitted';
$lang->project->featureBar['deliverable']['mine']       = 'Submitted by Me';
$lang->project->featureBar['deliverable']['submitbyme'] = 'Created by Me';
$lang->project->featureBar['deliverable']['pending']    = 'Waiting Review';
$lang->project->featureBar['deliverable']['pendingme']  = 'My Pending Review';
$lang->project->featureBar['deliverable']['more']       = 'More';

$lang->project->featureBar['approval']['all'] = 'All';

$lang->project->moreSelects['deliverable']['more']['reviewing']    = 'Reviewing';
$lang->project->moreSelects['deliverable']['more']['reviewedbyme'] = 'Reviewed by Me';
$lang->project->moreSelects['deliverable']['more']['pass']         = 'Pass';
$lang->project->moreSelects['deliverable']['more']['fail']         = 'Fail';

$lang->project->deliverableEmpty         = 'Deliverable cannot be empty';
$lang->project->deliverableCategoryEmpty = 'Deliverable category cannot be empty';
$lang->project->submitedBy               = 'Submitted by';
$lang->project->submitedDate             = 'Submitted Date';
$lang->project->viewApprovalProgress     = 'View Approval Progress';
$lang->project->submitFrom               = 'Submission Source';
$lang->project->selectDoc                = 'Select Document';
$lang->project->activity                 = 'Activity';
$lang->project->deliverableChecklist     = 'Deliverable Checklist';

$lang->project->featureBar['deliverablechecklist']['all']    = 'All';
$lang->project->featureBar['deliverablechecklist']['wait']   = 'Not Submitted';
$lang->project->featureBar['deliverablechecklist']['normal'] = 'Submitted';

global $config;
if($config->systemMode == 'light') $lang->project->copyProject->basicInfo = $lang->projectCommon . 'data (project name, project code,' . $lang->productCommon . ')';
if(!helper::hasFeature('project_auditplan')) unset($lang->project->copyProject->allList[4]);
if(!helper::hasFeature('project_process'))   unset($lang->project->copyProject->allList[5]);
