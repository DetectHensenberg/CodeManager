<?php
global $config;

$lang->review->id                  = 'ID';
$lang->review->delete              = 'Delete';
$lang->review->deleted             = 'Deleted';
$lang->review->common              = 'Review';
$lang->review->assess              = 'Review';
$lang->review->record              = 'History';
$lang->review->explain             = 'Notes';
$lang->review->resultExplain       = 'Result Notes';
$lang->review->reviewResult        = 'Review Result';
$lang->review->conclusion          = 'Review Conclusion(pass or not)';
$lang->review->recall              = 'Revoke';
$lang->review->files               = 'File';
$lang->review->start               = 'Start';
$lang->review->finish              = 'Finish';
$lang->review->toAudit             = 'Audit';
$lang->review->create              = 'Create';
$lang->review->submit              = 'Submit Review';
$lang->review->submitDeliverable   = 'Submit Deliverable Review';
$lang->review->submitBaseline      = 'Submit Baseline Review';
$lang->review->submitIpd           = 'Submit Technical and Decision Review';
$lang->review->submitProjectchange = 'Submit Project Change Review';
$lang->review->createFlow          = 'Create Flow';
$lang->review->edit                = 'Edit';
$lang->review->editFlow            = 'Edit Flow';
$lang->review->deleteFlow          = 'Delete Flow';
$lang->review->browse              = 'View';
$lang->review->admin               = 'Review Flow List';
$lang->review->view                = 'Details';
$lang->review->viewFlow            = 'Preview Process';
$lang->review->title               = 'Title';
$lang->review->type                = 'Review Type';
$lang->review->cm                  = 'Configuration Item';
$lang->review->cmTitle             = 'Baseline Name';
$lang->review->deliverables        = 'Review Deliverables';
$lang->review->object              = 'Review Object';
$lang->review->content             = 'Content From';
$lang->review->doclib              = 'Document Library';
$lang->review->template            = 'Template';
$lang->review->doc                 = 'Doc';
$lang->review->version             = 'Version';
$lang->review->deliverable         = 'Deliverable';
$lang->review->reviewedBy          = 'Reviewed by';
$lang->review->reviewer            = 'Reviewer';
$lang->review->reviewReport        = 'Review Report';
$lang->review->exportReport        = 'Export Review Report';
$lang->review->reviewerCount       = 'No. of Reviewer';
$lang->review->deadline            = 'Deadline';
$lang->review->comment             = 'Comment';
$lang->review->createdBy           = 'Created by';
$lang->review->createdDate         = 'Created';
$lang->review->submitedBy          = 'Submitted by';
$lang->review->reviewedHours       = 'Review Hours';
$lang->review->area                = 'Review Location';
$lang->review->audit               = 'Audit';
$lang->review->auditedBy           = 'Audit by';
$lang->review->issueCount          = 'Defect Count';
$lang->review->issueFoundRate      = 'Defect Discovery Rate';
$lang->review->issues              = 'Issue Found';
$lang->review->isIssue             = 'Defect';
$lang->review->result              = 'Review Result';
$lang->review->nodeDetail          = 'Node Details';
$lang->review->status              = 'Status';
$lang->review->opinion             = 'Suggestion';
$lang->review->finalOpinion        = 'Review Suggestion';
$lang->review->reviewcl            = 'Checklist';
$lang->review->reviewedDate        = 'Reviewed';
$lang->review->consumed            = 'Consumed';
$lang->review->basicInfo           = 'Basic Infomation';
$lang->review->product             = $lang->productCommon;
$lang->review->auditResult         = 'Audit Result';
$lang->review->auditedDate         = 'Audit';
$lang->review->auditOpinion        = 'Audit Opinion';
$lang->review->issueList           = 'Issue List';
$lang->review->lastIssue           = 'Legacy Issues';
$lang->review->fullScreen          = 'Full Screen';
$lang->review->auditedByEmpty      = 'Auditedby cannot be empty!';
$lang->review->exporting           = 'Exporting...';
$lang->review->lastReviewedDate    = 'Last Reviewed';
$lang->review->lastAuditedDate     = 'Last Audited';
$lang->review->lastEditedBy        = 'Last Edited';
$lang->review->createBaseline      = 'Create Baseline';
$lang->review->opinionDate         = 'Suggested';
$lang->review->setReviewer         = 'Next node approver';
$lang->review->issueCountTip       = "{$lang->review->issueCount} counts problem count of {$lang->review->common} Non-conformities";
$lang->review->issueFoundRateTip   = "{$lang->review->issueFoundRate}={$lang->review->issueCount}/{$lang->review->reviewedHours}";
$lang->review->untitled            = 'Untitled';
$lang->review->objectID            = 'Deliverable Category';
$lang->review->flow                = 'Approval Flow';
$lang->review->createApproval      = 'Create Approval';
$lang->review->approval            = 'Review Name';
$lang->review->relatedBy           = 'Related by';
$lang->review->relatedDate         = 'Related Date';
$lang->review->deliverableEmptyTip = "No deliverable data available yet. Please click 'Confirm' to create.";

$lang->review->browseAction = 'Reivew List';

$lang->review->pageAllSummary = 'Total reviews: %total%, Wait: %wait%, Reviewing: %reviewing%, Pass: %pass%.';
$lang->review->pageSummary    = 'Total reviews: %s.';

$lang->object = new stdclass();
$lang->object->product = $lang->review->product;

$lang->review->report = new stdclass();
$lang->review->report->common = 'Review Report';

$lang->review->reportCreatedBy  = 'Report Created by';
$lang->review->reportApprovedBy = 'Report Approved by';

$lang->review->listCategory = 'Category';
$lang->review->listTitle    = 'Content';
$lang->review->listItem     = 'Item';
$lang->review->listResult   = 'Result';

