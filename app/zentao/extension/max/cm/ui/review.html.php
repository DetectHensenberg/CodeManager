<?php
/**
 * The assess view file of review module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     review
 * @version     $Id$
 * @link        http://www.zentao.net
 */
namespace zin;
$sideWidth = '720';

featureBar
(
    to::leading(array(backBtn(set::icon('back'), set::className('size-md primary-outline'), set::url(createLink('cm', 'browse', "projectID={$baseline->project}")), $lang->goback))),
    entityTitle(set::titleClass('text-lg text-clip font-bold'), setID((string)$baseline->id), set::object($baseline), set::type('baseline'), set::title($baseline->title))
);

$buildSideBar = function($baseline, $viewData) use ($deliverables, $users)
{
    global $config;

    $nodes = array();
    $nodes[] = dtable(set::cols(array_values($config->cm->deliverable->dtable->fieldList)), set::data(array_values($deliverables)), set::userMap($users));
    return $nodes;
};

sidebar
(
    set::width($sideWidth),
    set::maxWidth($sideWidth),
    set::minWidth(0),
    set::toggleBtn(false),
    $buildSideBar($baseline, $this->view)
);

panel
(
    setClass('panel-form'),
    form
    (
        set::actions(array()),
        set::labelWidth('100px'),
        setID('reviewForm'),
        formGroup
        (
            set::width('full'),
            set::label($lang->cm->reviewResult),
            set::name('reviewResult'),
            set::control('radioListInline'),
            set::items($lang->cm->reviewResultList),
            set::value('pass')
        ),
        $setReviewer ? formGroup
        (
            set::width('1/2'),
            set::label($lang->cm->setReviewer),
            set::name('setReviewer'),
            set::control('picker'),
            set::items($users)
        ) : null,
        formGroup(set::width('full'), set::label($lang->cm->reviewOpinion), set::name('reviewOpinion'), set::control('editor')),
        toolbar(setClass('review-actions toolbar form-actions form-group no-label'), btn(set(array('text' => $lang->save, 'btnType' => 'submit', 'type' => 'primary'))), isset($currentNode->priv) && in_array('revert', $currentNode->priv)  ? btn(set(array('text' => $lang->approval->revert,  'url' => createLink('approval', 'revert', "objectType=baseline&objectID={$baseline->id}"),  'innerClass' => 'revert-btn',  'data-toggle' => 'modal'))) : null, isset($currentNode->priv) && in_array('forward', $currentNode->priv) ? btn(set(array('text' => $lang->approval->forward, 'url' => createLink('approval', 'forward', "objectType=baseline&objectID={$baseline->id}"), 'innerClass' => 'forward-btn', 'data-toggle' => 'modal'))) : null, isset($currentNode->priv) && in_array('addnode', $currentNode->priv) ? btn(set(array('text' => $lang->approval->addNode, 'url' => createLink('approval', 'addNode', "objectType=baseline&objectID={$baseline->id}"), 'innerClass' => 'forward-btn', 'data-toggle' => 'modal'))) : null, hasPriv('approval', 'progress') ? btn(set(array('text' => $lang->approval->progress, 'url' => createLink('approval', 'progress', "approvalID={$baseline->approval}"), 'data-toggle' => 'modal'))) : null)
    )
);
history(set::objectType('cm'), set::objectID($baseline->id));
