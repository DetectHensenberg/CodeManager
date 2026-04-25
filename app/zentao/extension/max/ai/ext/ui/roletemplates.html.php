<?php
namespace zin;

function buildTemplateModal($lang) {
    return div(
        setClass('modal fade'),
        setData('backdrop', 'static'),
        setID('roleTemplateModal'),
        div(
            setClass('modal-dialog'),
            div(
                setClass('modal-content'),
                div(
                    setClass('modal-header'),
                    div(
                        setClass('modal-title flex items-center gap-1'),
                        span(setID('modalTitle'), $lang->ai->prompts->addRoleTemplate),
                        small(
                            setClass('text-gray hidden'),
                            setID('modalSubtitle'),
                            $lang->ai->prompts->editRoleTemplateTip
                        )
                    )
                ),
                div(
                    setClass('modal-actions'),
                    button(
                        setClass('btn square ghost'),
                        setData('dismiss', 'modal'),
                        span(setClass('close'))
                    )
                ),
                div(
                    setClass('modal-body'),
                    form(
                        setID('roleTemplateForm'),
                        setClass('not-watch'),
                        set::actions(array()),
                        formGroup(
                            set::label($lang->ai->prompts->role),
                            set::width('1/1'),
                            set::required(true),
                            input(
                                set::type('text'),
                                set::name('role'),
                                set::id('role'),
                                setClass('form-control'),
                                set::placeholder($lang->ai->prompts->rolePlaceholder)
                            )
                        ),
                        formGroup(
                            set::label($lang->ai->prompts->characterization),
                            set::width('1/1'),
                            set::required(true),
                            textarea(
                                set::name('characterization'),
                                set::id('characterization'),
                                setClass('form-control'),
                                set::rows(4),
                                set::placeholder($lang->ai->prompts->charPlaceholder)
                            )
                        ),
                        input(
                            set::type('hidden'),
                            set::name('id')
                        )
                    )
                ),
                div(
                    setClass('modal-footer flex justify-end'),
                    button(
                        setID('saveTemplate'),
                        setClass('btn primary'),
                        $lang->save
                    )
                )
            )
        )
    );
}

function buildTemplateList($roleTemplates, $lang) {
    return div(
        set::id('roleList'),
        setClass('flex col gap-2'),
        ...array_map(function($role) use ($lang) {
            return div(
                setClass('role-template'),
                setClass('border border-gray-300 rounded p-3 w-full'),
                div(
                    setClass('flex justify-between items-center gap-4'),
                    p(
                        setClass('text-ellipsis'),
                        set::title($role->role),
                        $role->role
                    ),
                    div(
                        setClass('flex gap-1'),
                        button(
                            setClass('btn ghost btn-apply'),
                            setData('role', $role->role),
                            setData('characterization', $role->characterization),
                            span(setClass('text-primary'), $lang->ai->apply)
                        ),
                        hasPriv('ai', 'roleTemplates') ? array(
                            button(
                                setClass('btn ghost square btn-edit'),
                                setData('id', $role->id),
                                setData('role', $role->role),
                                setData('characterization', $role->characterization),
                                icon(setClass('icon icon-edit text-primary'))
                            ),
                            button(
                                setClass('btn ghost square btn-delete'),
                                setData('id', $role->id),
                                icon(setClass('icon icon-trash text-primary'))
                            )
                        ) : null
                    )
                ),
                p(
                    setClass('text-gray-600 text-ellipsis py-1'),
                    set::title($role->characterization),
                    $role->characterization
                )
            );
        }, $roleTemplates)
    );
}

function buildTemplatePanel($lang, $roleTemplates = []) {
    return div(
        set::id('roleTemplate'),
        setClass('hidden'),
        div(
            setClass('flex gap-2 items-center w-full justify-between'),
            h4(
                setClass('flex gap-1 items-center'),
                span(
                    setClass('text-md'),
                    $lang->ai->prompts->roleTemplate
                ),
                icon(
                    setClass('icon icon-help'),
                    setData('toggle', 'tooltip'),
                    setData('placement', 'top'),
                    setData('title', $lang->ai->prompts->roleTemplateTip)
                )
            ),
            hasPriv('ai', 'roleTemplates') ? button(
                set::id('btnAddTemplate'),
                setClass('btn square ghost'),
                icon(setClass('icon icon-plus text-primary'))
            ) : null
        ),
        div(
            set::id('roleListContainer'),
            buildTemplateList($roleTemplates ?? [], $lang)
        )
    );
}
