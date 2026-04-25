<?php
/**
 * The view file of cm module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     cm
 * @link        https://www.zentao.net
 */
namespace zin;

$operateList = $this->loadModel('common')->buildOperateMenu($baseline);
$actions     = $operateList['mainActions'];
if(!empty($operateList['suffixActions'])) $actions = array_merge($actions, $actions ? array(array('type' => 'divider')) : array(), $operateList['suffixActions']);

/* 初始化主栏内容。Init sections in main column. */
$sections = array();
$sections[] = setting()->control(array('control' => 'dtable', 'cols' => array_values($config->cm->deliverable->dtable->fieldList), 'data' => array_values($deliverables), 'userMap' => $users));

$items = array();
$items[$lang->cm->title]       = $baseline->title;
$items[$lang->cm->version]     = $baseline->version;
$items[$lang->cm->end]         = $baseline->end;
$items[$lang->cm->createdBy]   = zget($users, $baseline->createdBy);
$items[$lang->cm->createdDate] = $baseline->createdDate;

$tabs[] = setting()
    ->group('basic')
    ->title($lang->cm->basicInfo)
    ->control('datalist')
    ->items($items)
    ->labelWidth(80);

detail
(
    set::object($baseline),
    set::urlFormatter(array('{id}' => $baseline->id, '{approval}' => $baseline->approval, '{reviewID}' => $baseline->reviewID)),
    set::sections($sections),
    set::tabs($tabs),
    set::actions(array_values($actions))
);
