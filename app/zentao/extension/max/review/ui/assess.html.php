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
$sideWidth = '600';

featureBar
(
    to::leading(array(backBtn(set::icon('back'), set::className('primary-outline'), set::url(createLink('review', 'browse', "reviewID=$review->project")), $lang->goback))),
    entityTitle(set::titleClass('text-lg text-clip font-bold'), setID((string)$review->id), set::object($review), set::type('review'), set::title($review->title))
);

$reviewModel  = $this->review;
$projectchange = $review->type == 'projectchange' ? $projectchange : null;
$buildSideBar = function($review, $viewData) use ($sideWidth, $reviewModel, $projectchange, $users)
{
    global $app, $lang, $config;
    $nodes = array();

    if($review->type == 'projectchange')
    {
        $nodes[] = section
        (
            set::title($lang->projectchange->basicInfo),
            h::table
            (
                setClass('table condensed borderless'),
                h::tbody
                (
                    h::tr
                    (
                        h::td
                        (
                            div(setClass('flex flex-wrap pt-2'), div
                            (
                                setClass('w-1/3'),
                                span(setClass('text-gray'), $lang->projectchange->urgency),
                                span(setClass('ml-2'), zget($lang->projectchange->urgencyList, $projectchange->urgency))
                            ), div
                            (
                                setClass('w-1/3'),
                                span(setClass('text-gray'), $lang->projectchange->type),
                                span(setClass('ml-2'), zget($lang->projectchange->typeList, $projectchange->type))
                            ), div
                            (
                                setClass('w-1/3'),
                                span(setClass('text-gray'), $lang->projectchange->deadline),
                                span(setClass('ml-2'), formatTime($projectchange->deadline, DT_DATE1))
                            ))
                        )
                    )
                )
            )
        );

        $nodes[] = section
        (
            set::title($lang->projectchange->deliverable),
            empty($review->deliverables) ? div
            (
                setClass('dtable-empty-tip'),
                span
                (
                    setClass('text-gray'),
                    $lang->noData
                )
            ) : dtable
            (
                set::cols($config->projectchange->deliverable->dtable->fieldList),
                set::data($review->deliverables),
                set::userMap($users)
            )
        );

        $nodes[] = section
        (
            set::title($lang->projectchange->reason),
            set::content($projectchange->reason)
        );

        $nodes[] = section
        (
            set::title($lang->projectchange->desc),
            html($projectchange->desc)
        );

        if(!empty($projectchange->files)) $nodes[] = fileList(set::files($projectchange->files), set::padding(false));

        return $nodes;
    }

    if(empty($review->deliverables))
    {
        $reviewData         = json_decode($review->data, true);
        $showWithPageEditor = isset($reviewData['$migrate']) && $reviewData['$migrate'] == 'html';
        if(!empty($viewData->bookID) && !$showWithPageEditor)
        {
            $nodes[] = div
            (
                setID('bookTree'),
                treeEditor(set::items($reviewModel->buildBookTree($viewData->book, $viewData->review, zget($viewData, 'docID', 0))), set::canSplit(false))
            );
        }
        elseif(!$showWithPageEditor && $review->oldCategory == 'PP')
        {
            $from      = 'doc';
            $ganttType = $viewData->type;
            $productID = $review->product;
            $projectID = $review->project;
            $reviewID  = $review->id;
            include $app->getModuleRoot() . 'programplan/ui/ganttfields.html.php';

            data('showFields', 'PM,status,deadline');
            $ganttFields['column_text'] = $lang->programplan->ganttBrowseType['gantt'];
            $nodes[] = gantt
            (
                set('ganttLang', $ganttLang),
                set('ganttFields', $ganttFields),
                set('showChart', false),
                set('colsWidth', $sideWidth),
                set('options', $viewData->plans)
            );
        }
        elseif($showWithPageEditor)
        {
            $nodes[] = pageEditor
            (
                set::size('auto'),
                set::readonly(true),
                set::content($review->data)
            );
        }
        else
        {
            $linkedDoc = !empty($viewData->doc) ? $viewData->doc : null;
            if($linkedDoc)
            {
                $contentType = $linkedDoc->contentType;
                $nodes[] = section
                (
                    set::title($linkedDoc->title . ' ' . $review->version),
                    div
                    (
                        setClass('article-content'),
                        setID($linkedDoc->contentType == 'markdown' ? 'markdownContent' : null),
                        $contentType === 'doc' ? pageEditor
                        (
                            set::size('auto'),
                            set::readonly(true),
                            set::value(isset($linkedDoc->rawContent) ? $linkedDoc->rawContent : $linkedDoc->content)
                        ) : editor
                        (
                            set::resizable(false),
                            set::markdown($linkedDoc->contentType == 'markdown'),
                            set::readonly(true),
                            set::hideUI(true),
                            set::size('auto'),
                            html($linkedDoc->content)
                        )
                    )
                );
            }
        }

        if(!empty($viewData->doc) && !empty($viewData->doc->files)) $nodes[] = fileList(set::files($viewData->doc->files), set::padding(false));
    }
    else
    {
        $i = 0;
        $titleAction['items'][] = array('size' => 'xs', 'type' => 'ghost', 'class' => 'mr-2', 'data-on' => 'click', 'data-call' => 'toggleDetail', 'data-params' => 'event');
        foreach($review->deliverables as $deliverable)
        {
            if($i == 0)
            {
                $titleAction['items'][0]['icon'] = 'angle-top';
            }
            else
            {
                $titleAction['items'][0]['icon'] = 'angle-down';
            }

            $className          = $i == 0 ? '' : 'hidden';
            $title              = $deliverable->name . ' ' . $deliverable->version;
            $deliverableData    = !empty($deliverable->data) ? json_decode($deliverable->data, true) : array();
            $showWithPageEditor = isset($deliverableData['$migrate']) && $deliverableData['$migrate'] == 'html';
            if($deliverable->doc && !$showWithPageEditor)
            {
                $nodes[] = section
                (
                    set::title($title),
                    set::titleActions($titleAction),
                    div
                    (
                        setClass("article-content $className"),
                        pageEditor
                        (
                            set::size('auto'),
                            set::readonly(true),
                            set::value(isset($deliverable->doc->rawContent) ? $deliverable->doc->rawContent : $deliverable->doc->content)
                        )
                    )
                );

                if(!empty($deliverable->doc->files)) $nodes[] = fileList(set::files($deliverable->doc->files), set::padding(false));
            }
            elseif($showWithPageEditor)
            {
                $nodes[] = section
                (
                    set::title($title),
                    set::titleActions($titleAction),
                    div
                    (
                        setClass("article-content $className"),
                        pageEditor
                        (
                            set::size('auto'),
                            set::readonly(true),
                            set::value($deliverable->data)
                        )
                    )
                );
            }

            $i ++;
        }
    }

    if(!empty($review->files)) $nodes[] = fileList(set::files($review->files), set::padding(false));

    return $nodes;
};

