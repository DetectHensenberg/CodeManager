<?php
/**
 * The ajaxSetBasic view file of weekly module of ZenTaoPMS.
 * @copyright   Copyright 2009-2025 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Shujie Tian <tianshujie@chandao.com>
 * @package     weekly
 * @link        https://www.zentao.net
 */
namespace zin;

$aclClass = common::checkNotCN() ? 'isNotCN' : '';
formPanel
(
    setID('setDocBasicForm'),
    set::title(empty($report) ? $lang->weekly->create : $lang->settings),
    set::submitBtnText($lang->save),
    on::change('[name=acl]')->call('toggleWhiteList', jsRaw('event')),
    formGroup
    (
        set::label($lang->weekly->module),
        set::required(true),
        set::name('reportModule'),
        set::items($modules),
        set::value($module)
    ),
    empty($report) ? formGroup
    (
       set::label($lang->weekly->title),
       set::name('title'),
       set::required(true)
    ) : null,
    formGroup
    (
        set::label($lang->weekly->desc),
        textarea(set::name('templateDesc'), set::rows(3), set::value(isset($report) ? $report->templateDesc : ''))
    ),
    formGroup
    (
        set::label($lang->weekly->acl),
        radioList
        (
            set::name('acl'),
            set::items($lang->weekly->aclList),
            set::value(isset($report) ? $report->acl : 'open'),
            on::change('toggleWhiteList')
        )
    ),
    formGroup
    (
        setID('readListBox'),
        setClass((isset($report) && $report->acl == 'private') ? $aclClass : "hidden {$aclClass}"),
        set::label($lang->weekly->readonly),
        div
        (
            setClass('w-full check-list'),
            inputGroup
            (
                setClass('w-full'),
                $lang->weekly->groupLabel,
                picker
                (
                    set::name('readGroups[]'),
                    set::items($groups),
                    set::value(isset($report) ? $report->readGroups : null),
                    set::multiple(true)
                )
            ),
            div
            (
                setClass('w-full'),
                userPicker
                (
                    set::label($lang->weekly->userLabel),
                    set::name('readUsers[]'),
                    set::items($users),
                    set::value(isset($report) ? $report->readUsers : null)
                )
            )
        )
    ),
    formGroup
    (
        setID('whiteListBox'),
        setClass((isset($report) && $report->acl == 'private') ? $aclClass : "hidden {$aclClass}"),
        set::label($lang->weekly->editable),
        div
        (
            setClass('w-full check-list'),
            inputGroup
            (
                setClass('w-full'),
                $lang->weekly->groupLabel,
                picker
                (
                    set::name('groups[]'),
                    set::items($groups),
                    set::value(isset($report) ? $report->groups : null),
                    set::multiple(true)
                )
            ),
            div
            (
                setClass('w-full'),
                userPicker
                (
                    set::label($lang->weekly->userLabel),
                    set::name('users[]'),
                    set::items($users),
                    set::value(isset($report) ? $report->users : null)
                )
            )
        )
    )
);
