window.onRenderCell = function(result, {row, col})
{
    if(col.name == 'baseline1')
    {
        if(row.data.baseline1 && !row.data.baseline2)
        {
            result[0].props.class += ' text-danger';
            result[0].props.style = {'text-decoration': 'line-through'};
        }
        if(row.data.baseline1 && row.data.baseline2 && row.data.baseline1 !== row.data.baseline2) result[0].props.class += ' text-warning';
    }
    if(col.name == 'baseline2')
    {
        if(row.data.baseline2 && !row.data.baseline1) result[0].props.class += ' text-success';
        if(row.data.baseline2 && row.data.baseline1 && row.data.baseline2 !== row.data.baseline1) result[0].props.class += ' text-warning';
    }
    return result;
}

window.showOnlyChanges = function(event)
{
    loadPage($.createLink('cm', 'diff', 'projectID=' + projectID + '&baseline=' + baseline + '&onlyChanges=' + $(event.target).prop('checked')));
}
