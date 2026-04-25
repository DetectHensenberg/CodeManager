window.changeObjects = function()
{
    const objects = $('[name=objects]').val();
    $('.panel-body form [name^=objects]').zui('picker').$.setValue(objects);
}
