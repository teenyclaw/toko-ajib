<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Harga Modal — POS AJIB</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --bg:#09090b;--bg2:#111114;--bg3:#18181c;--bg4:#202025;--bg5:#2a2a30;
  --bd:rgba(255,255,255,.055);--bd2:rgba(255,255,255,.09);
  --tx:#ede9e2;--tx2:#938f88;--tx3:#4e4c49;
  --go:#c9a44e;--go2:#e4bf6a;--gd:rgba(201,164,78,.09);--gd2:rgba(201,164,78,.16);
  --gn:#3ecf8e;--gnd:rgba(62,207,142,.09);
  --rd:#f87171;--rdd:rgba(248,113,113,.09);
  --bl:#60a5fa;--bld:rgba(96,165,250,.09);
  --rr:12px;--rs:8px;--rx:6px;
  --f:'DM Sans',sans-serif;--m:'DM Mono',monospace;
}
html,body{height:100%;overflow:hidden}
body{font-family:var(--f);background:var(--bg);color:var(--tx);font-size:14px;line-height:1.5}
.app{display:grid;grid-template-columns:216px 1fr;height:100vh}
.main{display:flex;flex-direction:column;overflow:hidden}

/* ── SIDEBAR ── */
.sb{background:var(--bg2);border-right:1px solid var(--bd);display:flex;flex-direction:column}
.sb-logo{padding:20px 16px 18px;border-bottom:1px solid var(--bd)}
.logo{display:flex;align-items:center;gap:10px}
.logo-ico{width:30px;height:30px;background:var(--go);border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.logo-ico svg{width:16px;height:16px;color:#09090b}
.logo-name{font-size:14px;font-weight:600;letter-spacing:-.2px}
.logo-tag{font-size:9.5px;color:var(--tx3);letter-spacing:.9px;text-transform:uppercase}
.nav{padding:8px 6px;flex:1}
.nav-sec{font-size:9.5px;color:var(--tx3);letter-spacing:1px;text-transform:uppercase;padding:14px 10px 5px;font-weight:500}
.nav-a{display:flex;align-items:center;gap:9px;padding:8px 10px;border-radius:var(--rs);color:var(--tx2);text-decoration:none;font-size:13px;transition:all .14s;margin-bottom:1px}
.nav-a:hover{background:var(--bg3);color:var(--tx)}
.nav-a.on{background:var(--gd);color:var(--go)}
.ni{width:14px;height:14px;flex-shrink:0;opacity:.6}
.nav-a.on .ni{opacity:1}
.sb-foot{padding:12px 14px;border-top:1px solid var(--bd)}
.u-row{display:flex;align-items:center;gap:8px;padding:6px 8px;border-radius:var(--rs)}
.uav{width:26px;height:26px;border-radius:50%;background:var(--gd);border:1px solid var(--gd2);display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:600;color:var(--go);flex-shrink:0}
.u-nm{font-size:12.5px;font-weight:500}
.u-rl{font-size:10.5px;color:var(--tx3)}

.topbar{height:52px;padding:0 22px;border-bottom:1px solid var(--bd);background:var(--bg2);display:flex;align-items:center;gap:10px;flex-shrink:0}
.tb-ttl{font-size:14.5px;font-weight:500;flex:1}
.tb-sub{font-size:12px;color:var(--tx3)}
.btn{display:inline-flex;align-items:center;gap:6px;padding:7px 13px;border-radius:var(--rs);font-family:var(--f);font-size:12.5px;font-weight:500;cursor:pointer;transition:all .14s;border:none}
.btn-ghost{background:var(--bg4);color:var(--tx2);border:1px solid var(--bd2)!important}
.btn-ghost:hover{background:var(--bg5);color:var(--tx)}
.btn-gold{background:var(--go);color:#09090b;font-weight:600}
.btn-gold:hover{background:var(--go2)}
.btn-gold:disabled{opacity:.45;cursor:not-allowed}
.btn-sm{padding:5px 10px;font-size:11.5px}
.content{flex:1;overflow:hidden;display:grid;grid-template-columns:minmax(280px,36%) 1fr;min-height:0}
.panel{display:flex;flex-direction:column;min-height:0;border-right:1px solid var(--bd)}
.panel:last-child{border-right:none}
.panel-head{padding:14px 18px 10px;border-bottom:1px solid var(--bd);flex-shrink:0}
.panel-ttl{font-size:13px;font-weight:600;margin-bottom:4px}
.panel-sub{font-size:11.5px;color:var(--tx3)}
.fbar{display:flex;gap:8px;flex-wrap:wrap;padding:12px 18px;border-bottom:1px solid var(--bd);flex-shrink:0}
.fi{background:var(--bg3);border:1px solid var(--bd2);color:var(--tx);border-radius:var(--rs);padding:7px 11px;font-family:var(--f);font-size:13px;outline:none;flex:1;min-width:120px}
.fi:focus{border-color:var(--go)}
.fi-sel{flex:0 0 150px;cursor:pointer}
.scroll{flex:1;overflow-y:auto;min-height:0}
.scroll::-webkit-scrollbar{width:4px}
.scroll::-webkit-scrollbar-thumb{background:var(--bg5)}
table{width:100%;border-collapse:collapse}
thead th{font-size:10px;color:var(--tx3);text-transform:uppercase;letter-spacing:.7px;font-weight:500;padding:8px 12px;text-align:left;border-bottom:1px solid var(--bd);background:var(--bg2);position:sticky;top:0;z-index:2}
tbody td{padding:9px 12px;border-bottom:1px solid var(--bd);font-size:12.5px;color:var(--tx2);vertical-align:middle}
tbody tr:hover{background:rgba(255,255,255,.02)}
.c-nm{font-weight:500;color:var(--tx);font-size:13px}
.c-cat{font-size:10px;color:var(--tx3);margin-top:2px}
.c-mono{font-family:var(--m);font-size:12px;color:var(--tx)}
.preview-dus{color:var(--go);font-family:var(--m);font-size:12px}
.preview-pcs{color:var(--bl);font-family:var(--m);font-size:12px}
.ie{background:var(--bg4);border:1px solid var(--bd2);color:var(--tx);border-radius:var(--rx);padding:6px 8px;font-family:var(--m);font-size:12px;outline:none;width:100%;min-width:90px}
.ie:focus{border-color:var(--go)}
.empty{padding:40px 20px;text-align:center;color:var(--tx3);font-size:13px}
.work-foot{padding:12px 18px;border-top:1px solid var(--bd);display:flex;align-items:center;justify-content:space-between;gap:10px;flex-shrink:0;background:var(--bg2)}
.work-count{font-size:12px;color:var(--tx3)}
.toast{position:fixed;bottom:22px;right:22px;background:var(--bg3);border:1px solid var(--bd2);border-radius:var(--rr);padding:11px 15px;display:flex;align-items:center;gap:9px;font-size:13px;transform:translateY(70px);opacity:0;transition:all .28s;z-index:200;box-shadow:0 8px 40px rgba(0,0,0,.5)}
.toast.on{transform:translateY(0);opacity:1}
.t-dot{width:6px;height:6px;border-radius:50%}
.toast.ok .t-dot{background:var(--gn)}
.toast.err .t-dot{background:var(--rd)}
@media(max-width:900px){
  .content{grid-template-columns:1fr;grid-template-rows:40% 1fr}
  .panel{border-right:none;border-bottom:1px solid var(--bd)}
}
</style>
</head>
<body>
<div class="app">
@include('partials.sidebar', ['active' => 'products-bulk-modal'])

<div class="main">
  <div class="topbar">
    <div>
      <div class="tb-ttl">Update Harga Modal Massal</div>
      <div class="tb-sub">Pilih produk, input harga modal baru, preview harga jual, simpan sekaligus</div>
    </div>
    <a href="/products" class="btn btn-ghost">← Daftar Produk</a>
  </div>

  <div class="content">
    {{-- Panel kiri: cari produk --}}
    <div class="panel">
      <div class="panel-head">
        <div class="panel-ttl">Cari & Tambah Produk</div>
        <div class="panel-sub">Filter kategori, cari nama, klik Tambah ke daftar</div>
      </div>
      <div class="fbar">
        <input type="search" id="search-q" class="fi" placeholder="Cari nama produk..." autocomplete="off">
        <select id="search-cat" class="fi fi-sel">
          <option value="">Semua kategori</option>
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
          @endforeach
        </select>
        <button type="button" class="btn btn-gold btn-sm" onclick="searchProducts()">Cari</button>
      </div>
      <div class="scroll">
        <table>
          <thead>
            <tr>
              <th>Produk</th>
              <th>Modal</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="search-results">
            <tr><td colspan="3" class="empty">Ketik nama produk lalu klik Cari</td></tr>
          </tbody>
        </table>
      </div>
    </div>

    {{-- Panel kanan: daftar update --}}
    <div class="panel">
      <div class="panel-head">
        <div class="panel-ttl">Daftar Update</div>
        <div class="panel-sub">Harga jual dihitung otomatis dari margin produk</div>
      </div>
      <div class="scroll">
        <table>
          <thead>
            <tr>
              <th>Produk</th>
              <th>Modal lama</th>
              <th>Modal baru</th>
              <th>Preview jual dus</th>
              <th>Preview jual pcs</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="work-list">
            <tr id="work-empty"><td colspan="6" class="empty">Belum ada produk di daftar</td></tr>
          </tbody>
        </table>
      </div>
      <div class="work-foot">
        <span class="work-count" id="work-count">0 produk</span>
        <div style="display:flex;gap:8px">
          <button type="button" class="btn btn-ghost" onclick="clearWorkList()">Kosongkan</button>
          <button type="button" class="btn btn-gold" id="save-btn" onclick="saveAll()" disabled>Simpan Semua</button>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<div class="toast" id="toast"><div class="t-dot"></div><span id="t-msg"></span></div>

<script>
const CSRF = @json(csrf_token());
const Rp = n => 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.round(n));
const esc = s => String(s ?? '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/"/g,'&quot;');

const workItems = new Map();
let lastSearchResults = [];

function calcPrices(hbd, qty, md, mdt, mp, mpt) {
  hbd = parseFloat(hbd) || 0;
  qty = parseInt(qty, 10) || 1;
  md  = parseFloat(md) || 0;
  mp  = parseFloat(mp) || 0;
  const hd  = mdt === 'percent' ? hbd * (1 + md / 100) : hbd + md;
  const hbp = qty > 0 ? hd / qty : 0;
  const hp  = mpt === 'percent' ? hbp * (1 + mp / 100) : hbp + mp;
  return { harga_jual_dus: Math.ceil(hd), harga_jual_pcs: Math.ceil(hp) };
}

function showToast(msg, type = 'ok') {
  const t = document.getElementById('toast');
  document.getElementById('t-msg').textContent = msg;
  t.className = 'toast ' + type + ' on';
  clearTimeout(showToast._t);
  showToast._t = setTimeout(() => t.classList.remove('on'), 2800);
}

async function searchProducts() {
  const q = document.getElementById('search-q').value.trim();
  const categoryId = document.getElementById('search-cat').value;
  const tbody = document.getElementById('search-results');

  const params = new URLSearchParams();
  if (q) params.set('q', q);
  if (categoryId) params.set('category_id', categoryId);

  tbody.innerHTML = '<tr><td colspan="3" class="empty">Memuat...</td></tr>';

  try {
    const res = await fetch('/products/bulk-modal/search?' + params.toString(), {
      headers: { 'Accept': 'application/json' },
    });
    const data = await res.json();
    const products = data.products || [];
    lastSearchResults = products;

    if (!products.length) {
      tbody.innerHTML = '<tr><td colspan="3" class="empty">Produk tidak ditemukan</td></tr>';
      return;
    }

    tbody.innerHTML = products.map(p => {
      const inList = workItems.has(p.id);
      return `<tr>
        <td>
          <div class="c-nm">${esc(p.name)}</div>
          <div class="c-cat">${esc(p.category_name)}</div>
        </td>
        <td class="c-mono">${Rp(p.harga_beli_dus)}</td>
        <td>
          <button type="button" class="btn btn-gold btn-sm btn-add-work" data-id="${p.id}" ${inList ? 'disabled' : ''}>
            ${inList ? 'Sudah ada' : '+ Tambah'}
          </button>
        </td>
      </tr>`;
    }).join('');
  } catch (e) {
    tbody.innerHTML = '<tr><td colspan="3" class="empty">Gagal memuat produk</td></tr>';
    showToast('Gagal memuat produk', 'err');
  }
}

function addToWork(product) {
  if (workItems.has(product.id)) {
    showToast('Produk sudah ada di daftar', 'err');
    return;
  }
  workItems.set(product.id, {
    ...product,
    new_harga_beli_dus: product.harga_beli_dus,
  });
  renderWorkList();
  searchProducts();
  showToast(product.name + ' ditambahkan', 'ok');
}

function removeFromWork(id) {
  workItems.delete(id);
  renderWorkList();
  searchProducts();
}

function clearWorkList() {
  if (!workItems.size) return;
  if (!confirm('Kosongkan semua produk dari daftar?')) return;
  workItems.clear();
  renderWorkList();
  searchProducts();
}

function updatePreview(id, value) {
  const item = workItems.get(id);
  if (!item) return;
  item.new_harga_beli_dus = parseInt(value, 10) || 0;
  const preview = calcPrices(
    item.new_harga_beli_dus,
    item.qty_per_dus,
    item.margin_dus,
    item.margin_dus_type,
    item.margin_pcs,
    item.margin_pcs_type
  );
  const dusEl = document.getElementById('prev-dus-' + id);
  const pcsEl = document.getElementById('prev-pcs-' + id);
  if (dusEl) dusEl.textContent = Rp(preview.harga_jual_dus);
  if (pcsEl) pcsEl.textContent = Rp(preview.harga_jual_pcs);
}

function renderWorkList() {
  const tbody = document.getElementById('work-list');
  const countEl = document.getElementById('work-count');
  const saveBtn = document.getElementById('save-btn');

  countEl.textContent = workItems.size + ' produk';
  saveBtn.disabled = workItems.size === 0;

  if (!workItems.size) {
    tbody.innerHTML = '<tr id="work-empty"><td colspan="6" class="empty">Belum ada produk di daftar</td></tr>';
    return;
  }

  tbody.innerHTML = '';
  workItems.forEach((item, id) => {
    const preview = calcPrices(
      item.new_harga_beli_dus,
      item.qty_per_dus,
      item.margin_dus,
      item.margin_dus_type,
      item.margin_pcs,
      item.margin_pcs_type
    );
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td>
        <div class="c-nm">${esc(item.name)}</div>
        <div class="c-cat">${esc(item.category_name)}</div>
      </td>
      <td class="c-mono">${Rp(item.harga_beli_dus)}</td>
      <td>
        <input type="number" class="ie" id="inp-${id}" value="${item.new_harga_beli_dus}" min="1" step="1">
      </td>
      <td class="preview-dus" id="prev-dus-${id}">${Rp(preview.harga_jual_dus)}</td>
      <td class="preview-pcs" id="prev-pcs-${id}">${Rp(preview.harga_jual_pcs)}</td>
      <td><button type="button" class="btn btn-ghost btn-sm" data-remove="${id}">Hapus</button></td>
    `;
    tbody.appendChild(tr);

    const inp = tr.querySelector('#inp-' + id);
    inp.addEventListener('input', () => updatePreview(id, inp.value));
    tr.querySelector('[data-remove]').addEventListener('click', () => removeFromWork(id));
  });
}

async function saveAll() {
  if (!workItems.size) return;

  const items = [];
  for (const [id, item] of workItems) {
    const inp = document.getElementById('inp-' + id);
    const val = parseInt(inp?.value, 10);
    if (!val || val <= 0) {
      showToast('Harga modal tidak valid untuk ' + item.name, 'err');
      return;
    }
    items.push({ id: parseInt(id, 10), harga_beli_dus: val });
  }

  if (!confirm('Simpan harga modal untuk ' + items.length + ' produk? Harga jual akan dihitung ulang otomatis.')) {
    return;
  }

  const btn = document.getElementById('save-btn');
  btn.disabled = true;

  try {
    const res = await fetch('/products/bulk-update-modal', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': CSRF,
        'Accept': 'application/json',
      },
      body: JSON.stringify({ items }),
    });
    const data = await res.json();

    if (!res.ok || data.status !== 'success') {
      showToast(data.message || 'Gagal menyimpan', 'err');
      return;
    }

    workItems.clear();
    renderWorkList();
    searchProducts();
    showToast(data.message || 'Berhasil disimpan', 'ok');
  } catch (e) {
    showToast('Gagal menyimpan', 'err');
  } finally {
    btn.disabled = workItems.size === 0;
  }
}

document.getElementById('search-q').addEventListener('keydown', e => {
  if (e.key === 'Enter') searchProducts();
});
document.getElementById('search-cat').addEventListener('change', () => {
  if (document.getElementById('search-q').value.trim() || document.getElementById('search-cat').value) {
    searchProducts();
  }
});
document.getElementById('search-results').addEventListener('click', e => {
  const btn = e.target.closest('.btn-add-work');
  if (!btn || btn.disabled) return;
  const id = parseInt(btn.dataset.id, 10);
  const product = lastSearchResults.find(p => p.id === id);
  if (!product) {
    showToast('Data produk tidak ditemukan, cari ulang', 'err');
    return;
  }
  addToWork(product);
});
</script>
</body>
</html>
