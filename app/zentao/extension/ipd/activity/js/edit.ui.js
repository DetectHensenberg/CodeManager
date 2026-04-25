window.clickSubmit = function()
{
    if($("input[name='optional'][value='yes']").prop('checked'))
    {
        return zui.Modal.confirm(editConfirm).then(result => result);
    }
}
