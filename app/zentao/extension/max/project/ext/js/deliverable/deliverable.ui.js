window.onRenderCell = function (result, { row, col })
{
    if(result[0] && col.name == 'actions')
    {
        if (typeof result[0]?.props?.items == 'object')
        {
            result[0].props.items.map(item => {

                /* 已经通过的交付物再建评审要从头发起。*/
                if(item.icon == 'sub-review' && row.data.rawStatus == 'pass')
                {
                    item.url = $.createLink('review', 'create', `projectID=${row.data.project}&deliverable=${row.data.id}&reviewID=0&type=deliverable&objectID=0&from=deliverable`);
                }

                if(row.data.hasApproval == 0 && item.icon == 'sub-review')
                {
                    item.icon = 'ok';
                    item.hint = updateVersionLang;
                }

                if(item.icon != 'edit') return;
                if(row.data.editLink && !row.data.frozen)
                {
                    item.url = row.data.editLink;
                    if(row.data.linkAttr == 'blank')
                    {
                        item.target = '_blank';
                        delete item['data-toggle'];
                    }
                }
                else
                {
                    if(row.data.frozen) item.hint = deliverableFrozenTips;
                    item.disabled = true;
                }
            });
        }
    }

    if(col.name == 'status')
    {
        const label = result[0].props.children;

        result[0] = {html: `<span class="status-${row.data.rawStatus}">${label}</span>`}

        if(row.data.approval > 0 && canViewProgress)
        {
            const progressLink = $.createLink('approval', 'progress', `id=${row.data.approval}`);
            result[0].html += `<a href="${progressLink}" data-toggle="modal" class="btn item text-primary toolbar-item square size-sm ghost" title="${viewApprovalProgress}"><i class="icon icon-list-alt"></i></a>`;
        }
    }

    return result;
}
