<?php
/**
 * The approval view file of project module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang <wangyuting@easycorp.ltd>
 * @package     project
 * @link        https://www.zentao.net
 */
namespace zin;

$cols = $config->review->admin->dtable->fieldList;
$cols['actions']['width'] = '60';
$cols['actions']['menu']  = array('edit');
$cols['actions']['list']['edit']['url']  = array('module' => 'project', 'method' => 'editApproval', 'params' => "projectID={$projectID}&flowID={id}");
foreach($cols as $key => $col) $cols[$key]['sortType'] = false;

if(!empty($cols['objectID'])) $cols['objectID']['map'] = $objectMap;
if(!empty($cols['flow']))     $cols['flow']['map'] = $approvals;

$reviews = initTableData($reviews, $cols, $this->project);

featureBar
(
    set::current('all'),
    set::linkParams("project={$projectID}")
);

dtable
(
    set::id('approvals'),
    set::cols($cols),
    set::data($reviews),
    set::userMap($users)
);
