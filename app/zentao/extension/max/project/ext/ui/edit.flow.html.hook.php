<?php
namespace zin;

$project      = data('project');
$from         = data('from');
$programID    = data('programID');
$disableModel = data('disableModel');
$loadUrl      = createLink('project', 'edit', "projectID={$project->id}&from={$from}&programID={$programID}&extra=workflowGroup={workflowGroup},model={model}");
query('formGridPanel')->each(function($node) use($disableModel, $loadUrl, $project)
{
    $lang           = data('lang');
    $model          = data('model');
    $workflowGroup  = data('workflowGroup');
    $workflowGroups = data('workflowGroups');

    $fields = $node->prop('fields');

    $fields->field('workflowGroup')
           ->label($lang->project->workflowGroup)
           ->control('picker')
           ->disabled(data('singleProjectFlow'))
           ->control(array('control' => 'picker', 'beforeChange' => jsRaw("(groupID, afterGroupID) => {if(groupID !== afterGroupID) return zui.Modal.confirm('{$lang->project->confirmEditWorkflowGroup}')}")))
           ->required(true)
           ->value($project->workflowGroup)
           ->items($workflowGroups)
           ->width('1/2')
           ->moveAfter('hasProduct');

    $fields->autoLoad('workflowGroup');

    $fields->autoLoad('workflowGroup');

    $fields->fullModeOrders('charter,workflowGroup,budget');
    $fields->orders('charter,workflowGroup,budget');

    $fields->field('hasProduct')->hidden(true);

    $node->setProp('fields', $fields);
    $node->setProp('loadUrl', $loadUrl);
});
