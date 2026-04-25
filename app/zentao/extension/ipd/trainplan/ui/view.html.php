<?php
/**
 * The view file of trainplan module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     trainplan
 * @link        https://www.zentao.net
 */
namespace zin;

$operateList = $this->loadModel('common')->buildOperateMenu($trainplan);
$actions     = $operateList['mainActions'];
if(!empty($actions)) $actions = array_merge($actions, array(array('type' => 'divider')));
if(!empty($operateList['suffixActions'])) $actions = array_merge($actions, $operateList['suffixActions']);

/* 初始化主栏内容。Init sections in main column. */
$sections = array();
$sections[] = setting()
    ->title($lang->trainplan->summary)
    ->control('html')
    ->content($trainplan->summary);

$trainee = '';
foreach($trainplan->trainee as $user) $trainee .= zget($users, $user) . ',';

$basicItems = array();
$basicItems[$lang->trainplan->status]    = zget($lang->trainplan->statusList, $trainplan->status, '');
$basicItems[$lang->trainplan->type]      = zget($lang->trainplan->typeList,   $trainplan->type,   '');
$basicItems[$lang->trainplan->place]     = $trainplan->place;
$basicItems[$lang->trainplan->trainee]   = trim($trainee, ',');
$basicItems[$lang->trainplan->lecturer]  = $trainplan->lecturer;
$basicItems[$lang->trainplan->begin]     = $trainplan->begin;
$basicItems[$lang->trainplan->end]       = $trainplan->end;

$lifeItems = array();
$lifeItems[$lang->trainplan->createdBy] = zget($users, $trainplan->createdBy) . (formatTime($trainplan->createdDate) ? $lang->at . $trainplan->createdDate : '');
$lifeItems[$lang->trainplan->editedBy]  = zget($users, $trainplan->editedBy)  . (formatTime($trainplan->editedDate)  ? $lang->at . $trainplan->editedDate  : '');

/* 初始化侧边栏标签页。Init sidebar tabs. */
$tabs = array();

/* 基本信息。Legend basic items. */
$tabs[] = setting()
    ->group('basic')
    ->title($lang->trainplan->legendBasicInfo)
    ->labelWidth('80')
    ->control('datalist')
    ->items($basicItems);

/* 计划的一生。Life time. */
$tabs[] = setting()
    ->group('life')
    ->title($lang->trainplan->legendLifeTime)
    ->labelWidth('80')
    ->control('datalist')
    ->items($lifeItems);

detail
(
    set::urlFormatter(array('{id}' => $trainplan->id)),
    set::sections($sections),
    set::tabs($tabs),
    set::actions(array_values($actions))
);
