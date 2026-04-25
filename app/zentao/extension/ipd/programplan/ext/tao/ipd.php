<?php
/**
 * 更新IPD项目下评审点是否启用。
 * Update whether the evaluation point is enabled under the IPD project.
 *
 * @param  int    $projectID
 * @param  array  $points
 * @access public
 * @return bool 
 */
public function updatePoint($projectID = 0, $points = array())
{
    $this->dao->update(TABLE_OBJECT)->set('enabled')->eq(0)->where('project')->eq($projectID)->exec();
    $this->dao->update(TABLE_OBJECT)
        ->set('enabled')->eq(1)
        ->where('project')->eq($projectID)
        ->andWhere('category')->in(implode(',', $points))
        ->exec();
    return true;
}

/**
 * 获取项目流程对应的阶段对应的评审点。
 * Get stage points by project.
 *
 * @param  int    $projectID
 * @access public
 * @return array
 */
public function getStagePointsByProject($projectID)
{
    $stagePointGroup = $this->dao->select('execution AS stage,category AS id,categoryTitle AS title')->from(TABLE_OBJECT)
        ->where('type')->eq('decision')
        ->andWhere('project')->eq($projectID)
        ->fetchGroup('stage', 'id');

    if(empty($stagePointGroup))
    {
        $project = $this->dao->findByID($projectID)->from(TABLE_PROJECT)->fetch();
        $stagePointGroup = $this->dao->select('stage,id,title')->from(TABLE_DECISION)
            ->where('workflowGroup')->eq($project->workflowGroup)
            ->andWhere('deleted')->eq('0')
            ->orderBy('type_desc,order_asc')
            ->fetchGroup('stage', 'id');
    }

    $ipdStagePoint = array();
    foreach($stagePointGroup as $stageID => $pointList)
    {
        if(!isset($ipdStagePoint[$stageID])) $ipdStagePoint[$stageID] = array();
        foreach($pointList as $point) $ipdStagePoint[$stageID][$point->id] = $point->title;
    }
    return $ipdStagePoint;
}
