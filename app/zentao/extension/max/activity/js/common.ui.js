window.changeOptional = function(e)
{
    if(e.target.value == 'no')
    {
        $('input[name*=tailorNorm]').val('').attr('disabled', 'disabled');
    }
    else
    {
        $('input[name*=tailorNorm]').removeAttr('disabled');
    }
}
