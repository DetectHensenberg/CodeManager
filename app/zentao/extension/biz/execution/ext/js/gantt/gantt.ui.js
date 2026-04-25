window.clickAutoSchedule = function()
{
    const minBuffering = $('.scheduleBox input[name=minBuffering]').val();
    $.getJSON($.createLink('execution', 'ajaxAutoScheduleForTask', `executionID=${executionID}&minBuffering=${minBuffering}`), function(response)
    {
        if(response.result == 'success')
        {
            zui.Messager.show({
                message: response.message,
                type: 'success',
                close: true
            });
            loadPage($.createLink('execution', 'gantt', `execution=${executionID}`));
        }
        else
        {
            zui.Modal.alert(response.message);
        }
    })
}
