<?php
/**
 * The create file of process module of ZenTaoPMS.
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
    set::title($title),
    set::layout('horz'),
    formGroup
    (
        set::label($lang->process->module),
        set::width('1/2'),
        picker
        (
            set::name('module'),
            set::items($modules),
            set::value($moduleID),
            set::required(false)
        )
    ),
    formGroup
    (
        set::label($lang->process->name),
        set::name('name'),
        set::width('1/2')
    ),
    formGroup(set::label($lang->process->abbr), set::name('abbr'), set::width('1/2')),
    formGroup
    (
        set::label($lang->process->desc),
        set::name('desc'),
        set::control('editor')
    )
);
