$(document).ready(function() {
  iconModal();
  changeIconTheme();
  changeIcon();
  saveIcon();
  formActions();
});

// 图标数据
const iconData = {
  iconName: iconName,
  iconTheme: parseInt(iconTheme),
};
const colors = themeList[iconData.iconTheme];
iconData.bgColor = colors[0];
iconData.bdColor = colors[1];

function updatePreviewIcon() {
  $('#preview-icon')
    .css('background-color', iconData.bgColor)
    .css('border', '1px solid ' + iconData.bdColor)
    .empty()
    .append(iconList[iconData.iconName]);
}

// 图标弹窗
function iconModal() {
  $('#ai-edit-icon')
    .on('click', function() {
      const iconName = $('#iconName').val();
      const iconTheme = parseInt($('#iconTheme').val());

      iconData.iconTheme = iconTheme;
      iconData.iconName = iconName;

      const colors = themeList[iconData.iconTheme];
      iconData.bgColor = colors[0];
      iconData.bdColor = colors[1];

      updatePreviewIcon();

      $('#theme-buttons button.checked').removeClass('checked');
      $(`#theme-buttons button[index="${iconData.iconTheme}"]`).addClass('checked');

      zui.Modal.open({
        id: 'icon-modal',
      });
    });
}

// 图标弹窗 - 自定义背景色
function changeIconTheme() {
  $('#theme-buttons')
    .on('click', 'button', function() {
      if (!$(this).hasClass('checked')) {
        $('#theme-buttons button.checked').removeClass('checked');

        iconData.iconTheme = parseInt($(this).attr('index'));
        const colors = themeList[iconData.iconTheme];
        iconData.bgColor = colors[0];
        iconData.bdColor = colors[1];

        updatePreviewIcon();

        $(this).addClass('checked');
      }
    });
}

// 图标弹窗 - 自定义 icon
function changeIcon() {
  $('#icon-buttons')
    .on('click', 'svg', function() {
      iconData.iconName = $(this).attr('id');

      updatePreviewIcon();
    });
}

// 图标弹窗 - 保存
function saveIcon() {
  $('#save-icon-button')
    .on('click', function() {
      $('#iconName').val(iconData.iconName);
      $('#iconTheme').val(iconData.iconTheme);

      $('#ai-edit-icon')
        .css('background-color', iconData.bgColor)
        .css('border', '1px solid ' + iconData.bdColor)
        .empty()
        .append($(`#${iconData.iconName}`).clone())
    });
}

// 表单操作
function formActions() {
  // 保存
  $('#save-miniprogram').on('click', function() {
    $('[name="toNext"]').val('0');
  });

  // 下一步
  $('#next-step').on('click', function() {
    $('[name="toNext"]').val('1');
  });
}
