<?php
/**
 * @param int $objectID
 * @param string $begin
 * @param string $end
 * @param int $productID
 * @param object|null $task
 * @param string $method
 */
public function assignTesttaskReportData($objectID, $begin = '', $end = '', $productID = 0, $task = null, $method = 'create')
{
    return $this->loadExtension('zentaomax')->assignTesttaskReportData($objectID, $begin, $end, $productID, $task, $method);
}

/**
 * @param int $objectID
 * @param string $objectType
 * @param string $extra
 * @param string $begin
 * @param string $end
 * @param int $executionID
 */
public function assignProjectReportDataForCreate($objectID, $objectType, $extra, $begin = '', $end = '', $executionID = 0)
{
    return $this->loadExtension('zentaomax')->assignProjectReportDataForCreate($objectID, $objectType, $extra, $begin, $end, $executionID);
}

/**
 * @param object $report
 */
public function buildReportDataForView($report)
{
    return $this->loadExtension('zentaomax')->buildReportDataForView($report);
}
