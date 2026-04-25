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

$lang->pssp->featureBar['update'][$browseType] = "{$lang->pssp->update}({$lang->pssp->featureBar['browse'][$browseType]})";
unset($config->pssp->dtable->fieldList['createdBy'], $config->pssp->dtable->fieldList['createdDate']);
$processList = initTableData($processList, $config->pssp->dtable->fieldList, $this->pssp);

$canBrowse  = hasPriv('pssp', 'browse');
$browseLink = createLink('pssp', 'browse', "projectID={$projectID}&browseType={$browseType}&moduleID={$moduleID}") . "#app={$app->tab}";
$browseItem = array('text' => $lang->goback, 'url' => $browseLink);

featureBar
(
    set::current($browseType),
    set::linkParams("projectID={$projectID}&browseType={key}")
);
toolbar
(
    $canBrowse ? item(set($browseItem + array('class' => 'btn primary', 'icon' => 'back'))) : null
);

dtable
(
    set::id('pssp'),
    set::plugins(array('process-trimming')),
    set::data(array_values($processList)),
    set::cols(array_values($config->pssp->dtable->fieldList)),
    set::userMap($users),
    set::footer(array('trimmingActions')),
    set::trimingActionsTip(array('html' => $lang->pssp->footTips)),
    set::saveURL(createLink('pssp', 'update', "projectID={$projectID}&browseType={$browseType}&moduleID={$moduleID}") . "#app={$app->tab}"),
    set::backURL(createLink('pssp', 'browse', "projectID={$projectID}&browseType={$browseType}&moduleID={$moduleID}") . "#app={$app->tab}")
);
