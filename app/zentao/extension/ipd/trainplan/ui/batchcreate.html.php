<?php
/**
 * The batchCreate view file of trainplan module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang <wangyuting@easycorp.ltd>
 * @package     trainplan
 * @link        https://www.zentao.net
 */
namespace zin;

$items = array();
$items[] = array('label' => $lang->idAB,                'name' => 'id',       'control' => 'index',  'width' => '50px');
$items[] = array('label' => $lang->trainplan->name,     'name' => 'name',     'control' => 'input', 'required' => true);
$items[] = array('label' => $lang->trainplan->begin,    'name' => 'begin',    'control' => 'datePicker');
$items[] = array('label' => $lang->trainplan->end,      'name' => 'end',      'control' => 'datePicker');
$items[] = array('label' => $lang->trainplan->place,    'name' => 'place',    'control' => 'input');
$items[] = array('label' => $lang->trainplan->trainee,  'name' => 'trainee',  'control' => 'picker', 'items' => $members, 'multiple' => true);
$items[] = array('label' => $lang->trainplan->lecturer, 'name' => 'lecturer', 'control' => 'input');
$items[] = array('label' => $lang->trainplan->type,     'name' => 'type',     'control' => array('control' => 'radioList', 'inline' => true), 'items' => $lang->trainplan->typeList, 'value' => 'inside', 'width' => '200px');

formBatchPanel(set::title($title), set::items($items));
