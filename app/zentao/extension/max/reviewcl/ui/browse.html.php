<?php
/**
 * The brwose file of reviewcl module of ZenTaoPMS.
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang <wangyuting@easycorp.ltd>
 * @package     reviewcl
 * @link        https://www.zentao.net
 */
namespace zin;

$cols = $this->loadModel('datatable')->getSetting('reviewcl');
if(!empty($cols['object']))   $cols['object']['map']   = $reviewPairs;
if(!empty($cols['category'])) $cols['category']['map'] = $categories;
$reviewcls = initTableData($reviewcls, $cols, $this->reviewcl);

$canCreate       = hasPriv('reviewcl', 'create');
$canBatchCreate  = hasPriv('reviewcl', 'batchCreate');
$createLink      = createLink('reviewcl', 'create',      "groupID=$groupID&object=" . ($browseType == 'byreview' ? $param : 0));
$batchCreateLink = createLink('reviewcl', 'batchCreate', "groupID=$groupID&object=" . ($browseType == 'byreview' ? $param : 0));

$createItem      = array('text' => $lang->reviewcl->create,      'url' => $createLink, 'data-toggle' => 'modal', 'data-size' => 'sm');
$batchCreateItem = array('text' => $lang->reviewcl->batchCreate, 'url' => $batchCreateLink);

featureBar
(
    set::current('all'),
    set::linkParams("groupID={$groupID}&browseType={key}&param={$param}&orderBy={$orderBy}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}")
);

toolbar
(
    $canCreate && $canBatchCreate ? btngroup
    (
        btn(setClass('btn primary create-reviewcl-btn'), set::icon('plus'), set::url($createLink), $lang->reviewcl->create, setData(array('toggle' => 'modal', 'size' => 'sm'))),
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

sidebar
(
    moduleMenu
    (
        set::modules($moduleTree),
        set::activeKey($moduleID),
        set::allText($lang->reviewcl->allReview),
        set::settingLink(''),
        set::showDisplay(false),
        set::closeLink(createLink('reviewcl', 'browse', "groupID={$groupID}")),
        set::app($app->tab)
    )
);

dtable
(
    set::cols($cols),
    set::data($reviewcls),
    set::userMap($users),
    set::customCols(true),
    set::orderBy($orderBy),
    set::sortLink(inlink('browse', "groupID={$groupID}&browseType={$browseType}&param={$param}&orderBy={name}_{sortType}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}")),
    set::footPager(usePager())
);
