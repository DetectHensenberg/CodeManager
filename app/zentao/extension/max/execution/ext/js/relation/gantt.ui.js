window.renderCell = function(result, {row, col})
{
    if(col.name == 'type' && result) result[1]['attrs']['title'] = typeHintList[row.data.type];
    return result;
}

window.handleBatchBtnClick = function(btn)
{
    const $btn = $(btn);
    const dtable = zui.DTable.query($btn);
    const checkedList = dtable.$.getChecks();
    if(!checkedList.length) return;

    const url  = $btn.data('url');
    const form = new FormData();
    checkedList.forEach((id) => form.append('relationIdList[]', id));

    if($btn.hasClass('batchDeleteBtn'))
    {
        zui.Modal.confirm({message: confirmBatchDelete, icon: 'icon-exclamation-sign', iconClass: 'warning-pale rounded-full icon-2x'}).then((res) => {if(res) $.ajaxSubmit({url, data:form});});
    }
    else
    {
        postAndLoadPage(url, form);
    }
};
