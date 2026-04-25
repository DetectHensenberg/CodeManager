<?php
/**
 * The reviewissue view file of my module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yidong Wang <wangyidong@chandao.com>
 * @package     my
 * @link        https://www.zentao.net
 */
namespace zin;

include $app->getModuleRoot() . 'my/ui/header.html.php';

$module = $app->rawMethod == 'contribute' ? 'contributeReviewissue' : 'workReviewissue';
featureBar
(
    set::current($type),
    set::linkParams("mode={$mode}&type={key}&param=&orderBy={$orderBy}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}"),
    li(searchToggle(set::module($module), set::open($type == 'bysearch')))
);

if(isset($config->my->reviewissue->dtable->fieldList['actions']['list']['edit'])) $config->my->reviewissue->dtable->fieldList['actions']['list']['edit']['data-toggle'] = 'modal';
$reviewissues = initTableData($reviewissues, $config->my->reviewissue->dtable->fieldList, $this->reviewissue);

dtable
(
    set::cols($config->my->reviewissue->dtable->fieldList),
    set::data(array_values($reviewissues)),
    set::userMap($users),
    set::fixedLeftWidth('44%'),
    set::orderBy($orderBy),
    set::sortLink(createLink('my', $app->rawMethod, "mode={$mode}&type={$type}&param={$param}&orderBy={name}_{sortType}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}")),
    set::footPager(usePager())
);

render();
