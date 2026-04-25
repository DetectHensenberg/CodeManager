window.changeProjectModel = function()
{
    if($(this).val() == 'ipd')
    {
        $('[name^=projectType]').zui('picker').render({items: ipdTypeList});
        $('[name^=projectType]').zui('picker').$.setValue('ipd');
    }
    else
    {
        $('[name^=projectType]').zui('picker').render({items: defaultTypeList});
        $('[name^=projectType]').zui('picker').$.setValue('product');
    }
};
