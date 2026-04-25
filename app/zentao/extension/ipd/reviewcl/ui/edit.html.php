<?php
/**
 * The edit file of reviewcl module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     reviewcl
 * @link        https://www.zentao.net
 */
namespace zin;

formPanel
(
    set::layout('horz'),
    entityLabel(to::prefix($lang->reviewcl->edit), set(array('entityID' => $reviewcl->id, 'level' => 1, 'text' => $reviewcl->title))),
    formGroup
    (
        set::label($lang->reviewcl->object),
        set::name('object'),
        set::required(true),
        set::items($reviewPairs),
        set::value($reviewcl->object)
    ),
    formGroup
    (
        set::label($lang->reviewcl->category),
        set::name('category'),
        set::required(true),
        set::items($categories),
        set::value($reviewcl->category)
    ),
    formGroup
    (
        set::label($lang->reviewcl->title),
        set::name('title'),
        set::value($reviewcl->title)
    )
);
