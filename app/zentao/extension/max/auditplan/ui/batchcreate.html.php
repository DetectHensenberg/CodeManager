<?php
/**
 * The batchCreate view file of auditplan module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang <wangyuting@easycorp.ltd>
 * @package     auditplan
 * @link        https://www.zentao.net
 */
namespace zin;

jsVar('activityList', $activityList);

$items = array();
$items[] = array('label' => $lang->idAB,                  'name' => 'id',         'control' => 'index',  'width' => '50px');
$items[] = array('label' => $lang->auditplan->execution,  'name' => 'execution',  'control' => 'picker', 'items' => $executions,  'value' => !empty($executionID) ? $executionID : '', 'ditto' => true);
$items[] = array('label' => $lang->auditplan->process,    'name' => 'process',    'control' => array('control' => 'picker', 'required' => false), 'items' => $processList, 'required' => true, 'ditto' => true, 'defaultDitto' => false);
$items[] = array('label' => $lang->auditplan->objectID,   'name' => 'objectID',   'control' => array('control' => 'picker', 'required' => false), 'items' => array(),      'required' => true);
$items[] = array('label' => $lang->auditplan->checkDate,  'name' => 'checkDate',  'control' => 'date',   'required' => true);
$items[] = array('label' => $lang->auditplan->assignedTo, 'name' => 'assignedTo', 'control' => 'picker', 'items' => $users, 'ditto' => true);

formBatchPanel
(
    to::heading(div(setClass('panel-title text-lg'), $title, !empty($isUpgrade) ? span(setClass('font-normal text-sm'), $lang->auditplan->upgradeTip) : null)),
    on::change('[data-name="process"]', 'changeProcess'),
    set::onRenderRow(jsRaw('renderRowData')),
    set::data(array_values($auditplans)),
    set::items($items)
);

