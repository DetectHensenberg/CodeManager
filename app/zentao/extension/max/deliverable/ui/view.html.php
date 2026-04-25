<?php
/**
 * The view file of deliverable module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     deliverable
 * @link        https://www.zentao.net
 */
namespace zin;

$renderStages = function() use ($deliverable, $lang, $stageList)
{
    $stages = array();
    foreach($deliverable->stages as $stage => $required)
    {
        $stages[] = zget($stageList, $stage) . ' ' . zget($lang->deliverable->requiredList, $required) . '<br/>';
    }

    return $stages;
};

$items[$lang->deliverable->module] = zget($modules, $deliverable->module);
$items[$lang->deliverable->status] = zget($lang->deliverable->statusList, $deliverable->status, '');
if($hasProcess)
{
    $items[$lang->deliverable->activity]  = array('control' => 'html', 'content' => zget($activities, $deliverable->activity, ''), 'title' => zget($activities, $deliverable->activity, ''));
    $items[$lang->deliverable->trimmable] = zget($lang->deliverable->trimmableList, $deliverable->trimmable);
    $items[$lang->deliverable->trimRule]  = array('control' => 'html', 'content' => $deliverable->trimRule);
}
$items[$lang->deliverable->when]         = array('control' => 'html', 'content' => $renderStages);
$items[$lang->deliverable->createdBy]    = zget($users, $deliverable->createdBy) . $lang->at . $deliverable->createdDate;
$items[$lang->deliverable->lastEditedBy] = $deliverable->lastEditedBy ? (zget($users, $deliverable->lastEditedBy) . $lang->at . $deliverable->lastEditedDate) : '';

$operateList = $this->loadModel('common')->buildOperateMenu($deliverable);
if($deliverable->deleted)
{
    $actions = array();
}
else
{
    $actions = $operateList['mainActions'];
    $divider = empty($actions) ? array() : array(array('type' => 'divider'));
    if (!empty($operateList['suffixActions'])) $actions = array_merge($actions, $divider, $operateList['suffixActions']);
}

/* 初始化主栏内容。Init sections in main column. */
$sections   = array();
$sections[] = setting()
    ->title($lang->deliverable->desc)
    ->control('html')
    ->content($deliverable->desc);

if(!empty($deliverable->template))
{
    $sections[] = setting()
        ->control('deliverable')
        ->title($lang->deliverable->template)
        ->isTemplate(true)
        ->extraCategory($lang->other)
        ->onlyShow(true)
        ->items($deliverable->template);
}

/* 初始化侧边栏标签页。Init sidebar tabs. */
$tabs = array();

/* 基本信息。Legend basic items. */
$tabs[] = setting()
    ->group('basic')
    ->title($lang->deliverable->basicInfo)
    ->control('datalist')
    ->items($items);

detail
(
    set::urlFormatter(array('{id}' => $deliverable->id)),
    set::sections($sections),
    set::tabs($tabs),
    set::actions(array_values($actions))
);
