<?php
/**
 * The edit view of researchplan module of ZenTaoPMS.
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
        input(set::name('name'), set::value($plan->name))
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchplan->customer),
        input(set::name('customer'), set::value($plan->customer))
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchplan->stakeholder),
        picker(set::name('stakeholder'), set::items($users), set::multiple(true), set::value($plan->stakeholder))
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchplan->objective),
        input(set::name('objective'), set::value($plan->objective))
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchplan->begin),
        datetimePicker(set::name('begin'), set::value(helper::isZeroDate($plan->begin) ? '' : $plan->begin))
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchplan->end),
        datetimePicker(set::name('end'), set::value(helper::isZeroDate($plan->end) ? '' : $plan->end))
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchplan->location),
        input(set::name('location'), set::value($plan->location))
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchplan->team),
        picker(set::name('team'), set::items($insideUsers), set::multiple(true), set::value($plan->team))
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchplan->method),
        picker(set::name('method'), set::items($lang->researchplan->methodList), set::value($plan->method))
    ),
    formGroup
    (
        set::label($lang->researchplan->outline),
        editor(set::name('outline'), set::templateType('researchplan'), set::value($plan->outline))
    ),
    formGroup
    (
        set::label($lang->researchplan->schedule),
        editor(set::name('schedule'), set::value($plan->schedule))
    )
);
