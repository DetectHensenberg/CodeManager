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
        getTableOptions      : getTableOptions,
        onSaveDoc            : handleSaveDoc,
        customRenders        : $.extend(docAppCustomRenders, customRenders),
        getDocViewSidebarTabs: getDocViewSidebarTabs,
        viewModeUrl          : getViewModeUrl,
        isMatchFilter        : isMatchFilter,
        diffEnabled          : false
    });
};

const customRenders =
{
    'app-nav': function(items)
    {
        const docApp = getDocApp();
        if(docApp.mode == 'view')
        {
            const doc = docApp.doc;
            if(doc.data.status == 'pause')
            {
                const docIndex    = items.findIndex(item => item[0] === 'current');
                const versionView = items[docIndex][1];
                const statusLabel = zui.renderCustomContent({className: 'label gray-pale rounded-full ml-1', content: getDocAppLang('pauseText')});
                items[docIndex] = ['current', [versionView, statusLabel]];
            }
        }
        return items;
    },
    toolbar: function()
    {
        if(this.mode == 'list')
        {
            const items = [];
            if(docAppHasPriv('create')) items.push({text: getDocAppLang('create'), icon: 'plus', btnType: 'primary', command: 'createTemplate'});
            return {component: 'toolbar', props: {items: items}};
        }
    },
    'sidebar-footer-hint': function()
    {
        return '';
    }
}

/**
 * 获取查看视图的 URL，用于更新浏览器地址栏。
 * Get the view mode URL for updating the browser address bar.
 */
function getViewModeUrl(options)
{
    if(options.mode == 'view') return $.createLink('reporttemplate', 'view', `templateID=${options.docID}`);
    if(options.mode == 'edit') return $.createLink('reporttemplate', 'edit', `templateID=${options.docID}`);
    return $.createLink('reporttemplate', 'browse', `libID=${options.libID}&moduleID=${options.moduleID}`);
}

/**
 * 获取模板界面上的表格初始化选项。
 * Get the table initialization options on the doc UI.
 *
 * @param {object} options
 * @param {object} info
 * @returns {object}
 */
function getTableOptions(options, info)
{
    const lang = getDocAppLang('tableCols');
    options.data.sort((a, b) => a.id > b.id ? -1 : 1); // Sort by id desc.

    const templateCols = [];
    templateCols.push({...options.cols.find(col => col.name === 'rawID'), type: 'id'});

    /* Set table column. */
    let titleCol     = options.cols.find(col => col.name == 'title');
    let cycleCol     = {name: 'cycle', title: lang.cycle, type: 'category', sort: true};
    let moduleCol    = {name: 'moduleName', title: lang.module, type: 'string', sort: true};
    let objectsCol   = {name: 'objectsName', title: lang.objects, type: 'desc', sort: true};
    let addedByCol   = options.cols.find(col => col.name == 'addedBy');
    let addedDateCol = options.cols.find(col => col.name == 'addedDate');
    let descCol      = {name: 'templateDesc', title: lang.desc, type: 'desc', sort: true}
    let actionsCol   = options.cols.find(col => col.name == 'actions');

    titleCol.title   = lang.title;
    actionsCol.width = '125';

    templateCols.push(titleCol);
    templateCols.push(cycleCol);
    templateCols.push(moduleCol);
    templateCols.push(objectsCol);
    templateCols.push(addedByCol);
    templateCols.push(addedDateCol);
    templateCols.push(descCol);
    templateCols.push(actionsCol);
    options.cols = templateCols;

    /* Set table actions. */
    options.cols.forEach(col =>
    {
        if(col.name === 'actions' && col.actionsMap)
        {
            col.actions = col.actions.filter(action => (action !== 'move' && docAppHasPriv(action)));
            delete col.actionsMap.move;

            const actionsLang = getDocAppLang('actions');
            const privMap     = {edit: docAppHasPriv('edit'), pause: docAppHasPriv('pause'), cron: docAppHasPriv('cron'), delete: docAppHasPriv('delete')};
            $.each(col.actionsMap, (key, value) =>
            {
                value.disabled = !privMap[key];
            });
        }
    });

    options.onRenderCell = function(result, info)
    {
        if(info.col.name == 'title' && result)
        {
            const template = info.row.data;
            if(template.status == 'pause') result[result.length] = {html: '<span class="label gray-pale rounded-full ml-1 flex-none nowrap">' + getDocAppLang('pauseText') + '</span>'};
        }
        return result;
    }

    options.actionsCreator = function(item, info)
    {
        const template    = item.row.data;
        const actionsLang = getDocAppLang('actions');
        const actions = [
            docAppHasPriv('edit')   ? {icon: 'edit',  'hint': actionsLang.editTemplate, command: `startEditDoc/${template.id}`} : null,
            docAppHasPriv('pause')  ? {icon: 'pause', 'hint': actionsLang.pauseTemplate, command: `pauseDoc/${template.id}`, disabled: template.status != 'normal', 'hint': template.status == 'draft' ? getDocAppLang('disabledPauseHint') : getDocAppLang('pauseText')} : null,
            docAppHasPriv('cron')   ? {icon: 'clock', 'hint': actionsLang.cron, command: `cronConfig/${template.id}`} : null,
            docAppHasPriv('delete') ? {icon: 'trash', 'hint': actionsLang.deleteTemplate, command: `deleteDoc/${template.id}`, disabled: template.builtIn != 0, 'hint': template.builtIn != 0 ? getDocAppLang('disabledDeleteHint') : actionsLang.deleteTemplate} : null,
        ];
        return actions;
    }

    options.checkable = false;
    options.footer    = options.footer.filter(f => f !== 'checkbox');
    options.footer    = options.footer.filter(f => f !== 'checkedInfo');

    return options;
}

