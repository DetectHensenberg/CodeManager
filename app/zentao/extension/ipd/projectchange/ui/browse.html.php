<?php
/**
 * The browse view file of projectchange module of ZenTaoPMS.
 * @copyright   Copyright 2009-2025 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Tingting Dai <daitingting@easycorp.ltd>
 * @package     projectchange 
 * @link        https://www.zentao.net
 */
namespace zin;

jsVar('deleteHint', $lang->projectchange->deleteHint);
jsVar('statusList', $lang->projectchange->statusList);

featureBar
(
    set::current($browseType),
    set::linkParams("projectID={$projectID}&browseType={key}&orderBy={$orderBy}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}")
);

toolbar
(
    hasPriv('projectchange', 'create') ? item(set(array('text' => $lang->projectchange->create, 'url' => createLink('projectchange', 'create', "projectID={$projectID}"), 'class' => 'btn primary', 'icon' => 'plus'))) : null
);

foreach($projectchanges as $projectchange)
{
    if($projectchange->deliverable)
    {
        $projectchangeDeliverables = explode(',', $projectchange->deliverable);
        $projectchangeDeliverable  = '';
        foreach(array_filter($projectchangeDeliverables) as $projectchangeDeliverableID)
        {
            $projectchangeDeliverable .= ',' . zget($deliverables, $projectchangeDeliverableID);
        }

        $projectchange->deliverable = trim($projectchangeDeliverable, ',');
    }
}

$cols = $this->loadModel('datatable')->getSetting('projectchange', '', true);

$projectchanges = initTableData($projectchanges, $cols, $this->projectchange);

dtable
(
    set::cols($cols),
    set::data(array_values($projectchanges)),
    set::userMap($users),
    set::orderBy($orderBy),
    set::footPager(usePager()),
    set::onRenderCell(jsRaw('window.onRenderCell')),
    set::sortLink(inlink('browse', "projectID={$projectID}&browseType={$browseType}&orderBy={name}_{sortType}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}"))
);
