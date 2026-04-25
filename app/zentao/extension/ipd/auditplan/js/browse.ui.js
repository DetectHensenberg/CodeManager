$(document).off('click', '.batch-btn').on('click', '.batch-btn', function()
{
    const dtable = zui.DTable.query($(this).target);
    const checkedList = dtable.$.getChecks();
    if(!checkedList.length) return;

    const url  = $(this).data('url');
    const form = new FormData();
    checkedList.forEach((id) => form.append('auditplanIdList[]', id));

    postAndLoadPage(url, form);
});


window.onRenderCell = function(result, {row, col})
{
    if(result && col.name == 'checkDate' && row.data.delay)
    {
        result[0] = {html: '<span class="text-danger">' + row.data.checkDate + '</span>'};
    }
    return result;
};
