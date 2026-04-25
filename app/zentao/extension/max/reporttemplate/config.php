<?php
$config->reporttemplate = new stdclass();

$config->reporttemplate->zentaoList = array();

$config->reporttemplate->create = new stdclass();
$config->reporttemplate->edit   = new stdclass();
$config->reporttemplate->create->requiredFields = 'title,lib,module';
$config->reporttemplate->edit->requiredFields   = 'title,lib,module';

$config->reporttemplate->skipProjectFields      = ',type,lifetime,pri,PO,QD,RD,canceledBy,canceledDate,planDuration,realDuration,displayCards,fluidBoard,deleted,';
$config->reporttemplate->builtinProperties      = ',id,budget,name,code,begin,end,realBegan,realEnd,days,desc,openedDate,lastEditedDate,closedDate,suspendedDate,';
$config->reporttemplate->userProperties         = ',openedBy,lastEditedBy,closedBy,canceledBy,PM,';
$config->reporttemplate->multipleUserProperties = ',whitelist,';

$config->reporttemplate->weeklyChart['weekly_term']['dateperiods']                    = array('$yesterday', '$today', '$lastWeek', '$thisWeek', '$lastMonth', '$thisMonth');
$config->reporttemplate->weeklyChart['weekly_staff']['dateperiods']                   = array('$yesterday', '$today', '$lastWeek', '$thisWeek', '$lastMonth', '$thisMonth');
$config->reporttemplate->weeklyChart['project_progress_summary']['dateperiods']       = array('$yesterday', '$today', '$lastWeek', '$thisWeek', '$lastMonth', '$thisMonth');
$config->reporttemplate->weeklyChart['task_basicStatistic_finished']['dateperiods']   = array('$yesterday', '$today', '$lastWeek', '$thisWeek', '$lastMonth', '$thisMonth');
$config->reporttemplate->weeklyChart['task_basicStatistic_unfinished']['dateperiods'] = array('$thisWeek', '$thisMonth');
$config->reporttemplate->weeklyChart['task_basicStatistic_workplan']['dateperiods']   = array('$nextWeek', '$nextMonth');

$config->reporttemplate->propertyMap['auth'] = 'sortAuthList';
$config->reporttemplate->propertyMap['acl']  = 'shortAclList';

$config->reporttemplate->measuremenuConditions['task']['picker']         = array('status', 'pri', 'type', 'closedReason');
$config->reporttemplate->measuremenuConditions['task']['datepicker']     = array('openedDate', 'estStarted', 'deadline', 'realStarted', 'finishedDate', 'closedDate');
$config->reporttemplate->measuremenuConditions['story']['picker']        = array('status', 'stage', 'pri');
$config->reporttemplate->measuremenuConditions['story']['datepicker']    = array('openedDate', 'closedDate');
$config->reporttemplate->measuremenuConditions['bug']['picker']          = array('status', 'severity', 'pri', 'type');
$config->reporttemplate->measuremenuConditions['bug']['datepicker']      = array('openedDate', 'resolvedDate', 'closedDate', 'deadline');
$config->reporttemplate->measuremenuConditions['testcase']['picker']     = array('status', 'pri', 'lastRunResult');
$config->reporttemplate->measuremenuConditions['testcase']['datepicker'] = array('lastRunDate', 'openedDate', 'lastEditedDate');
$config->reporttemplate->measuremenuConditions['weekly']['picker']       = array();
$config->reporttemplate->measuremenuConditions['weekly']['datepicker']   = array('date');
$config->reporttemplate->measuremenuConditions['project']['datepicker']  = array('date');

$config->reporttemplate->getTableColsMethod['HLDS']       = 'getDesignTableCols';
$config->reporttemplate->getTableColsMethod['DDS']        = 'getDesignTableCols';
$config->reporttemplate->getTableColsMethod['DBDS']       = 'getDesignTableCols';
$config->reporttemplate->getTableColsMethod['ADS']        = 'getDesignTableCols';
$config->reporttemplate->getTableColsMethod['projectBug'] = 'getBugTableCols';

