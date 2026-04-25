<?php
namespace zin;

$buildProjectRisk = function() use ($executionRisk, $lang)
{
    $totalRisk = count($executionRisk);
    $firstRisk = array_shift($executionRisk);
    $firstTR   = $firstRisk ? h::tr
    (
        h::th(set::rowspan($totalRisk), $lang->milestone->riskAccumulate),
        h::td($firstRisk->name),
        h::td($firstRisk->impact),
        h::td($firstRisk->probability),
        h::td($firstRisk->rate),
        h::td($firstRisk->prevention)
    ) : null;

    $trListHtml = array_map(function($risk) { return "<tr><td>{$risk->name}</td><td>{$risk->impact}</td><td>{$risk->probability}</td><td>{$risk->rate}</td><td>{$risk->prevention}</td></tr>"; }, $executionRisk);
    return h::table
    (
        setClass('table bordered bg-white mb-4 text-left'),
        h::thead
        (
            h::tr(h::th(set::colspan(6), $lang->milestone->executionRisk)),
            h::tr
            (
                h::th($lang->milestone->riskCountermove),
                h::th($lang->milestone->riskDescriptio),
                h::th($lang->milestone->riskPossibility),
                h::th($lang->milestone->riskSeriousness),
                h::th($lang->milestone->riskFactor),
                h::th($lang->milestone->riskMeasures)
            )
        ),
        h::tbody
        (
            $firstTR,
            html(implode($trListHtml))
        )
    );
};