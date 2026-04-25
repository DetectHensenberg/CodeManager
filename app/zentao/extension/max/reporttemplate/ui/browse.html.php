<?php
/**
 * The browse view file of reporttemplate module of ZenTaoPMS.
 * @copyright   Copyright 2009-2025 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Shujie Tian <tianshujie@chandao.com>
 * @package     reporttemplate
 * @link        https://www.zentao.net
 */
namespace zin;

$privs = array();
$privs['create']         = hasPriv('reporttemplate', 'create');
$privs['edit']           = hasPriv('reporttemplate', 'edit');
$privs['view']           = hasPriv('reporttemplate', 'view');
$privs['delete']         = hasPriv('reporttemplate', 'delete');
$privs['pause']          = hasPriv('reporttemplate', 'pause');
$privs['cron']           = hasPriv('reporttemplate', 'cron');
$privs['addCategory']    = hasPriv('reporttemplate', 'addCategory');
$privs['editCategory']   = hasPriv('reporttemplate', 'editCategory');
$privs['deleteCategory'] = hasPriv('reporttemplate', 'deleteCategory');
$privs['collect']        = 'no';
$privs['restoreDoc']     = false;

$tableCols = array();
$tableCols['id']         = $lang->idAB;
$tableCols['title']      = $lang->reporttemplate->title;
$tableCols['cycle']      = $lang->reporttemplate->cycle;
$tableCols['module']     = $lang->reporttemplate->module;
$tableCols['objects']    = $lang->reporttemplate->objects;
$tableCols['desc']       = $lang->reporttemplate->desc;
$tableCols['actions']    = $lang->actions;

$langData = array();
$langData['filterTypes']             = $lang->reporttemplate->filterTypes;
$langData['basic']                   = $lang->reporttemplate->basic;
$langData['tableCols']               = $tableCols;
$langData['create']                  = $lang->reporttemplate->create;
$langData['edit']                    = $lang->reporttemplate->editAction;
$langData['delete']                  = $lang->reporttemplate->delete;
$langData['addCategory']             = $lang->reporttemplate->addCategory;
$langData['confirmPause']            = $lang->reporttemplate->confirmPause;
$langData['confirmDelete']           = $lang->reporttemplate->confirmDelete;
$langData['confirmDeleteCategory']   = $lang->reporttemplate->confirmDeleteCategory;
$langData['leaveEditingConfirm']     = $lang->reporttemplate->leaveEditingConfirm;
$langData['searchModulePlaceholder'] = $lang->reporttemplate->searchModulePlaceholder;
$langData['searchLibPlaceholder']    = $lang->reporttemplate->searchScopePlaceholder;
$langData['noDocs']                  = $lang->reporttemplate->noTemplate;
$langData['noModules']               = $lang->reporttemplate->noCategory;
$langData['insertSystemData']        = $lang->reporttemplate->insertSystemData;
$langData['errorDeleteCategory']     = $lang->reporttemplate->error->deleteCategory;
$langData['docOutline']              = $lang->reporttemplate->outline;
$langData['pauseText']               = $lang->reporttemplate->pause;
$langData['disabledPauseHint']       = $lang->reporttemplate->disabledHint->pause;
$langData['disabledDeleteHint']      = $lang->reporttemplate->disabledHint->delete;
$langData['cron']                    = $lang->reporttemplate->cron;
$langData['pause']                   = $lang->reporttemplate->statusList['pause'];

$langData['actions'] = array();
$langData['actions']['editCategory']   = $lang->reporttemplate->editCategory;
$langData['actions']['deleteCategory'] = $lang->reporttemplate->deleteCategory;
$langData['actions']['editTemplate']   = $lang->reporttemplate->edit;
$langData['actions']['pauseTemplate']  = $lang->reporttemplate->pause;
$langData['actions']['cron']           = $lang->reporttemplate->cron;
$langData['actions']['deleteTemplate'] = $lang->reporttemplate->deleteAbbr;

