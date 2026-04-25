const KnowledgeLibStore = {
    list: knowledgeLibs || [],
    selectedID: selectedID ? selectedID.map(id => parseInt(id)) : [],
};

/* 切换知识库空间，加载知识库列表 */
window.toggleSpace = () => {
    const $form = $('#selectKnowledgeLibForm');
    const picker = $form.find('[name="libID"]').zui('picker');
    const space = $form.find('input[name="space"]:checked').val();

    picker.render({items: []});
    picker.$.setValue('');

    $.getJSON($.createLink('ai', 'ajaxGetKnowledgeLibs', 'type=' + space), function(data)
    {
        KnowledgeLibStore.list = data;
        const items = data
            .filter(lib => !KnowledgeLibStore.selectedID.includes(lib.id))
            .map(lib => ({text: lib.name, value: lib.id}));
        picker.render({items});
    });
};

/* 提交拦截 */
window.selectKnowledgeLibFormBeforeSubmit = () => {
    if(!callback) return false;

    const selector = multiple ? '[name="libID[]"]' : '[name="libID"]';
    const pickerValue = $(selector).val();
    if(!pickerValue || (multiple && pickerValue.length === 0))
    {
        zui.Messager.show({
          content: pleaseSelectKnowledgeLib,
          type: 'danger',
        });
        return false;
    }

    const ids  = multiple ? pickerValue : [pickerValue];
    const libs = ids.map(id => KnowledgeLibStore.list.find(lib => parseInt(lib.id) === parseInt(id)));

    window[callback](libs);

    zui.Modal.hide();
    return false;
};
