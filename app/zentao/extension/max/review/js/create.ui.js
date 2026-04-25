window.waitDom(".category-picker .picker-select", function()
{
    changeDeliverableCategory();
});

window.changeType = function(e)
{
    const type = $(e.target).val();

    const url = $.createLink('review', 'create', `project=${projectID}&deliverable=${deliverableID}&reviewID=${reviewID}&type=${type}`);
    loadCurrentPage({url: url});
}

window.changeDeliverableCategory = function()
{
    const categoryID = $("[name='object']").val();

    const url = $.createLink('review', 'ajaxGetDeliverables', `project=${projectID}&category=${categoryID}&deliverable=${deliverableID}&reviewID=${reviewID}`);
    $.getJSON(url, function(data)
    {
        const deliverablePicker = $("[name='deliverable']").zui('picker');
        deliverablePicker.render({items: data.items});
        deliverablePicker.$.setValue(data.deliverable);
    });
}
