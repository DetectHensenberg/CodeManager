<?php
$lang->reporttemplate->create         = 'Create Report Template';
$lang->reporttemplate->edit           = 'Edit';
$lang->reporttemplate->editAction     = 'Edit Report Template';
$lang->reporttemplate->delete         = 'Delete Template';
$lang->reporttemplate->deleteAbbr     = 'Delete';
$lang->reporttemplate->deleteAction   = 'Delete Report Template';
$lang->reporttemplate->browse         = 'Browse Report Template';
$lang->reporttemplate->view           = 'Report Template Details';
$lang->reporttemplate->addCategory    = 'Add Category';
$lang->reporttemplate->editCategory   = 'Edit Category';
$lang->reporttemplate->deleteCategory = 'Delete Category';
$lang->reporttemplate->pause          = 'Pause';
$lang->reporttemplate->pauseAction    = 'Pause Report Template';
$lang->reporttemplate->cron           = 'Cron';

$lang->reporttemplate->lib            = 'Scopes';
$lang->reporttemplate->module         = 'Module';
$lang->reporttemplate->objects        = 'Flows';
$lang->reporttemplate->title          = 'Title';
$lang->reporttemplate->status         = 'Status';
$lang->reporttemplate->desc           = 'Description';
$lang->reporttemplate->acl            = 'Access Control';
$lang->reporttemplate->reportAcl      = 'Created Report Access Control';
$lang->reporttemplate->cycle          = 'Data Generation Frequency';
$lang->reporttemplate->content        = 'Template Content';
$lang->reporttemplate->basic          = 'Basic Info';
$lang->reporttemplate->basicStatistic = 'Basic Statistics';
$lang->reporttemplate->progress       = 'Progress Analysis';
$lang->reporttemplate->resource       = 'Resource Analysis';
$lang->reporttemplate->fixedProgress  = 'Repair progress';
$lang->reporttemplate->outline        = 'Outline';
$lang->reporttemplate->beginDate      = 'Begin Date';
$lang->reporttemplate->endDate        = 'End Date';
$lang->reporttemplate->allProject     = 'All flow templates';
$lang->reporttemplate->dateRange      = 'Date Range';
$lang->reporttemplate->cronLog        = 'Cron Log';

$lang->reporttemplate->aclList['open']    = 'Public (Have permission to view report templates, can be accessed)';
$lang->reporttemplate->aclList['private'] = 'Private (Only the creator and white list users can access)';

$lang->reporttemplate->statusList['draft']  = 'Draft';
$lang->reporttemplate->statusList['normal'] = 'Released';
$lang->reporttemplate->statusList['pause']  = 'Paused';

$lang->reporttemplate->cronTitle             = 'Cron Rule Settings';
$lang->reporttemplate->cronTurnon            = 'Is Timing Generate';
$lang->reporttemplate->cronTurnonList['on']  = 'Yes';
$lang->reporttemplate->cronTurnonList['off'] = 'No';

$lang->reporttemplate->cronFrequency              = 'Data Generation Frequency';
$lang->reporttemplate->cronFrequencyList['day']   = 'Day';
$lang->reporttemplate->cronFrequencyList['week']  = 'Week';
$lang->reporttemplate->cronFrequencyList['month'] = 'Month';
$lang->reporttemplate->cronFrequencyTips['day']   = '（Generate report at 0:00 every day）';
$lang->reporttemplate->cronFrequencyTips['week']  = '（Generate report at 0:00 every Monday）';
$lang->reporttemplate->cronFrequencyTips['month'] = '（Generate report at 0:00 every 1st）';

$lang->reporttemplate->appendUsers['PROJECTPM']          = 'Project Manager';
$lang->reporttemplate->appendUsers['PROJECTTEAM']        = 'Project Team Members';
$lang->reporttemplate->appendUsers['PROJECTSTAKEHOLDER'] = 'Project Stakeholders';
$lang->reporttemplate->appendUsers['PROJECTWHITELIST']   = 'Project White List';

$lang->reporttemplate->titleTemplate['day']   = '%s Daily Report';
$lang->reporttemplate->titleTemplate['week']  = '%s Weekly Report';
$lang->reporttemplate->titleTemplate['month'] = '%s Monthly Plan Report';

