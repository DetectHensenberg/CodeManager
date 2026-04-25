<?php
/**
 * 复制项目流程组。
 * Copy project workflow group.
 *
 * @param object $project
 * @return void
 */
public function copyWorkflowGroup($project)
{
    return $this->loadExtension('zentaobiz')->copyWorkflowGroup($project);
}

/**
 * 复制项目流程。
 * Copy project workflow.
 *
 * @param int $workflowGroupID
 * @param int $newWorkflowGroupID
 * @param string $table
 * @return void
 */
public function copyWorkflow($workflowGroupID, $newWorkflowGroupID, $table)
{
    return $this->loadExtension('zentaobiz')->copyWorkflow($workflowGroupID, $newWorkflowGroupID, $table);
}
