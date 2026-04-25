window.getCellSpan = function(cell)
{
    if(cell.col.name === 'process' && cell.row.data.processCount) return {rowSpan: cell.row.data.processCount};
    if(cell.col.name === 'activity' && cell.row.data.activityCount) return {rowSpan: cell.row.data.activityCount};
    if(cell.col.name === 'deliverableType' && cell.row.data.deliverableTypeCount) return {rowSpan: cell.row.data.deliverableTypeCount};
}

window.scrollToProcess = function({event, item})
{
    event.preventDefault();

    const processID = item.key;
    const myDTable  = zui.DTable.query('#table-project-deliverablechecklist');
    const theFirstRowMatchTheClickProcess = myDTable.$.layout.rows.find(x => x.data.process === processID);
    myDTable.$.scroll({scrollTop: theFirstRowMatchTheClickProcess.top});
}