$config->reporttemplate->getTableDataMethod['HLDS']       = 'getDesignTableData';
$config->reporttemplate->getTableDataMethod['DDS']        = 'getDesignTableData';
$config->reporttemplate->getTableDataMethod['DBDS']       = 'getDesignTableData';
$config->reporttemplate->getTableDataMethod['ADS']        = 'getDesignTableData';
$config->reporttemplate->getTableDataMethod['projectBug'] = 'getBugTableData';

$config->reporttemplate->getChartOptions['project']['workload'] = array('method' => '', 'chartType' => 'table');
$config->reporttemplate->getChartOptions['project']['summary']  = array('method' => '', 'chartType' => 'table');

$config->reporttemplate->getChartOptions['execution']['closedRate']    = array('method' => 'getWaterEchartsOptions', 'chartType' => 'waterpolo');
$config->reporttemplate->getChartOptions['execution']['delayRate']     = array('method' => 'getWaterEchartsOptions', 'chartType' => 'waterpolo');
$config->reporttemplate->getChartOptions['execution']['statusMap']     = array('method' => 'getBarEchartsOptions',   'chartType' => 'bar');
$config->reporttemplate->getChartOptions['execution']['doingSummary']  = array('method' => '',                       'chartType' => 'table');
$config->reporttemplate->getChartOptions['execution']['closedSummary'] = array('method' => '',                       'chartType' => 'table');

$config->reporttemplate->getChartOptions['task']['doneRate']   = array('method' => 'getWaterEchartsOptions', 'chartType' => 'waterpolo');
$config->reporttemplate->getChartOptions['task']['taskRate']   = array('method' => 'getWaterEchartsOptions', 'chartType' => 'waterpolo');
$config->reporttemplate->getChartOptions['task']['statusMap']  = array('method' => 'getBarEchartsOptions',   'chartType' => 'bar');
$config->reporttemplate->getChartOptions['task']['assignMap']  = array('method' => 'getPieEchartsOptions',   'chartType' => 'pie');
$config->reporttemplate->getChartOptions['task']['ownerMap']   = array('method' => 'getPieEchartsOptions',   'chartType' => 'pie');
$config->reporttemplate->getChartOptions['task']['moduleMap']  = array('method' => 'getPieEchartsOptions',   'chartType' => 'pie');
$config->reporttemplate->getChartOptions['task']['typeMap']    = array('method' => 'getPieEchartsOptions',   'chartType' => 'pie');
$config->reporttemplate->getChartOptions['task']['priMap']     = array('method' => 'getPieEchartsOptions',   'chartType' => 'pie');
$config->reporttemplate->getChartOptions['task']['reasonMap']  = array('method' => 'getPieEchartsOptions',   'chartType' => 'pie');
$config->reporttemplate->getChartOptions['task']['devRate']    = array('method' => 'getWaterEchartsOptions', 'chartType' => 'waterpolo');
$config->reporttemplate->getChartOptions['task']['testRate']   = array('method' => 'getWaterEchartsOptions', 'chartType' => 'waterpolo');
$config->reporttemplate->getChartOptions['task']['finished']   = array('method' => '',                       'chartType' => 'table');
$config->reporttemplate->getChartOptions['task']['unfinished'] = array('method' => '',                       'chartType' => 'table');
$config->reporttemplate->getChartOptions['task']['workplan']   = array('method' => '',                       'chartType' => 'table');

$config->reporttemplate->getChartOptions['task']['typeHour']   = array('method' => '',                     'chartType' => 'table');
$config->reporttemplate->getChartOptions['task']['statusData'] = array('method' => '',                     'chartType' => 'table');
$config->reporttemplate->getChartOptions['task']['dailyNum']   = array('method' => 'getBarEchartsOptions', 'chartType' => 'bar');

$config->reporttemplate->getChartOptions['task']['bugRate']           = array('method' => 'getWaterEchartsOptions', 'chartType' => 'waterpolo');
$config->reporttemplate->getChartOptions['task']['bugConsumeRate']    = array('method' => 'getWaterEchartsOptions', 'chartType' => 'waterpolo');
$config->reporttemplate->getChartOptions['task']['userEfforts']       = array('method' => 'getBarYEchartsOptions',  'chartType' => 'bar');
$config->reporttemplate->getChartOptions['task']['teamEfforts']       = array('method' => '',                       'chartType' => 'table');
$config->reporttemplate->getChartOptions['task']['workAssignSummary'] = array('method' => '',                       'chartType' => 'table');
$config->reporttemplate->getChartOptions['task']['workSummary']       = array('method' => '',                       'chartType' => 'table');

