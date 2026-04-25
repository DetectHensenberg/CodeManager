window.actionItemCreator = function(item, info)
{
    if(item.url)
    {
        if(typeof item.url == 'string') item.url = zui.formatString(item.url, info.row.data);
        else item.url.params = zui.formatString(item.url.params, info.row.data);
    }
    else if(item.disabled)
    {
        const report = info.row.data;
        if(item.icon == 'edit')
        {
            if(report.weeklyDate != '')
            {
                item.hint = disabledHint.cannotEditWeekly;
            }
            else if(report.reportModule == 'milestone')
            {
                item.hint = disabledHint.cannotEditMilestone;
            }
            else
            {
                item.hint = disabledHint.edit;
            }
        }
        if(item.icon == 'trash') item.hint = report.weeklyDate != '' ? disabledHint.cannotDeleteWeekly : disabledHint.cannotDeleteMilestone;
    }
    return item;
}

window.renderCell = function(result, info)
{
    const report = info.row.data;
    if(info.col.name == 'title' && result)
    {
        if(report.status == 'draft')
        {
            if(typeof result[0] == 'object') result[0].props.className = 'flex-auto clip';
            else result[0] = {html: `<div class='flex-auto clip'>${report.title}</div>`, className: 'flex-auto clip'};

            result[result.length] = {html: '<div class="label special-pale rounded-full ml-1 flex-none nowrap">' + draftText + '</div>', className: 'flex items-end', style: { flexDirection: "column" }};
        }

        if(typeof result[0] == 'object' && report.weeklyDate != '')
        {
            result[0].props.href = $.createLink('weekly', 'index', `projectID=${report.project}&date=${report.weeklyDate}`);
        }

        if(typeof result[0] == 'object' && report.reportModule == 'milestone')
        {
            result[0].props.href = $.createLink('milestone', 'index', `projectID=${report.project}`);
        }
    }
    return result;
}

window.confirmDeleteCategory = function(projectID, moduleID)
{
    $.get($.createLink('weekly', 'ajaxCheckDeleteCategory', `projectID=${projectID}&moduleID=${moduleID}`), function(result)
    {
        if(!result) return zui.Modal.alert(errorDeleteCategoryText);
        zui.Modal.confirm(confirmDeleteCategoryText).then((res) =>
        {
            if(res) $.ajaxSubmit({url: $.createLink('weekly', 'deleteCategory', `moduleID=${moduleID}`)});
        });
    })
}
