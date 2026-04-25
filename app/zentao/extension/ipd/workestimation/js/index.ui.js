window.updateScale = function()
{
    $('#scale').val(scale);
    computeDuration();
}

window.computeDuration = function()
{
    duration = parseFloat($('#scale').val()) * parseFloat($('#productivity').val()).toFixed(2);
    duration = duration.toFixed(2);
    if(!isNaN(duration)) $('#duration').val(duration);
    if(isNaN(duration)) $('#duration').val('');

    computeTotal();
}

window.computeTotal = function()
{
    totalLaborCost = parseFloat($('#unitLaborCost').val()) * parseFloat($('#duration').val());
    totalLaborCost = totalLaborCost.toFixed(2);
    if(!isNaN(totalLaborCost)) $('#totalLaborCost').val(totalLaborCost);
    if(isNaN(totalLaborCost)) $('#totalLaborCost').val('');
}
