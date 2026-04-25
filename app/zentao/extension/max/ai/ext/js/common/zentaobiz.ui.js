(({jsx, ReactComponent, ComponentFromReact, signal, fetchData, reactComponents}) =>
{
    if(zui.AIKnowledgeChunkList) return;

    /**
     * Knowledge chunk list component.
     *
     * Props:
     * - id: Knowledge item ID.
     */
    class AIKnowledgeChunkListJSX extends ReactComponent
    {
        chunks$    = signal([]);    // Loaded chunks list.
        error$     = signal('');    // Error message.
        loading$   = signal(false); // Loading state.
        synced$    = signal(false); // Whether synced.
        needSync$  = signal(false); // Whether need to sync.
        waitTimer$ = signal(0);     // Wait timer after synced.

        componentDidMount()
        {
            this.load();
        }

        componentDidUpdate(prevProps)
        {
            if(prevProps.id !== this.props.id) this.load(true);
        }

        componentWillUnmount()
        {
            this.resetTimer();
        }

        resetTimer(callback, delay)
        {
            if(this.waitTimer$.value) clearInterval(this.waitTimer$.value);
            this.waitTimer$.value = 0;
            if(callback) this.waitTimer$.value = setInterval(callback, delay || 5000);
        }

        /** Start sync knowledge item to zai and wait chunks. */
        async startSync(reset)
        {
            if(reset)
            {
                this.needSync$.value = true;
                this.loading$.value = true;
                this.chunks$.value = [];
            }

            if(!this.needSync$.value || this.waitTimer$.value) return;
            this.synced$.value = true;

            try
            {
                const url    = $.createLink('ai', 'ajaxSyncKnowledgeItem', `id=${this.props.id}&force=yes`);
                const result = await fetchData(url, [], {method: 'POST'});
                if(result.result !== 'success') this.error$.value  = result.message;
                this.loading$.value = true;
                this.resetTimer(() =>
                {
                    this.loading$.value = false;
                    this.load();
                }, 5000);
            }
            catch(error)
            {
                if(config.debug) console.error(error);
                this.error$.value = String(error);
            }
            this.needSync$.value  = false;
        }

        /** Load chunks list. */
        async load(reset)
        {
            if(this.loading$.value) return;

            this.loading$.value = true;
            this.error$.value   = '';

            if(reset)
            {
                this.resetTimer();
                this.chunks$.value   = [];
                this.needSync$.value = false;
                this.synced$.value   = false;
            }

            const url = $.createLink('ai', 'ajaxGetKnowledgeChunks', `id=${this.props.id}&force=yes`);
            try
            {
                const result = await fetchData(url);
                if(result.result === 'success')
                {
                    this.chunks$.value  = result.data;
                    this.error$.value   = '';

                    this.resetTimer();
                    if(Array.isArray(result.data) && !result.data.length && !result.needSync)
                    {
                        this.waitTimer$.value = setTimeout(() =>
                        {
                            if(!this.loading$.value) this.load();
                        }, 5000);
                    }
                }
                else
                {
                    this.chunks$.value = [];
                    this.error$.value  = result.message + (result.error ? ` (${result.error})` : '');
                    if(result.error) this.resetTimer();
                }
                if(result.needSync && !this.chunks$.value.length)
                {
                    this.needSync$.value = true;
                    if(!this.synced$.value) this.startSync();
                }
            }
            catch(error)
            {
                if(config.debug) console.error(error);
                this.error$.value = String(error);
            }
            this.loading$.value = false;
        }

        render()
        {
            const props     = this.props;
            const chunks    = this.chunks$.value || [];
            const error     = this.error$.value;
            const hasTimer  = this.waitTimer$.value;
            let contentView = null;
            if(chunks.length)
            {
                const {MarkdownContent} = reactComponents;
                contentView = chunks.map((chunk) => {
                    if(chunk.payload && chunk.payload.content_type === 'markdown') return jsx`<div key=${chunk.id} class="knowledge-chunk-item whitespace-pre-wrap surface p-4"><${MarkdownContent} content=${chunk.content}><//></div>`;
                    return jsx`<div key=${chunk.id} class="knowledge-chunk-item whitespace-pre-wrap surface p-4"><p>${chunk.content}</p></div>`;
                });
            }
            else
            {
                let hintText = '';
                if(this.needSync$.value && !hasTimer) hintText = props.needSyncKnowledgeItemText;
                else if(error) hintText = jsx`<p class="text-danger">${error}</p>`;
                else if(hasTimer) hintText = jsx`<p><i class="icon spin icon-spinner-indicator"></i> ${props.syncingKnowledgeItemText}</p>`;
                else hintText = this.synced$.value ? props.emptyKnowledgeDataText : '';
                contentView = jsx`<div class="alert col gap-2 py-8"><p class="text-info">${hintText}</p></div>`;
            }
            return jsx`<div class="knowledge-chunk-list col gap-4 relative load-indicator${(this.loading$.value && !hasTimer) ? ' loading' : ''}">${contentView}</div>`;
        }
    }

    class AIKnowledgeChunkList extends ComponentFromReact
    {
        static NAME      = 'AIKnowledgeChunkList';
        static Component = AIKnowledgeChunkListJSX;
    }

    AIKnowledgeChunkList.register();
    zui.AIKnowledgeChunkList = AIKnowledgeChunkList;
})(zui);

