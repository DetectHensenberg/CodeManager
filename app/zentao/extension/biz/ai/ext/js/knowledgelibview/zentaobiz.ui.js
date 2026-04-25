window.knowledgeLibID  = knowledgeLibId;

// 处理需求的跳转链接
window.renderObjectTableCell = function(result, info)
{
    const story = info.row.data;
    if(info.col.name == 'title' && (story.titleLink || story.protocol))
    {
        let link = story.titleLink;
        if(story.protocol) link = $.createLink('api', 'view', `libID=${story.docLib}&apiID=${story.docID}&moduleID=${story.module}`);
        const linkProps = {href: link, class: 'text-link'};
        if(story.titleLinkModal || story.protocol)
        {
            linkProps['data-toggle'] = 'modal';
            linkProps['data-size']   = 'lg';
        }

        result[0] =
        {
            html: `<a href="${linkProps.href}" class="${linkProps.class}" ${linkProps['data-toggle'] ? `data-toggle="${linkProps['data-toggle']}" data-size="${linkProps['data-size']}"` : ''}>${story.title}</a>`
        };
        return result;
    }
    if(info.col.name === 'syncedDate')
    {
        const syncedDateMap = this.state.syncedDateMap || {};
        const syncedDate    = syncedDateMap[story.id];
        if(syncedDate === true)       result[0] = {html: '<i class="icon icon-refresh spin"></i>'};
        else if(syncedDate === false) result[0] = zui.jsx`<div class="text-danger" title="${syncFailedHint}"><i class="icon icon-alert"></i> ${syncFailedText}</div>`;
        else if(syncedDate)           result[0] = zui.formatDate(syncedDate, '[yyyy-]MM-dd hh:mm');
    }
    return result;
};

// 切换标题编辑模式
window.toggleEditMode = function(event)
{
    $('.section-header h2').addClass('edit-mode');

    const input = $('.section-header h2 input');
    input.val($('.section-header h2 span').text());

    setTimeout(() => {
        input.trigger('focus');
    }, 100);
}

// 保存标题
window.updateName = function()
{
    const input = $('.section-header h2 input');
    const name  = input.val().trim();

    if(!name.length)     return $('.section-header h2').removeClass('edit-mode');
    if(!knowledgeItemId) return;

    const url = $.createLink('ai', 'ajaxupdateknowledgeitem', `id=${knowledgeItemId}`);
    $.ajax(
    {
        url     : url,
        type    : 'POST',
        data    : {title: name},
        dataType: 'json',
        success : function(response)
        {
            if(response.result === 'success')
            {
                $('.section-header h2 span').text(name);
                $('.section-header h2').removeClass('edit-mode');
                zui.Messager.success(response.message);
                loadCurrentPage();
            }
            else
            {
                zui.Messager.fail(response.message);
            }
        }
    });
}

window.toggleShowSource = function(event)
{
    const isChecked = $(event.target).prop('checked');
    $('.origin-content').toggleClass('hidden', !isChecked);
    $('.show-content').toggleClass('hidden', isChecked);
}

window.saveTextKnowledge = function()
{
    const {knowledgeID, knowledgeTitle} = $('.origin-content .actions').data();
    $.ajaxSubmit
    ({
        url:  $.createLink('ai', 'ajaxUpdateKnowledgeItem', `id=${knowledgeID}`),
        data: zui.createFormData({title: knowledgeTitle, content: $('[name="content"]').val()}),
        load: true,
        onComplete: () => {
            const $AIKnowledgeChunkList = $('.show-content>div').data('zui.AIKnowledgeChunkList');
            $AIKnowledgeChunkList.$.startSync(true);
        }
    });
}

// 批量删除知识条目
window.handleBatchDeleteBtnClick = function(tableSelector)
{
    const dtable = zui.DTable.query($(tableSelector));
    if(!dtable) return;

    const checkedList = dtable.$.getChecks();
    if(!checkedList.length)
    {
        zui.Messager.show({content: noItemSelected, type: 'warning'});
        return;
    }

    zui.Modal.confirm(confirmBatchDelete).then((confirmed) =>
    {
        if(confirmed)
        {
            const url  = $.createLink('ai', 'batchDeleteKnowledgeItem');
            $.ajaxSubmit({url, data: zui.createFormData({'knowledgeItem[]': checkedList})});
        }
    });
}

// AI 问答
window.openAIChatWithKnowledgeLib = function()
{
    const aiPanel = zui.AIPanel.shared;
    if(!aiPanel) return;

    const contexts = [{
        title: knowledgeLib.name,
        hint: knowledgeLib.name,
        code: `zentao-knowledgeLib-${knowledgeLib.id}`,
        data: {
            memory: {collections: [`zentao:${knowledgeLib.id}`]}
        }
    }];

    aiPanel.open({chat: {contexts: contexts}, select: true});
}

// 发布
window.publishKnowledgeLib = function()
{
    zui.Modal.confirm(confirmPublish).then(res =>
    {
        if(res)
        {
            const url = $.createLink('ai', 'publishknowledgelib', `id=${knowledgeLibId}`);
            $.post(url, (response) =>
            {
                if(response.result === 'success')
                {
                    zui.Messager.success(response.message);
                    loadCurrentPage();
                }
                else
                {
                    zui.Messager.fail(response.message);
                }
            }, 'json');
        }
    });
}

// 下架
window.unpublishKnowledgeLib = function()
{
    zui.Modal.confirm(confirmUnpublish).then(res =>
    {
        if(res)
        {
            const url = $.createLink('ai', 'unpublishknowledgelib', `id=${knowledgeLibId}`);
            $.post(url, (response) =>
            {
                if(response.result === 'success')
                {
                    zui.Messager.success(response.message);
                    loadCurrentPage();
                }
                else
                {
                    zui.Messager.fail(response.message);
                }
            }, 'json');
        }
    });
}
