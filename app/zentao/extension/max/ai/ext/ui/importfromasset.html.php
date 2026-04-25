<?php
namespace zin;

$assets = array();

foreach($this->lang->ai->knowledgeLibs->assets as $asset => $name)
{
    if(hasPriv('assetlib', $asset . 'Lib')) $assets[$asset] = $name;
}

$defaultAssetType = !empty($assets) ? array_keys($assets)[0] : '';

$acl        = $type === 'my' ? 'private' : 'default';
$aclOptions = $type === 'my'
    ? array(
        'private' => $lang->ai->knowledgeLibs->myPrivateAccess
    )
    : array(
        'default' => $lang->ai->knowledgeLibs->teamPublicAccess
    );

$labelWidth = common::checkNotCN() ? '126px' : '80px';

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

formPanel(
    set::id('importFromAssetForm'),
    set::title($this->lang->ai->knowledgeLibs->importActions['asset']),
    set::submitBtnText($lang->import),
    on::init()->do('$(function() {setTimeout(toggleAssetType, 50); });'),
    formRow(
        formGroup(
            set::label($lang->ai->knowledgeLibs->selectedAssetType),
            set::labelWidth($labelWidth),
            picker
            (
                set::name('assetType'),
                set::items($assets),
                set::value($defaultAssetType),
                on::change('[name=assetType]', 'toggleAssetType')
            )
        )
    ),
    formRow(
        formGroup(
            set::label($lang->ai->knowledgeLibs->selectedAssetLib),
            set::labelWidth($labelWidth),
            picker
            (
                set::name('importID'),
                set::items(array()),
                set::value('')
            )
        )
    ),
    $aclFormRow
);
