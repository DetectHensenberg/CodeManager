<?php
/**
 * 获取报告列表。
 * Get report list.
 *
 * @param  int    $objectID
 * @param  string $objectType
 * @param  int    $extra
 * @param  string $orderBy
 * @param  object $pager
 * @access public
 * @return array
 */
public function getList($objectID, $objectType, $extra = 0, $orderBy = 'id_desc', $pager = null)
{
    if(common::isTutorialMode()) return $this->loadModel('tutorial')->getTestReports();

    $reports = $this->dao->select('DISTINCT t1.*')->from(TABLE_TESTREPORT)->alias('t1')
        ->leftjoin(TABLE_TESTTASKPRODUCT)->alias('t2')->on('t1.tasks=t2.task')
        ->where('t1.deleted')->eq(0)
        ->beginIF($objectType == 'execution')
        ->andWhere('(t1.execution')->eq($objectID)
        ->orWhere('t2.execution')->eq($objectID)
        ->markRight(1)
        ->fi()
        ->beginIF($objectType == 'project')
        ->andWhere('(t1.project')->eq($objectID)
        ->orWhere('t2.project')->eq($objectID)
        ->markRight(1)
        ->fi()
        ->beginIF($objectType == 'product' && $extra)->andWhere('t1.objectID')->eq($extra)->andWhere('t1.objectType')->eq('testtask')->fi()
        ->beginIF($objectType == 'product' && !$extra)
        ->andWhere('(t1.product')->eq($objectID)
        ->orWhere('t2.product')->eq($objectID)
        ->markRight(1)
        ->fi()
        ->orderBy($orderBy)
        ->page($pager, 't1.id')
        ->fetchAll('id', false);

    return $this->appendProductGroup($reports);
}

/**
 * 获取测试报告键对。
 * Get pairs.
 *
 * @param  int    $productID
 * @param  int    $appendID
 * @access public
 * @return array
 */
public function getPairs($productID = 0, $appendID = 0)
{
    return $this->dao->select('t1.id,t1.title')->from(TABLE_TESTREPORT)->alias('t1')
        ->leftjoin(TABLE_TESTTASKPRODUCT)->alias('t2')->on('t1.tasks=t2.task')
        ->where('t1.deleted')->eq(0)
        ->beginIF($productID)->andWhere('(t1.product')->eq($productID)->orWhere('t2.product')->in($productID)->markRight(1)->fi()
        ->beginIF($appendID)->orWhere('t1.id')->eq($appendID)->fi()
        ->orderBy('id_desc')
        ->fetchPairs();
}

/**
 * 追加测试单产品分组数据。
 * Append product group.
 *
 * @param  array  $reports
 * @access public
 * @return array
 */
public function appendProductGroup($reports)
{
    $taskBuilds = $this->dao->select('t1.task, t2.*, t4.multiple, t3.name as executionName, t4.name as projectName, t5.name as productName')->from(TABLE_TESTTASKPRODUCT)->alias('t1')
        ->leftJoin(TABLE_BUILD)->alias('t2')->on('t1.build = t2.id')
        ->leftJoin(TABLE_EXECUTION)->alias('t3')->on('t1.execution = t3.id')
        ->leftJoin(TABLE_PROJECT)->alias('t4')->on('t1.project = t4.id')
        ->leftJoin(TABLE_PRODUCT)->alias('t5')->on('t1.product = t5.id')
        ->fetchGroup('task', 'id');

    foreach($reports as $reportID => $report)
    {
        foreach(explode(',', $report->tasks) as $taskID)
        {
            if(empty($taskBuilds[$taskID])) continue;
            $builds = $taskBuilds[$taskID];
            $executions = array();
            foreach($builds as $build)
            {
                if(!$build->multiple) continue;
                if($build->projectName && $build->executionName)
                {
                    $executions[$build->execution] = $build->projectName . '/' . $build->executionName;
                }
                elseif(!$build->executionName)
                {
                    $executions[$build->project] = $build->projectName;
                }
            }
            $reports[$reportID]->execution = implode(',', $executions);
        }
    }

    return $reports;
}