$lang->review->contentList['template'] = 'Generated by System Template';
$lang->review->contentList['doc']      = $lang->projectCommon . 'Document';

$lang->review->noBook        = 'No relevant statements. Go to the document to maintain statements.';
$lang->review->stopSubmit    = 'Nonconformities in the checklist!';
$lang->review->confirmDelete = 'Do you want to delete this review? If you delete it, the items under that review will also be deleted !';
$lang->review->confirmRecall = 'Do you want to recall this review?';

$lang->review->statusList['draft']     = 'Wait';
$lang->review->statusList['reverting'] = 'Reverting';
$lang->review->statusList['reviewing'] = 'Reviewing';
$lang->review->statusList['pass']      = 'Pass';
$lang->review->statusList['fail']      = 'Fail';
$lang->review->statusList['done']      = 'Done';

$lang->review->resultList['pass']        = 'Pass';
$lang->review->resultList['conditional'] = 'Conditional Pass';
$lang->review->resultList['fail']        = 'Fail';

$lang->review->auditResultList['pass']    = 'Pass';
$lang->review->auditResultList['needfix'] = 'Review';
$lang->review->auditResultList['fail']    = 'Fail';

$lang->review->resultLable['pass']    = 'success';
$lang->review->resultLable['fail']    = 'danger';
$lang->review->resultLable['needfix'] = 'info';

$lang->review->reviewResultList['pass']        = 'Pass';
$lang->review->reviewResultList['needfix']     = 'Pass after modification';
$lang->review->reviewResultList['conditional'] = 'Conditional Pass';
$lang->review->reviewResultList['fail']        = 'Fail';

$lang->review->checkList['1']  = 'Yes';
$lang->review->checkList['0']  = 'No';
$lang->review->checkList['na'] = 'N/A';

$lang->review->resolvedList['1'] = 'Yes';
$lang->review->resolvedList['0'] = 'No';

$lang->review->typeList['all']           = 'All';
$lang->review->typeList['decision']      = 'Technical and Decision Review';
$lang->review->typeList['deliverable']   = 'Deliverable Review';
$lang->review->typeList['baseline']      = 'Baseline Review';
$lang->review->typeList['projectchange'] = 'Project Change Review';

$lang->review->featureBar['browse']['all']          = 'All';
$lang->review->featureBar['browse']['wait']         = 'My Pending Review';
$lang->review->featureBar['browse']['reviewing']    = 'Reviewing';
$lang->review->featureBar['browse']['reviewedbyme'] = 'Reviewed by Me';
$lang->review->featureBar['browse']['createdbyme']  = 'Created by Me';

$lang->review->featureBar['admin']['deliverable']   = 'Deliverable';
$lang->review->featureBar['admin']['decision']      = 'Decision';
$lang->review->featureBar['admin']['baseline']      = 'Baseline';
$lang->review->featureBar['admin']['projectchange'] = 'Project Change';

$lang->review->editFlowLabel['review']   = 'Deliverable';
$lang->review->editFlowLabel['decision'] = 'Decision';
$lang->review->editFlowLabel['baseline'] = 'Baseline';

$lang->review->baselineReviews = array();
$lang->review->baselineReviews['baseline'] = 'Baseline Review';
$lang->review->baselineReviews['change']   = 'Project Change Review';

$lang->review->resultExplainList['pass'] = 'Approved - The work is qualified, so "no modification is required" or "minor modification is required but no review is required".';
$lang->review->resultExplainList['fail'] = 'Fail - The work is not up to standard and requires major revision, after which it must be evaluated again.';

$lang->review->issue = new stdclass();
$lang->review->issue->id           = 'ID';
$lang->review->issue->summary      = 'Summary';
$lang->review->issue->desc         = 'Defect Description';
$lang->review->issue->analyse      = 'Defect Analysis';
$lang->review->issue->introAnalyse = 'Intro Analysis';
$lang->review->issue->resolvedBy   = 'Resolved by';
$lang->review->issue->deadline     = 'Deadline';
$lang->review->issue->resolvedDate = 'Resolved';
$lang->review->issue->severity     = 'Severity';
$lang->review->issue->verifiedBy   = 'Verified by';
$lang->review->issue->status       = 'Status';

$lang->review->action = new stdclass();
$lang->review->action->reviewed  = array('main' => '$date, reviewed by <strong>$actor</strong>，<strong>$extra</strong>.', 'extra' => 'resultList');
$lang->review->action->submit    = array('main' => '$date, submited review by <strong>$actor</strong>.');
$lang->review->action->recall    = array('main' => '$date, recalled by <strong>$actor</strong>.');
$lang->review->action->toaudit   = array('main' => '$date, submited audit by <strong>$actor</strong> , assigned to <strong>$extra</strong>.');
$lang->review->action->audited   = array('main' => '$date, audited by <strong>$actor</strong> , <strong>$extra</strong>.', 'extra' => 'auditResultList');

$lang->reviewresult = new stdclass();
$lang->reviewresult->consumed    = 'Consumed';
$lang->reviewresult->createdDate = 'Created Date';

$lang->review->selectApprovalText = 'Review：No.%s';

$lang->review->cannotReview       = 'Sorry, You do not have permission to review this data.';
$lang->review->cannotDeleteFlow   = 'The builtin review process cannot be deleted';
$lang->review->confirmDeleteFlow  = 'The checklist will be deleted synchronously. Do you want to continue?';
$lang->review->createDecision     = 'Please create a new review point in the stage list and the review process will be generated synchronously.';
$lang->review->deleteDecision     = 'Review points can only be deleted in the stage list.';
$lang->review->cannotReviewChange = 'Project change review does not need to configure checklists';
