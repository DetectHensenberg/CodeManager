<?php
/**
 * @param mixed[] $storyList
 * @param object $data
 * @param string $type
 */
public function getBasicMetrics($storyList, $data, $type = 'execution')
{
    return $this->loadExtension('report')->getBasicMetrics($storyList, $data, $type);
}
/**
 * @param mixed[] $storyList
 * @param object $data
 * @param string $type
 */
public function buildBasicChartConfig($storyList, $data, $type = 'execution')
{
    return $this->loadExtension('report')->buildBasicChartConfig($storyList, $data, $type);
}
/**
 * @param mixed[] $storyList
 */
public function getProgressMetrics($storyList)
{
    return $this->loadExtension('report')->getProgressMetrics($storyList);
}
/**
 * @param mixed[] $storyList
 */
public function buildProgressChartConfig($storyList)
{
    return $this->loadExtension('report')->buildProgressChartConfig($storyList);
}
/**
 * @param int $storyID
 * @param string $begin
 * @param string $end
 */
public function getChangedStory($storyID, $begin, $end)
{
    return $this->loadExtension('report')->getChangedStory($storyID, $begin, $end);
}

/**
 * @param mixed[] $storyList
 * @param object|null $data
 * @param mixed[] $items
 */
public function getMetricsCount($storyList, $data = null, $items = array())
{
    return $this->loadExtension('report')->getMetricsCount($storyList, $data, $items);
}

/**
 * @param mixed[] $storyList
 * @param mixed[] $items
 */
public function getMetricsChart($storyList, $items = array())
{
    return $this->loadExtension('report')->getMetricsChart($storyList, $items);
}
