window.toggleDetail = function(event)
{
    if($(event.target).hasClass('icon-angle-top'))
    {
        $(event.target).removeClass('icon-angle-top');
        $(event.target).addClass('icon-angle-down');
        $(event.target).closest('.detail-section').find('.detail-section-content').addClass('hidden');
    }
    else
    {
        $(event.target).removeClass('icon-angle-down');
        $(event.target).addClass('icon-angle-top');
        $(event.target).closest('.detail-section').find('.detail-section-content').removeClass('hidden');
    }
}