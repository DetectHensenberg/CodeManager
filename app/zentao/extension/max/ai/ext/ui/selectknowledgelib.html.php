<?php
namespace zin;

jsVar('selectedID', $selectedID);
jsVar('callback', $callback);
jsVar('multiple', $multiple);
jsVar('knowledgeLibs', $knowledgeLibs);
jsVar('pleaseSelectKnowledgeLib', $lang->ai->knowledgeLibs->pleaseSelectKnowledgeLib);

$spaces = array();
$spaces['my']   = $lang->ai->knowledgeLibs->myKnowledgeLib;
$spaces['team'] = $lang->ai->knowledgeLibs->teamKnowledgeLib;

$labelWidth = common::checkNotCN() ? '160px' : '80px';

formPanel(
    set::id('selectKnowledgeLibForm'),
    set::title($title),
    set::submitBtnText($lang->save),
    set::ajax(array('beforeSubmit' => jsRaw('selectKnowledgeLibFormBeforeSubmit'))),
    formRow(
        formGroup(
            set::label($lang->ai->knowledgeLibs->knowledgeLibSpace),
            set::control(array('type' => 'radioList', 'inline' => true)),
            set::labelWidth($labelWidth),
            set::name('space'),
            set::items($spaces),
            set::value('my'),
            on::change('[name=space]', 'toggleSpace')
        )
    ),
    formRow(
        formGroup(
            set::label($lang->ai->knowledgeLibs->common),
            set::required(true),
            set::labelWidth($labelWidth),
            picker(
                set::name('libID'),
                set::placeholder($lang->ai->knowledgeLibs->pleaseSelectKnowledgeLib),
                set::items($options),
                set::multiple($multiple),
                set::value($current)
            )
        )
    )
);
