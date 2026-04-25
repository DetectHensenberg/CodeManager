<?php
/**
 * The edit view file of researchreport module of ZenTaoPMS.
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Shujie Tian <tianshujie@chandao.com>
 * @package     researchreport
 * @link        https://www.zentao.net
 */
namespace zin;

formPanel
(
    set::title($lang->researchreport->edit),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchreport->title),
        set::name('title'),
        set::value($report->title)
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchreport->author),
        picker
        (
            set::name('author'),
            set::items($users),
            set::value($report->author),
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
            set::value($report->relatedPlan),
            set::required(false)
        )
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchreport->customer),
        set::name('customer'),
        set::value($report->customer)
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchreport->researchObjects),
        set::name('researchObjects'),
        set::value($report->researchObjects)
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
                set::value(helper::isZeroDate($report->begin) ? '' : $report->begin),
                set::placeholder($lang->researchreport->begin)
            ),
            ' ~ ',
            datetimePicker
            (
                set::name('end'),
                set::value(helper::isZeroDate($report->end) ? '' : $report->end),
                set::placeholder($lang->researchreport->end)
            )
        )
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchreport->location),
        set::name('location'),
        set::value($report->location)
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->researchreport->method),
        picker
        (
            set::name('method'),
            set::items($lang->researchreport->methodList),
            set::value($report->method),
            set::required(false)
        )
    ),
    formGroup
    (
        set::label($lang->researchreport->content),
        editor
        (
            set::name('content'),
            $report->content && isHTML($report->content) ? html($report->content) : $report->content,
            set::templateType('researchreport')
        )
    )
);
