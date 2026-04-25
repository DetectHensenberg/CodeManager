<?php
/**
 * The create view file of workflowgroup module of ZenTaoPMS.
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Gang Liu <liugang@chandao.com>
 * @package     workflowgroup
 * @link        https://www.zentao.net
 */
namespace zin;
$ipdTypeList = $defaultTypeList = array();
foreach($lang->workflowgroup->ipdTypeList     as $groupType => $label) $ipdTypeList[]     = array('text' => $label, 'value' => $groupType);
foreach($lang->workflowgroup->defaultTypeList as $groupType => $label) $defaultTypeList[] = array('text' => $label, 'value' => $groupType);

jsVar('ipdTypeList', $ipdTypeList);
jsVar('defaultTypeList', $defaultTypeList);

$fields = defineFieldList('workflowgroup.create');
$fields->field('name')->control('input')->width('1/2')->required();
if($type == 'project')
{
    $fields->field('projectModel')->control('picker')->width('1/2')->items($lang->workflowgroup->projectModelList)->value('scrum')->required();
    $fields->field('projectType')->control('picker')->width('1/2')->items($lang->workflowgroup->defaultTypeList)->value('product')->required();
}
$fields->field('desc')->control(['control' => 'textarea', 'rows' => 3]);

formPanel
(
    on::change('[name^=projectModel]', 'window.changeProjectModel'),
    set::labelWidth($type == 'product' ? '80px' : '120px'),
    set::title($type == 'product' ? $lang->workflowgroup->createProduct : $lang->workflowgroup->createProject),
    set::fields($fields),
    set::submitBtnText($lang->save)
);

render();
