<?php
namespace zin;

global $lang;

$task = data('task');
if($task->joint)
{
    $stories    = data('stories') ? data('stories') : array();
    $products   = data('products');
    $executions = data('executions');
    $builds     = data('builds');

    $linkedStories   = array();
    $linkedStories[] = section
    (
        set::title($lang->testtask->linkedStories),
        div($lang->SRCommon, "：", !empty($stories) ? a(set::href('javascript:;'), setData(array('toggle' => 'modal', 'target' => '#storyList', 'size' => 'lg')), count($stories)) : 0, $lang->testtask->unit)
    );

    $storyCols = array();
    $storyCols[] = array('name' => 'id',         'title' => $lang->story->id,         'type' => 'id',    'fixed' => 'left', 'sortType' => false);
    $storyCols[] = array('name' => 'title',      'title' => $lang->story->title,      'type' => 'title', 'fixed' => 'left', 'link' => array('module' => 'story', 'method' => 'view', 'params' => "storyID={id}"), 'sortType' => false);
    $storyCols[] = array('name' => 'pri',        'title' => $lang->story->pri,        'type' => 'pri',    'priList' => $lang->story->priList, 'sortType' => false);
    $storyCols[] = array('name' => 'openedBy',   'title' => $lang->story->openedBy,   'type' => 'user',   'sortType' => false);
    $storyCols[] = array('name' => 'assignedTo', 'title' => $lang->story->assignedTo, 'type' => 'user',   'sortType' => false);
    $storyCols[] = array('name' => 'estimate',   'title' => $lang->story->estimate,   'type' => 'number', 'sortType' => false);
    $storyCols[] = array('name' => 'status',     'title' => $lang->story->status,     'type' => 'status', 'sortType' => false, 'statusMap' => $lang->story->statusList);
    $linkedStories[] = modal
    (
        setID('storyList'),
        set::title($lang->SRCommon),
        dtable
        (
            set::cols(array_values($storyCols)),
            set::data(array_values($stories)),
            set::userMap(data('users'))
        )
    );

    query('#descBox')->after($linkedStories);

    $productBox   = array();
    $executionBox = array();
    $buildBox     = array();
    foreach($products   as $productID   => $productName)   $productBox[]   = div(a(set::href(createLink('product', 'view', "productID={$productID}")), set::title($productName), $productName));
    foreach($executions as $executionID => $executionName) $executionBox[] = div(a(set::href(createLink('execution', 'story', "executionID={$executionID}")), set::title($executionName), $executionName));
    foreach($builds     as $buildID     => $buildName)     $buildBox[]     = div(a(set::href(createLink('build', 'view', "buildID={$buildID}")), set::title($buildName), $buildName));
    query('#buildText')->closest('tbody')->prepend(h::tr(h::th(setClass('py-1.5 pr-2 font-normal nowrap text-right'), $lang->testtask->product), h::td(setClass('py-1.5 pl-2 w-full'), $productBox)));
    query('#executionText')->empty()->after($executionBox);
    query('#buildText')->empty()->after($buildBox);
}
