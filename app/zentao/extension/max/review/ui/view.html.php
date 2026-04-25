<?php
/**
 * The view view file of review module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     review
 * @version     $Id$
 * @link        http://www.zentao.net
 */
namespace zin;

$sections = array();
if($review->type == 'projectchange')
{
    $sections[] = setting()->title($lang->projectchange->deliverable)->control(array('control' => 'dtable', 'cols' => array_values($config->projectchange->deliverable->dtable->fieldList), 'data' => array_values($review->deliverables), 'userMap' => $users));
    $sections[] = setting()->title($lang->projectchange->reason)->control('html')->content($projectchange->reason);
    $sections[] = setting()->title($lang->projectchange->desc)->control('html')->content($projectchange->desc);
    if(!empty($projectchange->files)) $sections[] = setting()->control('fileList')->files($projectchange->files)->object($projectchange)->padding(false);
}
else
{
    if(empty($review->deliverables))
    {
        $reviewData         = json_decode($review->data, true);
        $showWithPageEditor = isset($reviewData['$migrate']) && $reviewData['$migrate'] == 'html';
        if(!empty($bookID) && !$showWithPageEditor)
        {
            $nodeTree   = $this->review->buildBookTree($book, $review, isset($docID) ? $docID : 0);
            $sections[] = setting()->control('treeEditor')->items($nodeTree)->canSplit(false);
        }
        elseif(!$showWithPageEditor && $review->oldCategory == 'PP')
        {
            $from       = 'doc';
            $ganttType  = 'gantt';
            $productID  = $review->product;
            $projectID  = $review->project;
            include $app->getModuleRoot() . 'programplan/ui/ganttfields.html.php';

            data('showFields', $this->config->programplan->ganttCustom->ganttFields);
            $ganttFields['column_text'] = $lang->programplan->ganttBrowseType['gantt'];
            $sections[] = array('control' => 'gantt', 'ganttLang' => $ganttLang, 'ganttFields' => $ganttFields, 'showChart' => true, 'colsWidth' => '500', 'options' => $plans, 'height' =>
         250);
        }
        elseif($showWithPageEditor)
        {
            if(!empty($review->data)) $sections[] = setting()->control('pageEditor')->content($review->data)->readonly(true);
        }
        else
        {
            if(!empty($doc))
            {
                if($doc->contentType == 'doc')
                {
                    $sections[] = setting()->control('pageEditor')
                        ->content(isset($doc->rawContent) ? $doc->rawContent : $doc->content)
                        ->readonly(true);
                }
                else
                {
                    $sections[] = setting()->title($doc->title)
                        ->control('html')
                        ->content($doc->content)
                        ->id($doc->contentType == 'markdown' ? 'markdownContent' : null);
                }
            }

            if(!empty($doc) && !empty($doc->files)) $sections[] = array('control' => 'fileList', 'files' => $doc->files, 'showDelete' => false, 'object' => $doc, 'padding' => false);
        }
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
                $sections[] = setting()->title($title)->titleActions($titleAction)
                    ->control('pageEditor')
                    ->content($deliverable->doc->rawContent)
                    ->readonly(true)
                    ->className($className);
                if(!empty($deliverable->doc->files)) $sections[] = array('control' => 'fileList', 'files' => $deliverable->doc->files, 'showDelete' => false, 'object' => $deliverable->doc, 'padding' => false);
            }
            elseif($showWithPageEditor)
            {
                $sections[] = setting()->title($title)->titleActions($titleAction)
                    ->control('pageEditor')
                    ->content($deliverable->data)
                    ->readonly(true)
                    ->className($className);
            }

            $i ++;
        }
    }
}

if(!empty($review->files)) $sections[] = array('control' => 'fileList', 'files' => $review->files, 'showDelete' => false, 'object' => $review, 'padding' => false);

$basicItems = array();
if($review->type == 'projectchange')
{
    $basicItems[$lang->projectchange->urgency] = zget($lang->projectchange->urgencyList, $projectchange->urgency);
    $basicItems[$lang->projectchange->type]    = zget($lang->projectchange->typeList, $projectchange->type);
    $basicItems[$lang->projectchange->owner]   = zget($users, $projectchange->owner);
}
else
{
    $basicItems[$lang->review->version] = $review->version;
}
$basicItems[$lang->review->status]      = zget($lang->review->statusList, $review->status);
$basicItems[$lang->review->reviewedBy]  = $review->reviewedBy ? implode(' ', array_map(function($account) use ($users){return zget($users, $account);}, explode(',', str_replace(' ', '', $review->reviewedBy)))) : '';
$basicItems[$lang->review->reviewer]    = array();
$basicItems[$lang->review->deadline]    = helper::isZeroDate($review->deadline) ? '' : substr($review->deadline, 0, 19);
$basicItems[$lang->review->createdBy]   = zget($users, $review->createdBy);
$basicItems[$lang->review->createdDate] = $review->createdDate;
$basicItems[$lang->review->reviewer]    = array
(
    'children' => wg(div
    (
        setClass('row gap-2 flex-wrap'),
        array_values(array_map(function($account, $resultList) use($users)
        {
            $class = (in_array('', $resultList)) ? '' : 'text-gray';
            return span(setClass("mr-1 $class"), zget($users, $account));
        }, array_keys($reviewerResult), array_values($reviewerResult)))
    ))
);
$tabs[] = setting()
    ->group('basic')
    ->title($lang->review->basicInfo)
    ->control('datalist')
    ->items($basicItems)
    ->labelWidth(100);

$actions    = $review->deleted ? array() : $this->loadModel('common')->buildOperateMenu($review);
$hasDivider = !empty($actions['mainActions']) && !empty($actions['suffixActions']);
if(!empty($actions)) $actions = array_merge($actions['mainActions'], $hasDivider ? array(array('type' => 'divider')) : array(), $actions['suffixActions']);
foreach($actions as $actionID => $action)
{
    if(!isset($action['icon'])) continue;
    if($action['icon'] == 'list-alt' && $review->type == 'deliverable' && empty($review->approval)) unset($actions[$actionID]);
    if($action['icon'] == 'edit')
    {
        if($review->type == 'baseline')
        {
            if(hasPriv('cm', 'edit')) $actions[$actionID]['url'] = createLink('cm', 'edit', "id={$review->object}");
            else unset($actions[$actionID]);
        }
        else if($review->type == 'projectchange')
        {
            if(hasPriv('projectchange', 'edit')) $actions[$actionID]['url'] = createLink('projectchange', 'edit', "id={$review->object}");
            else unset($actions[$actionID]);
        }
    }
}

$lastAction = end($actions);
if(isset($lastAction['type']) && $lastAction['type'] == 'divider') unset($actions[count($actions) - 1]);

$approvalID = isset($approval->id) ? $approval->id : 0;
detail
(
    set::object($review),
    set::objectType('review'),
    set::sections($sections),
    set::tabs($tabs),
    set::urlFormatter(array('{id}' => $review->id, '{approval}' => $approvalID, '{deliverable}' => $review->deliverable, '{project}' => $review->project, '{type}' => $review->type, '{rawCategory}' => $review->category)),
    set::actions(array_values($actions))
);
