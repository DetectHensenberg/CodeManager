window.toggleWhiteList = function(e)
{
    const acl = e.target.value;
    $('#readListBox').toggleClass('hidden', acl == 'open');
    $('#whiteListBox').toggleClass('hidden', acl == 'open');
}
