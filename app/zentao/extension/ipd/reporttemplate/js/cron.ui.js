window.toggleCron = function(e)
{
    const turnon = e.target.value;
    $('#frequencyBox').toggleClass('hidden', turnon == 'off');
    $('#aclBox').toggleClass('hidden', turnon == 'off');

    const acl = $('input[name="acl"]:checked').val();
    $('#readListBox').toggleClass('hidden', acl == 'open' || turnon == 'off');
    $('#whiteListBox').toggleClass('hidden', acl == 'open' || turnon == 'off');
};