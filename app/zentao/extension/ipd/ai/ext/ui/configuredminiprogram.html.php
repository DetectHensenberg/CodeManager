<?php
namespace zin;

jsVar('currentFields', array_values($currentFields));
jsVar('knowledgeLibs', array_values($knowledgeLibs));
jsVar('currentPrompt', $currentPrompt);
jsVar('appID', $appID);
jsVar('deleteTip', $lang->ai->miniPrograms->deleteFieldTip);
jsVar('fieldAdd', $lang->ai->miniPrograms->field->add);
jsVar('fieldAddTip', $lang->ai->miniPrograms->field->addTip);
jsVar('knowledgeLibAdd', $lang->ai->miniPrograms->knowledgeLibAdd);
jsVar('knowledgeLibAddTip', $lang->ai->miniPrograms->knowledgeLibAddTip);
jsVar('unavailable', $lang->ai->knowledgeLibs->unavailable);
jsVar('unpublished', $lang->ai->knowledgeLibs->unpublished);
jsVar('deleted', $lang->ai->knowledgeLibs->deleted);
jsVar('fieldEdit', $lang->ai->miniPrograms->field->edit);
jsVar('fieldName', $lang->ai->miniPrograms->field->name);
jsVar('fieldOption', $lang->ai->miniPrograms->field->option);
jsVar('pleaseInput', $lang->ai->miniPrograms->placeholder->input);
jsVar('emptyWarning', $lang->ai->miniPrograms->field->emptyNameWarning);
jsVar('duplicatedWarning', $lang->ai->miniPrograms->field->duplicatedNameWarning);
jsVar('emptyOptionWarning', $lang->ai->miniPrograms->field->emptyOptionWarning);
jsVar('zaiConfigHint', $lang->ai->configZaiHint);
jsVar('hasZaiConfig', $hasZaiConfig);
jsVar('saveFailed', $lang->ai->saveFail);
jsVar('promptPlaceholder', $lang->ai->miniPrograms->placeholder->prompt);
jsVar('publishConfirm', $lang->ai->miniPrograms->publishConfirm);
jsVar('confirmDelete', $lang->ai->knowledgeLibs->confirmDelete);

