<?php
/**
 * The edit file of auditplan module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     auditplan
 * @link        https://www.zentao.net
 */
namespace zin;

if(!empty($auditplan->cycleConfig)) $cycleConfig = json_decode($auditplan->cycleConfig);
$auditplan->title = $this->dao->select('name')->from($auditplan->objectType == 'activity' ? TABLE_ACTIVITY : TABLE_DELIVERABLE)->where('id')->eq($auditplan->objectID)->fetch('name');

$fields = defineFieldList('auditplan');
$fields->field('execution')->control('picker')->items($executions)->width('full');
$fields->field('process')->required(true)->control(array('control' => 'picker', 'required' => false))->items($processList)->width('full');
$fields->field('objectID')->required(true)->control(array('control' => 'picker', 'required' => false))->items($activityList)->width('full');
if($auditplan->cycleType != 'noCycle')
{
    $fields->field('checkDate')
           ->checkbox(array('name' => 'isCycle', 'text' => $lang->auditplan->isCycle, 'value' => '1', 'checked' => true, 'disabled' => true))
           ->control(array('control' => 'radioList', 'name' => 'cycleType', 'inline' => true, 'items' => $lang->auditplan->cycleList, 'value' => $auditplan->cycleType))
           ->width('full');
}
else
{

    $fields->field('checkDate')->required(true)->control('date')->width('full');
}
if($cycleType == 'day')
{
    $fields->field('cycleConfig')
        ->required(true)
        ->control('inputGroup')
        ->itemBegin()->control('btn')->text($lang->auditplan->from)->itemEnd()
        ->itemBegin()->control(array('control' => 'datePicker', 'required' => true))->name('cycleConfig[fromDate]')->value(zget($cycleConfig, 'fromDate', ''))->itemEnd()
        ->itemBegin()->control('btn')->text($lang->auditplan->interval)->itemEnd()
        ->itemBegin()->control('input')->name('cycleConfig[interval]')->value(zget($cycleConfig, 'interval', 1))->type('number')->min(1)->step(1)->itemEnd()
        ->itemBegin()->control('btn')->text($lang->auditplan->day)->itemEnd()
        ->itemBegin()->control('input')->name('cycleConfig[]')->className('hidden')->itemEnd()
        ->width('full');
}
elseif($cycleType == 'week')
{
    $fields->field('cycleConfig')
        ->required(true)
        ->control('inputGroup')
        ->itemBegin()->control('btn')->text($lang->auditplan->weekly)->itemEnd()
        ->itemBegin()->control('picker')->multiple(true)->name('cycleConfig[week]')->items($lang->auditplan->weekList)->value(zget($cycleConfig, 'week', ''))->itemEnd()
        ->itemBegin()->control('input')->name('cycleConfig[]')->className('hidden')->itemEnd()
        ->width('full');
}
elseif($cycleType == 'month')
{
    $fields->field('cycleConfig')
        ->required(true)
        ->control('inputGroup')
        ->itemBegin()->control('btn')->text($lang->auditplan->monthly)->itemEnd()
        ->itemBegin()->control('picker')->multiple(true)->name('cycleConfig[month]')->items($lang->auditplan->monthList)->value(zget($cycleConfig, 'month', ''))->itemEnd()
        ->itemBegin()->control('input')->name('cycleConfig[]')->className('hidden')->itemEnd()
        ->width('full');
}

if($cycleType != 'noCycle')
{
    $fields->field('cyclePlan')
        ->required(true)
        ->label($lang->auditplan->cyclePlan)
        ->control('inputGroup')
        ->itemBegin()->control('btn')->text($lang->auditplan->advance)->itemEnd()
        ->itemBegin()->control('input')->type('number')->min(0)->step(1)->name('cyclePlan')->value($auditplan->cyclePlan)->itemEnd()
        ->itemBegin()->control('btn')->text($lang->auditplan->day)->itemEnd()
        ->width('full');

    $fields->field('deadline')
        ->control('datePicker')
        ->name('deadline')
        ->value($auditplan->deadline)
        ->width('full');
}

$fields->field('assignedTo')->required($cycleType != 'noCycle')->control(array('control' => 'picker', 'required' => false))->items($users)->width('full');
$fields->field('comment')->control('editor')->width('full');

$fields->autoLoad('process',   'objectID');
$fields->autoLoad('cycleType', 'cycleConfig');

modalHeader(set::entityText(''));
formPanel
(
    set::layout('grid'),
    set::fields($fields),
    set::loadUrl(createLink('auditplan', 'edit', "aduitplanID={$auditplan->id}&processID={process}&cycleType={cycleType}"))
);

history();
