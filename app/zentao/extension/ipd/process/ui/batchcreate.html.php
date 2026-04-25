<?php
/**
 * The batchCreate view file of process module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang <wangyuting@easycorp.ltd>
 * @package     process
 * @link        https://www.zentao.net
 */
namespace zin;

$items   = array();
$items[] = array('name' => 'id',     'label' => $lang->idAB,            'width' => '32px',  'control'  => 'index');
$items[] = array('name' => 'name',   'label' => $lang->process->name,   'width' => '240px', 'required' => true);
$items[] = array('name' => 'module', 'label' => $lang->process->module, 'width' => '200px', 'control'  => 'picker', 'items' => $modules, 'value' => $moduleID, 'ditto' => true, 'className' => 'hidden');
$items[] = array('name' => 'abbr',   'label' => $lang->process->abbr,   'width' => '200px');
$items[] = array('name' => 'desc',   'label' => $lang->process->desc,   'width' => '200px', 'control'  => 'textarea');

formBatchPanel
(
    to::heading(div
    (
        setClass('panel-title text-lg'),
        $lang->process->batchCreate,
        inputGroup
        (
            setClass('text-base font-medium'),
            span
            (
                setClass('input-group-addon form-label required'),
                $lang->process->module
            ),
            picker
            (
                setClass('w-40'),
                set::name('moduleID'),
                set::items($modules),
                set::value($moduleID),
                setData(array('on' => 'change', 'call' => 'changeModule'))
            )
        )
    )),
    set::items($items)
);
