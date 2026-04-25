<?php
$lang->resource->projectstory->importroadmapstories = 'importRoadmapStories';

$lang->resource->task->confirmdemandretract     = 'confirmDemandRetract';
$lang->resource->task->confirmdemandunlink      = 'confirmDemandUnlink';

$lang->resource->bug->confirmdemandretract      = 'confirmDemandRetract';
$lang->resource->bug->confirmdemandunlink       = 'confirmDemandUnlink';

$lang->resource->story->confirmdemandretract    = 'confirmDemandRetract';
$lang->resource->story->confirmdemandunlink     = 'confirmDemandUnlink';

$lang->resource->testcase->confirmdemandretract = 'confirmDemandRetract';
$lang->resource->testcase->confirmdemandunlink  = 'confirmDemandUnlink';

global $config;
if($config->enableER)
{
    $lang->resource->custom->epicGrade = 'epicGrade';
    $lang->custom->methodOrder[72] = 'epicGrade';
}
if($config->URAndSR)
{
    $lang->resource->custom->requirementGrade = 'requirementGrade';
    $lang->custom->methodOrder[73] = 'requirementGrade';
}

$lang->resource->custom->storyGrade       = 'storyGrade';
$lang->resource->custom->closeGrade       = 'closeGrade';
$lang->resource->custom->activateGrade    = 'activateGrade';
$lang->resource->custom->deleteGrade      = 'deleteGrade';

$lang->custom->methodOrder[74] = 'storyGrade';
$lang->custom->methodOrder[75] = 'closeGrade';
$lang->custom->methodOrder[80] = 'activateGrade';
$lang->custom->methodOrder[85] = 'deleteGrade';

if(isset($lang->resource->stage))
{
    $lang->resource->stage->setTRpoint  = 'setTRpoint';
    $lang->resource->stage->setDCPpoint = 'setDCPpoint';
}
