$(function()
{
    $('#rate').attr('readonly', true);
    $('#pri').attr('disabled', true);
    computeIndex();
    function computeIndex()
    {
        var impact      = $('#impact').val();
        var probability = $('#probability').val();
        var rate        = parseInt(impact * probability);
        var pri         = '';
        var priColor    = '';
        if(0 <= rate && rate <= 5)   pri = 3;
        if(5 < rate && rate <= 12)   pri = 2;
        if(15 <= rate && rate <= 25) pri = 1;

        priColor = 'pri-' + pri;

        $('#rate').val(rate);
        $('#pri').val(pri);
        $('#pri').trigger("chosen:updated")
        $('#pri').chosen();
        $('#pri').attr('disabled', true);
        $('#priValue .chosen-container-single .chosen-single>span').attr("class", priColor);
        $('input[name="pri"]').remove();
        $('#pri').after("<input type='hidden' name='pri' value='" + pri + "'/>");
    }

    $('#impact, #probability').change(function(){computeIndex()});
})
