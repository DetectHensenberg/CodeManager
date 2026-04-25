<?php
namespace zin;

$buildBasicInfo = function() use($basicInfo, $users, $lang)
{
    return h::table
    (
        setClass('table bordered basicInfo bg-white mb-4 text-left'),
        h::tr
        (
            h::th(set::rowspan(3), setClass('w-48'), $lang->milestone->common),
            h::th($lang->project->name),
            h::td(set::colspan('3'), $basicInfo->project->name),
            h::th($lang->execution->end),
            h::td($basicInfo->execution->end)
        ),
        h::tr
        (
            h::th($lang->project->PM),
            h::td(zget($users, $basicInfo->project->PM)),
            h::th($lang->milestone->name),
            h::td($basicInfo->execution->name),
            h::th($lang->project->realEnd),
            h::td($basicInfo->execution->realEnd)
        ),
        h::tr
        (
            h::th($lang->milestone->startedWeeks, icon(set::title($lang->milestone->startedWeekTip), setClass('ml-1'), 'help')),
            h::td($basicInfo->execution->startedWeeks),
            h::th($lang->milestone->finishedWeeks, icon(set::title($lang->milestone->finishedWeekTip), setClass('ml-1'), 'help')),
            h::td($basicInfo->execution->finishedWeeks),
            h::th($lang->milestone->offset),
            h::td($basicInfo->execution->offset)
        )
    );
};
