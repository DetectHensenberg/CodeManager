<?php
/**
 * The edit file of auditcl module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Sun Guangming<sunguangming@easycorp.ltd>
 * @package     auditcl
 * @link        https://www.zentao.net
 */
namespace zin;

jsVar('groupID', $auditcl->workflowGroup);

formPanel
(
    set::layout('horz'),
    set::title($lang->auditcl->edit),
    formGroup
    (
        on::change('changeProcess'),
        set::label($lang->auditcl->process),
        set::width('1/2'),
        set::name('process'),
        set::items($processes),
        set::value($auditcl->process)
    ),
    formGroup
    (
        set::label($lang->auditcl->activity),
        set::width('1/2'),
        set::name('objectID'),
        set::items($activities),
        set::value($auditcl->activity)
    ),
    formGroup
    (
        set::label($lang->auditcl->title),
        set::width('1/2'),
        set::name('title'),
        set::value($auditcl->title)
    )
);
