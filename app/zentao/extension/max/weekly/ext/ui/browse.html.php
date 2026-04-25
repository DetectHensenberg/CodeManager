<?php
/**
 * The browse view file of weekly module of ZenTaoPMS.
 * @copyright   Copyright 2009-2025 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Shujie Tian <tianshujie@chandao.com>
 * @package     weekly
 * @link        https://www.zentao.net
 */
namespace zin;
jsVar('disabledHint', $lang->weekly->disabledHint);
jsVar('draftText', $lang->weekly->draft);
jsVar('errorDeleteCategoryText', $lang->weekly->error->deleteCategory);
jsVar('confirmDeleteCategoryText', $lang->weekly->confirmDeleteCategory);

$linkParams = "projectID={$projectID}&browseType={key}&param={$param}&orderBy={$orderBy}&recTotal={$pager->recTotal}&recPerpage={$pager->recPerPage}";
featureBar
(
    set::current($this->session->weeklyBrowseType),
    set::linkParams($linkParams),
    li(searchToggle())
);

$canCreate = hasPriv('weekly', 'create') && common::canModify('project', $project);
toolbar
(
    $canCreate && helper::hasFeature('BI') ? item(set(array
    (
        'icon'        => 'plus',
        'text'        => $lang->weekly->createByTemplate,
        'class'       => "primary",
        'url'         => createLink('weekly', 'ajaxSelectTemplate', "projectID={$projectID}&moduleID={$moduleID}"),
        'data-toggle' => 'modal',
        'data-size'   => 'lg'
    ))) : null,
    $canCreate ? item(set(array
    (
        'icon'        => 'plus',
        'text'        => $lang->weekly->create,
        'class'       => "primary",
        'url'         => createLink('weekly', 'create', "projectID={$projectID}&moduleID={$moduleID}"),
        'data-toggle' => 'modal'
    ))) : null
);

sidebar
(
    moduleMenu
    (
        set::modules($moduleTree),
        set::activeKey($moduleID),
        set::closeLink(createLink('weekly', 'browse', "projectID={$projectID}&browseType=bymodule&param=")),
        set::createModuleLink(hasPriv('weekly', 'manageCategroy') ? createLink('weekly', 'addCategory', "rootID={$projectID}") : null),
        set::createModuleHint($lang->weekly->addCategory),
        set::showDisplay(false),
        set::app('project')
    )
);

$cols    = $this->loadModel('datatable')->getSetting('weekly');
$reports = initTableData(empty($reports) ? array() : $reports, $cols);
dtable
(
    set::onRenderCell(jsRaw('window.renderCell')),
    set::actionItemCreator(jsRaw('window.actionItemCreator')),
    set::cols($cols),
    set::data($reports),
    set::sortLink(inlink('browse', "projectID={$projectID}&browseType={$browseType}&param=$param&orderBy={name}_{sortType}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}")),
    set::customCols(true),
    set::userMap($users),
    set::footPager(usePager())
);
