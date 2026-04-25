<?php
/**
 * The edit file of process module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     process
 * @link        https://www.zentao.net
 */
namespace zin;

formPanel
(
    set::layout('horz'),
    entityLabel(to::prefix($lang->process->edit), set(array('entityID' => $process->id, 'level' => 1, 'text' => $process->name))),
    formGroup
    (
        set::label($lang->process->module),
        set::width('1/2'),
        picker
        (
            set::name('module'),
            set::items($modules),
            set::required(false),
            set::value($process->module)
        )
    ),
    formGroup
    (
        set::label($lang->process->name),
        set::name('name'),
        set::width('1/2'),
        set::value($process->name)
    ),
    formGroup
    (
        set::label($lang->process->abbr),
        set::name('abbr'),
        set::width('1/2'),
        set::value($process->abbr)
    ),
    formGroup
    (
        set::label($lang->process->desc),
        editor
        (
            set::name('desc'),
            html($process->desc)
        )
    )
);
