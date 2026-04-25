<?php
namespace zin;

jsVar('promptID', $promptID);
jsVar('currentFields', array_values($currentFields));
jsVar('knowledgeLibs', array_values($knowledgeLibs));
jsVar('currentPrompt', $currentPrompt);
jsVar('deleteTip', $lang->ai->miniPrograms->deleteFieldTip);
jsVar('fieldAdd', $lang->ai->miniPrograms->field->add);
jsVar('fieldAddTip', $lang->ai->miniPrograms->field->addTip);
jsVar('knowledgeLibAdd', $lang->ai->miniPrograms->knowledgeLibAdd);
jsVar('knowledgeLibAddTip', $lang->ai->miniPrograms->knowledgeLibAddTip);
jsVar('unpublished', $lang->ai->knowledgeLibs->unpublished);
jsVar('deleted', $lang->ai->knowledgeLibs->deleted);
jsVar('confirmDelete', $lang->confirmDelete);
jsVar('fieldEdit', $lang->ai->miniPrograms->field->edit);
jsVar('fieldName', $lang->ai->miniPrograms->field->name);
jsVar('fieldOption', $lang->ai->miniPrograms->field->option);
jsVar('pleaseInput', $lang->ai->miniPrograms->placeholder->input);
jsVar('fieldPlaceholder', $lang->ai->miniPrograms->placeholder->input);
jsVar('emptyWarning', $lang->ai->miniPrograms->field->emptyNameWarning);
jsVar('duplicatedWarning', $lang->ai->miniPrograms->field->duplicatedNameWarning);
jsVar('emptyOptionWarning', $lang->ai->miniPrograms->field->emptyOptionWarning);
jsVar('saveFailed', $lang->ai->saveFail);
jsVar('promptPlaceholder', $lang->ai->miniPrograms->placeholder->prompt);

include './promptnav.html.php';

/* 构建预览列表 */
function buildPreviewList($lang, $prompt, $dataPreview, $knowledgeLibs)
{
    $knowledgeLibNames = [];
    foreach($knowledgeLibs as $knowledgeLib)
    {
        $available = $knowledgeLib->published === '1' && $knowledgeLib->deleted === '0';
        if(!$available) continue;

        $knowledgeLibNames[] = $knowledgeLib->name;
    }

    return ul(
        setClass('preview-list'),
        li(
            h5($lang->ai->prompts->dataPreview),
            p(
                setClass('pre'),
                $dataPreview
            )
        ),
        li(
            h5($lang->ai->prompts->rolePreview),
            p(
                setClass('whitespace-pre-wrap'),
                $prompt->role
            ),
            p(
                setClass('whitespace-pre-wrap'),
                $prompt->characterization
            )
        ),
        li(
            h5($lang->ai->miniPrograms->field->prompterPreview),
            div(
                setID('prompt-preview')
            )
        ),
        li(
            h5($lang->ai->miniPrograms->field->knowledgeLibs),
            p(
                setID('knowledgelib-names'),
                setClass('whitespace-pre-wrap'),
                implode(', ', $knowledgeLibNames)
            )
        )
    );
}

div(
    setClass('prompt-set-purpose'),
    div(
        setClass('panels'),
        div(
                setClass('form-panel'),
                div(
                    setClass('section-content'),
                    div(
                        setClass('panel-area'),
                        h3(
                            setClass('text-md'),
                            $lang->ai->miniPrograms->field->fields
                        ),
                        ol(
                            setID('field-list'),
                            setClass('field-list sortable')
                        )
                    ),
                    div(
                        setClass('panel-area'),
                        h3(
                            setClass('text-md field-required'),
                            $lang->ai->miniPrograms->field->prompt,
                            icon('help'),
                            small(
                                set::title($lang->ai->miniPrograms->field->prompterDesignTip),
                                setClass('text-ellipsis'),
                                $lang->ai->miniPrograms->field->prompterDesignTip
                            )
                        ),
                        div(setID('prompt-editor'))
                    ),
                    div(
                        setClass('panel-area'),
                        h3(
                            setClass('text-md'),
                            $lang->ai->miniPrograms->field->knowledgeLibs
                        ),
                        ol(
                            setID('knowledge-libs'),
                            setClass('field-list')
                        )
                    )
                )
            ),
            div(
                setClass('preview-panel'),
                div(
                    setClass('section-header'),
                    h2(
                        setClass('text-md'),
                        $lang->ai->prompts->inputPreview
                    )
                ),
                div(
                    setClass('section-content'),
                    buildPreviewList($lang, $prompt, $dataPreview, $knowledgeLibs)
            )
        )
    ),
    div
    (
        setClass('actions'),
        btn
        (
            setID('btn-save'),
            set::type('primary'),
            $lang->ai->nextStep
        )
    )
);

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
