window.toggleSpace = () => {
    const $form  = $('#addDocForm');
    const picker = $form.find('[name="libParentID"]').zui('picker');
    const space  = $form.find('input[name="space"]:checked').val();
    const dtable = zui.DTable.query($('#docSelectTable'));

    const $libIdPicker = $('[name="libID"]').zui('picker');
    $libIdPicker.$.setValue('');
    $libIdPicker.render({items: []});

    $('.btns-type .btn.active .label').text(0);
    dtable.render({data: []});
    picker.render({items: []});
    picker.$.setValue('');
    $('[name="apiType"]').val('product');
    $('.api-type').toggleClass('hidden', space != 'api');
    $('.specific-space').removeClass('hidden');

    if(space == 'api')
    {
        const apiType = $('[name="apiType"]').val();
        $('.specific-space').toggleClass('hidden', apiType == 'nolink');
        $.getJSON($.createLink('ai', 'ajaxGetApiSpaces', 'type=product'), function(data)
        {
            picker.render({items: data});
        });
    }
    else
    {
        $.getJSON($.createLink('doc', 'ajaxGetSpaceData', 'space=' + space), function(libs)
        {
            const spaces = (libs?.spaces || []).map(space => ({text: space.name, value: space.id}));
            picker.render({items: spaces});
        });
    }
};

window.toggleApiType = function(apiType)
{
    const $libIdPicker = $('[name="libID"]').zui('picker');
    const dtable       = zui.DTable.query($('#docSelectTable'));
    dtable.render({data: []});
    $('.btns-type .btn.active .label').text(0);
    $libIdPicker.$.setValue('');
    $libIdPicker.render({items: []});

    $('.specific-space').toggleClass('hidden', apiType == 'nolink');
    if(apiType != 'nolink')
    {
        const $detailedSpacePicker = $('[name="libParentID"]').zui('picker');
        $.getJSON($.createLink('ai', 'ajaxGetApiSpaces', `type=${apiType}`), function(data)
        {
            $detailedSpacePicker.$.setValue('');
            $detailedSpacePicker.render({items: data});
        });
    }
    else
    {
        $.getJSON($.createLink('ai', 'ajaxGetDocLibs', `space=api&id=0&type=${apiType}`), function(libs)
        {
            $libIdPicker.render({items: libs});
        });
    }
}

window.toggleLibParentID = () => {
    const $form       = $('#addDocForm');
    const picker      = $form.find('[name="libID"]').zui('picker');
    const space       = $form.find('input[name="space"]:checked').val();
    const libParentID = $form.find('[name="libParentID"]').val();
    const dtable      = zui.DTable.query($('#docSelectTable'));
    const type        = space == 'api' ? $('[name="apiType"]:checked').val() : '';

    $('.btns-type .btn.active .label').text(0);
    dtable.render({data: []});
    picker.render({items: []});
    picker.$.setValue('');

    if(!libParentID) return;

    $.getJSON($.createLink('ai', 'ajaxGetDocLibs', `space=${space}&id=${libParentID}&type=${type}`), function(libs)
    {
        picker.render({items: libs});
    });
};

 $('.btns-type .btn[data-id="all"]').addClass('active');
window.toggleLibID = () => {
    const $form  = $('#addDocForm');
    const dtable = zui.DTable.query($('#docSelectTable'));
    const libID  = $form.find('[name="libID"]').val();
    const space  = $form.find('input[name="space"]:checked').val();
    const type   = $('.btns-type .btn.active').data('id');

    $('.btns-type .btn.active .label').text(0);
    if(!libID) return;

    dtable.render({data: []});
    $.getJSON($.createLink('ai', 'ajaxGetDoc', `libID=${libID}&space=${space}&browseType=${type}`), function(docs)
    {
        $('.btns-type .btn.active .label').text(docs?.length || 0);
        dtable.render({data: docs});
    });
};

window.toggleBrowseType = function(browseType, event)
{
    $(event).closest('.btns-type').find('.btn').removeClass('active');
    $(event).closest('.btns-type').find('.label').addClass('hidden');
    $(event).addClass('active');

    const $form  = $('#addDocForm');
    const dtable = zui.DTable.query($('#docSelectTable'));
    const libID  = $form.find('[name="libID"]').val();
    const space  = $form.find('input[name="space"]:checked').val();
    const $label = $(event).find('.label');
    if(!libID || !space)
    {
        $label.text(0);
        $label.removeClass('hidden');
        return;
    };

    dtable.render({data: []});
    $.getJSON($.createLink('ai', 'ajaxGetDoc', `libID=${libID}&space=${space}&browseType=${browseType}`), function(docs)
    {
        dtable.render({data: docs});
        $label.text(docs?.length || 0);
        $label.removeClass('hidden');
    });
}

window.renderDocCell = function(result, {row, col})
{
    if(col.name == 'title')
    {
        let url = $.createLink('doc', 'view', `docID=${row.data.id}&version=${row.data.version}`);
        if(!!row.data?.protocol) url = $.createLink('api', 'view', `libID=${row.data.lib}&apiID=${row.data.id}&moduleID=${row.data.module}`);

        result[0] ={html: `<a href="${url}" class="text-link" data-toggle="modal" data-size="lg">${row.data.title}</a>`};
        return result;
    }
    return result;
}
