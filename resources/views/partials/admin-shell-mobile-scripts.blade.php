@once
<script>
window.AdminSidebar = (function () {
  function app() {
    return document.getElementById('admin-app') || document.querySelector('.app.admin-shell');
  }
  function backdrop() {
    return document.getElementById('admin-sb-backdrop');
  }
  function isMobile() {
    return window.matchMedia('(max-width: 900px)').matches;
  }
  function apply(open) {
    const el = app();
    const bd = backdrop();
    if (!el) return;
    el.classList.toggle('admin-sb-open', !!open);
    if (bd) bd.classList.toggle('show', !!open);
    document.body.style.overflow = open && isMobile() ? 'hidden' : '';
  }
  return {
    toggle() { apply(!app()?.classList.contains('admin-sb-open')); },
    close()  { apply(false); },
    init() {
      backdrop()?.addEventListener('click', () => this.close());
      document.querySelectorAll('.app.admin-shell .nav-a').forEach(a => {
        a.addEventListener('click', () => { if (isMobile()) this.close(); });
      });
      window.addEventListener('resize', () => {
        if (!isMobile()) this.close();
      });
    },
  };
})();
document.addEventListener('DOMContentLoaded', () => AdminSidebar.init());
</script>
@endonce
