$(document).ready(function() {
  checkAndUpdateActions();
  formChange();
  submitForm();
});

// 检查和修改按钮状态
function checkAndUpdateActions() {
  const targetForm = $('input[name="targetForm"]:checked').val();

  if (targetForm) {
    $('#submit').prop('disabled', false);
    $('#go-test-btn').prop('disabled', false);
  } else {
    $('#submit').prop('disabled', true);
    $('#go-test-btn').prop('disabled', true);
  }
}

// 表单变化
function formChange() {
  $('input[name="targetForm"]')
    .on('change', function() {
      checkAndUpdateActions();
    });
}

// 发送表单数据
function postFormData(data) {
  $.ajax({
    url: $.createLink('ai', 'promptSetTargetForm', 'prompt=' + promptID),
    type: 'POST',
    data: data,
    dataType: 'json',
    success: function(response) {
      if (response.result === 'success') {
        if (response.msg || response.message) {
          const msg = response.msg || response.message;
          zui.Messager.show({content: msg, type: 'success'});
        }
        if (response.locate) {
          openUrl(response.locate);
        }
      } else {
        if (response.message) {
          zui.Messager.show({content: response.message, type: 'danger'});
        }
      }
    },
    error: function(xhr, status, error) {
      zui.Messager.show({content: lang.saveFailed + '：' + error, type: 'danger'});
    }
  });
}

// 下一步/去调试 提交数据
function submitForm() {
  $('#submit').on('click', function(e) {
    e.preventDefault(); // 阻止默认表单提交

    const targetForm = $('input[name="targetForm"]:checked').val();
    if (!targetForm) {
      return false;
    }

    const data = {
      targetForm: targetForm,
      jumpToNext: '1'
    };

    postFormData(data);
  });

  $('#go-test-btn').on('click', function(e) {
    e.preventDefault(); // 阻止默认表单提交

    const targetForm = $('input[name="targetForm"]:checked').val();
    if (!targetForm) return false;

    const data = {
      targetForm: targetForm,
      jumpToNext: '0'
    };

    $.ajaxSubmit(
    {
      url: $.createLink('ai', 'promptSetTargetForm', 'prompt=' + promptID),
      data: data,
      load: false,
      onSuccess: function()
      {
        getTestingLocation(promptID);
      },
      onFail: () => {
        zui.Messager.show({content: lang.saveFailed, type: 'danger'});
      }
    });
  });
}
