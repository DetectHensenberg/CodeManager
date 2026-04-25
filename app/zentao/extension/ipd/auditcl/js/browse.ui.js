$(document).off('click', '[data-formaction]').on('click', '[data-formaction]', function () {
    const $this = $(this);
    if ($this.attr('class').indexOf('disabled') !== -1) return;

    const dtable = zui.DTable.query($('#auditcls'));
    const checkedList = dtable.$.getChecks();
    if (!checkedList.length) return;

    const postData = new FormData();
    checkedList.forEach((id) => postData.append('auditclIdList[]', id));

    if ($this.data('page') == 'batch') {
        postAndLoadPage($this.data('formaction'), postData);
    }
    else {
        $.ajaxSubmit({ "url": $this.data('formaction'), "data": postData });
    }
});