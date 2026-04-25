window.renderCellCallback = function (result, { row, col })
{
    if(result[0] && col.name == 'actions')
    {
        if (typeof result[0]?.props?.items == 'object')
        {
            result[0].props.items.map(item => {

                if(item.icon != 'edit') return;
                if(row.data.type == 'baseline')
                {
                    if(canEditCM) item.url = $.createLink('cm', 'edit', `id=${row.data.object}`);
                    else item.disabled = true;
                }
                else if(row.data.type == 'projectchange')
                {
                    if(canEditChange) item.url = $.createLink('projectchange', 'edit', `id=${row.data.object}`);
                    else item.disabled = true;
                }
            });
        }
    }

    return result;
}