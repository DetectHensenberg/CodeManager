<?php
/**
 * The create file of durationestimation module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     durationestimation
 * @link        https://www.zentao.net
 */
namespace zin;

jsVar('projectID', $project->id);
jsVar('estimation', $workestimation);

$totalWorkload = 0;
$totalStaff    = 0;
foreach($stages as $stage)
{
    $estimation           = zget($estimationList, $stage->id, array());
    $stage->stage         = $stage->id;
    $stage->workload      = zget($estimation, 'workload', $stage->percent);
    $stage->workloadLabel = zget($workestimation, 'scale', 0) * $stage->workload / 100;
    $stage->worktimeRate  = zget($estimation, 'workload', $stage->percent);
    $stage->people        = zget($estimation, 'people',    0);
    $stage->startDate     = zget($estimation, 'startDate', '');
    $stage->endDate       = zget($estimation, 'endDate',   '');

    $totalWorkload += $stage->workloadLabel;
    $totalStaff    += $stage->people;
}

$formBatchItems = array();
$formBatchItems[] = array('name' => 'stage' , 'control' => 'input', 'hidden' => true);
$formBatchItems[] = array('label' => $lang->durationestimation->stage,                              'name' => 'name' ,         'control' => 'input');
$formBatchItems[] = array('label' => $lang->durationestimation->workloadRate . "(%)",               'name' => 'workload',      'control' => array('control' => 'number', 'data-on' => 'change', 'data-call' => 'changeWorkload', 'data-params' => 'event'));
$formBatchItems[] = array('label' => $lang->durationestimation->workload . "({$lang->hourCommon})", 'name' => 'workloadLabel', 'control' => 'input', 'disabled' => true);
$formBatchItems[] = array('label' => $lang->durationestimation->worktimeRate . '(%)',               'name' => 'worktimeRate',  'control' => 'number');
$formBatchItems[] = array('label' => $lang->durationestimation->people,                             'name' => 'people',        'control' => array('control' => 'number', 'data-on' => 'change', 'data-call' => 'computeTotalStaff', 'data-params' => 'event'));
$formBatchItems[] = array('label' => $lang->durationestimation->startDate,                          'name' => 'startDate',     'control' => array('control' => 'date', 'data-on' => 'change', 'data-call' => 'computeEndDate', 'data-params' => 'event'));
$formBatchItems[] = array('label' => $lang->durationestimation->endDate,                            'name' => 'endDate',       'control' => 'date');

formBatchPanel
(
    empty($stages) ? set::actions('') : null,
    set::mode('edit'),
    set::data(array_values($stages)),
    set::items($formBatchItems)
);

query('.form-actions')->before(html("<div class='pl-6'>" . sprintf($lang->durationestimation->summary, zget($workestimation, 'scale', ''), $totalWorkload, $totalStaff) . "</div>"));
