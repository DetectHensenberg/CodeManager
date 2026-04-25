<?php
/**
 * The result view file of auditplan module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang <wangyuting@easycorp.ltd>
 * @package     auditplan
 * @link        https://www.zentao.net
 */
namespace zin;

$results = initTableData($results, $config->auditplan->result->dtable->fieldList, $this->auditplan);

modalHeader(set::title($title));
dtable
(
    set::data($results),
    set::cols(array_values($config->auditplan->result->dtable->fieldList)),
    set::userMap($users)
);
