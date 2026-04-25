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
        $('[data-name=execution]').show();
        $('[data-name=relatedBox]').hide();
        loadTestReports($('[name=product]').val());
    }
}

window.changeProducts = function(event)
{
    if(event)
    {
        const productID   = $(event.target).val();
        const projectID   = $('[name=project]').val() || 0;
        const executionID = $('[name=execution]').val() || 0;

        let link = $.createLink('build', 'ajaxGetExecutionBuilds', 'executionID=' + executionID + '&productID=' + productID + '&varName=testTaskBuild');
        if(executionID == 0) link = $.createLink('build', 'ajaxGetProjectBuilds', 'projectID=' + projectID + '&productID=' + productID + '&varName=builds&build=&branch=all&needCreate=&type=notrunk,withexecution');
        if(executionID == 0 && projectID == 0) link = $.createLink('build', 'ajaxGetProductBuilds', 'productID=' + productID + '&varName=builds&build=&branch=all&type=notrunk,withexecution');
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
    line = line.replace(/products\[\d+\]/g, 'products[' + index+ ']').replace(/builds\[\d+\]\[\]/g, 'builds[' + index+ '][]');
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
