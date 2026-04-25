<?php
namespace zin;

global $lang;
jsVar('+index', 5);

$relatedHtml = array();
$relatedHtml[] = div(set::className('flex w-full mt-2'), div(set::className('text-center w-48'), $lang->testtask->product), div(set::className('text-center w-48 ml-4'), $lang->testtask->build));

for($index = 0; $index <= 1; $index ++)
{
    $relatedHtml[] = div
    (
        set::className('relatedItem flex w-full mt-2'),
        div
        (
            set::className('flex items-center'),
            picker(set::name("products[$index]"), set::shareSelections('products'), set::width('196px'), set::items(data('products')), setData(array('on' => 'change', 'call' => 'changeProducts', 'params' => 'event')))

        ),
        div
        (
            set::className('flex items-center ml-4'),
            picker(set::name("builds[$index][]"), set::multiple(true), set::width('196px'), set::items(array()))
        ),
        div
        (
            set::className('flex ml-2'),
            btn(set::className('ghost addLine p-2'), icon('plus'), setData(array('on' => 'click', 'call' => 'addLine', 'params' => 'event'))),
            btn(set::className('ghost removeLine p-2'), icon('close'), setData(array('on' => 'click', 'call' => 'removeLine', 'params' => 'event')))
        )
    );
}

$jointBox[] = formGroup
(
    set::width('1/2'),
    set::label($lang->testtask->related),
    set::required(true),
    set::name('relatedBox'),
    set::hidden(true),
    set::control(array('control' => 'input', 'className' => 'hidden')),
    $relatedHtml
);

$jointBox[] = formGroup
(
    set::width('1/2'),
    set::label($lang->testtask->joint),
    set::name('joint'),
    set::control(array('control' => 'radioList', 'inline' => true, 'data-on' => 'change', 'data-call' => 'changeJoint', 'data-params' => 'event')),
    set::items($lang->testtask->jointList),
    set::value(0)
);

query('#typeBox')->closest('.form')->prepend($jointBox);
