$(document).ready(function()
{
    renderMarkdown();
});

window.searchKnowledgeLib = function()
{
    const {knowledgeLibID, contentID, inputTip, type} = $('.search-form').data();
    const content = $('.search-form').find('input[name="content"]').val();
    if(!content.trim())
    {
        zui.Modal.alert(inputTip);
        return false;
    }

    const form = new FormData();
    form.append('content', content);

    postAndLoadPage($.createLink('ai', 'searchknowledgelib', `knowledgeLibID=${knowledgeLibID}&type=${type}&contentID=${contentID}`), form);
}

/* 渲染 Markdown 内容 */
function renderMarkdown()
{
    $('[id^="markdownContent_"]').each(function()
    {
        const $container = $(this);
        const content = $container.data('content');
        if(!content) return;

        try
        {
            new zui.Markdown('#' + this.id, {content});
        }
        catch(error)
        {
            if(config.debug) console.error('Render markdown error:', error);
            $container.text(content);
        }
    });
}

$(document).on('keypress', '.search-form input[name="content"]', function(e)
{
    if(e.key === 'Enter')
    {
        e.preventDefault();
        searchKnowledgeLib();
        return false;
    }
});
