<?php
/**
 * The view deliverable file of project module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     project
 * @version     $Id$
 * @link        http://www.zentao.net
 */
namespace zin;

$versions   = array();
$versionBox = null;
if($deliverable->reviews)
{
    if(!$reviewID) $reviewID = $review->id;
    foreach($deliverable->reviews as $id => $reviewData)
    {
        if(empty($reviewData->vsrsion)) $reviewVersion = $id;
        $baselineLabel = $reviewData->isBaseline ? "[{$lang->project->baseline}]" : '';
        $versionItem = setting()
            ->text("#{$reviewData->version} {$baselineLabel}")
            ->url(inlink('viewdeliverable', "id={$deliverable->id}&reviewID={$id}"));

        $versionItem->selected($id == $reviewID);
        $versions[] = $versionItem;
    }

    $version    = !empty($review->version) ? $review->version : $review->id;
    $baseline   = $review->isBaseline ? "[{$lang->project->baseline}]" : '';
    $versionBtn = btn(set::type('ghost'), setClass('text-link font-normal text-base'), "#{$version} {$baseline}");
    if(count($versions) > 1)
    {
        $versionBox = to::title
        (
            dropdown
            (
                $versionBtn,
                set::items($versions)
            )
        );
    }
    else
    {
        $versionBox = to::title($versionBtn);
    }
}

$sections = array();
if(!empty($deliverable->data) && empty($doc))
{
    $deliverableData    = json_decode($deliverable->data, true);
    $showWithPageEditor = isset($deliverableData['$migrate']) && $deliverableData['$migrate'] == 'html';
    if(!empty($review->template) && !$showWithPageEditor)
    {
        $reviewInfo = $this->loadModel('review')->getByID($review->id);
        $template   = $this->loadModel('doc')->getByID($review->template);
        $nodeTree   = $this->review->buildBookTree($template, $reviewInfo);
        $sections[] = setting()->control('treeEditor')->items($nodeTree)->canSplit(false);
    }
    else
    {
        $sections[] = setting()->control('pageEditor')->content($deliverable->data)->readonly(true);
    }
}
elseif(!empty($doc))
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

    if(!empty($doc) && !empty($doc->files)) $sections[] = array('control' => 'fileList', 'files' => $doc->files, 'showDelete' => false, 'object' => $doc, 'padding' => false);
}
else
{
    $sections[] = setting()->control('html')->content($lang->noData);
}

$renderStages = function() use ($deliverable, $lang, $stageList)
{
    $stages = array();
    foreach($deliverable->stages as $stage => $required)
    {
        $stages[] = zget($stageList, $stage) . ' ' . zget($lang->deliverable->requiredList, $required) . '<br/>';
    }

    return $stages;
};

$status = zget($lang->review->statusList, $deliverable->status);
if($deliverable->hasApproval == 0)
{
    $status = $deliverable->status == 'pass' ? $lang->project->confirmed : $lang->project->needConfirm;
}

$moduleName = zget($modules, $deliverable->module, '');
$moduleName = ltrim($moduleName, '/');
$basicItems = array();
$basicItems[$lang->deliverable->activity]      = array('control' => 'html', 'content' => zget($activities, $deliverable->activity, ''), 'title' => zget($activities, $deliverable->activity, ''));
$basicItems[$lang->deliverable->module]        = $moduleName;
$basicItems[$lang->deliverable->name]          = $deliverable->deliverableName;
$basicItems[$lang->deliverable->when]          = array('control' => 'html', 'content' => $renderStages);
$basicItems[$lang->project->submitFrom]        = $deliverable->submitFromName;
$basicItems[$lang->deliverable->versionStatus] = zget($lang->deliverable->versionStatusList, $deliverable->versionStatus, '');
$basicItems[$lang->deliverable->reviewStatus]  = $status;
$basicItems[$lang->deliverable->submitedBy]    = !empty($deliverable->createdBy) ? zget($users, $deliverable->createdBy) . $lang->at . $deliverable->createdDate : '';
$basicItems[$lang->review->submitedBy]         = isset($review->createdBy) ? zget($users, $review->createdBy) . $lang->at . $review->createdDate : '';
$basicItems[$lang->review->reviewedBy]         = isset($review->reviewedBy) ? implode(' ', array_map(function($account) use ($users){return zget($users, $account);}, explode(',', str_replace(' ', '', $review->reviewedBy)))) : '';

$tabs[] = setting()
    ->group('basic')
    ->title($lang->review->basicInfo)
    ->control('datalist')
    ->items($basicItems)
    ->labelWidth(100);

if(!empty($deliverable->files)) $sections[] = array('control' => 'fileList', 'files' => $deliverable->files, 'showDelete' => false, 'object' => $deliverable->review, 'padding' => false);

$operateList = $this->loadModel('common')->buildOperateMenu($deliverable);
$actions     = $operateList['mainActions'];
$divider     = empty($actions) ? array() : array(array('type' => 'divider'));
if(!empty($operateList['suffixActions'])) $actions = array_merge($actions, $divider, $operateList['suffixActions']);

foreach($actions as $id => $action)
{
    if(!isset($action['icon'])) continue;

    /* 如果交付物状态为通过，并且有更新，则可以再次创建评审。 */
    if($action['icon'] == 'sub-review')
    {
        if($deliverable->hasApproval == 0)
        {
            $actions[$id]['icon'] = 'ok';
            $actions[$id]['hint'] = $lang->project->updateVersion;
            $actions[$id]['text'] = $lang->project->updateVersion;
        }

        if($deliverable->status == 'pass')
        {
            $actions[$id]['url'] = helper::createLink('review', 'create', "projectID={$deliverable->project}&deliverable={$deliverable->id}&reviewID=0&type=deliverable");
        }
    }

    if($action['icon'] != 'edit') continue;
    if(!$deliverable->editLink || $deliverable->status == 'reviewing' || !empty($deliverable->frozen))
    {
        unset($actions[$id]);
        continue;
    }

    $actions[$id]['url'] = $deliverable->editLink;
    if($deliverable->linkAttr == 'blank')
    {
        $actions[$id]['target'] = '_blank';
        unset($actions[$id]['data-toggle']);
    }
}

/* 如果最后一个是分隔符，则删除。 */
$endAction = end($actions);
if(isset($endAction['type']) && $endAction['type'] == 'divider')
{
    $lastIndex = count($actions) - 1;
    unset($actions[$lastIndex]);
}

detail
(
    set::object($deliverable),
    set::objectType('projectdeliverable'),
    set::sections($sections),
    set::history(array('commentBtn' => false)),
    set::tabs($tabs),
    set::urlFormatter(array('{review}' => $deliverable->reviewID, '{id}' => $deliverable->id, '{project}' => $deliverable->project)),
    set::actions(array_values($actions)),
    $versionBox
);
