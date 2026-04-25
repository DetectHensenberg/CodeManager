<?php
$lang->reviewissue->common         = 'Review Issues';
$lang->reviewissue->issue          = 'Issues';
$lang->reviewissue->issueBrowse    = 'View';
$lang->reviewissue->create         = 'Create';
$lang->reviewissue->edit           = 'Edit';
$lang->reviewissue->view           = 'Details';
$lang->reviewissue->updateStatus   = 'Activate/Close Issues';
$lang->reviewissue->confirmSolve   = 'Is the issue resolved?';
$lang->reviewissue->confirmActive  = 'Is the issue reactivated?';
$lang->reviewissue->confirmClose   = 'Is the issue needs to be closed?';
$lang->reviewissue->confirmDelete  = 'Is the issue needs to be deleted?';
$lang->reviewissue->undeleteAction = 'The review that this issue belongs to has been deleted. Please restore the review first and then restore the issue';
$lang->reviewissue->resolved       = 'Resolve';
$lang->reviewissue->activation     = 'Active';
$lang->reviewissue->activate       = 'Active';
$lang->reviewissue->assignTo       = 'Assign';
$lang->reviewissue->close          = 'Close';
$lang->reviewissue->delete         = 'Delete';
$lang->reviewissue->deleted        = 'Deleted';
$lang->reviewissue->issueInfo      = 'Issue Details';
$lang->reviewissue->hasResolved    = 'Resolve?';
$lang->reviewissue->searchReview   = 'Select Review Item';
$lang->reviewissue->injection      = 'Injection Stage';
$lang->reviewissue->byQuery        = 'Search';

$lang->reviewissue->id           = 'ID';
$lang->reviewissue->review       = 'Review';
$lang->reviewissue->listID       = 'Checklist';
$lang->reviewissue->title        = 'Checklist';
$lang->reviewissue->opinion      = 'Review Issue';
$lang->reviewissue->status       = 'Status';
$lang->reviewissue->type         = 'Type';
$lang->reviewissue->createdBy    = 'Created by';
$lang->reviewissue->createdDate  = 'Created';
$lang->reviewissue->assignedTo   = 'Assigned to';
$lang->reviewissue->assignedDate = 'Assigned Date';

$lang->reviewissue->issueType['deliverable'] = 'Deliverable Issue';
$lang->reviewissue->issueType['baseline']    = 'Baseline Issue';
$lang->reviewissue->issueType['decision']    = 'Decision Issue';

$lang->reviewissue->statusList['active']   = 'Active';
$lang->reviewissue->statusList['resolved'] = 'Resolved';
$lang->reviewissue->statusList['closed']   = 'Closed';

$lang->reviewissue->featureBar['issue']['all']         = 'All';
$lang->reviewissue->featureBar['issue']['active']      = 'Active';
$lang->reviewissue->featureBar['issue']['resolved']    = 'Resolved';
$lang->reviewissue->featureBar['issue']['closed']      = 'Closed';
$lang->reviewissue->featureBar['issue']['createdBy']   = 'Created by';
$lang->reviewissue->featureBar['issue']['deliverable'] = 'Deliverable';
$lang->reviewissue->featureBar['issue']['baseline']    = 'Baseline';
$lang->reviewissue->featureBar['issue']['decision']    = 'Decision';

$lang->reviewissue->review         = 'Review Title';
$lang->reviewissue->checklist      = 'Checklist';
$lang->reviewissue->listType       = 'Checklist Type';
$lang->reviewissue->resolution     = 'Resolution';
$lang->reviewissue->resolutionBy   = 'Resolved by';
$lang->reviewissue->resolutionDate = 'Resolved Date';

$lang->reviewissue->resolutionList['']           = '';
$lang->reviewissue->resolutionList['bydesign']   = 'As Designed';
$lang->reviewissue->resolutionList['duplicate']  = 'Duplicate';
$lang->reviewissue->resolutionList['external']   = 'External';
$lang->reviewissue->resolutionList['fixed']      = 'Resolved';
$lang->reviewissue->resolutionList['notrepro']   = 'Irreproducible';
$lang->reviewissue->resolutionList['postponed']  = 'Postponed';
$lang->reviewissue->resolutionList['willnotfix'] = "Won't Fix";

/* Operating record. */
$lang->reviewissue->action = new stdclass();
$lang->reviewissue->action->resolved = array('main' => '$date, resolved by <strong>$actor</strong> and the resolution is <strong>$extra</strong>.', 'extra' => 'resolutionList');
