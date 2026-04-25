/* 切换白名单框显示/隐藏 */
window.toggleWhiteListBox = function()
{
    const acl          = $('input[name=acl]:checked').val();
    const whiteListBox = $('#whiteListBox');
    const groupsPicker = whiteListBox.find('select[name^=groups]').zui('picker');
    const usersPicker  = whiteListBox.find('select[name^=users]').zui('picker');

    whiteListBox.toggleClass('hidden', acl !== 'private');

    groupsPicker.$.setValue((isEdit && acl === 'private') ? selectedGroups : '');
    usersPicker.$.setValue((isEdit && acl === 'private') ? selectedUsers : '');
}
