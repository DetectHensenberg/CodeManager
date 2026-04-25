/**
 * Get by id for gantt.
 */
function getByIdForGantt(list, id)
{
    for (var i = 0; i < list.length; i++)
    {
        if (list[i].key == id) return list[i].label || "";
    }
    return id;
}

function initGantt()
{
    const columns = [
        {name: 'text', width: '*', tree: true, resize: true, min_width:120, width:200},
        this.options.productType != 'normal' ? {name: 'branch', align: 'center', resize: true, width: 100} : null,
        {name: 'status', align: 'center', resize: true, width: 90},
        {name: 'start_date', align: 'center', resize: true, width: 90},
        {name: 'end_date', align: 'center', resize: true, width: 90},
        {name: 'requirements', align: 'center', resize: true, width: 90},
        window.config.vision == 'or' ? {name: 'actions', align: 'center', resize: true, width: 130, min_width: 130} : null,
    ].filter(Boolean);
    columns[columns.length - 1].resize = false;

    this.setConfig(
    {
        order_branch     : this.options.ganttType !== 'assignedTo',
        drag_progress    : false,
        drag_links       : false,
        drag_move        : false,
        drag_resize      : true,
        smart_rendering  : true,
        smart_scales     : true,
        static_background: true,
        show_task_cells  : false,
        row_height       : 32,
        min_column_width : 40,
        grid_width       : 600,
        details_on_create: false,
        scales           : [{unit: "year", step: 1, format: "%Y"}, {unit: 'month', step: 1, format: '%M'}],
        scale_height     : 18 * this.gantt.config.scales.length,
        duration_unit    : 'day',
        columns          : columns,
    });

    const gridDateToStr = this.gantt.date.date_to_str('%Y-%m-%d');
    this.setTemplates({
        task_end_date: function(data)
        {
            return this.gantt.templates.task_date(new Date(date.valueOf() - 1));
        },
        grid_date_format: function(date, column)
        {
            if(column === 'end_date') return gridDateToStr(new Date(date.valueOf()));
            return gridDateToStr(date);
        },
        task_class: function(start, end, task)
        {
            return 'pri-' + (task.pri || 0);
        },
        rightside_text: function(start, end, task)
        {
            if(typeof task.owner_id == 'undefined') return;
            return getByIdForGantt(this.gantt.serverList('userList'), task.owner_id);
        },
        grid_row_class: function(start, end, task)
        {
            if(task.type == 'task') return 'task-item';
        },
        link_class: function(link)
        {
            const types = gantt.config.links;
            if(link.type == types.finish_to_start)  return 'finish_to_start';
            if(link.type == types.start_to_start)   return 'start_to_start';
            if(link.type == types.finish_to_finish) return 'finish_to_finish';
            if(link.type == types.start_to_finish)  return 'start_to_finish';
        },
        tooltip_text: function(start, end, task) {return '';},
        grid_folder: function(item) {return '';},
        grid_file: function(item) {return '';},
    });

    const date2Str = this.gantt.date.date_to_str(this.gantt.config.task_date);
    const today    = new Date();
    this.addMarker({
        start_date: today,
        css: "today",
        text: this.options.todayTips,
        title: this.options.todayTips + ": " + date2Str(today)
    });

    this.attachEvent('onTaskClick', function(id, e)
    {
        if($(e.srcElement).hasClass('icon-magic')) return false;
        if($(e.srcElement).hasClass('icon-trash')) return false;

        if($(e.srcElement).find('a').length > 0) return false;
        if(e.target.tagName == 'I' || e.target.tagName == 'A') return false;
        if($(e.srcElement).hasClass('gantt_close') || $(e.srcElement).hasClass('gantt_open')) return false;

        /* The id of task item is like executionID-taskID. e.g. 1507-37829, 37829 is task id. */
        const mapID = id;

        if(!isNaN(mapID) && mapID > 0) openUrl($.createLink('roadmap', 'view', 'mapID=' + mapID, 'html'));
    });

    this.on('mouseleave', () =>
    {
        setTimeout(function(){$('.gantt_tooltip').remove()}, 100);
    });
}

window.setGanttOptions = function(_, options)
{
    options = $.extend({onInit: initGantt}, options, options.roadmaps);
    return options;
};

window.enterGanttFullscreen = function()
{
    zui.toggleFullscreen('#mainContainer');
    getGantt().gantt.expand();
};

window.getGantt = function()
{
    return $('#ganttView').zui('gantt');
};

window.zoomTasks = function(value)
{
    const gantt = getGantt().gantt;
    if(value == 'month')   gantt.config.scales = [{unit: "year", step: 1, format: "%Y"}, {unit: 'month', step: 1, format: '%M'}];
    if(value == 'year')    gantt.config.scales = [{unit: "year", step: 1, format: "%Y"}];
    if(value == 'quarter')
    {
        gantt.config.scales = [{unit: "year", step: 1, format: "%Y"}, {unit: "quarter", step: 1, format: function (date)
        {
           var dateToStr = gantt.date.date_to_str("%M");
           var endDate = gantt.date.add(gantt.date.add(date, 3, "month"), -1, "day");
           return dateToStr(date) + " - " + dateToStr(endDate);
        }}];
    }
    gantt.render();
};
