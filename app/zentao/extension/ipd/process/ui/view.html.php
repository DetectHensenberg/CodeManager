<?php
/**
 * The view file of process module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     process
 * @link        https://www.zentao.net
 */
namespace zin;

$operateList = $this->loadModel('common')->buildOperateMenu($process);
$actions     = $operateList['mainActions'];
if(!empty($operateList['suffixActions'])) $actions = array_merge($actions, array(array('type' => 'divider')), $operateList['suffixActions']);

/* 初始化主栏内容。Init sections in main column. */
$sections = array();
$sections[] = setting()
    ->title($lang->process->desc)
    ->control('html')
    ->content($process->desc);

$items = array();
$items[$lang->process->module]    = zget($modules, $process->module, '');
$items[$lang->process->abbr]      = $process->abbr;
$items[$lang->process->createdBy] = zget($users, $process->createdBy) . (formatTime($process->createdDate) ? $lang->at . $process->createdDate : '');
$items[$lang->process->editedBy]  = zget($users, $process->editedBy)  . (formatTime($process->editedDate)  ? $lang->at . $process->editedDate  : '');

/* 初始化侧边栏标签页。Init sidebar tabs. */
$tabs = array();

/* 基本信息。Legend basic items. */
$tabs[] = setting()
    ->group('basic')
    ->title($lang->process->basicInfo)
    ->control('datalist')
    ->items($items);

detail
(
    set::urlFormatter(array('{id}' => $process->id, '{workflowGroup}' => $process->workflowGroup)),
    set::sections($sections),
    set::tabs($tabs),
    set::actions(array_values($actions))
);
