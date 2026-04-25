<?php
/**
 * The ganttsetting view file of execution module of ZenTaoPMS.
 *
 * @copyright   Copyright 2026 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@chandao.com>
 * @package     execution
 * @version     $Id: editrelation.html.php 935 2024-08-08 15:14:24Z $
 * @link        https://www.zentao.net
 */
namespace zin;

modalHeader(set::title($lang->execution->ganttSetting));

formPanel
(
    formGroup
    (
        set::name('zooming'),
        set::label($lang->execution->gantt->format),
        set::value($zooming ? $zooming : 'day'),
        set::control(['control' => 'radioList', 'inline' => true]),
        set::items($lang->execution->gantt->zooming)
    ),
    formGroup
    (
        set::name('ganttFields[]'),
        set::label($lang->customField),
        set::value(explode(',', $showFields)),
        set::control(['control' => 'checkList', 'inline' => true]),
        set::items($customFields)
    )
);
