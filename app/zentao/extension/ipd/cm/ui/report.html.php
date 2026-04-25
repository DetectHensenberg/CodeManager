<?php
/**
 * The report view file of cm module of ZenTaoPMS.
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Shujie Tian <tianshujie@chandao.com>
 * @package     cm
 * @link        https://www.zentao.net
 */
namespace zin;

if(!isInModal() && !$this->session->notHead)
{
    toolbar
    (
        setClass('flex justify-between w-full'),
        btn($lang->goback, set::icon('back'), setClass('ghost'), set::url(createLink('cm', 'browse', "projectID={$projectID}"))),
        hasPriv('cm', 'exportReport') ? btn
        (
            set::text($lang->export),
            set::icon('export'),
            set::className('ghost'),
            setData(array('toggle' => 'modal', 'size' => 'sm')),
            set::url(createLink('cm', 'exportReport', "projectID={$projectID}"))
        ) : null
    );
}

$auditTrList = array();
foreach($report['audit'] as $type => $audit)
{
    $objects = '';
    foreach(explode(',', $audit->category) as $category) $objects .= zget($categories, $category) . ',';
    $auditTrList[] = h::tr
    (
        h::td(set::colspan('3'), $audit->title),
        h::td(set::colspan('3'), $audit->version),
        h::td(set::colspan('3'), trim($objects, ',')),
        h::td(set::colspan('3'), !helper::isZeroDate($audit->createdDate) ? $audit->createdDate : ''),
        h::td(set::colspan('1'), zget($users, $audit->createdBy))
    );
}

$issueTrList = array();
foreach($report['issue'] as $issue)
{
    $issueTrList[] = h::tr
    (
        h::td($issue->id),
        h::td(set::colspan('2'), $issue->title),
        h::td(set::colspan('2'), $issue->reviewTitle),
        h::td(!helper::isZeroDate($issue->createdDate) ? $issue->createdDate : ''),
        h::td(zget($users, $issue->createdBy)),
        h::td($issue->opinion),
        h::td(!helper::isZeroDate($issue->opinionDate) ? $issue->opinionDate : ''),
        h::td(zget($lang->reviewissue->resolutionList, $issue->resolution)),
        h::td(!helper::isZeroDate($issue->resolutionDate) ? $issue->resolutionDate : ''),
        h::td(zget($users, $issue->resolutionBy)),
        h::td(zget($lang->reviewissue->statusList, $issue->status))
    );
}

panel
(
    h::table
    (
        setClass('table bordered table-fixed'),
        h::tbody
        (
            h::tr(h::td(setClass('text-center'), set::colspan('12'), h5($lang->cm->baselineReport))),
            h::tr
            (
                h::th($lang->cm->projectID, set::colspan('2')),
                h::td(set::colspan('2'), $report['project']->id),
                h::th(set::colspan('2'),$lang->cm->release),
                h::td(set::colspan('2'), zget($lang->project->modelList, $report['project']->model)),
                h::th($lang->cm->approver, set::colspan('2')),
                h::td(set::colspan('2'))
            ),
            h::tr
            (
                h::th($lang->cm->projectName, set::colspan('2')),
                h::td(set::colspan('6'), $report['project']->name),
                h::th($lang->cm->compiling, set::colspan('2')),
                h::td(set::colspan('2'), zget($users, $report['project']->PM))
            ),
            h::tr
            (
                setClass('text-center'),
                h::td(setClass('text-center'), set::colspan('12'), h5($lang->cm->changeDesc))
            ),
            h::tr
            (
                h::td(setClass('font-bold'), set::colspan('3'), $lang->cm->baselineItem),
                h::td(setClass('font-bold'), set::colspan('2'), $lang->cm->currentVersion),
                h::td(setClass('font-bold'), set::colspan('3'), $lang->cm->configItemName),
                h::td(setClass('font-bold'), set::colspan('2'), $lang->cm->releaseDate),
                h::td(setClass('font-bold'), set::colspan('2'), $lang->cm->publisher)
            ),
            $auditTrList,
            h::tr
            (
                h::td(setClass('font-bold'), set::colspan('6'), $lang->cm->configAdmin),
                h::td(setClass('font-bold'), set::colspan('4'), $lang->cm->solutionMan),
                h::td(setClass('font-bold'), $lang->cm->confManagement, set::colspan('2'))
            ),
            h::tr
            (
                h::td(setClass('font-bold'), $lang->cm->issueID),
                h::td(setClass('font-bold'), $lang->cm->issueDesc),
                h::td(setClass('font-bold'), $lang->cm->baselineAudit, $app->getClientLang() == 'en' ? set::style(array('padding-left' => '0.5rem', 'padding-right' => '0.5rem')) : null),
                h::td(setClass('font-bold'), $lang->cm->discoveryDate),
                h::td(setClass('font-bold'), $lang->cm->personLiable),
                h::td(setClass('font-bold'), $lang->cm->proposedScheme),
                h::td(setClass('font-bold'), $lang->cm->proposedDate),
                h::td(setClass('font-bold'), $lang->cm->solutionResult),
                h::td(setClass('font-bold'), $lang->cm->resolvingDate),
                h::td(setClass('font-bold'), $lang->cm->resolvingBy),
                h::td(set::colspan('2'), setClass('font-bold'), $lang->cm->currentState)
            ),
            $issueTrList
        )
    )
);

$this->session->notHead ? render('fragment') : render();
