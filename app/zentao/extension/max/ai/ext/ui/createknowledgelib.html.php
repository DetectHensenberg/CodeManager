<?php
namespace zin;

$isEdit = !empty($knowledgeLib);

$selectedGroups = array();
$selectedUsers  = array();
if($isEdit && !empty($knowledgeLib->groups)) $selectedGroups = array_filter(explode(',', trim($knowledgeLib->groups, ',')));
if($isEdit && !empty($knowledgeLib->users)) $selectedUsers = array_filter(explode(',', trim($knowledgeLib->users, ',')));

jsVar('isEdit', $isEdit);
jsVar('selectedGroups', $selectedGroups);
jsVar('selectedUsers', $selectedUsers);

if($isEdit)
{
    $name = $knowledgeLib->name;
    $desc = $knowledgeLib->desc;
    $acl  = $knowledgeLib->acl;
}
else
{
    $name = '';
    $desc = '';
    $acl  = $type === 'my' ? 'private' : 'open';
}

$aclOptions = array();
$importAclOptions = array();
if (!$isEdit || $knowledgeLib->importType == 'custom')
{
    $aclOptions = $type === 'my'
        ? array(
            'private' => $lang->ai->knowledgeLibs->myPrivateAccess
        )
        : array(
            'open'    => $lang->ai->knowledgeLibs->teamPublicAccess,
            'private' => $lang->ai->knowledgeLibs->teamPrivateAccess
        );
}
else
{
    $importAclOptions = $type === 'my'
        ? array(
            'default' => $lang->ai->knowledgeLibs->myPrivateAccess
        )
        : array(
            'default' => $knowledgeLib->importType == 'doclib' ? $lang->ai->knowledgeLibs->defaultAccess : $lang->ai->knowledgeLibs->teamPublicAccess
        );
}

$labelWidth = common::checkNotCN() ? '200px' : '100px';
$aclFormRow = null;

if(!empty($aclOptions))
{
    $aclFormRow = formRow(
        formGroup(
            set::label($lang->ai->knowledgeLibs->acl),
            set::labelWidth($labelWidth),
            set::control('radioList'),
            set::name('acl'),
            set::items($aclOptions),
            set::value($acl),
            on::change('toggleWhiteListBox')
        )
    );
}

$importAclFormRow = null;
if(!empty($importAclOptions))
{
    $importAclFormRow = formRow(
        formGroup(
            set::label($lang->ai->knowledgeLibs->acl),
            set::labelWidth($labelWidth),
            set::control('radioList'),
            set::name('acl'),
            set::items($importAclOptions),
            set::value('default')
        )
    );
}

$whiteListBox = null;
if(!empty($aclOptions) && in_array('private', array_keys($aclOptions)))
{
    $groups     = $this->loadModel('group')->getPairs();
    $groupItems = array();
    foreach($groups as $groupID => $groupName)
    {
        $groupItems[] = array('text' => $groupName, 'value' => $groupID, 'keys' => $groupName);
    }

    $users     = $this->loadModel('user')->getPairs('noletter|noempty|noclosed');
    $userItems = array();
    foreach($users as $account => $realname)
    {
        $userItems[] = array('text' => $realname, 'value' => $account, 'keys' => $realname);
    }

    $whiteListBoxClass = ($type == 'team' && $acl == 'private') ? '' : 'hidden';
    $extraClass        = common::checkNotCN() ? ' not-cn' : '';

    $whiteListBox = formRow(
        setID('whiteListBox'),
        setClass($whiteListBoxClass . $extraClass),
        formGroup(
            set::label($lang->ai->knowledgeLibs->whiteList),
            set::labelWidth($labelWidth),
            div(
                setClass('w-full check-list'),
                div(
                    setClass('w-full'),
                    inputGroup(
                        $lang->ai->knowledgeLibs->group,
                        picker(
                            set::name('groups[]'),
                            set::items($groupItems),
                            set::multiple(true),
                            set::value($selectedGroups)
                        )
                    )
                ),
                div(
                    setClass('w-full'),
                    userPicker(
                        set::label($lang->ai->knowledgeLibs->user),
                        set::items($userItems),
                        set::value($selectedUsers)
                    )
                )
            )
        )
    );
}

formPanel(
    set::id('createKnowledgeLibForm'),
    set::title($title),
    set::submitBtnText($lang->save),
    formRow(
        formGroup(
            set::label($lang->ai->knowledgeLibs->knowledgeLibName),
            set::labelWidth($labelWidth),
            set::name('name'),
            set::required(true),
            set::control(array('control' => 'input', 'maxlength' => 255)),
            set::value($name)
        )
    ),
    formRow(
        formGroup(
            set::label($lang->ai->knowledgeLibs->knowledgeLibDesc),
            set::labelWidth($labelWidth),
            set::control(array('control' => 'textarea', 'rows' => 4)),
            set::name('desc'),
            set::placeholder($lang->ai->knowledgeLibs->knowledgeLibDescPlaceholder),
            set::value($desc)
        )
    ),
    $aclFormRow,
    $importAclFormRow,
    $whiteListBox
);
