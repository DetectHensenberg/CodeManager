<?php
/**
 * The batchCreate view file of reviewcl module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang <wangyuting@easycorp.ltd>
 * @package     reviewcl
 * @link        https://www.zentao.net
 */
namespace zin;

$items   = array();
$items[] = array('name' => 'id',         'label' => $lang->idAB,                 'width' => '32px',  'control'  => 'index');
$items[] = array('name' => 'objects',    'label' => $lang->reviewcl->object,     'width' => '120px', 'control'  => array('control' => 'picker', 'required' => false), 'required' => true, 'items' => $reviewPairs, 'value' => $object, 'ditto' => true, 'className' => 'hidden');
$items[] = array('name' => 'categories', 'label' => $lang->reviewcl->category,   'width' => '120px', 'control'  => 'picker', 'required' => true, 'items' => $categories);
$items[] = array('name' => 'titles',     'label' => $lang->reviewcl->title,      'width' => '240px', 'required' => true);

formBatchPanel
(
    to::heading(div
    (
        setClass('panel-title text-lg'),
        $lang->reviewcl->batchCreate,
        inputGroup
        (
            setClass('text-base font-medium'),
            span
            (
                setClass('input-group-addon form-label required'),
                $lang->reviewcl->object
            ),
            picker
            (
                setClass('w-40'),
                set::name('objects'),
                set::items($reviewPairs),
                set::value($object),
                setData(array('on' => 'change', 'call' => 'changeObjects'))
            )
        )
    )),
    set::items($items)
);
