<?php
/**
 * The create view of researchplan module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.cnezsoft.com)
 * @license     ZPL(http://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yidong Wang <yidong@chandao.net>
 * @package     researchplan
 * @link        https://www.zentao.net
 */

namespace zin;

formPanel
(
    set::title($lang->researchplan->create),
    set::formClass('border-0'),
    set::submitBtnText($lang->save),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchplan->name),
        set::required(true),
        input(set::name('name'))
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchplan->customer),
        input(set::name('customer'))
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchplan->stakeholder),
        picker(set::name('stakeholder'), set::items($users), set::multiple(true))
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchplan->objective),
        input(set::name('objective'))
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchplan->begin),
        datetimePicker(set::name('begin'))
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchplan->end),
        datetimePicker(set::name('end'))
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchplan->location),
        input(set::name('location'))
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchplan->team),
        picker(set::name('team'), set::items($insideUsers), set::multiple(true))
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchplan->method),
        picker(set::name('method'), set::items($lang->researchplan->methodList))
    ),
    formGroup
    (
        set::label($lang->researchplan->outline),
        editor(set::name('outline'), set::templateType('researchplan'))
    ),
    formGroup
    (
        set::label($lang->researchplan->schedule),
        editor(set::name('schedule'))
    )
);
