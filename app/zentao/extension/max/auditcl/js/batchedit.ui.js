$(document).ready(function()
{
    $('form').on('submit', function(e)
    {
        e.preventDefault();

        $.ajax(
        {
            type: 'POST',
            url: $.createLink('auditcl', 'batchEdit', `groupID=${groupID}`),
            data: $('#batchEditForm').serialize(),
            dataType: 'json',
            success: data =>
            {
                if(data.result == 'success')
                {
                    window.location.href = data.load;
                }
                else
                {
                    zui.Modal.alert(data.message)
                }
            },
            complete: () =>
            {
                $('#batchEditForm').find('button[type="submit"]').removeAttr('disabled');
            }
        });
    });
});