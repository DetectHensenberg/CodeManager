window.saveData = function(event)
{
    const myTable = zui.DTable.query();
    const applicableState = myTable.$.getApplicableState();

    const url  = $(event.target).data('url');
    const form = new FormData();
    form.append('type', 'update');
    $.each(applicableState, function(index)
    {
        form.append('checkedList[' + index + ']', applicableState[index] ? 'yes' : 'no');
    });

    $.ajaxSubmit({url, data: form});
};

zui.DTable.definePlugin(
{
    name: 'process-trimming',
    plugins: ['nested'],
    defaultOptions:
    {
        noTrimName:         'noTrim',     // 禁止裁剪属性名
        applicableName:     'applicable', // 裁剪结果状态属性名，true 适用， false 不适用，null 空（未裁剪）
        nested:              true,
        showTrimmingToggles: true,
    },
    state: function() {return {applicableState: {}, savedApplicableState: {}, isSavingApplicableState: false, showTrimmingToggles: this.options.showTrimmingToggles};},
    colTypes:
    {
        trimCheckbox: function(colSetting)
        {
            return {
                width: 40,
                hidden: !this.isShowTrimmingToggles(),
                align: 'center',
                onRenderCell: function(result, info)
                {
                    const rowData = info.row.data;
                    if(rowData[this.options.noTrimName]) return result;

                    const applicable = this.isRowApplicable(info.row.id);
                    if(applicable === true)       result[0] = {html: '<div class="dtable-applicable-toggle w-3 h-3 rounded canvas state ring ring-darker hover:ring-primary text-success hover:text-primary center"><i class="icon icon-check"></i></div>'};
                    else if(applicable === false) result[0] = {html: '<div class="dtable-applicable-toggle w-3 h-3 rounded canvas state ring ring-darker hover:ring-primary text-danger hover:text-primary center"><i class="icon icon-close"></i></div>'};
                    else                          result[0] = {html: '<div class="dtable-applicable-toggle w-3 h-3 rounded canvas state ring ring-darker hover:ring-primary hover:text-primary center"></div>'};
                    return result;
                }
            };
        },
        applicableState:
        {
            onRenderCell: function(result, info)
            {
                const rowData    = info.row.data;
                const applicable = this.isRowApplicable(info.row.id);
                const mapValue   = info.col.setting.map ? info.col.setting.map[applicable] : undefined;
                if(mapValue !== undefined) result[0] = mapValue;
                return result;
            }
        }
    },
    footer:
    {
        trimmingActions: function(_, layout)
        {
            const showTrimmingToggles = this.isShowTrimmingToggles();
            const saveURL = this.options.saveURL;
            const backURL = this.options.backURL;
            const savingClass = this.state.isSavingApplicableState ? ' disabled' : '';
            const jsx = zui.jsx || zui.html;
            return [
                jsx`<button type="button" class="btn primary size-sm mr-4${savingClass}" data-url="${saveURL}" data-on='click' data-call='saveData' data-params='event'>${zui.i18n.getLang('save')}</button>`,
                jsx`<a type="button" class="btn size-sm mr-4${savingClass}" href="${backURL}">${zui.i18n.getLang('cancel')}</a>`,
                this.options.trimingActionsTip,
            ]
        }
    },
    methods:
    {
        /* 检查指定行是否可以进行裁剪，true 适用（未裁剪），false 不适用（已裁剪），null 空（待定） */
        isRowApplicable: function(rowID)
        {
            const {applicableState, savedApplicableState} = this.state;
            const modifiedApplicableState = applicableState[rowID];
            if(modifiedApplicableState !== undefined) return modifiedApplicableState;

            const saveApplicableState = savedApplicableState[rowID];
            if(saveApplicableState !== undefined) return saveApplicableState;

            const row = this.getRowInfo(rowID);
            if(row.data[this.options.noTrimName]) return null;
            return row ? row.data[this.options.applicableName] : null;
        },

        /* 获取当前的裁剪状态，includeAll 参数为 true 时会返回所有行，否则只返回用户变更过的行 */
        getApplicableState: function(includeAll)
        {
            const originState = {};
            this.layout.allRows.forEach((row) =>
            {
                if(row.data[this.options.noTrimName]) return;
                originState[row.id] = row.data[this.options.applicableName];
            });

            const {applicableState, savedApplicableState} = this.state;
            if(includeAll) return Object.assign({}, originState, savedApplicableState, applicableState);

            const state = {};
            Object.keys(applicableState).forEach((rowID) =>
            {
                let newValue = applicableState[rowID];
                if(newValue === originState[rowID] || newValue === savedApplicableState[rowID]) return;
                state[rowID] = newValue;
            });
            return state;
        },

        /* 切换行的裁剪适用状态，true 适用（未裁剪），false 不适用（已裁剪），null 空（待定） */
        toggleRowApplicable: function(rowID, toggle)
        {
            const row = this.getRowInfo(rowID);
            const noTrimName = this.options.noTrimName;
            if(row.data[noTrimName]) return;

            const allState = this.getApplicableState(true);
            const oldApplicable = allState[rowID];
            if(toggle !== undefined && toggle === oldApplicable) return;

            if(toggle === undefined) toggle = !oldApplicable;
            const currentState = this.state.applicableState;
            const newState = Object.assign({}, currentState, {[rowID]: toggle});


            const nestedMap = this.data.nestedMap;
            const nestedInfo = nestedMap.get(rowID); // {children: ['121', '123', '125'], parent: 'P-a'}
            const relatedRows = new Set();

            // 子级设置为不适用
            let children = nestedInfo.children;
            while(children && children.length)
            {
                const newChildren = [];
                children.forEach((childID) =>
                {
                    if(relatedRows.has(childID)) return;
                    relatedRows.add(childID);
                    const childInfo = nestedMap.get(childID);
                    if(childInfo.children) newChildren.push(...childInfo.children);
                });
                children = newChildren;
            }

            if(toggle === true) // 父级和子级都需要设置为适用
            {
                let parentID = nestedInfo.parent;
                while(parentID !== undefined)
                {
                    relatedRows.add(parentID);
                    const parentInfo = nestedMap.get(parentID);
                    parentID = parentInfo.parent;
                }
            }

            relatedRows.forEach(id =>
            {
                const theRow = this.getRowInfo(id);
                if(theRow.data[noTrimName]) return;
                newState[id] = toggle;
            });
            this.setState({applicableState: newState});
        },

        /* 切换行的裁剪操作按钮，如果不指定 show 参数则自动切换和隐藏 */
        showTrimmingToggles: function(show)
        {
            if(show === undefined) show = !this.state.showTrimmingToggles;
            this.update({dirtyType: 'layout', state: {showTrimmingToggles: show}});
        },

        /* 检查是否显示裁剪操作按钮 */
        isShowTrimmingToggles: function()
        {
            let showTrimmingToggles = this.state.showTrimmingToggles;
            if(showTrimmingToggles === undefined) showTrimmingToggles = this.options.showTrimmingToggles;
            return showTrimmingToggles;
        },

        /* 保存裁剪状态 */
        saveApplicableState: async function()
        {
            const onSaveApplicableState = this.options.onSaveApplicableState;
            const newState = {isSavingApplicableState: false};
            if(onSaveApplicableState)
            {
                this.setState({isSavingApplicableState: true});
                const changedState = this.getApplicableState();
                if(!Object.keys(changedState).length)
                {
                    newState.showTrimmingToggles = false;
                    this.update({dirtyType: 'layout', state: newState});
                    return false;
                }

                const result = await onSaveApplicableState(changedState);
                if(result === false)
                {
                    this.setState(newState);
                    return false;
                }
                if(result === true)
                {
                    const {applicableState, savedApplicableState} = this.state;
                    newState.applicableState = {};
                    newState.savedApplicableState = $.extend({}, savedApplicableState, applicableState);
                }
            }
            newState.showTrimmingToggles = false;
            this.update({dirtyType: 'layout', state: newState});
        }
    },
    onAddCol: function(col)
    {
        if(col.type === 'trimCheckbox' && !this.state.showTrimmingToggles) col.hidden = true;
    },
    onCellClick: function(event, info)
    {
        if($(event.target).closest('.dtable-applicable-toggle').length) this.toggleRowApplicable(info.rowID);
    }
});
