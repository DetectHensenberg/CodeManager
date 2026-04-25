<?php
/**
 * Save copy project.
 *
 * @param  int    $copyProjectID
 * @param  string $model
 * @param  object $executions
 * @param  string $copyFrom
 * @access public
 * @return string
 */
public function saveCopyProject($copyProjectID, $model = 'scrum', $executions = array(), $copyFrom = '')
{
    return $this->loadExtension('zentaomax')->saveCopyProject($copyProjectID, $model, $executions, $copyFrom);
}

/**
 * Check create.
 *
 * @access public
 * @return bool
 */
public function checkCreate($copyProjectID = 0)
{
    return $this->loadExtension('zentaomax')->checkCreate($copyProjectID);
}

/**
 * Change execution deliverable.
 *
 * @param  object $project
 * @access public
 * @return bool
 */
public function changeExecutionDeliverable($project)
{
    return $this->loadExtension('zentaomax')->changeExecutionDeliverable($project);
}

/**
 * check execution.
 *
 * @param array  $executions
 * @param int    $projectID
 * @param string $model
 * @access public
 * @return void
 */
public function checkExecution($executions, $projectID = 0, $model = 'scrum')
{
    return $this->loadExtension('zentaomax')->checkExecution($executions, $projectID, $model);
}

/**
 * Save process.
 *
 * @param int     $copyProjectID
 * @param int     $executionID
 * @param int     $lastExecutionID
 * @param string  $model
 * @access public
 * @return void
 */
public function saveProcess($copyProjectID, $projectID, $executionID, $lastExecutionID, $model)
{
    return $this->loadExtension('zentaomax')->saveProcess($copyProjectID, $projectID, $executionID, $lastExecutionID, $model);
}

/**
 * 复制项目的任务关系。
 * Copy project task relations.
 *
 * @param  int    $copyProjectID
 * @param  int    $projectID
 * @param  array  $executionIdList
 * @param  array  $taskIdList
 * @access public
 * @return bool
 */
public function copyProjectTaskRelations($copyProjectID, $projectID, $executionIdList, $taskIdList)
{
    return $this->loadExtension('zentaomax')->copyProjectTaskRelations($copyProjectID, $projectID, $executionIdList, $taskIdList);
}

/**
 * 复制项目的审批设置。
 * Copy project approval flow objects.
 *
 * @param  int    $copyProjectID
 * @param  int    $projectID
 * @access public
 * @return bool
 */
public function copyProjectApprovalFlow($copyProjectID, $projectID)
{
    return $this->loadExtension('zentaomax')->copyProjectApprovalFlow($copyProjectID, $projectID);
}

/**
 * 复制迭代的模块。
 * Copy execution Module.
 *
 * @param  int    $executionID
 * @param  int    $lastExecutionID
 * @access public
 * @return array
 */
public function copyExecutionTaskModule($executionID, $lastExecutionID)
{
    return $this->loadExtension('zentaomax')->copyExecutionTaskModule($executionID, $lastExecutionID);
}

/**
 * 复制项目的评审点。
 * Copy project review point.
 *
 * @param  int    $copyProjectID
 * @param  int    $projectID
 * @access public
 * @return bool
 */
public function copyProjectReviewPoint($copyProjectID, $projectID)
{
    return $this->loadExtension('zentaomax')->copyProjectReviewPoint($copyProjectID, $projectID);
}

/**
 * Save QA.
 *
 * @param int  $copyProjectID
 * @param int  $projectID
 * @param int  $executionID
 * @param int  $lastExecutionID
 * @access public
 * @return void
 */
public function saveQA($copyProjectID, $projectID, $executionID, $lastExecutionID)
{
    return $this->loadExtension('zentaomax')->saveQA($copyProjectID, $projectID, $executionID, $lastExecutionID);
}

/**
 * Save task.
 *
 * @param  int    $copyProjectID
 * @param  int    $projectID
 * @param  int    $executionID
 * @param  int    $lastExecutionID
 * @param  array  $moduleList
 * @param  string $copyFrom
 * @access public
 * @return void
 */
