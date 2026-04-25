<?php
namespace zin;
$buildProgress = function() use($process, $nextMilestone, $lang)
{
    $thead = h::thead
    (
        h::tr
        (
            h::th(set::rowspan(2), $lang->milestone->paogressForecast),
            h::th(setClass('text-center'), set::colspan(3), $lang->milestone->duration),
            h::th(setClass('text-center'), set::colspan(3), $lang->milestone->cost),
            h::th(set::rowspan(2), set::colspan(3), $lang->milestone->forecastResults)
        ),
        h::tr
        (
            h::th($lang->milestone->plannedValue),
            h::th($lang->milestone->predictedValue, icon('help', setClass('ml-1'), set::title($lang->milestone->predictedValueDesc))),
            h::th($lang->milestone->periodDeviation),
            h::th($lang->milestone->plannedValue),
            h::th($lang->milestone->predictedValue),
            h::th($lang->milestone->costDeviation)
        )
    );

    $nextDuration      = empty($process->milestoneSPI) || empty($nextMilestone->nextDays) ? 0 : round($nextMilestone->nextDays / $process->milestoneSPI, 2);
    $nextDurationValue = $nextMilestone->nextDays - $nextDuration;
    $nextCost          = empty($process->nowCPI) || empty($nextMilestone->nextHours) ? 0 : round($nextMilestone->nextHours/$process->milestoneCPI);
    $nextCostValue     = $nextMilestone->nextHours - $nextCost;
    $resultText        = $nextDurationValue < 0 ? sprintf($lang->milestone->timeOverrun, abs($nextDurationValue)) : '';
    $resultText       .= $nextCostValue     < 0 ? sprintf($lang->milestone->costOverrun, abs($nextCostValue))     : '';
    $trList   = array();
    $trList[] = h::tr
    (
        h::th($lang->milestone->nextStage),
        h::td($nextMilestone->nextDays),
        h::td($nextDuration),
        h::td($nextDurationValue),
        h::td($nextMilestone->nextHours),
        h::td($nextCost),
        h::td($nextCostValue),
        h::td(set::colspan(3), $resultText)
    );

    $totalDuration      = empty($process->milestoneSPI) || empty($nextMilestone->totalDays) ? 0 : round($nextMilestone->totalDays / $process->milestoneSPI, 2);
    $totalDurationValue = $nextMilestone->totalDays - $totalDuration;
    $totalCost          = empty($process->nowCPI) || empty($nextMilestone->totalHours) ? 0 : round($nextMilestone->totalHours/$process->nowCPI, 2);
    $totalCostValue     = $nextMilestone->totalHours - $totalCost;
    $resultText         =  $totalDurationValue < 0 ? sprintf($lang->milestone->timeOverrun, abs($totalDurationValue)) : '';
    $resultText        .=  $totalCostValue     < 0 ? sprintf($lang->milestone->costOverrun, abs($totalCostValue))     : '';
    $trList[] = h::tr
    (
        h::th($lang->milestone->overallProject),
        h::td($nextMilestone->totalDays),
        h::td($totalDuration),
        h::td($totalDurationValue),
        h::td($nextMilestone->totalHours),
        h::td($totalCost),
        h::td($totalCostValue),
        h::td(set::colspan(3), $resultText)
    );
    $tbody = h::tbody($trList);

    return h::table(setClass('table bordered bg-white mb-4'), $thead, $tbody);
};