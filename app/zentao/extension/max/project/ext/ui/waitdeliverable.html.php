<?php
namespace zin;

jsVar('canViewProgress', hasPriv('approval', 'progress'));
jsVar('viewApprovalProgress', $lang->project->viewApprovalProgress);

featureBar
(
    set::current($browseType),
    set::linkParams("projectID={$projectID}&browseType={key}&param={$param}&orderBy={$orderBy}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}")
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

$cols = $config->project->waitDeliverable->dtable->fieldList;
$activities[0] = '';
if(isset($cols['activity'])) $cols['activity']['map'] = $activities;

$summary   = sprintf($lang->deliverable->summary, count($deliverables));
$tableData = initTableData($deliverables, $cols, $this->project);
$data      = array();
foreach($tableData as $key => $row)
{
    $row->project = $projectID;
    $row->desc    = str_replace('&nbsp;', ' ', strip_tags($row->desc));
    if(!empty($row->stages))
    {
        foreach($row->stages as $stage)
        {
            $row->stage    = zget($stageList, $stage->stage, '');
            $row->required = zget($lang->deliverable->requiredList, $stage->required, '');
            $row->rowspan  = count($row->stages);
            $data[] = clone $row;
        }
    }
    else
    {
        $data[] = $row;
    }
}

dtable
(
    set::id('waitdeliverable'),
    set::cols($cols),
    set::data($data),
    set::userMap($users),
    set::orderBy($orderBy),
    set::checkable(false),
    set::plugins(array('cellspan')),
    set::getCellSpan(jsRaw('window.getCellSpan')),
    set::sortLink(createLink('project', 'deliverable', "projectID={$projectID}&browseType=$browseType&param={$param}&orderBy={name}_{sortType}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}")),
    set::footer(array($summary, 'flex', 'pager')),
    set::footPager(usePager(array
    (
        'recTotal'    => $pager->recTotal,
        'recPerPage'  => $pager->recPerPage,
        'linkCreator' => helper::createLink('project', 'deliverable', "projectID={$projectID}&browseType=$browseType&param={$param}&orderBy=$orderBy&recTotal={$pager->recTotal}&recPerPage={recPerPage}&page={page}")
    )))
);
