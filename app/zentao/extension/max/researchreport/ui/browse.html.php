<?php
/**
 * The browse view file of researchreport module of ZenTaoPMS.
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Shujie Tian <tianshujie@chandao.com>
 * @package     researchreport
 * @link        https://www.zentao.net
 */
namespace zin;

$linkParams = "projectID={$projectID}&browseType={key}&param={$param}&orderBy={$orderBy}&recTotal={$pager->recTotal}&recPerpage={$pager->recPerPage}";
featureBar
(
    set::current($browseType),
    set::linkParams($linkParams),
    li(searchToggle(set::module('researchreport')))
);

toolbar(common::canModify('project', $project) && hasPriv('researchreport', 'create') ? btn(setClass('btn primary create-researchreport-btn'), set::icon('plus'), set::url(createLink('researchreport', 'create', "projectID=$projectID")), $lang->researchreport->create) : null);

$reports = initTableData($reportList, $config->researchreport->dtable->fieldList);

dtable
(
    set::cols($config->researchreport->dtable->fieldList),
    set::data($reports),
    set::userMap($users),
    set::sortLink(createLink('researchreport', 'browse', "projectID={$projectID}&browseType={$browseType}&param={$param}&orderBy={name}_{sortType}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}")),
    set::footPager(usePager())
);
