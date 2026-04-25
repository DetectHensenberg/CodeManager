<?php
/**
 * The view file of activity module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     activity
 * @link        https://www.zentao.net
 */
namespace zin;
global $app;

$operateList = $this->loadModel('common')->buildOperateMenu($activity);
$actions     = $operateList['mainActions'];
if(!empty($operateList['suffixActions'])) $actions = array_merge($actions, $operateList['suffixActions']);

/* 初始化主栏内容。Init sections in main column. */
$sections = array();
$sections[] = setting()
    ->title($lang->activity->content)
    ->control('html')
    ->content($activity->content);

$items = array();
$items[$lang->activity->process]    = zget($processes, $activity->process, '');
$items[$lang->activity->optional]   = zget($lang->activity->optionalList, $activity->optional, '');
$items[$lang->activity->tailorNorm] = $activity->tailorNorm;
$items[$lang->activity->createdBy]  = zget($users, $activity->createdBy) . (formatTime($activity->createdDate) ? $lang->at . $activity->createdDate : '');
$items[$lang->activity->editedBy]   = zget($users, $activity->editedBy)  . (formatTime($activity->editedDate)  ? $lang->at . $activity->editedDate  : '');

/* 初始化侧边栏标签页。Init sidebar tabs. */
$tabs = array();

/* 基本信息。Legend basic items. */
$tabs[] = setting()
    ->group('basic')
    ->title($lang->activity->basicInfo)
    ->control('datalist')
    ->items($items);

detail
(
    set::urlFormatter(array('{id}' => $activity->id)),
    set::sections($sections),
    set::tabs($tabs),
    set::actions(array_values($actions))
);
