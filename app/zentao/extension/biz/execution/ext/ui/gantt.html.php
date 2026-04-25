<?php
/**
 * The gantt view file of execution module of ZenTaoPMS.
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

jsVar('executionID', $executionID);

$ganttLang = new stdclass();
$ganttLang->exporting           = $lang->programplan->exporting;
$ganttLang->exportFail          = $lang->programplan->exportFail;
$ganttLang->zooming             = $lang->execution->gantt->zooming;
$ganttLang->hideCriticalPath    = $lang->programplan->hideCriticalPath;
$ganttLang->showCriticalPath    = $lang->programplan->showCriticalPath;
$ganttLang->fullScreen          = $lang->execution->gantt->fullScreen;
$ganttLang->taskStatusList      = $lang->task->statusList;
$ganttLang->ganttSetting        = $lang->execution->ganttSetting;
$ganttLang->edit                = $lang->programplan->edit;
$ganttLang->submit              = $lang->programplan->submit;
$ganttLang->today               = $lang->programplan->today;
$ganttLang->scrollToToday       = $lang->execution->gantt->scrollToToday;
$ganttLang->deleteRelation      = $lang->execution->gantt->confirmDelete;
$ganttLang->errorTaskDrag       = $lang->programplan->error->taskDrag;
$ganttLang->errorPlanDrag       = $lang->programplan->error->planDrag;
$ganttLang->wrongRelation       = $lang->execution->error->wrongGanttRelation;
$ganttLang->wrongRelationSource = $lang->execution->error->wrongGanttRelationSource;
$ganttLang->wrongRelationTarget = $lang->execution->error->wrongGanttRelationTarget;
$ganttLang->wrongKanbanTasks    = $lang->execution->error->wrongKanbanTasks;
$ganttLang->warningNoToday      = $lang->execution->gantt->warning->noTodayMarker;

$fileName = ($execution->type == 'stage' ? "$project->name-" : '') . $executionName . '-' . $lang->execution->ganttchart;

$typeHtml  = '<span class="toggle-all-icon"><i class="icon-expand-alt"></i></span><a data-toggle="dropdown" href="#browseTypeList"><span class="text">' . $lang->execution->gantt->browseType[$ganttType] . '</span><span class="caret"></span></a>';
$typeHtml .= '<menu class="dropdown-menu menu" id="browseTypeList">';
foreach($lang->execution->gantt->browseType as $ganttBrowseType => $typeName)
{
    $link = createLink('execution', 'gantt', "executionID=$executionID&type=$ganttBrowseType");
    $typeHtml .= '<li class="menu-item' . ($ganttType == $ganttBrowseType ? " active" : '') . '">' . html::a($link, $typeName, '', "class='item-content'") . '</li>';
}
$typeHtml .= '</menu>';

$notSort = array('delay', 'delayDays');
$ganttFields = [];
$ganttFields['column_text']       = $typeHtml;
$ganttFields['column_percent']    = $lang->execution->ganttCustom['progress'];
$ganttFields['column_start_date'] = array('text' => $lang->execution->ganttCustom['begin']);
$ganttFields['column_end_date']   = array('text' => $lang->execution->gantt->endDate);
foreach($lang->execution->ganttCustom as $field => $name)
{
    if($field == 'progress') continue;

    $ganttField = "column_{$field}";
    if(isset($ganttFields[$ganttField])) continue;
    $ganttFields[$ganttField] = in_array($field, $notSort) ? $name : array('text' => $name);
}

list($orderField, $orderDirect) = $this->execution->parseOrderBy($orderBy);
foreach($ganttFields as $colName => $value)
{
    $field = str_replace('column_', '', $colName);
    if(is_null($value) || is_array($value))
    {
        list($fieldOrderBy, $fieldClass) = $this->execution->buildKanbanOrderBy($field, $orderField, $orderDirect);
        $text  = (is_array($value) && !empty($value['text'])) ? $value['text'] : $lang->execution->ganttCustom[$field];
        $value = \html::a(createLink('execution', 'gantt', "executionID=$executionID&type=$ganttType&orderBy=$fieldOrderBy"), $text, '', "class='$fieldClass'");
    }

    $ganttFields[$colName] = $value;
}

h::css("#browseTypeList .menu-item .item-content{height:30px;}");
h::css("#browseTypeList .menu-item.active .item-content{color: var(--menu-selected-color); font-weight: 700;}");
h::css("#browseTypeList .menu-item.active .item-content:hover{color: #fff;}");

$hasGanttType = isset($ganttType);

featureBar
(
    $hasGanttType ? btn
    (
        setID('criticalPath'),
        setClass('mr-2'),
        set::type('ghost'),
        on::click()->call('updateCriticalPath'),
        setData('showText', $lang->execution->gantt->showCriticalPath),
        setData('hideText', $lang->execution->gantt->hideCriticalPath),
        $lang->execution->gantt->showCriticalPath
    ) : null,
    $hasGanttType ? btn
    (
        setID('fullScreenBtn'),
        setClass('mr-4'),
        set::type('ghost'),
        set::icon('fullscreen'),
        on::click()->call('enterGanttFullscreen'),
        $lang->execution->gantt->fullScreen
    ) : null,
    $hasGanttType ? null : btn
    (
        set::type('secondary'),
        set::url('execution', 'gantt', "executionID=$executionID"),
        $lang->goback
    ),
    div
    (
        setID('ganttPris'),
        setClass('row gap-2'),
        strong($lang->task->pri . " : "),
        array_map(function($pri, $color)
        {
            if($pri <= 0 || $pri > 4) return null;
            return span(setClass('h-5 w-5 center'), style::background($color), $pri);
        }, array_keys($lang->execution->gantt->progressColor), $lang->execution->gantt->progressColor)
    )
);

$toolbarItems = [];
if($hasGanttType)
{
    if(hasPriv('execution', 'ganttsetting')) $toolbarItems[] = ['type' => 'ghost', 'text' => $lang->execution->ganttSetting, 'icon' => 'cog-outline muted', 'url' => createLink('execution', 'ganttsetting', "executionID=$executionID"), 'data-toggle' => 'modal', 'data-size' => '45%'];
    if(hasPriv('execution', 'relation') && $config->vision != 'lite') $toolbarItems[] = ['type' => 'ghost', 'text' => $lang->execution->maintainRelation, 'icon' => 'list-alt muted', 'url' => createLink('execution', 'relation', "executionID=$executionID") . "#app={$app->tab}"];
}
if($this->app->rawMethod != 'relation' and $this->app->rawMethod != 'maintainrelation')
{
    $exportItems = [];
    $exportItems[] = ['text' => $lang->execution->gantt->exportImg, 'url' => 'javascript:exportGantt()'];
    $exportItems[] = ['text' => $lang->execution->gantt->exportPDF, 'url' => 'javascript:exportGantt("pdf")'];
    $toolbarItems[] = ['text' => $lang->export, 'icon' => 'export muted', 'type' => 'dropdown', 'items' => $exportItems];
}
elseif(hasPriv('execution', 'maintainRelation'))
{
    $toolbarItems[] = ['type' => 'secondary', 'text' => $lang->execution->gantt->editRelationOfTasks, 'icon' => 'plus', 'url' => createLink('execution', 'maintainRelation', "executionID=$executionID")];
}

$checkObject = new stdclass();
$checkObject->execution = $executionID;
$canCreateTask = hasPriv('task', 'create', $checkObject);
$toolbarItems[] = ['type' => 'primary', 'disabled' => !$canCreateTask, 'text' => $lang->task->create, 'icon' => 'plus', 'url' => $canCreateTask ? createLink('task', 'create', "execution=$executionID" . (isset($moduleID) ? "&storyID=&moduleID=$moduleID" : '')) : null, 'data-toggle' => 'modal', 'data-size' => 'lg'];

toolbar(set::items($toolbarItems));

gantt
(
    set('ganttLang', $ganttLang),
    set('ganttFields', $ganttFields),
    set('canEdit', hasPriv('execution', 'ganttEdit')),
    set('zooming', !empty($zooming) ? $zooming : 'day'),
    set('users', $users),
    set('showFields', str_replace('assignedTo', 'owner_id', $config->execution->ganttCustom->ganttFields)),
    set::exportFileName($fileName),
    set::weekend(array('weekend' => zget($config->execution, 'weekend', 2), 'restDay' => zget($config->execution, 'restDay', 0))),
    set('options', $executionData)
);
