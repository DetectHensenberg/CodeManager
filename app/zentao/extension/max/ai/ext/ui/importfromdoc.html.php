<?php
namespace zin;

$spaces = array();

if(hasPriv('doc', 'myspace') && $type === 'my')
{
    $spaces['mine'] = $this->lang->ai->knowledgeLibs->spaces['mine'];
}

foreach($this->lang->ai->knowledgeLibs->spaces as $space => $name)
{
    if($space === 'mine') continue;

    if($space == 'api' && hasPriv('api', 'index')) $spaces[$space] = $name;
    if($space != 'api' && hasPriv('doc', ($space === 'custom' ? 'team' : $space) . 'Space')) $spaces[$space] = $name;
}

$defaultSpace = !empty($spaces) ? array_keys($spaces)[0] : '';

$acl        = $type === 'my' ? 'private' : 'default';
$aclOptions = $type === 'my'
    ? array(
        'private' => $lang->ai->knowledgeLibs->myPrivateAccess
    )
    : array(
        'default' => $lang->ai->knowledgeLibs->defaultAccess
    );

$labelWidth = common::checkNotCN() ? '150px' : '80px';

$aclFormRow = formRow(
    formGroup(
        set::label($lang->ai->knowledgeLibs->acl),
        set::labelWidth($labelWidth),
        set::control('radioList'),
        set::name('acl'),
        set::items($aclOptions),
        set::value($acl)
    )
);

$app->loadLang('api');
formPanel
(
    setID('importDocForm'),
    set::title($this->lang->ai->knowledgeLibs->importActions['doc']),
    set::submitBtnText($lang->import),
    on::init()->do('$(function() {setTimeout(toggleSpace, 50); });'),
    formGroup
    (
        set::name('space'),
        set::label($lang->ai->knowledgeLibs->selectedSpace),
        set::labelWidth($labelWidth),
        set::control(array('type' => 'radioList', 'inline' => true)),
        set::items($spaces),
        set::value($defaultSpace),
        on::change('[name=space]', 'toggleSpace')
    ),
    formGroup
    (
        setClass('api-type hidden'),
        set::label($lang->api->libType),
        set::labelWidth($labelWidth),
        radioList(set::name('apiType'), set::items($lang->api->libTypeList), set::value('product'), set::inline(true), on::change()->call('toggleApiType', jsRaw('event.target.value')))
    ),
    formGroup
    (
        setClass('specific-space'),
        set::label($lang->ai->knowledgeLibs->space),
        set::labelWidth($labelWidth),
        picker
        (
            set::name('importParentID'),
            set::items(array()),
            set::value(''),
            on::change('[name=importParentID]', 'toggleImportParentID')
        )
    ),
    formGroup
    (
        set::label($lang->ai->knowledgeLibs->selectedDocLibrary),
        set::labelWidth($labelWidth),
        picker
        (
            set::name('importID'),
            set::items(array()),
            set::value(''),
            on::change('[name=importID]', 'toggleImportID')
        )
    ),
    $aclFormRow,
    input(
        set::name('name'),
        set::value(''),
        set::type('hidden')
    )
);
