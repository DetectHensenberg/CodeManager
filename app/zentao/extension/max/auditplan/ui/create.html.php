<?php
/**
 * The create file of auditplan module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     auditplan
 * @link        https://www.zentao.net
 */
namespace zin;

$fields = defineFieldList('auditplan');
$fields->field('execution')->control('picker')->items($executions)->value(!empty($executionID) ? $executionID : '')->width('full');
$fields->field('process')->required(true)->control(array('control' => 'picker', 'required' => false))->items($processList)->width('full');
$fields->field('objectID')->required(true)->control(array('control' => 'picker', 'required' => false))->items($activityList)->width('full');

$formBatchItems = array();
$formBatchItems[] = array('label' => $lang->auditplan->checkDate,  'name' => 'checkDateList',  'control' => 'date', 'checkboxName' => 'isCycle', 'checkboxValue' => '1', 'checkboxChecked' => $isCycle, 'checkboxText' => $lang->auditplan->isCycle);
$formBatchItems[] = array('label' => $lang->auditplan->assignedTo, 'name' => 'assignedToList', 'control' => 'picker', 'items' => $users);
if(!empty($isCycle))
{
    $fields->field('checkDateBox')->label($lang->auditplan->checkDate)->checkbox(array('text' => $lang->auditplan->isCycle, 'name' => 'isCycle', 'value' => '1', 'checked' => $isCycle))->control(array('control' => 'radioList', 'items' => $lang->auditplan->cycleList, 'inline' => true, 'name' => 'cycleType', 'value' => $cycleType))->width('full');

}
else
{
    $fields->field('checkDateBox')->control(array('control' => 'formBatch', 'minRows' => '2', 'tagName' => 'div', 'actions' => array(), 'items' => $formBatchItems))->width('full');
}

if($cycleType == 'day')
{
    $fields->field('cycleConfig')
        ->required(true)
        ->control('inputGroup')
        ->itemBegin()->control('btn')->text($lang->auditplan->from)->itemEnd()
        ->itemBegin()->control('datePicker')->name('cycleConfig[fromDate]')->itemEnd()
        ->itemBegin()->control('btn')->text($lang->auditplan->interval)->itemEnd()
        ->itemBegin()->control('input')->name('cycleConfig[interval]')->type('number')->min(1)->step(1)->itemEnd()
        ->itemBegin()->control('btn')->text($lang->auditplan->day)->itemEnd()
        ->itemBegin()->control('input')->name('cycleConfig[]')->className('hidden')->itemEnd()
        ->hidden(empty($isCycle))
        ->width('full');
}
elseif($cycleType == 'week')
{
    $fields->field('cycleConfig')
        ->required(true)
        ->control('inputGroup')
        ->itemBegin()->control('btn')->text($lang->auditplan->weekly)->itemEnd()
        ->itemBegin()->control('picker')->name('cycleConfig[week]')->items($lang->auditplan->weekList)->multiple(true)->itemEnd()
        ->itemBegin()->control('input')->name('cycleConfig[]')->className('hidden')->itemEnd()
        ->hidden(empty($isCycle))
        ->width('full');
}
elseif($cycleType == 'month')
{
    $fields->field('cycleConfig')
        ->required(true)
        ->control('inputGroup')
        ->itemBegin()->control('btn')->text($lang->auditplan->monthly)->itemEnd()
        ->itemBegin()->control('picker')->name('cycleConfig[month]')->items($lang->auditplan->monthList)->multiple(true)->itemEnd()
        ->itemBegin()->control('input')->name('cycleConfig[]')->className('hidden')->itemEnd()
        ->hidden(empty($isCycle))
        ->width('full');
}

$fields->field('cyclePlan')
    ->required(true)
    ->label($lang->auditplan->cyclePlan)
    ->control('inputGroup')
    ->itemBegin()->control('btn')->text($lang->auditplan->advance)->itemEnd()
    ->itemBegin()->control('input')->type('number')->min(0)->step(1)->name('cyclePlan')->itemEnd()
    ->itemBegin()->control('btn')->text($lang->auditplan->day)->itemEnd()
    ->hidden(empty($isCycle))
    ->width('full');

$fields->field('deadline')
    ->control('datePicker')
    ->name('deadline')
    ->hidden(empty($isCycle))
    ->width('full');

$fields->field('assignedTo')
    ->required(true)
    ->control(array('control' => 'picker', 'required' => false))
    ->name('assignedTo')
    ->items($users)
    ->hidden(empty($isCycle))
    ->width('full');

if($app->tab == 'execution') $fields->autoLoad('execution', 'process,objectID');
$fields->autoLoad('process', 'objectID');
$fields->autoLoad('isCycle', 'checkDateBox,cycleConfig,cyclePlan,deadline,assignedTo');
$fields->autoLoad('cycleType', 'cycleConfig');

formPanel
(
    to::heading(div(setClass('panel-title text-lg'), $title, !empty($isUpgrade) ? span(setClass('font-normal text-sm'), $lang->auditplan->upgradeTip) : null)),
    set::layout('grid'),
    set::fields($fields),
    set::loadUrl(createLink('auditplan', 'create', $app->tab == 'execution' ? "projectID={execution}&processID={process}&isCycle={isCycle}&cycleType={cycleType}" : "projectID={$projectID}&processID={process}&isCycle={isCycle}&cycleType={cycleType}"))
);
