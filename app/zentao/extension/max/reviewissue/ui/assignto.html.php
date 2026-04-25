<?php
/**
 * The resolved view file of reviewissue module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yidong Wang <yidong@chandao.com>
 * @package     reviewissue
 * @link        https://www.zentao.net
 */
namespace zin;

modalHeader(set::title($lang->reviewissue->assignTo), set::entityID($issue->id), set::entityText($issue->title));

$fields = $config->reviewissue->form->assignTo;
formPanel
(
    formGroup
    (
        set::label($fields['assignedTo']['label']),
        picker
        (
            set::name('assignedTo'),
            set::items($users),
            set::required($fields['assignedTo']['required']),
            set::value($issue->assignedTo)
        )
    ),
    formGroup
    (
        set::label($lang->comment),
        set::name('comment'),
        set::control('editor'),
        set::rows(6)
    )
);
