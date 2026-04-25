<?php
/**
 * @param mixed[] $executionList
 * @param mixed[] $items
 */
public function getMetricsCount($executionList, $items = array())
{
    return $this->loadExtension('report')->getMetricsCount($executionList, $items);
}

/**
 * @param mixed[] $executionList
 * @param mixed[] $items
 */
public function getMetricsChart($executionList, $items = array())
{
    return $this->loadExtension('report')->getMetricsChart($executionList, $items);
}

/**
 * @param mixed[] $executionList
 * @param object $project
 * @param mixed[] $items
 */
public function getMetricsTable($executionList, $project, $items = array())
{
    return $this->loadExtension('report')->getMetricsTable($executionList, $project, $items);
}
