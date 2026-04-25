<?php
/**
 * The deliverable checklist view file of project module of ZenTaoPMS.
 * @copyright   Copyright 2009-2025 禅道软件（青岛）集团有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Qiyu Xie <xieqiyu@chandao.com>
 * @package     project
 * @link        https://www.zentao.net
 */
namespace zin;

data('activeMenuItem', 'deliverable');

featureBar
(
    set::current($browseType),
    set::linkParams("projectID={$projectID}&browseType={key}")
);

sidebar
(
    moduleMenu
    (
        set::modules($processTree),
        set::activeKey($processID),
        set::closeLink(createLink('project', 'deliverablechecklist', "projectID={$projectID}&browseType={$browseType}")),
        set::showDisplay(false),
        set::onClickItem(jsRaw('scrollToProcess'))
    )
);

$cols = $this->loadModel('datatable')->getSetting('project', 'deliverablechecklist');
$cols['process']['map']         = $processPairs;
$cols['activity']['map']        = $activityPairs;
$cols['deliverableType']['map'] = $deliverableTypePairs;
$cols['deliverableID']['map']   = $deliverablePairs;
$cols['project']['map']         = $submitFromPairs;

dtable
(
    set::id('table-project-deliverablechecklist'),
    set::cols($cols),
    set::data($checklist),
    set::userMap($users),
    set::bordered(true),
    set::plugins(array('cellspan')),
    set::getCellSpan(jsRaw('window.getCellSpan'))
);