$lang->reporttemplate->weekNumber[0] = 'First Week';
$lang->reporttemplate->weekNumber[1] = 'Second Week';
$lang->reporttemplate->weekNumber[2] = 'Third Week';
$lang->reporttemplate->weekNumber[3] = 'Fourth Week';
$lang->reporttemplate->weekNumber[4] = 'Fifth Week';
$lang->reporttemplate->weekNumber[5] = 'Sixth Week';

$lang->reporttemplate->hotDate      = 'Edited Date';
$lang->reporttemplate->scope        = 'Scope';
$lang->reporttemplate->scopeField   = 'Scope';
$lang->reporttemplate->categoryName = 'Name';
$lang->reporttemplate->templateDesc = 'Description';
$lang->reporttemplate->groups       = 'Groups';
$lang->reporttemplate->users        = 'Users';

$lang->reporttemplate->noCategory              = 'No Category';
$lang->reporttemplate->noTemplate              = 'No Report Template';
$lang->reporttemplate->noDesc                  = 'No Desc';
$lang->reporttemplate->createTypeFirst         = 'Please create a template category first.';
$lang->reporttemplate->confirmPause            = 'Do you want to pause this template?';
$lang->reporttemplate->confirmDelete           = 'Do you want to delete this report template?';
$lang->reporttemplate->confirmDeleteCategory   = 'Do you want to delete this category?';
$lang->reporttemplate->leaveEditingConfirm     = 'The template is currently being edited. Do you want to leave the editing page?';
$lang->reporttemplate->searchScopePlaceholder  = 'Search Scope';
$lang->reporttemplate->searchModulePlaceholder = 'Search Category';
$lang->reporttemplate->insertSystemData        = 'Insert System Data';
$lang->reporttemplate->executionDataTips       = "Obtain all {$lang->execution->common} data within the project";
$lang->reporttemplate->noneConditionTips       = 'If no conditions are set, all data within the project will be retrieved.';
$lang->reporttemplate->chartBlockTip           = 'Display the relevant charts when generating reports from this template';
$lang->reporttemplate->emptyDataTip            = 'There is no system data that conform to this filtering conditions.';
$lang->reporttemplate->devRateTip              = 'Task type is %s, (the number of %s tasks / total) * 100%%';
$lang->reporttemplate->testRateTip             = 'Task type is %s, (the number of %s tasks / total) * 100%%';
$lang->reporttemplate->taskTotalCount          = 'Total: %s tasks';
$lang->reporttemplate->logTemplate             = 'Successfully generated %s reports, %s failed';

$lang->reporttemplate->doingSummaryTip = <<<EOD
Number of stories: The sum of all stories in %s
Remaining stories: The sum of all ongoing stories that are not closed in %s
Number of tasks: The sum of all tasks in %s
Remaining tasks: The sum of tasks in %s with a status that is not 'Closed' or 'Completed'
Remaining hours: The sum of remaining hours for all tasks in %s, filtering out parent tasks and tasks with statuses of 'Cancelled' and 'Closed'
Consumed hours: The sum of remaining hours for all tasks in %s, filtering out parent tasks
Progress in %s: Consumed hours / (Consumed hours + Remaining hours) * 100%
EOD;

$lang->reporttemplate->closedSummaryTip = <<<EOD
Display statistical data on the second day after executing the shutdown, with the following statistical rules:
Development Efficiency: %s closed delivered R&D stories scale / task hours consumed according to %s
story Acceptance Rate: %s closed R&D stories accepted / valid R&D stories according to %s
story Planned Completion Rate: %s closed delivered R&D stories / R&D stories as of the start of %s
Development Task Completion Rate: %s closed completed development tasks / development tasks according to %s
Testing Task Completion Rate: %s closed completed testing tasks / testing tasks according to %s
Test Defect Density: New valid bugs according to %s / R&D stories scale completed by %s closed
EOD;

$lang->reporttemplate->notice = new stdclass();
$lang->reporttemplate->notice->filter     = 'Filter';
$lang->reporttemplate->notice->noSettings = 'Obtain all %s data within the project';
$lang->reporttemplate->notice->noSupport  = 'This project does not support %s.';
$lang->reporttemplate->notice->logLimit   = 'Display up to 20 latest records';

$lang->reporttemplate->disabledHint = new stdclass();
$lang->reporttemplate->disabledHint->pause  = 'This template has not been released yet';
$lang->reporttemplate->disabledHint->delete = 'The built-in report template cannot be deleted';

