<?php
/**
 * The browse view file of review module of ZenTaoPMS.
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Mengyi Liu
 * @package     review
 * @link        https://www.zentao.net
 */
namespace zin;

if($project->model != 'ipd') unset($lang->review->typeList['decision']);

jsVar('canEditCM',     hasPriv('cm', 'edit'));
jsVar('canEditChange', hasPriv('projectchange', 'edit'));

$viewName = $lang->review->typeList[$type];
$items    = array();
foreach($lang->review->typeList as $key => $value)
{
    if(!$hasDeliverable && $key == 'deliverable') continue;
    if(!$hasBaseline && $key == 'baseline') continue;
    if(!$hasProjectchange && $key == 'projectchange') continue;
    $items[] = array('text' => $value, 'url' => createLink('review', 'browse', "projectID={$projectID}&type={$key}&browseType={$browseType}&orderBy={$orderBy}&param={$param}&recTotal={$recTotal}&recPerPage={$recPerPage}&pageID={$pageID}"));
}

$dropdown = in_array($project->model, array('scrum', 'agileplus')) ? null : dropdown
(
    to('trigger', btn($viewName, setClass('ghost'))),
    set::items($items)
);

$queryMenuLink = createLink('review', 'browse', "projectID={$projectID}&type={$type}&browseType={$browseType}&orderBy={$orderBy}&param={queryID}");
featureBar
(
    to::before($dropdown),
    set::current($browseType),
    set::linkParams("project={$projectID}&type={$type}&browseType={key}&orderBy={$orderBy}&param={$param}&recTotal={$recTotal}&recPerPage={$recPerPage}&pageID={$pageID}"),
    set::queryMenuLinkCallback(array(function ($key) use ($queryMenuLink) {
        return str_replace('{queryID}', (string)$key, $queryMenuLink);
    })),
    li(searchToggle(set::open($browseType == 'bysearch')))
);

$canBeChanged = common::canModify('project', $project);
if(in_array($project->model, array('scrum', 'aglieplus')) && !hasPriv('review', 'submitdeliverable')) $canBeChanged = false;

if(!isInModal())
{
    toolbar
    (
        $canBeChanged && hasPriv('review', 'create') ? btn
        (
            setClass('primary review-create-btn'),
            set::icon('plus'),
            set::url(createLink('review', 'create', "project={$projectID}")),
            $lang->review->create
        ) : null
    );
}

$cols = $this->loadModel('datatable')->getSetting('review');

if($browseType == 'reviewing' || $browseType == 'done')
{
    $checkInfo = sprintf($lang->review->pageSummary, count($reviewList));
}
else
{
    $waitReviews = $reviewingReviews = $passReviews = $auditingReviews = $doneReviews = 0;
    foreach($reviewList as $review)
    {
        if($review->status === 'draft')     $waitReviews ++;
        if($review->status === 'reviewing') $reviewingReviews ++;
        if($review->status === 'pass')      $passReviews ++;
    }
    $checkInfo = str_replace(array('%total%', '%wait%', '%reviewing%', '%pass%'), array(count($reviewList), $waitReviews, $reviewingReviews, $passReviews), $lang->review->pageAllSummary);
}

$reviewList = initTableData($reviewList, $cols, $this->review);
foreach($reviewList as $reviewID => $review)
{
    $review->rawCategory = $review->category;
    if($review->type == 'baseline') $review->category = $lang->review->typeList['baseline'];
    if($review->type == 'projectchange') $review->category = $lang->review->typeList['projectchange'];
    if($review->type == 'decision' && $review->category) $review->category = zget($pointPairs, $review->category, '');
    if($review->type == 'deliverable' && $review->category) $review->category = zget($deliverablePairs, $review->category, '');
    if(!empty($review->reviewedBy))
    {
        $reviewedBy = array();
        foreach(explode(',', $review->reviewedBy) as $reviewer)
        {
            if(!$reviewer) continue;
            $reviewedBy[$reviewer] = $users[$reviewer];
        }
        $reviewList[$reviewID]->reviewedBy = implode(',', array_filter($reviewedBy));
    }
    foreach($review->actions as $actionID => $action)
    {
        if($action['name'] == 'recall' && $review->status == 'reviewing' && $this->approval->canCancel($review)) $reviewList[$reviewID]->actions[$actionID]['disabled'] = false;
        if($action['name'] == 'progress' && empty($review->approval)) $reviewList[$reviewID]->actions[$actionID]['disabled'] = true;
    }
}

dtable
(
    set::cols($cols),
    set::data(array_values($reviewList)),
    set::userMap($users),
    set::customCols(true),
    set::checkable(false),
    set::orderBy($orderBy),
    set::sortLink(inlink('browse', "project={$projectID}&type={$type}&browseType={$browseType}&orderBy={name}_{sortType}&param={$param}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}")),
    set::checkInfo(jsRaw("function(checkedIDList){return {html: '{$checkInfo}'}}")),
    set::footPager(usePager()),
    set::onRenderCell(jsRaw('window.renderCellCallback')),
    set::footer(array($checkInfo, 'flex','pager')),
    set::createTip($lang->review->create),
    set::createLink($canBeChanged && hasPriv('review', 'create') ? createLink('review', 'create', "project={$projectID}") : '')
);

render();