/**
 * 定义报告模板各个视图和 UI 元素的上的操作方法。
 * Define the operation methods on the views and UI elements of the report template.
 */
$.extend(window.docAppActions,
{
    /**
     * 定义目录的操作按钮。
     * Define the actions on the module page.
     */
    module: function(info)
    {
        const lang   = getLang('actions');
        const items  = [];
        const module = info.data;
        if(docAppHasPriv('editCategory')) items.push({text: lang.editCategory, command: `editModule/${module.id}`});
        if(docAppHasPriv('deleteCategory')) items.push({text: lang.deleteCategory, command: `deleteModule/${module.id}`});

        if(info.ui === 'sidebar')
        {
            return [
                items.length ? {icon: 'ellipsis-v', caret: false, placement: 'bottom-end', size: 'xs', items: items} : null,
            ];
        }

        return items;
    },
    /**
     * 定义文档库的操作按钮。
     * Define the actions of modules.
     */
    lib: function(info)
    {
        const items = [];
        const lib   = info.data;
        const libID = lib?.data == undefined ? lib?.id : lib?.data.id;

        /* 获取侧边栏没有模块时的操作按钮。 Get actions when sidebar no module. */
        if(info.ui === 'sidebar-no-module')
        {
            if(!docAppHasPriv('addCategory')) return;
            return [{text: getLang('addCategory'), command: `addModule/${libID}`, icon: 'plus', type: 'primary-pale'}];
        }

        if(docAppHasPriv('addCategory')) items.push({text: getLang('addCategory'), command: `addModule/${libID}`});

        if(!items.length) return;
        return [{type: 'dropdown', icon: 'cog-outline', square: true, caret: false, placement: 'top-end', items: items}];
    },
    /**
     * 定义模板列表的操作按钮。
     * Define the actions on the template list.
     */
    'doc-list': function(info)
    {
        /* 文档列表没有文档时的按钮。Actions for empty doc list. */
        if(info.ui === 'doc-list-empty')
        {
            const createLang = getLang('create');
            return docAppHasPriv('create') ? [{icon: 'plus', text: createLang, btnType: 'primary', command: 'createTemplate'}] : null;
        }
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
            (isToolbar && docApp.props.showDocHistory !== false) ? {hint: lang.history, icon: 'file-log', command: 'toggleViewSideTab/history'} : null,
            (isToolbar && docApp.props.quickEditMenu) ? {hint: lang.insertSystemData, icon: 'controls', command: 'toggleViewSideTab/quick-edit-menu'} : null,
            {text: lang.basic, size: 'md', type: 'ghost', command: `showSettingModal/${doc.id}`, icon: 'cog-outline'},
            doc.status === 'draft' ? {text: lang.saveDraft, size: 'md', className: 'btn-wide', type: 'secondary', command: `saveDoc/draft`} : null,
            {text: lang.release, size: 'md', className: 'btn-wide', type: 'primary', command: `saveDoc`},
            {text: lang.cancel, size: 'md', className: 'btn-wide', type: 'primary-outline', command: 'cancelEditDoc'},
        ];
    },
    /**
     * 定义模板的操作按钮。
     * Define the actions of template.
     */
    doc: function(info)
    {
        const lang       = getLang();
        const doc        = info.data;
        const isTemplate = doc.templateType !== '';
        const canEditDoc = hasPriv('edit');
        const isChapter  = doc.type === 'chapter';
        /* 侧边栏上的文档操作按钮。Doc actions in sidebar. */
        if(info.ui === 'sidebar')
        {
            const moreItems =
            [
                hasPriv('addChapter') ? {icon: 'plus', text: lang.addSubChapter, command: `addChapter/${doc.id}`} : null,
                hasPriv('addChapter') && doc.parent != 0 ? {icon: 'plus', text: lang.addSameChapter, command: `addChapter/${doc.parent}`} : null,
                !isTemplate && hasPriv('create') ? {icon: 'plus', text: lang.addSubDoc, command: `startCreateDoc/${doc.id}`} : null,
                !isChapter && hasPriv('delete') ? {icon: 'trash', text: lang.delete, command: `deleteDoc/${doc.id}`, disabled: doc.builtIn != 0, 'hint': doc.builtIn != 0 ? getDocAppLang('disabledDeleteHint') : lang.delete} : null,
                isChapter && hasPriv('editChapter') ? {icon: 'pencil', text: lang.editChapter, command: `editChapter/${doc.id}`} : null,
                isChapter && hasPriv('deleteChapter') ? {icon: 'trash', text: lang.deleteChapter, command: `deleteDoc/${doc.id}`} : null,
            ];
            return [
                moreItems.every(item => item === null) ? null : {icon: 'ellipsis-v', caret: false, placement: 'bottom-end', size: 'xs', items: moreItems}
            ];
        }

        const moreItems = [];
        if(hasPriv('delete')) moreItems.push({icon: 'trash', text: lang.delete, command: `deleteDoc/${doc.id}`, disabled: doc.builtIn != 0, 'hint': doc.builtIn != 0 ? getDocAppLang('disabledDeleteHint') : lang.delete});

        const docApp = this;
        const isOpen = isOpenVersion(config.version);
        if(!isOpen && docApp && docApp.mode === 'view' && doc.status != 'draft' && !doc.api && !isTemplate)
        {
            moreItems.push({icon: 'link', text: getLang('relateObject'), className: 'relateObject-btn', command: 'toggleViewSideTab/relateObject'})
        }

        const isToolbar = info.ui === 'toolbar';
        const isInModal = $(this.element).closest('.modal').length;
        const actions = isInModal ? [] : [
            isToolbar ? {hint: docApp.fullscreen ? lang.exitFullscreen : lang.enterFullscreen, icon: docApp.fullscreen ? 'fullscreen-exit' : 'fullscreen', command: 'toggleFullscreen'} : null,
            docAppHasPriv('cron') ? {hint: lang.cron, icon: 'clock', command: `cronConfig/${doc.id}`} : null,
            canEditDoc ? {icon: 'edit', class: doc.editable ? null : 'disabled', type: doc.editable ? 'ghost text-primary' : 'ghost text-gray', hint: doc.editable ? lang.edit : lang.needEditable, rounded: 'lg', command: doc.editable ? 'startEditDoc' : null} : null,
            (isToolbar && docApp.props.showDocOutline !== false) ? {hint: lang.docOutline, icon: 'list-box', command: 'toggleViewSideTab/outline'} : null,
            (isToolbar && docApp.props.showDocHistory !== false) ? {hint: lang.history, icon: 'file-log', command: 'toggleViewSideTab/history'} : null,
            moreItems.length ? {icon: 'icon-ellipsis-v', type: 'dropdown', rounded: 'lg', placement: 'bottom-end', caret: false, items: moreItems} : null,
        ];
        return actions;
    }
});

