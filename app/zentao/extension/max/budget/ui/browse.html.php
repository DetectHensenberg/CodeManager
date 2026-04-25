<?php
/**
 * The browse view of budget module of ZenTaoPMS.
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
    'list'    => createLink('budget', 'browse', "projectID=$projectID&orderBy=$orderBy&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}")
);

featureBar
(
    set::current('list'),
    set::itemLink($itemLink),
    set::module('budget'),
    set::method('browse')
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

$cols = $this->config->budget->dtable->fieldList;
$cols['stage']['map']   = $stages;
$cols['subject']['map'] = $modules;
if(!$canModify) unset($cols['actions']);

$budgets = initTableData($budgets, $cols, $this->budget);

dtable
(
    set::cols($cols),
    set::data($budgets),
    set::userMap($users),
    set::sortLink(createLink('budget', 'browse', "projectID=$projectID&orderBy={name}_{sortType}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}")),
    set::footPager(usePager()),
    $canModify && hasPriv('budget', 'create') ? set::emptyLink(createLink('budget', 'create', "projectID=$projectID")) : null
);
