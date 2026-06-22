<script>
window.OrderCart = (function () {
  const CSRF = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
  const ORDER_UNITS = @json(\App\Support\OrderUnits::unitOptions());
  const drawer   = document.getElementById('cart-drawer');
  const backdrop = document.getElementById('cart-backdrop');
  const toggleBtn = document.getElementById('cart-toggle-btn');
  const closeBtn  = document.getElementById('cart-drawer-close');
  const toastEl   = document.getElementById('order-toast');

  const esc = s => String(s ?? '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/"/g,'&quot;');

  function lineKeyFrom(el) {
    return el?.getAttribute('data-line-key') || '';
  }

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
    showToast._t = setTimeout(() => toastEl.classList.remove('show'), 2600);
  }

  async function parseJsonResponse(res) {
    const text = await res.text();
    if (!text) {
      return { status: 'error', message: 'Respons server kosong (' + res.status + ')' };
    }
    try {
      return JSON.parse(text);
    } catch (e) {
      return { status: 'error', message: 'Gagal memproses respons server (' + res.status + ')' };
    }
  }

  function linePayload(line) {
    const qty = parseInt(line?.querySelector('.cart-qty-num')?.textContent || '1', 10);
    const unit = line?.querySelector('.cart-unit-select')?.value || 'pcs';
    const note = line?.querySelector('.cart-note-input')?.value?.trim() || '';
    return { qty, unit, note: note || null };
  }

  function bindActions() {
    document.querySelectorAll('.cart-qty-btn').forEach(btn => {
      btn.onclick = () => {
        const lineKey = lineKeyFrom(btn);
        const line = btn.closest('.cart-drawer-line');
        let qty = parseInt(line?.querySelector('.cart-qty-num')?.textContent || '1', 10);
        const max = parseInt(btn.dataset.max || '9999', 10);

        if (btn.dataset.action === 'plus') qty = Math.min(max, qty + 1);
        else qty = Math.max(0, qty - 1);

        const payload = linePayload(line);
        payload.qty = qty;
        updateItem(lineKey, payload);
      };
    });

    document.querySelectorAll('.cart-remove-btn').forEach(btn => {
      btn.onclick = () => removeItem(lineKeyFrom(btn));
    });

    document.querySelectorAll('.cart-unit-select').forEach(select => {
      select.onchange = () => {
        const lineKey = lineKeyFrom(select);
        const line = select.closest('.cart-drawer-line');
        updateItem(lineKey, linePayload(line));
      };
    });

    document.querySelectorAll('.cart-note-input').forEach(input => {
      input.onblur = () => {
        const lineKey = lineKeyFrom(input);
        const line = input.closest('.cart-drawer-line');
        updateItem(lineKey, linePayload(line));
      };
    });
  }

  function renderItems(data) {
    const body = document.getElementById('cart-drawer-body');
    const foot = document.getElementById('cart-drawer-foot');
    const badge = document.getElementById('cart-badge');
    const units = data.units?.length ? data.units : ORDER_UNITS;

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
      <li class="cart-drawer-line" data-line-key="${esc(item.id)}">
        <div class="cart-drawer-line-main">
          <div class="cart-drawer-line-info">
            <span class="cart-drawer-line-name">${esc(item.name)}</span>
          </div>
          <span class="cart-drawer-line-qty">x${item.qty}</span>
        </div>
        <div class="cart-drawer-line-edit">
          <select class="cart-unit-select" data-line-key="${esc(item.id)}" aria-label="Satuan">
            ${(units.length ? units : [{ value: item.unit || 'pcs', label: item.unit_label || 'Pcs' }]).map(u =>
              `<option value="${esc(u.value)}"${(u.value === (item.unit || 'pcs')) ? ' selected' : ''}>${esc(u.label)}</option>`
            ).join('')}
          </select>
          <input type="text" class="cart-note-input" data-line-key="${esc(item.id)}" value="${esc(item.note || '')}" placeholder="Catatan item" maxlength="500" aria-label="Catatan item">
        </div>
        <div class="cart-drawer-line-actions">
          <button type="button" class="cart-qty-btn" data-action="minus" data-line-key="${esc(item.id)}" aria-label="Kurangi">−</button>
          <span class="cart-qty-num">${item.qty}</span>
          <button type="button" class="cart-qty-btn" data-action="plus" data-line-key="${esc(item.id)}" data-max="${item.stock}" aria-label="Tambah">+</button>
          <button type="button" class="cart-remove-btn" data-line-key="${esc(item.id)}" aria-label="Hapus">×</button>
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
    try {
      const res = await fetch(document.getElementById('cart-data-url')?.value || '/order/cart/data', {
        headers: { 'Accept': 'application/json' },
      });
      const data = await parseJsonResponse(res);
      if (!res.ok) {
        showToast(data.message || 'Gagal memuat keranjang');
        return data;
      }
      renderItems(data);
      return data;
    } catch (e) {
      showToast('Gagal memuat keranjang');
      return { items: [], total_qty: 0 };
    }
  }

  async function addProduct(productId, qty, unit, note) {
    try {
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
      const data = await parseJsonResponse(res);
      if (!res.ok || data.status === 'error') {
        showToast(data.message || 'Gagal menambahkan');
        return false;
      }
      renderItems(data);
      showToast(data.message || 'Ditambahkan ke keranjang');
      if (isMobile()) open();
      return true;
    } catch (e) {
      showToast('Gagal menambahkan ke keranjang');
      return false;
    }
  }

  async function updateItem(lineKey, payload) {
    if (!lineKey) {
      showToast('Item keranjang tidak valid');
      return;
    }

    const base = document.getElementById('cart-update-url')?.value || '/order/cart/';

    try {
      const res = await fetch(base + encodeURIComponent(lineKey), {
        method: 'PATCH',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': CSRF,
          'Accept': 'application/json',
        },
        body: JSON.stringify(payload),
      });
      const data = await parseJsonResponse(res);
      if (!res.ok || data.status === 'error') {
        showToast(data.message || 'Gagal memperbarui keranjang');
        return;
      }
      renderItems(data);
    } catch (e) {
      showToast('Gagal memperbarui keranjang');
    }
  }

  async function removeItem(lineKey) {
    if (!lineKey) return;

    const base = document.getElementById('cart-update-url')?.value || '/order/cart/';

    try {
      const res = await fetch(base + encodeURIComponent(lineKey), {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': CSRF,
          'Accept': 'application/json',
        },
      });
      const data = await parseJsonResponse(res);
      if (!res.ok || data.status === 'error') {
        showToast(data.message || 'Gagal menghapus item');
        return;
      }
      renderItems(data);
    } catch (e) {
      showToast('Gagal menghapus item');
    }
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
