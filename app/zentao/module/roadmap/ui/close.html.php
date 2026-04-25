<?php
/**
 * The close view file of roadmap module of ZenTaoPMS.
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
    to::heading
    (
        entityLabel
        (
            set::entityID($roadmap->id),
            set::text($roadmap->name)
        )
    ),
    formGroup
    (
        set::label($lang->roadmap->closedReason),
        set::name('closedReason'),
        set::items($lang->roadmap->reasonList),
        set::width('1/3'),
        set::required()
    ),
    formGroup
    (
        set::label($lang->comment),
        set::control('editor'),
        set::name('comment')
    )
);
