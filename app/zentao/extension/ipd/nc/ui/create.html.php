<?php
/**
 * The create file of nc module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2025 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun<sunguangming@easycorp.ltd>
 * @package     nc
 * @link        https://www.zentao.net
 */
namespace zin;

jsVar('projectID', $projectID);
jsVar('executionID', $executionID);
jsVar('auditplanID', $auditplanID);
jsVar('from', $from);

unset($lang->nc->severityList[0]);
if(!$hasDeliverable) unset($lang->nc->objectTypeList['deliverable']);
formGridPanel
(
    set::title($lang->nc->create),
    set::modeSwitcher(false),
    $type != 'deliverable' ? on::change('[name="execution"]', 'changeExecution') : null,
    on::change('[name="auditplan"]', 'changeAuditplan'),
    on::change('[name="objectType"]', 'changeObjectType'),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->nc->objectType),
        set::wrapAfter(true),
        picker
        (
            set::name('objectType'),
            set::items($lang->nc->objectTypeList),
            set::required(true),
            set::value($type)
        )
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->nc->title),
        input
        (
            set::name('title'),
            set::required(true)
        )
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->nc->execution),
        picker
        (
            set::name('execution'),
            set::items($executions),
            set::value($executionID)
        )
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->nc->type),
        picker
        (
            set::name('type'),
            set::items($lang->nc->typeList)
        )
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->nc->severity),
        set::required(true),
        picker
        (
            set::name('severity'),
            set::items($lang->nc->severityList)
        )
    ),
    $type == 'auditplan' ? formGroup
    (
        set::width('1/2'),
        set::label($lang->nc->auditplan),
        set::required(true),
        picker
        (
            set::name('auditplan'),
            set::value($auditplanID),
            set::items($auditplans)
        )
    ) : null,
    $type == 'deliverable' ? formGroup
    (
        set::width('1/2'),
        set::label($lang->nc->auditplan),
        set::required(true),
        picker
        (
            set::name('deliverable'),
            set::items($deliverables)
        )
    ) : null,
    $type == 'auditplan' ? formGroup
    (
        set::width('1/2'),
        set::label($lang->nc->listID),
        picker
        (
            set::name('listID'),
            set::items($checkPairs),
            set::required(true)
        )
    ) : null
);
