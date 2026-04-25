<?php
/**
 * The view file of auditplan module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     auditplan
 * @link        https://www.zentao.net
 */
namespace zin;
global $app;

$operateList = $this->loadModel('common')->buildOperateMenu($auditplan);
$actions     = $operateList['mainActions'];
if(!empty($actions)) $actions = array_merge($actions, array(array('type' => 'divider')));
if(!empty($operateList['suffixActions'])) $actions = array_merge($actions, $operateList['suffixActions']);

/* 初始化主栏内容。Init sections in main column. */
$sections = array();
$sections[] = setting()
    ->title($lang->auditplan->result)
    ->control(array('control' => 'dtable', 'cols' => array_values($config->auditplan->result->dtable->fieldList), 'data' => array_values($results), 'userMap' => $users));

$sections[] = setting()
    ->title($lang->auditplan->nc)
    ->control(array('control' => 'dtable', 'cols' => array_values($config->auditplan->nc->dtable->fieldList), 'data' => array_values($ncs), 'userMap' => $users));

$items = array();
$items[$lang->auditplan->execution]     = zget($executions, $auditplan->execution, '');
$items[$lang->auditplan->process]       = zget($processList, $auditplan->process, '');
if($auditplan->objectType == 'activity') $items[$lang->auditplan->activity] = $auditplan->name;
if($auditplan->objectType == 'zoutput')  $items[$lang->auditplan->zoutput]  = $auditplan->name;
$items[$lang->auditplan->status]        = zget($lang->auditplan->statusList, $auditplan->status);
$items[$lang->auditplan->assignedTo]    = zget($users, $auditplan->assignedTo) . (formatTime($auditplan->assignedDate) ? $lang->at . $auditplan->assignedDate : '');
$items[$lang->auditplan->checkDate]     = $auditplan->checkDate;
$items[$lang->auditplan->realCheckDate] = zget($users, $auditplan->checkedBy) . (formatTime($auditplan->realCheckDate) ? $lang->at . $auditplan->realCheckDate : '');
$items[$lang->auditplan->createdBy]     = zget($users, $auditplan->createdBy) . (formatTime($auditplan->createdDate) ? $lang->at . $auditplan->createdDate : '');
$items[$lang->auditplan->editedBy]      = zget($users, $auditplan->editedBy)  . (formatTime($auditplan->editedDate)  ? $lang->at . $auditplan->editedDate  : '');

/* 初始化侧边栏标签页。Init sidebar tabs. */
$tabs = array();

/* 基本信息。Legend basic items. */
$tabs[] = setting()
    ->group('basic')
    ->title($lang->auditplan->basicInfo)
    ->labelWidth('80')
    ->control('datalist')
    ->items($items);

detail
(
    set::urlFormatter(array('{id}' => $auditplan->id)),
    set::sections($sections),
    set::tabs($tabs),
    set::actions(array_values($actions))
);
