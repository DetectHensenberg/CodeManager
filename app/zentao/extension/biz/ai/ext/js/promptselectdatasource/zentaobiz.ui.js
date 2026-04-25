window.initPromptSelectDataSourceForm = function()
{
    selectCategory();
    selectField();
    removeField();
    sortSelectedFields();
    $('#submit').prop('disabled', !selectedSources.filter(Boolean).length);
};

// 状态管理对象
const DataSourceManager = {
  state: {
    selectedCategory: activeDataSource || 'product',
    selectedFields: selectedSources || []
  },

  setCategory(category) {
    this.state.selectedCategory = category;
    $('#datagroup').val(category);
  },

  setFields(fields) {
    this.state.selectedFields = fields;
    $('#datasource').val(fields.join(','));
  },

  getCategory() {
    return this.state.selectedCategory;
  },

  getFields() {
    return this.state.selectedFields;
  }
};

// 渲染字段列表
function renderFieldList(category) {
  if (!dataSource || !dataSourceLang || !category) {
    console.warn('Missing required data for renderFieldList');
    return;
  }

  const categoryDataSources = dataSource[category];
  const categoryLang = dataSourceLang[category];

  if (!categoryDataSources || !categoryLang) {
    console.warn(`No data found for category: ${category}`);
    return;
  }

  $('.category-groups')
    .attr('data-object-group', category)
    .empty();

  let html = '';

  Object.keys(categoryDataSources).forEach(sourceKey => {
    const fields = categoryDataSources[sourceKey];
    const sourceLang = categoryLang[sourceKey];

    const headerHtml = `
      <div class="category-group-header">
        <label class="checkbox group-item">
          <input type="checkbox" data-prop="${sourceKey}">
          <span>${sourceLang.common}</span>
        </label>
      </div>
    `;

    const fieldsHtml = fields.map(field => `
      <label class="checkbox field-item">
        <input type="checkbox" data-prop="${sourceKey}.${field}">
        <span>${sourceLang[field]}</span>
      </label>
    `).join('');

    const groupHtml = `
      <div class="category-group">
        ${headerHtml}
        <div class="category-group-body check-list-inline">
          ${fieldsHtml}
        </div>
      </div>
    `;

    html += groupHtml;
  });

  $('.category-groups').html(html);
}

// 渲染已选择数据的标题
function renderSelectedTitle(category) {
  if (!dataSourceLang || !category) {
    return;
  }

  const categoryLang = dataSourceLang[category];
  if (!categoryLang) {
    return;
  }

  const categoryName = categoryLang.common;
  const titleElement = $('#selected-title-text');

  if (titleElement.length) {
    const format = titleElement.data('format');
    if (format) {
      const formattedText = format
        .replace('{0}', categoryName)
        .replace('{1}', DataSourceManager.getFields().length);
      titleElement.text(formattedText);
    } else {
      titleElement.text(categoryName);
    }
  }
}

// 渲染已选择的数据列表
function renderSelectedList() {
  const fields = DataSourceManager.getFields().filter(Boolean);

  if (!fields.length) {
    $('#selected-data-sorter').html('');
    $('#submit').prop('disabled', true);
    return;
  }

  $('#submit').prop('disabled', false);

  const listItems = fields.map((field, index) => {
    const [source, fieldName] = field.split('.');
    const sourceLang = dataSourceLang[DataSourceManager.getCategory()][source];
    const fieldLang = sourceLang[fieldName];

    return `
      <li class="list-group-item" data-prop="${field}" data-order="${index}">
        <i class="icon icon-move text-gray drag-icon"></i>
        <span>${sourceLang.common} / ${fieldLang}</span>
        <i class="icon icon-close text-gray remove-icon"></i>
      </li>
    `;
  }).join('');

  const html = `
    <ol class="list-group">
      ${listItems}
    </ol>
  `;

  $('#selected-data-sorter').html(html);
  sortSelectedFields();
}