$lang->reporttemplate->error = new stdclass();
$lang->reporttemplate->error->deleteCategory   = 'There is report template exists in the current category, it cannot be deleted.';
$lang->reporttemplate->error->beginMoreThanEnd = 'Start date cannot be greater than the end date.';

$lang->reporttemplate->builtInScopes = array();
$lang->reporttemplate->builtInScopes['rnd']  = array();
$lang->reporttemplate->builtInScopes['rnd']['project'] = 'Project';

$lang->reporttemplate->filterTypes = array();
$lang->reporttemplate->filterTypes[] = array('all', 'All');
$lang->reporttemplate->filterTypes[] = array('draft', 'Draft');
$lang->reporttemplate->filterTypes[] = array('released', 'Released');
$lang->reporttemplate->filterTypes[] = array('paused', 'Paused');
$lang->reporttemplate->filterTypes[] = array('createdByMe', 'Created By Me');

$lang->reporttemplate->quickEditMenuList['properties']   = 'Properties';
$lang->reporttemplate->quickEditMenuList['lists']        = 'Lists';
$lang->reporttemplate->quickEditMenuList['measurements'] = 'Measurements';
$lang->reporttemplate->quickEditMenuList['charts']       = 'Charts';

$lang->reporttemplate->filterList['projectStory'] = 'Project Story Filter';
$lang->reporttemplate->filterList['HLDS']         = 'Outline Design Filter';
$lang->reporttemplate->filterList['DDS']          = 'Detailed Design Filter';
$lang->reporttemplate->filterList['DBDS']         = 'Database Design Filter';
$lang->reporttemplate->filterList['ADS']          = 'Application Design Filter';
$lang->reporttemplate->filterList['task']         = 'Project Task Filter';
$lang->reporttemplate->filterList['projectCase']  = 'Project Case Filter';
$lang->reporttemplate->filterList['projectBug']   = 'Project Bug Filter';

$lang->reporttemplate->project   = $lang->projectCommon;
$lang->reporttemplate->execution = $lang->execution->common;
$lang->reporttemplate->task      = 'Task';
$lang->reporttemplate->story     = 'Story';
$lang->reporttemplate->bug       = 'Bug';
$lang->reporttemplate->testcase  = 'Case';
$lang->reporttemplate->weekly    = 'Report';

$lang->reporttemplate->measurementList['execution']['total']     = "{$lang->execution->common} Number";
$lang->reporttemplate->measurementList['execution']['doingNum']  = "Doing {$lang->execution->common} Number";
$lang->reporttemplate->measurementList['execution']['closedNum'] = "Closed {$lang->execution->common} Number";
$lang->reporttemplate->measurementList['execution']['delayNum']  = "Delayed {$lang->execution->common} Number";

$lang->reporttemplate->measurementList['task']['taskNum']     = 'Task Number';
$lang->reporttemplate->measurementList['task']['doneNum']     = 'Done Task Number';
$lang->reporttemplate->measurementList['task']['consumed']    = 'Consumed man-hours';
$lang->reporttemplate->measurementList['task']['left']        = 'Left man-hours';
$lang->reporttemplate->measurementList['task']['bugTaskNum']  = 'Number of bug-converted tasks';
$lang->reporttemplate->measurementList['task']['bugConsume']  = 'The consumed man-hours for bug-converted tasks';

$lang->reporttemplate->measurementList['story']['storyNum']        = 'Story Number';
$lang->reporttemplate->measurementList['story']['storyScale']      = 'Story Scale Number';
$lang->reporttemplate->measurementList['story']['devNum']          = 'Developed Story Number';
$lang->reporttemplate->measurementList['story']['devScale']        = 'Developed Story Scale Number';
$lang->reporttemplate->measurementList['story']['testNum']         = 'Tested Story Number';
$lang->reporttemplate->measurementList['story']['testScale']       = 'Tested Story Scale Number';
$lang->reporttemplate->measurementList['story']['doneNum']         = 'Done Story Number';
$lang->reporttemplate->measurementList['story']['doneScale']       = 'Done Story Scale Number';
$lang->reporttemplate->measurementList['story']['closedNum']       = 'Closed Story Number';
$lang->reporttemplate->measurementList['story']['closedScale']     = 'Closed Story Scale Number';
$lang->reporttemplate->measurementList['story']['changedNum']      = 'Changed Story Number';
$lang->reporttemplate->measurementList['story']['changedScale']    = 'Changed Story Scale Number';
$lang->reporttemplate->measurementList['story']['defect']          = 'Defect Density';
$lang->reporttemplate->measurementList['story']['hasCaseStoryNum'] = 'Has Case Story Number';
$lang->reporttemplate->measurementList['story']['caseCoverage']    = 'Story Case Coverage';
$lang->reporttemplate->measurementList['story']['caseDensity']     = 'Story Case Density';

