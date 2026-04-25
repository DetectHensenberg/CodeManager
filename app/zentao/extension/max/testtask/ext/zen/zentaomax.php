<?php
/**
 * @param object $product
 * @param object $testtask
 * @param mixed[] $runs
 * @param mixed[] $scenes
 * @param int $moduleID
 * @param string $browseType
 * @param int $param
 * @param string $orderBy
 * @param object $pager
 */
public function assignForCases($product, $testtask, $runs, $scenes, $moduleID, $browseType, $param, $orderBy, $pager)
{
    $this->loadExtension('zentaomax')->assignForCases($product, $testtask, $runs, $scenes, $moduleID, $browseType, $param, $orderBy, $pager);
}

/**
 * @param int $productID
 * @param object $task
 */
public function setDropMenu($productID, $task)
{
    $this->loadExtension('zentaomax')->setDropMenu($productID, $task);
}

/**
 * @param int|string $branch
 * @param int $productID
 * @param int $projectID
 * @param int $executionID
 * @param object|null $testtask
 */
public function setMenu($productID, $branch, $projectID, $executionID,  $testtask = null)
{
    $this->loadExtension('zentaomax')->setMenu($productID, $branch, $projectID, $executionID, $testtask);
}
