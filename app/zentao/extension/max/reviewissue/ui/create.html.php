<?php
/**
 * The create view file of reviewissue module of ZenTaoPMS.
 * @copyright   Copyright 2009-2025 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Shujie Tian <tianshujie@chandao.com>
 * @package     reviewissue
 * @link        https://www.zentao.net
 */
namespace zin;

$createFields = $config->reviewissue->form->create;
formPanel
(
    set::title($lang->reviewissue->create),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->reviewissue->review),
        picker
        (
            set::name('review'),
            set::items($reviewList),
            set::required(true),
            set::onChange(jsRaw("(value) => reviewChange(value)"))
        )
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->reviewissue->listType),
        picker
        (
            set::name('category'),
            set::items($categories),
            set::required(true),
            set::onChange(jsRaw("(value) => categoryChange(value)"))
        )
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->reviewissue->checklist),
        set::required(true),
        picker(set::name('listID'), set::items($checkList))
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->reviewissue->opinion),
        set::name('opinion')
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($createFields['assignedTo']['label']),
        set::name('assignedTo'),
        set::items($users),
        set::value($app->user->account),
        set::required($createFields['assignedTo']['required'])
    )
);
