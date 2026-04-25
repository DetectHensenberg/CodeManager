<?php
/* Set menu for stage. */
if(empty($executionID))
{
    $executions = $this->loadModel('execution')->getPairs(0, 'all', 'nocode');
    if(!$executionID and $this->session->execution) $executionID = $this->session->execution;
    if(!$executionID or !in_array($executionID, array_keys($executions))) $executionID = key($executions);
}

/* Unset story, bug, build and testtask if type is ops. */
$execution = $this->getByID((int)$executionID);
if($execution and $execution->type == 'stage')
{
    $attribute = $execution->attribute;
    if($attribute and isset($this->lang->stage->attribute[$attribute]))
    {
        $this->lang->execution->menu = $this->lang->stage->attribute[$attribute]->menu;
        $this->lang->execution->dividerMenu = $this->lang->stage->attribute[$attribute]->dividerMenu;
    }
}

$project = !empty($execution) ? $this->loadModel('project')->getByID($execution->project) : null;
$model   = isset($project->model) ? $project->model : '';
if(in_array($model, array('scrum', 'agileplus', 'waterfallplus')) && $project->workflowGroup)
{
    $this->loadModel('workflowgroup');
    $workflowGroup = $this->loadModel('workflowgroup')->fetchByID((int)$project->workflowGroup);
    $featureList   = $this->config->featureGroup->project;
    foreach($featureList as $feature)
    {
        if(!$this->workflowgroup->hasFeature((int)$project->workflowGroup, $feature, $workflowGroup))
        {
            if($feature == 'process') $feature = 'pssp';
            unset($this->lang->execution->menu->other['dropMenu']->{$feature});
            if($feature == 'deliverable') unset($this->lang->execution->menu->auditplan['subMenu']->deliverable);
        }
    }
}
