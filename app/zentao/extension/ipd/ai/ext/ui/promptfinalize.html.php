<?php
namespace zin;

include './promptnav.html.php';

div(setClass('prompt-finalize'), formPanel
(
    set::id('mainForm'),
    set::actions(
        array(
            array('text' => $lang->ai->prompts->action->publish, 'class' => 'btn primary', 'id' => 'submit', 'btnType' => 'submit', 'name' => 'jumpToNext', 'value' => '1')
        )
    ),
    formGroup
    (
        setClass('w-full max-w-2xl mx-auto'),
        set::label($lang->prompt->name),
        set::required(true),
        input
        (
            set::name('name'),
            set::value($prompt->name),
            set::required(true)
        )
    ),
    formGroup
    (
        setClass('w-full max-w-2xl mx-auto'),
        set::label($lang->prompt->module),
        input
        (
            set::name('module'),
            set::value($lang->ai->prompts->modules[$prompt->module]),
            set::disabled(true)
        ),
        div
        (
            setClass('form-tip text-gray'),
            $lang->ai->moduleDisableTip
        )
    ),
    formGroup
    (
        setClass('w-full max-w-2xl mx-auto'),
        set::label($lang->prompt->desc),
        textarea
        (
            set::name('desc'),
            set::value($prompt->desc),
            set::rows(6)
        )
    )
));
