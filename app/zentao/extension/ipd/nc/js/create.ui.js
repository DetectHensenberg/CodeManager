window.changeExecution = function(e)
{
    const executionID = e.target.value;
    const url         = $.createLink('nc', 'ajaxGetAuditplan', `projectID=${projectID}&executionID=${executionID}`);
    $.getJSON(url, function(data)
    {
        $('[name="auditplan"]').zui('picker').render({items: data});
        $('[name="auditplan"]').zui('picker').$.setValue('');
    });

    $('[name="listID"]').zui('picker').render({items: []});
    $('[name="listID"]').zui('picker').$.setValue('');
}

window.changeAuditplan = function(e)
{
    const auditplanID = e.target.value;
    const url         = $.createLink('nc', 'ajaxGetCheckList', `auditplanID=${auditplanID}`);
    $.getJSON(url, function(data)
    {
        $('[name="listID"]').zui('picker').render({items: data});
        $('[name="listID"]').zui('picker').$.setValue('');
    });
}

window.changeObjectType = function(e)
{
    const type     = $(e.target).val();
    const objectID = from == 'execution' ? executionID : projectID;
    const url      = $.createLink('nc', 'create', `project=${objectID}&auditplanID=${auditplanID}&from=${from}&type=${type}`)
    loadCurrentPage({url: url});
}
