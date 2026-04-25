<?php
/**
 * The effort view file of execution module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.cnezsoft.com)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      sun guangming <sunguangming@cnezsoft.com>
 * @package     execution
 * @link        https://www.zentao.net
 */
namespace zin;

$filterItems = array();
foreach($this->lang->execution->featureBar['effortcalendar'] as $period => $label)
{
    if($period == 'calendar' && !hasPriv('execution', 'effortcalendar')) continue;
    if($period != 'calendar' && !hasPriv('execution', 'effort')) break;
    $method = $period == 'calendar' ? 'effortcalendar' : 'effort';
    $vars   = $period == 'calendar' ? "executionID=$executionID" : "executionID=$executionID&date=$period&userID=$userID";
    $filterItems[] = array('text' => $label, 'url' => inlink($method, $vars), 'active' => $period == $date);
    if($period == $date) $filterItems[count($filterItems) - 1]['badge'] = $pager->recTotal;
}

featureBar
(
    set::items($filterItems),
    datePicker
    (
        setClass('ml-4 w-36'),
        set::value($today),
        set::onChange(jsRaw("(value) => {if(!value) return; loadPage($.createLink('execution', 'effort', 'executionID=$executionID&date=' + zui.formatDate(value, 'yyyyMMdd') + '&userID=$userID'))}"))
    ),
    picker
    (
        setClass('ml-4'),
        set::width(150),
        set::placeholder($users['']),
        set::items($users),
        set::value($userID),
        set::onChange(jsRaw("(val) => loadPage($.createLink('execution', 'effort', 'executionID=$executionID&date=$date&userID=' + (val || '')))"))
    )
);

$toolbarItems = array();
if(hasPriv('effort', 'export')) $toolbarItems[] = array('type' => 'ghost', 'text' => $lang->effort->export, 'icon' => 'import', 'url' => createLink('effort', 'export', "userID=$userID&orderBy=date_asc&executionID=$executionID"), 'data-toggle' => 'modal');

toolbar(set::items($toolbarItems));

$canExport = hasPriv('effort', 'export');
$consumed  = 0;
foreach($efforts as $effort) $consumed += (float)$effort->consumed;

$cols = $this->loadModel('datatable')->getSetting('execution', 'effort');

dtable
(
    set::cols($cols),
    set::data($efforts),
    set::customCols(true),
    set::userMap($accounts),
    set::checkable($canExport),
    set::checkInfo(jsRaw("function(checkedIDList){return {html: '" . sprintf($lang->company->effort->timeStat, round($consumed, 2)) . "'}}")),
    set::orderBy($orderBy),
    set::sortLink(createLink('execution', 'effort', "executionID=$executionID&date=$date&userID=$userID&orderBy={name}_{sortType}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}")),
    set::footPager(usePager()),
    set::onRenderCell(jsRaw("window.renderCell"))
);
