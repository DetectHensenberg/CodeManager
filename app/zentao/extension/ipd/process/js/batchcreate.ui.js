window.changeModule = function()
{
    const module = $('[name=moduleID]').val();
    $('.panel-body form [name^=module]').zui('picker').$.setValue(module);
}
