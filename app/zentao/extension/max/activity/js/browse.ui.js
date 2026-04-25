window.renderActivityCell = function(result, info)
{
    const {col, row} = info;
    if(col.name == 'order')
    {
        const canSort = this.options.orderBy.order == 'asc';
        result[0] = {html: "<i class='icon-move' title='" + (!canSort ? sortHint : '') + "'></i>", className: 'text-gray cursor-move move-process ' + (!canSort ? 'disabled' : '')};
    }

    if(col.name == 'actions')
    {
        if(!row.data?.hasDeliverable) return result;

        const actionItem = result[0]?.props?.items?.[1];
        if(actionItem && 'data-confirm' in actionItem) delete actionItem['data-confirm'];
    }
    return result;
};

window.onSortEnd = function(from, to, type)
{
    if(!from || !to) return false;

    const url  = $.createLink('activity', 'ajaxUpdateOrder');
    const form = new FormData();

    form.append('orders',   JSON.stringify(this.state.rowOrders));
    form.append('orderBy',  orderBy);

    $.ajaxSubmit({url, data:form});
    $.apps.updateAppUrl($.createLink('activity', 'browse', `groupID=${groupID}&browseType=${browseType}&param=${param}&orderBy=order_asc`));
    return true;
}

$(document).off('click', '[data-formaction]').on('click', '[data-formaction]', function () {
    const $this = $(this);
    if ($this.attr('class').indexOf('disabled') !== -1) return;

    const dtable = zui.DTable.query($('#activities'));
    const checkedList = dtable.$.getChecks();
    if (!checkedList.length) return;

    const postData = new FormData();
    checkedList.forEach((id) => postData.append('activityIdList[]', id));

    if ($this.data('page') == 'batch') {
        postAndLoadPage($this.data('formaction'), postData);
    }
    else {
        $.ajaxSubmit({ "url": $this.data('formaction'), "data": postData });
    }
});