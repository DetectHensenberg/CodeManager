window.docSpaces = {}; // 可选空间
window.docLibs   = {}; // 可选文档库

/* 切换空间类型 */
window.toggleSpace = () => {
    const $form  = $('#importDocForm');
    const picker = $form.find('[name="importParentID"]').zui('picker');
    const space  = $form.find('input[name="space"]:checked').val();

    const $importIdPicker = $('[name="importID"]').zui('picker');
    $importIdPicker.$.setValue('');
    $importIdPicker.render({items: []});

    picker.render({items: []});
    picker.$.setValue('');
    $('[name="apiType"]').val('product');
    $('.api-type').toggleClass('hidden', space != 'api');
    $('.specific-space').removeClass('hidden');

    window.docSpaces = {};

    if(space == 'api')
    {
        const apiType = $('[name="apiType"]').val();
        $('.specific-space').toggleClass('hidden', apiType == 'nolink');
        $.getJSON($.createLink('ai', 'ajaxGetApiSpaces', 'type=product'), function(data)
        {
            data.forEach(space => {
                window.docSpaces[space.value] = space.text;
            });
            picker.render({items: data});
        });
    }
    else
    {
        $.getJSON($.createLink('doc', 'ajaxGetSpaceData', 'space=' + space), function(libs)
        {
            const spaces = (libs?.spaces || []).map(space =>
            {
                window.docSpaces[space.id] = space.name;
                return {text: space.name, value: space.id};
            });
            picker.render({items: spaces});
        });
    }
};

/* 切换 API 类型 */
window.toggleApiType = function(apiType)
{
    const $importIdPicker = $('[name="importID"]').zui('picker');

    $importIdPicker.$.setValue('');
    $importIdPicker.render({items: []});
    $('.specific-space').toggleClass('hidden', apiType == 'nolink');

    if(apiType != 'nolink')
    {
        window.docSpaces = {};
        const $detailedSpacePicker = $('[name="importParentID"]').zui('picker');
        $.getJSON($.createLink('ai', 'ajaxGetApiSpaces', `type=${apiType}`), function(data)
        {
            data.forEach(space => {
                window.docSpaces[space.value] = space.text;
            });
            $detailedSpacePicker.$.setValue('');
            $detailedSpacePicker.render({items: data});
        });
    }
    else
    {
        window.docLibs = {};
        $.getJSON($.createLink('ai', 'ajaxGetDocLibs', `space=api&id=0&type=${apiType}`), function(libs)
        {
            libs.forEach(lib => {
                window.docLibs[lib.value] = lib.text;
            });
            $importIdPicker.render({items: libs});
        });
    }
}

/* 选择空间 */
window.toggleImportParentID = () => {
    const $form          = $('#importDocForm');
    const picker         = $form.find('[name="importID"]').zui('picker');
    const space          = $form.find('input[name="space"]:checked').val();
    const importParentID = $form.find('[name="importParentID"]').val();
    const type           = space == 'api' ? $('[name="apiType"]:checked').val() : '';

    picker.render({items: []});
    picker.$.setValue('');

    window.docLibs = {};

    $.getJSON($.createLink('ai', 'ajaxGetDocLibs', `space=${space}&id=${importParentID}&type=${type}`), function(libs)
    {
        libs.forEach(lib => {
            window.docLibs[lib.value] = lib.text;
        });
        picker.render({items: libs});
    });
};

/* 选择文档库 */
window.toggleImportID = () => {
    const $form          = $('#importDocForm');
    const space          = $form.find('input[name="space"]:checked').val();
    const importParentID = $form.find('[name="importParentID"]').val();
    const importID       = $form.find('[name="importID"]').val();

    // 生成知识库名称
    let name = window.docLibs[importID] || '';
    if(['product', 'project'].includes(space) && window.docSpaces[importParentID] && window.docLibs[importID])
    {
        name = `${window.docSpaces[importParentID]} ${window.docLibs[importID]}`;
    }

    $form.find('[name="name"]').val(name);
};
