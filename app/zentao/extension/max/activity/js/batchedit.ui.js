function setTailorNorm(e)
{
    const $optional    = $(e.target);
    const $currentRow  = $optional.closest('tr');
    const optionalVal  = $optional.val();

    if(optionalVal == 'no')
    {
        $currentRow.find('[name*=tailorNorm]').val('').attr('disabled', 'disabled');
    }
    else
    {
        $currentRow.find('[name*=tailorNorm]').removeAttr('disabled');
    }
}

window.renderActivityRow = function($row, index, row)
{
    if(row.optional == 'no')
    {
        $row.find('[name*=tailorNorm]').val('').attr('disabled', 'disabled');
    }
    else
    {
        $row.find('[name*=tailorNorm]').removeAttr('disabled');
    }
}