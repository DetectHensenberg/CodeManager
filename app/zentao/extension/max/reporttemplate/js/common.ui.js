window.toggleWhiteList = function(e)
{
    const acl = e.target.value;
    $('#readListBox').toggleClass('hidden', acl == 'open');
    $('#whiteListBox').toggleClass('hidden', acl == 'open');
};

window.clickSubmitForZentaoConfig = function()
{
    const docID = getDocApp()?.docID;
    $("#buildZentaoConfig form [name=templateID]").val(docID);
};

/**
 * 根据是否勾选了所有项目来切换适用流程选择框的禁用状态。
 * Change the disabled status of the process selection box according to whether the all project is checked.
 *
 * @access public
 * @return void
 */
function toggleObjectsBox()
{
    const objectsPicker = $('[name^=objects]').zui('picker');
    if($('[name=allProject]').prop('checked'))
    {
        objectsPicker.$.setValue('');
        objectsPicker.render({disabled: true});
    }
    else
    {
        objectsPicker.render({disabled: false});
    }
}
