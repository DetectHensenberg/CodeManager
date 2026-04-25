<?php
/**
 * The select template view file of doc module of ZenTaoPMS.
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yue Liu<liuyue@chandao.com>
 * @package     gapanalysis
 * @link        https://www.zentao.net
 */
namespace zin;

jsVar('roles', $rolePairs);

formPanel
(
    set::title($lang->gapanalysis->create),
    formRow
    (
        formGroup
        (
            set::width('1/2'),
            set::label($lang->gapanalysis->account),
            set::required(true),
            picker(set::emptyValue(''), set::name('account'), set::items($members), on::change('refreshRole'))
        )
    ),
    formRow
    (
        formGroup
        (
            set::width('1/2'),
            set::label($lang->gapanalysis->role),
            set::disabled(true),
            set::name('role')
        )
    ),
    formRow
    (
        formGroup
        (
            set::label($lang->gapanalysis->analysis),
            editor
            (
                set::name('analysis'),
                set::rows('6')
            )
        )
    ),
    formRow
    (
        formGroup
        (
            set::width('1/2'),
            set::label($lang->gapanalysis->needTrain),
            radioList
            (
                set::name('needTrain'),
                set::items($lang->gapanalysis->needTrainList),
                set::value('no'),
                set::inline(true)
            )
        )
    )
);

render();
