<?php
/**
 * The nc view file of auditplan module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang <wangyuting@easycorp.ltd>
 * @package     auditplan
 * @link        https://www.zentao.net
 */
namespace zin;

unset($config->auditplan->nc->dtable->fieldList['type']);
unset($config->auditplan->nc->dtable->fieldList['resolvedDate']);
$ncs = initTableData($ncs, $config->auditplan->nc->dtable->fieldList, $this->auditplan);

modalHeader(set::title($title));
dtable
(
    set::data($ncs),
    set::cols(array_values($config->auditplan->nc->dtable->fieldList)),
    set::userMap($users)
);