$config->reporttemplate->getChartOptions['story']['statusMap']     = array('method' => 'getBarEchartsOptions',      'chartType' => 'bar');
$config->reporttemplate->getChartOptions['story']['stageMap']      = array('method' => 'getBarEchartsOptions',      'chartType' => 'bar');
$config->reporttemplate->getChartOptions['story']['productMap']    = array('method' => 'getSunburstEchartsOptions', 'chartType' => 'sunburst');
$config->reporttemplate->getChartOptions['story']['sourceMap']     = array('method' => 'getPieEchartsOptions',      'chartType' => 'pie');
$config->reporttemplate->getChartOptions['story']['priMap']        = array('method' => 'getPieEchartsOptions',      'chartType' => 'pie');
$config->reporttemplate->getChartOptions['story']['categoryMap']   = array('method' => 'getPieEchartsOptions',      'chartType' => 'pie');
$config->reporttemplate->getChartOptions['story']['userMap']       = array('method' => 'getPieEchartsOptions',      'chartType' => 'pie');
$config->reporttemplate->getChartOptions['story']['devRate']       = array('method' => 'getWaterEchartsOptions',    'chartType' => 'waterpolo');
$config->reporttemplate->getChartOptions['story']['testRate']      = array('method' => 'getWaterEchartsOptions',    'chartType' => 'waterpolo');
$config->reporttemplate->getChartOptions['story']['doneRate']      = array('method' => 'getWaterEchartsOptions',    'chartType' => 'waterpolo');
$config->reporttemplate->getChartOptions['story']['devScaleRate']  = array('method' => 'getWaterEchartsOptions',    'chartType' => 'waterpolo');
$config->reporttemplate->getChartOptions['story']['testScaleRate'] = array('method' => 'getWaterEchartsOptions',    'chartType' => 'waterpolo');
$config->reporttemplate->getChartOptions['story']['doneScaleRate'] = array('method' => 'getWaterEchartsOptions',    'chartType' => 'waterpolo');

$config->reporttemplate->getChartOptions['bug']['efficientRate']    = array('method' => 'getWaterEchartsOptions',    'chartType' => 'waterpolo');
$config->reporttemplate->getChartOptions['bug']['fixedRate']        = array('method' => 'getWaterEchartsOptions',    'chartType' => 'waterpolo');
$config->reporttemplate->getChartOptions['bug']['caseBugRate']      = array('method' => 'getWaterEchartsOptions',    'chartType' => 'waterpolo');
$config->reporttemplate->getChartOptions['bug']['statusMap']        = array('method' => 'getBarEchartsOptions',      'chartType' => 'bar');
$config->reporttemplate->getChartOptions['bug']['productMap']       = array('method' => 'getSunburstEchartsOptions', 'chartType' => 'sunburst');
$config->reporttemplate->getChartOptions['bug']['severityMap']      = array('method' => 'getPieEchartsOptions',      'chartType' => 'pie');
$config->reporttemplate->getChartOptions['bug']['priMap']           = array('method' => 'getPieEchartsOptions',      'chartType' => 'pie');
$config->reporttemplate->getChartOptions['bug']['resolutionMap']    = array('method' => 'getPieEchartsOptions',      'chartType' => 'pie');
$config->reporttemplate->getChartOptions['bug']['typeMap']          = array('method' => 'getPieEchartsOptions',      'chartType' => 'pie');
$config->reporttemplate->getChartOptions['bug']['dailyNum']         = array('method' => 'getLineEchartsOptions',     'chartType' => 'line');
$config->reporttemplate->getChartOptions['bug']['userCreatedBugs']  = array('method' => 'getBarYEchartsOptions',     'chartType' => 'bar');
$config->reporttemplate->getChartOptions['bug']['userResolvedBugs'] = array('method' => 'getBarYEchartsOptions',     'chartType' => 'bar');

