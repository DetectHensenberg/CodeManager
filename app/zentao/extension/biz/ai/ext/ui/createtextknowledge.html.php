<?php
namespace zin;

jsVar('errorNotempty', $lang->error->notempty);
jsVar('knowledgeContentLabel', $lang->ai->knowledgeLibs->knowledgeContent);

$labelWidth = common::checkNotCN() ? '130px' : '80px';

formPanel(
    set::id('createTextKnowledgeForm'),
    set::title($lang->ai->knowledgeLibs->knowledgeTypes['text']['label']),
    set::submitBtnText($lang->save),
    formRow(
        formGroup(set::label($lang->ai->knowledgeLibs->knowledgeName), set::labelWidth($labelWidth), set::required(true), inputGroup(
            input(
                set::name('title')
            ),
            btn(
                set::text($lang->ai->knowledgeLibs->generateTitleByAI),
                on::click()->call('generateKnowledgeTitle')
            )
        ))
    ),
    formRow(
        formGroup(
            set::label($lang->ai->knowledgeLibs->knowledgeContent),
            set::labelWidth($labelWidth),
            set::name('content'),
            set::required(true),
            set::control(array('control' => 'editor', 'markdown' => true, 'uploadUrl' => 'disabled'))
        )
    )
);