// 选择分类
function selectCategory() {
  $('.category-list li')
    .on('click', function() {
      if($(this).hasClass('active')) {
        return;
      }

      DataSourceManager.setFields([]);

      $(this).addClass('active')
        .siblings().removeClass('active');

      const category = $(this).data('category');
      DataSourceManager.setCategory(category);

      renderFieldList(category);
      renderSelectedTitle(category);
      renderSelectedList();
    });
}

// 切换字段选中状态
function toggleFieldSelect(fieldName, checked) {
  const fields = DataSourceManager.getFields();

  if (checked) {
    if (fields.indexOf(fieldName) < 0) {
      fields.push(fieldName);
    }
  } else {
    const index = fields.indexOf(fieldName);
    if (index >= 0) {
      fields.splice(index, 1);
    }
  }

  DataSourceManager.setFields(fields);

  renderSelectedTitle(DataSourceManager.getCategory());
  renderSelectedList();
}

// 分组选择
function toggleGroupSelection(groupName, checked) {
  const fields = dataSource[DataSourceManager.getCategory()][groupName];

  fields.forEach(field => {
    const key = `${groupName}.${field}`;

    $(`input[type="checkbox"][data-prop="${key}"]`)
      .prop('checked', checked);

    toggleFieldSelect(key, checked);
  });
}

// 分组选择变化
function groupSelectionOnChange(checkbox) {
  const checked = $(checkbox).prop('checked');
  const groupName = $(checkbox).data('prop');

  toggleGroupSelection(groupName, checked);
}

// 更新分组选择状态
function updateGroupSelection(groupName) {
  const groupFields = dataSource[DataSourceManager.getCategory()][groupName];
  const selectedFields = DataSourceManager.getFields();

  const allChecked = groupFields
    .every(field => {
      const key = `${groupName}.${field}`;
      return selectedFields.indexOf(key) >= 0;
    });

  $(`input[type="checkbox"][data-prop="${groupName}"]`)
    .prop('checked', allChecked);
}

// 更新字段选择状态
function updateFieldSelection(fieldName, checked) {
  $(`input[type="checkbox"][data-prop="${fieldName}"]`)
    .prop('checked', checked);
}

// 字段选择变化
function fieldSelectionOnChange(checkbox) {
  const checked = $(checkbox).prop('checked');
  const fieldName = $(checkbox).data('prop');

  toggleFieldSelect(fieldName, checked);

  const groupName = fieldName.split('.')[0];
  updateGroupSelection(groupName);
}

// 选择字段
function selectField() {
  $('.category-groups')
    .on('change', 'input[type="checkbox"]', function() {
      const prop = $(this).data('prop');

      // 检查是否为分组
      if(prop && prop.indexOf('.') === -1) {
        groupSelectionOnChange(this);
      } else {
        fieldSelectionOnChange(this);
      }
    });
}

// 删除字段
function removeField() {
  $('#selected-data-sorter')
    .on('click', '.remove-icon', function() {
      const field = $(this).closest('li').data('prop');
      const fields = DataSourceManager.getFields();
      const index = fields.indexOf(field);

      if (index >= 0) {
        fields.splice(index, 1);
        DataSourceManager.setFields(fields);

        updateFieldSelection(field, false);

        const groupName = field.split('.')[0];
        updateGroupSelection(groupName);

        renderSelectedList();
      }
    });
}

// 拖动排序
function sortSelectedFields() {
  if ($('#selected-data-sorter .list-group').data('sortable-initialized')) {
    return;
  }

  try {
    new zui.Sortable('#selected-data-sorter .list-group', {
      handle: '.list-group-item',
      animation: 150,
      ghostClass: 'bg-primary-pale',
      onSort: function(event) {
        const newOrder = [];
        $('#selected-data-sorter .list-group-item')
          .each(function() {
            newOrder.push($(this).data('prop'));
          });

        DataSourceManager.setFields(newOrder);
        updateListOrder();
      }
    });
    $('#selected-data-sorter .list-group').data('sortable-initialized', true);
  } catch (error) {
    console.error('Failed to initialize sortable for selected data sorter');
  }
}

// 只更新排序索引，不重新渲染
function updateListOrder() {
  $('#selected-data-sorter .list-group-item').each(function(index) {
    $(this).attr('data-order', index);
  });
}
