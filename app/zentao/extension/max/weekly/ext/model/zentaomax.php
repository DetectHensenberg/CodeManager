<?php
/**
 * @param object $report
 */
public function create($report)
{
    return $this->loadExtension('zentaomax')->create($report);
}

/**
 * @param string|int $moduleID
 * @param int $projectID
 * @param string $browseType
 * @param string $orderBy
 * @param int $limit
 */
public function getList($projectID = 0, $browseType = 'all', $moduleID = '', $orderBy = 'id_desc', $limit = 0)
{
    return $this->loadExtension('zentaomax')->getList($projectID, $browseType, $moduleID, $orderBy, $limit);
}

/**
 * @param string $period
 */
public function getBeginAndEnd($period = '')
{
    return $this->loadExtension('zentaomax')->getBeginAndEnd($period);
}

/**
 * @param object $report
 * @param string $action
 */
public function isClickable($report, $action)
{
    return $this->loadExtension('zentaomax')->isClickable($report, $action);
}

/**
 * @param int $queryID
 * @param string $actionURL
 */
public function buildSearchForm($queryID, $actionURL)
{
    return $this->loadExtension('zentaomax')->buildSearchForm($queryID, $actionURL);
}

/**
 * @param int $projectID
 * @param int $queryID
 * @param string $orderBy
 */
public function getBySearch($projectID = 0, $queryID = 0, $orderBy = 'id_desc')
{
    return $this->loadExtension('zentaomax')->getBySearch($projectID, $queryID, $orderBy);
}

/**
 * @param int $templateID
 * @param int $reportID
 */
public function getTemplateContent($templateID, $reportID = 0)
{
    return $this->loadExtension('zentaomax')->getTemplateContent($templateID, $reportID);
}

/**
 * @param int $reportID
 */
public function deleteReport($reportID)
{
    return $this->loadExtension('zentaomax')->deleteReport($reportID);
}

/**
 * @param int $projectID
 * @param string $end
 */
public function buildSummaryTable($projectID, $end = '')
{
    return $this->loadExtension('zentaomax')->buildSummaryTable($projectID, $end);
}

/**
 * @param int $projectID
 */
public function buildWorkloadTable($projectID)
{
    return $this->loadExtension('zentaomax')->buildWorkloadTable($projectID);
}

/**
 * @param int $projectID
 * @param string $browseType
 */
public function getModuleTree($projectID, $browseType)
{
    return $this->loadExtension('zentaomax')->getModuleTree($projectID, $browseType);
}

/**
 * @param object $moduleData
 */
public function addCategory($moduleData)
{
    return $this->loadExtension('zentaomax')->addCategory($moduleData);
}

/**
 * @param int $moduleID
 * @param object $moduleData
 */
public function updateCategory($moduleID, $moduleData)
{
    return $this->loadExtension('zentaomax')->updateCategory($moduleID, $moduleData);
}
/**
 * @param int $moduleID
 */
public function deleteCategory($moduleID)
{
    return $this->loadExtension('zentaomax')->deleteCategory($moduleID);
}

/**
 * @param int $projectID
 * @param string $mode
 */
public function getModulePairs($projectID, $mode = '')
{
    return $this->loadExtension('zentaomax')->getModulePairs($projectID, $mode);
}

/**
 * @param int $reportID
 * @param object $reportContent
 * @param int $projectID
 */
public function copyDocBlock($reportID, $reportContent, $projectID)
{
    return $this->loadExtension('zentaomax')->copyDocBlock($reportID, $reportContent, $projectID);
}
