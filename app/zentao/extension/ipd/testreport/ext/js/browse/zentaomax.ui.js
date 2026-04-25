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
    if(!['execution'].includes(cell.col.name) && cell.row.data.trowspan)
    {
        return {rowSpan: cell.row.data.trowspan};
    }
}
