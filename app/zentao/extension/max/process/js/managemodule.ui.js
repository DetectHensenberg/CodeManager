window.handleRenderRow = function($row, index, row)
{
    if(typeof row != 'undefined' && row.count > 0)
    {
        $row.find('[data-type="delete"]').attr('disabled', true);
        $row.find('[data-type="delete"]').attr('title', cannotDelete);

        $row.find("input[name^=name]").on('keyup', function()
        {
            const name = moduleProcesses[row.id]?.name || '';
            if(this.value == '' && name != '')
            {
                zui.Modal.alert(cannotDeleteWithName.replace('{name}', `[${name}]`));
                $(this).val(name);
            }
        });
    }
};