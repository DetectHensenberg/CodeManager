window.getCellSpan = function(cell)
{
    if(!['stage', 'required'].includes(cell.col.name) && cell.row.data.rowspan)
    {
        return {rowSpan: cell.row.data.rowspan};
    }
}