<?php
/**
 * The edit file of trainplan module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     trainplan
 * @link        https://www.zentao.net
 */
namespace zin;

$fields = defineFieldList('trainplan');
$fields->field('name')->required(true)->value($trainplan->name)->width('full');
$fields->field('datePlan')
    ->control('inputGroup')
    ->itemBegin()->control('datePicker')->name('begin')->value($trainplan->begin)->placeholder($lang->trainplan->begin)->itemEnd()
    ->itemBegin()->control('btn')->text('~')->itemEnd()
    ->itemBegin()->control('datePicker')->name('end')->value($trainplan->end)->placeholder($lang->trainplan->end)->itemEnd()
    ->width('full');

$fields->field('place')->value($trainplan->place)->width('full');
$fields->field('trainee')->items($members)->multiple(true)->value($trainplan->trainee)->width('full');
$fields->field('lecturer')->value($trainplan->lecturer)->width('full');
$fields->field('type')->control(array('control' => 'radioList', 'inline' => true))->items($lang->trainplan->typeList)->value($trainplan->type)->width('full');

formPanel
(
    set::title($title),
    set::layout('grid'),
    set::fields($fields)
);
