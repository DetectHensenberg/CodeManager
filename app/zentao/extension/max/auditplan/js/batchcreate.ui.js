window.renderRowData = function($row, index, row)
{
    $row.find('[data-name="objectID"]').find('.picker-box').on('inited', function(e, info)
    {
        let $objectID = info[0];
        $objectID.render({items: activityList[row.process]});
        $objectID.$.setValue(row.activity);
    });
};

window.changeProcess = function(event)
{
    const processID = $(event.target).val();
    const $object = $(event.target).closest('tr').find('input[name^="objectID"]').zui('picker');
    $object.render({items: activityList[processID]});
    $object.$.setValue('');
}
