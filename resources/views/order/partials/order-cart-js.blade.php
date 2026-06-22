<script>
window.OrderCart = (function () {
  const CSRF = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
  const drawer   = document.getElementById('cart-drawer');
  const backdrop = document.getElementById('cart-backdrop');
  const toggleBtn = document.getElementById('cart-toggle-btn');
  const closeBtn  = document.getElementById('cart-drawer-close');
  const toastEl   = document.getElementById('order-toast');

  const esc = s => String(s ?? '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/"/g,'&quot;');

  function isMobile() {
    return window.matchMedia('(max-width: 767px)').matches;
  }

  function open() {
    if (!drawer) return;
    drawer.classList.add('open');
    backdrop?.classList.add('show');
    toggleBtn?.setAttribute('aria-expanded', 'true');
    document.body.style.overflow = isMobile() ? 'hidden' : '';
  }

  function close() {
    if (!drawer) return;
    drawer.classList.remove('open');
    backdrop?.classList.remove('show');
    toggleBtn?.setAttribute('aria-expanded', 'false');
    document.body.style.overflow = '';
  }

  function toggle() {
    if (drawer?.classList.contains('open')) close();
    else open();
  }

  function showToast(msg) {
    if (!toastEl || !msg) return;
    toastEl.textContent = msg;
    toastEl.classList.add('show');
    clearTimeout(showToast._t);
    showToast._t = setTimeout(() => toastEl.classList.remove('show'), 2200);
  }

  function bindActions() {
    document.querySelectorAll('.cart-qty-btn').forEach(btn => {
      btn.onclick = () => {
        const id = btn.dataset.id;
        const line = btn.closest('.cart-drawer-line');
        const numEl = line?.querySelector('.cart-qty-num');
        const qtyEl = line?.querySelector('.cart-drawer-line-qty');
        let qty = parseInt(numEl?.textContent || '1', 10);
        const max = parseInt(btn.dataset.max || '9999', 10);

        if (btn.dataset.action === 'plus') qty = Math.min(max, qty + 1);
        else qty = Math.max(0, qty - 1);

        updateQty(id, qty);
      };
    });

    document.querySelectorAll('.cart-remove-btn').forEach(btn => {
      btn.onclick = () => removeItem(btn.dataset.id);
    });
  }

  function renderItems(data) {
    const body = document.getElementById('cart-drawer-body');
    const foot = document.getElementById('cart-drawer-foot');
    const badge = document.getElementById('cart-badge');

    if (badge) {
      badge.textContent = data.total_qty;
      badge.hidden = data.total_qty <= 0;
    }

    if (!body) return;

    if (!data.items.length) {
      body.innerHTML = '<div class="cart-drawer-empty"><p>Keranjang masih kosong.</p><p class="cart-drawer-empty-sub">Tambah produk dari katalog.</p></div>';
      if (foot) foot.innerHTML = '';
      return;
    }

    body.innerHTML = '<ul class="cart-drawer-list">' + data.items.map(item => `
      <li class="cart-drawer-line" data-id="${esc(item.id)}">
        <div class="cart-drawer-line-main">
          <div class="cart-drawer-line-info">
            <span class="cart-drawer-line-name">${esc(item.name)}</span>
            <span class="cart-drawer-line-meta">${esc(item.unit_label || item.unit || 'Pcs')}${item.note ? ' — ' + esc(item.note) : ''}</span>
          </div>
          <span class="cart-drawer-line-qty">x${item.qty}</span>
        </div>
        <div class="cart-drawer-line-actions">
          <button type="button" class="cart-qty-btn" data-action="minus" data-id="${esc(item.id)}" aria-label="Kurangi">−</button>
          <span class="cart-qty-num">${item.qty}</span>
          <button type="button" class="cart-qty-btn" data-action="plus" data-id="${esc(item.id)}" data-max="${item.stock}" aria-label="Tambah">+</button>
          <button type="button" class="cart-remove-btn" data-id="${esc(item.id)}" aria-label="Hapus">×</button>
        </div>
      </li>
    `).join('') + '</ul>';

    if (foot) {
      foot.innerHTML = `
        <div class="cart-drawer-summary">
          <span>Total item</span>
          <strong>${data.total_qty} item</strong>
        </div>
        <a href="${esc(document.getElementById('checkout-url')?.value || '/order/checkout')}" class="btn btn-primary">Lanjut Checkout</a>
      `;
    }

    bindActions();
  }

  async function refresh() {
    const res = await fetch(document.getElementById('cart-data-url')?.value || '/order/cart/data', { headers: { 'Accept': 'application/json' } });
    const data = await res.json();
    renderItems(data);
    return data;
  }

  async function addProduct(productId, qty, unit, note) {
    const res = await fetch(document.getElementById('cart-add-url')?.value || '/order/cart/add', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': CSRF,
        'Accept': 'application/json',
      },
      body: JSON.stringify({
        product_id: productId,
        qty: qty,
        unit: unit || 'pcs',
        note: note || null,
      }),
    });
    const data = await res.json();
    if (!res.ok || data.status === 'error') {
      showToast(data.message || 'Gagal menambahkan');
      return false;
    }
    renderItems(data);
    showToast(data.message || 'Ditambahkan ke keranjang');
    if (isMobile()) open();
    return true;
  }

  async function updateQty(lineKey, qty) {
    const base = document.getElementById('cart-update-url')?.value || '/order/cart/';
    const res = await fetch(base + encodeURIComponent(lineKey), {
      method: 'PATCH',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': CSRF,
        'Accept': 'application/json',
      },
      body: JSON.stringify({ qty: qty }),
    });
    const data = await res.json();
    if (!res.ok || data.status === 'error') {
      showToast(data.message || 'Gagal memperbarui');
      return;
    }
    renderItems(data);
  }

  async function removeItem(lineKey) {
    const base = document.getElementById('cart-update-url')?.value || '/order/cart/';
    const res = await fetch(base + encodeURIComponent(lineKey), {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': CSRF,
        'Accept': 'application/json',
      },
    });
    const data = await res.json();
    renderItems(data);
  }

  toggleBtn?.addEventListener('click', toggle);
  closeBtn?.addEventListener('click', close);
  backdrop?.addEventListener('click', close);

  document.querySelectorAll('.add-to-cart-form').forEach(form => {
    form.addEventListener('submit', async e => {
      e.preventDefault();
      const productId = form.querySelector('[name=product_id]')?.value;
      const qty = parseInt(form.querySelector('[name=qty]')?.value || '1', 10);
      const unit = form.querySelector('[name=unit]')?.value || 'pcs';
      const note = form.querySelector('[name=note]')?.value?.trim() || '';
      const btn = form.querySelector('button[type=submit]');
      if (btn) btn.disabled = true;
      await addProduct(productId, qty, unit, note);
      if (btn) btn.disabled = false;
    });
  });

  if (new URLSearchParams(location.search).get('cart') === 'open') {
    open();
  }

  bindActions();

  return { open, close, toggle, refresh, addProduct };
})();
</script>
<input type="hidden" id="checkout-url" value="{{ route('order.checkout') }}">
<input type="hidden" id="cart-data-url" value="{{ route('order.cart.data') }}">
<input type="hidden" id="cart-add-url" value="{{ route('order.cart.add') }}">
<input type="hidden" id="cart-update-url" value="{{ url('/order/cart') }}/">
