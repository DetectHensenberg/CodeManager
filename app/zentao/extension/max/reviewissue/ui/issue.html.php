<?php
/**
 * The issue view file of reviewissue module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yidong Wang <yidong@chandao.com>
 * @package     reviewissue
 * @link        https://www.zentao.net
 */
namespace zin;

/* zin: Define the feature bar on main menu. */
if(in_array($project->model, array('scrum', 'agileplus'))) unset($lang->reviewissue->featureBar['issue']['baseline'], $lang->reviewissue->featureBar['issue']['decision']);
if(in_array($project->model, array('waterfall', 'waterfallplus'))) unset($lang->reviewissue->featureBar['issue']['decision']);

$reviewTitle = $lang->reviewissue->searchReview;
if(!empty($reviewInfo)) $reviewTitle = $reviewInfo->title . '--' . $reviewInfo->version;
if(!$hasDeliverable) unset($lang->reviewissue->featureBar['issue']['deliverable']);
if(!$hasBaseline)    unset($lang->reviewissue->featureBar['issue']['baseline']);
featureBar
(
    to::leading
    (
        picker
        (
            set::items($reviews),
            set::search(true),
            set::width('120px'),
            set::popWidth('auto'),
            set::onChange(jsRaw("(value) => loadPage($.createLink('reviewissue', 'issue', 'project={$projectID}&reviewID=' + value + '&status={$status}'))")),
            set::display($reviewTitle),
            set::required(true),
            set::value($reviewID)
        )
    ),
    set::current($status),
    set::linkParams("project={$projectID}&reviewID={$reviewID}&status={key}"),
    li(searchToggle(set::open($browseType == 'bysearch'), set::module('reviewissue')))
);
toolbar(common::canModify('project', $project) && common::hasPriv('reviewissue', 'create') ? item(set(array
(
    'icon'  => 'plus',
    'class' => 'btn primary',
    'text'  => $lang->reviewissue->create,
    'url'   => createLink('reviewissue', 'create', "project={$projectID}")
))) : null);

$cols      = $this->loadModel('datatable')->getSetting('reviewissue');
$tableData = initTableData($issueList, $cols, $this->reviewissue);
dtable
(
    set::id('issues'),
    set::userMap($users),
    set::cols($cols),
    set::data($tableData),
    set::orderBy($orderBy),
    set::footPager(usePager(array
    (
        'recPerPage'  => $pager->recPerPage,
        'recTotal'    => $pager->recTotal,
        'linkCreator' => helper::createLink('reviewissue', 'issue', "projectID={$projectID}&reviewID={$reviewID}&status={$status}&orderBy=$orderBy&browseType={$browseType}&param={$param}&recTotal={$pager->recTotal}&recPerPage={recPerPage}&pageID={page}") . "#app={$app->tab}"
    ))),
    set::sortLink(createLink('reviewissue', 'issue', "projectID={$projectID}&reviewID={$reviewID}&status={$status}&orderBy={name}_{sortType}&browseType={$browseType}&param={$param}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}")),
    set::emptyTip($lang->noData)
);
