<?php
/**
 * The browse file of nc module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2025 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun<sunguangming@easycorp.ltd>
 * @package     nc
 * @link        https://www.zentao.net
 */
namespace zin;

$queryMenuLink = createLink('nc', 'browse', "objectID={$objectID}&from={$from}&browseType=bysearch&queryID={queryID}");
featureBar
(
    set::current($browseType),
    set::linkParams("objectID={$objectID}&from={$from}&browseType={key}&param={$param}&orderBy={$orderBy}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}"),
    set::queryMenuLinkCallback(array(function ($key) use ($queryMenuLink) {
        return str_replace('{queryID}', (string)$key, $queryMenuLink);
    })),
    li(searchToggle
    (
        set::open($browseType == 'bysearch')
    ))
);

common::canModify('project', $project) ? toolbar(hasPriv('nc', 'export') ? btn(setClass('btn ghost'), set::icon('export'), setData(array('toggle' => 'modal')), set::url(createLink('nc', 'export', "objectID={$objectID}&from={$from}&browseType={$browseType}&orderBy={$orderBy}")), $lang->nc->export) : null, hasPriv('nc', 'create') ? btn(setClass('btn primary create-nc-btn'), set::icon('plus'), set::url(createLink('nc', 'create', "objectID={$objectID}&auditplanID=0&from={$from}") . "#app=$from"), $lang->nc->create) : null) : null;

$cols = $this->loadModel('datatable')->getSetting('nc');
$ncs  = initTableData($ncs, $cols, $this->nc);

dtable(set::id('ncs'), set::customCols(true), set::userMap($users), set::order($orderBy), set::sortLink(createLink('nc', 'browse', "objectID={$objectID}&from={$from}&browseType={$browseType}&param={$param}&orderBy={name}_{sortType}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}")), set::cols($cols), set::data($ncs), set::footPager(usePager()));
