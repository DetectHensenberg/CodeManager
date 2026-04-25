<?php
/**
 * 根据项目获取可用的评审点。
 * Get review point by project.
 *
 * @param  int    $projectID
 * @access public
 * @return array
 */
public function getReviewPointByProject($projectID = 0)
{
    $project = $this->loadModel('project')->getByID($projectID);
    if($project->model != 'ipd') return array();

    $enabledPoints = $this->getPointsByProjectID($projectID, 'category');

    $pointList = array();
    foreach($enabledPoints as $category => $enabledPoint) $pointList[$category] = array('value' => $category, 'text' => $enabledPoint->title, 'disabled' => 1);

    $stages = $this->dao->select('*')->from(TABLE_EXECUTION)
        ->where('project')->eq($projectID)
        ->andWhere('type')->eq('stage')
        ->andWhere('parent')->eq($projectID)
        ->orderBy('order_asc')
        ->fetchAll('id');

    if(empty($stages)) return $pointList;

    return $this->checkPoints($stages, $enabledPoints, $pointList);
}

/**
 * 检查评审点是否可用。
 * Check points is available.
 *
 * @param  array  $stage
 * @param  array  $enabledPoints
 * @param  array  $pointList
 *
 * @access public
 * @return array
 * @param mixed[] $stages
 */
public function checkPoints($stages = array(), $enabledPoints = array(), $pointList = array())
{
    $prePoint       = '';
    $ipdReviewPoint = array();
    foreach($enabledPoints as $enabledPoint)
    {
        if(!isset($ipdReviewPoint[$enabledPoint->execution])) $ipdReviewPoint[$enabledPoint->execution] = array();
        $ipdReviewPoint[$enabledPoint->execution][] = $enabledPoint->category;
    }

    foreach($stages as $stageID => $stage)
    {
        if(!$stageID || !isset($ipdReviewPoint[$stageID])) continue;

        foreach($ipdReviewPoint[$stageID] as $point)
        {
            if($stage->enabled == 'off')
            {
                unset($pointList[$point]);
                continue;
            }

            if(!isset($pointList[$point])) continue;

            $pointResult    = isset($enabledPoints[$point]) ? $enabledPoints[$point]->result : '';
            $prePointResult = isset($enabledPoints[$prePoint]) ? $enabledPoints[$prePoint]->result : '';

            $pointList[$point]['disabled'] = false;

            /* 如果阶段还未开始，则评审点置灰。*/
            if($stage->status == 'wait')
            {
                $pointList[$point]['disabled'] = true;
                $pointList[$point]['message']  = $this->lang->review->stageNotStartTip;
                $prePoint = $point;
                continue;
            }

            /* 如果前一个评审点评审未通过, 则评审点置灰。*/
            if($prePoint && $prePointResult != 'pass')
            {
                $pointList[$point]['disabled'] = true;
                $pointList[$point]['message']  = $this->lang->review->prePointNotPassTip;
                $prePoint = $point;
                continue;
            }

            /* 如果评审点已经评审通过，或者已经发起了评审，还未被评审，则评审点置灰。*/
            if($pointResult == 'pass' || ($enabledPoints[$point]->review && !$pointResult && $enabledPoints[$point]->status != 'draft')) $pointList[$point]['disabled'] = true;

            $prePoint = $point;
        }
    }

    return $pointList;
}

/**
 * 根据评审点类型获取阶段。
 * Get stage by point.
 *
 * @param  string       $category
 * @param  int          $projectID
 * @access public
 * @return object|false
 */
public function getStageByPoint($category = '', $projectID = 0)
{
    if(!$category) return false;
    $object = $this->dao->select('*')->from(TABLE_OBJECT)->where('project')->eq($projectID)->andWhere('category')->eq($category)->fetch();

    $attribute = '';
    foreach($this->config->review->ipdReviewPoint as $type => $point)
    {
        if(!in_array($object->category, $point)) continue;
        $attribute = $type;
    }

    return $this->dao->select('*')->from(TABLE_EXECUTION)->where('project')->eq($object->project)->andWhere('type')->eq('stage')->andWhere('grade')->eq(1)->andWhere('attribute')->eq($attribute)->fetch();
}

/**
 * Get stage by review.
 *
 * @param  int    $reviewID
 * @access public
 * @return object
 */
public function getStageByReview($reviewID = 0)
{
    $object = $this->dao->select('t1.*')->from(TABLE_OBJECT)->alias('t1')
        ->leftJoin(TABLE_REVIEW)->alias('t2')->on('t2.object=t1.id')
        ->where('t2.id')->eq($reviewID)
        ->fetch();

    $stageType = '';
    foreach($this->config->review->ipdReviewPoint as $type => $point)
    {
        if(in_array($object->category, $point))
        {
            $stageType = $type;
            break;
        }
    }

    return $this->dao->select('*')->from(TABLE_EXECUTION)
        ->where('project')->eq($object->project)
        ->andWhere('type')->eq('stage')
        ->andWhere('attribute')->eq($stageType)
        ->fetch();
}

