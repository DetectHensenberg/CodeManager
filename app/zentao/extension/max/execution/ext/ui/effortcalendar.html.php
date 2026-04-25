<?php
/**
 * The calendar view file of execution module of ZenTaoPMS.
 *
 * @copyright   Copyright 2026 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@chandao.com>
 * @package     execution
 * @version     $Id: editrelation.html.php 935 2024-08-08 15:14:24Z $
 * @link        https://www.zentao.net
 */
namespace zin;

$filterItems = [];
foreach($this->lang->execution->featureBar['effortcalendar'] as $period => $label)
{
    if($period != 'calendar' and !hasPriv('execution', 'effort')) break;
    $method = $period == 'calendar' ? 'effortcalendar' : 'effort';
    $vars   = $period == 'calendar' ? "executionID=$executionID" : "executionID=$executionID&date=$period";
    $filterItems[] = ['text' => $label, 'url' => inlink($method, $vars), 'active' => $period == 'calendar'];
}

featureBar
(
    set::items($filterItems),
    picker(setClass('ml-4'), set::width(150), set::placeholder($users['']), set::items($users), set::value($userID), set::onChange(jsRaw("(val) => changeUser($executionID, val)")))
);

$toolbarItems = [];
if(hasPriv('effort', 'export')) $toolbarItems[] = ['type' => 'ghost', 'text' => $lang->effort->export, 'icon' => 'import', 'zui-on-click' => ['call' => 'exportCalendar', 'params' => [createLink('effort', 'export', "userID=$userID&orderBy=date_desc&date=_date_&executionID=$executionID")]]];
toolbar(set::items($toolbarItems));

panel
(
    zui::calendar
    (
        set::_id('calendar'),
        set::hideEmptyWeekends(),
        set::ajaxGetEffortsUrl(createLink('execution', 'ajaxGetEfforts', "executionID=$executionID&userID=$userID&year={year}")),
        set::effortViewUrl(createLink('effort', 'view', 'id={id}')),
        set::textNetworkError($lang->textNetworkError),
        set('$options', jsRaw('window.setCalendarOptions'))
    )
);
