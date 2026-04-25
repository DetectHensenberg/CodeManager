<?php
/**
 * The create view file of researchreport module of ZenTaoPMS.
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Shujie Tian <tianshujie@chandao.com>
 * @package     researchreport
 * @link        https://www.zentao.net
 */
namespace zin;

formPanel
(
    set::title($lang->researchreport->create),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchreport->title),
        set::name('title')
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchreport->author),
        picker
        (
            set::name('author'),
            set::items($users),
            set::value($this->app->user->account),
            set::required(false)
        )
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchreport->relatedPlan),
        picker
        (
            set::name('relatedPlan'),
            set::items($planPairs),
            set::value(empty($relatedPlan) ? '' : $relatedPlan),
            set::required(false)
        )
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchreport->customer),
        set::name('customer')
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchreport->researchObjects),
        set::name('researchObjects')
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchreport->researchTime),
        inputGroup
        (
            datetimePicker
            (
                set::name('begin'),
                set::placeholder($lang->researchreport->begin)
            ),
            ' ~ ',
            datetimePicker
            (
                set::name('end'),
                set::placeholder($lang->researchreport->end)
            )
        )
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchreport->location),
        set::name('location')
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchreport->method),
        picker
        (
            set::name('method'),
            set::items($lang->researchreport->methodList),
            set::required(false)
        )
    ),
    formGroup
    (
        set::label($lang->researchreport->content),
        editor
        (
            set::name('content'),
            set::templateType('researchreport')
        )
    )
);
