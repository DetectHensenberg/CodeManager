window.changeJoint = function(event)
{
    const joint = $(event.target).val();
    if(joint == 1)
    {
        $('[data-name=product]').hide();
        $('[name=build]').closest('.form-group').hide();
        $('[data-name=execution]').hide();
        $('[data-name=relatedBox]').show();
        $('[data-name=relatedBox]').removeClass('hidden');
        changeProducts();
    }
    else
    {
        $('[data-name=product]').show();
        $('[name=build]').closest('.form-group').show();
        $('[name=build]').closest('.form-group').removeClass('hidden');
        $('[data-name=execution]').show();
        $('[data-name=execution]').removeClass('hidden');
        $('[data-name=relatedBox]').hide();
        loadTestReports($('[name=product]').val());
    }
}

window.changeProducts = function(event)
{
    if(event)
    {
        const productID = $(event.target).val();
        const projectID = $('[name=project]').val() || 0;
        const link = projectID == 0 ? $.createLink('build', 'ajaxGetProductBuilds', 'productID=' + productID + '&varName=builds&build=&branch=all&type=notrunk,withexecution') : $.createLink('build', 'ajaxGetProjectBuilds', 'projectID=' + projectID + '&productID=' + productID + '&varName=builds&build=&branch=all&needCreate=&type=notrunk,withexecution');
        $.getJSON(link, function(items)
        {
            const $testreportPicker = $(event.target).closest('.relatedItem').find('[name^="builds"]').zui('picker');
            $testreportPicker.render({items});
            $testreportPicker.$.setValue('');
        });
    }

    products = '';
    $('[name^=products]').each(function() {products += $(this).val() + ',';})
    loadTestReports(products);
}

window.addLine = function(event)
{
    line = $(event.target).closest('.relatedItem').prop('outerHTML');
    line = line.replace(/products\[\d+\]/g, 'products[' + index+ ']').replace(/builds\[\d+\]\[\]/g, 'builds[' + index+ '][]').replace(/defaultValue/g, 'asd');

    index ++;
    $(event.target).closest('.relatedItem').after(line);
    checkLine();
}

window.removeLine = function(event)
{
    $(event.target).closest('.relatedItem').remove();
    checkLine();
    changeProducts();
}

window.checkLine = function()
{
    $('.removeLine').css('visibility', $('.relatedItem').length == 1 ? 'hidden' : 'visible');
}
