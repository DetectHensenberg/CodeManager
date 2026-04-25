window.refreshApproval = function()
{
    $.getJSON($.createLink('review', 'ajaxGetApproval'), function(data)
    {
        $('[name=flow]').zui('picker').render({items: data})
    });
}
