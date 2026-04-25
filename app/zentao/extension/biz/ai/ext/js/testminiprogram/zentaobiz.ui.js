$(document).ready(function() {
  initData();
  formFieldChange();
  initPromptEditor();
  initMarkdown();
  generateResult();
  actionSave();
  actionPublish();
});

// 是否已保存
let isSaved = true;

// Markdown 组件
let markdownComponent = null;

// 表单数据管理
const FieldManager = {
  state: {
    fields: [],
    fieldsMap: {},
  },

  setFields(fields) {
    this.state.fields = [];

    fields.forEach(field => {
      this.state.fields
        .push(field.id);
      this.state.fieldsMap[field.id] = field;
    });

    renderList();
  },

  getFields() {
    return this.state.fields
      .map(id => this.state.fieldsMap[id]);
  },
};

// 数据初始化
function initData() {
  let fields = [];

  if (currentFields && currentFields.length > 0) {
    fields = currentFields.map((field, index) => ({
      ...field,
      options: field.options
        ? field.options.split(',')
        : [],
    }));
  }

  FieldManager.setFields(fields);
}

// 渲染列表
function renderList() {
  const fields = FieldManager.getFields();

  renderForm(fields);
}

// 渲染表单项
function renderFormField(field) {
  let fieldHtml = '';

  switch (field.type) {
    case 'text':
      fieldHtml = `
        <input type="text"
          class="form-control"
          name="${field.name}"
          placeholder="${field.placeholder || ''}"
          ${field.required === '1' ? 'required' : ''}>
      `;
      break;

    case 'textarea':
      fieldHtml = `
        <textarea
          class="form-control"
          name="${field.name}"
          placeholder="${field.placeholder || ''}"
          rows="3"
          ${field.required === '1' ? 'required' : ''}></textarea>
      `;
      break;

    case 'radio':
    case 'checkbox':
      if(field.options && field.options.length > 0)
      {
          const options = {
              items: field.options.map(item => ({
                  text: item,
                  value: item,
              })),
              name: field.name,
              limitValueInList: false,
              multiple: field.type === 'checkbox',
              required: field.required === '1',
          };

          const pickerOptions  = JSON.stringify(options).replace(/"/g, '&quot;');
          const dataAttributes = [
              `zui-create="picker"`,
              `zui-create-picker="${pickerOptions}"`,
          ].join(' ');

          fieldHtml = `
              <div
                  class="input-group-control"
                  ${dataAttributes}>
              </div>
          `;
      }
      break;
    default:
      return '';
  }

  return `
    <div class="form-group" data-id="${field.id}">
      <label class="form-label ${field.required === '1' ? 'required' : ''}" for="${field.name}">
        ${field.name}
      </label>
      ${fieldHtml}
    </div>
  `;
}

// 渲染表单
function renderForm(fields) {
  const formFields = $('#form-fields');
  formFields.empty();

  let html = '';

  if (fields.length > 0) {
    fields.forEach(field => {
      html += renderFormField(field);
    });
  }

  formFields.html(html);
}

// 表单数据
const FormFieldData = {};

// 表单字段变化
function formFieldChange() {
  $('#form-fields')
    .on(
      'change',
      'input, textarea, select',
      function() {
        const fieldName = $(this).attr('name');
        const fieldId = $(this).closest('.form-group')
          .data('id');

        const name = fieldName.endsWith('[]')
          ? fieldName.slice(0, -2)
          : fieldName;
        const value = $(this).val();

        FormFieldData[fieldId] = value;

        generatePromptPreview();
      },
    );
}

// 构建输入提示列表
function buildInputSuggestions(query = '') {
  const list = FieldManager.getFields()
    .map(field => ({
      text: field.name,
      value: `${field.name}>`,
    }));

  if (!query) {
    return list;
  }

  return list.filter(item => item.text.includes(query));
}

// 处理 Prompt 文本
function processPromptText(text) {
  if (!text) {
    return '';
  }

  return text
    .replace(/&lt;/g, '<')
    .replace(/&gt;/g, '>');
}

/* 将文本转换为 HTML */
function propmtTextToHtml(text)
{
    let html         = text.replace(/</g, '&lt;').replace(/>/g, '&gt;');
    const fields     = FieldManager.getFields();
    const fieldNames = {};

    fields.forEach(field => {
        fieldNames[field.name] = field.id;
    });

    html = html.replace(/&lt;([^&]+)&gt;/g, function(match, fieldName)
    {
        if(!fieldNames[fieldName]) return match;

        return `<span class="mention-label" data-type="mention" data-id="${fieldName}&gt;" data-label="${fieldName}&gt;" data-mention-suggestion-char="&lt;">&lt;${fieldName}&gt;</span>`;
    });

    const list = html.split('\n');

    return list.map((line) => `<p>${line}</p>`).join('');
}

// Prompt 初始值
const initPrompt = processPromptText(currentPrompt || '');

// Prompt Data
let promptData = {
  editor: null,
  text: initPrompt,
  html: '',
};

// 初始化 Prompt Editor
function initPromptEditor() {
  // 是否为初始化
  let isInit = true;

  promptData.html = propmtTextToHtml(initPrompt);

  promptData.editor = new zui.TEditor('#prompt-editor', {
    content: promptData.html,
    mode: 'plain',
    suggestions: {
      '<': (query) => buildInputSuggestions(query),
    },
    onChange: function(content) {
      promptData.text = content.replace(/\n\n/g, '\n');
      promptData.html = promptData.editor.getHtml();

      // 跳过初始化导致的改动
      if (isInit) {
        isInit = false;
      } else {
        isSaved = false;
      }

      generatePromptPreview();
    },
  });

  generatePromptPreview();
}

// 更新 Prompt 数据
function updatePromptData(data) {
  switch (data.action) {
    case 'update':
      promptData.text = promptData.text
        .replace(new RegExp(`<${data.oldName}>`, 'g'), `<${data.newName}>`);
      break;
    case 'delete':
      promptData.text = promptData.text
        .replace(new RegExp(` <${data.name}> `, 'g'), '');
      break;
    default:
      return;
  }

  isSaved = false;
  promptData.html = propmtTextToHtml(promptData.text);

  promptData.editor.setContent(promptData.html);

  generatePromptPreview();
}

// 初始化 Markdown 组件
function initMarkdown() {
  markdownComponent = new zui.Markdown('#result-preview', {
    content: '',
  });
}

/* 生成 Prompt 预览 */
function generatePromptPreview()
{
    const promptPreview = $('#prompt-preview');
    promptPreview.empty();

    let html     = promptData.text.replace(/</g, '&lt;').replace(/>/g, '&gt;');
    const fields = FieldManager.getFields();

    fields.forEach(field => {
        const { id, name, type } = field;

        let value = `&lt;${name}&gt;`;
        if(FormFieldData[id])
        {
            if(type === 'checkbox')
            {
                const options = FormFieldData[id].filter(item => item);
                if(options.length > 0) value = options.join(',');
            }
            else
            {
                value = FormFieldData[id];
            }
        }

        const list = html.split(`&lt;${name}&gt;`).map(item => item.trim());
        html = list.join(`<span>${value}</span>`);
    });

    promptPreview.html(html);
}

// 生成结果
function generateResult() {
  $('#generate-result')
    .on('click', async function() {
      if($(this).hasClass('disabled')) return;
      if (!hasZaiConfig) {
        zui.Messager.show({content: zaiConfigHint, type: 'danger'});
        return;
      }

      const promptPreview = $('#prompt-preview');
      markdownComponent.render({
        content: '',
      });

      const text = promptPreview.text();
      if (!text) {
        zui.Messager.show({
          content: promptPlaceholder,
          type: 'danger'
        });
        return;
      }

      $(this).addClass('disabled');

      const res = await zui.AIPanel.shared.store
        .postTempMessage({
          content: text,
          onResponse: (message) => {
            if (message.content) {
              markdownComponent.render({
                content: message.content,
              });
            }
          },
        });

      markdownComponent.render({
        content: res.message.content,
      });

      $(this).removeClass('disabled');
    });
}

// 返回列表
function backToList() {
  zui.Modal.hide();
}

// 获取字段数据
function getFieldsData() {
  const fields = FieldManager.getFields();
  return fields.map((field, index) => {
    const {
      name,
      type,
      required,
      placeholder,
      options,
    } = field;
    const fieldData = {
      name,
      type,
      required: required ? '1' : '0',
      appID,
    };

    // 根据字段类型添加相应属性
    if (['text', 'textarea'].includes(type)) {
      fieldData.placeholder = placeholder || '';
    } else if (['radio', 'checkbox'].includes(type)) {
      fieldData.options = options ? options.join(',') : '';
    }

    return fieldData;
  });
}

// 发送页面数据
function postData(data) {
  $.ajax({
    url: $.createLink('ai', 'configuredMiniProgram', `appID=${appID}`),
    type: 'POST',
    data: JSON.stringify(data),
    processData: false,
    contentType: 'application/json; charset=UTF-8',
    dataType: 'json'
  }).done(function(response) {
    if (response.result === 'success') {
      isSaved = true;
      if (response.message) {
        zui.Messager.show({
          content: response.message,
          type: 'success'
        });
      }

      backToList();
    } else {
      if (response.message) {
        zui.Messager.show({
          content: response.message,
          type: 'danger'
        });
      }
    }
  }).fail(function(xhr, status, error) {
    zui.Messager.show({
      content: saveFailed + '：' + error,
      type: 'danger'
    });
  });
}

// 保存页面数据
function saveData(toPublish) {
  // 准备相关数据
  const fields = getFieldsData();
  const prompt = promptData.text.trim();

  // 数据验证
  if (!prompt) {
    zui.Messager.show({
      content: promptPlaceholder,
      type: 'danger'
    });
    return;
  }

  const data = {
    fields,
    prompt,
    toPublish,
  };

  if (toPublish === '0') {
    postData(data);
    return;
  }

  zui.Modal.confirm({
    title: publishConfirm[0],
    message: publishConfirm[1],
    icon: 'icon-exclamation-sign',
    iconClass: 'icon-2x modal-icon-warning',
  })
    .then(confirmed => {
      if (confirmed) {
        postData(data);
      }
    });
}

// 保存
function actionSave() {
  $('#btn-save')
    .on('click', function() {
      saveData('0');
    });
}

// 发布
function actionPublish() {
  $('#btn-publish')
    .on('click', function() {
      saveData('1');
    });
}
