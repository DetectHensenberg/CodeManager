window.renderRowData = function($row, index, row)
{
    $row.find('[data-name="severity"]').find('.picker-box').on('inited', function(e, info)
    {
        let $objectID = info[0];
        $objectID.render({disabled: row.result == 'pass'});
    });
};

window.changeResult = function(event)
{
    const result  = $(event.target).val();
    const $object = $(event.target).closest('tr').find('input[name^="severity"]').zui('picker');
    $object.render({disabled: result == 'pass'});
    $object.$.setValue('');
}

window.clickSubmit = function(event)
{
    const status = $(event.submitter).data('status');
    if(status === undefined) return;
    $(event.submitter).closest('form').find('[name^=status]').val(status);
}

if(isChecked) zui.Modal.alert(checkedTip);
