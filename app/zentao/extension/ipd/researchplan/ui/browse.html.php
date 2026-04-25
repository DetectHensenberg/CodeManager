<?php
/**
 * The browse view file of researchplan module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yidong Wang<yidong@chandao.net>
 * @package     researchplan
 * @link        https://www.zentao.net
 */
namespace zin;

featureBar
(
    set::linkParams("projectID=$projectID"),
    li(searchToggle(set::module('researchplan'), set::open(strtolower($browseType) == 'bysearch')))
);


if(hasPriv('researchplan', 'create')) $createItem = array('icon' => 'plus', 'class' => 'primary', 'text' => $lang->researchplan->create, 'url' => $this->createLink('researchplan', 'create', "projectID={$projectID}"));
toolbar
(
    !empty($createItem) ? item(set($createItem)) : null
);

$tableData = initTableData($planList, $config->researchplan->dtable->fieldList, $this->researchplan);
dtable
(
    set::cols($config->researchplan->dtable->fieldList),
    set::data($tableData),
    set::orderBy($orderBy),
    set::sortLink(createLink('researchplan', 'browse', "projectID={$projectID}&browseType={$browseType}&param=0&orderBy={name}_{sortType}"))
);
