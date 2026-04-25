<?php
$lang->deliverable->name            = 'Deliverable Category';
$lang->deliverable->title           = 'Deliverable Title';
$lang->deliverable->version         = 'Version';
$lang->deliverable->versionStatus   = 'Version Status';
$lang->deliverable->module          = 'Module';
$lang->deliverable->desc            = 'Description';
$lang->deliverable->createdByAB     = 'CreatedBy';
$lang->deliverable->createdBy       = 'Created By';
$lang->deliverable->createdDate     = 'Created Date';
$lang->deliverable->lastEditedBy    = 'Last Modified';
$lang->deliverable->lastEditedDate  = 'Last Modified Date';
$lang->deliverable->template        = 'Reference Template';
$lang->deliverable->files           = 'Upload Template';
$lang->deliverable->activity        = 'Activity';
$lang->deliverable->addActivity     = 'Add Activity';
$lang->deliverable->trimmable       = 'Trimmable';
$lang->deliverable->trimRule        = 'Trim Rule';
$lang->deliverable->when            = 'When';
$lang->deliverable->required        = 'Required';
$lang->deliverable->or              = 'OR';
$lang->deliverable->basicInfo       = 'Basiec Info';
$lang->deliverable->selectDoc       = 'Select Document Template';
$lang->deliverable->whenClose       = ' closes';
$lang->deliverable->moduleSetting   = 'Category Setting';
$lang->deliverable->status          = 'Status';
$lang->deliverable->reviewStatus    = 'Review Status';
$lang->deliverable->toEdit          = 'Go to link';
$lang->deliverable->isBaseline      = 'Is Base Line';
$lang->deliverable->submitedBy      = 'Submited By';
$lang->deliverable->baseline        = 'Baseline';
$lang->deliverable->baselineVersion = 'Baseline Version';

$lang->deliverable->createByTemplate   = 'Create from template';
$lang->deliverable->selectDocInProject = 'Please select document that you can view.';

$lang->deliverable->browse  = 'Deliverable Category Browse';
$lang->deliverable->create  = 'Add Deliverable Category';
$lang->deliverable->edit    = 'Edit Deliverable Category';
$lang->deliverable->delete  = 'Delete Deliverable Category';
$lang->deliverable->enable  = 'Enable Deliverable Category';
$lang->deliverable->disable = 'Disable Deliverable Category';
$lang->deliverable->view    = 'Deliverable Category Details';

$lang->deliverable->createAbbr  = 'New';
$lang->deliverable->createTitle = 'Create Deliverable Category';
$lang->deliverable->editTitle   = 'Edit Deliverable Category';

$lang->deliverable->moduleLang = new stdclass();
$lang->deliverable->moduleLang->common         = 'Category Manage';
$lang->deliverable->moduleLang->manage         = 'Category Manage';
$lang->deliverable->moduleLang->module         = 'Category';
$lang->deliverable->moduleLang->name           = 'Category Name';
$lang->deliverable->moduleLang->create         = 'Create Category';
$lang->deliverable->moduleLang->edit           = 'Edit Category';
$lang->deliverable->moduleLang->repeatName     = 'The category name %s already exists!';
$lang->deliverable->moduleLang->confirmDelete  = 'Are you sure you want to delete this category?';
$lang->deliverable->moduleLang->shouldNotBlank = 'The category name cannot be a space!';

$lang->deliverable->abbr = new stdclass();
$lang->deliverable->abbr->template = 'Template';

$lang->deliverable->typeLang = new stdclass();
$lang->deliverable->typeLang->summary = 'There are %s deliverable categories on this page';

$lang->deliverable->trimmableList['0']  = 'Not Trimmable';
$lang->deliverable->trimmableList['1']  = 'Trimmable';

$lang->deliverable->requiredList['0'] = 'Choose to submit when';
$lang->deliverable->requiredList['1'] = 'Must submit when';

$lang->deliverable->statusList['enabled']  = 'Enabled';
$lang->deliverable->statusList['disabled'] = 'Disabled';

$lang->deliverable->versionStatusList['latest']  = 'Latest';
$lang->deliverable->versionStatusList['updated'] = 'Updated';

$lang->deliverable->baselineList['0'] = 'No';
$lang->deliverable->baselineList['1'] = 'Yes';

$lang->deliverable->confirmDelete    = 'The deliverable review process and checklist will be deleted synchronously. Do you want to continue?';
$lang->deliverable->summary          = 'There are %s deliverables on this page';
$lang->deliverable->exceededCountTip = 'Each deliverable can only upload one file';

$lang->deliverable->featureBar['browse']['all'] = 'All';

$lang->deliverable->addedDoc    = 'Added deliverable documents: %s';
$lang->deliverable->deletedDoc  = 'Deleted deliverable documents: %s';
$lang->deliverable->addedFile   = 'Added deliverable files: %s';
$lang->deliverable->deletedFile = 'Deleted deliverable files: %s';
$lang->deliverable->renamedFile = 'Renamed deliverable files: %s -> %s';
$lang->deliverable->renamedDoc  = 'Renamed deliverable documents: %s -> %s';

$lang->deliverable->stageMustBeSelected = 'Please select at least one check stage for the deliverable!';
$lang->deliverable->deleteModuleConfirm = 'Cannot delete categories containing deliverable categories.';
$lang->deliverable->confirmEnable       = 'The deliverable is not associated with "Category" or "Activity", please associate it before enabling.';
$lang->deliverable->builtinConfirm      = 'Built in deliverables cannot be operated';
$lang->deliverable->trimableNotice      = 'The "Trimmable" attribute of the deliverable type is constrained by the trimming attribute of the associated activity';

$lang->deliverable->buildinModule['plan']   = 'Plan';
$lang->deliverable->buildinModule['story']  = 'Story';
$lang->deliverable->buildinModule['design'] = 'Design';
$lang->deliverable->buildinModule['test']   = 'Test';
$lang->deliverable->buildinModule['other']  = 'Other';

$lang->deliverable->action = new stdclass();
$lang->deliverable->action->enabled  = array('main' => '$date, enabled by <strong>$actor</strong>.');
$lang->deliverable->action->disabled = array('main' => '$date, disabled by <strong>$actor</strong>.');