div(setClass('configured-miniprogram'), div(setClass('panels'), div
(
    setClass('panel-field'),
    h2($lang->ai->miniPrograms->field->configuration),
    div(setClass('panel-content'), div(setClass('panel-area'), h3
    (
        $lang->ai->miniPrograms->field->fieldConfig
    ), ol
    (
        setID('field-list'),
        setClass('field-list sortable')
    )), div(setClass('panel-area'), h3
    (
        $lang->ai->miniPrograms->field->knowledgeLibs
    ), ol
    (
        setID('knowledge-libs'),
        setClass('field-list')
    )))
), div(setClass('panel-debug'), h2($lang->ai->miniPrograms->field->debug), div(setClass('panel-content'), div(setClass('panel-area'), h3(span($lang->ai->miniPrograms->field->contentDebugging), icon('help'), small(set::title($lang->ai->miniPrograms->field->contentDebuggingTip), setClass('text-ellipsis'), $lang->ai->miniPrograms->field->contentDebuggingTip)), div(setID('form-fields'), setClass('form form-horz'))), div(setClass('panel-area'), h3(span($lang->ai->miniPrograms->field->prompterDesign), icon('help'), small(set::title($lang->ai->miniPrograms->field->prompterDesignTip), setClass('text-ellipsis'), $lang->ai->miniPrograms->field->prompterDesignTip)), div(setID('prompt-editor'))))), div(setClass('panel-preview'), h2($lang->ai->miniPrograms->field->preview), div(setClass('panel-content'), div(setClass('panel-area'), h3(setClass('preview-title'), span($lang->ai->miniPrograms->field->prompterPreview), btn(set::type('link'), setID('generate-result'), set::icon('publish'), $lang->ai->miniPrograms->field->generateResult)), div(setID('prompt-preview'), setClass('preview-box'))), div(setClass('panel-area'), h3
(
    $lang->ai->miniPrograms->field->resultPreview
), div(setID('result-preview'), setClass('preview-box')))))), div
(
    setClass('actions'),
    btn
    (
        setID('btn-goback'),
        $lang->ai->miniPrograms->backToListPage
    ),
    btn
    (
        set::url(createLink('ai', 'editMiniProgram', "appID=$appID")),
        $lang->ai->miniPrograms->lastStep
    ),
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

div(
    setClass('modal fade'),
    setData('backdrop', 'static'),
    setID('field-modal'),
    div(
        setClass('modal-dialog shadow size-sm bd-none'),
        div(
            setClass('modal-content'),
            div(setClass('modal-header items-center'), span
            (
                setStyle(array(
                    'font-size' => '20px',
                    'font-weight' => 'bold',
                )),
                $lang->ai->miniPrograms->field->add
            )),
            div
            (
                setClass('modal-actions'),
                button
                (
                    setClass('btn square ghost'),
                    setData('dismiss', 'modal'),
                    span
                    (
                        setClass('close')
                    )
                )
            ),
            div(
                setClass('modal-body form form-horz'),
                formGroup
                (
                    set::label($lang->ai->miniPrograms->field->name),
                    set::required(true),
                    input
                    (
                        set::name('field-name'),
                        set::maxlength('16'),
                        set::required(true)
                    )
                ),
                formGroup
                (
                    set::label($lang->ai->miniPrograms->field->type),
                    select
                    (
                        set::name('field-type'),
                        set::items(array(
                            'text' => $lang->ai->miniPrograms->field->typeList['text'],
                            'textarea' => $lang->ai->miniPrograms->field->typeList['textarea'],
                            'radio' => $lang->ai->miniPrograms->field->typeList['radio'],
                            'checkbox' => $lang->ai->miniPrograms->field->typeList['checkbox']
                        )),
                        set::value('text'),
                        set::required(true)
                    )
                ),
                formGroup
                (
                    setID('field-placeholder'),
                    set::label($lang->ai->miniPrograms->field->placeholder),
                    input
                    (
                        set::name('field-placeholder'),
                        set::placeholder($lang->ai->miniPrograms->placeholder->default)
                    )
                ),
                formGroup
                (
                    setID('field-options'),
                    setClass('field-options hidden'),
                    set::label('')
                ),
                formGroup
                (
                    set::label($lang->ai->miniPrograms->field->required),
                    radioList
                    (
                        set::name('field-required'),
                        set::items(array(
                            '1' => $lang->ai->miniPrograms->field->requiredOptions[1],
                            '0' => $lang->ai->miniPrograms->field->requiredOptions[0]
                        )),
                        set::value('1'),
                        set::inline(true)
                    )
                )
            ),
            div(
                setClass('modal-footer flex items-center justify-center'),
                btn(
                    setID('field-modal-save'),
                    setClass('btn btn-wide primary'),
                    $lang->save
                )
            )
        )
    )
);

div(
    setClass('modal fade'),
    setData('backdrop', 'static'),
    setID('back-modal'),
    div(
        setClass('modal-dialog shadow size-sm bd-none'),
        div(
            setClass('modal-content'),
            div(
                setClass('modal-body back-modal-message'),
                icon('exclamation-sign'),
                p
                (
                    $lang->ai->miniPrograms->backToListPageTip
                )
            ),
            div(setClass('modal-footer flex items-center justify-center'), btn(
                setData('action', 'save'),
                setClass('btn primary'),
                $lang->save
            ), btn(
                setData('action', 'cancel'),
                setClass('btn'),
                $lang->cancel
            ), btn(
                setData('action', 'discard'),
                setClass('btn text-primary ghost'),
                $lang->ai->prompts->roleTemplateSaveList['discard']
            ))
        )
    )
);
