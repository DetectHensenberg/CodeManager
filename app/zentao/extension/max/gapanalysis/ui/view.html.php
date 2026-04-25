<?php
/**
 * The select template view file of doc module of ZenTaoPMS.
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yue Liu<liuyue@chandao.com>
 * @package     gapanalysis
 * @link        https://www.zentao.net
 */
namespace zin;

/* 初始化底部操作栏。Init bottom actions. */
$actions = array();
$canEdit = common::hasPriv('gapanalysis', 'edit');
if(!$gapanalysis->deleted && $canEdit)
{
    $operateList = $this->loadModel('common')->buildOperateMenu($gapanalysis);
    $actions = $operateList['suffixActions'];
}

$getBasicInfoItems = [
    $lang->gapanalysis->account   => zget($users, $gapanalysis->account),
    $lang->gapanalysis->role      => zget($lang->user->roleList, $gapanalysis->role),
    $lang->gapanalysis->needTrain => zget($lang->gapanalysis->needTrainList, $gapanalysis->needTrain)
];

$getLegendInfoItems = [
    $lang->gapanalysis->createdBy   => zget($users, $gapanalysis->createdBy),
    $lang->gapanalysis->createdDate => $gapanalysis->createdDate,
    $lang->gapanalysis->editedBy    => zget($users, $gapanalysis->editedBy),
    $lang->gapanalysis->editedDate  => helper::isZeroDate($gapanalysis->editedDate) ? '' : $gapanalysis->editedDate
];

/* 初始化侧边栏标签页。Init sidebar tabs. */
$tabs = array();

$tabs[] = setting()
    ->group('basic')
    ->title($lang->gapanalysis->legendBasicInfo)
    ->control('datalist')
    ->items($getBasicInfoItems)
    ->labelWidth(80);

$tabs[] = setting()
    ->group('related')
    ->title($lang->gapanalysis->legendLifeTime)
    ->control('datalist')
    ->items($getLegendInfoItems);

/* 初始化主栏内容。Init sections in main column. */
$sections = array();
$sections[] = setting()
    ->title($lang->gapanalysis->analysis)
    ->control('html')
    ->content($gapanalysis->analysis);

detail
(
    set::title(zget($users, $gapanalysis->account)),
    set::sections($sections),
    set::tabs($tabs),
    set::actions($actions)
);
