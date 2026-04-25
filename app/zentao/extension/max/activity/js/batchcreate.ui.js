window.changeProcess = function()
{
    const process = $('[name=processID]').val();
    $('.panel-body form [name^=process]').zui('picker').$.setValue(process);
}

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
