<?php
/**
 * The edit view file of review module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Shujie Tian <tianshujie@easycorp.ltd>
 * @package     review
 * @link        https://www.zentao.net
 */
namespace zin;
$content = array();
$files   = null;

if($review->type == 'deliverable')
{
    $content[] = formGroup
    (
        set::label($lang->review->object),
        set::width('1/2'),
        setClass('category-picker'),
        picker
        (
            set::name('object'),
            set::items($categories),
            set::value($review->category),
            set::disabled(true),
            set::required(true)
        )
    );

    $content[] = formGroup
    (
        set::label($lang->review->deliverable),
        set::width('1/2'),
        setClass('deliverable-picker'),
        picker
        (
            set::name('deliverable'),
            set::items($deliverables),
            set::value($review->deliverable),
            set::required(true),
            set::disabled(true)
        )
    );
}
elseif($review->type == 'decision')
{
    $content[] = formGroup
    (
        set::label($lang->review->object),
        set::width('1/2'),
        picker
        (
            set::name('object'),
            set::items($objectList),
            set::value($review->category),
            set::disabled(true)
        )
    );

    $content[] = formGroup
    (
        set::label($lang->review->deliverables),
        set::width('1/2'),
        picker
        (
            set::name('deliverables'),
            set::menu(array('checkbox' => true)),
            set::items($deliverables),
            set::value(array_keys($review->deliverables)),
            set::disabled(true),
            set::multiple(true)
        )
    );

    $files = formGroup
    (
        set::label($lang->files),
        fileSelector
        (
            set::name('files'),
            set::defaultFiles($review->files)
        )
    );
}

formPanel
(
    set::title($lang->review->edit),
    formHidden('product', $review->product),
    formGroup
    (
        set::label($lang->review->type),
        set::width('1/2'),
        set::required(true),
        setClass('type-picker'),
        picker
        (
            set::name('type'),
            set::items($lang->review->typeList),
            set::disabled(true),
            set::value($review->type)
        )
    ),
    $content,
    formGroup
    (
        set::label($lang->review->version),
        set::width('1/2'),
        set::name('version'),
        set::value($review->version),
        set::className($review->type == 'decision' ? 'hidden' : ''),
        set::required(false),
        set::disabled(true)
    ),
    formGroup
    (
        set::label($lang->review->deadline),
        set::width('1/2'),
        set::control('datePicker'),
        set::name('deadline'),
        set::value($review->deadline)
    ),
    $files,
    formGroup
    (
        set::label($lang->review->comment),
        set::name('comment'),
        set::control('editor')
    )
);
