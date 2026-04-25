<?php
/**
 * The audit view file of AI module of ZenTaoPMS.
 *
 * @copyright   Copyright 2025 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Hao Sun <sunhao@easycorp.ltd>
 * @package     ai
 * @link        https://www.zentao.net
 */

namespace zin;

$sources = explode(',', $prompt->source);
$sources = array_filter($sources);
end($sources);
$lastKey = key($sources);
$fields  = array();
foreach($sources as $key => $source)
{
    list($object, $field) = explode('.', $source);
    $fields[] = $this->lang->ai->dataSource[$prompt->module][$object][$field];
}

$targetForm     = explode('.', $prompt->targetForm);
$targetFormName = $this->lang->ai->targetForm[$targetForm[0]][$targetForm[1]];

set::size('lg');

modalHeader
(
    set::title($lang->ai->audit->designPrompt),
    set::entityID($prompt->id),
    set::entityText($prompt->name)
);

form
(
    row
    (
        setClass('surface-light py-1'),
        cell
        (
            setClass('col gap-3 w-1/2 pr-4 border-r'),
            h5(setClass('pl-1'), $lang->ai->prompts->assignRole),
            formGroup
            (
                set::label($lang->ai->prompts->role),
                set::name('role'),
                set::value($prompt->role),
                set::control('input'),
                set::placeholder($lang->ai->prompts->rolePlaceholder),
                on::input()->do('$("#roleDisplay").text($(target).closest("input").val());')
            ),
            formGroup
            (
                set::label($lang->ai->prompts->characterization),
                set::name('characterization'),
                set::value($prompt->characterization),
                set::control(array('control' => 'textarea', 'rows' => 4)),
                set::placeholder($lang->ai->prompts->charPlaceholder),
                on::input()->do('$("#characterizationDisplay").text($(target).closest("textarea").val());')
            ),
            h5(setClass('pl-1'), $lang->ai->prompts->selectDataSource),
            formGroup
            (
                set::label($lang->ai->prompts->object),
                set::value($lang->ai->dataSource[$prompt->module]['common']),
                set::control('static')
            ),
            formGroup
            (
                set::label($lang->ai->prompts->field),
                set::value(implode($lang->ai->prompts->fieldSeparator, $fields)),
                set::control('static')
            ),
            h5(setClass('pl-1'), $lang->ai->prompts->setPurpose),
            formGroup
            (
                set::label($lang->ai->prompts->purpose),
                set::name('purpose'),
                set::value($currentPrompt),
                set::control(array('control' => 'textarea', 'rows' => 6)),
                set::required(true),
                set::placeholder($lang->ai->prompts->purposeTip),
                on::input()->do
                (
                    'const purposeText = $(target).closest("textarea").val();',
                    '$("#purposeDisplay").text(purposeText);',
                    '$this.closest("form").find("button[type=\'submit\']").prop("disabled", !purposeText);'
                )
            ),
            h5(setClass('pl-1'), $lang->ai->prompts->setTargetForm),
            formGroup
            (
                set::label($lang->ai->prompts->selectTargetForm),
                set::value($targetFormName),
                set::control('static')
            )
        ),
        cell
        (
            setClass('col gap-4 w-1/2 pl-4'),
            h5
            (
                setClass('flex items-center'),
                $lang->ai->audit->promptForModel,
                $lang->colon,
                zui::aiModelName($prompt->model)
            ),
            div(setClass('border-t text-gray pt-1'), $lang->ai->prompts->assignRole),
            p(setID('roleDisplay'), $prompt->role),
            p(setID('characterizationDisplay'), $prompt->characterization),
            div(setClass('border-t text-gray pt-1'), $lang->ai->prompts->selectDataSource),
            p(htmlspecialchars($dataPrompt)),
            div(setClass('border-t text-gray pt-1'), $lang->ai->prompts->setPurpose),
            p(setID('purposeDisplay'), setClass('whitespace-pre-wrap'), $currentPrompt)
        )
    ),
    row
    (
        setClass('items-center gap-2 pl-1'),
        div($this->lang->ai->audit->afterSave),
        radioList
        (
            set::name('backLocation'),
            set::items($this->lang->ai->audit->backLocationList),
            set::value(1),
            set::inline(true)
        )
    )
);
