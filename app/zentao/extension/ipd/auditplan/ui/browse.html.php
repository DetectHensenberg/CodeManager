<?php
/**
 * The browse view file of auditplan module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang <wangyuting@easycorp.ltd>
 * @package     auditplan
 * @link        https://www.zentao.net
 */
namespace zin;


$app->loadLang('activity');
$cols = $this->loadModel('datatable')->getSetting('auditplan');
if(!empty($cols['execution'])) $cols['execution']['map'] = $executions;

$auditplans = initTableData($auditplans, $cols, $this->auditplan);
foreach($auditplans as $auditplan)
{
    foreach($auditplan->actions as $index => $action)
    {
        if($action['name'] == 'createNc')
        {
            $action['disabled'] = true;
            if(hasPriv('nc', 'create') && $auditplan->status == 'wait' && $browseType != 'iscycle' && $auditplan->objectType != 'zoutput') $action['disabled'] = false;
            $auditplan->actions[$index] = $action;
        }
    }
}

$canModify       = common::canModify('project', $project);
$canCreate       = hasPriv('auditplan', 'create')      && $canModify;
$canBatchCreate  = hasPriv('auditplan', 'batchCreate') && $canModify;
$createLink      = createLink('auditplan', 'create',      "projectID={$projectID}") . "#app={$app->tab}";
$batchCreateLink = createLink('auditplan', 'batchCreate', "projectID={$projectID}") . "#app={$app->tab}";
$createItem      = array('text' => $lang->auditplan->create,      'url' => $createLink, 'data-toggle' => 'modal');
$batchCreateItem = array('text' => $lang->auditplan->batchCreate, 'url' => $batchCreateLink);
$canBatchEdit    = hasPriv('auditplan', 'batchEdit')  && $canModify;
$canBatchCheck   = hasPriv('auditplan', 'batchCheck') && $canModify;

$queryMenuLink = inlink('browse', "projectID={$projectID}&browseType=bysearch&param={queryID}");
featureBar
(
    set::current($browseType),
    set::linkParams("projectID={$projectID}&browseType={key}&param=" . ($browseType == 'bysearch' ? 0 : $param)),
    set::queryMenuLinkCallback(array(function ($key) use ($queryMenuLink) {
        return str_replace('{queryID}', (string)$key, $queryMenuLink);
    })),
    li(searchToggle(set::open($browseType == 'bysearch')))
);
toolbar
(
    $canCreate && $canBatchCreate ? btngroup
    (
        btn(setClass('btn primary create-activity-btn'), set::icon('plus'), set::url($createLink), $lang->auditplan->create, setData(array('toggle' => 'modal'))),
        dropdown
        (
            btn(setClass('btn primary dropdown-toggle'), setStyle(array('padding' => '6px', 'border-radius' => '0 2px 2px 0'))),
            set::items(array($createItem, $batchCreateItem)),
            set::placement('bottom-end')
        )
    ) : null,
    $canCreate && !$canBatchCreate ? item(set($createItem      + array('class' => 'btn primary', 'icon' => 'plus', 'data-toggle' => 'modal'))) : null,
    $canBatchCreate && !$canCreate ? item(set($batchCreateItem + array('class' => 'btn primary', 'icon' => 'plus'))) : null
);

$footToolbar = array();
if($canBatchEdit)  $footToolbar['items'][] = array('text' => $lang->edit, 'className' => 'primary batch-btn', 'data-url' => createLink('auditplan', 'batchEdit', "projectID={$projectID}"));
if($canBatchCheck) $footToolbar['items'][] = array('text' => $lang->auditplan->batchCheck, 'className' => 'primary batch-btn', 'data-url' => createLink('auditplan', 'batchCheck', "projectID={$projectID}"));

sidebar
(
    moduleMenu
    (
        set::modules($moduleTree),
        set::activeKey($moduleID),
        set::allText($lang->activity->allProcesses),
        set::settingLink(''),
        set::showDisplay(false),
        set::closeLink(createLink('auditplan', 'browse', "projectID={$projectID}&browseType={$browseType}")),
        set::app($app->tab)
    )
);

dtable
(
    set::id('auditplan'),
    set::customCols(true),
    set::checkable($canBatchEdit || $canBatchCheck ? true : false),
    set::data($auditplans),
    set::cols($cols),
    set::userMap($users),
    set::sortLink(inlink('browse', "projectID={$projectID}&browseType={$browseType}&param={$param}&orderBy={name}_{sortType}")),
    set::onRenderCell(jsRaw('window.onRenderCell')),
    set::footToolbar($footToolbar),
    set::footPager(usePager())
);
