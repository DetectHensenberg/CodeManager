$(document).ready(function()
{
    renderMarkdown();
});

/* 渲染 Markdown 内容 */
function renderMarkdown()
{
    if(!content) return;

    new zui.Markdown('#markdownContent', {content});
}
