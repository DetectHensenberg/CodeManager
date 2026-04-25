window.onModuleChangedForBatch = function(event)
{
    const $target     = $(event.target);
    const $currentRow = $target.closest('tr');
    const moduleID    = $target.val();
    const productID   = $currentRow.find('.form-batch-control[data-name="product"]').length ? $currentRow.find('.form-batch-control[data-name="product"] input').val() : productID;

    loadScenesForBatch(productID, moduleID, $currentRow);
    loadStoriesForBatch(productID, moduleID, 0, $currentRow);
}