sidebar
(
    set::width($sideWidth + 10),
    set::maxWidth($sideWidth + 10),
    set::minWidth(0),
    set::toggleBtn(false),
    $buildSideBar($review, $this->view)
);

if($setReviewer) $reviewer = strpos($setReviewer, 'pending-') !== false ? substr($setReviewer, 8) : $setReviewer;

$reviewclHtml = '';
if(!empty($reviewcl))
{
    $reviewclGroup = array();
    foreach($reviewcl as $list)
    {
        $reviewclGroup[$list->category][] = $list;
    }

    $reviewclHtml  = "<table class='table bordered condensed reviewcl'>";
    $reviewclHtml .= "<caption class='text-left pb-2'>{$lang->review->reviewcl}</caption>";
    $reviewclHtml .= "<thead><tr><th class='w-1/2'>{$lang->review->listItem}</th><th class='w-1/2'>{$lang->review->listResult}</th></tr></thead>";
    $reviewclHtml .= '<tbody>';
    foreach($reviewclGroup as $category => $lists)
    {
        $btn = '<button class="toolbar-item mr-2 btn square ghost size-xs" data-on="click" data-call="toggleOpinion" data-params="event" type="button"><i class="icon icon-angle-top"></i></button>';
        $reviewclHtml .= "<tr><td class='text-left font-bold' colspan='2' id='category-{$category}'>" . zget($categoryList, $category) . $btn . '</td></tr>';
        foreach($lists as $list)
        {
            $reviewclHtml .= "<tr class='category-{$category}'>";
            $reviewclHtml .= "<td>" . $list->title . '</td>';
            $reviewclHtml .= "<td>";
            $reviewclHtml .= html::radio("issueResult[$list->id]", $lang->review->checkList, '1', "class='issueResult' onchange='toggleOption(this)'", 'inline');
            $reviewclHtml .= "<div class='flex items-center issue-opinion hidden'>";
            $reviewclHtml .= "<input name='issueOpinion[$list->id][]' class='w-full form-control opinion'>";
            $reviewclHtml .= "<a class='btn btn-sm btn-link add-issue-opinion'><i class='icon icon-plus'></i></a>";
            $reviewclHtml .= "<a class='btn btn-sm btn-link del-issue-opinion' style='visibility: hidden;'><i class='icon icon-trash'></i></a>";
            $reviewclHtml .= '</div>';
            $reviewclHtml .= '</td>';
            $reviewclHtml .= '</tr>';
        }
    }
    $reviewclHtml .= '</tbody></table>';
}


