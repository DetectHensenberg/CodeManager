window.renderProcessCell = function(result, info)
{
    if(info.col.name == 'sort')
    {
        result[0] = {html: "<i class='icon-move'></i>", className: 'text-gray cursor-move move-process'};
    }
    return result;
};

window.onSortEnd = function(from, to, type)
{
    if(!from || !to) return false;

    const url  = $.createLink('process', 'ajaxUpdateOrder');
    const form = new FormData();

    form.append('process', JSON.stringify(this.state.rowOrders));
    form.append('orderBy', orderBy);

    $.ajaxSubmit({url, data:form});
    $.apps.updateAppUrl($.createLink('process', 'browse', `groupID=${groupID}&browseType=${browseType}&param=${param}&orderBy=order_asc`));
    return true;
}

$(document).off('click', '[data-formaction]').on('click', '[data-formaction]', function () {
    const $this = $(this);
    if ($this.attr('class').indexOf('disabled') !== -1) return;

    const dtable = zui.DTable.query($('#processTable'));
    const checkedList = dtable.$.getChecks();
    if (!checkedList.length) return;

    const postData = new FormData();
    checkedList.forEach((id) => postData.append('processIdList[]', id));

    if ($this.data('page') == 'batch') {
        postAndLoadPage($this.data('formaction'), postData);
    }
    else {
        $.ajaxSubmit({ "url": $this.data('formaction'), "data": postData });
    }
});
