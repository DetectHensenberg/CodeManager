<?php
/**
 * The view view file of researchplan module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yidong Wang<yidong@chandao.net>
 * @package     researchplan
 * @link        https://www.zentao.net
 */
namespace zin;

$actions = !$plan->deleted  ? $this->loadModel('common')->buildOperateMenu($plan) : array();
$actions = zget($actions, 'suffixActions', array());

/* 初始化主栏内容。Init sections in main column. */
$sections = array();
$sections[] = setting()
    ->title($lang->researchplan->outline)
    ->control('html')
    ->content(empty($plan->outline) ? $lang->noDesc : $plan->outline);
$sections[] = setting()
    ->title($lang->researchplan->schedule)
    ->control('html')
    ->content(empty($plan->schedule) ? $lang->noDesc : $plan->schedule);

$stakeholders = implode(' ', array_map(function($stakeholder) use ($users) { return zget($users, $stakeholder); }, explode(',', $plan->stakeholder)));
$teamUser = '';
foreach(explode(',', $plan->team) as $user) $teamUser .= zget($users, $user) . ' ';

$basicInfo = array();
$basicInfo[$lang->researchplan->customer]    = $plan->customer;
$basicInfo[$lang->researchplan->stakeholder] = implode(' ', array_map(function($stakeholder) use ($users) { return zget($users, $stakeholder); }, explode(',', $plan->stakeholder)));
$basicInfo[$lang->researchplan->objective]   = $plan->objective;
$basicInfo[$lang->researchplan->location]    = $plan->location;
$basicInfo[$lang->researchplan->begin]       = helper::isZeroDate($plan->begin) ? '' : $plan->begin;
$basicInfo[$lang->researchplan->end]         = helper::isZeroDate($plan->end) ? '' : $plan->end;
$basicInfo[$lang->researchplan->team]        = implode(' ', array_map(function($team) use ($users) { return zget($users, $team); }, explode(',', $plan->team)));
$basicInfo[$lang->researchplan->method]      = zget($lang->researchplan->methodList, $plan->method, '');

$lifeTime = array();
$lifeTime[$lang->researchplan->createdBy]   = zget($users, $plan->createdBy);
$lifeTime[$lang->researchplan->createdDate] = $plan->createdDate;
$lifeTime[$lang->researchplan->editedBy]    = zget($users, $plan->editedBy);
$lifeTime[$lang->researchplan->editedDate]  = $plan->editedDate;

/* 初始化侧边栏标签页。Init sidebar tabs. */
$tabs = array();

/* 基本信息。Legend basic items. */
$tabs[] = setting()
    ->group('basic')
    ->title($lang->researchplan->basicInfo)
    ->control('datalist')
    ->style(array('--datalist-label-width' => '80px'))
    ->items($basicInfo);

/* 一生信息。Legend life items. */
$tabs[] = setting()
    ->group('life')
    ->title($lang->researchplan->lifeTime)
    ->control('datalist')
    ->items($lifeTime);

detail
(
    set::object($plan),
    set::urlFormatter(array('{id}' => $plan->id)),
    set::sections($sections),
    set::tabs($tabs),
    set::actions(array_values($actions))
);