window.changePromptName = function(event)
{
    const hasValue = event.target.value?.length > 0;
    $('button[type="submit"]').toggleClass('disabled', !hasValue).prop('disabled', !hasValue);
}

window.initPromptForm = function()
{
    if(!$('input[name="name"]').val()?.length) $('button[type="submit"]').addClass('disabled').attr('disabled', 'disabled');
}

window.syncKnowledgeItemsToZAI = async function(idList, options)
{
    options = options || {};
    const {beforeSync, afterSync} = options;
    const syncedDateMap = {};
    const updateDTable = (id, syncedDate) =>
    {
        const dtable    = zui.DTable.query('#knowledgeObjectList');
        if(!dtable || !dtable.$) return;
        syncedDateMap[id] = syncedDate;
        dtable.$.setState({syncedDateMap: {...syncedDateMap}});
    };
    for(const id of idList)
    {
        beforeSync && beforeSync(id);
        let isSuccess = false;
        let error = null;
        try
        {
            updateDTable(id, true);
            const result = await zui.fetchData($.createLink('ai', 'ajaxSyncKnowledgeItem', `id=${id}&force=${options.updateFromSource ? 'update' : (options.force ? 'yes' : 'no')}`), [], {method: 'POST'});
            isSuccess = typeof result === 'object' && result.result === 'success';
            updateDTable(id, isSuccess ? (result.syncedDate || Date.now()) : false);
        }
        catch(_)
        {
            if(config.debug) console.error('Sync items to zai error:', _, id);
            error = _;
        }
        afterSync && afterSync(id, isSuccess, error);
    }
}

window.requestSyncObjectListToZAI = async function(knowledgeLibID, objectType, silence, updateFromSourceFirst)
{
    const $btn       = $('#syncObjectListBtn');
    const originText = $btn.find('.text').text();
    const finish     = (message, isSuccess) =>
    {
        $btn.removeClass('disabled');
        $btn.find('.text').text(originText);
        $btn.find('.icon').removeClass('spin');
        if(message) zui.Messager[isSuccess ? 'success' : 'fail'](message);
    };

    try
    {
        objectType = objectType || 'all';
        const res = await zui.fetchData($.createLink('ai', 'ajaxGetKnowledgeObjectList', `knowledgeLibID=${knowledgeLibID}&objectType=${objectType}`));
        if(!res || typeof res !== 'object') return finish(typeof res === 'string' ? res : '');
        if(res.result !== 'success')        return finish(typeof res.message === 'string' ? res.message : '');

        const {needSyncList, allList, lang} = res.data;
        if((!needSyncList.length && !updateFromSourceFirst) || (!allList.length && updateFromSourceFirst))
        {
            if(!silence) zui.Modal.alert(lang.noDataNeedToUpdate);
            return finish();
        }

        if(!silence)
        {
            const confirmed = await zui.Modal.confirm(updateFromSourceFirst ? lang.updateFromSourceConfirm : lang.syncListToZAIConfirm);
            if(!confirmed) return finish();
        }

        const finishedList = [];
        const totalCount   = updateFromSourceFirst ? allList.length : needSyncList.length;
        $btn.find('.icon').addClass('spin');
        let failedCount    = 0;
        await syncKnowledgeItemsToZAI(updateFromSourceFirst ? allList : needSyncList,
        {
            updateFromSource: updateFromSourceFirst,
            beforeSync:       () => $btn.find('.text').text(`${lang.syncingData} ${finishedList.length}/${totalCount}`),
            afterSync:        (id, isSuccess) =>
            {
                finishedList.push(id);
                $btn.find('.text').text(`${lang.syncingData} ${finishedList.length}/${totalCount}`);
                if(!isSuccess) failedCount++;
            }
        });
        if(failedCount && !silence)
        {
            zui.Modal.alert(lang.syncFailedCountAlert.replace('%s', failedCount));
        }
        if(updateFromSourceFirst) loadCurrentPage();
        finish();
    }
    catch(error)
    {
        finish(String(error));
    }
}
