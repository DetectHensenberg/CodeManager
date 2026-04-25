<?php
namespace zin;

$buildChart = function() use($lang, $charts)
{
    $chartOptions = array();
    $chartOptions['legend'] = array('top' => 0, 'right' => 0, 'data' => array('PV', 'EV', 'AC'));
    $chartOptions['xAxis']  = array('type' => 'category', 'data' => zget($charts, 'labels', array()));
    $chartOptions['grid']   = array('left' => '3%');

    $chartOptions['yAxis']['type']     = 'value';
    $chartOptions['yAxis']['name']     = "({$lang->execution->workHour})";
    $chartOptions['yAxis']['axisLine'] =  array('show' => true);

    $chartOptions['tooltip']['trigger']     = 'axis';
    $chartOptions['tooltip']['axisPointer'] = array('label' => array('formatter' => "{value} {$lang->execution->workHour} /h"));

    $chartOptions['series'][] = array('name' => 'PV', 'type' => 'line', 'data' => json_decode(str_replace(',]', ']', zget($charts, 'PV', '[]'))));
    $chartOptions['series'][] = array('name' => 'EV', 'type' => 'line', 'data' => json_decode(str_replace(',]', ']', zget($charts, 'EV', '[]'))));
    $chartOptions['series'][] = array('name' => 'AC', 'type' => 'line', 'data' => json_decode(str_replace(',]', ']', zget($charts, 'AC', '[]'))));

    return div
    (
        setID('milestoneChart'),
        setClass('milestone-chart bg-white mb-4'),
        echarts(set($chartOptions), set::width('100%'), set::height(300))
    );
};
