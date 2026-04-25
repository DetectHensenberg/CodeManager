<?php
namespace zin;

$buildProcess = function() use($process, $lang)
{
    return h::table
    (
        setClass('table bordered basicInfo bg-white mb-4'),
        h::thead
        (
            h::tr
            (
                h::th(set::rowspan(2), $lang->milestone->processCommon),
                h::th
                (
                    setClass('overflow-visible'),
                    set::rowspan(2), 
                    $lang->milestone->stage,
                    span(setClass('pl-1'), setData(array('toggle' => 'dropdown', 'trigger' => 'hover')), icon('help')),
                    h::menu(setClass("dropdown-menu custom p-1 h-44 overflow-auto text-left helpDropdown"), setStyle(array('font-weight' => 'normal', 'font-size' => '12px', 'line-height' => '1.5')), html($lang->milestone->milestoneHelpNotice))
                ),
                h::th
                (
                    setClass('overflow-visible'),
                    set::rowspan(2),
                    $lang->milestone->toNow,
                    span(setClass('pl-1'), setData(array('toggle' => 'dropdown', 'trigger' => 'hover')), icon('help')),
                    h::menu(setClass("dropdown-menu custom p-1 h-44 overflow-auto text-left helpDropdown"), setStyle(array('font-weight' => 'normal', 'font-size' => '12px', 'line-height' => '1.5')), html($lang->milestone->soFarHelpNotice))
                ),
                h::th(set::colspan(2), $lang->milestone->targetRange),   
                h::th(set::rowspan(2), $lang->milestone->analysis),
                h::th(set::rowspan(2), $lang->milestone->stage),
                h::th(set::rowspan(2), $lang->milestone->toNow)
            ),
            h::tr
            (
                h::th(setClass('text-center'), $lang->milestone->ge),
                h::th(setClass('text-center'), $lang->milestone->le)
            )
        ),
        h::tbody
        (
            h::tr
            (
                h::td($lang->milestone->PV),
                h::td($process->milestonePV),
                h::td($process->nowPV),
                h::td(setClass('text-center'), '-'),
                h::td(setClass('text-center'), '-'),
                h::td(setClass('text-center'), set::rowspan(3), $lang->milestone->process),
                h::td(set::rowspan(3), $process->milestoneSpiTip),
                h::td(set::rowspan(3), $process->nowSpiTip)
            ),
            h::tr(h::td($lang->milestone->EV), h::td($process->milestoneEV), h::td($process->nowEV), h::td(setClass('text-center'), '-'), h::td(setClass('text-center'), '-')),
            h::tr(h::td($lang->milestone->AC), h::td($process->milestoneAC), h::td($process->nowAC), h::td(setClass('text-center'), '-'), h::td(setClass('text-center'), '-')),
            h::tr
            (
                h::td($lang->milestone->SPI),
                h::td($process->milestoneSPI),
                h::td($process->nowSPI),
                h::td(setClass('text-center'), $process->spiMin),
                h::td(setClass('text-center'), $process->spiMax),
                h::td(setClass('text-center'), set::rowspan(4), $lang->milestone->cost),
                h::td(set::rowspan(4), $process->milestoneCpiTip),
                h::td(set::rowspan(4), $process->nowCpiTip)
            ),
            h::tr(h::td($lang->milestone->CPI), h::td($process->milestoneCPI), h::td($process->nowCPI), h::td(setClass('text-center'), $process->cpiMin), h::td(setClass('text-center'), $process->cpiMax)),
            h::tr(h::td($lang->milestone->SV), h::td($process->milestoneSV . '%'), h::td($process->nowSV . '%'), h::td(setClass('text-center'), $process->svMin . '%'), h::td(setClass('text-center'), $process->svMax . '%')),
            h::tr(h::td($lang->milestone->CV), h::td($process->milestoneCV . '%'), h::td($process->nowCV . '%'), h::td(setClass('text-center'), $process->cvMin . '%'), h::td(setClass('text-center'), $process->cvMax . '%'))
        )
    );
};