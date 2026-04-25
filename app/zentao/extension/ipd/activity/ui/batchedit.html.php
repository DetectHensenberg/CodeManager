<?php
/**
 * The batchEdit view file of activity module of ZenTaoPMS.
 * @copyright   Copyright 2009-2025 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun <sunguangming@easycorp.ltd>
 * @package     activity
 * @link        https://www.zentao.net
 */
namespace zin;

$items   = array();
$items[] = array('name' => 'id',         'label' => $lang->idAB,                 'width' => '32px',  'control'  => 'index');
$items[] = array('name' => 'process',    'label' => $lang->activity->process,    'width' => '120px', 'control'  => array('control' => 'picker', 'required' => true), 'required' => true, 'items' => $processes);
$items[] = array('name' => 'name',       'label' => $lang->activity->name,       'width' => '240px', 'required' => true);
$items[] = array('name' => 'optional',   'label' => $lang->activity->optional,   'width' => '120px', 'control'  => array('control' => 'radioList', 'inline' => true), 'items' => array_filter($lang->activity->optionalList), 'value' => 'yes');
$items[] = array('name' => 'tailorNorm', 'label' => $lang->activity->tailorNorm, 'width' => '200px');

formBatchPanel
(
    to::heading(div
    (
        setClass('panel-title text-lg'),
        $lang->activity->batchEdit
    )),
    on::change('[data-name="optional"]', 'setTailorNorm'),
    set::onRenderRow(jsRaw('window.renderActivityRow')),
    set::mode('edit'),
    set::items($items),
    set::data(array_values($activities))
);
