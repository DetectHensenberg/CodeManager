/**
 * 重写文档应用的配置选项方法。
 * Override the method to set the doc app options.
 */
window._setDocAppOptions = window.setDocAppOptions; // Save the original method.
window.setDocAppOptions = function(_, options) // Override the method.
{
    options     = window._setDocAppOptions(_, options);
    currentUser = options.currentUser;
    return $.extend(options,
    {
        viewModeUrl          : getViewModeUrl,
        customRenders        : $.extend(docAppCustomRenders, customRenders),
        getDocViewSidebarTabs: getDocViewSidebarTabs
    });
};

const customRenders =
{
    'app-nav': function(items)
    {
        const docApp = getDocApp();
        if(docApp && docApp.mode == 'view')
        {
            const homeUrl    = $.createLink('weekly', 'browse', `projectID=${projectID}&browseType=all`);
            const homeText   = getLang('reportList');
            const homeButton = zui.renderCustomContent({className: 'homeButton', content: {html: `<a class='btn ghost text-primary square size-md ml-1' href=${homeUrl}><i class="icon-home mr-0.5"></i>${homeText}</a>`}});
            items[0] = ['space', [homeButton]];
        }

        const moduleIndex = items.findIndex(item => item[0].includes('-angle'));
        if(moduleIndex > 0) items.splice(moduleIndex, 1);

        return items;
    }
}

$.extend(window.docAppActions,
{
    doc: function(info)
    {
        const lang       = getLang();
        const doc        = info.data;
        const docApp     = this;
        const canEditDoc = hasPriv('edit');
        if(doc.content && !doc.hasContent)
        {
            async function initHtmlByRawContent(rawContent)
            {
                await zui.Editor.loadModule();
                const html = await zui.Editor.convertToHtml(rawContent);
                $.post($.createLink('weekly', 'ajaxSetContent', `reportID=${doc.id}&version=${doc.version}`), {content: html})
            };
            initHtmlByRawContent(doc.content);
        }

        const moreItems = [];
        if(hasPriv('delete'))       moreItems.push({icon: 'trash', text: lang.delete, command: `deleteDoc/${doc.id}`});
        if(hasPriv('exportReport')) moreItems.push({icon: 'export', text: lang.export, command: `exportWord/${doc.id}/${doc.title}`});

        const isToolbar = info.ui === 'toolbar';
        const isInModal = $(this.element).closest('.modal').length;
        const actions = isInModal ? [] : [
            isToolbar ? {hint: docApp.fullscreen ? lang.exitFullscreen : lang.enterFullscreen, icon: docApp.fullscreen ? 'fullscreen-exit' : 'fullscreen', command: 'toggleFullscreen'} : null,
            canEditDoc ? {icon: 'edit', class: doc.editable ? null : 'disabled', type: doc.editable ? 'ghost text-primary' : 'ghost text-gray', hint: doc.editable ? lang.edit : lang.needEditable, rounded: 'lg', command: doc.editable ? 'startEditDoc' : null} : null,
            (isToolbar && docApp.props.showDocOutline !== false) ? {hint: lang.docOutline, icon: 'list-box', command: 'toggleViewSideTab/outline'} : null,
            (isToolbar && docApp.props.showDocHistory !== false) ? {hint: lang.history, icon: 'file-log', command: 'toggleViewSideTab/history'} : null,
            moreItems.length ? {icon: 'icon-ellipsis-v', type: 'dropdown', rounded: 'lg', placement: 'bottom-end', caret: false, items: moreItems} : null,
        ];

        return actions;
    },
    /**
     * 定义文档编辑时的操作按钮。
     * Define the actions on toolbar of the doc editing page.
     */
    'doc-edit': function(info)
    {
        const doc = info.data;
        if(!doc) return;

        const lang      = getLang();
        const isToolbar = info.ui === 'toolbar';
        const docApp    = this;
        return [
            isToolbar ? {hint: docApp.fullscreen ? lang.exitFullscreen : lang.enterFullscreen, icon: docApp.fullscreen ? 'fullscreen-exit' : 'fullscreen', command: 'toggleFullscreen'} : null,
            (isToolbar && docApp.props.showDocOutline !== false) ? {hint: lang.docOutline, icon: 'list-box', command: 'toggleViewSideTab/outline'} : null,
            (isToolbar && docApp.props.showDocHistory !== false) ? {hint: lang.history, icon: 'file-log', command: 'toggleViewSideTab/history'} : null,
            (isToolbar && docApp.props.quickEditMenu) ? {hint: lang.insertSystemData, icon: 'controls', command: 'toggleViewSideTab/quick-edit-menu'} : null,
            {text: lang.refreshData, type: 'ghost', command: `refreshData/${doc.project}`, icon: 'refresh'},
            {text: lang.settings, size: 'md', type: 'ghost', command: `showSettingModal/${doc.id}`, icon: 'cog-outline'},
            doc.status === 'draft' ? {text: lang.saveDraft, size: 'md', className: 'btn-wide', type: 'secondary', command: `saveDoc/draft`} : null,
            {text: lang.release, size: 'md', className: 'btn-wide', type: 'primary', command: `saveDoc`},
            {text: lang.cancel, size: 'md', className: 'btn-wide', type: 'primary-outline', command: 'exitEditDoc'}
        ];
    }
});

