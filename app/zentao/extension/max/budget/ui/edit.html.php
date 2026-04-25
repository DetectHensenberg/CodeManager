<?php
/**
 * The edit view of budget module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.cnezsoft.com)
 * @license     ZPL(http://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun<sunguangming@chandao.com>
 * @package     budget
 * @link        http://www.zentao.net
 */
namespace zin;

formPanel
(
    set::title($lang->budget->edit . $lang->budget->common),
    set::url(createLink('budget', 'edit', "id=$budget->id")),
    set::modeSwitcher(false),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->budget->stage),
        set::name('stage'),
        set::items($plans),
        set::value($budget->stage),
        set::required(true)
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->budget->subject),
        set::name('subject'),
        set::items($subjects),
        set::value($budget->subject),
        set::required(true)
    ),
    formGroup(set::width('1/2'), set::label($lang->budget->amount), set::name('amount'), set::value($budget->amount)),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->budget->name),
        set::name('name'),
        set::value($budget->name),
        set::required(true)
    ),
    formGroup
    (
        set::label($lang->budget->desc),
        set::name('desc'),
        set::value($budget->desc),
        set::control('editor')
    )
);