/* 扩展报告模板命令定义。 Extend the doc app command definition. */
$.extend(window.docAppCommands,
{
    createTemplate: function(_, args)
    {
        const docApp = getDocApp();
        const lib    = docApp.lib;

        const {libID, moduleID} = docApp;
        const url = $.createLink('reporttemplate', 'create', `libID=${libID}&moduleID=${moduleID}`);
        zui.Modal.open({url: url});
    },
    showSettingModal: function(_, args)
    {
        const docApp   = getDocApp();
        const libID    = docApp.libID;
        const moduleID = docApp.moduleID;
        const docID    = args[0] || docApp.docID;
        const url      = $.createLink('reporttemplate', 'ajaxSetBasic', `libID=${libID}&moduleID=${moduleID}&docID=${docID || 0}`);

        zui.Modal.open({url: url});
    },
    pauseDoc: function(_, args)
    {
        const docApp = getDocApp();
        const docID  = args[0] || docApp.docID;
        $.ajaxSubmit(
        {
            confirm: getLang('confirmPause'),
            url:     $.createLink('reporttemplate', 'pause', `docID=${docID}`),
            load:    false,
            onSuccess: function()
            {
                loadPage($.createLink('reporttemplate', 'browse', `libID=${docApp.libID}&moduleID=${docApp.moduleID}`));
            }
        });
    },
    cronConfig: function(_, args)
    {
        const docApp = getDocApp();
        const docID    = args[0] || docApp.docID;

        const url = $.createLink('reporttemplate', 'cron', `docID=${docID}`);
        zui.Modal.open({url: url});
    },
    deleteDoc: function(_, args)
    {
        const docApp = getDocApp();
        const docID  = args[0] || docApp.docID;
        $.ajaxSubmit(
        {
            confirm: getLang('confirmDelete'),
            url:     $.createLink('reporttemplate', 'delete', `docID=${docID}`),
            load:    false,
            onSuccess: function()
            {
                getDocApp().delete('doc', docID);
                loadPage($.createLink('reporttemplate', 'browse', `libID=${docApp.libID}&moduleID=${docApp.moduleID}`));
            }
        });
    },
    addModule: function(_, args)
    {
        const docApp = getDocApp();
        const scope  = args[0];
        const url    = $.createLink('reporttemplate', 'addCategory', `scopeID=${scope}`);
        zui.Modal.open({size: 'sm', url: url});
    },
    editModule: function(_, args)
    {
        const docApp   = getDocApp();
        const moduleID = args[0] || docApp.moduleID;
        const url      = $.createLink('reporttemplate', 'editCategory', `moduleID=${moduleID}`);
        zui.Modal.open({size: 'sm', url: url});
    },
    deleteModule: function(_, args)
    {
        const docApp   = getDocApp();
        const moduleID = args[0] || docApp.moduleID;
        $.get($.createLink('reporttemplate', 'ajaxCheckDeleteCategory', `moduleID=${moduleID}`), function(result)
        {
            if(!result) return zui.Modal.alert(getLang('errorDeleteCategory'));

            $.ajaxSubmit(
            {
                confirm: getLang('confirmDeleteCategory'),
                url: $.createLink('reporttemplate', 'deleteCategory', `moduleID=${moduleID}`),
                load: false,
                onSuccess: function()
                {
                    getDocApp().delete('module', moduleID);
                }
            })
        })
    }
});

