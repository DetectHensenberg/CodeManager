<?php
/**
 * The resolved view file of reviewissue module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yidong Wang <yidong@chandao.com>
 * @package     reviewissue
 * @link        https://www.zentao.net
 */
namespace zin;

modalHeader(set::title($lang->reviewissue->resolved), set::entityID($issue->id), set::entityText($issue->title));

$fields = $config->reviewissue->form->resolved;
formPanel
(
    formGroup
    (
        set::label($fields['resolution']['label']),
        picker(set::name('resolution'), set::items($lang->reviewissue->resolutionList), set::required($fields['resolution']['required']))
    )
);