$lang->reporttemplate->measurementList['bug']['total']     = 'Bug Number';
$lang->reporttemplate->measurementList['bug']['effective'] = 'Valid Bug Number';
$lang->reporttemplate->measurementList['bug']['useCase']   = 'The number of bugs generated by executing cases';
$lang->reporttemplate->measurementList['bug']['fixed']     = 'Fixed Bug Number';

$lang->reporttemplate->measurementList['testcase']['caseNum'] = 'Case Number';

$lang->reporttemplate->measurementList['weekly']['term']  = 'Report Term';
$lang->reporttemplate->measurementList['weekly']['staff'] = 'Staff Number';

$lang->reporttemplate->chartList['project']['basicStatistic']['gantt']    = 'Gantt';
$lang->reporttemplate->chartList['project']['basicStatistic']['workload'] = "{$lang->projectCommon} Plan Workload Statistic";

$lang->reporttemplate->chartList['project']['progress']['summary'] = "{$lang->projectCommon} Progress Summary";

$lang->reporttemplate->chartList['execution']['basicStatistic']['closedRate']    = "{$lang->execution->common} Closed Rate";
$lang->reporttemplate->chartList['execution']['basicStatistic']['delayRate']     = "{$lang->execution->common} Delayed Rate";
$lang->reporttemplate->chartList['execution']['basicStatistic']['statusMap']     = "{$lang->execution->common} status distribution";
$lang->reporttemplate->chartList['execution']['basicStatistic']['doingSummary']  = "In progress {$lang->execution->common} summary table";
$lang->reporttemplate->chartList['execution']['basicStatistic']['closedSummary'] = "Closed {$lang->execution->common} summary table";

$lang->reporttemplate->chartList['task']['basicStatistic']['doneRate']   = 'Task completion rate';
$lang->reporttemplate->chartList['task']['basicStatistic']['taskRate']   = 'Task progress';
$lang->reporttemplate->chartList['task']['basicStatistic']['statusMap']  = 'Task status distribution';
$lang->reporttemplate->chartList['task']['basicStatistic']['assignMap']  = 'Task assign distribution';
$lang->reporttemplate->chartList['task']['basicStatistic']['ownerMap']   = 'Task owner distribution';
$lang->reporttemplate->chartList['task']['basicStatistic']['moduleMap']  = 'Task first level module distribution';
$lang->reporttemplate->chartList['task']['basicStatistic']['typeMap']    = 'Task type distribution';
$lang->reporttemplate->chartList['task']['basicStatistic']['priMap']     = 'Task priority distribution';
$lang->reporttemplate->chartList['task']['basicStatistic']['reasonMap']  = 'Task close reason distribution';
$lang->reporttemplate->chartList['task']['basicStatistic']['devRate']    = 'Development Task Completion Rate';
$lang->reporttemplate->chartList['task']['basicStatistic']['testRate']   = 'Testing Task Completion Rate';
$lang->reporttemplate->chartList['task']['basicStatistic']['finished']   = 'Finished Tasks';
$lang->reporttemplate->chartList['task']['basicStatistic']['unfinished'] = 'Unfinished Tasks';
$lang->reporttemplate->chartList['task']['basicStatistic']['workplan']   = 'Work Plan';

$lang->reporttemplate->chartList['task']['progress']['typeHour']   = 'Different type tasks progress statistics table';
$lang->reporttemplate->chartList['task']['progress']['statusData'] = 'Different type tasks status statistics table';
$lang->reporttemplate->chartList['task']['progress']['dailyNum']   = 'Bar chart of daily completed tasks (Nearly 14 days)';

