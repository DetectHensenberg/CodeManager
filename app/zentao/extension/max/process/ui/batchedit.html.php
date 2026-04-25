<?php
/**
 * The batchEdit view file of process module of ZenTaoPMS.
 * @copyright   Copyright 2009-2025 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun <sunguangming@easycorp.ltd>
 * @package     process
 * @link        https://www.zentao.net
 */
namespace zin;

$items   = array();
$items[] = array('name' => 'id',     'label' => $lang->idAB,            'width' => '32px',  'control'  => 'index');
$items[] = array('name' => 'module', 'label' => $lang->process->module, 'width' => '200px', 'control'  => 'picker', 'items' => $modules, 'required' => true);
$items[] = array('name' => 'name',   'label' => $lang->process->name,   'width' => '240px', 'required' => true);
$items[] = array('name' => 'abbr',   'label' => $lang->process->abbr,   'width' => '200px');

formBatchPanel
(
    to::heading(div
    (
        setClass('panel-title text-lg'),
        $lang->process->batchEdit
    )),
    set::mode('edit'),
    set::items($items),
    set::data(array_values($processes))
);
