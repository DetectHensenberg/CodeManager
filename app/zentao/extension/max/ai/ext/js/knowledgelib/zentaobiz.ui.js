// 发布知识库
function publishKnowledgeLib(id)
{
    const url = $.createLink('ai', 'publishknowledgelib', `id=${id}`);

    zui.Modal.confirm(confirmPublish).then(res => {
        if(res) {
            $.post(url, (response) => {
                if(response.result === 'success') {
                    zui.Messager.show({content: response.message, type: 'success'});
                    loadCurrentPage();
                } else {
                    zui.Messager.show({content: response.message, type: 'danger'});
                }
            }, 'json');
        }
    });
}

// 下架知识库
function unpublishKnowledgeLib(id)
{
    const url = $.createLink('ai', 'unpublishknowledgelib', `id=${id}`);

    zui.Modal.confirm(confirmUnpublish).then(res => {
        if(res) {
            $.post(url, (response) => {
                if(response.result === 'success') {
                    zui.Messager.show({content: response.message, type: 'success'});
                    loadCurrentPage();
                } else {
                    zui.Messager.show({content: response.message, type: 'danger'});
                }
            }, 'json');
        }
    });
}

// 编辑知识库
function editKnowledgeLib(id)
{
    const type = currentMethod === 'myknowledgelib' ? 'my' : 'team';
    const url = $.createLink('ai', 'editknowledgelib', `id=${id}`);
    loadModal(url, null, { size: 'sm' });
}

// 删除知识库
function deleteKnowledgeLib(id)
{
    const url = $.createLink('ai', 'deleteknowledgelib', `id=${id}`);

    zui.Modal.confirm(confirmDelete).then(res => {
        if(res) {
            $.post(url, (response) => {
                if(response.result === 'success') {
                    zui.Messager.show({content: response.message, type: 'success'});
                    loadCurrentPage();
                } else {
                    zui.Messager.show({content: response.message, type: 'danger'});
                }
            }, 'json');
        }
    });
}

// 卡片操作
window.knowledgeLibAction = function(event)
{
    const target = $(event.target).closest('a');
    const action = target.data('action');
    const id = target.data('id');

    switch (action) {
        case 'publish':
            publishKnowledgeLib(id);
            break;
        case 'unpublish':
            unpublishKnowledgeLib(id);
            break;
        case 'edit':
            editKnowledgeLib(id);
            break;
        case 'delete':
            deleteKnowledgeLib(id);
            break;
        default:
    }
}
