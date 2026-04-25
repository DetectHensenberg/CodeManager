<?php
/**
 * The summary view of budget module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.cnezsoft.com)
 * @license     ZPL(http://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun<sunguangming@chandao.com>
 * @package     budget
 * @link        http://www.zentao.net
 */
namespace zin;

$canModify = common::canModify('project', $project);
$itemLink  = array(
    'summary' => createLink('budget', 'summary', "projectID=$projectID"),
    'list'    => createLink('budget', 'browse', "projectID=$projectID")
);

featureBar
(
    set::current('summary'),
    set::itemLink($itemLink),
    set::module('budget'),
    set::method('summary')
);

toolbar
(
    $canModify && hasPriv('budget', 'batchCreate') ? item(set(array(
        'url'   => createLink('budget', 'batchcreate', "projectID=$projectID"),
        'class' => 'btn secondary',
        'icon'  => 'plus',
        'text'  => $lang->budget->batchCreate
    ))) : null,
    $canModify && hasPriv('budget', 'create') ? item(set(array(
        'url'   => createLink('budget', 'create', "projectID=$projectID"),
        'class' => 'btn primary',
        'icon'  => 'plus',
        'text'  => $lang->budget->create
    ))) : null
);

if(empty($subjects))
{
    div(
        setClass('dtable'),
        div(setClass('dtable-empty-tip'), p(setClass('text-muted'), $lang->noData))
    );
}
else
{
    $header1Cells = array(h::th(set('rowspan', $hasSubSubject ? 2 : 1), $lang->budget->stage));
    foreach($subjects as $id => $subject) $header1Cells[] = h::th(set('colspan', count($subject)), zget($modules, $id));
    $header1Cells[] = h::th(set('rowspan', $hasSubSubject ? 2 : 1), $lang->budget->summary);

    $header2Cells = array();
    if($hasSubSubject)
    {
        foreach($subjects as $id => $subject)
        {
            foreach($subject as $subjectID) $header2Cells[] = h::th(zget($modules, $subjectID));
        }
    }

    $bodyRows = array();
    foreach($summary['stages'] as $stageID => $subject)
    {
        $cells = array(h::td(zget($plans, $stageID, $stageID)));
        foreach($subject as $cost) $cells[] = h::td($cost);

        $cells[]    = h::td(array_sum($subject));
        $bodyRows[] = h::tr($cells);
    }

    $footCells = array(h::td(setClass('font-bold'), $lang->budget->summary));
    foreach($summary['subjects'] as $cost) $footCells[] = h::td(setClass('font-bold'), $cost);
    $footCells[] = h::td(setClass('font-bold'), array_sum($summary['subjects']));

    div
    (
        setClass('center-block'),
        h::table
        (
            setClass('table bordered'),
            h::thead
            (
                h::tr(setClass('text-left table-title'), $header1Cells),
                $hasSubSubject ? h::tr(setClass('text-left table-title'), $header2Cells) : null
            ),
            h::tbody($bodyRows),
            h::tfoot(h::tr(setClass('summary font-bold'), $footCells))
        ),
        div
        (
            setClass('alert alert-info mg-0'),
            $lang->budget->total . '：' . array_sum($summary['subjects']) . (isset($project->budgetUnit) ? $lang->budget->{$project->budgetUnit} : '')
        )
    );
}
