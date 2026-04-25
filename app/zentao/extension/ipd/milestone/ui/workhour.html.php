<?php
namespace zin;
$buildWorkhour = function() use($workhours, $lang)
{
    $count = $workhours['count'];
    unset($workhours['count']);
    $thead = h::thead
    (
        h::tr
        (
            h::th(set::rowspan(2), $lang->milestone->workHours),
            h::th(setClass('text-center'), set::colspan(count($workhours)), $lang->milestone->allStage),
            h::th(setClass('text-center'), set::rowspan(2), $lang->milestone->colSummary),
            h::th(setClass('text-center'), set::rowspan(2), $lang->milestone->colPercent)
        ),
        h::tr
        (
            array_map(function($stage){ return h::th(set::title($stage['name']), $stage['name']); }, $workhours)
        )
    );
    $tbody = h::tbody(h::tr
    (
        h::th($lang->milestone->devHours),
        array_map(function($stage){ return h::td($stage['dev']); }, $workhours),
        h::td(setClass('text-center'), $count['dev']),
        h::td(setClass('text-center'), $count['total'] == '0' ? '0%' : round($count['dev'] / $count['total'], 2) * 100 . '%')
    ), h::tr
    (
        h::th($lang->milestone->toHours, icon('help', setClass('ml-1'), set::title($lang->milestone->toHoursTip))),
        array_map(function($stage){ return h::td($stage['to']); }, $workhours),
        h::td(setClass('text-center'), $count['to']),
        h::td(setClass('text-center'), $count['total'] == '0' ? '0%' : round($count['to'] / $count['total'], 2) * 100 . '%')
    ), h::tr
    (
        h::th($lang->milestone->reviewHours, icon('help', setClass('ml-1'), set::title($lang->milestone->reviewHoursTip))),
        array_map(function($stage){ return h::td($stage['review']); }, $workhours),
        h::td(setClass('text-center'), $count['review']),
        h::td(setClass('text-center'), $count['total'] == '0' ? '0%' : round($count['review'] / $count['total'], 2) * 100 . '%')
    ), h::tr
    (
        h::th($lang->milestone->qaHours),
        array_map(function($stage){ return h::td($stage['qa']); }, $workhours),
        h::td(setClass('text-center'), $count['qa']),
        h::td(setClass('text-center'), $count['total'] == '0' ? '0%' : round($count['qa'] / $count['total'], 2) * 100 . '%')
    ), h::tr
    (
        h::th($lang->milestone->rowSummary),
        array_map(function($stage){ return h::td($stage['count']); }, $workhours),
        h::td(setClass('text-center'), $count['total']),
        h::td(setClass('text-center'), $count['total'] == '0' ? '0%' : '100%')
    ), h::tr
    (
        h::th($lang->milestone->rowPercent),
        array_map(function($stage) use($count){ return h::td($count['total'] == '0' ? '0%' : round($stage['count'] / $count['total'] * 100, 2) . '%'); }, $workhours),
        h::td(setClass('text-center'), '100%'),
        h::td(setClass('text-center'), '100%')
    ), h::tr
    (
        h::th($lang->milestone->qatoDev),
        array_map(function($stage){ return h::td($stage['qaToDev']); }, $workhours),
        h::td(),
        h::td()
    ));

    $chartOptions = array();
    $chartOptions['title'] = array('text' => $lang->milestone->chart->workhour, 'textStyle' => array('fontSize' => 14));
    $chartOptions['grid']  = array('left' => '3%', 'bottom' => '10%');
    $chartOptions['xAxis'] = array('type' => 'category', 'data' => array_column($workhours, 'name'));

    $chartOptions['yAxis']['type']      = 'value';
    $chartOptions['yAxis']['name']      = "({$lang->execution->workHour})";
    $chartOptions['yAxis']['axisLine']  =  array('show' => true);
    $chartOptions['tooltip']['trigger'] = 'axis';

    $chartOptions['series'][] = array('type' => 'bar', 'data' => array_values(array_map(function($stage) use($count){ return $count['total'] == '0' ? 0 : round($stage['count'] / $count['total'] * 100, 2); }, $workhours)));

    return div
    (
        h::table(setClass('table bordered bg-white mb-4'), $thead, $tbody),
        div(setClass('bg-white mb-4'), echarts(set($chartOptions), set::width('100%'), set::height(300)))
    );
};