$issueCols = $this->config->review->issue->dtable->fieldList;
$issues    = array_values($review->issues);

$issueCols['createdBy']['map'] = $users;

$approvalType     = '';
$approvalObjectID = 0;
if(in_array($review->type, array('deliverable', 'decision')))
{
    $approvalType     = 'review';
    $approvalObjectID = $review->id;
}
else
{
    $approvalType     = $review->type;
    $approvalObjectID = $review->object;
}

panel
(
    tabs
    (
        tabPane
        (
            setClass('panel-form'),
            set::key('review-opinion'),
            set::title($lang->review->finalOpinion),
            set::active(true),
            form
            (
                set::actions(array()),
                set::labelWidth('100px'),
                setID('reviewForm'),
                !empty($reviewcl) ? formRow
                (
                    setID('reviewrc'),
                    set::width('full'),
                    html($reviewclHtml)
                ) : null,
                $setReviewer ? formGroup
                (
                    set::width('1/3'),
                    set::label($lang->review->setReviewer),
                    set::name('setReviewer'),
                    set::value($reviewer),
                    set::control('picker'),
                    set::items($users)
                ) : null,
                formGroup
                (
                    set::width('full'),
                    set::label($lang->review->reviewResult),
                    set::name('result'),
                    set::value(isset($result->result) ? $result->result : 'pass'),
                    set::control('radioListInline'),
                    set::items($lang->review->resultList)
                ),
                formRow
                (
                    formGroup(set::width('1/3'), set::label($lang->review->reviewedDate), set::name('createdDate'), set::value(helper::today()), set::control('datePicker')),
                    formGroup
                    (
                        set::width('1/3'),
                        set::label($lang->review->consumed),
                        inputControl
                        (
                            input(set::name('consumed'), set::value(isset($result->consumed) ? $result->consumed : 0)),
                            to::suffix($lang->task->suffixHour),
                            set::suffixWidth(20)
                        )
                    )
                ),
                formGroup(set::width('full'), set::label($lang->review->finalOpinion), set::name('opinion'), set::value(isset($result->opinion) ? $result->opinion : ''), set::control('editor')),
                formGroup
                (
                    set::width('full'),
                    set::label($lang->files),
                    fileSelector()
                ),
                $review->deleted ? null : toolbar(setClass('review-actions toolbar form-actions form-group no-label'), btn(set(array('text' => $lang->save, 'btnType' => 'submit', 'type' => 'primary'))), isset($currentNode->priv) && in_array('revert', $currentNode->priv)  ? btn(set(array('text' => $lang->approval->revert,  'url' => createLink('approval', 'revert', "objectType={$approvalType}&objectID={$approvalObjectID}"),  'innerClass' => 'revert-btn',  'data-toggle' => 'modal'))) : null, isset($currentNode->priv) && in_array('forward', $currentNode->priv) ? btn(set(array('text' => $lang->approval->forward, 'url' => createLink('approval', 'forward', "objectType={$approvalType}&objectID={$approvalObjectID}"), 'innerClass' => 'forward-btn', 'data-toggle' => 'modal'))) : null, isset($currentNode->priv) && in_array('addnode', $currentNode->priv) ? btn(set(array('text' => $lang->approval->addNode, 'url' => createLink('approval', 'addNode', "objectType={$approvalType}&objectID={$approvalObjectID}"), 'innerClass' => 'forward-btn', 'data-toggle' => 'modal'))) : null, hasPriv('approval', 'progress') ? btn(set(array('text' => $lang->approval->progress, 'url' => createLink('approval', 'progress', "approvalID={$approval->id}"), 'data-toggle' => 'modal'))) : null)
            )
        ),
        $review->type != 'projectchange' ? tabPane
        (
            set::key('review-issue'),
            set::title($lang->review->issueList),
            set::active(false),
            dtable
            (
                set::cols($issueCols),
                set::data($issues),
                set::sortType(false)
            )
        ) : null
    )
);
history(set::objectID((int)$reviewID));
