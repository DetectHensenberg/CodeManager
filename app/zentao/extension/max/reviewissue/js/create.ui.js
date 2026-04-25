window.reviewChange = function(reviewID)
{
    $.getJSON($.createLink('reviewissue', 'ajaxGetCategory',`reviewID=${reviewID}`), function(categoryItems)
    {
        const oldCategory     = $('[name=category]').val();
        const $categoryPicker = $('[name=category]').zui('picker');
        $categoryPicker.render({items: categoryItems});
        $categoryPicker.$.setValue(oldCategory);
    })

    categoryChange($('[name=category]').val());
}

window.categoryChange = function(category)
{
    const reviewID = $('[name=review]').val();
    $.getJSON($.createLink('reviewissue', 'ajaxGetCheck',`reviewID=${reviewID}&category=${category}`), function(checkItems)
    {
        const $checkPicker = $('[name=listID]').zui('picker');
        const oldCheckID   = $('[name=listID]').val();

        $checkPicker.render({items: checkItems});
        $checkPicker.$.setValue(oldCheckID);
    })
}