function handleSaveDoc(doc)
{
    const docApp = getDocApp();

    if(docApp.isSavingDoc) return;
    docApp.isSavingDoc = true;

    const url     = $.createLink('reporttemplate', 'edit', `templateID=${doc.id}`);
    const docData = {
        rawContent : doc.content,
        status     : doc.status || 'normal',
        contentType: doc.contentType,
        type       : 'text',
        title      : doc.title,
        keywords   : doc.keywords,
        content    : doc.html,
        uid        : (doc.uid || `doc${doc.id}`),
    };
    if(doc.fromVersion) docData.fromVersion = doc.fromVersion;

    return new Promise((resolve, reject) => {
        $.ajaxSubmit({'url': url, 'data': docData, 'load': false, 'onComplete': function(result)
        {
            docApp.isSavingDoc = false;
            resolve(result.newDoc);
            docApp.cancelEditDoc();
        }});
    });
}

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
        if(holder.text) commandParts.push(encodeURIComponent(JSON.stringify({text: holder.text, hint: item.text})));
        if(holder.data) commandParts.push(encodeURIComponent(JSON.stringify(holder.data)));
        return $.extend({url: `#!${commandParts.join('/')}`}, item);
    }
    return item;
};

window.getDocViewSidebarTabs = function(doc, info)
{
    const docApp = getDocApp();
    const tabs   = [
        {key: 'outline', icon: 'list-box', title: getLang('docOutline')},
        {key: 'history', icon: 'file-log', title: getLang('history')}
    ]

    /* 定义快捷编辑菜单标签页。 */
    const quickEditMenu = docApp.props.quickEditMenu;
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

/* 插入禅道列表。*/
window.insertZentaoMeasurement = function(type, props, isNewBlock)
{
    if(!isNewBlock) return getDocApp().editor.$.updateHolderText({name: `${type}_${props.blockID}`, text: props.text, hint: props.hint});
    getDocApp().editor.$.insertHolderText(`${type}_${props.blockID}`, {text: props.text, hint: props.hint}, props);
};

window.insertExecutionMeasurement = function(e, info)
{
    getDocApp().editor.$.insertHolderText(info.item['data-type'], {text: info.item.text, hint: info.item.hint});
};

window.clickHolder = function(info)
{
    const docApp = getDocApp();
    if(docApp.mode != 'edit') return;
    if(!info.holder.data) return;
    if(!info.holder.data.blockID) return;

    const url = $.createLink('reporttemplate', 'ajaxBuildZentaoMeasurementConfig', `type=${info.holder.data.type}&blockID=${info.holder.data.blockID}`);
    zui.Modal.open({url: url});
};

/* 插入图表。*/
window.insertZentaoChart = function(type, blockID, props, replaceBlockID)
{
    if(Number(replaceBlockID)) return replaceZentaoChart(replaceBlockID, type, blockID, props);
    getDocApp().editor.$.insertCustom(getZentaoChartProps(type, blockID, props));
};

/* 设置图表配置。*/
function getZentaoChartProps(type, blockID, props)
{
    if(props && props.isTemplate) blockID = '__TML_ZENTAOCHART__' + blockID;

    return $.extend(
    {
        exportUrl: `exportZentaoChart_${blockID}`,
        fetcher: $.createLink('reporttemplate', 'ajaxZentaoChart', `type=${type}&blockID=${blockID}`),
        clearBeforeLoad: false
    }, props);
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

/* 从编辑器删除图表。*/
window.deleteZentaoChart = function(blockID)
{
    const $block = $('#docApp').find(`.zentao-chart[data-id="${blockID}"]`);
    if(!$block.length) return false;
    getDocApp().editor.$.deleteBlock($block[0]);
};

/* 插入甘特图。*/
window.insertExecutionChart = function(e, info)
{
    const doc = getDocApp().doc;
    $.ajaxSubmit({
        url: $.createLink('reporttemplate', 'ajaxBuildZentaoChartConfig', `type=${info.item['data-type']}`),
        data: {templateID: doc.data.id}
    });
}

/**
 * 检查文档是否符合筛选条件。
 * Check if the doc matches the filter condition.
 *
 * @param {string} type
 */
function isMatchFilter(type, filterType, item)
{
    if(type === 'doc')
    {
        if(filterType === 'createdByMe') return item.addedBy === docAppData.currentUser;
        if(filterType === 'draft')       return item.status === 'draft';
        if(filterType === 'paused')      return item.status === 'pause';
        if(filterType === 'released')    return item.status === 'normal';
    }
    return true;
}

/* 检查是否是开源版。*/
function isOpenVersion(version) {
    return /^\d/.test(version || $('#zuiCSS').attr('href').split('?v=').pop());
}
