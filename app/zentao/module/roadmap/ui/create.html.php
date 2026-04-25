<?php
/**
 * The edit view file of roadmap module of ZenTaoPMS.
 *
 * @copyright   Copyright 2026 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@chandao.com>
 * @package     roadmap
 * @version     $Id: editrelation.html.php 935 2024-08-08 15:14:24Z $
 * @link        https://www.zentao.net
 */
namespace zin;

formPanel
(
    set::title($lang->roadmap->edit),
    set::size('md'),
    $branches ? formGroup
    (
        set::label(sprintf($lang->roadmap->branch, $lang->product->branchName[$product->type])),
        set::name('branch'),
        set::width('1/2'),
        set::items($branches)
    ) : null,
    formGroup
    (
        set::label($lang->roadmap->name),
        set::name('name'),
        set::width('1/2')
    ),
    formGroup
    (
        set::label($lang->roadmap->begin),
        set::name('begin'),
        set::width('1/2'),
        set::control('date')
    ),
    formGroup
    (
        set::label($lang->roadmap->end),
        set::name('end'),
        set::width('1/2'),
        set::control('date')
    ),
    formGroup
    (
        set::label($lang->roadmap->desc),
        set::name('desc'),
        set::control('editor')
    )
);
