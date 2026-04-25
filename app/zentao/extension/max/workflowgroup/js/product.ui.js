window.renderCell = function(result, info)
{
    if(info.col.name == 'name' && result)
    {
        const group = info.row.data;
        let html = '';
        if(group.main == '1') html += "<span class='label gray-pale rounded-xl'>" + buildinLang + "</span>";
        if(html) result.push({html});
    }
    else if(info.col.name == 'status' && result)
    {
        const rowData = info.row.data;
        if(rowData.status == 'wait') result[0].props.class = 'status-draft';
    }
    return result;
};
