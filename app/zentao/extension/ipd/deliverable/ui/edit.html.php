<?php
namespace zin;

if(!in_array('lifecycle', array_keys($deliverable->stages))) unset($stageList['lifecycle']);

$i = 1;
foreach($deliverable->stages as $stage => $required)
{
    $invisible = $i == 1 ? 'invisible' : '';
    $stageGroup[] = formGroup
    (
        set::width('1/2'),
        $i == 1 ? set::label($lang->deliverable->when) : '',
        set::required(true),
        set::id("stage{$i}"),
        picker
        (
            set::name('stage[]'),
            set::items($stageList),
            set::value($stage)
        )
    );

    $stageGroup[] = formGroup
    (
        set::width('1/2'),
        $i == 1 ? set::label($lang->deliverable->required) : '',
        set::id("required{$i}"),
        picker
        (
            set::required(true),
            set::name('required[]'),
            set::value($required),
            set::items($lang->deliverable->requiredList)
        ),
        btnGroup(setClass("flex self-center"), item(set(array
        (
            'icon' => 'plus',
            'class' => 'ghost btn-add'
        ))), item(set(array
        (
            'icon' => 'trash',
            'class' => "ghost {$invisible} btn-delete"
        ))))
    );

    $i++;
}

formGridPanel
(
    set::title($lang->deliverable->editTitle),
    set::modeSwitcher(false),
    on::click('.btn-add', 'addRow'),
    on::click('.btn-delete', 'deleteRow'),
    on::change('[name^="stage"]', 'disableItems'),
    on::change('[name="activity"]', 'changeActivity'),
    on::change('[name="trimmable"]', 'changeTrimmable'),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->deliverable->module),
        picker
        (
            set::name('module'),
            set::value($deliverable->module),
            set::items($modules),
            set::disabled(!empty($deliverable->systemList))
        )
    ),
    formGroup(set::width('1/2')),
    formGroup
    (
        set::disabled(in_array($deliverable->category, array('PP', 'SRS', 'ITTC', 'STTC', 'unittest', 'feature', 'intergrate', 'system', 'smoke', 'bvt')) || !empty($deliverable->builtin)),
        set::width('1/2'),
        set::label($lang->deliverable->name),
        set::value($deliverable->name),
        set::name('name')
    ),
    formGroup(set::width('1/2')),
    formGroup
    (
        set::width('full'),
        set::label($lang->deliverable->desc),
        editor
        (
            set::value($deliverable->desc),
            set::name('desc')
        )
    ),
    formGroup
    (
        set::label($lang->deliverable->template),
        set::width('full'),
        set::hidden(!empty($deliverable->systemList)),
        deliverable
        (
            set::formName('template'),
            set::items($deliverable->template),
            set::extraCategory($lang->other),
            set::isTemplate(true)
        )
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->deliverable->activity),
        set::required(true),
        $hasProcess ? '' : set::hidden(true),
        picker
        (
            set::name('activity'),
            set::value($deliverable->activity),
            set::items($activities)
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
            set::value($deliverable->trimmable),
            set::items($lang->deliverable->trimmableList),
            set::disabled($activity && $activity->optional == 'yes')
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
            set::value($deliverable->trimRule),
            set::disabled($deliverable->trimmable == '0')
        )
    ),
    $stageGroup
);
