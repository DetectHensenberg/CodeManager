<?php
/**
 * The edit file of nc module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     nc
 * @link        https://www.zentao.net
 */
namespace zin;

unset($lang->nc->severityList[0]);

$fields = defineFieldList('nc');
$fields->field('title')->required(true)->control('input')->width('1/2');
$fields->field('execution')->control('picker')->items($executions)->width('1/2');
$fields->field('type')->control('picker')->items($lang->nc->typeList)->width('1/2');
$fields->field('severity')->required(true)->control('picker')->items($lang->nc->severityList)->width('1/2');
if(!empty($nc->deliverable)) $fields->field('deliverable')->required(true)->label($lang->nc->auditplan)->control(array('contorl' => 'picker', 'required' => false))->items($deliverables)->width('1/2');
if(!empty($nc->auditplan)) $fields->field('auditplan')->required(true)->control(array('contorl' => 'picker', 'required' => false))->items($auditplans)->width('1/2');
if(!empty($nc->listID)) $fields->field('listID')->required(true)->control(array('control' => 'picker', 'required' => false))->items($checkPairs)->width('1/2');
$fields->field('assignedTo')->control('picker')->items($users)->width('1/2');
$fields->field('deadline')->control('date')->width('1/2');
$fields->field('desc')->control('editor')->width('full');

$fields->autoLoad('execution', 'auditplan,listID');
$fields->autoLoad('auditplan', 'listID');
formGridPanel
(
    set::modeSwitcher(false),
    set::title($title),
    set::fields($fields),
    set::loadUrl(createLink('nc', 'edit', "ncID={$nc->id}&executionID={execution}&auditplan={auditplan}"))
);
