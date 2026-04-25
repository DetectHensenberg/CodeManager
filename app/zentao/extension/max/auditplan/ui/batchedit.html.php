<?php
/**
 * The batchEdit view file of auditplan module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang <wangyuting@easycorp.ltd>
 * @package     auditplan
 * @link        https://www.zentao.net
 */
namespace zin;

jsVar('activityList', $activityList);
$isCycle = current($auditplans)->cycleType != 'noCycle' ? true : false;

$items = array();
$items[] = array('label' => $lang->idAB,                  'control' => 'index',   'width' => '50px');
$items[] = array('label' => $lang->idAB,                  'name' => 'id',         'control' => 'hidden', 'hidden' => true);
$items[] = array('label' => $lang->auditplan->execution,  'name' => 'execution',  'control' => 'picker', 'items' => $executions);
$items[] = array('label' => $lang->auditplan->process,    'name' => 'process',    'control' => 'picker', 'items' => $processList, 'required' => true);
$items[] = array('label' => $lang->auditplan->objectID,   'name' => 'objectID',   'control' => 'picker', 'items' => array(),      'required' => true);
if(!$isCycle) $items[] = array('label' => $lang->auditplan->checkDate,  'name' => 'checkDate',  'control' => 'date',   'required' => true);
$items[] = array('label' => $lang->auditplan->assignedTo, 'name' => 'assignedTo', 'control' => array('control' => 'picker', 'required' => false), 'items' => $users, 'required' => $isCycle);

formBatchPanel
(
    on::change('[data-name="process"]', 'changeProcess'),
    set::onRenderRow(jsRaw('renderRowData')),
    set::title($lang->auditplan->batchEdit),
    set::mode('edit'),
    set::data(array_values($auditplans)),
    set::items($items)
);

