window.addRow = function(e)
{
    const currentGroup = $(e.target).closest('.form-group').clone();
    const prevGroup    = $(e.target).closest('.form-group').prev('.form-group').clone();

    let stageOptions    = zui.Picker.query("[name^='stage']").options;
    let requiredOptions = zui.Picker.query("[name^='required']").options;

    /* 获取已有下拉控件的最大id的值加1赋值给新行. */
    let index = 0;
    const checkedStages = [];
    $(".form-group[id^='stage']").each(function()
    {
        let id = $(this).attr('id').replace(/[^\d]/g, '');
        id = parseInt(id);
        id ++;
        index = id > index ? id : index;

        checkedStages.push($(this).find('input[name^="stage"]').val());
    })

    stageOptions = JSON.parse(JSON.stringify(stageOptions)); // 保证不会影响原来的options
    stageOptions.items.forEach(function(item)
    {
        if(checkedStages.includes(item.value)) item.disabled = true;
    });
    stageOptions.defaultValue = '';

    currentGroup.attr('id', `required${index}`).find('.btn-delete').removeClass('invisible');
    prevGroup.attr('id', `stage${index}`);

    /* 重新初始化新一行的下拉控件. */
    currentGroup.find('.picker-box').html(`<div class='form-group-wrapper picker-box'></div>`, false);
    prevGroup.find('.picker-box').html(`<div class='form-group-wrapper picker-box'></div>`, false);

    currentGroup.find('.form-label').remove();
    prevGroup.find('.form-label').remove();

    $(e.target).closest('.form-group').after(currentGroup);
    $(e.target).closest('.form-group').after(prevGroup);

    new zui.Picker(`#stage${index} .picker-box`, stageOptions);
    new zui.Picker(`#required${index} .picker-box`, requiredOptions);
}

window.deleteRow = function(e)
{
    const currentGroup = $(e.target).closest('.form-group');
    const prevGroup    = currentGroup.prev('.form-group');

    currentGroup.remove();
    prevGroup.remove();

    disableItems();
}

/**
 * 禁用已选中的下拉控件。
 * Disable the selected items in the dropdown control.
 */
window.disableItems = function()
{
    let chosenStages= [];
    $("[name^='stage']").each(function()
    {
        chosenStages.push($(this).val());
    });

    let allItems = zui.Picker.query("[name^='stage']").options.items;
    let stageItems = [];
    for(i = 0; i < allItems.length; i++)
    {
        allItems[i].disabled = false;
        if(chosenStages.includes(allItems[i].value)) allItems[i].disabled = true;
        stageItems[allItems[i].value] = Object.assign({},allItems[i]);
        stageItems[allItems[i].value].i = i;
    }

    $(".form-group[id^='stage']").each(function()
    {
        const $stage  = $(this).find('.picker-box').zui('picker');
        const stageID = $(this).find('input[name^="stage"]').val();
        let currentStageItems = JSON.parse(JSON.stringify(allItems));
        if(stageID != 0) currentStageItems[stageItems[stageID].i].disabled = false;

        $stage.render({items: currentStageItems});
    });
}

window.refreshActivity = function(activityID)
{
    $.getJSON($.createLink('deliverable', 'ajaxGetActivityOptions', `groupID=${groupID}&activityID=${activityID}`), function(data)
    {
        const activityPicker = zui.Picker.query("[name='activity']");
        activityPicker.render({items: data});
        activityPicker.$.setValue(activityID);
    });
}

window.changeModule = function(e)
{
    const module = e.target.value;
    if(module == designModule)
    {
        $('.deliverable-list').closest('.form-group').addClass('hidden');
    }
    else
    {
        $('.deliverable-list').closest('.form-group').removeClass('hidden');
    }
}