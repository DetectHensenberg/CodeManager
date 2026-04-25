<?php
/**
 * The select template view file of doc module of ZenTaoPMS.
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yue Liu<liuyue@chandao.com>
 * @package     gapanalysis
 * @link        https://www.zentao.net
 */
namespace zin;

featureBar
(
    set::current($browseType),
    set::linkParams("projectID={$projectID}&status={key}&param={$param}&orderBy={$orderBy}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}"),
    li(searchToggle
    (
        set::module('gapanalysis'),
        set::open($browseType == 'bysearch')
    ))
);

$canCreate       = common::canModify('project', $project) && hasPriv('gapanalysis', 'create');
$canBatchCreate  = common::canModify('project', $project) && hasPriv('gapanalysis', 'batchCreate');
$createLink      = $this->createLink('gapanalysis', 'create', "projectID=$projectID");
$batchCreateLink = $this->createLink('gapanalysis', 'batchCreate', "project=$projectID");
$createItem      = array('text' => $lang->gapanalysis->create,      'url' => $createLink);
$batchCreateItem = array('text' => $lang->gapanalysis->batchCreate, 'url' => $batchCreateLink);

toolbar
(
    $canCreate && $canBatchCreate ? btngroup
    (
        btn(setClass('btn primary createTask-btn'), set::icon('plus'), set::url($createLink), $lang->gapanalysis->create),
        dropdown
        (
            btn(setClass('btn primary dropdown-toggle'),
            setStyle(array('padding' => '6px', 'border-radius' => '0 2px 2px 0'))),
            set::items(array_filter(array($createItem, $batchCreateItem))),
            set::placement('bottom-end')
        )
    ) : null,
    $canCreate && !$canBatchCreate ? item(set($createItem + array('class' => 'btn primary createTask-btn', 'icon' => 'plus'))) : null,
    $canBatchCreate && !$canCreate ? item(set($batchCreateItem + array('class' => 'btn primary', 'icon' => 'plus'))) : null
);

$cols      = $this->loadModel('datatable')->getSetting('gapanalysis');
$tableData = initTableData($gapanalysises, $cols, $this->gapanalysis);

$footToolbar           = array();
$createGapanalysisLink = $canCreate ? $createLink : '';
$canBatchEdit          = common::hasPriv('gapanalysis', 'batchEdit');

if($canBatchEdit)
{
    $footToolbar['items'][] = array('text' => $lang->edit, 'className' => 'primary batch-btn', 'data-url' => createLink('gapanalysis', 'batchEdit', "projectID={$projectID}"));
}

dtable
(
    set::id('gapanalysisList'),
    set::groupDivider(true),
    set::userMap($users),
    set::cols($cols),
    set::data($tableData),
    set::checkable($canBatchEdit),
    set::orderBy($orderBy),
    set::footToolbar($footToolbar),
    set::footPager(usePager(array
    (
        'recPerPage'  => $pager->recPerPage,
        'recTotal'    => $pager->recTotal,
        'linkCreator' => helper::createLink('gapanalysis', 'browse', "projectID=$projectID&browseType=$browseType&param={$param}&orderBy=$orderBy&recTotal={$pager->recTotal}&recPerPage={recPerPage}&page={page}") . "#app={$app->tab}"
    ))),
    set::sortLink(createLink('gapanalysis', 'browse', "projectID=$projectID&browseType=$browseType&param={$param}&orderBy={name}_{sortType}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}")),
    set::createTip($lang->gapanalysis->create),
    set::createLink($createGapanalysisLink),
    set::emptyTip($lang->noData)
);
