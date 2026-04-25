<?php
/**
 * The edit file of activity module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     activity
 * @link        https://www.zentao.net
 */
namespace zin;
jsVar('editConfirm', $lang->activity->editConfirm);

formPanel
(
    $needConfirm ? set::ajax(array('beforeSubmit' => jsRaw("clickSubmit"))) : null,
    set::layout('horz'),
    entityLabel(to::prefix($lang->activity->edit), set(array('entityID' => $activity->id, 'level' => 1, 'text' => $activity->name))),
    formGroup
    (
        set::label($lang->activity->process),
        set::width('1/2'),
        set::name('process'),
        set::items($process),
        set::value($activity->process)
    ),
    formGroup
    (
        set::label($lang->activity->name),
        set::width('1/2'),
        set::name('name'),
        set::value($activity->name)
    ),
    formGroup
    (
        set::label($lang->activity->optional),
        set::width('1/2'),
        radioList
        (
            on::change('changeOptional'),
            set::inline(true),
            set::name('optional'),
            set::items(array_filter($lang->activity->optionalList)),
            set::value($activity->optional)
        )
    ),
    formGroup
    (
        set::label($lang->activity->tailorNorm),
        set::width('1/2'),
        set::name('tailorNorm'),
        set::value($activity->tailorNorm),
        set::disabled($activity->optional == 'no')
    ),
    formGroup
    (
        set::label($lang->activity->content),
        editor
        (
            set::name('content'),
            html($activity->content)
        )
    )
);
