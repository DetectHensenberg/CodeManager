window.loadAllPrevData = function()
{
    $('.prevField').each(function()
    {
        loadPrevData($(this));
    });
    $('.prevTR').each(function()
    {
        loadPrevData($(this), 0, 'tr');
    });
}