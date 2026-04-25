/**
 * 产品列合并单元格。
 * Merge cell in the product column.
 *
 * @param  object cell
 * @access public
 * @return object
 */
window.getCellSpan = function(cell)
{
    if(!['buildName', 'productName', 'executionName'].includes(cell.col.name) && cell.row.data.trowspan)
    {
        return {rowSpan: cell.row.data.trowspan};
    }

    if(['productName'].includes(cell.col.name) && cell.row.data.prowspan)
    {
        return {rowSpan: cell.row.data.prowspan};
    }
}

/**
 * 产品列显示展开收起的图标。
 * Display show icon in the product column.
 *
 * @param  object result
 * @param  object info
 * @access public
 * @return object
 */
window.onRenderCell = function(result, {row, col})
{
    if(result && col.name == 'name' && row.data.joint == 1)
    {
        result.push({html: "<i class='icon icon-code-fork'></i>"});
    }
    if(result && col.name == 'idName' && row.data.hidden)
    {
        result.push({outer: false, style: {alignItems: 'center', justifyContent: 'start'}})
    }
    if(col.name == 'status' && result)
    {
        result[0] = {html: `<span class='status-${row.data.rawStatus}'>` + row.data.status + "</span>"};
    }

    return result;
}