public function saveTask($copyProjectID, $projectID, $executionID, $lastExecutionID, $moduleList, $copyFrom = '')
{
    return $this->loadExtension('zentaomax')->saveTask($copyProjectID, $projectID, $executionID, $lastExecutionID, $copyFrom);
}

/**
 * Save execution doc lib.
 *
 * @param int  $executionID
 * @param int  $lastExecutionID
 * @access public
 * @return void
 */
public function saveExecutionDocLib($executionID, $lastExecutionID, $projectID)
{
    return $this->loadExtension('zentaomax')->saveExecutionDocLib($executionID, $lastExecutionID, $projectID);
}

/**
 * Save project doc lib.
 *
 * @param int  $copyProjectID
 * @param int  $projectID
 * @access public
 * @return void
 */
public function saveProjectDocLib($copyProjectID, $projectID)
{
    return $this->loadExtension('zentaomax')->saveProjectDocLib($copyProjectID, $projectID);
}

/**
 * Save team.
 *
 * @param int     $copyObjectID
 * @param int     $objectID
 * @param string  $type
 * @access public
 * @return void
 */
public function saveTeam($copyObjectID, $objectID, $type = 'project')
{
    return $this->loadExtension('zentaomax')->saveTask($copyObjectID, $objectID, $type);
}

/**
 * Save stakeholder.
 *
 * @param int  $copyProjectID
 * @param int  $projectID
 * @access public
 * @return void
 */
public function saveStakeholder($copyProjectID, $projectID)
{
    return $this->loadExtension('zentaomax')->saveStakeholder($copyProjectID, $projectID);
}

/**
 * Save group.
 *
 * @param int  $copyProjectID
 * @param int  $projectID
 * @access public
 * @return void
 */
public function saveGroup($copyProjectID, $projectID)
{
    return $this->loadExtension('zentaomax')->saveGroup($copyProjectID, $projectID);
}

/**
 * Save RD kanban.
 *
 * @param  int    $execution
 * @param  int    $lastExecutionID
 * @access public
 * @return void
 */
public function saveKanban($execuitonID, $lastExecutionID)
{
    return $this->loadExtension('zentaomax')->saveKanban($execuitonID, $lastExecutionID);
}

/**
 * Set menu of project module.
 *
 * @param  int    $projectID
 * @access public
 * @return int|false
 */
public function setMenu($projectID)
{
    return $this->loadExtension('zentaomax')->setMenu($projectID);
}

/**
 * 检查名称唯一性.
 * Check name unique.
 *
 * @param  array  $names
 * @access public
 * @return bool
 */
public function checkNameUnique($names)
{
    return $this->loadExtension('zentaomax')->checkNameUnique($names);
}

/**
 * 创建一个项目。
 * Create a project.
 *
 * @param  object   $project
 * @param  object   $postData
 * @access public
 * @return int|bool
 */
public function create($project, $postData)
{
    return $this->loadExtension('zentaomax')->create($project, $postData);
}

/**
 * 关闭项目并更改其状态
 * Close project and update status.
 *
 * @param  int    $projectID
 * @param  object $project
 *
 * @access public
 * @return array|false
 */
public function close($projectID, $project)
{
    return $this->loadExtension('zentaomax')->close($projectID, $project);
}

/**
 * 添加默认交付物。
 * Add default deliverable.
 *
 * @param  int    $projectID
 * @param  int    $groupID
 * @access public
 * @return void
 */
public function addDefaultDeliverable($projectID, $groupID)
{
    return $this->loadExtension('zentaomax')->addDefaultDeliverable($projectID, $groupID);
}

/**
 * 获取项目交付物键值对。
 * Get deliverable pairs.
 *
 * @param  int    $projectID
 * @param  string $status
 * @access public
 * @return array
 * @param string $frozen
 */
