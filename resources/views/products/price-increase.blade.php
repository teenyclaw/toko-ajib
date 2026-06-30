<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Info Kenaikan Harga — POS AJIB</title>
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
.btn-wa{background:#25d366;color:#fff;font-weight:600}
.btn-wa:hover{background:#1ebe57}
.content{flex:1;overflow:hidden;display:grid;grid-template-columns:minmax(260px,34%) 1fr;min-height:0}
.panel{display:flex;flex-direction:column;min-height:0;border-right:1px solid var(--bd)}
.panel:last-child{border-right:none}
.panel-head{padding:14px 18px 10px;border-bottom:1px solid var(--bd);flex-shrink:0}
.panel-ttl{font-size:13px;font-weight:600;margin-bottom:4px}
.panel-sub{font-size:11.5px;color:var(--tx3)}
.fbar{display:flex;gap:8px;flex-wrap:wrap;padding:12px 18px;border-bottom:1px solid var(--bd);flex-shrink:0;align-items:center}
.fi{background:var(--bg3);border:1px solid var(--bd2);color:var(--tx);border-radius:var(--rs);padding:7px 11px;font-family:var(--f);font-size:13px;outline:none;flex:1;min-width:100px}
.fi:focus{border-color:var(--go)}
.fi-sel{flex:0 0 140px;cursor:pointer}
.fi-narrow{width:64px;flex:0 0 64px;min-width:64px;font-family:var(--m)}
.margin-bar{display:flex;gap:10px;flex-wrap:wrap;padding:10px 18px;border-bottom:1px solid var(--bd);background:var(--bg3);flex-shrink:0;align-items:flex-end}
.mg{display:flex;flex-direction:column;gap:4px}
.mg-lbl{font-size:10px;color:var(--tx3);text-transform:uppercase;letter-spacing:.5px}
.mg-row{display:flex;gap:4px;align-items:center}
.ttog{display:flex;border:1px solid var(--bd2);border-radius:var(--rx);overflow:hidden;height:30px}
.ttog button{padding:0 8px;font-size:11px;background:var(--bg4);color:var(--tx3);border:none;cursor:pointer;font-family:var(--f)}
.ttog button.on{background:var(--gd);color:var(--go);font-weight:600}
.scroll{flex:1;overflow:auto;min-height:0}
.scroll::-webkit-scrollbar{width:4px;height:4px}
.scroll::-webkit-scrollbar-thumb{background:var(--bg5)}
table{width:100%;border-collapse:collapse}
thead th{font-size:10px;color:var(--tx3);text-transform:uppercase;letter-spacing:.7px;font-weight:500;padding:8px 10px;text-align:left;border-bottom:1px solid var(--bd);background:var(--bg2);position:sticky;top:0;z-index:2;white-space:nowrap}
tbody td{padding:8px 10px;border-bottom:1px solid var(--bd);font-size:12px;color:var(--tx2);vertical-align:middle}
tbody tr:hover{background:rgba(255,255,255,.02)}
.c-nm{font-weight:500;color:var(--tx);font-size:13px}
.c-cat{font-size:10px;color:var(--tx3);margin-top:2px}
.c-mono{font-family:var(--m);font-size:12px;color:var(--tx)}
.preview-dus{color:var(--go);font-family:var(--m);font-size:12px;font-weight:500}
.preview-pcs{color:var(--bl);font-family:var(--m);font-size:12px;font-weight:500}
.ie{background:var(--bg4);border:1px solid var(--bd2);color:var(--tx);border-radius:var(--rx);padding:5px 6px;font-family:var(--m);font-size:11px;outline:none;width:52px}
.ie:focus{border-color:var(--go)}
.empty{padding:40px 20px;text-align:center;color:var(--tx3);font-size:13px}
.work-foot{padding:12px 18px;border-top:1px solid var(--bd);display:flex;align-items:center;justify-content:space-between;gap:10px;flex-shrink:0;background:var(--bg2);flex-wrap:wrap}
.work-count{font-size:12px;color:var(--tx3)}
.foot-actions{display:flex;gap:8px;flex-wrap:wrap}
.toast{position:fixed;bottom:22px;right:22px;background:var(--bg3);border:1px solid var(--bd2);border-radius:var(--rr);padding:11px 15px;display:flex;align-items:center;gap:9px;font-size:13px;transform:translateY(70px);opacity:0;transition:all .28s;z-index:200;box-shadow:0 8px 40px rgba(0,0,0,.5)}
.toast.on{transform:translateY(0);opacity:1}
.t-dot{width:6px;height:6px;border-radius:50%}
.toast.ok .t-dot{background:var(--gn)}
.toast.err .t-dot{background:var(--rd)}
@media(max-width:1100px){
  .content{grid-template-columns:1fr;grid-template-rows:38% 1fr}
  .panel{border-right:none;border-bottom:1px solid var(--bd)}
}
</style>
@include('partials.admin-shell-mobile-styles')
</head>
<body>
@include('partials.admin-shell-mobile-body-start')
@include('partials.sidebar', ['active' => 'products-price-increase', 'sidebarId' => 'sb'])

<div class="main">
  <div class="topbar">
    @include('partials.sb-toggle')
    <div>
      <div class="tb-ttl">Info Kenaikan Harga</div>
      <div class="tb-sub">Hitung harga jual dari modal DB + margin, cetak struk atau kirim WhatsApp</div>
    </div>
    <a href="/products" class="btn btn-ghost">← Daftar Produk</a>
  </div>

  <div class="content">
    <div class="panel">
      <div class="panel-head">
        <div class="panel-ttl">Cari & Tambah Produk</div>
        <div class="panel-sub">Modal diambil otomatis dari database</div>
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
          <thead><tr><th>Produk</th><th>Modal</th><th></th></tr></thead>
          <tbody id="search-results">
            <tr><td colspan="3" class="empty">Ketik nama produk lalu klik Cari</td></tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="panel">
      <div class="panel-head">
        <div class="panel-ttl">Daftar Kenaikan Harga</div>
        <div class="panel-sub">Atur margin, preview jual pcs & dus (bulat ke atas 500)</div>
      </div>

      <div class="margin-bar">
        <div class="mg">
          <span class="mg-lbl">Margin Dus (global)</span>
          <div class="mg-row">
            <div class="ttog" id="glob-dus-type">
              <button type="button" class="on" data-type="percent">%</button>
              <button type="button" data-type="nominal">Rp</button>
            </div>
            <input type="number" id="glob-md" class="fi fi-narrow" value="10" min="0" step="0.1">
          </div>
        </div>
        <div class="mg">
          <span class="mg-lbl">Margin Pcs (global)</span>
          <div class="mg-row">
            <div class="ttog" id="glob-pcs-type">
              <button type="button" class="on" data-type="percent">%</button>
              <button type="button" data-type="nominal">Rp</button>
            </div>
            <input type="number" id="glob-mp" class="fi fi-narrow" value="15" min="0" step="0.1">
          </div>
        </div>
        <button type="button" class="btn btn-ghost btn-sm" onclick="applyMarginToAll()">Terapkan ke Semua</button>
        <input type="tel" id="wa-phone" class="fi" style="flex:0 0 130px;min-width:130px" placeholder="No. WA (opsional)">
      </div>

      <div class="scroll">
        <table>
          <thead>
            <tr>
              <th>Produk</th>
              <th>Modal</th>
              <th>Mrg Dus</th>
              <th>Mrg Pcs</th>
              <th>Jual Dus</th>
              <th>Jual Pcs</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="work-list">
            <tr id="work-empty"><td colspan="7" class="empty">Belum ada produk di daftar</td></tr>
          </tbody>
        </table>
      </div>

      <div class="work-foot">
        <span class="work-count" id="work-count">0 produk</span>
        <div class="foot-actions">
          <button type="button" class="btn btn-ghost" onclick="clearWorkList()">Kosongkan</button>
          <button type="button" class="btn btn-wa" id="wa-btn" onclick="shareWhatsApp()" disabled>WhatsApp</button>
          <button type="button" class="btn btn-gold" id="print-btn" onclick="printStruk()" disabled>Cetak Struk</button>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<div class="toast" id="toast"><div class="t-dot"></div><span id="t-msg"></span></div>

<form id="print-form" method="POST" action="/products/price-increase/print" target="_blank" style="display:none">
  @csrf
  <input type="hidden" name="payload" id="print-payload">
</form>

<script>
const CSRF = @json(csrf_token());
const Rp = n => 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.round(n));
const RpPlain = n => 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.round(n));
const esc = s => String(s ?? '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/"/g,'&quot;');

const workItems = new Map();
let lastSearchResults = [];
const globTypes = { dus: 'percent', pcs: 'percent' };

function roundUp500(n) {
  n = parseFloat(n) || 0;
  if (n <= 0) return 0;
  return Math.ceil(n / 500) * 500;
}

function calcSelling(hbd, qty, md, mdt, mp, mpt) {
  hbd = parseFloat(hbd) || 0;
  qty = parseInt(qty, 10) || 1;
  md  = parseFloat(md) || 0;
  mp  = parseFloat(mp) || 0;
  const rawDus = mdt === 'percent' ? hbd * (1 + md / 100) : hbd + md;
  const beliPcs = qty > 0 ? rawDus / qty : 0;
  const rawPcs = mpt === 'percent' ? beliPcs * (1 + mp / 100) : beliPcs + mp;
  return {
    harga_jual_dus: roundUp500(rawDus),
    harga_jual_pcs: roundUp500(rawPcs),
  };
}

function showToast(msg, type = 'ok') {
  const t = document.getElementById('toast');
  document.getElementById('t-msg').textContent = msg;
  t.className = 'toast ' + type + ' on';
  clearTimeout(showToast._t);
  showToast._t = setTimeout(() => t.classList.remove('on'), 2800);
}

function setupTypeToggle(containerId, key) {
  const el = document.getElementById(containerId);
  el.querySelectorAll('button').forEach(btn => {
    btn.addEventListener('click', () => {
      el.querySelectorAll('button').forEach(b => b.classList.remove('on'));
      btn.classList.add('on');
      globTypes[key] = btn.dataset.type;
    });
  });
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
        <td><div class="c-nm">${esc(p.name)}</div><div class="c-cat">${esc(p.category_name)}</div></td>
        <td class="c-mono">${Rp(p.harga_beli_dus)}</td>
        <td><button type="button" class="btn btn-gold btn-sm btn-add-work" data-id="${p.id}" ${inList ? 'disabled' : ''}>${inList ? 'Sudah ada' : '+ Tambah'}</button></td>
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
    id: product.id,
    name: product.name,
    category_name: product.category_name,
    harga_beli_dus: product.harga_beli_dus,
    qty_per_dus: product.qty_per_dus,
    margin_dus: product.margin_dus,
    margin_dus_type: product.margin_dus_type || 'percent',
    margin_pcs: product.margin_pcs,
    margin_pcs_type: product.margin_pcs_type || 'percent',
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

function applyMarginToAll() {
  if (!workItems.size) {
    showToast('Daftar masih kosong', 'err');
    return;
  }
  const md = parseFloat(document.getElementById('glob-md').value) || 0;
  const mp = parseFloat(document.getElementById('glob-mp').value) || 0;
  workItems.forEach(item => {
    item.margin_dus = md;
    item.margin_dus_type = globTypes.dus;
    item.margin_pcs = mp;
    item.margin_pcs_type = globTypes.pcs;
  });
  renderWorkList();
  showToast('Margin diterapkan ke semua produk', 'ok');
}

function marginCell(id, kind) {
  const item = workItems.get(id);
  const isDus = kind === 'dus';
  const typeKey = isDus ? 'margin_dus_type' : 'margin_pcs_type';
  const valKey = isDus ? 'margin_dus' : 'margin_pcs';
  const type = item[typeKey] || 'percent';
  return `<div class="mg-row" style="gap:3px">
    <div class="ttog ttog-sm" data-id="${id}" data-kind="${kind}">
      <button type="button" class="${type === 'percent' ? 'on' : ''}" data-type="percent">%</button>
      <button type="button" class="${type === 'nominal' ? 'on' : ''}" data-type="nominal">Rp</button>
    </div>
    <input type="number" class="ie margin-inp" data-id="${id}" data-kind="${kind}" value="${item[valKey]}" min="0" step="0.1">
  </div>`;
}

function renderWorkList() {
  const tbody = document.getElementById('work-list');
  const countEl = document.getElementById('work-count');
  const printBtn = document.getElementById('print-btn');
  const waBtn = document.getElementById('wa-btn');

  countEl.textContent = workItems.size + ' produk';
  printBtn.disabled = workItems.size === 0;
  waBtn.disabled = workItems.size === 0;

  if (!workItems.size) {
    tbody.innerHTML = '<tr id="work-empty"><td colspan="7" class="empty">Belum ada produk di daftar</td></tr>';
    return;
  }

  tbody.innerHTML = '';
  workItems.forEach((item, id) => {
    const preview = calcSelling(
      item.harga_beli_dus, item.qty_per_dus,
      item.margin_dus, item.margin_dus_type,
      item.margin_pcs, item.margin_pcs_type
    );
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td><div class="c-nm">${esc(item.name)}</div><div class="c-cat">${esc(item.category_name)}</div></td>
      <td class="c-mono">${Rp(item.harga_beli_dus)}</td>
      <td>${marginCell(id, 'dus')}</td>
      <td>${marginCell(id, 'pcs')}</td>
      <td class="preview-dus" id="prev-dus-${id}">${Rp(preview.harga_jual_dus)}</td>
      <td class="preview-pcs" id="prev-pcs-${id}">${Rp(preview.harga_jual_pcs)}</td>
      <td><button type="button" class="btn btn-ghost btn-sm" data-remove="${id}">Hapus</button></td>
    `;
    tbody.appendChild(tr);
  });

  tbody.querySelectorAll('.margin-inp').forEach(inp => {
    inp.addEventListener('input', () => {
      const item = workItems.get(parseInt(inp.dataset.id, 10));
      if (!item) return;
      const kind = inp.dataset.kind;
      const val = parseFloat(inp.value) || 0;
      if (kind === 'dus') item.margin_dus = val;
      else item.margin_pcs = val;
      updateRowPreview(inp.dataset.id);
    });
  });

  tbody.querySelectorAll('.ttog-sm').forEach(tog => {
    tog.querySelectorAll('button').forEach(btn => {
      btn.addEventListener('click', () => {
        const id = parseInt(tog.dataset.id, 10);
        const item = workItems.get(id);
        if (!item) return;
        tog.querySelectorAll('button').forEach(b => b.classList.remove('on'));
        btn.classList.add('on');
        if (tog.dataset.kind === 'dus') item.margin_dus_type = btn.dataset.type;
        else item.margin_pcs_type = btn.dataset.type;
        updateRowPreview(id);
      });
    });
  });

  tbody.querySelectorAll('[data-remove]').forEach(btn => {
    btn.addEventListener('click', () => removeFromWork(parseInt(btn.dataset.remove, 10)));
  });
}

function updateRowPreview(id) {
  id = parseInt(id, 10);
  const item = workItems.get(id);
  if (!item) return;
  const preview = calcSelling(
    item.harga_beli_dus, item.qty_per_dus,
    item.margin_dus, item.margin_dus_type,
    item.margin_pcs, item.margin_pcs_type
  );
  const dusEl = document.getElementById('prev-dus-' + id);
  const pcsEl = document.getElementById('prev-pcs-' + id);
  if (dusEl) dusEl.textContent = Rp(preview.harga_jual_dus);
  if (pcsEl) pcsEl.textContent = Rp(preview.harga_jual_pcs);
}

function buildItemsPayload() {
  const items = [];
  for (const [id, item] of workItems) {
    items.push({
      id: parseInt(id, 10),
      margin_dus: item.margin_dus,
      margin_dus_type: item.margin_dus_type,
      margin_pcs: item.margin_pcs,
      margin_pcs_type: item.margin_pcs_type,
    });
  }
  return items;
}

function printStruk() {
  if (!workItems.size) return;
  const form = document.getElementById('print-form');
  document.getElementById('print-payload').value = JSON.stringify({ items: buildItemsPayload() });
  form.submit();
}

function shareWhatsApp() {
  if (!workItems.size) return;

  const today = new Date();
  const dateStr = String(today.getDate()).padStart(2,'0') + '/' +
    String(today.getMonth() + 1).padStart(2,'0') + '/' + today.getFullYear();

  let text = '*INFO KENAIKAN HARGA — TOKO AJIB*\n';
  text += 'Tanggal: ' + dateStr + '\n\n';

  for (const [, item] of workItems) {
    const p = calcSelling(
      item.harga_beli_dus, item.qty_per_dus,
      item.margin_dus, item.margin_dus_type,
      item.margin_pcs, item.margin_pcs_type
    );
    text += '• ' + item.name + '\n';
    text += '  Jual Pcs: ' + RpPlain(p.harga_jual_pcs) + '\n';
    text += '  Jual Dus: ' + RpPlain(p.harga_jual_dus) + '\n\n';
  }

  let phone = (document.getElementById('wa-phone').value || '').replace(/\D/g, '');
  if (phone.startsWith('0')) phone = '62' + phone.slice(1);
  if (phone.startsWith('8')) phone = '62' + phone;

  const base = phone ? 'https://wa.me/' + phone : 'https://wa.me/';
  window.open(base + '?text=' + encodeURIComponent(text.trim()), '_blank');
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

setupTypeToggle('glob-dus-type', 'dus');
setupTypeToggle('glob-pcs-type', 'pcs');
</script>
@include('partials.admin-shell-mobile-scripts')
</body>
</html>