/**
 * In ipd project, create default review points after create a stage.
 *
 * @param  int    $projectID
 * @param  int    $stageID
 * @param  array  $defaultPoint
 * @access public
 * @return void
 */
public function createDefaultPoint($projectID, $stageID, $defaultPoint)
{
    $defaultPointList = $this->dao->select('*')->from(TABLE_DECISION)->where('id')->in($defaultPoint)->fetchAll('id');

    $object = new stdclass();
    $object->project     = $projectID;
    $object->execution   = $stageID;
    $object->product     = 0;
    $object->type        = 'decision';
    $object->version     = '';
    $object->createdBy   = $this->app->user->account;
    $object->createdDate = helper::today();
    foreach($defaultPoint as $pointID)
    {
        $object->title         = $defaultPointList[$pointID]->title;
        $object->categoryTitle = $defaultPointList[$pointID]->title;
        $object->category      = $pointID;
        $this->dao->insert(TABLE_OBJECT)->data($object)->exec();
    }
}

/**
 * 更新评审日期。
 * Update review date.
 *
 * @param  int    $objectID
 * @param  string $type
 * @access public
 * @return void
 */
public function updateReviewDate($objectID, $type)
{
    if($type == 'point')
    {
        $end = $_POST['startDate'];
        $this->dao->update(TABLE_OBJECT)->set('end')->eq($end)->where('id')->eq($objectID)->exec();
    }
}

/**
 * Get latest reviews for project's review points.
 *
 * @param  int    $projectID
 * @access public
 * @return array
 */
public function getPointLatestReviews($projectID)
{
    $this->app->loadLang('baseline');
    $pointList = $this->lang->baseline->ipd->pointList;
    unset($pointList['other']);
    unset($pointList['']);

    $reviews = $this->dao->select('t1.*, t2.category as category')->from(TABLE_REVIEW)->alias('t1')
        ->leftJoin(TABLE_OBJECT)->alias('t2')->on('t1.object = t2.id')
        ->where('t1.deleted')->eq(0)
        ->andWhere('t1.project')->eq($projectID)
        ->andWhere('t2.category')->in(array_keys($pointList))
        ->orderBy('id_asc')
        ->fetchAll('category');

    return $reviews;
}

/**
 * 获取IPD项目已启用的评审点列表。
 * Get IPD points.
 *
 * @param  int    $projectID
 * @param  string $groupBy  id|category
 * @access public
 * @return array
 */
public function getPointsByProjectID($projectID = 0, $groupBy = '')
{
    $points = $this->dao->select('*')->from(TABLE_OBJECT)
        ->where('project')->eq($projectID)
        ->andWhere('type')->eq('decision')
        ->andWhere('deleted')->eq('0')
        ->andWhere('enabled')->eq('1')
        ->orderby('id')
        ->fetchAll('id');

    $reviews = $this->dao->select('*')->from(TABLE_REVIEW)
        ->where('deleted')->eq(0)
        ->andWhere('object')->in(array_keys($points))
        ->fetchAll('object');

    foreach($points as $id => $point)
    {
        $point->status           = isset($reviews[$point->id]) ? $reviews[$point->id]->status           : '';
        $point->realBegan        = isset($reviews[$point->id]) ? $reviews[$point->id]->createdDate      : null;
        $point->deadline         = isset($reviews[$point->id]) ? $reviews[$point->id]->deadline         : '';
        $point->review           = isset($reviews[$point->id]) ? $reviews[$point->id]->id               : 0;
        $point->lastReviewedDate = isset($reviews[$point->id]) ? $reviews[$point->id]->lastReviewedDate : '';
        $point->result           = isset($reviews[$point->id]) ? $reviews[$point->id]->result           : '';
        $point->disabled         = in_array($point->status, array('reviewing', 'pass')) ? true : false;
    }
    if(empty($groupBy)) return $points;

    $pointGroup = array();
    foreach($points as $id => $point) $pointGroup[$point->$groupBy] = $point;
    return $pointGroup;
}

/**
 * Get point pairs by project id.
 *
 * @param  int $projectID
 * @access public
 * @return void
 */
public function getPointPairsByProjectID($projectID)
{
    return $this->dao->select('category, categoryTitle')->from(TABLE_OBJECT)->where('project')->eq($projectID)->andWhere('type')->eq('decision')->fetchPairs();
}