$lang->reporttemplate->chartList['task']['resource']['bugRate']           = 'Bug to task rate';
$lang->reporttemplate->chartList['task']['resource']['bugConsumeRate']    = 'Bug to task consume rate';
$lang->reporttemplate->chartList['task']['resource']['userEfforts']       = 'Team effort distribution';
$lang->reporttemplate->chartList['task']['resource']['teamEfforts']       = 'Detailed team effort distribution';
$lang->reporttemplate->chartList['task']['resource']['workAssignSummary'] = 'Task assign summary';
$lang->reporttemplate->chartList['task']['resource']['workSummary']       = 'Task summary';

$lang->reporttemplate->chartList['story']['basicStatistic']['statusMap']   = 'Status Map';
$lang->reporttemplate->chartList['story']['basicStatistic']['stageMap']    = 'Stage Map';
$lang->reporttemplate->chartList['story']['basicStatistic']['productMap']  = "{$lang->productCommon} Product Module Map";
$lang->reporttemplate->chartList['story']['basicStatistic']['sourceMap']   = 'Source Map';
$lang->reporttemplate->chartList['story']['basicStatistic']['priMap']      = 'Pri Map';
$lang->reporttemplate->chartList['story']['basicStatistic']['categoryMap'] = 'Category Map';
$lang->reporttemplate->chartList['story']['basicStatistic']['userMap']     = 'Creator Map';

$lang->reporttemplate->chartList['story']['progress']['devRate']       = 'Development Completion Rate of Stories by Item';
$lang->reporttemplate->chartList['story']['progress']['devScaleRate']  = 'Development Completion Rate of Stories by Scale';
$lang->reporttemplate->chartList['story']['progress']['testRate']      = 'Testing Completion Rate of Stories by Item';
$lang->reporttemplate->chartList['story']['progress']['testScaleRate'] = 'Testing Completion Rate of Stories by Scale';
$lang->reporttemplate->chartList['story']['progress']['doneRate']      = 'Completion Rate of Stories by Item';
$lang->reporttemplate->chartList['story']['progress']['doneScaleRate'] = 'Completion Rate of Stories by Scale';

$lang->reporttemplate->chartList['bug']['basicStatistic']['efficientRate'] = 'Bug Efficiency';
$lang->reporttemplate->chartList['bug']['basicStatistic']['fixedRate']     = 'Bug Fix Rate';
$lang->reporttemplate->chartList['bug']['basicStatistic']['caseBugRate']   = 'Proportion of Bugs from Cases';
$lang->reporttemplate->chartList['bug']['basicStatistic']['statusMap']     = 'Bug status distribution';
$lang->reporttemplate->chartList['bug']['basicStatistic']['productMap']    = "Bug From {$lang->productCommon} Module Distribution";
$lang->reporttemplate->chartList['bug']['basicStatistic']['severityMap']   = 'Bug Severity Distribution';
$lang->reporttemplate->chartList['bug']['basicStatistic']['priMap']        = 'Bug Priority Distribution';
$lang->reporttemplate->chartList['bug']['basicStatistic']['resolutionMap'] = 'Bug Solution Distribution';
$lang->reporttemplate->chartList['bug']['basicStatistic']['typeMap']       = 'Bug Type Distribution';

$lang->reporttemplate->chartList['bug']['fixedProgress']['dailyNum']         = 'Daily New, Resolved, Closed Bugs';
$lang->reporttemplate->chartList['bug']['fixedProgress']['userCreatedBugs']  = 'Number of Bugs Created by Team Members';
$lang->reporttemplate->chartList['bug']['fixedProgress']['userResolvedBugs'] = 'Number of Bugs Resolved by Team Members';

$lang->reporttemplate->chartList['testcase']['basicStatistic']['userCreatedCases']  = 'Number of Cases Created by Team Members';
$lang->reporttemplate->chartList['testcase']['basicStatistic']['userExecutedCases'] = 'Number of Cases Executed by Team Members';
$lang->reporttemplate->chartList['testcase']['basicStatistic']['productMap']        = "Case From {$lang->productCommon} Module Distribution";
$lang->reporttemplate->chartList['testcase']['basicStatistic']['statusMap']         = 'Case Status Distribution';
$lang->reporttemplate->chartList['testcase']['basicStatistic']['priMap']            = 'Case Priority Distribution';
$lang->reporttemplate->chartList['testcase']['basicStatistic']['resultMap']         = 'Case Result Distribution';
$lang->reporttemplate->chartList['testcase']['basicStatistic']['typeMap']           = 'Case Type Distribution';
