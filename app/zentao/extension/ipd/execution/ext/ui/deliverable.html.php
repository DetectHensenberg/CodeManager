<?php
namespace zin;

formPanel
(
    set::layout('grid'),
    set::actions(array('submit')),
    formGroup
    (
        set::label($this->lang->project->deliverableList['close'] . ($execution->status == 'closed' ? '' : $this->lang->execution->whenClosedTips)),
        set::width('full'),
        set::strong(true),
        deliverable
        (
            set::formName('deliverable'),
            set::items($deliverables),
            set::categories($categories),
            set::projectID($execution->project),
            set::createDocUrl($createDocUrl),
            set::uploadDocUrl($uploadDocUrl)
        )
    )
);

if(!empty($actions))
{
    history
    (
        setClass('panel panel-form size-lg is-lite'),
        set::commentBtn(''),
        set::editCommentUrl('')
    );
}