public function getDeliverablePairs($projectID, $status = '', $frozen = 'all')
{
    return $this->loadExtension('zentaomax')->getDeliverablePairs($projectID, $status, $frozen);
}

/**
 * 获取按照交付物类型分组的项目交付物。
 * Get deliverable group by category.
 *
 * @param  int    $projectID
 * @param  string $status
 * @access public
 * @return array
 */
public function getDeliverableGroupByCategory($projectID, $status = '')
{
    return $this->loadExtension('zentaomax')->getDeliverableGroupByCategory($projectID, $status);
}

/**
 * 获取项目可提交评审交付物键值对。
 * Get deliverable pairs for submit review.
 *
 * @param  int    $projectID
 * @param  int    $categoryID
 * @param  int    $reviewID
 * @param  int    $deliverableID
 * @access public
 * @return array
 */
public function getCanSubmitDeliverablePairs($projectID, $categoryID = 0, $reviewID = 0, $deliverableID = 0)
{
    return $this->loadExtension('zentaomax')->getCanSubmitDeliverablePairs($projectID, $categoryID, $reviewID, $deliverableID);
}

/**
 * 获取项目的交付物列表。
 * Get project deliverable list.
 *
 * @param  int    $projectID
 * @param  string $browseType
 * @param  int|string $param
 * @param  string $orderBy
 * @param  object|null $pager
 * @access public
 * @return array
 */
public function getDeliverableList($projectID, $browseType = 'normal', $param = 0, $orderBy = 'id_desc', $pager = null)
{
    return $this->loadExtension('zentaomax')->getDeliverableList($projectID, $browseType, $param, $orderBy, $pager);
}

/**
 * 获取项目的待评审交付物列表。
 * Get project wait deliverable list.
 *
 * @param  int         $projectID
 * @param  string      $orderBy
 * @param  object|null $pager
 * @access public
 * @return array
 */
public function getWaitDeliverableList($projectID, $orderBy = 'id_desc', $pager = null)
{
    return $this->loadExtension('zentaomax')->getWaitDeliverableList($projectID, $orderBy, $pager);
}

/**
 * 获取后台的交付物配置。
 * Get deliverables for backend.
 *
 * @param  int    $groupID
 * @param  string $stageType project|stageList(release|design|request|mix...)|sprint|kanban
 * @param  int    $objectID
 * @param  string $status
 * @param  int    $appendID
 * @param  bool   $excludeSystemList
 * @param  int    $projectID
 * @access public
 * @return array
 */
public function getDeliverables($groupID, $stageType = 'project', $objectID = 0, $status = 'enabled', $appendID = 0, $excludeSystemList = false, $projectID = 0)
{
    return $this->loadExtension('zentaomax')->getDeliverables($groupID, $stageType, $objectID, $status, $appendID, $excludeSystemList, $projectID);
}

/**
 * 获取项目的交付物，包含已上传的和未上传的。
 * Get project deliverables, include uploaded and not uploaded.
 *
 * @param  int    $groupID
 * @param  string $type         project|stageList(release|design|request|mix...)|sprint|kanban
 * @param  array  $projectDeliverables
 * @param  int    $objectID
 * @param  bool   $withName
 * @access public
 * @return string
 */
public function getProjectDeliverables($groupID, $type = 'project', $projectDeliverables = array(), $objectID = 0, $withName = false)
{
    return $this->loadExtension('zentaomax')->getProjectDeliverables($groupID, $type, $projectDeliverables, $objectID, $withName);
}

/**
 * 填充交付物附件和文档用于展示。
 * Fill deliverable file and doc for display.
 *
 * @param  array $deliverables
 * @param  string $objectType project|execution
 * @access public
 * @return array
 */
public function fillDocForDisplay($deliverables, $objectType = 'project')
{
    return $this->loadExtension('zentaomax')->fillDocForDisplay($deliverables, $objectType);
}

