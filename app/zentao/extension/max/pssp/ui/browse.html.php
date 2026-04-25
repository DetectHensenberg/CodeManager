<?php
/**
 * The browse view file of pssp module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang <wangyuting@easycorp.ltd>
 * @package     pssp
 * @link        https://www.zentao.net
 */
namespace zin;

unset($config->pssp->dtable->fieldList['check']);
if($browseType == 'wait') unset($config->pssp->dtable->fieldList['createdBy'], $config->pssp->dtable->fieldList['createdDate']);
$processList = initTableData($processList, $config->pssp->dtable->fieldList, $this->pssp);

$canUpdate  = hasPriv('pssp', 'update');
$updateLink = createLink('pssp', 'update', "projectID={$projectID}&browseType={$browseType}&moduleID={$moduleID}") . "#app={$app->tab}";
$updateItem = array('text' => $lang->pssp->update, 'url' => $updateLink);

featureBar
(
    set::current($browseType),
    set::linkParams("projectID={$projectID}&browseType={key}")
);
toolbar
(
    $canUpdate ? item(set($updateItem + array('class' => 'btn primary', 'icon' => 'plus'))) : null
);

sidebar
(
    moduleMenu
    (
        set::modules($moduleTree),
        set::activeKey($moduleID),
        set::allText($lang->activity->allProcesses),
        set::settingLink(''),
        set::showDisplay(false),
        set::closeLink(createLink('pssp', 'browse', "projectID={$projectID}&browseType={$browseType}")),
        set::app($app->tab)
    )
);

dtable
(
    set::id('pssp'),
    set::data(array_values($processList)),
    set::cols(array_values($config->pssp->dtable->fieldList)),
    set::userMap($users)
);
