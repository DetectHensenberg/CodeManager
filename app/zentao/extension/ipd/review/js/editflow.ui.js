window.refreshApproval = function()
{
    $.getJSON($.createLink('review', 'ajaxGetApproval', 'workflow=' + workflow), function(data)
    {
        $('[name=flow]').zui('picker').render({items: data})
    });
}
