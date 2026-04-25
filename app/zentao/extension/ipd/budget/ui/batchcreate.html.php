<?php
/**
 * The batchCreate view of budget module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.cnezsoft.com)
 * @license     ZPL(http://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun<sunguangming@chandao.com>
 * @package     budget
 * @link        http://www.zentao.net
 */
namespace zin;

$items = array();
$items[] = array('name' => 'id', 'label' => $lang->idAB, 'control' => 'index', 'width' => '40px');
$items[] = array('name' => 'stage', 'label' => $lang->budget->stage, 'control' => array('control' => 'picker', 'items' => $plans), 'width' => '200px', 'required' => true);
$items[] = array('name' => 'subject', 'label' => $lang->budget->subject, 'control' => array('control' => 'picker', 'items' => $subjects), 'width' => '200px', 'required' => true);
$items[] = array('name' => 'name', 'label' => $lang->budget->name, 'control' => 'input', 'width' => '250px', 'required' => true);
$items[] = array('name' => 'amount', 'label' => $lang->budget->amount, 'control' => 'input', 'width' => '150px');
$items[] = array('name' => 'desc', 'label' => $lang->budget->desc, 'control' => 'input', 'width' => '180px');

formBatchPanel
(
    set::title($lang->budget->batchCreate),
    set::url(createLink('budget', 'batchCreate', "projectID=$projectID")),
    set::items($items),
    set::minRows(10)
);
