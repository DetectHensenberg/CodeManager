<?php
namespace zin;

jsVar('canViewProgress', hasPriv('approval', 'progress'));
jsVar('viewApprovalProgress', $lang->project->viewApprovalProgress);
jsVar('deliverableFrozenTips', $lang->project->deliverableFrozenTips);
jsVar('updateVersionLang', $lang->project->updateVersion);

featureBar
(
    set::current($browseType),
    set::linkParams("projectID={$projectID}&browseType={key}&param={$param}&orderBy={$orderBy}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}"),
    li(searchToggle(set::module('projectDeliverable'), set::open($browseType == 'bysearch')))
);

toolbar(hasPriv('project', 'createDeliverable') ? item(set(array
(
    'icon'        => 'plus',
    'class'       => 'primary',
    'text'        => $lang->project->createDeliverableAbbr,
    'data-toggle' => 'modal',
    'url'         => createLink('project', 'createDeliverable', "id={$projectID}")
))) : null);

sidebar
(
    moduleMenu
    (
        set::modules($moduleTree),
        set::activeKey($moduleID),
        set::closeLink(createLink('project', 'deliverable', "id={$projectID}")),
        set::settingText($lang->deliverable->moduleSetting),
        set::showDisplay(false),
        set::app('project')
    )
);

$cols      = $this->loadModel('datatable')->getSetting('project', 'deliverable');
$summary   = sprintf($lang->deliverable->summary, count($deliverables));
$tableData = initTableData($deliverables, $cols, $this->project);

foreach($tableData as $key => $row)
{
    $tableData[$key]->rawStatus = $row->status;
    if($row->hasApproval == 0)
    {
        $tableData[$key]->status = $row->status == 'pass' ? $lang->project->confirmed : $lang->project->needConfirm;
    }
    else
    {
        $tableData[$key]->status = zget($lang->review->statusList, $row->status);
    }
}

if(isset($cols['submitFrom'])) $cols['submitFrom']['map'] = $this->project->getSubmitFromPairs($projectID);
if(in_array($project->model, array('scrum', 'agileplus'))) unset($cols['isBaseline']);

dtable
(
    set::id('deliverable'),
    set::cols($cols),
    set::data($tableData),
    set::userMap($users),
    set::orderBy($orderBy),
    set::customCols(true),
    set::checkable(false),
    set::sortLink(createLink('project', 'deliverable', "projectID={$projectID}&browseType=$browseType&param={$param}&orderBy={name}_{sortType}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}")),
    set::footer(array($summary, 'flex', 'pager')),
    set::onRenderCell(jsRaw('window.onRenderCell')),
    set::footPager(usePager(array
    (
        'recTotal'    => $pager->recTotal,
        'recPerPage'  => $pager->recPerPage,
        'linkCreator' => helper::createLink('project', 'deliverable', "projectID={$projectID}&browseType=$browseType&param={$param}&orderBy=$orderBy&recTotal={$pager->recTotal}&recPerPage={recPerPage}&page={page}")
    )))
);
