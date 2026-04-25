<?php
/**
 * The setDocBasic view file of doc module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun <sunguangming@easycorp.ltd>
 * @package     doc
 * @link        https://www.zentao.net
 */
namespace zin;

if(!empty($doc->builtIn)) unset($lang->reporttemplate->aclList['private']);

$acl = zget($doc, 'acl', 'open');
formPanel
(
    setID('setDocBasicForm'),
    set::title($mode == 'create' ? $lang->reporttemplate->create : $lang->settings),
    set::submitBtnText($lang->save),
    formRow
    (
        formGroup
        (
            set::width('1/2'),
            set::label($lang->reporttemplate->lib),
            set::required(true),
            picker(set::name('lib'), set::items($scopeList), set::value($libID), set::readonly(true), set::required(true))
        ),
        formGroup
        (
            set::width('1/2'),
            set::label($lang->reporttemplate->module),
            set::required(true),
            picker(set::name('module'), set::items($modules), set::value($moduleID), set::required(true))
        )
    ),
    formGroup
    (
        set::label($lang->reporttemplate->objects),
        inputGroup
        (
            div(setClass('w-full'), picker(set::name('objects'), set::items($objects), set::multiple(true), set::value(zget($doc, 'objects', '')), set::disabled(!isset($doc->objects) || $doc->objects == 'all'))),
            div
            (
                setClass('input-group-addon flex'),
                checkbox
                (
                    set::name('allProject'),
                    set::text($lang->reporttemplate->allProject),
                    set::checked(!isset($doc->objects) || $doc->objects == 'all'),
                    on::change('toggleObjectsBox')
                )
            )
        )
    ),
    $mode == 'create' ? formGroup
    (
       set::label($lang->reporttemplate->title),
       set::name('title'),
       set::value(zget($doc, 'title', '')),
       set::required(true)
    ) : null,
    formGroup
    (
        set::label($lang->reporttemplate->desc),
        textarea(set::name('templateDesc'), set::rows(3), set::value(zget($doc, 'templateDesc', '')))
    ),
    formGroup
    (
        set::label($lang->reporttemplate->acl),
        radioList
        (
            set::name('acl'),
            set::items($lang->reporttemplate->aclList),
            set::value($acl),
            on::change('toggleWhiteList')
        )
    ),
    formGroup
    (
        setID('whiteListBox'),
        setClass($acl == 'open' ? 'hidden' : ''),
        set::label($lang->doc->whiteList),
        div
        (
            setClass('w-full check-list'),
            inputGroup
            (
                setClass('w-full'),
                $lang->doc->groupLabel,
                picker
                (
                    set::name('groups'),
                    set::items($groups),
                    set::value(zget($doc, 'groups', '')),
                    set::multiple(true)
                )
            ),
            div
            (
                setClass('w-full'),
                userPicker(set::label($lang->doc->userLabel), set::items($users), set::value(zget($doc, 'users', '')))
            )
        )
    )
);
