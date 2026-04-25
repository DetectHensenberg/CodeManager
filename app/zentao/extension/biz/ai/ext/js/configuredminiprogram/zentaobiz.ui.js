$(document).ready(function() {
  initData();
  fieldItemActions();
  watchFieldTypeChange();
  fieldOptionActions();
  fieldOptionsChange();
  fieldModalSave();
  knowledgeLibItemActions();
  formFieldChange();
  initPromptEditor();
  initMarkdown();
  generateResult();
  actionBackToList();
  backModalActions();
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
    // ID 列表
    fields: [
      // id,
    ],
    // 数据存储
    fieldsMap: {
      // id: field,
    },
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

  setFieldIds(fieldIds) {
    this.state.fields = fieldIds;

    renderList();
  },

  addField(field, afterId = null) {
    // 生成 ID
    const id = Date.now();
    field.id = id;

    const index = afterId
      ? this.state.fields.indexOf(afterId)
      : -1;

    if (index === -1) {
      this.state.fields
        .push(id);
    } else {
      this.state.fields
        .splice(index + 1, 0, id);
    }

    this.state.fieldsMap[id] = field;

    renderList();
  },

  updateField(field) {
    const oldName = this.state.fieldsMap[field.id].name;
    const newName = field.name;
    this.state.fieldsMap[field.id] = field;

    renderList();

    if (oldName !== newName) {
      updatePromptData({
        action: 'update',
        id: field.id,
        oldName,
        newName,
      });
    }
  },

  removeField(fieldId) {
    const index = this.state.fields.indexOf(fieldId);
    if (index > -1) {
      const name = this.state.fieldsMap[fieldId].name;

      this.state.fields.splice(index, 1);
      delete this.state.fieldsMap[fieldId];

      renderList();

      updatePromptData({
        action: 'delete',
        id: fieldId,
        name,
      });
    }
  },

  getField(id) {
    return this.state.fieldsMap[id];
  },

  getFields() {
    return this.state.fields
      .map(id => this.state.fieldsMap[id]);
  },
};

// Modal 数据管理
const ModalManager = {
  state: {
    action: '',
    id: '',
    type: '',
    options: [],
  },

  setAction(action) {
    this.state.action = action;
  },

  getAction() {
    return this.state.action;
  },

  setId(id) {
    this.state.id = id;
  },

  getId() {
    return this.state.id;
  },

  setType(type) {
    this.state.type = type;

    renderOptions();
  },

  getType() {
    return this.state.type;
  },

  setOptions(options, render = true) {
    this.state.options = options;

    if (render) {
      renderOptions();
    }
  },

  getOptions() {
    return this.state.options;
  },

  setState(state) {
    this.state = state;

    renderOptions();
  },

  getState() {
    return this.state;
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

  KnowledgeLibManager.setLibs(knowledgeLibs || []);
}

// 渲染列表
function renderList() {
  const fields = FieldManager.getFields();

  renderFieldList(fields);
  renderForm(fields);
}

// 渲染字段列表占位符
function renderFieldListPlaceholder() {
  return `
    <div
      class="field-empty"
      id="add-field">
      <div class="action">
        <i class="icon icon-plus"></i>
        <span>${fieldAdd}</span>
      </div>
      <div class="tips">${fieldAddTip}</div>
    </div>
  `;
}

// 渲染字段项
function renderFieldItem(field) {
  return `
    <li class="field-item" data-id="${field.id}">
      <i class="icon icon-move"></i>
      <span class="name text-ellipsis">${field.name}</span>
      <span class="asterisk">${field.required === '1' ? '*' : ''}</span>
      <div class="text-ellipsis">${field.placeholder || ''}</div>
      <button
        class="btn size-sm square"
        data-action="add">
        <i class="icon icon-plus"></i>
      </button>
      <button
        class="btn size-sm square"
        data-action="edit">
        <i class="icon icon-edit"></i>
      </button>
      <button
        class="btn size-sm square"
        data-action="delete">
        <i class="icon icon-trash"></i>
      </button>
    </li>
  `;
}

// 渲染字段列表
function renderFieldList(fields) {
  const fieldList = $('#field-list');
  fieldList.empty();

  let html = '';

  if (fields.length === 0) {
    html = renderFieldListPlaceholder();
  } else {
    fields.forEach(field => {
      html += renderFieldItem(field);
    });
  }

  fieldList.html(html);

  // 初始化拖动排序
  fieldListSortable();
}

// 字段列表拖动排序
function fieldListSortable() {
  if ($('#field-list').data('sortable-initialized')) {
    return;
  }

  new zui.Sortable('#field-list', {
    handle: '.field-item',
    animation: 150,
    ghostClass: 'bg-primary-pale',
    onSort: function(event) {
      const newOrder = [];
      $('#field-list .field-item').each(function() {
        const fieldId = $(this).data('id');
        newOrder.push(fieldId);
      });

      FieldManager.setFieldIds(newOrder);
    }
  });

  $('#field-list').data('sortable-initialized', true);
}

/* 知识库数据管理 */
const KnowledgeLibManager = {
    state: {
        libs: [],
        libsMap: {},
        action: '',
        targetId: '',
    },

    setLibs(libs)
    {
        this.state.libs = [];

        libs.forEach(lib => {
            this.state.libs.push(lib.id);
            this.state.libsMap[lib.id] = lib;
        });

        renderKnowledgeLibs();
    },

    setLibIds(libIds)
    {
        this.state.libs = libIds;

        renderKnowledgeLibs();
    },

    addLib(lib, afterId = null)
    {
        const index = afterId ? this.state.libs.indexOf(afterId) : -1;

        if(index === -1)
        {
            this.state.libs.push(lib.id);
        }
        else
        {
            this.state.libs.splice(index + 1, 0, lib.id);
        }

        this.state.libsMap[lib.id] = lib;

        renderKnowledgeLibs();
    },

    updateLib(lib, targetId)
    {
        const index = this.state.libs.indexOf(targetId);
        if(index === -1) return;

        this.state.libs[index] = lib.id;
        delete this.state.libsMap[targetId];
        this.state.libsMap[lib.id] = lib;

        renderKnowledgeLibs();
    },

    removeLib(libId)
    {
        const index = this.state.libs.indexOf(libId);
        if(index > -1)
        {
            this.state.libs.splice(index, 1);
            delete this.state.libsMap[libId];

            renderKnowledgeLibs();
        }
    },

    getLib(id)
    {
        return this.state.libsMap[id];
    },

    getLibs()
    {
        return this.state.libs.map(id => this.state.libsMap[id]);
    },

    setAction(action, targetId)
    {
      this.state.action   = action;
      this.state.targetId = targetId;
    },

    getAction()
    {
      const { action, targetId } = this.state;
      return { action, targetId };
    },
};

/* 渲染字段列表占位符 */
function renderKnowledgeLibsPlaceholder()
{
    return `
        <div class="field-empty" id="add-knowledge-lib">
            <div class="action">
                <i class="icon icon-plus"></i>
                <span>${knowledgeLibAdd}</span>
            </div>
            <div class="tips">${knowledgeLibAddTip}</div>
        </div>
    `;
}

/* 渲染字段项 */
function renderKnowledgeLibItem(lib)
{
    const available = lib.published && !lib.deleted;

    let badge = '';
    if(!lib.published) badge = `<span class="badge badge-danger">${unpublished}</span>`;
    if(lib.deleted) badge = `<span class="badge badge-danger">${deleted}</span>`;

    return `
        <li class="field-item" data-id="${lib.id}">
            <div class="rect">
              <span class="text-ellipsis" title="${lib.name}">${lib.name}</span>
              ${badge}
            </div>
            <button class="btn size-sm square" data-action="add">
                <i class="icon icon-plus"></i>
            </button>
            <button class="btn size-sm square ${available ? '' : 'disabled'}" data-action="edit" ${available ? '' : 'disabled'}>
                <i class="icon icon-edit"></i>
            </button>
            <button class="btn size-sm square" data-action="delete">
                <i class="icon icon-trash"></i>
            </button>
        </li>
    `;
}

/* 渲染知识库列表 */
function renderKnowledgeLibs()
{
    const libList = $('#knowledge-libs');
    libList.empty();

    const libs = KnowledgeLibManager.getLibs();

    let html = '';
    if(libs.length === 0)
    {
        html = renderKnowledgeLibsPlaceholder();
    }
    else
    {
        libs.forEach(lib => {
            html += renderKnowledgeLibItem(lib);
        });
    }

    libList.html(html);
}

/* 知识库列表操作 */
function knowledgeLibItemActions()
{
    $('#knowledge-libs')
        .on('click', 'button', function()
        {
            const action = $(this).data('action');
            const libId  = $(this).closest('.field-item').data('id');

            switch(action)
            {
                case 'add':
                    openKnowledgeLibModal('add', libId);
                    break;
                case 'edit':
                    openKnowledgeLibModal('edit', libId);
                    break;
                case 'delete':
                    confirmToDeleteKnowledgeLib(libId);
                    break;
                default:
            }
        })
        .on('click', '#add-knowledge-lib', function()
        {
            openKnowledgeLibModal('add', null);
        });
}

/* 打开知识库 Modal */
function openKnowledgeLibModal(action, libId)
{
    KnowledgeLibManager.setAction(action, libId);

    const selectedID = KnowledgeLibManager.getLibs().map(lib => lib.id).join(',');

    zui.Modal.open({
        id: 'selectKnowledgeLibModal',
        url: $.createLink('ai', 'selectKnowledgeLib', `selectedID=${selectedID}&callback=knowledgeLibOnSelect&multiple=0&showSelected=1${action === 'edit' ? '&current=' + libId : ''}`),
        size: 'sm',
    });
}

/* 知识库选中回调 */
window.knowledgeLibOnSelect = function(libs)
{
    const { action, targetId } = KnowledgeLibManager.getAction();

    if(action === 'add')
    {
        KnowledgeLibManager.addLib(libs[0], targetId);
    }
    else if(action === 'edit')
    {
        KnowledgeLibManager.updateLib(libs[0], targetId);
    }
};

/* 确认并删除知识库 */
function confirmToDeleteKnowledgeLib(libId)
{
    zui.Modal.confirm(confirmDelete)
        .then(confirmed => {
            if(confirmed) KnowledgeLibManager.removeLib(libId);
        });
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

// 渲染选项
function renderOption(option, index) {
  const disabledAttr = index === 0 ? 'disabled' : '';

  return `
    <div
      class="input-group"
      data-index="${index}">
      <span class="input-group-addon">${fieldOption}${index + 1}</span>
      <div class="input-control">
        <input
          class="form-control"
          type="text"
          placeholder="${pleaseInput}"
          value="${option}"
        />
      </div>
      <button
        type="button"
        data-action="add"
        class="btn square input-group-addon">
        <i class="icon icon-plus"></i>
      </button>
      <button
        type="button"
        data-action="delete"
        class="btn square input-group-addon"
        ${disabledAttr}>
        <i class="icon icon-minus"></i>
      </button>
    </div>
  `;
}

// 渲染选项列表
function renderOptions() {
  const type = ModalManager.getType();
  const options = ModalManager.getOptions();

  if (!['radio', 'checkbox'].includes(type)) {
    $('#field-placeholder').removeClass('hidden');
    $('#field-options').addClass('hidden');

    return;
  }

  const optionsList = $('#field-options');
  optionsList.empty();

  let html = '';
  options.forEach((option, index) => {
    html += renderOption(option, index);
  });

  optionsList.html(html);

  $('#field-placeholder').addClass('hidden');
  $('#field-options').removeClass('hidden');
}

// 监听字段类型变化
function watchFieldTypeChange() {
  $('#field-modal select[name="field-type"]')
    .on('change', function() {
      const type = $(this).val();

      ModalManager.setType(type);

      if (['radio', 'checkbox'].includes(type)) {
        let options = ModalManager.getOptions();
        if (!options || options.length === 0) {
          options = ['', '', ''];
        }

        ModalManager.setOptions(options);
      }
    });
}

// 打开 Modal（添加/编辑字段）
function openModal(action, fieldId) {
  $('#field-modal .modal-header span')
    .text(action === 'add' ? fieldAdd : fieldEdit);

  const field = FieldManager.getField(fieldId);
  const type = action === 'add'
    ? 'text'
    : field.type;
  let options = action === 'add'
    ? ['', '', '']
    : field.options;
  if (['radio', 'checkbox'].includes(type)
    && (!options || options.length === 0)) {
    options = ['', '', ''];
  }

  ModalManager.setState({
    action,
    id: fieldId,
    type,
    options,
  });

  $('#field-modal input[name="field-name"]')
    .val(action === 'add' ? '' : field.name);
  $('#field-modal select[name="field-type"]')
    .val(type);
  $('#field-modal input[name="field-placeholder"]')
    .val(action === 'add' ? '' : field.placeholder);
  $('#field-modal input[name="field-required"]')
    .val(action === 'add' ? '1' : field.required);

  zui.Modal.open({
    id: 'field-modal',
  });
}

// 确认并删除字段
function confirmToDeleteField(fieldId) {
  zui.Modal.confirm(deleteTip)
    .then(confirmed => {
      if (confirmed) {
        FieldManager.removeField(fieldId);
      }
    });
}

// 字段列表操作
function fieldItemActions() {
  $('#field-list')
    .on('click', 'button', function() {
      const action = $(this).data('action');
      const fieldId = $(this).closest('.field-item').data('id');

      switch (action) {
        case 'add':
          openModal('add', fieldId);
          break;
        case 'edit':
          openModal('edit', fieldId);
          break;
        case 'delete':
          confirmToDeleteField(fieldId);
          break;
        default:
      }
    })
    .on('click', '#add-field', function() {
      openModal('add', null);
    });
}

// 字段选项操作
function fieldOptionActions() {
  $('#field-options')
    .on('click', 'button', function() {
      const action = $(this).data('action');
      const index = $(this).closest('.input-group')
        .data('index');

      const options = ModalManager.getOptions();

      if (action === 'add') {
        options.splice(parseInt(index) + 1, 0, '');
      } else {
        options.splice(parseInt(index), 1);
      }

      ModalManager.setOptions(options);
    });
}

// 字段选项变化
function fieldOptionsChange() {
  $('#field-options')
    .on('change', 'input', function() {
      const options = ModalManager.getOptions();
      const value = $(this).val();
      const index = $(this).closest('.input-group')
        .data('index');

      options[parseInt(index)] = value;

      ModalManager.setOptions(options, false);
    });
}

// field Modal 数据验证
function validateFieldData(id, name, type, options) {
  // 1. name 不能为空
  if (!name.trim()) {
    zui.Messager.show({
      content: emptyWarning.replace('%s', fieldName),
      type: 'danger',
    });

    return false;
  }

  const fields = FieldManager.getFields();

  // 2. name 不能重复
  if (fields.some(field => field.id !== id && field.name === name)) {
    zui.Messager.show({
      content: duplicatedWarning.replace('%s', fieldName),
      type: 'danger',
    });

    return false;
  }

  // 3. options 不能为空
  if (['radio', 'checkbox'].includes(type)) {
    if (options.length === 0) {
      zui.Messager.show({
        content: emptyOptionWarning,
        type: 'danger',
      });

      return false;
    }
  }

  return true;
}

// field Modal 保存
function fieldModalSave() {
  $('#field-modal-save')
    .on('click', function() {
      const fieldState = ModalManager.getState();
      const name = $('#field-modal input[name="field-name"]')
        .val().trim();
      const placeholder = $('#field-modal input[name="field-placeholder"]')
        .val();
      const required = $('#field-modal input[name="field-required"]:checked')
        .val();

      const type = fieldState.type;
      let options = [];
      if (['radio', 'checkbox'].includes(type)) {
        options = fieldState.options
          .filter(option => option.trim());
      }

      const id = fieldState.action === 'add'
        ? null
        : fieldState.id;
      const valid = validateFieldData(id, name, type, options);
      if (!valid) {
        return;
      }

      const field = {
        id,
        name,
        type,
        required,
      };
      if (['radio', 'checkbox'].includes(type)) {
        field.options = options;
      } else {
        field.placeholder = placeholder;
      }

      if (fieldState.action === 'add') {
        FieldManager.addField(field, fieldState.id);
      } else {
        FieldManager.updateField(field);
      }

      zui.Modal.hide('#field-modal');
    });
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

// 初始化 Markdown 组件
function initMarkdown() {
  markdownComponent = new zui.Markdown('#result-preview', {
    content: '',
  });
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

// 返回列表操作
function actionBackToList() {
  $('#btn-goback')
    .on('click', function() {
      if (isSaved) {
        backToList();
      } else {
        zui.Modal.open({
          id: 'back-modal',
        });
      }
    });
}

// 返回列表
function backToList() {
  openUrl($.createLink('ai', 'miniPrograms'));
}

// 返回 Modal 操作
function backModalActions() {
  $('#back-modal .modal-footer')
    .on('click', 'button', function() {
      const action = $(this).data('action');

      switch (action) {
        case 'save':
          saveData('0');
          backToList();
          break;
        case 'cancel':
          zui.Modal.hide('#back-modal');
          break;
        case 'discard':
          backToList();
          break;
        default:
      }
    });
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
      if (data.toPublish === '1') {
        backToList();
      }
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
  const knowledgeLib = KnowledgeLibManager.getLibs().map(lib => lib.id).join(',');

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
    knowledgeLib,
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