/* 定义编辑文档时右侧的快捷菜单标签： */
$quickEditMenuTabs = array();
foreach($lang->reporttemplate->quickEditMenuList as $menuKey => $menuName) $quickEditMenuTabs[$menuKey] = array('key' => $menuKey, 'text' => $menuName, 'items' => array());
foreach($fields as $fieldKey => $fieldName)
{
    if(strpos($config->reporttemplate->skipProjectFields, ",{$fieldKey},") !== false) continue;
    $quickEditMenuTabs['properties']['items'][] = array('id' => "property_{$fieldKey}", 'text' => $fieldName, 'holder' => array('name' => "property_{$fieldKey}", 'text' => $fieldName));
}
foreach($lang->reporttemplate->filterList as $filterKey => $filterName) $quickEditMenuTabs['lists']['items'][] = array('id' => "list_{$filterKey}", 'text' => $filterName, 'url' => '###', 'data-toggle' => 'modal', 'data-size' => 'sm', 'data-url' => $this->createLink('reporttemplate', 'ajaxBuildZentaoListConfig', "type={$filterKey}"));
foreach($lang->reporttemplate->measurementList as $groupKey => $measurements)
{
    $items = array();
    foreach($measurements as $measurementKey => $measurementName)
    {
        if($groupKey == 'execution')
        {
            $items[] = array('id' => "measurement_{$groupKey}_{$measurementKey}", 'text' => $measurementName, 'url' => '###', 'onClick' => jsRaw('window.insertExecutionMeasurement'), 'data-type' => "{$groupKey}_{$measurementKey}", 'hint' => $this->lang->reporttemplate->notice->filter . $this->lang->colon . $lang->reporttemplate->executionDataTips);
        }
        else
        {
            $items[] = array('id' => "measurement_{$groupKey}_{$measurementKey}", 'text' => $measurementName, 'url' => '###', 'data-toggle' => 'modal', 'data-url' => $this->createLink('reporttemplate', 'ajaxBuildZentaoMeasurementConfig', "type={$groupKey}_{$measurementKey}"));
        }
    }

    $quickEditMenuTabs['measurements']['items'][] = array
    (
        'id'    => $groupKey,
        'text'  => $lang->reporttemplate->{$groupKey},
        'items' => $items
    );
}

foreach($lang->reporttemplate->chartList as $groupKey => $chartList)
{
    $groupItems = array();
    foreach($chartList as $classKey => $charts)
    {
        $classItems = array();
        foreach($charts as $chartKey => $chartName)
        {
            $noCondition = false;
            if(in_array($groupKey, array('project', 'execution'))) $noCondition = true;
            if($groupKey == 'project' && $chartKey == 'summary')   $noCondition = false;
            if($noCondition)
            {
                $classItems[] = array('id' => "chart_{$groupKey}_{$chartKey}", 'text' => $chartName, 'url' => '###', 'onClick' => jsRaw('window.insertExecutionChart'), 'data-type' => "{$groupKey}_{$classKey}_{$chartKey}");
            }
            else
            {
                $classItems[] = array('id' => "chart_{$groupKey}_{$chartKey}", 'text' => $chartName, 'url' => '###', 'data-toggle' => 'modal', 'data-url' => $this->createLink('reporttemplate', 'ajaxBuildZentaoChartConfig', "type={$groupKey}_{$classKey}_{$chartKey}"));
            }
        }

        $groupItems[] = array
        (
            'id'    => $classKey,
            'text'  => $lang->reporttemplate->{$classKey},
            'items' => $classItems
        );
    }

    $quickEditMenuTabs['charts']['items'][] = array
    (
        'id'    => $groupKey,
        'text'  => $lang->reporttemplate->{$groupKey},
        'items' => $groupItems
    );
}

docApp
(
    set::spaceID(1),
    set::libID($libID),
    set::docID((int)$docID),
    set::moduleID((int)$moduleID),
    set::mode($mode),
    set::docFetcher(createLink('reporttemplate', 'ajaxGetDoc', 'docID={docID}&version={version}')),
    set::fetcher(createLink('reporttemplate', 'ajaxGetData', 'spaceID={spaceID}')),
    set::historyFetcher(createLink('action', 'ajaxGetList', 'objectType=reportTemplate&objectID={objectID}')),
    set::historyPanel(array('objectType' => 'reporttemplate')),
    set::noSpace('hidden'),
    set::docIcon('file-archive'),
    set::langData($langData),
    set::userMap($userList),
    set::privs($privs),
    set::pager(array('recPerPage' => $recPerPage, 'page' => $pageID)),
    set::homeName(false),
    set::quickEditMenu(array_values($quickEditMenuTabs)),
    set::openViewSidebar('quick-edit-menu'),
    set::editorProps(array('onClickHolder' => jsRaw('window.clickHolder'))),
    set::hasZentaoSlashMenu(false),
    set::docFilterProps(array('title', 'objectsName', 'templateDesc'))
);
