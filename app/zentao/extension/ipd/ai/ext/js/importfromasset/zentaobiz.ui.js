window.toggleAssetType = () => {
    const $form     = $('#importFromAssetForm');
    const $picker   = $form.find('[name="importID"]');
    const picker    = $picker.zui('picker');
    const assetType = $form.find('[name="assetType"]').val();

    picker.render({items: []});
    picker.$.setValue('');

    $.getJSON($.createLink('ai', 'ajaxGetAssetLibs', 'assetType=' + assetType), function(assetLibs)
    {
        $picker.zui('picker').render({items: assetLibs});
    });
};