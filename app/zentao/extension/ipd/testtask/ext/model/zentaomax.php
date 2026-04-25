<?php
/**
 * @return int|false
 * @param object $testtask
 */
public function create($testtask)
{
    return $this->loadExtension('zentaomax')->create($testtask);
}

/**
 * @return mixed[]|bool
 * @param object $task
 * @param object $oldTask
 */
public function update($task, $oldTask)
{
    return $this->loadExtension('zentaomax')->update($task, $oldTask);
}

/**
 * @param int $productID
 * @param string $branch
 * @param string $type
 * @param string $begin
 * @param string $end
 * @param string $orderBy
 * @param object|null $pager
 */
public function getProductTasks($productID, $branch = 'all', $type = '', $begin = '', $end = '', $orderBy = 'id_desc', $pager = null)
{
    return $this->loadExtension('zentaomax')->getProductTasks($productID, $branch, $type, $begin, $end, $orderBy, $pager);
}

/**
 * @param int $projectID
 * @param int $productID
 * @param string $orderBy
 * @param object|null $pager
 * @param string $status
 */
public function getProjectTasks($projectID, $productID = 0, $orderBy = 'id_desc', $pager = null, $status = '')
{
    return $this->loadExtension('zentaomax')->getProjectTasks($projectID, $productID, $orderBy, $pager, $status);
}

/**
 * @param int $executionID
 * @param int $productID
 * @param string $objectType
 * @param string $orderBy
 * @param object|null $pager
 */
public function getExecutionTasks($executionID, $productID = 0, $objectType = 'execution', $orderBy = 'id_desc', $pager = null)
{
    return $this->loadExtension('zentaomax')->getExecutionTasks($executionID, $productID, $objectType, $orderBy, $pager);
}

/**
 * @param string $account
 * @param object|null $pager
 * @param string $orderBy
 * @param string $type
 */
public function getByUser($account, $pager = null, $orderBy = 'id_desc', $type = '')
{
    return $this->loadExtension('zentaomax')->getByUser($account, $pager, $orderBy, $type);
}

/**
 * @param int $productID
 * @param object $task
 * @param string $type
 * @param int $param
 * @param object|null $pager
 */
public function getLinkableCases($productID, $task, $type = 'all', $param = 0, $pager = null)
{
    return $this->loadExtension('zentaomax')->getLinkableCases($productID, $task, $type, $param, $pager);
}

/**
 * @param int $taskID
 */
public function getTaskProducts($taskID)
{
    return $this->loadExtension('zentaomax')->getTaskProducts($taskID);
}

/**
 * @param mixed[] $tasks
 */
public function appendProductGroup($tasks)
{
    return $this->loadExtension('zentaomax')->appendProductGroup($tasks);
}

/**
 * @return object|false
 */
public static function createTestTaskLink($type, $module, $parent, $extra)
{
    $taskID = $extra['taskID'];

    $data = new stdclass();
    $data->id     = $module->id;
    $data->parent = $module->parent ? $module->parent : $parent;
    $data->name   = $module->name;
    $data->url    = helper::createLink('testtask', 'cases', "taskID=$taskID&type=byModule&module={$module->id}");
    return $data;
}
