<?php
namespace zin;

jsVar('groupID', $groupID);
jsVar('designModule', $designModule);

unset($stageList['lifecycle']);
formGridPanel
(
    set::title($lang->deliverable->createTitle),
    set::modeSwitcher(false),
    on::click('.btn-add', 'addRow'),
    on::click('.btn-delete', 'deleteRow'),
    on::change('[name^="stage"]', 'disableItems'),
    on::change('[name="activity"]', 'changeActivity'),
    on::change('[name="trimmable"]', 'changeTrimmable'),
    on::change('[name="module"]', 'changeModule'),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->deliverable->module),
        picker
        (
            set::name('module'),
            set::items($modules),
            set::value($moduleID)
        )
    ),
    formGroup(set::width('1/2')),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->deliverable->name),
        set::name('name')
    ),
    formGroup(set::width('1/2')),
    formGroup
    (
        set::width('full'),
        set::label($lang->deliverable->desc),
        editor
        (
            set::name('desc')
        )
    ),
    formGroup
    (
        set::label($lang->deliverable->template),
        set::width('full'),
        deliverable
        (
            set::formName('template'),
            set::items(array(array('category' => $this->lang->other))),
            set::extraCategory($lang->other),
            set::isTemplate(true)
        )
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->deliverable->activity),
        $hasProcess ?  '' : set::hidden(true),
        inputGroup
        (
            picker
            (
                set::name('activity'),
                set::items($activities),
                !$hasProcess ? set::value($otherActivity->id) : null
            ),
            common::hasPriv('activity', 'create') ? btnGroup(item(set(array
            (
                'text' => $lang->deliverable->addActivity,
                'icon' => 'plus',
                'data-toggle' => 'modal',
                'url' => createLink('activity', 'create', "groupID=$groupID&processID=0&from=deliverable"),
                'class' => 'primary-pale btn ml-1'
            )))) : null
        )
    ),
    formGroup
    (
        set::width('full'),
        set::label($lang->deliverable->trimmable),
        set::labelHint($lang->deliverable->trimableNotice),
        $hasProcess ? '' : set::hidden(true),
        radioList
        (
            set::name('trimmable'),
            set::value($hasProcess ? '0' : $otherActivity->optional),
            set::items($lang->deliverable->trimmableList)
        ),
        input(setClass('hidden'), set::name('trimmable'), set::id('trimmable'), set::value('1'), set::disabled(true))
    ),
    formGroup
    (
        set::width('full'),
        set::label($lang->deliverable->trimRule),
        $hasProcess ? '' : set::hidden(true),
        input
        (
            set::name('trimRule'),
            set::disabled(true)
        )
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->deliverable->when),
        set::required(true),
        set::id('stage1'),
        picker
        (
            set::name('stage[]'),
            set::items($stageList),
            set::value('project')
        )
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->deliverable->required),
        set::id('required1'),
        picker
        (
            set::required(true),
            set::name('required[]'),
            set::value('1'),
            set::items($lang->deliverable->requiredList)
        ),
        btnGroup(setClass('flex self-center'), item(set(array
        (
            'icon' => 'plus',
            'class' => 'ghost btn-add'
        ))), item(set(array
        (
            'icon' => 'trash',
            'class' => 'ghost invisible btn-delete'
        ))))
    )
);
