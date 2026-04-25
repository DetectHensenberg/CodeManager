$(function()
{
    if(notifyEmailRequired) $("input[name^=notifyEmail").parent().addClass('required');
    if(customerRequired)    $("input[name^=customer").parent().addClass('required');
    if(contactRequired)     $("input[name^=contact").parent().addClass('required');
})

/**
 * Add item.
 *
 * @param  obj $obj
 * @access public
 * @return void
 */
function addItem(obj)
{
    var item = $('#addItem').html().replace(/%i%/g, itemIndex);
    $(obj).closest('tr').next('.notifyEmailBox').after(item);
    itemIndex ++;
}

/**
 * Delete item.
 *
 * @param  obj $obj
 * @access public
 * @return void
 */
function deleteItem(obj)
{
    $(obj).closest('tr').next('.notifyEmailBox').remove();
    $(obj).closest('tr').prev('.customerBox').remove();
    $(obj).closest('tr').remove();
}