$config->reporttemplate->getChartOptions['testcase']['userCreatedCases']  = array('method' => 'getBarYEchartsOptions',     'chartType' => 'bar');
$config->reporttemplate->getChartOptions['testcase']['userExecutedCases'] = array('method' => 'getBarYEchartsOptions',     'chartType' => 'bar');
$config->reporttemplate->getChartOptions['testcase']['productMap']        = array('method' => 'getSunburstEchartsOptions', 'chartType' => 'sunburst');
$config->reporttemplate->getChartOptions['testcase']['statusMap']         = array('method' => 'getPieEchartsOptions',      'chartType' => 'pie');
$config->reporttemplate->getChartOptions['testcase']['priMap']            = array('method' => 'getPieEchartsOptions',      'chartType' => 'pie');
$config->reporttemplate->getChartOptions['testcase']['resultMap']         = array('method' => 'getPieEchartsOptions',      'chartType' => 'pie');
$config->reporttemplate->getChartOptions['testcase']['typeMap']           = array('method' => 'getPieEchartsOptions',      'chartType' => 'pie');

global $lang, $app;
$app->loadLang('task');
$config->reporttemplate->weeklyTableHeader = array();
$config->reporttemplate->weeklyTableHeader['finished'][] = array('field' => 'id',          'name' => 'id',          'label' => $lang->idAB);
$config->reporttemplate->weeklyTableHeader['finished'][] = array('field' => 'name',        'name' => 'name',        'label' => $lang->task->name);
$config->reporttemplate->weeklyTableHeader['finished'][] = array('field' => 'estStarted',  'name' => 'estStarted',  'label' => $lang->task->estStarted);
$config->reporttemplate->weeklyTableHeader['finished'][] = array('field' => 'deadline',    'name' => 'deadline',    'label' => $lang->task->deadline);
$config->reporttemplate->weeklyTableHeader['finished'][] = array('field' => 'realStarted', 'name' => 'realStarted', 'label' => $lang->task->realStarted);
$config->reporttemplate->weeklyTableHeader['finished'][] = array('field' => 'finishedBy',  'name' => 'finishedBy',  'label' => $lang->task->finishedBy);

$config->reporttemplate->weeklyTableHeader['unfinished'][] = array('field' => 'id',          'name' => 'id',          'label' => $lang->idAB);
$config->reporttemplate->weeklyTableHeader['unfinished'][] = array('field' => 'name',        'name' => 'name',        'label' => $lang->task->name);
$config->reporttemplate->weeklyTableHeader['unfinished'][] = array('field' => 'assignedTo',  'name' => 'assignedTo',  'label' => $lang->task->assignedTo);
$config->reporttemplate->weeklyTableHeader['unfinished'][] = array('field' => 'estStarted',  'name' => 'estStarted',  'label' => $lang->task->estStarted);
$config->reporttemplate->weeklyTableHeader['unfinished'][] = array('field' => 'deadline',    'name' => 'deadline',    'label' => $lang->task->deadline);
$config->reporttemplate->weeklyTableHeader['unfinished'][] = array('field' => 'realStarted', 'name' => 'realStarted', 'label' => $lang->task->realStarted);
$config->reporttemplate->weeklyTableHeader['unfinished'][] = array('field' => 'progress',    'name' => 'progress',    'label' => $lang->task->progress);

$config->reporttemplate->weeklyTableHeader['workplan'][] = array('field' => 'id',         'name' => 'id',         'label' => $lang->idAB);
$config->reporttemplate->weeklyTableHeader['workplan'][] = array('field' => 'name',       'name' => 'name',       'label' => $lang->task->name);
$config->reporttemplate->weeklyTableHeader['workplan'][] = array('field' => 'assignedTo', 'name' => 'assignedTo', 'label' => $lang->task->assignedTo);
$config->reporttemplate->weeklyTableHeader['workplan'][] = array('field' => 'estStarted', 'name' => 'estStarted', 'label' => $lang->task->estStarted);
$config->reporttemplate->weeklyTableHeader['workplan'][] = array('field' => 'deadline',   'name' => 'deadline',   'label' => $lang->task->deadline);
