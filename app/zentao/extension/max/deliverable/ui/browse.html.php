<?php
namespace zin;

if(!$hasDeliverable)
{
    $currentModuleName = $lang->deliverable->common;
    include('../../common/ext/ui/closefeaturenotice.html.php');
    return;
}

jsVar('builtinConfirm', $lang->deliverable->builtinConfirm);
featureBar
(
    set::current('all'),
    set::linkParams("groupID={$groupID}&browseType={key}&param={$param}&orderBy={$orderBy}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}"),
    li(searchToggle(set::module('deliverable'), set::open($browseType == 'bysearch')))
);

toolbar(hasPriv('deliverable', 'create') ? item(set(array
(
    'icon'     => 'plus',
    'class'    => 'primary',
    'text'     => $lang->deliverable->createAbbr,
    'data-app' => $app->tab,
    'url'      => createLink('deliverable', 'create', "groupID={$groupID}&moduleID=$moduleID")
))) : null);

foreach($moduleTree as $tree)
{
    $hasDeliverable = !empty($modulePairs[$tree->id]);
    if(hasPriv('tree', 'edit')   && !in_array($tree->extra, array_keys($lang->deliverable->buildinModule))) $tree->actions['items'][] = array('icon' => 'edit',  'hint' => $lang->edit,   'url' => createLink('tree', 'edit', "moduleID={$tree->id}&type=deliverable"), 'data-toggle' => 'modal', 'data-size' => 'sm');
    if(hasPriv('tree', 'delete') && !in_array($tree->extra, array_keys($lang->deliverable->buildinModule))) $tree->actions['items'][] = array('icon' => 'trash', 'hint' => $lang->delete, 'url' => createLink('tree', 'delete', "moduleID={$tree->id}"), 'className' => 'btn ghost toolbar-item square size-sm rounded ajax-submit', 'data-confirm' => $hasDeliverable ? array('message' => $lang->deliverable->deleteModuleConfirm, 'actions' => 'cancel') : null);
}

sidebar
(
    moduleMenu
    (
        set::modules($moduleTree),
        set::activeKey($moduleID),
        set::closeLink(createLink('deliverable', 'browse', "id={$groupID}")),
        set::createModuleLink(hasPriv('tree', 'create') ? createLink('tree', 'create', "rootID={$groupID}&viewType=deliverable") : null),
        set::settingText($lang->deliverable->moduleSetting),
        set::showDisplay(false),
        set::app('admin')
    )
);

$cols = $this->loadModel('datatable')->getSetting('deliverable');
if(!$hasProcess)
{
    unset($cols['activity']);
    unset($cols['trimmable']);
    unset($cols['trimRule']);
}

$activities[0] = '';
if(isset($cols['activity'])) $cols['activity']['map'] = $activities;
if(isset($cols['module']))   $cols['module']['map']   = $modules;

$summary   = sprintf($lang->deliverable->typeLang->summary, count($deliverables));
$tableData = initTableData($deliverables, $cols, $this->deliverable);
$data      = array();
foreach($tableData as $key => $row)
{
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
    set::cols($cols),
    set::data($data),
    set::userMap($users),
    set::orderBy($orderBy),
    set::customCols(array('url' => createLink('datatable', 'ajaxcustom', "module=deliverable&method=browse&extra=$groupID"))),
    set::plugins(array('cellspan')),
    set::checkable(false),
    set::sortLink(createLink('deliverable', 'browse', "groupID={$groupID}&browseType=$browseType&param={$param}&orderBy={name}_{sortType}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}")),
    set::getCellSpan(jsRaw('window.getCellSpan')),
    set::onRenderCell(jsRaw('window.onRenderCell')),
    set::footer(array($summary, 'flex', 'pager')),
    set::footPager(usePager(array
    (
        'recTotal'    => $pager->recTotal,
        'recPerPage'  => $pager->recPerPage,
        'linkCreator' => helper::createLink('deliverable', 'browse', "groupID={$groupID}&browseType=$browseType&param={$param}&orderBy=$orderBy&recTotal={$pager->recTotal}&recPerPage={recPerPage}&page={page}")
    )))
);
