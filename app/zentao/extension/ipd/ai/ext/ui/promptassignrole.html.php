<?php
namespace zin;

include './promptnav.html.php';
include './roletemplates.html.php';

jsVar('prompt', $prompt);
jsVar('lang', array(
    'roleRequired' => $lang->ai->prompts->role . $lang->error->notempty,
    'characterizationRequired' => $lang->ai->prompts->characterization . $lang->error->notempty,
    'saveSuccess' => $lang->saveSuccess,
    'saveFailed' => $lang->ai->saveFail,
    'addRoleTemplate' => $lang->ai->prompts->addRoleTemplate,
    'editRoleTemplate' => $lang->ai->prompts->editRoleTemplate,
    'deleteConfirm' => $lang->ai->prompts->roleDelConfirm,
    'deleteSuccess' => $lang->ai->prompts->roleDelSuccess,
    'apply' => $lang->ai->apply
));

div(setClass('prompt-assign-role'), formPanel
(
    to::heading
    (
        div(
            set::className('flex gap-2 items-center w-full justify-between'),
            div(
                set::className('panel-title text-lg'),
                $lang->ai->prompts->assignRole
            ),
            div(
                set::className('flex gap-1 items-center'),
                button(
                    set::className('btn secondary-outline'),
                    set::id('toggleTemplatePanel'),
                    span($lang->ai->prompts->roleTemplate),
                    icon(setClass('icon icon-first-page'))
                )
            )
        )
    ),
    set::id('mainForm'),
    set::actions(
        array(
            array('text' => $lang->ai->nextStep, 'class' => 'btn primary', 'id' => 'submit', 'btnType' => 'submit', 'name' => 'jumpToNext', 'value' => '1')
        )
    ),
    formGroup
    (
        set::label($lang->ai->prompts->model),
        set::width('1/2'),
        set::required(true),
        div
        (
            setClass('w-full'),
            zui::AIModelPicker(set::name('model'), set::required(true), set::value(!empty($prompt->model) ? $prompt->model : ''))
        )
    ),
    formGroup
    (
        set::label($lang->ai->prompts->role),
        set::width('1/2'),
        input
        (
            set::name('role'),
            set::value(!empty($prompt->role) ? $prompt->role : ''),
            set::placeholder($lang->ai->prompts->rolePlaceholder)
        )
    ),
    formGroup
    (
        set::label($lang->ai->prompts->characterization),
        textarea
        (
            set::name('characterization'),
            set::value(!empty($prompt->characterization) ? $prompt->characterization : ''),
            set::rows(4),
            set::placeholder($lang->ai->prompts->charPlaceholder),
            set::required(true)
        )
    ),
    formGroup
    (
        set::label($lang->ai->prompts->roleTemplateSave),
        set::width('1/2'),
        radioList
        (
            set::name('saveTemplate'),
            set::items($lang->ai->prompts->roleTemplateSaveList),
            set::value('discard'),
            set::inline(true)
        )
    )
), buildTemplatePanel($lang, $roleTemplates ?? []), buildTemplateModal($lang));
