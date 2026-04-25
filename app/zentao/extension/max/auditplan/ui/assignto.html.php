<?php
/**
 * The assignto file of auditplan module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     auditplan
 * @link        https://www.zentao.net
 */
namespace zin;

$isCycle = $auditplan->cycleType != 'noCycle';
$fields = defineFieldList('auditplan');
if(!$isCycle) $fields->field('checkDate')->required(true)->control('date')->width('full');
$fields->field('assignedTo')->control(array('control' => 'picker', 'required' => false))->items($users)->value($auditplan->assignedTo)->width('full')->required($isCycle);
$fields->field('comment')->control('editor')->width('full');

formPanel
(
    set::title($title),
    set::layout('horz'),
    set::fields($fields)
);
