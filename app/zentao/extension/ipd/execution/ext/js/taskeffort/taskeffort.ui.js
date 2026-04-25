window.initTaskEffortTable = function()
{
    let $tasksTable = $('#tasksTable');
    console.log('> rowsCount', rowsCount);
    if(!rowsCount) return $tasksTable.removeClass('loading');

    let $tableContainer     = $('#tableContainer');
    let $tableHeader        = $('#tableHeader');
    let $tableFooter        = $('#tableFooter');
    let $tableBody          = $('#tableBody');
    let $cells              = $('#cells');
    let $scrollbarContainer = $('#scrollbarContainer');
    let $timeline           = $('#timeline');
    let $timeList           = $('#timeList');
    let $totalDays          = $('#totalDays');
    let $scrollbar          = $('#scrollbar');
    let $window             = $(window);
    let cellWidth           = 56;
    let dayWidth            = cellWidth * 2;
    let lastScrollLeft      = 0;
    let lastScrollTop       = 0;
    let lastTimelineWidth;
    let isHeaderFixed        = false;
    let isFooterFixed        = false;
    let winHeight            = $window.height();
    let headerHeight         = $tableHeader.outerHeight();
    let footerHeight         = $tableFooter.outerHeight();
    let pageFooterHeight     = $('#footer').outerHeight() || 0;
    let currentYear          = new Date().getFullYear();
    let firstVisibleDayIndex = 0;
    let rowLayouts           = [];
    let maxRowHeight         = 0;
    let lastHoverRow, lastHoverDay, hoverDelayTimer;


    /* Init body bounds */
    for (let i = 0; i < groupsCount; ++i)
    {
        let $group = $('#group-' + i);
        let height = $group.outerHeight();
        $group.find('.group-tasks').css('min-height', height - 1);
    }
    const bodyBounds = $.extend({}, $tableBody[0].getBoundingClientRect());

    /* Init layout of rows */
    for (let i = 0; i < rowsCount; ++i)
    {
        let $task  = $('#task-' + i);
        let bounds = $task[0].getBoundingClientRect();
        let layout = {top: bounds.top - bodyBounds.top, height: bounds.height, bottom: bounds.bottom - bodyBounds.top};

        rowLayouts.push(layout);
        maxRowHeight = Math.max(maxRowHeight, layout.height);
    }

    let scrollTopOnLoad = window.scrollTo(0, 0);
    if(scrollTopOnLoad > 0)
    {
        bodyBounds.y      += scrollTopOnLoad;
        bodyBounds.top    += scrollTopOnLoad;
        bodyBounds.bottom += scrollTopOnLoad;
    }

    /* Init layout of cells */
    let cellsWidth = dayWidth * days.length;
    $scrollbar.css('width', cellsWidth);
    $timeList.css('width', cellsWidth);
    $totalDays.css('width', cellsWidth);

    /* Layout timeline */
    function layoutTimeline(force)
    {
        let scrollLeft    = $scrollbarContainer[0].scrollLeft;
        let timeLineWidth = $timeline.width();

        if(!force && lastScrollLeft === scrollLeft && timeLineWidth === lastTimelineWidth) return;

        lastScrollLeft       = scrollLeft;
        lastTimelineWidth    = timeLineWidth;
        firstVisibleDayIndex = Math.floor(scrollLeft / dayWidth);

        let index        = firstVisibleDayIndex;
        let visibleWidth = timeLineWidth + dayWidth;
        let width        = 0;
        let $days        = $timeList.children('.day-cell').addClass('expired');
        let $tDays       = $totalDays.children('.day-cell').addClass('expired');

        while(width < visibleWidth && days[index])
        {
            let day  = days[index];
            let $day = $('#day-' + index);

            if($day.length) $day.removeClass('expired');
            else
            {
                $day = $(
                [
                    '<div class="day-cell" id="day-' +  index + '" data-day="' + index + '">',
                        '<div class="day-name">' + (day.indexOf(currentYear + '-') === 0 ? day.substr(5) : day) + '</div>',
                        '<div class="day-consumed">' + consumedText + '</div>',
                        '<div class="day-left">' + leftText + '</div>',
                    '</div>'
                ].join('')).css({left: index * dayWidth, width: dayWidth}).appendTo($timeList);
            }

            let $totalDay = $('#day-total-' + index);

            if($totalDay.length) $totalDay.removeClass('expired');
            else
            {
                let totalCounts = counts[day];
                $totalDay = $(
                [
                    '<div class="day-cell" id="day-total-' +  index + '" data-day="' + index + '">',
                        '<div class="day-consumed">' + (totalCounts ? totalCounts.countConsumed.toFixed(1) : '') + '</div>',
                        '<div class="day-left">' + (totalCounts ? totalCounts.countLeft.toFixed(1) : '') + '</div>',
                    '</div>'
                ].join('')).css({left: index * dayWidth, width: dayWidth}).appendTo($totalDays);
            }
            width += dayWidth;
            index++;
        }
        $days.filter('.expired').remove();
        $tDays.filter('.expired').remove();
        $timeList.css('left', 0 -scrollLeft);
        $totalDays.css('left', 0 -scrollLeft);
    }

    /* Layout table cells */
    function layoutCells(scrollTop)
    {
        if(typeof scrollTop !== 'number') scrollTop = window.pageYOffset;

        let firstVisibleRowIndex = 0;
        if(scrollTop > (bodyBounds.top - headerHeight))
        {
            for(let i = 0; i < rowLayouts.length; ++i)
            {
                let layout = rowLayouts[i];
                firstVisibleRowIndex++;
                if(scrollTop < layout.bottom + bodyBounds.top) break;
            }
        }

        let $oldCellList  = $cells.children('.data-cell').addClass('expired');
        let height        = 0;
        let visibleHeight = winHeight - headerHeight - pageFooterHeight - footerHeight + maxRowHeight;
        let rowIndex      = firstVisibleRowIndex < 3 ? 0 : firstVisibleRowIndex;

        while(height < visibleHeight && rowLayouts[rowIndex])
        {
            let layout       = rowLayouts[rowIndex];
            let dayIndex     = firstVisibleDayIndex;
            let visibleWidth = lastTimelineWidth + dayWidth;
            let width        = 0;
            let task         = taskList[rowIndex];

            while(width < visibleWidth && days[dayIndex])
            {
                let day   = days[dayIndex];
                let $cell = $('#cell-' + rowIndex + '-' + dayIndex);

                if($cell.length) $cell.removeClass('expired');
                else
                {
                    let data     = task ? task[day] : null;
                    let consumed = (data ? data.consumed : '') || '';
                    let left     = (data ? data.left : '') || '';

                    $cell = $(
                    [
                        '<div class="data-cell" id="cell-' + rowIndex + '-' + dayIndex + '" data-row="' + rowIndex + '" data-day="' + dayIndex + '">',
                            '<div class="day-consumed">' + consumed + '</div>',
                            '<div class="day-left">' + left + '</div>',
                        '</div>'
                    ].join(''));
                    $cell.css(
                    {
                        left:   dayIndex * dayWidth,
                        top:    layout.top + (rowIndex ? 1 : 0),
                        width:  dayWidth,
                        height: layout.height + (rowIndex ? 0 : 1)
                    }).appendTo($cells);
                }
                width += dayWidth;
                dayIndex++;
            }
            height += layout.height;
            rowIndex++;
        }

        $oldCellList.filter('.expired').remove();
        $cells.css('left', 0 -lastScrollLeft);
    }

    /* Layout table cells */
    function fixedHeaderFooter(scrollTop, force)
    {
        if(typeof scrollTop !== 'number')
        {
            force     = scrollTop;
            scrollTop = window.pageYOffset;
        }
        let needFixedHeader = scrollTop > (bodyBounds.top - headerHeight);
        if(force || needFixedHeader !== isHeaderFixed)
        {
            isHeaderFixed = needFixedHeader;
            $tableHeader.toggleClass('is-fixed', isHeaderFixed);
            $tableContainer.toggleClass('is-fixed-header', isHeaderFixed).css('padding-top', isHeaderFixed ? headerHeight : 0);
            $tableHeader.css(isHeaderFixed ? {left: bodyBounds.left, width: bodyBounds.width} : {left: 'auto', width: 'auto'});
        }

        let needFixedFooter = (scrollTop + winHeight - pageFooterHeight) < bodyBounds.bottom;
        if(force || needFixedFooter !== isFooterFixed)
        {
            isFooterFixed = needFixedFooter;
            if(isFooterFixed)
            {
                $('#scrollbarContainer').css('top', '-12px');
                $('#scrollbarContainer').css('bottom', 'unset');
            }
            else
            {
                $('#scrollbarContainer').css('top', 'unset');
                $('#scrollbarContainer').css('bottom', '0');
            }
            $tableFooter.toggleClass('is-fixed', isFooterFixed);
            $tableContainer.toggleClass('is-fixed-footer', isFooterFixed).css('padding-bottom', isFooterFixed ? footerHeight : 0);
            $tableFooter.css(isFooterFixed ? {left: bodyBounds.left, width: bodyBounds.width, bottom: pageFooterHeight} : {left: 'auto', width: 'auto', bottom: 0});
        }
    }

    const date = Date.now();
    /* Listen events to refresh layout */
    $scrollbarContainer.off('.zentaoTaskeffort').on('scroll.zentaoTaskeffort', function()
    {
        layoutTimeline(true);
        layoutCells(lastScrollTop);
    });
    $window.off('.zentaoTaskeffort').on('scroll.zentaoTaskeffort', function()
    {
        let scrollTop = window.pageYOffset;
        if(scrollTop === lastScrollTop) return;
        lastScrollTop = scrollTop;
        fixedHeaderFooter(scrollTop);
        layoutCells(scrollTop);
        clearHoverEffections();
    }).on('resize.zentaoTaskeffort', function()
    {
        let bounds = $tableBody[0].getBoundingClientRect();
        bodyBounds.width = bounds.width;
        bodyBounds.left  = bounds.left;
        bodyBounds.right = bounds.right;
        bodyBounds.x     = bounds.x;
        winHeight        = $window.height();

        fixedHeaderFooter(true);
        layoutTimeline(true);
        clearHoverEffections();
    });

    /* Clear hover effections */
    function clearHoverEffections(row, day)
    {
        if(row !== false && lastHoverRow > -1)
        {
            $tableContainer.find('.hover-row').removeClass('hover-row');
            lastHoverRow = -1;
        }
        if(day !== false && lastHoverDay > -1)
        {
            lastHoverDay = -1;
            $tableContainer.find('.hover-day').removeClass('hover-day');
        }
    };

    /* Update hover effections */
    function updateHoverEffections()
    {
        let $cell = $(this);
        let row   = $cell.data('row');
        let day   = $cell.data('day');

        if(row !== lastHoverRow)
        {
            clearHoverEffections(1, false);
            $tableContainer.find('.day-cell,.data-cell,.group-task').filter('[data-row="' + row + '"]').addClass('hover-row');
            lastHoverRow = row;
        }
        if(day !== lastHoverDay)
        {
            clearHoverEffections(false, 1);
            $tableContainer.find('.day-cell,.data-cell,.group-task').filter('[data-day="' + day + '"]').addClass('hover-day');
            lastHoverDay = day;
        }
        hoverDelayTimer = 0;
    }

    /* Add mouse hover effections */
    $tableContainer.off('.zentaoTaskeffort').on('mouseenter.zentaoTaskeffort', '.day-cell,.data-cell,.group-task', function()
    {
        if(hoverDelayTimer) clearTimeout(hoverDelayTimer);
        hoverDelayTimer = setTimeout(updateHoverEffections.bind(this), 20);
    }).on('mouseleave.zentaoTaskeffort', '.day-cell,.data-cell,.group-task', clearHoverEffections);

    /* Init layouts */
    fixedHeaderFooter(true);
    layoutTimeline(true);
    layoutCells();

    /* Remove loading status */
    $tasksTable.removeClass('loading');
};

window.computeTaskEffort = function()
{
    let begin = $('#begin').val();
    let end   = $('#end').val();

    if(begin > end) return zui.Modal.alert(beginMoreThanEnd);
    if(typeof(today) != 'undefined' && end > today) return zui.Modal.alert(endMoreThanToday);

    begin = begin.replace(/-/g, '');
    end   = end.replace(/-/g, '');

    const link = $.createLink('execution', 'computeTaskEffort', 'begin=' + begin + '&end=' + end);
    $.get(link, function(data){if(data == 'success') reloadPage();});
};
