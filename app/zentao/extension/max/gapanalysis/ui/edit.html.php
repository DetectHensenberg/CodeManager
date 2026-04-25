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

formPanel
(
    set::title($lang->gapanalysis->edit),
    formRow
    (
        formGroup
        (
            set::width('1/2'),
            set::label($lang->gapanalysis->account),
            set::control('picker'),
            set::items($users),
            set::name('account'),
            set::disabled(true),
            set::value($gapanalysis->account)
        )
    ),
    formRow
    (
        formGroup
        (
            set::width('1/2'),
            set::label($lang->gapanalysis->role),
            set::disabled(true),
            set::name('role'),
            set::value($gapanalysis->role)
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
                set::rows('6'),
                set::value($gapanalysis->analysis)
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
                set::value($gapanalysis->needTrain),
                set::inline(true)
            )
        )
    )
);

render();
