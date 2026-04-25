<?php
/**
 * The close view file of bug module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang <wangyuting@easycorp.ltd>
 * @package     bug
 * @link        https://www.zentao.net
 */
namespace zin;

jsVar('projectID', $projectID);
set::title($lang->project->createDeliverable);
set::bodyClass('createdeliverable-body');

formPanel
(
    set::layout('grid'),
    set::actions(array('submit')),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->deliverable->name),
        set::required(true),
        picker
        (
            on::change('changeDeliverable'),
            set::required(true),
            set::items($deliverables),
            set::value($deliverableID),
            set::name('deliverable')
        )
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->deliverable->activity),
        input
        (
            set::value(!empty($deliverable->activityName) ? $deliverable->activityName : ''),
            set::readonly(true)
        )
    ),
    formGroup
    (
        set::label($lang->project->selectDoc),
        set::width('full'),
        set::required(true),
        deliverable
        (
            set::formName('doc'),
            set::createDocUrl($createDocUrl),
            set::uploadDocUrl($uploadDocUrl),
            set::projectID($projectID),
            set::items($items),
            set::categories($categories)
        )
    ),
    $stageInfo ? formGroup
    (
        set::label($lang->deliverable->when),
        set::width('full'),
        div
        (
            setClass('stage-info'),
            html($stageInfo)
        )
    ) : null
);
