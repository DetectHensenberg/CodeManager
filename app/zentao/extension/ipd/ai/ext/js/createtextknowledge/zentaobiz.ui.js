// 根据知识内容生成标题
window.generateKnowledgeTitle = async function()
{
    const zaiPanel = await parent.checkZAIPanel(true);
    if(!zaiPanel) return;

    const editors = $('#createTextKnowledgeForm zen-editor[name="content"]');
    const content = editors[0].value;

    if(!content || content.trim() === '')
    {
        zui.Messager.show({
            content: errorNotempty.replace('%s', knowledgeContentLabel),
            type: 'warning'
        });
        return;
    }

    const btn = $('#createTextKnowledgeForm button');
    btn.addClass('disabled');

    const res = await zui.AIPanel.shared.store.generateContentTitle(content);

    $('#createTextKnowledgeForm input[name="title"]').val(res);

    btn.removeClass('disabled');
}
