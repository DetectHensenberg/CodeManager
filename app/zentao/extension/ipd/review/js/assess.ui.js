window.toggleOption = function(obj)
{
    let $this    = $(obj);
    let result   = $this.val();
    let $opinion = $this.closest('tr').find('.issue-opinion');
    if(result == 0) $opinion.removeClass('hidden');
    else $opinion.addClass('hidden');
}

window.toggleDetail = function(event)
{
    if($(event.target).hasClass('icon-angle-top'))
    {
        $(event.target).removeClass('icon-angle-top');
        $(event.target).addClass('icon-angle-down');
        $(event.target).closest('.section').find('.article-content').addClass('hidden');
    }
    else
    {
        $(event.target).removeClass('icon-angle-down');
        $(event.target).addClass('icon-angle-top');
        $(event.target).closest('.section').find('.article-content').removeClass('hidden');
    }
}

$(document).off('click', '.add-issue-opinion').on('click', '.add-issue-opinion', function()
{
    const row = $(this).closest('div').clone()
    row.find('.opinion').val('');
    row.find('.del-issue-opinion').css('visibility', 'visible')
    $(this).closest('div').after(row)
})

$(document).off('click', '.del-issue-opinion').on('click', '.del-issue-opinion', function()
{
    $(this).closest('div').remove()
})

window.toggleOpinion = function(event)
{
    const id = $(event.target).closest('td').attr('id')
    if($(event.target).hasClass('icon-angle-top'))
    {
        $(event.target).removeClass('icon-angle-top')
        $(event.target).addClass('icon-angle-down')
        $(event.target).closest('.table').find(`tr.${id}`).addClass('hidden')
    }
    else
    {
        $(event.target).removeClass('icon-angle-down')
        $(event.target).addClass('icon-angle-top')
        $(event.target).closest('.table').find(`tr.${id}`).removeClass('hidden')
    }
}