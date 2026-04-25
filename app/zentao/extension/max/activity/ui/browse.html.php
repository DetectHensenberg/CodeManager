<?php
/**
 * The browse view file of activity module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang <wangyuting@easycorp.ltd>
 * @package     activity
 * @link        https://www.zentao.net
 */
namespace zin;

if(!$hasProcess)
{
    $currentModuleName = $lang->process->common;
    include('../../common/ext/ui/closefeaturenotice.html.php');
    return;
}

jsVar('groupID', $groupID);
jsVar('browseType', $browseType);
jsVar('param', $param);
jsVar('orderBy', $orderBy);
jsVar('sortHint', $lang->activity->sortHint);

$cols = $this->loadModel('datatable')->getSetting('activity');
if(!empty($cols['process'])) $cols['process']['map'] = $processes;
if($browseType == 'all') unset($cols['order']);
$activities = initTableData($activities, $cols, $this->activity);

$canCreate       = hasPriv('activity', 'create');
$canBatchCreate  = hasPriv('activity', 'batchCreate');
$createLink      = createLink('activity', 'create',      "groupID=$groupID&processID=" . ($browseType == 'byprocess' ? $param : 0));
$batchCreateLink = createLink('activity', 'batchCreate', "groupID=$groupID&processID=" . ($browseType == 'byprocess' ? $param : 0));

$createItem      = array('text' => $lang->activity->create,      'url' => $createLink, 'data-toggle' => 'modal');
$batchCreateItem = array('text' => $lang->activity->batchCreate, 'url' => $batchCreateLink);

featureBar
(
    set::current($browseType == 'bysearch' ? $param : 'all'),
    set::linkParams("groupID={$groupID}&browseType={key}&param={$param}&orderBy={$orderBy}&scrollButtom=0&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}"),
    li(searchToggle(set::open($browseType == 'bysearch')))
);
toolbar
(
    $canCreate && $canBatchCreate ? btngroup
    (
        btn(setClass('btn primary create-activity-btn'), set::icon('plus'), set::url($createLink), $lang->activity->create, setData(array('toggle' => 'modal'))),
        dropdown
        (
            btn(setClass('btn primary dropdown-toggle'), setStyle(array('padding' => '6px', 'border-radius' => '0 2px 2px 0'))),
            set::items(array($createItem, $batchCreateItem)),
            set::placement('bottom-end')
        )
    ) : null,
    $canCreate && !$canBatchCreate ? item(set($createItem      + array('class' => 'btn primary', 'icon' => 'plus'))) : null,
    $canBatchCreate && !$canCreate ? item(set($batchCreateItem + array('class' => 'btn primary', 'icon' => 'plus'))) : null
);

sidebar
(
    moduleMenu
    (
        set::modules($moduleTree),
        set::activeKey($moduleID),
        set::allText($lang->activity->allProcesses),
        set::settingLink(''),
        set::showDisplay(false),
        set::closeLink(createLink('activity', 'browse', "groupID={$groupID}")),
        set::app($app->tab)
    )
);

$canBatchEdit = hasPriv('activity', 'batchEdit');
$footToolbar = array
(
    array
    (
        'type' => 'btn-group',
        'items' => array
        (
            array
            (
                'text' => $lang->edit,
                'className' => 'secondary batch-btn',
                'data-page' => 'batch',
                'data-formaction' => createLink('activity', 'batchEdit', "groupID=$groupID"),
            )
        )
    )
);

dtable
(
    set::id('activities'),
    set::plugins(array('sortable')),
    set::cols($cols),
    set::data(array_values($activities)),
    set::checkable($canBatchEdit),
    set::userMap($users),
    set::customCols(true),
    set::orderBy($orderBy),
    set::sortHandler('.move-process'),
    set::sortable($orderBy == 'order_asc'),
    set::onSortEnd($orderBy == 'order_asc' ? jsRaw('window.onSortEnd') : null),
    set::sortLink(inlink('browse', "groupID={$groupID}&browseType={$browseType}&param={$param}&orderBy={name}_{sortType}&scrollButtom=0&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}")),
    set::onRenderCell(jsRaw('window.renderActivityCell')),
    set::afterRender($scrollButtom ? jsRaw("function(firstRender) {if(firstRender) this.scroll({to: 'bottom'});}") : null),
    set::footToolbar($footToolbar),
    set::footPager(usePager())
);
