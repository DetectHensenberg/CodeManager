<?php
/**
 * The index file of workestimation module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     workestimation
 * @link        https://www.zentao.net
 */
namespace zin;

jsVar('scale', $scale);
$canModify = common::canModify('project', $project);
$productivityLable = $lang->hourCommon;
if($hourPoint == 1) $productivityLable = $lang->custom->unitList['efficiency'] . $lang->hourCommon;
if($hourPoint == 2) $productivityLable = $lang->custom->unitList['manhour']    . $lang->custom->unitList['loc'];
formPanel
(
    set::title($title),
    set::layout('horz'),
    formGroup
    (
        set::width($canModify && $scale ? '800px' : '400px'),
        set::label($lang->workestimation->scale),
        set::required(true),
        inputGroup(input
        (
            setData(array('on' => 'change', 'call' => 'computeDuration')),
            set::name('scale'),
            set::value(zget($budget, 'scale', '')),
            set::type('number'),
            set::min(0),
            set::step(0.01)
        ), inputGroupAddon($lang->hourCommon, setClass('w-24 center'))),
        $canModify && $scale ? div
        (
            setClass('flex h-8 items-center pl-4'), html(sprintf($lang->workestimation->scaleTip, $scale)),
            setStyle(array('width' => '400px'))
        ) : null
    ),
    formGroup
    (
        set::width('400px'),
        set::label($lang->workestimation->productivity),
        set::hidden($hourPoint == 0),
        set::required(true),
        inputGroup
        (
            input
            (
                setData(array('on' => 'change', 'call' => 'computeDuration')),
                set::name('productivity'),
                set::value(zget($budget, 'productivity', ''))
            ),
            inputGroupAddon($productivityLable, setClass('w-24 center'))
        )
    ),
    formGroup
    (
        set::width('400px'),
        set::label($lang->workestimation->duration),
        set::required(true),
        inputGroup
        (
            input
            (
                setData(array('on' => 'change', 'call' => 'computeTotal')),
                set::name('duration'),
                set::disabled(true),
                set::value(zget($budget, 'duration', ''))
            ),
            inputGroupAddon($lang->workestimation->hour, setClass('w-24 center'))
        )
    ),
    formGroup
    (
        set::width('400px'),
        set::label($lang->workestimation->unitLaborCost),
        set::required(true),
        inputGroup
        (
            input
            (
                setData(array('on' => 'change', 'call' => 'computeTotal')),
                set::name('unitLaborCost'),
                set::value(zget($budget, 'unitLaborCost', '')),
                set::type('number'),
                set::min(0),
                set::step(0.01)
            ),
            inputGroupAddon($lang->custom->unitList['cost'], setClass('w-24 center'))
        )
    ),
    formGroup
    (
        set::width('400px'),
        set::label($lang->workestimation->totalLaborCost),
        set::required(true),
        set::name('totalLaborCost'),
        set::control(array('control' => 'input', 'type' => 'number', 'min' => 0, 'step' => '0.01')),
        set::value(zget($budget, 'totalLaborCost', ''))
    ),
    formGroup
    (
        set::width('400px'),
        set::label($lang->workestimation->dayHour),
        set::name('dayHour'),
        set::control(array('control' => 'input', 'type' => 'number', 'min' => 0, 'step' => '0.01')),
        set::value(zget($budget, 'dayHour', ''))
    )
);
query('.form-row')->after(html("<div class='p-4 bg-secondary-100 text-primary'>" . $lang->workestimation->tips . "</div>"));