/**
 * 检查项目是否提交过交付物。
 * Check uploaded deliverable.
 *
 * @param  int $projectID
 * @access public
 * @return bool
 */
public function checkUploadedDeliverable($projectID)
{
    return $this->loadExtension('zentaomax')->checkUploadedDeliverable($projectID);
}

/**
 * 保存单个交付物。
 * Save single deliverable.
 *
 * @param  object $project
 * @param  array  $postData
 * @param  object $deliverable
 * @access public
 * @return bool
 */
public function saveSingleDeliverable($project, $postData, $deliverable)
{
    return $this->loadExtension('zentaomax')->saveSingleDeliverable($project, $postData, $deliverable);
}

/**
 * 维护交付物页面的保存逻辑。
 * Save deliverable.
 *
 * @param  object $object
 * @param  array  $newDeliverables
 * @access public
 * @return bool
 */
public function saveDeliverable($object, $newDeliverables)
{
    return $this->loadExtension('zentaomax')->saveDeliverable($object, $newDeliverables);
}

/**
 * 计算交付物数量。
 * Count deliverable.
 *
 * @param  array  $objects
 * @param  string $objectType
 * @access public
 * @return array
 */
public function countDeliverable($objects, $objectType = 'project')
{
    return $this->loadExtension('zentaomax')->countDeliverable($objects, $objectType);
}

/**
 * 获取项目模板列表。
 * Get template list.
 *
 * @param  string $status
 * @param  string $orderBy
 * @param  object $pager
 * @access public
 * @return array
 */
public function getTemplateList($status = 'all', $orderBy = 'id_asc', $pager = null)
{
    return $this->loadExtension('zentaomax')->getTemplateList($status, $orderBy, $pager);
}

/**
 * 更新项目模板。
 * Update project template.
 *
 * @param  int    $projectID
 * @param  object $project
 * @param  object $oldProject
 * @access public
 * @return bool|array
 */
public function updateTemplate($projectID, $project, $oldProject)
{
    return $this->loadExtension('zentaomax')->updateTemplate($projectID, $project, $oldProject);
}

/**
 * 获取交付物模板项。
 * Get deliverable template items.
 *
 * @param  string $template
 * @param  string $type
 * @param  int    $objectID
 * @access public
 * @return array
 */
public function getTemplateItems($template, $type, $objectID)
{
    return $this->loadExtension('zentaomax')->getTemplateItems($template, $type, $objectID);
}

/**
 * 检查交付物是否必填。
 * Check deliverable is required.
 *
 * @param  array  $categories
 * @param  array  $currentDeliverables
 * @access public
 * @return bool
 */
public function checkDeliverables($categories, $currentDeliverables)
{
    return $this->loadExtension('zentaomax')->checkDeliverables($categories, $currentDeliverables);
}

/*
 * 保存复制的执行。
 * Save copy executions.
 *
 * @param  array  $insertExecutions
 * @param  int    $productID
 * @param  int    $copyProjectID
 * @param  object $project
 * @param  int    $projectID
 * @param  string $model
 * @param  string $copyFrom
 * @access public
 * @return array
 */
public function saveExecutions($insertExecutions = array(), $productID = 0, $copyProjectID = 0, $project = null, $projectID = 0, $model = 'scrum', $copyFrom = '')
{
    return $this->loadExtension('zentaomax')->saveExecutions($insertExecutions, $productID, $copyProjectID, $project, $projectID, $model, $copyFrom);
}

/**
 * 构建交付物搜索表单。
 * Build deliverable search form.
 *
 * @param  string $actionURL
 * @param  int    $queryID
 * @param  int    $projectID
 * @access public
 * @return void
 */
public function buildDeliverableSearchForm($actionURL, $queryID, $projectID)
{
    return $this->loadExtension('zentaomax')->buildDeliverableSearchForm($actionURL, $queryID, $projectID);
}

/**
 * 获取项目交付物。
 * Get project deliverable.
 *
 * @param  int    $deliverableID
 * @param  int    $reviewID
 * @access public
 * @return object
 */
