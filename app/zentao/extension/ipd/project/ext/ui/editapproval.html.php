<?php
/**
 * The edit file of review module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     review
 * @link        https://www.zentao.net
 */
namespace zin;

$workflow = '';
if($flow->objectType == 'baseline') $workflow = 'cm';
if($flow->objectType == 'change')   $workflow = 'projectchange';

jsVar('workflow', $workflow);
formPanel
(
    set::layout('horz'),
    entityLabel(to::prefix($lang->review->editFlow), set(array('entityID' => $flow->id, 'level' => 1, 'text' => zget($deliverables, $flow->objectID, '')))),
    on::change('[name="flow"]', 'refreshDesignLink'),
    formGroup
    (
        set::label($lang->review->approval),
        set::required(true),
        set::disabled(true),
        set::control(array('control' => 'picker', 'required' => false)),
        set::name('objectID'),
        set::items($deliverables),
        set::value($flow->objectID)
    ),
    formGroup
    (
        set::label($lang->review->flow),
        set::required(true),
        inputGroup
        (
            picker
            (
                set::name('flow'),
                set::required(false),
                set::items($approvals),
                set::value($flow->flow)
            ),
            hasPriv('approvalflow', 'design') ? div
            (
                a(set::className('btn secondary ml-1 designLink'), set::href(createLink('approvalflow', 'design', "id=$flow->flow")), set::target('_blank'), $lang->design->common)
            ) : null,
            hasPriv('approvalflow', 'create') ? div
            (
                a(set::className('btn secondary ml-1'), set::href(createLink('approvalflow', 'create', "workflow={$workflow}&callback=refreshApproval")), setData(array('toggle' => 'modal')), $lang->review->createApproval)
            ) : null
        )
    )
);
