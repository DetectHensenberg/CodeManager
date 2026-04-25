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

if($config->vision == 'lite') include 'header.html.php';

$canCreateTask = hasPriv('task', 'create', (object)['execution' => $executionID]);
$canExportTask = hasPriv('task', 'export');
$createLink    = createLink('task', 'create', "execution=$executionID" . (isset($moduleID) ? "&storyID=&moduleID=$moduleID" : ''));

featureBar();

$toolbarItems = [];
$toolbarItems[] = ['type' => 'ghost', 'text' => $lang->task->export, 'icon' => 'import', 'disabled' => !$canExportTask, 'url' => $canExportTask ? createLink('task', 'export', "execution=$executionID&orderBy=$orderBy&type=calendar") : '#', 'data-toggle' => 'modal', 'data-size' => 620];
if($canCreateTask) $toolbarItems[] = ['type' => 'primary', 'text' => $lang->task->create, 'icon' => 'plus', 'url' => $createLink];

toolbar(set::items($toolbarItems));

$waitTaskLists = [];
foreach($events as $i => $task)
{
    if($task['status'] != 'wait') continue;
    $waitTaskLists[] = (object)$task;
}

sidebar
(
    set::side('right'),
    set::width(280),
    panel
    (
        set::title($lang->task->waitTask),
        set::bodyClass('pt-0 overflow-y-auto scrollbar-hover'),
        set::bodyProps(['style' => ['max-height' => 'calc(100vh - 130px)']]),
        entitylist
        (
            set::type('task'),
            set::items($waitTaskLists)
        )
    )
);

panel
(
    zui::calendar
    (
        set::_id('calendar'),
        set::tasks($events),
        set::hideEmptyWeekends(),
        set('$options', jsRaw('window.setCalendarOptions'))
    )
);
