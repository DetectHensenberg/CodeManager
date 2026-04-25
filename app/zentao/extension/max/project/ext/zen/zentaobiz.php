<?php
/**
 * 获取基本统计数据。
 * Get basic metrics.
 *
 * @param  array  $executions
 * @param  object $project
 * @access public
 * @return object
 */
public function getExecutionBasicMetrics($executions, $project)
{
    $countItems = array('total', 'doingNum', 'closedNum', 'delayNum', 'closedRate', 'delayRate');
    $chartItems = array('statusMap');
    $tableItems = array('doingSummary', 'closedSummary');

    $metricsCount = $this->project->getMetricsCount($executions, $countItems);
    $metricsChart = $this->project->getMetricsChart($executions, $chartItems);
    $metricsTable = $this->project->getMetricsTable($executions, $project, $tableItems);

    $statistics = new stdclass();
    foreach($countItems as $item) $statistics->{$item} = $metricsCount->{$item};
    foreach($chartItems as $item) $statistics->{$item} = $metricsChart->{$item};
    foreach($tableItems as $item) $statistics->{$item} = $metricsTable->{$item};
    return $statistics;
}

/**
 * 构建执行的基本统计配置。
 * Build chart config.
 *
 * @param  array  $bugs
 * @param  object $execution
 * @access public
 * @return array
 * @param mixed[] $executions
 * @param object $project
 */
public function buildBasicExecutionConfig($executions, $project)
{
    $this->loadModel('report');
    $settings = array();
    $metrics  = $this->getExecutionBasicMetrics($executions, $project);
    $xAxis    = $this->config->report->reportChart->xAxis;
    $yAxis    = 80;
    $name     = in_array($project->model, array('waterfall', 'waterfallplus', 'ipd')) ? $this->lang->stage->common : $this->lang->project->reportSettings->execution;
    $width    = $this->config->report->reportChart->oneQuarter;
    foreach(array('total', 'doingNum', 'closedNum', 'delayNum') as $index => $field)
    {
        $fieldName = sprintf($this->lang->project->reportSettings->$field, $name);
        $settings  = array_merge($settings, $this->report->buildTextChartConfig($metrics->$field, $fieldName, $xAxis, $yAxis, $index, $width));
    }

    $yAxis += $this->config->report->reportChart->textHeight + $this->config->report->reportChart->padding * 8;
    $xAxis  = 0;
    foreach(array('closedRate', 'delayRate') as $index => $field)
    {
        $fieldName = str_replace('%s', $name, $this->lang->project->reportSettings->$field);
        $fieldTips = str_replace('%s', $name, $this->lang->project->reportSettings->tips->$field);
        $settings  = array_merge($settings, $this->report->buildWaterChartConfig($fieldName, $metrics->$field,  $xAxis, $yAxis, $index, $fieldTips, 2));
    }

    $yAxis      += $this->config->report->reportChart->waterHeight + $this->config->report->reportChart->padding * 9;
    $xAxis       = 0;
    $statusTitle = sprintf($this->lang->project->reportSettings->statusMap, $name);
    $settings    = array_merge($settings, $this->report->buildBarChartConfig($statusTitle, $metrics->statusMap, $yAxis));

    $yAxis -= $this->config->report->reportChart->padding * 4.6;
    foreach(array('doingSummary', 'closedSummary') as $type)
    {
        $yAxis   += $this->config->report->reportChart->barHeight + $this->config->report->reportChart->padding * 9;
        $title    = sprintf($this->lang->project->reportSettings->$type, $name);
        $tips     = str_replace('%s', $name, $this->lang->project->reportSettings->tips->$type);
        $settings = array_merge($settings, $this->report->buildTableChartConfig($title, $metrics->{$type}->headers, $metrics->{$type}->dataset, $yAxis, 0, array(), '', $tips));
    }

    return $settings;
}

/**
 * Append extras data to post data.
 *
 * @param  object       $postData
 * @param  int          $copyProjectID
 * @access protected
 * @return object|false
 */
public function prepareCreateExtras($postData, $copyProjectID = 0)
{
    $project = parent::prepareCreateExtras($postData, $copyProjectID);
    if(!empty($project->workflowGroup))
    {
        $projectType = $this->dao->select('projectType')->from(TABLE_WORKFLOWGROUP)->where('id')->eq($project->workflowGroup)->fetch('projectType');
        $project->hasProduct = strpos(',product,ipd,tpd,cbb,cpdproduct,', ",$projectType,") !== false ? '1' : '0';
        if($project->model == 'ipd') $project->category = strpos(',cpdproduct,cpdproject,', ",$projectType,") !== false ? 'CPD' : strtoupper($projectType);
    }
    return $project;
}

/**
 * Validate $postData and prepare $project for update.
 *
 * @param  object       $postData
 * @param  int          $hasProduct
 * @access protected
 * @return object|false
 */
protected function prepareProject($postData, $hasProduct)
{
    $project = parent::prepareProject($postData, $hasProduct);
    if(!empty($project->workflowGroup))
    {
        $projectType = $this->dao->select('projectType')->from(TABLE_WORKFLOWGROUP)->where('id')->eq($project->workflowGroup)->fetch('projectType');
        $project->hasProduct = strpos(',product,ipd,tpd,cbb,cpdproduct,', ",$projectType,") !== false ? '1' : '0';
        if($project->model == 'ipd') $project->category = strpos(',cpdproduct,cpdproject,', ",$projectType,") !== false ? 'CPD' : strtoupper($projectType);
    }
    return $project;
}
