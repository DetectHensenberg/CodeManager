<?php
/**
 * The browse view file of cm module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang <wangyuting@easycorp.ltd>
 * @package     cm
 * @link        https://www.zentao.net
 */
namespace zin;

$cols = $this->loadModel('datatable')->getSetting('cm');
if(!empty($cols['category'])) $cols['category']['map'] = $categories;

$baselines  = initTableData($baselines, $cols, $this->cm);
$canCreate  = hasPriv('cm', 'create');
$canDiff    = hasPriv('cm', 'diff');
$canReport  = hasPriv('cm', 'report');
$createLink = createLink('cm', 'create', "projectID={$projectID}");
$diffLink   = createLink('cm', 'diff',   "projectID={$projectID}");
$reportLink = createLink('cm', 'report', "projectID={$projectID}");

featureBar
(
    set::current($browseType),
    set::linkParams("projectID={$projectID}&browseType={key}&orderBy={$orderBy}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}")
);
toolbar
(
    $canReport ? item(set(array('text' => $lang->cm->report, 'url' => $reportLink, 'class' => 'btn ghost',   'icon' => 'doc'))) : null,
    $canDiff   ? item(set(array('text' => $lang->cm->diff,   'url' => $diffLink,   'class' => 'btn ghost',   'icon' => 'diff', 'data-toggle' => 'modal', 'data-size' => 'sm'))) : null,
    $canCreate ? item(set(array('text' => $lang->cm->create, 'url' => $createLink, 'class' => 'btn primary', 'icon' => 'plus'))) : null
);

dtable
(
    set::id('baselines'),
    set::cols($cols),
    set::data(array_values($baselines)),
    set::userMap($users),
    set::customCols(true),
    set::orderBy($orderBy),
    set::sortLink(inlink('browse', "projectID={$projectID}&browseType={$browseType}&orderBy={name}_{sortType}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}")),
    set::footPager(usePager())
);
