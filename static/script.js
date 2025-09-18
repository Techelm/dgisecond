(function () {
  const body = document.body;
  const app = document.getElementById('appRoot');
  const overlay = document.getElementById('overlay');
  const mobileMenuBtn = document.getElementById('mobileMenuBtn');
  const collapseBtn = document.getElementById('collapseSidebarBtn');
  const themeToggle = document.getElementById('themeToggle');
  const logoutBtn = document.getElementById('logoutBtn');
  const logoutLink = document.getElementById('logoutLink');
  const searchForm = document.getElementById('searchForm');
  const searchToastEl = document.getElementById('searchToast');

  /* ---------- INIT STATE (localStorage) ---------- */
  const savedTheme = localStorage.getItem('smi_theme');
  if (savedTheme === 'light') body.classList.add('theme-light');
  const savedCollapsed = localStorage.getItem('smi_sidebar_collapsed');
  if (savedCollapsed === '1') app.classList.add('collapsed');

  /* ---------- Tooltips (for collapsed icons) ---------- */
  const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  let tooltipList = tooltipTriggerList.map(el => new bootstrap.Tooltip(el));
  const refreshTooltips = () => {
    tooltipList.forEach(t => t.dispose());
    tooltipList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      .map(el => new bootstrap.Tooltip(el));
  };

  /* ---------- Sidebar: mobile open/close ---------- */
  mobileMenuBtn.addEventListener('click', () => {
    body.classList.toggle('sidebar-open');
  });
  overlay.addEventListener('click', () => body.classList.remove('sidebar-open'));

  /* ---------- Sidebar: desktop collapse ---------- */
  if (collapseBtn) {
    collapseBtn.addEventListener('click', () => {
      app.classList.toggle('collapsed');
      localStorage.setItem('smi_sidebar_collapsed', app.classList.contains('collapsed') ? '1' : '0');
      refreshTooltips();
    });
  }

  /* ---------- Theme toggle ---------- */
  if (themeToggle) {
    themeToggle.addEventListener('click', () => {
      body.classList.toggle('theme-light');
      localStorage.setItem('smi_theme', body.classList.contains('theme-light') ? 'light' : 'dark');
    });
  }

  /* ---------- Logout ---------- */
  function handleLogout(e) {
    e.preventDefault();
    window.location.href = '/logout';
  }
  logoutBtn?.addEventListener('click', handleLogout);
  logoutLink?.addEventListener('click', handleLogout);

  /* ---------- Section router ---------- */
  const links = document.querySelectorAll('a.nav-link[data-section], .dropdown-item[data-section]');
  const sections = document.querySelectorAll('.section');
  function showSection(name) {
    sections.forEach(s => s.classList.toggle('active', s.id === `section-${name}`));
    links.forEach(l => l.classList.toggle('active', l.dataset.section === name));
    // Close mobile sidebar after navigation
    body.classList.remove('sidebar-open');
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }
  links.forEach(link => {
    link.addEventListener('click', (e) => {
      e.preventDefault();
      const name = link.dataset.section;
      if (name) showSection(name);
    });
  });

  /* ---------- Search demo ---------- */
  if (searchForm && searchToastEl) {
    const toast = new bootstrap.Toast(searchToastEl, { delay: 1200 });
    searchForm.addEventListener('submit', (e) => {
      e.preventDefault();
      toast.show();
    });
  }

  /* ---------- Modal submit demo ---------- */
  const composeModal = document.getElementById('composeModal');
  composeModal?.querySelector('form')?.addEventListener('submit', (e) => {
    e.preventDefault();
    bootstrap.Modal.getInstance(composeModal)?.hide();
  });

  /* ---------- Accessibility: close sidebar with ESC ---------- */
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') body.classList.remove('sidebar-open');
  });
})();
