<?php
namespace zin;

include './promptnav.html.php';

jsVar('promptID', $promptID);
jsVar('promptModule', $prompt->module);
jsVar('lang', array(
    'saveFailed' => $lang->ai->saveFail
));

/* 构建选项列表 */
function buildOptions($lang, $prompt, $config)
{
    $optionGroups = array();

    foreach ($config->ai->targetForm as $name => $forms)
    {
        $options = array();
        foreach (array_keys($forms) as $form)
        {
            if(isset($forms[$form]->for) && strpos(',' . $forms[$form]->for . ',', ',' . $prompt->module . ',') === false) continue;
            $value = "$name.$form";
            $isChecked = $value == $prompt->targetForm;

            $options[] = radio(
                set::primary(true),
                set::typeClass('radio'),
                set::name('targetForm'),
                set::value($value),
                set::checked($isChecked),
                set::text($lang->ai->targetForm[$name][$form])
            );
        }

        if(empty($options)) continue;

        $optionGroups[] = div(
            setClass('option-group'),
            h5(setClass('group-name'), span($lang->ai->targetForm[$name]['common'])),
            div(
                setClass('options'),
                ...$options
            )
        );
    }

    return $optionGroups;
}

/* 构建预览列表 */
function buildPreviewList($lang, $prompt, $dataPreview)
{
    return ul(
        setClass('preview-list'),
        li(h5($lang->ai->prompts->dataPreview), p
        (
            setClass('pre'),
            $dataPreview
        )),
        li(
            h5($lang->ai->prompts->rolePreview),
            p($prompt->role),
            p($prompt->characterization)
        ),
        li(
            h5($lang->ai->prompts->promptPreview),
            p($prompt->purpose),
            p($prompt->elaboration)
        )
    );
}

div(
    setClass('prompt-set-target'),
    formPanel(set::id('mainForm'), set::actions(
        array(
            array('text' => $lang->ai->nextStep, 'class' => 'btn primary', 'id' => 'submit', 'btnType' => 'button'),
            array('text' => $lang->ai->goTesting, 'class' => 'btn btn-secondary', 'id' => 'go-test-btn', 'btnType' => 'submit', 'name' => 'goTesting', 'value' => '1')
        )
    ), div(
        setClass('panel-container'),
        div(setClass('form-panel'), div(
            setClass('section-header'),
            h4(setClass('text-md'), $lang->ai->prompts->selectTargetForm),
            small(setClass('text-gray'), $lang->ai->prompts->selectTargetFormTip)
        ), div(
            setClass('section-content'),
            buildOptions($lang, $prompt, $config),
            div
            (
                setClass('pl-4 py-3'),
                radio
                (
                    set::name('targetForm'),
                    set::value('empty.empty'),
                    set::checked(empty($prompt->targetForm) || $prompt->targetForm == 'empty.empty'),
                    set::text($lang->ai->prompts->noRedirect)
                )
            )
        )),
        div(
            setClass('preview-panel'),
            div(
                setClass('section-header'),
                h4(setClass('text-md'), $lang->ai->prompts->inputPreview)
            ),
            div(
                setClass('section-content'),
                buildPreviewList($lang, $prompt, $dataPreview)
            )
        )
    ))
);
