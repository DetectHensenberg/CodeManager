<?php
/**
 * The editCategory view file of weekly module of ZenTaoPMS.
 * @copyright   Copyright 2009-2025 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Shujie Tian <tianshujie@chandao.com>
 * @package     weekly
 * @link        https://www.zentao.net
 */
namespace zin;

formPanel
(
    detailHeader
    (
        to::title
        (
            entityLabel
            (
                setClass('text-xl font-black'),
                set::level(1),
                set::text($lang->weekly->editCategory)
            )
        )
    ),
    setID('editForm'),
    set::submitBtnText($lang->save),
    formGroup
    (
        set::required(true),
        set::name('name'),
        set::label($lang->weekly->categoryName),
        set::control('input'),
        set::value($category->name)
    )
);