public function getDeliverableByID($deliverableID, $reviewID = 0)
{
    return $this->loadExtension('zentaomax')->getDeliverableByID($deliverableID, $reviewID);
}

/**
 * 替换交付物。
 * Replace deliverable.
 *
 * @param  int    $projectID
 * @param  int    $oldGroupID
 * @param  int    $newGroupID
 * @access public
 * @return void
 */
public function modifyWorkflowGroup($projectID, $oldGroupID, $newGroupID)
{
    return $this->loadExtension('zentaomax')->modifyWorkflowGroup($projectID, $oldGroupID, $newGroupID);
}

/**
 * 获取交付物版本状态。
 * Get deliverable version status.
 *
 * @param  int         $projectID
 * @param  object      $deliverable
 * @param  object|null $doc
 * @access public
 * @return string
 */
public function getVersionStatus($projectID, $deliverable, $doc)
{
    return $this->loadExtension('zentaomax')->getVersionStatus($projectID, $deliverable, $doc);
}

/**
 * 填充编辑链接。
 * Append edit link.
 *
 *
 * @param  object          $deliverable
 * @param mixed $doc
 * @param  int             $projectID
 * @access public
 * @return object
 */
public function appendEditLink($deliverable, $doc, $projectID)
{
    return $this->loadExtension('zentaomax')->appendEditLink($deliverable, $doc, $projectID);
}

/**
 * 获取提交来源列表。
 * Get submit from pairs.
 *
 * @param  int    $projectID
 * @access public
 * @return array
 */
public function getSubmitFromPairs($projectID)
{
    return $this->loadExtension('zentaomax')->getSubmitFromPairs($projectID);
}

/**
 * 获取交付物检查列表。
 * Get deliverable checklist.
 *
 * @param  int    $groupID
 * @param  int    $projectID
 * @param  int    $executionID
 * @param  string $browseType  all|wait|normal
 * @access public
 * @return array
 */
public function getDeliverableChecklist($groupID, $projectID, $executionID = 0, $browseType = 'all')
{
    return $this->loadExtension('zentaomax')->getDeliverableChecklist($groupID, $projectID, $executionID, $browseType);
}

/**
 * 获取项目过程裁剪后不适用的活动。
 * Get disabled activities.
 *
 * @param  int    $projectID
 * @param  int    $executionID
 * @access public
 * @return array
 */
public function getDisabledActivities($projectID, $executionID = 0)
{
    return $this->loadExtension('zentaomax')->getDisabledActivities($projectID, $executionID);
}

/**
 * 获取项目过程裁剪后不适用的交付物类型。
 * Get disabled deliverables.
 *
 * @param  int    $projectID
 * @param  int    $executionID
 * @access public
 * @return array
 */
public function getDisabledDeliverables($projectID, $executionID = 0)
{
    return $this->loadExtension('zentaomax')->getDisabledDeliverables($projectID, $executionID);
}

/**
 * 复制目标数据。
 * Copy targets.
 *
 * @param  int    $copyProjectID
 * @param  int    $projectID
 * @access public
 * @return bool
 */
public function copyProjectTargets($copyProjectID, $projectID)
{
    return $this->loadExtension('zentaomax')->copyProjectTargets($copyProjectID, $projectID);
}

/**
 * 设置要插入的执行数据。
 * Set insert execution data.
 *
 * @param  array  $executions
 * @param  array  $executionIdList
 * @param  string $model
 * @param  int    $productID
 * @param  string $parentAcl
 * @param  string $copyFrom
 * @access public
 * @return void
 */
public function setInsertExecutions($executions = array(), $executionIdList = array(), $model = 'scrum', $productID = 0, $parentAcl = '', $copyFrom = '')
{
    return $this->loadExtension('zentaomax')->setInsertExecutions($executions, $executionIdList, $model, $productID, $parentAcl, $copyFrom);
}
