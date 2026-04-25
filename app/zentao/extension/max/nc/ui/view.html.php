<?php
/**
 * The view file of nc module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     nc
 * @link        https://www.zentao.net
 */
namespace zin;
global $app;

$operateList = $this->loadModel('common')->buildOperateMenu($nc);
$actions     = $operateList['mainActions'];
if(!empty($operateList['suffixActions'])) $actions = array_merge($actions, array(array('type' => 'divider')), $operateList['suffixActions']);

/* 初始化主栏内容。Init sections in main column. */
$sections = array();
$sections[] = setting()
    ->title($lang->nc->desc)
    ->control('html')
    ->content($nc->desc);

$items = array();
$items[$lang->nc->type]       = zget($lang->nc->typeList, $nc->type, '');
$items[$lang->nc->execution]  = zget($executions, $nc->execution, '');

if($nc->objectType == 'activity')
{
    $items[$lang->auditplan->activity] = $nc->objectTitle;
}
elseif($nc->objectType == 'zoutput')
{
    $items[$lang->auditplan->zoutput]  = $nc->objectTitle;
}

$items[$lang->nc->status]     = zget($lang->nc->statusList, $nc->status);
$items[$lang->nc->deadline]   = $nc->deadline;
$items[$lang->nc->createdBy]  = zget($users, $nc->createdBy) . (formatTime($nc->createdDate) ? $lang->at . $nc->createdDate : '');
$items[$lang->nc->resolution] = zget($lang->nc->resolutionList, $nc->resolution, '');
$items[$lang->nc->resolvedBy] = zget($users, $nc->resolvedBy) . (formatTime($nc->resolvedDate) ? $lang->at . $nc->resolvedDate : '');
$items[$lang->nc->closedBy]   = zget($users, $nc->closedBy)   . (formatTime($nc->closedDate)   ? $lang->at . $nc->closedDate   : '');

/* 初始化侧边栏标签页。Init sidebar tabs. */
$tabs = array();

/* 基本信息。Legend basic items. */
$tabs[] = setting()
    ->group('basic')
    ->title($lang->nc->basicInfo)
    ->labelWidth('80')
    ->control('datalist')
    ->items($items);

detail
(
    set::urlFormatter(array('{id}' => $nc->id)),
    set::sections($sections),
    set::tabs($tabs),
    set::actions(array_values($actions))
);
