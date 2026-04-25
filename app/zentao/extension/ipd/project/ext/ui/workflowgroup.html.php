<?php
namespace zin;

if($group->objectID == 0)
{
    formPanel
    (
        set::title($lang->project->workflowGroup),
        set::headingClass('justify-start'),
        set::bodyClass('px-0'),
        set::actions(array('submit')),
        set::submitBtnText($lang->confirm),
        formGroup
        (
            setStyle(array('align-items' => 'center', 'margin-left' => '-1rem')),
            set::label(''),
            set::labelWidth('80px'),
            sprintf($lang->project->toggleGroupTips[0], $group->name)
        ),
        formGroup
        (
            setStyle(array('align-items' => 'center')),
            set::label('1.'),
            set::labelWidth('80px'),
            $lang->project->toggleGroupTips[1]
        ),
        formGroup
        (
            setStyle(array('align-items' => 'center')),
            set::label('2.'),
            set::labelWidth('80px'),
            $lang->project->toggleGroupTips[2]
        ),
        formGroup
        (
            setStyle(array('align-items' => 'center')),
            set::label('3.'),
            set::labelWidth('80px'),
            $lang->project->toggleGroupTips[3]
        )
    );
}
else
{
    $hasPriv = hasPriv('workflowgroup', 'design');
    $hint    = !$hasPriv ? $lang->error->accessDenied : '';
    formPanel
    (
        set::title($lang->project->workflowGroup),
        set::headingClass('justify-start'),
        set::bodyClass('px-0'),
        set::actions(array('settings' => array('text' => $lang->settings, 'url' => $this->createLink('workflowGroup', 'design', "id={$group->id}") . '#app=admin', 'class' => 'primary', 'target' => '_blank', 'disabled' => !$hasPriv, 'hint' => $hint))),
        formGroup
        (
            setStyle(array('align-items' => 'center', 'margin-left' => '-1rem')),
            set::label(''),
            set::labelWidth('80px'),
            sprintf($lang->project->settingGroupTips[0], $group->name)
        ),
        formGroup
        (
            setStyle(array('align-items' => 'center')),
            set::label('1.'),
            set::labelWidth('80px'),
            $lang->project->settingGroupTips[1]
        ),
        formGroup
        (
            setStyle(array('align-items' => 'center')),
            set::label('2.'),
            set::labelWidth('80px'),
            $lang->project->settingGroupTips[2]
        ),
        formGroup
        (
            setStyle(array('align-items' => 'center')),
            set::label('3.'),
            set::labelWidth('80px'),
            $lang->project->settingGroupTips[3]
        )
    );
}
