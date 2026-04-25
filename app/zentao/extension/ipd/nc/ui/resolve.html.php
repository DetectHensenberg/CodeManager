<?php
/**
 * The resovle file of nc module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     nc
 * @link        https://www.zentao.net
 */
namespace zin;

$fields = defineFieldList('nc');
$fields->field('resolution')->required(true)->control('picker')->items($lang->nc->resolutionList)->value('fixed')->width('full');
$fields->field('resolvedDate')->required(true)->control('datePicker')->value(helper::today())->width('full');
$fields->field('assignedTo')->control('picker')->items($members)->value($nc->assignedTo)->width('full');
$fields->field('desc')->label($lang->nc->desc)->control('editor')->value($nc->desc)->width('full');

formPanel
(
    set::title($title),
    set::layout('horz'),
    set::fields($fields)
);

history();
