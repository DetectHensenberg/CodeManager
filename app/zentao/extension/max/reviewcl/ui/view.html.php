<?php
/**
 * The view file of reviewcl module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     reviewcl
 * @link        https://www.zentao.net
 */
namespace zin;
global $app;

$operateList = $this->loadModel('common')->buildOperateMenu($reviewcl);
$actions     = $operateList['mainActions'];

$items = array();
$items[$lang->reviewcl->title]      = $reviewcl->title;
$items[$lang->reviewcl->object]     = zget($reviewPairs, $reviewcl->object);
$items[$lang->reviewcl->category]   = zget($categories, $reviewcl->category);
$items[$lang->reviewcl->createdBy]  = zget($users, $reviewcl->createdBy) . (formatTime($reviewcl->createdDate) ? $lang->at . $reviewcl->createdDate : '');
$items[$lang->reviewcl->editedBy]   = zget($users, $reviewcl->editedBy)  . (formatTime($reviewcl->editedDate)  ? $lang->at . $reviewcl->editedDate  : '');

/* 初始化侧边栏标签页。Init sidebar tabs. */
$tabs = array();

/* 基本信息。Legend basic items. */
$tabs[] = setting()
    ->group('basic')
    ->title($lang->reviewcl->basicInfo)
    ->control('datalist')
    ->items($items);

detail
(
    set::urlFormatter(array('{id}' => $reviewcl->id)),
    set::sections(array()),
    set::tabs($tabs),
    set::actions(array_values($actions))
);
