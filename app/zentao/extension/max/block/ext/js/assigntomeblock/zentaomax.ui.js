/**
 * 合并单元格。
 * cell span in the column.
 *
 * @param  object cell
 * @access public
 * @return object
 */
window.getCellSpan = function(cell)
{
    if(!['executionBuild', 'productName'].includes(cell.col.name) && cell.row.data.trowspan)
    {
        return {rowSpan: cell.row.data.trowspan};
    }

    if(['productName'].includes(cell.col.name) && cell.row.data.prowspan)
    {
        return {rowSpan: cell.row.data.prowspan};
    }
}

window.onRenderCell = function(result, {row, col})
{
    if(result && col.name == 'name' && row.data.joint == 1)
    {
        result.push({html: "<i class='icon icon-code-fork'></i>"});
    }
    return result;
}
