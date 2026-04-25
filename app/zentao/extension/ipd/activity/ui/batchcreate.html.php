<?php
/**
 * The batchCreate view file of activity module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang <wangyuting@easycorp.ltd>
 * @package     activity
 * @link        https://www.zentao.net
 */
namespace zin;

$items   = array();
$items[] = array('name' => 'id',         'label' => $lang->idAB,                 'width' => '32px',  'control'  => 'index');
$items[] = array('name' => 'process',    'label' => $lang->activity->process,    'width' => '120px', 'control'  => array('control' => 'picker', 'required' => false), 'required' => true, 'items' => $processes, 'value' => $processID, 'ditto' => true, 'className' => 'hidden');
$items[] = array('name' => 'name',       'label' => $lang->activity->name,       'width' => '240px', 'required' => true);
$items[] = array('name' => 'optional',   'label' => $lang->activity->optional,   'width' => '120px', 'control'  => array('control' => 'radioList', 'inline' => true), 'items' => array_filter($lang->activity->optionalList), 'value' => 'yes');
$items[] = array('name' => 'tailorNorm', 'label' => $lang->activity->tailorNorm, 'width' => '200px');
$items[] = array('name' => 'content',    'label' => $lang->activity->content,    'width' => '200px', 'control'  => 'textarea');

formBatchPanel
(
    to::heading(div
    (
        setClass('panel-title text-lg'),
        $lang->activity->batchCreate,
        inputGroup
        (
            setClass('text-base font-medium'),
            span
            (
                setClass('input-group-addon form-label required'),
                $lang->activity->process
            ),
            picker
            (
                setClass('w-40'),
                set::name('processID'),
                set::items($processes),
                set::value($processID),
                setData(array('on' => 'change', 'call' => 'changeProcess'))
            )
        )
    )),
    on::change('[data-name="optional"]', 'setTailorNorm'),
    set::items($items)
);
