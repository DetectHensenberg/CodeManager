<?php
/**
 * The create view file of projectchange module of ZenTaoPMS.
 * @copyright   Copyright 2009-2025 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Tingting Dai <daitingting@easycorp.ltd>
 * @package     projectchange
 * @link        https://www.zentao.net
 */
namespace zin;

formPanel
(
    to::heading(div(setClass('panel-title text-lg'), $title)),
    set::submitBtnText($lang->projectchange->submit),
    set::layout('horz'),
    formGroup
    (
        set::label($lang->projectchange->name),
        set::width('1/2'),
        set::required(true),
        set::name('name')
    ),
    formGroup
    (
        set::label($lang->projectchange->urgency),
        set::width('1/2'),
        set::required(true),
        set::name('urgency'),
        set::control('picker'),
        set::items($lang->projectchange->urgencyList)
    ),
    formGroup
    (
        set::label($lang->projectchange->type),
        set::width('1/2'),
        set::required(true),
        set::name('type'),
        set::control('picker'),
        set::items($lang->projectchange->typeList)
    ),
    formRow
    (
        formGroup
        (
            set::label($lang->projectchange->deliverable),
            set::width('1/2'),
            picker(set::multiple(true), set::name('deliverable'), set::items($deliverables))
        ),
        formGroup
        (
            btn
            (
                set::icon('help'),
                toggle::tooltip(array('placement' => 'right', 'title' => $lang->projectchange->deliverableNotice, 'class-name' => 'text-gray border border-light')),
                set::square(true),
                setClass('ghost h-6 mt-0.5 tooltip-btn')
            )
        )
    ),
    formGroup
    (
        set::label($lang->projectchange->owner),
        set::width('1/2'),
        set::required(true),
        set::name('owner'),
        set::control('picker'),
        set::items($users)
    ),
    formGroup
    (
        set::label($lang->projectchange->deadline),
        set::width('1/2'),
        set::name('deadline'),
        set::control('datePicker')
    ),
    formGroup
    (
        set::label($lang->projectchange->reason),
        set::width('full'),
        set::required(true),
        set::name('reason'),
        set::control('textarea'),
        set::rows(2)
    ),
    formGroup
    (
        set::label($lang->projectchange->desc),
        set::width('full'),
        set::required(true),
        set::name('desc'),
        set::control('editor')
    ),
    formGroup
    (
        set::label($lang->projectchange->files),
        fileSelector
        (
            set::name('files')
        )
    ),
    formGroup
    (
        set::label($lang->projectchange->comment),
        set::name('comment'),
        set::control('editor')
    )
);

render();
