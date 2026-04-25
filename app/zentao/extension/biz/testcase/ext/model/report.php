<?php
/**
 * @param mixed[] $cases
 * @param object|null $data
 * @param mixed[] $stories
 */
public function getBasicMetrics($cases, $data = null, $stories = array())
{
    return $this->loadExtension('report')->getBasicMetrics($cases, $data, $stories);
}
/**
 * @param mixed[] $cases
 * @param object $data
 */
public function buildBasicConfig($cases, $data)
{
    return $this->loadExtension('report')->buildBasicConfig($cases, $data);
}

/**
 * @param mixed[] $cases
 * @param object|null $data
 */
public function getMetricsCount($cases, $data = null)
{
    return $this->loadExtension('report')->getMetricsCount($cases, $data);
}

/**
 * @param mixed[] $cases
 * @param object|null $data
 * @param mixed[] $items
 */
public function getMetricsChart($cases, $data = null, $items = array())
{
    return $this->loadExtension('report')->getMetricsChart($cases, $data, $items);
}
