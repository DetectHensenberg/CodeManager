<?php
/**
 * The product view file of workflowgroup module of ZenTaoPMS.
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun <sunguangming@chandao.com>
 * @package     workflowgroup
 * @link        https://www.zentao.net
 */
namespace zin;

jsVar('buildinLang', $lang->workflow->buildin);

featurebar
(
    set::current($browseType),
    set::linkParams("browseType={key}&orderBy={$orderBy}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}")
);

hasPriv('workflowgroup', 'create') ? toolbar
(
    item(set(array('icon' => 'plus', 'class' => 'primary', 'data-toggle' => 'modal', 'text' => $lang->workflowgroup->createProduct, 'url' => inlink('create', 'type=product'))))
) : null;

$cols = $config->workflowgroup->dtable->product->fieldList;
if(isset($cols['actions']['list']['design'])) $cols['actions']['list']['design']['url'] = array('module' => 'workflowgroup', 'method' => 'design', 'params' => 'id={id}');
$cols['actions']['list']['delete']['data-confirm'] = sprintf($lang->workflowgroup->notice->confirmDelete, $lang->productCommon);

$data = initTableData($groups, $cols, $this->workflowgroup);
foreach($data as $workflowgroup)
{
    if($workflowgroup->main == '0') continue;
    foreach($workflowgroup->actions as $i => $action)
    {
        if(!in_array($action['name'], array('edit', 'delete'))) continue;
        $workflowgroup->actions[$i]['disabled'] = true;
    }
}

dtable
(
    set::cols($cols),
    set::data($data),
    set::orderBy($orderBy),
    set::onRenderCell(jsRaw('window.renderCell')),
    set::sortLink(createLink('workflowgroup', 'product', "orderBy={name}_{sortType}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}")),
    set::footPager(usePager())
);
