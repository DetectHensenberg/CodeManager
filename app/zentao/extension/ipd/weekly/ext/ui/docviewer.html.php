<?php
/**
 * The docviewer view file of weekly module of ZenTaoPMS.
 * @copyright   Copyright 2009-2025 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Shujie Tian <tianshujie@chandao.com>
 * @package     weekly
 * @link        https://www.zentao.net
 */
namespace zin;
jsVar('projectID', $projectID);

$privs = array();
$privs['view']         = hasPriv('weekly', 'view');
$privs['edit']         = common::canModify('project', $project) && hasPriv('weekly', 'edit');
$privs['delete']       = common::canModify('project', $project) && hasPriv('weekly', 'delete');
$privs['exportReport'] = hasPriv('weekly', 'exportReport');
$privs['collect']      = 'no';
$privs['restoreDoc']   = false;

$app->loadLang('doc');
$langData = array();
foreach($lang->doc->docLang as $key => $value) $langData[$key] = $value;
$langData['history']         = $lang->history;
$langData['cancel']          = $lang->cancel;
$langData['settings']        = $lang->settings;
$langData['refreshData']     = $lang->weekly->refreshData;
$langData['saveDraft']       = $lang->doc->saveDraft;
$langData['release']         = $lang->doc->release;
$langData['enterFullscreen'] = $lang->doc->docLang->enterFullscreen;
$langData['exitFullscreen']  = $lang->doc->docLang->exitFullscreen;
$langData['docOutline']      = $lang->weekly->outline;
$langData['accessDenied']    = $lang->doc->accessDenied;
$langData['delete']          = $lang->weekly->delete;
$langData['confirmDelete']   = $lang->weekly->confirmDelete;
$langData['confirmRefresh']  = $lang->weekly->confirmRefresh;
$langData['needEditable']    = $lang->weekly->disabledHint->edit;
$langData['reportList']      = $lang->weekly->reportList;
$langData['edit']            = $lang->weekly->edit;
$langData['deleted']         = $lang->deleted;

/* 定义编辑报告时右侧的快捷菜单标签。*/
$quickEditMenuTabs = array();
if($mode == 'edit')
{
    $langData['insertSystemData'] = $lang->reporttemplate->insertSystemData;

    /* Build tabs. */
    foreach($lang->reporttemplate->quickEditMenuList as $menuKey => $menuName) $quickEditMenuTabs[$menuKey] = array('key' => $menuKey, 'text' => $menuName, 'items' => array());

    /* Build property tree. */
    foreach($fields as $fieldKey => $fieldName)
    {
        $quickEditMenuTabs['properties']['items'][] = array('id' => "property_{$fieldKey}", 'text' => $fieldName, 'holder' => array('name' => "property_{$fieldKey}", 'text' => (string)$properties["property_{$fieldKey}"]));
    }

    /* Build data list tree. */
    foreach($lang->reporttemplate->filterList as $filterKey => $filterName)
    {
        if(in_array($filterKey, array('HLDS', 'DDS', 'DBDS', 'ADS')) && in_array($project->model, array('scrum', 'agileplus', 'kanban'))) continue;
        $quickEditMenuTabs['lists']['items'][] = array('id' => "list_{$filterKey}", 'text' => $filterName, 'url' => '###', 'data-toggle' => 'modal', 'data-size' => 'sm', 'data-url' => $this->createLink('reporttemplate', 'ajaxBuildZentaoListConfig', "type={$filterKey}&oldBlockID=0&projectID={$projectID}"));
    }

    /* Build measurement tree. */
    foreach($lang->reporttemplate->measurementList as $groupKey => $measurements)
    {
        $items = array();
        foreach($measurements as $measurementKey => $measurementName)
        {
            if($groupKey == 'execution')
            {
                $items[] = array('id' => "measurement_{$groupKey}_{$measurementKey}", 'text' => $measurementName, 'url' => '###', 'onClick' => jsRaw('window.insertExecutionMeasurement'), 'data-type' => "{$groupKey}_{$measurementKey}", 'data-project' => $projectID, 'hint' => $this->lang->reporttemplate->notice->filter . $this->lang->colon . $lang->reporttemplate->executionDataTips);
            }
            else
            {
                $items[] = array('id' => "measurement_{$groupKey}_{$measurementKey}", 'text' => $measurementName, 'url' => '###', 'data-toggle' => 'modal', 'data-url' => $this->createLink('reporttemplate', 'ajaxBuildZentaoMeasurementConfig', "type={$groupKey}_{$measurementKey}&blockID=0&projectID={$projectID}"));
            }
        }

        $quickEditMenuTabs['measurements']['items'][] = array
            (
                'id'    => $groupKey,
                'text'  => $lang->reporttemplate->{$groupKey},
                'items' => $items
            );
    }

    /* Build chart tree. */
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
                    $classItems[] = array('id' => "chart_{$groupKey}_{$chartKey}", 'text' => $chartName, 'url' => '###', 'onClick' => jsRaw('window.insertExecutionChart'), 'data-type' => "{$groupKey}_{$classKey}_{$chartKey}", 'data-project' => $projectID);
                }
                else
                {
                    $classItems[] = array('id' => "chart_{$groupKey}_{$chartKey}", 'text' => $chartName, 'url' => '###', 'data-toggle' => 'modal', 'data-url' => $this->createLink('reporttemplate', 'ajaxBuildZentaoChartConfig', "type={$groupKey}_{$classKey}_{$chartKey}&blockID=0&projectID={$projectID}"));
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
}

docViewer
(
    set::doc((array)$report),
    set::docID((int)$report->id),
    set::mode($mode),
    set::privs($privs),
    set::userMap($userList),
    set::langData($langData),
    set::historyFetcher(createLink('action', 'ajaxGetList', 'objectType=weekly&objectID={objectID}')),
    set::historyPanel(array('objectType' => 'weekly')),
    set::editorProps(array('onClickHolder' => jsRaw('window.clickHolder'))),
    set::docFetcher(createLink('weekly', 'ajaxGetReport', 'reportID={docID}&version={version}')),
    set::quickEditMenu(array_values($quickEditMenuTabs)),
    set::openViewSidebar('quick-edit-menu')
);
