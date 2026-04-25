let choosenAccount = [];
/**
 * 更新选中人员的角色。
 * Refresh role.
 *
 * @access public
 * @return void
 */
function refreshRole(event)
{
    let $account    = $(event.target).closest('td').find('input[name^=account]');
    let $currentRow = $(event.target).closest('tr');
    let $role       = $currentRow.find('.form-batch-input[data-name="role"]');

    if(choosenAccount.includes($account.val()))
    {
        zui.Messager.show({content: errorSameAccount, type: 'danger'});

        const currentPickerID = $currentRow.find('.picker-box[data-name="account"]').attr('id');
        const picker          = zui.Picker.query(`[id='${currentPickerID}']`);
        
        picker.$.setValue('');
        $account.val('');
    }

    if($account.val() && !choosenAccount.includes($account.val())) choosenAccount.push($account.val());

    $role.val(roles[$account.val()]);
}