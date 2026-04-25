<?php
namespace zin;

$buildProductQuality = function() use($productQuality, $lang)
{
    $thead = h::thead
    (
        setClass('text-left'),
        h::tr
        (
            h::th(set::rowspan(2), $lang->milestone->quality->identify),
            isset($productQuality['stages']) ? h::th(setClass('text-center'), set::colspan(count($productQuality['stages'])), $lang->milestone->quality->injection) : null,
            h::th(set::rowspan(2), $lang->milestone->quality->scale),
            h::th(set::rowspan(2), $lang->milestone->quality->identifyRate)
        ),
        isset($productQuality['stages']) ? h::tr(array_map(function($stage){ return h::th(set::title($stage['name']), $stage['name']); }, $productQuality['stages'])) : null
    );

    $trList = array();
    if(isset($productQuality['reviews']))
    {
        $trList = array_map(function($reviewID, $review) use($productQuality)
        {
            return h::tr
            (
                h::td($review['name']),
                array_map(function($stage) use($reviewID) { return h::td($stage[$reviewID]['counts']); }, $productQuality['stages']),
                h::td($review['reviewEstimate']),
                h::td($review['identifyRate'])
            );
        }, array_keys($productQuality['reviews']), $productQuality['reviews']);
    }
    $trList[] = h::tr
    (
        h::th(setClass('text-left'), $lang->milestone->quality->total),
        isset($productQuality['stages']) ? array_map(function($stage){ return h::td($stage['total']); }, $productQuality['stages']) : null,
        isset($productQuality['totalEstimate']) ? h::td($productQuality['totalEstimate']) : null,
        isset($productQuality['totalIdentifyRate']) ? h::td($productQuality['totalIdentifyRate']) : null
    );
    $trList[] = h::tr
    (
        h::th(setClass('text-left'), $lang->milestone->quality->injectionRate),
        isset($productQuality['stages']) ? array_map(function($stage){ return h::td($stage['injection']); }, $productQuality['stages']) : null,
        h::td(),
        h::td()
    );
    $tbody = h::tbody($trList);
    return h::table(setClass('table bordered bg-white mb-4'), $thead, $tbody);
};