window.refreshApproval = function()
{
    $.getJSON($.createLink('review', 'ajaxGetApproval', 'workflow=' + workflow), function(data)
    {
        $('[name=flow]').zui('picker').render({items: data})
    });
}

window.refreshDesignLink = function(e)
{
    var flow = e.target.value;
    var link = $.createLink('approvalflow', 'design', 'id=' + flow);
    $('a.designLink').attr('href', link);
}
