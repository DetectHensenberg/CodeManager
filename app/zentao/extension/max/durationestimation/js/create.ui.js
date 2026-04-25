window.changeWorkload = function(event)
{
    $stageTR = $(event.target).closest('tr.form-batch-row');
    rate = parseFloat($stageTR.find('input[data-name=workload]').val());
    workload = estimation.scale * rate / 100;
    $stageTR.find('input[data-name=workloadLabel]').val(workload);

    computeTotalWorkload();
    computeEndDate(event);
}

window.computeTotalStaff = function(event)
{
    let peopleNumber = 0;
    $('input[data-name=people]').each(function()
    {
        let people = $(this).val();
        if(people) peopleNumber += parseInt(people);
    });
    $('#totalStaff').html(peopleNumber);
    computeEndDate(event);
}

window.computeTotalWorkload = function()
{
    let totalWorkload = 0;
    $('input[data-name=workload]').each(function()
    {
        let   rate = parseFloat($(this).val());
        const workload = estimation.scale * rate / 100;
        totalWorkload += workload;
    });

    $('#totalWorkload').html(totalWorkload.toFixed(2));
}

window.computeEndDate = function(event)
{
    $stageTR = $(event.target).closest('tr.form-batch-row');

    stage        = $stageTR.find('input[name^=stage]').val();
    workload     = $stageTR.find('input[name^=workload]').val();
    worktimeRate = $stageTR.find('input[name^=worktimeRate]').val();
    people       = $stageTR.find('input[name^=people]').val();
    startDate    = $stageTR.find('input[name^=startDate]').val();
    if(startDate) startDate = startDate.replace(/-/g, '_');

    if(isNaN(workload) || isNaN(worktimeRate) || isNaN(people) || startDate == '') return false;

    url = $.createLink('durationestimation', 'ajaxGetDuration', 'projectID=' + projectID + '&stage=' + stage + '&workload=' + workload + '&worktimeRate=' + worktimeRate  + '&people=' + people + '&startDate=' + startDate);
    $.getJSON(url, function(response)
    {
        if(response.result == 'success')
        {
            $stageTR.find('input[name^=endDate]').zui('datePicker').$.changeState({value: response.endDate});
        }
    });
}
