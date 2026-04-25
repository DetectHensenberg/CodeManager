$(document).off('click', '#submitModal .modal-actions button').on('click', '#submitModal .modal-actions button', function()
{
    return loadPage(viewURL);
});
