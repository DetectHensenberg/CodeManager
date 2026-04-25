<?php
/**
 * The browse view file of process module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun <sunguangming@easycorp.ltd>
 * @package     process
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

foreach($processList as $process)
{
    $process->desc = str_replace('&nbsp;', ' ', strip_tags($process->desc));
    if($process->module == 0) $process->module = '';
}

$cols      = $this->loadModel('datatable')->getSetting('process');
$tableData = initTableData($processList, $cols, $this->process);

if(isset($cols['module'])) $cols['module']['map'] = $modules;

featureBar
(
    set::current($browseType == 'bysearch' ? $param : 'all'),
    set::linkParams("groupID={$groupID}&browseType={key}&param={$param}&orderBy={$orderBy}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}"),
    li(searchToggle(set::open($browseType == 'bysearch')))
);

$canCreate       = hasPriv('process', 'create');
$canBatchCreate  = hasPriv('process', 'batchCreate');
$createLink      = createLink('process', 'create',      "groupID=$groupID&moduleID=$moduleID");
$batchCreateLink = createLink('process', 'batchCreate', "groupID=$groupID&moduleID=$moduleID");

$createItem      = array('text' => $lang->process->create,      'url' => $createLink, 'data-toggle' => 'modal');
$batchCreateItem = array('text' => $lang->process->batchCreate, 'url' => $batchCreateLink);
toolbar
(
    $canCreate && $canBatchCreate ? btngroup
    (
        btn(setClass('btn primary create-process-btn'), set::icon('plus'), set::url($createLink), $lang->process->create, setData(array('toggle' => 'modal'))),
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

$settingLink = hasPriv('process', 'manageModule') ? createLink('process', 'manageModule', "rootID=$groupID") : '';
sidebar
(
    moduleMenu
    (
        set::modules($moduleTree),
        set::activeKey($moduleID),
        set::allText($lang->process->allModule),
        set::settingLink($settingLink),
        set::settingText($lang->process->manageModule),
        set::isInModal(true),
        set::showDisplay(false),
        set::closeLink(createLink('process', 'browse', "groupID={$groupID}")),
        set::app($app->tab)
    )
);

$canBatchEdit = hasPriv('process', 'batchEdit');
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
                'data-formaction' => createLink('process', 'batchEdit', "groupID=$groupID"),
            )
        )
    )
);

dtable
(
    set::id('processTable'),
    set::groupDivider(true),
    set::checkable($canBatchEdit),
    set::plugins(array('sortable')),
    set::sortHandler('.move-process'),
    set::onSortEnd(jsRaw('window.onSortEnd')),
    set::cols($cols),
    set::data($tableData),
    set::orderBy($orderBy),
    set::sortLink(createLink('process', 'browse', "groupID=$groupID&browseType=$browseType&param=$param&orderBy={name}_{sortType}")),
    set::userMap($users),
    set::onRenderCell(jsRaw('window.renderProcessCell')),
    set::footPager(usePager()),
    set::footToolbar($footToolbar),
    set::emptyTip($lang->noData)
);
