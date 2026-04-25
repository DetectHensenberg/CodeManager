(function() {
  function ready(fn) {
    if(document.readyState !== 'loading') return fn();
    document.addEventListener('DOMContentLoaded', fn);
  }

  ready(function() {
    document.documentElement.classList.add('codemanager-ui');
    document.body && document.body.classList.add('codemanager-shell');

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
  });
})();
