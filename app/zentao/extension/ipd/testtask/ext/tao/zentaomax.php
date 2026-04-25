<?php
/**
 * @param int $productID
 * @param string $branch
 * @param int $projectID
 * @param string $unit
 * @param string $scope
 * @param string $status
 * @param string $begin
 * @param string $end
 * @param string $orderBy
 * @param object|null $pager
 */
public function fetchTesttaskList($productID, $branch = '', $projectID = 0, $unit = 'no', $scope = '', $status = '', $begin = '', $end = '', $orderBy = '', $pager = null)
{
    return $this->loadExtension('zentaomax')->fetchTesttaskList($productID, $branch, $projectID, $unit, $scope, $status, $begin, $end, $orderBy, $pager);
}
