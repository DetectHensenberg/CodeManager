$(document).ready(function() {
  toggleTemplatePanel();
  applyTemplate();
  addTemplate();
  deleteTemplate();
  editTemplate();
  saveTemplate();
});

// 渲染角色模板列表
function renderRoleTemplates(roleTemplates) {
  let html = '<div id="roleList" class="flex col gap-2">';

  roleTemplates.forEach(function(template) {
    html += `
      <div
        id="role-template-${template.id}"
        data-id="${template.id}"
        class="role-template-card border border-gray-300 rounded p-3 w-full">
        <div class="flex justify-between items-center gap-4">
          <p
            id="role-${template.id}"
            class="role text-ellipsis"
            title="${template.role}">${template.role}</p>
          <div class="flex gap-1">
            <button
              class="btn ghost btn-apply"
              data-id="${template.id}"
              data-role="${template.role}"
              data-characterization="${template.characterization}">
              <span class="text-primary">${lang.apply}</span>
            </button>
            <button
              class="btn ghost square btn-edit"
              data-id="${template.id}"
              data-role="${template.role}"
              data-characterization="${template.characterization}"
              data-toggle="modal"
              data-target="#roleTemplateModal">
              <i class="icon icon-edit text-primary"></i>
            </button>
            <button
              class="btn ghost square btn-delete"
              data-id="${template.id}">
              <i class="icon icon-trash text-primary"></i>
            </button>
          </div>
        </div>
        <p
          id="characterization-${template.id}"
          class="characterization text-gray-600 text-ellipsis py-1"
          title="${template.characterization}">${template.characterization}</p>
      </div>
    `;
  });

  html += '</div>';

  $('#roleListContainer').html(html);
}

// 展开/折叠角色模板
function toggleTemplatePanel() {
  $('#toggleTemplatePanel')
    .on('click', function() {
      $('#roleTemplate').toggleClass('hidden');
      $('#toggleTemplatePanel .icon')
        .toggleClass('icon-first-page')
        .toggleClass('icon-last-page');
    });
}

// 应用角色模板
function applyTemplate() {
  $('#roleListContainer')
    .on('click', '.btn-apply', function() {
      const role = $(this).data('role');
      const characterization = $(this).data('characterization');

      $('#mainForm input[name="role"]')
        .val(role).toggleClass('focus', true);
      $('#mainForm textarea[name="characterization"]')
        .val(characterization).toggleClass('focus', true);

      setTimeout(() => {
        $('#mainForm input[name="role"]')
          .toggleClass('focus', false);
        $('#mainForm textarea[name="characterization"]')
          .toggleClass('focus', false);
      }, 1000);
    });
}

// 保存模板
function postTemplate(data) {
  $.ajax({
    url: $.createLink('ai', 'roleTemplates'),
    type: 'POST',
    data,
        dataType: 'json',
        success: function(response) {
          if (response.result === 'success') {
            $('#roleTemplateForm input[name="role"]').val('');
            $('#roleTemplateForm textarea[name="characterization"]').val('');
            $('#roleTemplateForm input[name="id"]').val('');

            zui.Messager.show({content: response.message, type: 'success'});

            renderRoleTemplates(response.data.roleTemplates);

            setTimeout(() => {
              $('#roleTemplateModal').modal('hide');
            }, 200);

            $('#modalTitle').text(lang.addRoleTemplate);
            $('#modalSubtitle').addClass('hidden');
          } else {
            zui.Messager.show({content: response.message, type: 'danger'});
          }
        },
        error: function(xhr, status, error) {
          zui.Messager.show({content: lang.saveFailed + '：' + error, type: 'danger'});
        }
  });
}

// 保存（添加/删除）角色模板
function saveTemplate() {
  $('#saveTemplate')
    .on('click', function() {
      const role = $('#roleTemplateForm input[name="role"]').val().trim();
      const characterization = $('#roleTemplateForm textarea[name="characterization"]').val().trim();

      if (!role) {
        zui.Messager.show({content: lang.roleRequired, type: 'danger'});
        return false;
      }

      if (!characterization) {
        zui.Messager.show({content: lang.characterizationRequired, type: 'danger'});
        return false;
      }

      const id = $('#roleTemplateForm input[name="id"]').val();
      const data = {
        method: id ? 'edit' : 'create',
        role,
        characterization,
      };

      if (id) data.id = id;

      postTemplate(data);
    });
}

// 添加模板
function addTemplate() {
  $('#btnAddTemplate')
    .on('click', function() {
      $('#roleTemplateForm input[name="id"]').val('');
      $('#roleTemplateForm input[name="role"]').val('');
      $('#roleTemplateForm textarea[name="characterization"]').val('');

      $('#modalTitle').text(lang.addRoleTemplate);
      $('#modalSubtitle').addClass('hidden');

      zui.Modal.open({
        id: 'roleTemplateModal',
      });
    });
}

// 编辑模板
function editTemplate() {
  $('#roleListContainer')
    .on('click', '.btn-edit', function() {
      const id = $(this).data('id');
      const role = $(this).data('role');
      const characterization = $(this).data('characterization');

      $('#roleTemplateForm input[name="id"]').val(id);
      $('#roleTemplateForm input[name="role"]').val(role);
      $('#roleTemplateForm textarea[name="characterization"]').val(characterization);

      $('#modalTitle').text(lang.editRoleTemplate);
      $('#modalSubtitle').removeClass('hidden');

      zui.Modal.open({
        id: 'roleTemplateModal',
      });
    });
}

// 删除模板
function deleteTemplate() {
  $('#roleListContainer')
    .on('click', '.btn-delete', function() {
      const id = $(this).data('id');

      zui.Modal.confirm(lang.deleteConfirm)
        .then(confirmed => {
          if (confirmed) {
            $.ajax({
              url: $.createLink('ai', 'roleTemplates'),
              type: 'POST',
              data: {
                method: 'delete',
                id,
              },
              dataType: 'json',
              success: function(response) {
                if (response.result === 'success') {
                  zui.Messager.show({content: response.message, type: 'success'});

                  renderRoleTemplates(response.data.roleTemplates);
                } else {
                  zui.Messager.show({content: response.message, type: 'danger'});
                }
              },
              error: function(xhr, status, error) {
                zui.Messager.show({content: lang.saveFailed + '：' + error, type: 'danger'});
              }
            });
          }
        });
    });
}
