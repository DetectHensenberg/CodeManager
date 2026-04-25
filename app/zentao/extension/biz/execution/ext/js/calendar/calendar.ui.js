window.setCalendarOptions = function(_, options)
{
    const colors = {
        doing: 'var(--color-danger-400)',
        done : 'var(--color-success-400)',
        pause: 'var(--color-important-400)',
    };
    return $.extend({
        categories: [{id: 'DEFAULT', color: 'var(--color-gray-400)'}],
        events: options.tasks.map(task => {
            return {
                id: task.id,
                title: task.title,
                allDay: true,
                start: task.start,
                color: colors[task.status],
                task: task,
            };
        }),
        eventRender: (event) => {
            const task = event.task;
            return {
                hint         : task.desc || task.title,
                url          : task.url,
                text         : {html: task.iconTitle ? task.iconTitle : task.title, className: 'flex items-center gap-1'},
                'data-toggle': 'modal',
                'data-size'  : '90%',
            };
        },
    }, options);
};
