<?php
$config->project->form->edit['category'] = array('type' => 'string', 'required' => false, 'default' => '');

$app->loadLang('review');
$app->loadLang('approval');

$config->project->execution->dtable->fieldList['status']['statusMap'] = $lang->execution->statusList + $lang->task->statusList + $lang->review->statusList;

$config->project->execution->dtable->fieldList['actions']['actionsMap']['createReview']['icon'] = 'confirm';
$config->project->execution->dtable->fieldList['actions']['actionsMap']['createReview']['hint'] = $lang->review->submit;
$config->project->execution->dtable->fieldList['actions']['actionsMap']['createReview']['url']  = helper::createLink('review', 'create', 'projectID={project}&deliverable=0&reviewID={review}&type=decision&objectID={category}');

$config->project->execution->dtable->fieldList['actions']['actionsMap']['submitReview']['icon']        = 'confirm';
$config->project->execution->dtable->fieldList['actions']['actionsMap']['submitReview']['hint']        = $lang->review->submit;
$config->project->execution->dtable->fieldList['actions']['actionsMap']['submitReview']['data-toggle'] = 'modal';
$config->project->execution->dtable->fieldList['actions']['actionsMap']['submitReview']['url']         = helper::createLink('review', 'submit', 'reviewID={review}');

$config->project->execution->dtable->fieldList['actions']['actionsMap']['recallReview']['icon']         = 'back';
$config->project->execution->dtable->fieldList['actions']['actionsMap']['recallReview']['hint']         = $lang->review->recall;
$config->project->execution->dtable->fieldList['actions']['actionsMap']['recallReview']['url']          = helper::createLink('review', 'recall', 'reviewID={review}');
$config->project->execution->dtable->fieldList['actions']['actionsMap']['recallReview']['className']    = 'ajax-submit';
$config->project->execution->dtable->fieldList['actions']['actionsMap']['recallReview']['data-confirm'] = $lang->review->confirmRecall;

$config->project->execution->dtable->fieldList['actions']['actionsMap']['assessReview']['icon'] = 'glasses';
$config->project->execution->dtable->fieldList['actions']['actionsMap']['assessReview']['hint'] = $lang->review->assess;
$config->project->execution->dtable->fieldList['actions']['actionsMap']['assessReview']['url']  = helper::createLink('review', 'assess', 'reviewID={review}');

$config->project->execution->dtable->fieldList['actions']['actionsMap']['progressReview']['icon']        = 'list-alt';
$config->project->execution->dtable->fieldList['actions']['actionsMap']['progressReview']['hint']        = $lang->approval->progress;
$config->project->execution->dtable->fieldList['actions']['actionsMap']['progressReview']['url']         = helper::createLink('approval', 'progress', 'approvalID={approval}');
$config->project->execution->dtable->fieldList['actions']['actionsMap']['progressReview']['data-toggle'] = 'modal';

$config->project->execution->dtable->fieldList['actions']['actionsMap']['reportReview']['icon'] = 'bar-chart';
$config->project->execution->dtable->fieldList['actions']['actionsMap']['reportReview']['hint'] = $lang->review->reviewReport;
$config->project->execution->dtable->fieldList['actions']['actionsMap']['reportReview']['url']  = helper::createLink('review', 'report', 'reviewID={review}');

$config->project->execution->dtable->fieldList['actions']['actionsMap']['editReview']['icon']        = 'edit';
$config->project->execution->dtable->fieldList['actions']['actionsMap']['editReview']['hint']        = $lang->review->edit;
$config->project->execution->dtable->fieldList['actions']['actionsMap']['editReview']['data-toggle'] = 'modal';
$config->project->execution->dtable->fieldList['actions']['actionsMap']['editReview']['url']         = helper::createLink('review', 'edit', 'reviewID={review}');

$config->project->execution->dtable->actionsRule['ipd']   = array('start', 'createTask', 'createChildStage', 'edit', 'close|activate', 'delete');
$config->project->execution->dtable->actionsRule['point'] = array('createReview|submitReview', 'recallReview', 'assessReview', 'progressReview', 'reportReview', 'editReview');

$config->project->labelClass['ipd'] = 'primary-outline';
