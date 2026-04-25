window.changeProjectModel = function()
{
    var $model = $(this).is('[name^=projectModel]') ? $(this) : $('[name^=projectModel]').first();
    if($model.val() == 'ipd')
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

window.waitDom('.picker-box [name^=projectModel]', function(){
    window.changeProjectModel();
});
