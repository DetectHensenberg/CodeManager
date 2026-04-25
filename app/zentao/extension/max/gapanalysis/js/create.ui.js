/**
 * 更新选中人员的角色。
 * Refresh role.
 *
 * @access public
 * @return void
 */

function refreshRole()
{
    const accountID = $('[name=account]').val();
    $('#role').val(roles[accountID]);
}