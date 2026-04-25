<?php
/**
 * The view file of budget module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.cnezsoft.com)
 * @license     ZPL(http://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun<sunguangming@chandao.com>
 * @package     budget
 * @link        http://www.zentao.net
 */
namespace zin;

$operateList = $this->loadModel('common')->buildOperateMenu($budget);
$actions     = $operateList['mainActions'] ?? array();
if(!empty($operateList['suffixActions'])) $actions = array_merge($actions, $operateList['suffixActions']);

$basicInfoItems = array();
$basicInfoItems[$lang->budget->stage]          = array('control' => 'text', 'text' => zget($plans, $budget->stage));
$basicInfoItems[$lang->budget->subject]        = array('control' => 'text', 'text' => zget($subjects, $budget->subject));
$basicInfoItems[$lang->budget->amount]         = array('control' => 'text', 'text' => $budget->amount);
$basicInfoItems[$lang->budget->createdBy]      = array('control' => 'text', 'text' => zget($users, $budget->createdBy));
$basicInfoItems[$lang->budget->createdDate]    = array('control' => 'text', 'text' => $budget->createdDate);
$basicInfoItems[$lang->budget->lastEditedBy]   = array('control' => 'text', 'text' => zget($users, $budget->lastEditedBy));
$basicInfoItems[$lang->budget->lastEditedDate] = array('control' => 'text', 'text' => $budget->lastEditedDate);

$sections   = array();
$sections[] = setting()
    ->title($lang->budget->desc)
    ->control('html')
    ->content(empty($budget->desc) ? $lang->noDesc : $budget->desc);

$tabs = array();
$tabs[] = setting()->group('basic')->title($lang->budget->basicInfo)->control('datalist')->items($basicInfoItems);

if($budget->deleted == '1') $actions = array();
detail
(
    set::objectType('budget'),
    set::objectID($budget->id),
    set::sections($sections),
    set::tabs($tabs),
    set::actions(array_values($actions))
);
