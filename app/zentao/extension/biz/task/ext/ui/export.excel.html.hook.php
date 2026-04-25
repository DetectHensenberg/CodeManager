<?php
namespace zin;
$type        = data('type');
$executionID = data('executionID');
$orderBy     = data('orderBy');
?>

<?php if($type == 'group'):?>
<script>
$(function()
{
    $('#exportPanel .form-group, #exportPanel .form-row').addClass('hidden');
    $('#exportPanel .form-group[data-name=fileName], #exportPanel .form-row:last-child').removeClass('hidden');
    $('#exportPanel .form-group[data-name=fileType]').remove();
    $('#exportPanel .form-actions').after("<input type='hidden' name='fileType' value='<?php echo $type;?>' />");
    $('#exportPanel .form-actions').after("<input type='hidden' name='executionID' value='<?php echo $executionID;?>' />");
    $('#exportPanel .form-actions').after("<input type='hidden' name='orderBy' value='<?php echo $orderBy;?>' />");
})
</script>
<?php endif;?>

<?php if($type == 'tree'):?>
<?php
$radioHtml = <<<EOT
<div class="check-list-inline ml-4">
  <div class="radio-primary">
    <input type="radio" id="excel0" name="excel" checked value="0">
    <label for="excel0">word</label>
  </div>
  <div class="radio-primary">
    <input type="radio" id="excelexcel" name="excel" value="excel">
    <label for="excelexcel">excel</label>
  </div>
</div>
EOT;
?>
<script>
$(function()
{
    $('#exportPanel .form-group[data-name=fileType]').remove();
    $('#exportPanel .form-actions').after("<input type='hidden' name='fileType' value='<?php echo $type;?>' />");
    $('#exportPanel .form-group, #exportPanel .form-row').addClass('hidden');
    $('#exportPanel .form-group[data-name=fileName], #exportPanel .form-row:last-child').removeClass('hidden');
    $('#exportPanel .form-group[data-name=fileName] [name=fileName]').addClass('w-2/3');
    $('#exportPanel .form-group[data-name=fileName]').append(<?php echo json_encode($radioHtml);?>);
})
</script>
<?php endif;?>
