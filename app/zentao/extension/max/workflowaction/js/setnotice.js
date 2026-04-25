$('.createContact').click(function()
{
    $('#triggerModal').load($(this).prop('href'), function()
    {
        $.zui.ajustModalPosition();
    });
    return false;
});

/**
 * Set mailto users by id.
 *
 * @param string mailto
 * @param int    contactListID
 * @access public
 * @return void
 */
function setMailto(mailto, contactListID)
{
    link = createLink('user', 'ajaxGetOldContactUsers', 'contactListID=' + contactListID);
    $.get(link, function(users)
    {
        $('#' + mailto).replaceWith(users);
        $('#' + mailto + '_chosen').remove();
        $('#' + mailto).chosen();
    });
}