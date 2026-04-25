<?php
namespace zin;

/**
 * Build navigation steps for prompt design
 * 构建提示设计页面的步骤导航
 *
 * @param array $stepSequence 步骤序列
 * @param array $stepStatus 步骤状态
 * @param object $prompt 提示对象
 * @param array $stepNav 步骤导航配置
 * @return mixed Any type supported by zin widget function
 */
function buildNavSteps($stepSequence, $stepStatus, $prompt, $stepNav)
{
    return menu(
        setClass('nav nav-steps'),
        ...array_map(function ($stepKey, $stepLang) use ($stepStatus, $stepSequence, $prompt) {
            $currentStepStatus = $stepStatus[$stepKey] ?? 'disabled';

            /* 根据状态设置CSS类 */
            $linkClass = '';
            switch ($currentStepStatus) {
                case 'active':
                    $linkClass = 'selected';
                    break;
                case 'current':
                    $linkClass = 'active';
                    break;
                case 'clickable':
                    $linkClass = '';
                    break;
                case 'disabled':
                    $linkClass = 'disabled';
                    break;
            }

            return li(setClass('nav-item item'), a(setClass($linkClass), set::href(createLink('ai', "prompt$stepKey", "prompt=" . ($prompt->id ?? '0'))), span(
                setClass('text'),
                $stepLang
            )));
        }, array_keys($stepNav), array_values($stepNav))
    );
}

/* 步骤导航逻辑 */
$step = preg_replace('/^prompt/', '', $app->methodName ?? 'assignrole');
$stepSequence = array('assignrole', 'selectdatasource', 'setpurpose', 'settargetform', 'finalize');

$currentStepIndex = array_search($step, $stepSequence);
$lastActiveStepIndex = array_search($lastActiveStep ?? 'assignrole', $stepSequence);

$stepStatus = array();
foreach ($stepSequence as $index => $stepName) {
    if ($index < $currentStepIndex) {
        $stepStatus[$stepName] = 'active';
    } elseif ($index > $currentStepIndex && $index <= $lastActiveStepIndex + 1) {
        $stepStatus[$stepName] = 'clickable';
    } else {
        $stepStatus[$stepName] = 'disabled';
    }

    if ($index == $currentStepIndex) {
        $stepStatus[$stepName] = 'current';
    }
}

/**
 * Prompt Design 页面共享头部
 */
div(setClass('prompt-header'), btn(setClass('btn-back'), set::type('ghost'), set::url(createLink('ai', 'prompts')), set::icon('angle-left'), set::text($lang->goback)), buildNavSteps($stepSequence, $stepStatus, $prompt, $lang->ai->designStepNav));
