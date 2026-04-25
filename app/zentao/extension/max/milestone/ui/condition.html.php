<?php
namespace zin;

$buildCondition = function() use($stageInfo, $stageList, $lang, $config)
{
    if(!$config->URAndSR) return;

    $stageCount   = count($stageList);
    $totalStoryTd = $stageCount === 0 ? 4 : 3;
    $thead = h::thead 
    (
        h::tr(h::th(set::colspan($stageCount + $totalStoryTd), $lang->milestone->demandStatus)),
        h::tr
        (
            h::th(set::rowspan('2'), $lang->milestone->storyUnit),
            $stageCount ? h::th(set::colspan($stageCount), setClass('text-center'), $lang->milestone->engineeringStage) : null,
            h::th(set::rowspan('2'), set::colspan(2), $lang->milestone->rateChange)
        ),
        $stageCount ? h::tr(array_map(function($stage){ return h::th(set::title($stage), $stage); }, $stageList)) : null
    );

    $rateNumber = '0%';
    if(count($stageInfo['after']) && current($stageInfo['after'])) $rateNumber = round((array_sum($stageInfo['change']) / current($stageInfo['origin'])) * 100, 2) . '%';
    $tbody = h::tbody
    (
        h::tr(h::th($lang->milestone->originalStory), $stageCount ? null : h::td(set::colspan(3)), array_map(function($key) use($stageInfo){ return h::td($stageInfo['origin'][$key]); }, array_keys($stageList)), h::td(set::colspan(2), set::rowspan(3), $rateNumber)),
        h::tr(h::th($lang->milestone->modifyNumber), array_map(function($key) use($stageInfo){ return h::td($stageInfo['after'][$key]); }, array_keys($stageList))),
        h::tr(h::th($lang->milestone->changeStory), array_map(function($key) use($stageInfo){ return h::td($stageInfo['change'][$key]); }, array_keys($stageList)))
    );
    return h::table(setClass('table bordered bg-white mb-4 text-left'), $thead, $tbody);
};