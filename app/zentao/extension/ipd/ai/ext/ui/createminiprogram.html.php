<?php
namespace zin;

jsVar('iconCheck', $config->ai->miniPrograms->iconCheck);
jsVar('iconName', $iconName);
jsVar('iconTheme', $iconTheme);
jsVar('themeList', $config->ai->miniPrograms->themeList);
jsVar('iconList', $config->ai->miniPrograms->iconList);

div(setClass('create-miniprogram'), formPanel
(
    to::heading
    (
        div(
            set::className('flex gap-2 items-center w-full max-w-2xl mx-auto'),
            div(
                set::className('panel-title text-lg'),
                $lang->ai->miniPrograms->configuration
            ),
            div(
                set::className('flex gap-1 items-center'),
                h::i(setClass('icon icon-help text-warning')),
                div(
                    set::className('text-gray'),
                    $lang->ai->miniPrograms->downloadTip
                ),
                a(
                    set::className('text-primary'),
                    set::href('https://www.zentao.net/page/download.html'),
                    set::target('_blank'),
                    '>>' . $lang->ai->miniPrograms->download
                )
            )
        )
    ),
    set::id('miniprogram-form'),
    set::actions(
        array(
            array('text' => $lang->goback, 'class' => 'toolbar-item btn open-url', 'url' => helper::createLink('ai', 'miniPrograms')),
            array('text' => $lang->save, 'class' => 'btn secondary', 'id' => 'save-miniprogram', 'btnType' => 'submit'),
            array('text' => $lang->ai->nextStep, 'class' => 'btn primary', 'id' => 'next-step', 'btnType' => 'submit')
        )
    ),
    formGroup
    (
        set::label($lang->ai->miniPrograms->category),
        set::width('1/2'),
        set::required(true),
        select
        (
            set::name('category'),
            set::items(array_merge($lang->ai->miniPrograms->categoryList, $categoryList)),
            set::value(!empty($category) ? $category : ''),
            set::required(true)
        )
    ),
    formGroup
    (
        set::label($lang->prompt->model),
        set::width('1/2'),
        set::required(true),
        div
        (
            setClass('w-full'),
            zui::AIModelPicker
            (
                set::name('model'),
                set::required(true),
                set::value(!empty($model) ? $model : '')
            )
        )
    ),
    formGroup
    (
        set::label($lang->prompt->name),
        set::required(true),
        input
        (
            set::name('name'),
            set::value(!empty($name) ? $name : ''),
            set('maxlength', 16),
            set::placeholder($lang->ai->miniPrograms->placeholder->name),
            set::required(true)
        )
    ),
    formGroup
    (
        set::label($lang->ai->miniPrograms->desc),
        set::required(true),
        textarea
        (
            set::name('desc'),
            set::value(!empty($desc) ? $desc : ''),
            set::rows(3),
            set::placeholder($lang->ai->miniPrograms->placeholder->desc),
            set::required(true)
        )
    ),
    formGroup
    (
        set::label($lang->ai->miniPrograms->icon),
        set::width('1/2'),
        set::hight('50px'),
        button
        (
            setID('ai-edit-icon'),
            setClass('btn btn-icon group '),
            setStyle(array(
                'border' => "1px solid {$config->ai->miniPrograms->themeList[$iconTheme][1]}",
                'background-color' => $config->ai->miniPrograms->themeList[$iconTheme][0],
            )),
            html($config->ai->miniPrograms->iconList[$iconName]),
            div
            (
                setID('edit-icon'),
                html($config->ai->miniPrograms->iconEdit)
            )
        )
    ),
    input
    (
        set::name('iconName'),
        set::type('hidden'),
        set::value($iconName)
    ),
    input
    (
        set::name('iconTheme'),
        set::type('hidden'),
        set::value($iconTheme)
    ),
    input
    (
        set::name('toNext'),
        set::type('hidden')
    )
));

$ai = $config->ai;

div(
    setClass('modal fade'),
    setData('backdrop', 'static'),
    setID('icon-modal'),
    div(
        setClass('modal-dialog shadow size-sm bd-none'),
        div(
            setClass('modal-content'),
            div(
                setClass('modal-header items-center'),
                span
                (
                    setStyle(array(
                        'font-size' => '20px',
                        'font-weight' => 'bold',
                    )),
                    $lang->ai->miniPrograms->iconModification
                ),
                span
                (
                    setClass('text-muted'),
                    'Emoji icons by Twemoji with CC-BY4.0'
                )
            ),
            div
            (
                setClass('modal-actions'),
                button
                (
                    setClass('btn square ghost'),
                    setData('dismiss', 'modal'),
                    span
                    (
                        setClass('close')
                    )
                )
            ),
            div(
                setClass('modal-body'),
                div
                (
                    setStyle(array(
                        'display' => 'flex',
                        'gap' => '42px',
                    )),
                    div
                    (
                        setClass('icon-preview-container p-1'),
                        button(setID('preview-icon'), setClass('btn btn-icon'), setStyle(array(
                            'width' => '46px',
                            'height' => '46px',
                            'border-radius' => '50%',
                        )))
                    ),
                    div
                    (
                        setClass('icon-setting-container'),
                        div
                        (
                            setClass('mb-4'),
                            $lang->ai->miniPrograms->customBackground
                        ),
                        div
                        (
                            setID('theme-buttons'),
                            setStyle(
                                array(
                                    'display' => 'flex',
                                    'gap' => '20px',
                                    'width' => '400px'
                                )
                            ),
                            array_map(function ($theme, $index) use ($iconTheme, $ai) {
                                return button
                                (
                                    setClass('btn btn-icon'),
                                    setStyle(array(
                                        'border' => "1px solid {$theme[1]}",
                                        'background-color' => $theme[0],
                                    )),
                                    set::bg($theme[0]),
                                    set::bd($theme[1]),
                                    set::index($index),
                                    html($ai->miniPrograms->iconCheck)
                                );
                            }, $config->ai->miniPrograms->themeList, array_keys($config->ai->miniPrograms->themeList))
                        ),
                        div
                        (
                            setClass('mt-6'),
                            div
                            (
                                setClass('mb-4'),
                                $lang->ai->miniPrograms->customIcon
                            ),
                            div
                            (
                                setID('icon-buttons'),
                                array_map(function ($icon) {
                                    return html($icon);
                                }, $config->ai->miniPrograms->iconList)
                            )
                        )
                    )
                )
            ),
            div(
                setClass('modal-footer flex items-center justify-center'),
                btn(
                    setID('save-icon-button'),
                    setClass('btn btn-wide primary'),
                    setData('dismiss', 'modal'),
                    $lang->save
                )
            )
        )
    )
);
