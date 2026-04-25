<?php
if(helper::hasFeature('deliverable'))
{
    $config->workflowgroup->dtable->project->fieldList['actions']['list'] = $config->workflowgroup->actionList;
    $config->workflowgroup->dtable->project->fieldList['actions']['menu'] = array('design', 'release|deactivate', 'copy', 'edit', 'delete');;

    if(!isset($config->workflowgroup->form)) $config->workflowgroup->form = new stdclass();
    $config->workflowgroup->form->deliverable['key']         = array('type' => 'string', 'base' => true);
    $config->workflowgroup->form->deliverable['deliverable'] = array('type' => 'array');
    $config->workflowgroup->form->deliverable['required']    = array('type' => 'array');
}
