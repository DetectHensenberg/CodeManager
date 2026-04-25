window.changeProcess = function(e)
{
    const processID = e.target.value;
    const link = $.createLink('auditcl', 'ajaxGetActivities', 'groupID=' + groupID + '&processID=' + processID);
    $.getJSON(link, function(data)
    {
        $('[name="objectID"]').zui('picker').render({items: data});
        $('[name="objectID"]').zui('picker').$.setValue('');
    })
}