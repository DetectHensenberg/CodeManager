<?php
/**
 * The buildzentaoconfig view file of document module of ZenTaoPMS.
 * @copyright   Copyright 2009-2025 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Tingting Dai <daitingting@easycorp.ltd>
 * @package     doc
 * @link        https://www.zentao.net
 */
namespace zin;

$formRows   = array();
$formGroups = array();
foreach($conditionFields as $conditionField)
{
    $required = false;
    if($module == 'weekly' && $measurementKey == 'term') $required = true;
    $conditionField['required'] = $required;

    if(!$isTemplate && $conditionField['control'] == 'datepicker')
    {
        $fieldName  = $conditionField['name'];
        $formGroups[] = formGroup
        (
            set::label($conditionField['label']),
            set::required($conditionField['required']),
            set::width('1/2'),
            inputGroup
            (
                datePicker
                (
                    set::name("{$fieldName}[begin]"),
                    set::value(zget($conditionField['value'], 'begin', ''))
                ),
                $lang->to,
                datePicker
                (
                    set::name("{$fieldName}[end]"),
                    set::value(zget($conditionField['value'], 'end', ''))
                )
            )
        );
        if(count($formGroups) == 2)
        {
            $formRows[] = formRow($formGroups);
            $formGroups = array();
        }
    }
    else
    {
        $formGroups[] = formGroup(set($conditionField));
        if(count($formGroups) == 2)
        {
            $formRows[] = formRow($formGroups);
            $formGroups = array();
        }
    }
}
if($formGroups) $formRows[] = formRow($formGroups);

formPanel
(
    setID('buildZentaoConfig'),
    set::action(inlink($this->app->rawMethod, "type={$type}&oldBlockID={$blockID}")),
    set::ajax(array('beforeSubmit' => jsRaw('clickSubmitForZentaoConfig'))),
    set::title($title),
    to::titleSuffix
    (
        span
        (
            setClass('text-muted text-sm text-gray-600 font-light'),
            span(setClass('text-warning mr-1'), icon('help'), set::title($lang->reporttemplate->noneConditionTips)),
            $lang->reporttemplate->noneConditionTips
        )
    ),
    $formRows,
    $isTemplate ? null : formHidden('project', $project),
    formHidden('templateID', '')
);
