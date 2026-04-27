(function() {
  function ready(fn) {
    if(document.readyState !== 'loading') return fn();
    document.addEventListener('DOMContentLoaded', fn);
  }

  /* ── Sub-page enhancements (run inside iframes) ── */
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

  /* ── ZUI3 shell sidebar section labels ── */

  var SECTION_LABELS = ['PAGES', 'APPS', 'SETTINGS'];

  function injectNavLabels(nav) {
    /* Remove previously injected labels to avoid duplicates. */
    nav.querySelectorAll('.cm-nav-label').forEach(function(el) { el.remove(); });

    var items = nav.querySelectorAll('li');
    if(!items.length) return;

    var labelIdx = 0;

    function makeLabel(text) {
      var li = document.createElement('li');
      li.className = 'cm-nav-label';
      li.setAttribute('aria-hidden', 'true');
      li.textContent = text;
      return li;
    }

    /* Insert label before the very first nav item. */
    if(SECTION_LABELS[labelIdx]) {
      nav.insertBefore(makeLabel(SECTION_LABELS[labelIdx++]), items[0]);
    }

    /* Insert label after each divider. */
    Array.from(items).forEach(function(item) {
      if(item.classList.contains('divider') && SECTION_LABELS[labelIdx]) {
        item.insertAdjacentElement('afterend', makeLabel(SECTION_LABELS[labelIdx++]));
      }
    });
  }

  ready(function() {
    var nav = document.getElementById('menuMainNav');
    if(!nav) return; /* Not the ZUI3 shell page. */

    var observer = new MutationObserver(function(mutations) {
      var hasRealItems = Array.from(nav.querySelectorAll('li')).some(function(li) {
        return !li.classList.contains('cm-nav-label');
      });
      if(!hasRealItems) return;

      /* Disconnect before modifying DOM to avoid infinite loop. */
      observer.disconnect();
      injectNavLabels(nav);
      observer.observe(nav, { childList: true });
    });

    observer.observe(nav, { childList: true });

    /* If items are already there (e.g., hot-reload), inject immediately. */
    if(nav.querySelectorAll('li').length) {
      observer.disconnect();
      injectNavLabels(nav);
      observer.observe(nav, { childList: true });
    }
  });
})();
