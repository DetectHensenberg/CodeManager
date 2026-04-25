<?php
/**
 * The browse view file of trainplan module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang <wangyuting@easycorp.ltd>
 * @package     trainplan
 * @link        https://www.zentao.net
 */
namespace zin;

$cols = $config->trainplan->dtable->fieldList;
$trainplans = initTableData($trainplans, $cols, $this->trainplan);
$cols['trainee']['map'] = $users;

featureBar
(
    set::current($browseType),
    set::linkParams("projectID={$projectID}&browseType={key}&param=" . ($browseType == 'bysearch' ? 0 : $param)),
    li(searchToggle(set::open($browseType == 'bysearch')))
);

$canModify       = common::canModify('project', $project);
$canCreate       = hasPriv('trainplan', 'create')      && $canModify;
$canBatchCreate  = hasPriv('trainplan', 'batchCreate') && $canModify;
$createLink      = createLink('trainplan', 'create',      "projectID={$projectID}");
$batchCreateLink = createLink('trainplan', 'batchCreate', "project={$projectID}");
$createItem      = array('text' => $lang->trainplan->create,      'url' => $createLink, 'data-toggle' => 'modal', 'data-size' => 'sm');
$batchCreateItem = array('text' => $lang->trainplan->batchCreate, 'url' => $batchCreateLink);
$canBatchEdit    = hasPriv('trainplan', 'batchEdit')   && $canModify;
$canBatchFinish  = hasPriv('trainplan', 'batchFinish') && $canModify;
toolbar
(
    $canCreate && $canBatchCreate ? btngroup
    (
        btn(setClass('btn primary create-activity-btn'), set::icon('plus'), set::url($createLink), $lang->trainplan->create, setData(array('toggle' => 'modal', 'size' => 'sm'))),
        dropdown
        (
            btn(setClass('btn primary dropdown-toggle'), setStyle(array('padding' => '6px', 'border-radius' => '0 2px 2px 0'))),
            set::items(array($createItem, $batchCreateItem)),
            set::placement('bottom-end')
        )
    ) : null,
    $canCreate && !$canBatchCreate ? item(set($createItem      + array('class' => 'btn primary', 'icon' => 'plus'))) : null,
    $canBatchCreate && !$canCreate ? item(set($batchCreateItem + array('class' => 'btn primary', 'icon' => 'plus'))) : null
);

$footToolbar = array();
if($canBatchEdit)   $footToolbar['items'][] = array('text' => $lang->edit, 'className' => 'primary batch-btn',     'data-url' => createLink('trainplan', 'batchEdit',   "projectID={$projectID}"));
if($canBatchFinish) $footToolbar['items'][] = array('text' => $lang->trainplan->finish, 'className' => 'primary batch-btn ajax-btn', 'data-url' => createLink('trainplan', 'batchFinish', "projectID={$projectID}"));

dtable
(
    set::id('trainplan'),
    set::checkable($canBatchEdit || $canBatchCheck ? true : false),
    set::data($trainplans),
    set::cols($cols),
    set::userMap($users),
    set::sortLink(inlink('browse', "projectID={$projectID}&browseType={$browseType}&param={$param}&orderBy={name}_{sortType}")),
    set::footToolbar($footToolbar),
    set::footPager(usePager())
);
