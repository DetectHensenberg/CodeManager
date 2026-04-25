<?php
/**
 * The index file of durationestimation module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     durationestimation
 * @link        https://www.zentao.net
 */
namespace zin;

foreach($stages as $stage)
{
    $estimation           = zget($estimationList, $stage->id, array());
    $stage->workload      = zget($estimation, 'workload',     '') . '%';
    $stage->worktimeRate  = zget($estimation, 'worktimeRate', '') . '%';
    $stage->people        = zget($estimation, 'people',       '');
    $stage->startDate     = zget($estimation, 'startDate',    '');
    $stage->endDate       = zget($estimation, 'endDate',      '');
}

$cols = array();
$cols['name']         = array('title' => $lang->durationestimation->stage,        'name' => 'name',         'type' => 'category', 'group' => 1);
$cols['workload']     = array('title' => $lang->durationestimation->workload,     'name' => 'workload',     'type' => 'category', 'group' => 1);
$cols['worktimeRate'] = array('title' => $lang->durationestimation->worktimeRate, 'name' => 'worktimeRate', 'type' => 'category', 'group' => 1);
$cols['people']       = array('title' => $lang->durationestimation->people,       'name' => 'people',       'type' => 'category', 'group' => 1);
$cols['startDate']    = array('title' => $lang->durationestimation->startDate,    'name' => 'startDate',    'type' => 'category', 'group' => 1);
$cols['endDate']      = array('title' => $lang->durationestimation->endDate,      'name' => 'endDate',      'type' => 'category', 'group' => 1);

common::canModify('project', $project) && common::hasPriv('durationestimation', 'create') ? toolbar
(
    setClass('w-full flex justify-end'),
    item(set(array('text' => $lang->durationestimation->setting, 'url' => inlink('create', "projectID={$project->id}"), 'class' => 'btn primary', 'icon' => 'backend')))
) : null;

dtable
(
    set::cols($cols),
    set::data(array_values($stages))
);
