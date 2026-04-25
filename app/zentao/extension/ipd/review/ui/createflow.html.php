<?php
/**
 * The create flow file of review module of ZenTaoPMS.
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang <wangyuting@easycorp.ltd>
 * @package     review
 * @link        https://www.zentao.net
 */
namespace zin;

formPanel
(
    set::title($title),
    set::layout('horz'),
    formGroup
    (
        set::label($lang->review->objectID),
        set::required(true),
        set::control(array('control' => 'picker', 'required' => false)),
        set::name('objectID'),
        set::items($deliverables)
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
                set::items($approvals)
            ),
            hasPriv('approvalflow', 'create') ? div
            (
                a(set::className('btn secondary ml-1'), set::href(createLink('approvalflow', 'create', 'workflow=&callback=refreshApproval')), setData(array('toggle' => 'modal')), $lang->review->createApproval)
            ) : null
        )
    )
);
