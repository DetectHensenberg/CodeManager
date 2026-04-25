<?php
/**
 * The cron view file of reporttemplate module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yidong Wang <yidong@chandao.com>
 * @package     reporttemplate
 * @link        https://www.zentao.net
 */
namespace zin;

$turnon = zget($cycleConfig, 'turnon', 'off');
$acl    = zget($cycleConfig, 'acl', 'open');

$frequencyList = array();
foreach($lang->reporttemplate->cronFrequencyList as $type => $name) $frequencyList[$type] = $name . ' ' . $lang->reporttemplate->cronFrequencyTips[$type];

tabs
(
    pageCSS('.unsetPosition {position: unset !important;}'),
    tabPane
    (
        set::key('set_cron'),
        set::title($lang->reporttemplate->cronTitle),
        set::active(true),
        formPanel
        (
            set::layout('grid'),
            set::actionsClass('unsetPosition'),
            set::submitBtnText($lang->save),
            formGroup
            (
                set::width('full'),
                set::label($lang->reporttemplate->cronTurnon),
                radioList
                (
                    set::name('turnon'),
                    set::inline(true),
                    set::items($lang->reporttemplate->cronTurnonList),
                    set::value($turnon),
                    on::change('toggleCron')
                )
            ),
            formGroup
            (
                setID('frequencyBox'),
                setClass($turnon == 'off' ? 'hidden' : ''),
                set::width('full'),
                set::label($lang->reporttemplate->cronFrequency),
                radioList(set::name('frequency'), set::items($frequencyList), set::value(zget($cycleConfig, 'frequency', 'week')))
            ),
            formGroup
            (
                setID('aclBox'),
                setClass($turnon == 'off' ? 'hidden' : ''),
                set::width('full'),
                set::label($lang->reporttemplate->reportAcl),
                radioList
                (
                    set::name('acl'),
                    set::items($lang->doc->aclList),
                    set::value($acl),
                    on::change('toggleWhiteList')
                )
            ),
            formGroup
            (
                setID('readListBox'),
                setClass(($turnon == 'off' || $acl == 'open') ? 'hidden' : ''),
                set::width('full'),
                set::label($lang->doc->readonly),
                div
                (
                    setClass('w-full check-list'),
                    inputGroup
                    (
                        setClass('w-full'),
                        $lang->doc->groupLabel,
                        picker
                        (
                            set::name('readGroups[]'),
                            set::items($groups),
                            set::value(zget($cycleConfig, 'readGroups', '')),
                            set::multiple(true)
                        )
                    ),
                    div
                    (
                        setClass('w-full'),
                        userPicker(set::label($lang->doc->userLabel), set::name('readUsers[]'), set::items($users), set::value(zget($cycleConfig, 'readUsers', '')))
                    )
                )
            ),
            formGroup
            (
                setID('whiteListBox'),
                setClass(($turnon == 'off' || $acl == 'open') ? 'hidden' : ''),
                set::label($lang->doc->editable),
                set::width('full'),
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
                            set::value(zget($cycleConfig, 'groups', '')),
                            set::multiple(true)
                        )
                    ),
                    div
                    (
                        setClass('w-full'),
                        userPicker
                        (
                            set::label($lang->doc->userLabel),
                            set::name('users[]'),
                            set::items($users),
                            set::value(zget($cycleConfig, 'users', ''))
                        )
                    )
                )
            )
        )
    ),
    tabPane
    (
        set::key('log'),
        set::title($lang->reporttemplate->cronLog),
        empty($cronLogs) ? div(setClass('dtable-empty-tip'), $lang->noData) : h::ul
        (
            setClass('list-none'),
            h::li(setClass('text-gray mb-1'), $lang->reporttemplate->notice->logLimit),
            array_map(function($log){ return h::li(html($log->date . ' ' . $log->result)); }, $cronLogs)
        )
    )
);
