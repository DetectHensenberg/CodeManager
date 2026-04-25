window.getCellSpan = function(cell)
{
    if(!['stage', 'required'].includes(cell.col.name) && cell.row.data.rowspan)
    {
        return {rowSpan: cell.row.data.rowspan};
    }
}

window.onRenderCell = function(result, {row, col})
{
    if(result && col.name == 'actions')
    {
        if(row.data.builtin)
        {
            $.each(result[0].props.items, function(i, item)
            {
                if(!item.disabled) return;
                result[0].props.items[i].hint = builtinConfirm;
            });
        }
    }

    return result;
}
