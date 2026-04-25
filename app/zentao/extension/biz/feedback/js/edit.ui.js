window.changeProduct = function()
{
    const productID = $('[name=product]').val();
    const url = $.createLink('feedback', 'edit', 'id=' + feedbackID + '&productID=' + productID);
    isInModal ? loadModal(url) : loadPage(url);
}
