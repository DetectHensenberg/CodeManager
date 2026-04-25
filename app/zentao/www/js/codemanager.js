(function() {
  function ready(fn) {
    if(document.readyState !== 'loading') return fn();
    document.addEventListener('DOMContentLoaded', fn);
  }

  ready(function() {
    document.documentElement.classList.add('codemanager-ui');
    document.body && document.body.classList.add('codemanager-shell');

    var routeText = [location.pathname, location.search, location.hash].join(' ');
    var modules = ['my', 'project', 'program', 'product', 'story', 'task', 'bug', 'doc', 'group', 'company', 'admin'];
    modules.forEach(function(moduleName) {
      var pattern = new RegExp('(?:^|[?&/=-])' + moduleName + '(?:[&/=-]|$)', 'i');
      if(pattern.test(routeText)) document.body.classList.add('cm-module-' + moduleName);
    });

    var actionMatch = routeText.match(/(?:[?&]f=|[-\/])([a-z0-9_]+)(?:[-&\/]|$)/i);
    if(actionMatch && actionMatch[1]) document.body.classList.add('cm-action-' + actionMatch[1].toLowerCase());

    var forms = document.querySelectorAll('form');
    forms.forEach(function(form) {
      if(form.querySelector('[name="customer"], [name="contractNo"], [name="deliveryDate"], [name="sowLink"]')) {
        form.classList.add('cm-form-delivery-group');
      }
    });

    var tables = document.querySelectorAll('.main-table table, table.table');
    tables.forEach(function(table) {
      table.classList.add('cm-data-table');
      if(!table.closest('.cm-table-wrap')) {
        var wrap = document.createElement('div');
        wrap.className = 'cm-table-wrap';
        table.parentNode.insertBefore(wrap, table);
        wrap.appendChild(table);
      }
    });

    document.querySelectorAll('.dtable-empty-tip, .empty-tip, .empty, .no-data').forEach(function(emptyState) {
      emptyState.classList.add('cm-empty-state');
    });

    document.querySelectorAll('.form-actions, .panel-actions, #pageActions, .toolbar, .table-actions').forEach(function(actions) {
      actions.classList.add('cm-action-cluster');
    });
  });
})();
