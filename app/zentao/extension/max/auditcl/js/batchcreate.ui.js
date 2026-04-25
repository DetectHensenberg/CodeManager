window.addTitle = function(titleID, own)
{
    var titleObj = "title-" + titleID;
    var titleHtml = $(own).closest('.' + titleObj).html();
    $(own).parent().after("<div class='" + titleObj +" item flex activity-title'>" + titleHtml + "</div>");
}

window.delTitle = function(titleID)
{
    if($(titleID).parent().parent().children().length == 1) return false;
    $(titleID).parent().remove();
}

$(document).ready(function()
{
    $('form').on('submit', function(e)
    {
        e.preventDefault();

        $.ajax(
        {
            type: 'POST',
            url: $.createLink('auditcl', 'batchCreate', `groupID=${groupID}`),
            data: $('#batchCreateForm').serialize(),
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
                $('#batchCreateForm').find('button[type="submit"]').removeAttr('disabled');
            }
        });
    });
});