<?php
/**
 * The create file of activity module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     activity
 * @link        https://www.zentao.net
 */
namespace zin;

formPanel
(
    set::title($title),
    set::layout('horz'),
    formGroup
    (
        set::label($lang->activity->process),
        set::width('1/2'),
        set::name('process'),
        set::items($processes),
        set::value($processID)
    ),
    formGroup
    (
        set::label($lang->activity->name),
        set::width('1/2'),
        set::name('name')
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
            set::value('yes')
        )
    ),
    formGroup
    (
        set::label($lang->activity->tailorNorm),
        set::width('1/2'),
        set::name('tailorNorm')
    ),
    formGroup
    (
        set::label($lang->activity->content),
        set::name('content'),
        set::control('editor')
    )
);
