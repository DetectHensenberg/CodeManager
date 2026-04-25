async function handleSwitchCalendarDate(date)
{
    const displayDate = date.getFullYear();
    if(displayDate === this.displayDate) return;
    this.displayDate = displayDate;

    toggleLoading('#mainContent', true);
    try
    {
        const data   = await $.getJSON(this.props.ajaxGetEffortsUrl.replace('{year}', displayDate));
        const events = data.map(effort => ({id: effort.id, start: effort.start, end: effort.end, title: effort.title, allDay: true, effort: effort}));
        this.modifyEvents(events);
    }
    catch
    {
        zui.Messager.fail(this.props.textNetworkError);
    }
    toggleLoading('#mainContent', false);
}

function renderEvent(event)
{
    const effort = event.effort;
    return {
        icon         : null,
        hint         : effort.divTitle || effort.title,
        url          : effort.url,
        text         : {html: effort.title, className: 'flex items-center gap-1'},
        trailing     : zui.jsx`<div class="text-xs muted">${Number(effort.consumed).toFixed(2)}h</div>`,
        'data-toggle': 'modal',
        'data-size'  : '70%',
    };
}

window.setCalendarOptions = function(_, options)
{
    return $.extend({
        onSwitchDate: handleSwitchCalendarDate,
        eventRender:  renderEvent,
    }, options);
};

window.changeUser = function(executionID, userID)
{
    const url = $.createLink('execution', 'effortcalendar', 'executionID=' + executionID + '&userID=' + userID);
    openUrl(url);
};

window.exportCalendar = function(href)
{
    const calendar = $('#calendar').zui('calendar');
    const thisDate = new Date(calendar.$.date);
    const year     = thisDate.getFullYear();
    const month    = thisDate.getMonth() + 1;

    href = href.replace('_date_', year + '_' + month + '_01');
    zui.Modal.open({url: href, size: 600});
};
