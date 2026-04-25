window.changeModule = function(e)
{
    const module = e.target.value;
    const url    = $.createLink('deliverable', 'ajaxGetModelList', `type=${module}`);

    let $methodPicker = $('[name="method"]').zui('picker');
    //$methodPicker.render({disabled: true});
    //$methodPicker.$.setValue(module == 'execution' ? 'close' : 'create');

    $.getJSON(url, function(data)
    {
        let $modelPicker = $('.modelBox .picker-box').zui('picker');
        $modelPicker.render({items: data});
        $modelPicker.$.setValue('');
    });
}

window.changeActivity = function(e)
{
    $('input[name="trimmable"][type="radio"]').removeAttr('disabled');

    const activity = e.target.value || 0;
    const url      = $.createLink('deliverable', 'ajaxGetActivityOptional', `activity=${activity}`);

    $.get(url, function(data)
    {
        if(data == '1')
        {
            $('#trimmable').removeAttr('disabled');
            $('input[name="trimmable"][type="radio"]').attr('disabled', 'disabled');
            $('input[name="trimmable"][value="1"]').prop('checked', true);
            $('[type=radio][name=trimmable]').closest('.radio-primary').addClass('disabled');
            $('[type=radio][name=trimmable]').closest('.check-list').addClass('disabled');

            $('input[name=trimRule]').removeAttr('disabled');
        }
        else if(data == '0')
        {
            $('#trimmable').attr('disabled', 'disabled');
            $('input[name="trimmable"][value="0"]').prop('checked', true);
            $('[type=radio][name=trimmable]').closest('.radio-primary').removeClass('disabled');
            $('[type=radio][name=trimmable]').closest('.check-list').removeClass('disabled');

            $('input[name=trimRule]').val('').attr('disabled', 'disabled');
        }
    });
}

window.changeTrimmable = function(e)
{
    const trimmable = e.target.value;
    if(trimmable == '1')
    {
        $('input[name=trimRule]').removeAttr('disabled');
    }
    else
    {
        $('input[name=trimRule]').val('').attr('disabled', 'disabled');
    }
}
