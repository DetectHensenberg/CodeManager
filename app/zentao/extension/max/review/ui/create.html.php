<?php
/**
 * The create view file of review module of ZenTaoPMS.
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Shujie Tian <tianshujie@easycorp.ltd>
 * @package     review
 * @link        https://www.zentao.net
 */
namespace zin;

jsVar('objectList', $lang->baseline->objectList);
jsVar('projectID',  $projectID);
jsVar('reviewID',  $reviewID);
jsVar('deliverableID',  $deliverableID);
jsVar('type',  $type);
jsVar('reviewText', $lang->review->common);

$typeList = $lang->review->typeList;
unset($typeList['all']);
if($project->model != 'ipd') unset($typeList['decision']);
if($project->model == 'agileplus')
{
    unset($typeList['baseline']);
    unset($typeList['projectchange']);
}

if(!hasPriv('review', 'submitDeliverable'))   unset($typeList['deliverable']);
if(!hasPriv('review', 'submitBaseline'))      unset($typeList['baseline']);
if(!hasPriv('review', 'submitIpd'))           unset($typeList['decision']);
if(!hasPriv('review', 'submitProjectchange')) unset($typeList['projectchange']);

$content      = array();
$files        = null;
$hasApproval  = true;
if($type == 'deliverable')
{
    if($deliverable) $hasApproval = !empty($deliverable->hasApproval);
    $disabled  = $reviewID || !$hasApproval;
    $content[] = formGroup
    (
        set::label($lang->review->object),
        set::width('1/2'),
        set::required(true),
        setClass('category-picker'),
        set::hidden(!$hasApproval),
        picker
        (
            on::change('changeDeliverableCategory'),
            set::name('object'),
            set::items($categories),
            set::value($categoryID),
            set::disabled($disabled)
        )
    );

    $content[] = formGroup
    (
        set::label($lang->review->deliverable),
        set::width('1/2'),
        set::required(true),
        setClass('deliverable-picker'),
        picker
        (
            set::name('deliverable'),
            set::items($deliverables),
            set::value($deliverableID),
            set::disabled($disabled)
        )
    );

    $content[] = formGroup
    (
        set::label($lang->review->version),
        set::width('1/2'),
        set::required(true),
        set::name('version'),
        set::value($version),
        set::hidden($hasApproval)
    );
}
elseif($type == 'baseline')
{
    $content[] = formGroup
    (
        set::required(true),
        set::label($lang->review->cmTitle),
        set::width('1/2'),
        set::name('title'),
        set::disabled(!empty($review)),
        set::value(!empty($review) ? $review->title : '')
    );

    $content[] = formGroup
    (
        set::label($lang->review->version),
        set::width('1/2'),
        set::required(true),
        set::name('version'),
        set::value($version),
        set::disabled($reviewID ? true : false)
    );

    $content[] = formGroup
    (
        set::required(true),
        set::label($lang->review->cm),
        set::width('1/2'),
        picker
        (
            set::name('deliverables'),
            set::items($deliverables),
            set::multiple(true),
            set::disabled(!empty($review)),
            set::menu(array('checkbox' => true)),
            set::toolbar(true),
            set::value(!empty($review) ? $review->category : '')
        )
    );
}
elseif($type == 'decision')
{
    $content[] = formGroup
    (
        set::label($lang->review->object),
        set::width('1/2'),
        set::id('objectList'),
        set::required(true),
        set::hidden(!empty($reviewID)),
        setClass('object-picker'),
        picker
        (
            set::name('object'),
            set::items($objectList),
            set::disabled(!empty($review)),
            set::value(!empty($review) ? $review->category : $objectID)
        )
    );

    $content[] = formGroup
    (
        set::label($lang->review->deliverables),
        set::width('1/2'),
        set::hidden(!empty($reviewID)),
        picker
        (
            set::name('deliverables'),
            set::menu(array('checkbox' => true)),
            set::items($deliverables),
            set::multiple(true),
            set::disabled(!empty($review)),
            set::value(!empty($review) ? array_keys($review->deliverables) : '')
        )
    );
}
elseif($type == 'projectchange')
{
    $content[] = formGroup
    (
        set::label($lang->projectchange->name),
        set::width('1/2'),
        set::required(true),
        set::name('title'),
        set::disabled(!empty($review)),
        set::value(!empty($review) ? $review->title : '')
    );
    if(empty($review))
    {
        $content[] = formGroup
        (
            set::label($lang->projectchange->urgency),
            set::width('1/2'),
            set::required(true),
            set::name('urgency'),
            set::control('picker'),
            set::items($lang->projectchange->urgencyList)
        );
        $content[] = formGroup
        (
            set::label($lang->projectchange->type),
            set::width('1/2'),
            set::required(true),
            set::name('changeType'),
            set::control('picker'),
            set::items($lang->projectchange->typeList)
        );
    }
    $content[] = formRow
    (
        formGroup
        (
            set::label($lang->projectchange->deliverable),
            set::width('1/2'),
            set::multiple(true),
            set::name('deliverable'),
            set::control('picker'),
            set::items($deliverables),
            set::value(!empty($review) ? $review->category : ''),
            set::disabled(!empty($review))
        ),
        formGroup
        (
            btn
            (
                set::icon('help'),
                toggle::tooltip(array('placement' => 'right', 'title' => $lang->projectchange->deliverableNotice, 'class-name' => 'text-gray border border-light')),
                set::square(true),
                setClass('ghost h-6 mt-0.5 tooltip-btn')
            )
        )
    );
    if(empty($review))
    {
        $content[] = formGroup
        (
            set::label($lang->projectchange->owner),
            set::width('1/2'),
            set::required(true),
            set::name('owner'),
            set::control('picker'),
            set::items($users)
        );
    }

    $files = formGroup
    (
        set::label($lang->files),
        fileSelector
        (
            set::name('files')
        )
    );
}

$title = $hasApproval ? $lang->review->create : $lang->project->updateVersion;
if(in_array($project->model, array('scrum', 'aglieplus'))) unset($typeList['baseline'], $typeList['decision'], $typeList['projectchange']);
formPanel
(
    set::submitBtnText($lang->review->create),
    set::title($title),
    formGroup
    (
        set::label($lang->review->type),
        set::width('1/2'),
        set::required(true),
        set::hidden(!$hasApproval || ($type == 'decision' && $reviewID)),
        setClass('type-picker'),
        picker
        (
            on::change('changeType'),
            set::name('type'),
            set::items($typeList),
            set::disabled(!empty($review) || !$hasApproval),
            set::value($type)
        )
    ),
    $content,
    $type != 'deliverable' ? formGroup
    (
        set::label($lang->review->deadline),
        set::width('1/2'),
        set::control('datePicker'),
        set::name('deadline'),
        set::hidden(!$hasApproval || ($type == 'decision' && $reviewID)),
        set::value($deadline)
    ) : null,
    $type == 'projectchange' && empty($review) ? formGroup
    (
        set::label($lang->projectchange->reason),
        set::width('full'),
        set::required(true),
        set::name('reason'),
        set::control('textarea'),
        set::rows(2)
    ) : null,
    $type == 'projectchange' && empty($review) ? formGroup
    (
        set::label($lang->projectchange->desc),
        set::width('full'),
        set::required(true),
        set::name('desc'),
        set::control('editor')
    ) : null,
    $files,
    formGroup
    (
        set::label($lang->review->comment),
        set::hidden($type == 'decision' && $reviewID),
        set::name('comment'),
        set::control('editor')
    )
);

if($reviewID)
{
    history
    (
        setClass('panel panel-form size-lg is-lite'),
        set::objectID($reviewID)
    );
}