$.extend(window.docAppCommands,
{
    showSettingModal: function(_, args)
    {
        const docApp = getDocApp();
        const docID  = args[0] || docApp.docID;
        const url    = $.createLink('weekly', 'ajaxSetBasic', `docID=${docID || 0}`);

        zui.Modal.open({url: url});
    },
    refreshData: function(_, args)
    {
        zui.Modal.confirm(getLang('confirmRefresh')).then(result =>
        {
            if(!result) return;
            refreshReportData(args[0]);
        });

    },
    exportWord: function(_, args)
    {
        const docApp = getDocApp();
        const docID  = args[0] || docApp.docID;
        let   title  = args[1] || 'undefined';
        const form   = new FormData();

        $('.zentao-chart').each(function()
        {
            const $this     = $(this);
            const blockID   = $this.data('id');
            const $chartBox = $this.find('.chartBox');
            if($chartBox.length == 0)
            {
                form.append(`charts[${blockID}][data]`, $this.find('.canvas').text());
                return;
            }

            let chartType = '';
            if($chartBox.hasClass('table')) chartType = 'table';
            if($chartBox.hasClass('chart')) chartType = 'image';
            if($chartBox.hasClass('gantt')) chartType = 'gantt';
            form.append(`charts[${blockID}][type]`, chartType);
            if(chartType == 'table') form.append(`charts[${blockID}][data]`, $chartBox.find('table').length ? $chartBox.find('table').prop('outerHTML') : $chartBox.text());
            if(chartType == 'image') form.append(`charts[${blockID}][data]`, $chartBox.find('canvas').length ? $chartBox.find('canvas').get(0).toDataURL('image/png') : $chartBox.text());
            if(chartType == 'gantt') form.append(`charts[${blockID}][data]`, location.origin + $chartBox.data('link'));
        });

        const url = $.createLink('weekly', `exportReport`, `docID=${docID}`);
        $.post(url, form, function(blob)
        {
            const urlObject = URL.createObjectURL(blob);

            const link = document.createElement('a');
            link.href  = urlObject;

            if(!isNaN(title) && title !== '') title = 'doc_' + title;
            link.download = decodeURIComponent(title.replace(/"/g, '') + '.doc');

            document.body.appendChild(link);
            link.click();

            document.body.removeChild(link);
            URL.revokeObjectURL(urlObject);
        });
    },
    deleteDoc: function(_, args)
    {
        const docApp = getDocApp();
        const docID  = args[0] || docApp.docID;
        $.ajaxSubmit(
        {
            confirm: getLang('confirmDelete'),
            url:     $.createLink('weekly', 'delete', `docID=${docID}`),
            load:    false,
            onSuccess: function()
            {
                getDocApp().delete('doc', docID);
                loadPage($.createLink('weekly', 'browse', `projectID=${projectID}`));
            }
        });
    },
    startEditDoc: function(_, [doc], options)
    {
        const docApp = getDocApp();
        loadPage($.createLink('weekly', 'edit', `reportID=${docApp.docID}`));
    },
    exitEditDoc: function(_, [doc], options)
    {
        const docApp = getDocApp();
        loadPage($.createLink('weekly', 'view', `reportID=${docApp.docID}`));
    }
})

/**
 * 获取查看视图的 URL，用于更新浏览器地址栏。
 * Get the view mode URL for updating the browser address bar.
 */
function getViewModeUrl(options)
{
    if(options.mode == 'view') return $.createLink('weekly', 'view', `reportID=${options.docID}`);
    if(options.mode == 'edit') return $.createLink('weekly', 'edit', `reportID=${options.docID}`);
    return $.createLink('weekly', 'browse', `projectID=${options.project}`);
};

/*
 * 插入禅道列表。
 * Insert the Zentao list.
 */
window.insertZentaoMeasurement = function(type, props, isNewBlock)
{
    if(!isNewBlock) return getDocApp().editor.$.updateHolderText({name: `${type}_${props.blockID}`, text: `${props.text}`, hint: props.hint});
    getDocApp().editor.$.insertHolderText(`${type}_${props.blockID}`, {text: `${props.text}`, hint: props.hint}, props);
};

/*
 * 插入执行度量数据。
 * Insert the execution list.
 */
window.insertExecutionMeasurement = function(e, info)
{
    $.getJSON($.createLink('weekly', 'ajaxGetMeasurement', `type=${info.item['data-type']}&projectID=${info.item['data-project']}`), function(count)
    {
        getDocApp().editor.$.insertHolderText(info.item['data-type'], {text: `${count}`, hint: info.item.hint});
    })
};

/*
 * 点击占位符。
 * Click the holder.
 */
window.clickHolder = function(info)
{
    const docApp = getDocApp();
    if(docApp.mode != 'edit') return;
    if(!info.holder.data) return;
    if(!info.holder.data.blockID) return;

    const url = $.createLink('reporttemplate', 'ajaxBuildZentaoMeasurementConfig', `type=${info.holder.data.type}&blockID=${info.holder.data.blockID}&projectID=${projectID}`);
    zui.Modal.open({url: url});
};

/* 从编辑器删除图表。*/
window.deleteZentaoChart = function(blockID)
{
    const $block = $('#docApp').find(`.zentao-chart[data-id="${blockID}"]`);
    if(!$block.length) return false;
    getDocApp().editor.$.deleteBlock($block[0]);
};

window.getDocViewSidebarTabs = function(doc, info)
{
    const docApp = getDocApp();
    const tabs   = [
        {key: 'outline', icon: 'list-box', title: getLang('docOutline')},
        {key: 'history', icon: 'file-log', title: getLang('history')}
    ]

    /* 定义快捷编辑菜单标签页。 */
    const quickEditMenu = docApp ? docApp.props.quickEditMenu : '';
    if(quickEditMenu && quickEditMenu.length && docApp.mode == 'edit')
    {
        tabs.push({
            key: 'quick-edit-menu',
            icon: 'controls',
            render: function(doc)
            {
                const navHtml = [];
                const contentHtml = [];
                if(!docApp.quickEditMenuActiveTab) docApp.quickEditMenuActiveTab = quickEditMenu[0].key;
                for (const tab of quickEditMenu)
                {
                    const isActive = docApp.quickEditMenuActiveTab === tab.key;
                    const id = `quick-edit-menu-tab-${tab.key}`;
                    navHtml.push(`<li class="nav-item"><a class="${isActive ? 'active' : ''}" data-toggle="tab" href="#${id}">${tab.text}</a></li>`);

                    const itemsCode = zui.jsRaw(tab.items).replaceAll('"', "&quot;").replaceAll('<', '&lt;').replaceAll('>', '&gt;');
                    contentHtml.push(`<div class="tab-pane fade duration-500${isActive ? ' active in' : ''}" id="${id}" data-key="${tab.key}"><menu zui-create="tree" zui-create-tree="{preserve: 'quick-edit-menu-tree-${tab.key}', items: ${itemsCode}, getItem: window.getQuickEditMenuItem}"></menu></div>`);
                }
                return {html: `<ul class="nav nav-tabs">${navHtml.join('')}</ul><div class="tab-content">${contentHtml.join('')}</div>`, className: 'quick-edit-menu', executeScript: true};
            }
        });
    }

    return tabs;
};

/**
 * 获取快捷编辑菜单项。
 * Get the quick edit menu item.
 *
 * @param {object} item
 * @returns {object}
 */
window.getQuickEditMenuItem = function(item)
{
    const holder = item.holder;
    if(holder && !item.command && !item.url)
    {
        const commandParts = [holder.block ? 'editor$.insertHolderBlock' : 'editor$.insertHolderText', encodeURIComponent(holder.name)];
        commandParts.push(encodeURIComponent(JSON.stringify({text: holder.text, hint: item.text})));
        if(holder.data) commandParts.push(encodeURIComponent(JSON.stringify(holder.data)));
        return $.extend({url: `#!${commandParts.join('/')}`}, item);
    }
    return item;
};

/* 插入甘特图。*/
window.insertExecutionChart = function(e, info)
{
    const doc = getDocApp().doc;
    $.ajaxSubmit({
        url: $.createLink('reporttemplate', 'ajaxBuildZentaoChartConfig', `type=${info.item['data-type']}&blockID=0&projectID=${info.item['data-project']}`),
        data: {templateID: doc.data.id}
    });
}

/* 设置图表配置。*/
function getZentaoChartProps(type, blockID, props)
{
    if(props && props.isTemplate) blockID = '__TML_ZENTAOCHART__' + blockID;

    return $.extend(
    {
        exportUrl: `exportZentaoChart_${blockID}`,
        fetcher: $.createLink('reporttemplate', 'ajaxZentaoChart', `type=${type}&blockID=${blockID}&projectID=${projectID}`),
        clearBeforeLoad: false
    }, props);
}

/* 插入图表。*/
window.insertZentaoChart = function(type, blockID, props, replaceBlockID)
{
    if(Number(replaceBlockID)) return replaceZentaoChart(replaceBlockID, type, blockID, props);
    getDocApp().editor.$.insertCustom(getZentaoChartProps(type, blockID, props));
}

/* 替换禅道图表。*/
window.replaceZentaoChart = function(oldBlockID, newType, newblockID, props)
{
    return updateZentaoChart(oldBlockID, {content: getZentaoChartProps(newType, newblockID, props), renderID: $.guid++});
};

/* 更新禅道图表。*/
window.updateZentaoChart = function(blockID, props)
{
    const $block = $('#docApp').find(`.zentao-chart[data-id="${blockID}"]`);
    if(!$block.length) return false;
    getDocApp().editor.$.updateBlock($block[0], props);
};

/* 更新报告数据。*/
function refreshReportData(projectID)
{
    const formData        = new FormData();
    const $holderElements = $('#docApp .affine-zui-holder');
    const $listElements   = $('#docApp .zentao-list');
    const $chartElements  = $('#docApp .zentao-chart');
    $holderElements.each(function()
    {
        const holderName = $(this).attr('data-holder-name');
        formData.append('holders[]', holderName);
    });

    $listElements.each(function()
    {
        formData.append('zentaoList[]', $(this).attr('data-id'));
    });

    $chartElements.each(function()
    {
        formData.append('zentaoChart[]', $(this).attr('data-id'));
    });

    $.post($.createLink('weekly', 'ajaxRefreshData', `projectID=${projectID}`), formData, function(result)
    {
        result = JSON.parse(result);
        if(result.result == 'success')
        {
            /* Update property and measurement. */
            for(let key in result.data.holders)
            {
                const hint = $(`#docApp [data-holder-name=${key}] .affine-zui-holder-container`).attr('title');
                getDocApp().editor.$.updateHolderText({name: key, text: result.data.holders[key].toString(), hint: hint})
            }

            /* Update task, story list data. */
            for(let key in result.data.zentaoList)
            {
                const zentaoList = result.data.zentaoList[key];
                window.insertZentaoList(zentaoList.type, zentaoList.newBlockID, zentaoList.props, zentaoList.oldBlockID);
            }

            /* Update chart data. */
            for(let key in result.data.zentaoChart)
            {
                const zentaoChart = result.data.zentaoChart[key];
                window.insertZentaoChart(zentaoChart.type, zentaoChart.newBlockID, zentaoChart.props, zentaoChart.oldBlockID);
            }
        }
    });
}
