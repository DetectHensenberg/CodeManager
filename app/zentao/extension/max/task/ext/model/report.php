<?php
/**
 * @param mixed[] $taskList
 */
public function getBasicMetrics($taskList)
{
    return $this->loadExtension('report')->getBasicMetrics($taskList);
}

/**
 * @param mixed[] $taskList
 */
public function buildBasicChartConfig($taskList)
{
    return $this->loadExtension('report')->buildBasicChartConfig($taskList);
}

/**
 * @param mixed[] $taskList
 * @param object $data
 * @param string $type
 */
public function getProgressMetrics($taskList, $data, $type = 'execution')
{
    return $this->loadExtension('report')->getProgressMetrics($taskList, $data, $type);
}

/**
 * @param mixed[] $taskList
 * @param object $data
 * @param string $type
 */
public function buildProgressChartConfig($taskList, $data, $type = 'execution')
{
    return $this->loadExtension('report')->buildProgressChartConfig($taskList, $data, $type);
}

/**
 * @param mixed[] $taskList
 * @param object $data
 */
public function getResourceMetrics($taskList, $data, $type = 'execution')
{
    return $this->loadExtension('report')->getResourceMetrics($taskList, $data, $type);
}

/**
 * @param mixed[] $taskList
 * @param object $data
 */
public function buildResourceChartConfig($taskList, $data, $type = 'execution')
{
    return $this->loadExtension('report')->buildResourceChartConfig($taskList, $data, $type);
}

/**
 * @param mixed[] $taskList
 * @param mixed[] $items
 */
public function getMetricsCount($taskList, $items)
{
    return $this->loadExtension('report')->getMetricsCount($taskList, $items);
}

/**
 * @param mixed[] $taskList
 * @param mixed[] $items
 * @param int $objectID
 * @param string $type
 */
public function getMetricsChart($taskList, $items, $objectID = 0, $type = 'execution')
{
    return $this->loadExtension('report')->getMetricsChart($taskList, $items, $objectID, $type);
}

/**
 * @param mixed[] $taskList
 * @param mixed[] $items
 * @param object|null $data
 * @param string $type
 */
public function getMetricsTable($taskList, $items, $data = null, $type = 'execution')
{
    return $this->loadExtension('report')->getMetricsTable($taskList, $items, $data, $type);
}

/**
 * @param mixed[] $taskList
 * @param object $data
 * @param string $type
 */
public function processDateLimitForTasks($taskList, $data, $type)
{
    return $this->loadExtension('report')->processDateLimitForTasks($taskList, $data, $type);
}

/**
 * @param mixed[] $taskList
 * @param mixed[] $items
 * @param int $objectID
 * @param string $type
 */
public function getEffortMetrics($taskList, $items, $objectID = 0, $type = 'execution')
{
    return $this->loadExtension('report')->getEffortMetrics($taskList, $items, $objectID, $type);
}
