<?php
namespace zin;

jsVar('currentFields', array_values($currentFields));
jsVar('currentPrompt', $currentPrompt);
jsVar('appID', $appID);
jsVar('zaiConfigHint', $lang->ai->configZaiHint);
jsVar('hasZaiConfig', $hasZaiConfig);
jsVar('saveFailed', $lang->ai->saveFail);
jsVar('promptPlaceholder', $lang->ai->miniPrograms->placeholder->prompt);
jsVar('publishConfirm', $lang->ai->miniPrograms->publishConfirm);

div(setClass('test-miniprogram'), h1(setClass('modal-name'), $lang->ai->prompts->action->test), div(setClass('panels'), div(setClass('panel-debug'), div(setClass('panel-content'), div(setClass('panel-area'), h3(span($lang->ai->miniPrograms->field->contentDebugging)), div(setID('form-fields'), setClass('form form-horz'))), div(setClass('panel-area'), h3(span($lang->ai->miniPrograms->field->prompterDesign)), div(setClass('prompt-editor'), div(setID('prompt-editor')))))), div(setClass('panel-preview'), div(setClass('panel-content'), div(setClass('panel-area'), h3(setClass('preview-title'), span($lang->ai->miniPrograms->field->prompterPreview), btn
(
    set::type('link'),
    setID('generate-result'),
    set::icon('publish'),
    $lang->ai->miniPrograms->field->generateResult,
    on::init()->const('zaiConfigHint', $lang->ai->configZaiHint)->do('if(!window.top.zai) $element.attr("title", zaiConfigHint).addClass("disabled")')
)), div(setID('prompt-preview'), setClass('preview-box'))), div(setClass('panel-area'), h3
(
    $lang->ai->miniPrograms->field->resultPreview
), div(setID('result-preview'), setClass('preview-box')))))), div
(
    setClass('actions'),
    btn
    (
        setID('btn-save'),
        set::type('secondary'),
        $lang->save
    ),
    btn
    (
        setID('btn-publish'),
        set::type('primary'),
        $lang->ai->prompts->action->publish
    )
));
