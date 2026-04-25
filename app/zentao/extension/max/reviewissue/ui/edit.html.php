<?php
/**
 * The edit view file of reviewissue module of ZenTaoPMS.
 * @copyright   Copyright 2009-2025 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Shujie Tian <tianshujie@chandao.com>
 * @package     reviewissue
 * @link        https://www.zentao.net
 */
namespace zin;

$editFields = $config->reviewissue->form->edit;
formPanel
(
    set::title($lang->reviewissue->edit),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->reviewissue->review),
        set::control("static"),
        set::value($issue->reviewTitle)
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->reviewissue->title),
        set::name('title'),
        set::value($issue->title)
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($editFields['assignedTo']['label']),
        set::name('assignedTo'),
        set::items($users),
        set::value($issue->assignedTo)
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($editFields['opinion']['label']),
        set::name('opinion'),
        set::value($issue->opinion)
    )
);
