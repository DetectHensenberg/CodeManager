<?php
/**
 * The batchEdit view file of auditplan module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang <wangyuting@easycorp.ltd>
 * @package     auditplan
 * @link        https://www.zentao.net
 */
namespace zin;

$items = array();
$items[] = array('label' => $lang->idAB,                'name' => 'resultID', 'control' => 'input', 'hidden' => true);
$items[] = array('label' => $lang->idAB,                'name' => 'listID',   'control' => 'input', 'hidden' => true);
$items[] = array('label' => $lang->auditplan->content,  'name' => 'title',    'control' => 'textarea', 'readonly' => true);
$items[] = array('label' => $lang->auditplan->result,   'name' => 'result',   'control' => array('control' => 'radioList', 'inline' => true), 'value' => 'pass', 'items' => $lang->auditplan->resultList);
$items[] = array('label' => $lang->auditplan->comment,  'name' => 'comment',  'control' => 'textarea');
$items[] = array('label' => $lang->auditplan->severity, 'name' => 'severity', 'control' => 'picker', 'items' => array_filter($lang->nc->severityList));
$items[] = array('label' => $lang->auditplan->status,   'name' => 'status',   'control' => 'input', 'hidden' => true, 'value' => 'normal');

if($checkList)
{
    formBatchPanel
    (
        on::change('[data-name="result"]', 'changeResult'),
        set::onRenderRow(jsRaw('renderRowData')),
        set::ajax(array('beforeSubmit' => jsRaw('clickSubmit'))),
        set::actions
        (
            array
            (
                array('text' => $lang->save,                 'data-status' => 'normal', 'class' => 'primary',   'btnType' => 'submit'),
                array('text' => $lang->auditplan->saveDraft, 'data-status' => 'draft',  'class' => 'secondary', 'btnType' => 'submit')
            )
        ),
        set::title($lang->auditplan->check),
        set::mode('edit'),
        set::data(array_values($checkList)),
        set::items($items)
    );
}
else
{
    $tips = $auditplan->objectType == 'zoutput' ? $lang->auditplan->outputTip : $lang->auditplan->noCheckList;
    formPanel
    (
        set::actions(''),
        set::title($lang->auditplan->check),
        div(setClass('h-32 center'), $tips)
    );
}
