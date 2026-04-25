<?php
/**
 * The create file of cm module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     cm
 * @link        https://www.zentao.net
 */
namespace zin;

formPanel
(
    set::submitBtnText($lang->cm->submit),
    set::title($title),
    set::layout('horz'),
    formGroup
    (
        set::label($lang->cm->title),
        set::width('1/2'),
        set::required(true),
        set::name('title')
    ),
    formGroup
    (
        set::label($lang->cm->version),
        set::width('1/2'),
        set::required(true),
        set::name('version')
    ),
    formGroup
    (
        set::label($lang->cm->object),
        set::width('1/2'),
        set::name('category[]'),
        set::required(true),
        set::multiple(true),
        set::control(array('control' => 'picker', 'menu' => array('checkbox' => true), 'toolbar' => true, 'items' => $categories))
    ),
    formGroup
    (
        set::label($lang->cm->end),
        set::width('1/2'),
        set::name('end'),
        set::control('date')
    ),
    formGroup
    (
        set::label($lang->cm->comment),
        set::name('comment'),
        set::control('editor')
    )
);
