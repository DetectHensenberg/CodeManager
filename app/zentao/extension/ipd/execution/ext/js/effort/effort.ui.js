window.renderCell = function(result, info)
{
    const data = info.row.data;
    if(info.col.name == 'objectTitle')
    {
        if(data.objectType != 'custom')
        {
            result[0] =  data.objectTitle ? {html : `<a href="${$.createLink(data.objectType, 'view', 'id=' + data.objectID)}">${data.objectTitle}</a>`} : '';
        }
    }
    return result;
}