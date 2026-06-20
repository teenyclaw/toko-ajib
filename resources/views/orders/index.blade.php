<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Pesanan Online — POS AJIB</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{--bg:#09090b;--bg2:#111114;--bg3:#18181c;--bg4:#202025;--bg5:#2a2a30;--bd:rgba(255,255,255,.055);--bd2:rgba(255,255,255,.09);--tx:#ede9e2;--tx2:#938f88;--tx3:#4e4c49;--go:#c9a44e;--go2:#e4bf6a;--gd:rgba(201,164,78,.09);--gd2:rgba(201,164,78,.17);--gn:#3ecf8e;--gnd:rgba(62,207,142,.09);--rd:#f87171;--rdd:rgba(248,113,113,.09);--am:#f59e0b;--bl:#60a5fa;--bld:rgba(96,165,250,.09);--pu:#a78bfa;--pud:rgba(167,139,250,.09);--rr:12px;--rs:8px;--rx:6px;--fn:'DM Sans',sans-serif;--mo:'DM Mono',monospace;--shl:0 8px 40px rgba(0,0,0,.6)}
html,body{height:100%;overflow:hidden}
body{font-family:var(--fn);background:var(--bg);color:var(--tx);font-size:14px;line-height:1.5}
.app{display:grid;grid-template-columns:216px 1fr;height:100vh}
.main{display:flex;flex-direction:column;overflow:hidden}
.sb{background:var(--bg2);border-right:1px solid var(--bd);display:flex;flex-direction:column}
.sb-logo{padding:20px 16px 18px;border-bottom:1px solid var(--bd)}
.logo{display:flex;align-items:center;gap:10px}
.logo-ico{width:30px;height:30px;background:var(--go);border-radius:7px;display:flex;align-items:center;justify-content:center}
.logo-ico svg{width:16px;height:16px;color:#09090b}
.logo-name{font-size:14px;font-weight:600}
.logo-tag{font-size:9.5px;color:var(--tx3);text-transform:uppercase;letter-spacing:.9px}
.nav{padding:8px 6px;flex:1}
.nav-sec{font-size:9.5px;color:var(--tx3);text-transform:uppercase;letter-spacing:1px;padding:14px 10px 5px}
.nav-a{display:flex;align-items:center;gap:9px;padding:8px 10px;border-radius:var(--rs);color:var(--tx2);text-decoration:none;font-size:13px;margin-bottom:1px}
.nav-a:hover{background:var(--bg3);color:var(--tx)}
.nav-a.on{background:var(--gd);color:var(--go)}
.ni{width:14px;height:14px;opacity:.6}
.nav-a.on .ni{opacity:1}
.sb-foot{padding:12px 14px;border-top:1px solid var(--bd)}
.u-row{display:flex;align-items:center;gap:8px}
.uav{width:26px;height:26px;border-radius:50%;background:var(--gd);border:1px solid var(--gd2);display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:600;color:var(--go)}
.u-nm{font-size:12.5px;font-weight:500}
.u-rl{font-size:10.5px;color:var(--tx3)}
.topbar{height:52px;padding:0 22px;border-bottom:1px solid var(--bd);background:var(--bg2);display:flex;align-items:center;gap:10px}
.tb-ttl{font-size:14.5px;font-weight:500;flex:1}
.btn{display:inline-flex;align-items:center;gap:6px;padding:7px 13px;border-radius:var(--rs);font-size:12.5px;font-weight:500;cursor:pointer;border:none;text-decoration:none;font-family:var(--fn)}
.btn-gold{background:var(--go);color:#09090b;font-weight:600}
.btn-gold:hover{background:var(--go2)}
.btn-ghost{background:var(--bg3);color:var(--tx2);border:1px solid var(--bd2)}
.btn-ghost:hover{border-color:var(--go);color:var(--go)}
.stats{display:grid;grid-template-columns:repeat(4,1fr);gap:10px;padding:14px 22px;border-bottom:1px solid var(--bd)}
.stat{background:var(--bg2);border:1px solid var(--bd);border-radius:var(--rr);padding:12px 14px}
.stat-l{font-size:10px;color:var(--tx3);text-transform:uppercase;letter-spacing:.8px;margin-bottom:5px}
.stat-v{font-size:20px;font-weight:600;font-family:var(--mo)}
.sv-go{color:var(--go)}.sv-pu{color:var(--pu)}.sv-gn{color:var(--gn)}.sv-rd{color:var(--rd)}
.fbar{padding:10px 22px;border-bottom:1px solid var(--bd);display:flex;align-items:center;gap:8px;flex-wrap:wrap}
.fi{background:var(--bg3);border:1px solid var(--bd2);color:var(--tx);border-radius:var(--rs);padding:7px 11px;font-family:var(--fn);font-size:13px;outline:none}
.fi-search{flex:1;max-width:240px}
.p-tabs{display:flex;background:var(--bg3);border:1px solid var(--bd2);border-radius:var(--rs);padding:3px;gap:2px}
.p-tab{padding:6px 12px;border-radius:var(--rx);font-size:12px;font-weight:500;cursor:pointer;color:var(--tx3);background:transparent;border:none;font-family:var(--fn);text-decoration:none}
.p-tab.on{background:var(--bg4);color:var(--tx)}
.tw{flex:1;overflow-y:auto}
table{width:100%;border-collapse:collapse}
thead th{font-size:10px;color:var(--tx3);text-transform:uppercase;letter-spacing:.8px;padding:9px 14px;text-align:left;border-bottom:1px solid var(--bd);background:var(--bg2);position:sticky;top:0}
tbody tr{border-bottom:1px solid var(--bd);cursor:pointer}
tbody tr:hover{background:rgba(255,255,255,.018)}
tbody td{padding:11px 14px;font-size:12.5px;color:var(--tx2);vertical-align:middle}
.c-no{font-family:var(--mo);color:var(--go);font-weight:500;font-size:12px}
.c-nm{font-size:13px;font-weight:500;color:var(--tx)}
.c-sub{font-size:11px;color:var(--tx3);margin-top:2px}
.st{display:inline-flex;padding:2px 8px;border-radius:20px;font-size:10.5px;font-weight:500;text-transform:capitalize}
.st-pending{background:var(--gd);color:var(--go)}
.st-processing{background:var(--pud);color:var(--pu)}
.st-completed{background:var(--gnd);color:var(--gn)}
.st-cancelled{background:var(--rdd);color:var(--rd)}
.empty{text-align:center;padding:64px 20px;color:var(--tx3)}
.pag{padding:12px 22px;border-top:1px solid var(--bd);display:flex;justify-content:center;gap:4px}
.pag a,.pag span{padding:6px 11px;border-radius:var(--rx);font-size:12px;text-decoration:none;color:var(--tx2);border:1px solid var(--bd)}
.pag .on{background:var(--gd);color:var(--go);border-color:var(--gd2)}
.ov{position:fixed;inset:0;background:rgba(0,0,0,.6);z-index:40;opacity:0;pointer-events:none;transition:opacity .24s}
.ov.on{opacity:1;pointer-events:all}
.panel{position:fixed;top:0;right:0;bottom:0;width:480px;background:var(--bg2);border-left:1px solid var(--bd2);z-index:41;transform:translateX(100%);transition:transform .28s;display:flex;flex-direction:column;box-shadow:var(--shl)}
.panel.on{transform:translateX(0)}
.p-head{padding:18px 22px;border-bottom:1px solid var(--bd);display:flex;align-items:flex-start;gap:10px}
.p-ttl{font-size:14.5px;font-weight:500}
.p-sub{font-size:11.5px;color:var(--tx3);font-family:var(--mo);margin-top:2px}
.p-cls{margin-left:auto;background:var(--bg4);border:1px solid var(--bd2);color:var(--tx2);border-radius:var(--rx);width:26px;height:26px;cursor:pointer}
.p-body{flex:1;overflow-y:auto;padding:18px 22px}
.p-foot{padding:14px 22px;border-top:1px solid var(--bd);display:flex;gap:8px}
.pf-btn{flex:1;padding:10px;border-radius:var(--rs);font-family:var(--fn);font-size:13px;font-weight:600;cursor:pointer;border:none;text-align:center;text-decoration:none;display:flex;align-items:center;justify-content:center}
.pf-go{background:var(--go);color:#09090b}
.pf-ghost{background:var(--bg4);color:var(--tx2);border:1px solid var(--bd2)!important}
.pf-rd{background:var(--rdd);color:var(--rd);border:1px solid rgba(248,113,113,.2)!important}
.dv-row{display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid var(--bd);font-size:13px}
.dv-row:last-child{border-bottom:none}
.item-tbl{width:100%;margin-top:12px}
.item-tbl th,.item-tbl td{padding:8px 6px;font-size:12px;border-bottom:1px solid var(--bd);text-align:left}
</style>
</head>
<body>
<div class="app">
<aside class="sb">
<div class="sb-logo"><div class="logo"><div class="logo-ico"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M3 3h7v7H3V3zm0 11h7v7H3v-7zm11-11h7v7h-7V3z"/></svg></div><div><div class="logo-name">TOKO AJIB</div><div class="logo-tag">Point of Sale</div></div></div></div>
<nav class="nav">
  <div class="nav-sec">Utama</div>
  <a href="/dashboard" class="nav-a"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="2" width="9" height="9" rx="2"/><rect x="13" y="2" width="9" height="9" rx="2"/><rect x="2" y="13" width="9" height="9" rx="2"/><rect x="13" y="13" width="9" height="9" rx="2"/></svg>Kasir</a>
  <a href="/online-orders" class="nav-a on"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/></svg>Pesanan Online</a>
  <a href="/products" class="nav-a"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/></svg>Produk</a>
  <a href="/transactions" class="nav-a"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/></svg>Transaksi</a>
  <a href="/customers" class="nav-a"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="8" cy="7" r="4"/><path d="M2 21v-2a4 4 0 014-4h4a4 4 0 014 4v2"/></svg>Pelanggan</a>
</nav>
<div class="sb-foot"><div class="u-row"><div class="uav">{{ substr(auth()->user()->name??'A',0,1) }}</div><div><div class="u-nm">{{ auth()->user()->name??'Admin' }}</div><div class="u-rl">Kasir</div></div></div></div>
</aside>

<main class="main">
<div class="topbar">
  <div class="tb-ttl">Riwayat Pesanan Online</div>
  <a href="/settings/order" class="btn btn-ghost">Pengaturan</a>
  <a href="/dashboard" class="btn btn-gold">Buka Kasir</a>
</div>

<div class="stats">
  <div class="stat"><div class="stat-l">Pending</div><div class="stat-v sv-go">{{ $stats['pending'] }}</div></div>
  <div class="stat"><div class="stat-l">Diproses</div><div class="stat-v sv-pu">{{ $stats['processing'] }}</div></div>
  <div class="stat"><div class="stat-l">Selesai Hari Ini</div><div class="stat-v sv-gn">{{ $stats['completed'] }}</div></div>
  <div class="stat"><div class="stat-l">Ditolak Hari Ini</div><div class="stat-v sv-rd">{{ $stats['cancelled'] }}</div></div>
</div>

<form method="GET" action="/online-orders" class="fbar">
  <div class="p-tabs">
    @foreach(['all'=>'Semua','pending'=>'Pending','processing'=>'Diproses','completed'=>'Selesai','cancelled'=>'Ditolak'] as $key=>$label)
    <a href="/online-orders?status={{ $key }}{{ $search ? '&search='.urlencode($search) : '' }}" class="p-tab {{ $status===$key?'on':'' }}">{{ $label }}</a>
    @endforeach
  </div>
  <input type="hidden" name="status" value="{{ $status }}">
  <input class="fi fi-search" type="search" name="search" value="{{ $search }}" placeholder="Cari no. pesanan / nama / telepon...">
  <button type="submit" class="btn btn-gold" style="padding:7px 12px">Cari</button>
  <span style="font-size:11.5px;color:var(--tx3);margin-left:auto">{{ $orders->total() }} pesanan</span>
</form>

<div class="tw">
@if($orders->isEmpty())
<div class="empty"><p>Belum ada pesanan</p></div>
@else
<table>
<thead><tr><th>No. Pesanan</th><th>Pelanggan</th><th>Item</th><th>Status</th><th>Total</th><th>Waktu</th></tr></thead>
<tbody>
@foreach($orders as $order)
<tr onclick="openDetail({{ $order->id }})">
  <td><span class="c-no">{{ $order->order_number }}</span></td>
  <td><div class="c-nm">{{ $order->customer_name }}</div><div class="c-sub">{{ $order->customer_phone }}</div></td>
  <td>{{ $order->items->sum('qty') }} item</td>
  <td><span class="st st-{{ $order->status }}">{{ $order->status }}</span></td>
  <td>@if($order->subtotal > 0) Rp {{ number_format($order->subtotal,0,',','.') }} @else — @endif</td>
  <td class="c-sub">{{ $order->created_at?->format('d/m/Y H:i') }}</td>
</tr>
@endforeach
</tbody>
</table>
@endif
</div>

@if($orders->hasPages())
<div class="pag">{{ $orders->links('pagination::simple-default') }}</div>
@endif
</main>
</div>

<div class="ov" id="ov" onclick="closeDetail()"></div>
<div class="panel" id="panel">
  <div class="p-head">
    <div><div class="p-ttl" id="p-ttl">Detail Pesanan</div><div class="p-sub" id="p-sub"></div></div>
    <button class="p-cls" onclick="closeDetail()">✕</button>
  </div>
  <div class="p-body" id="p-body"></div>
  <div class="p-foot" id="p-foot"></div>
</div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
const esc = s => String(s??'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/"/g,'&quot;');
let currentOrderId = null;

async function openDetail(id) {
  currentOrderId = id;
  document.getElementById('ov').classList.add('on');
  document.getElementById('panel').classList.add('on');
  document.getElementById('p-body').innerHTML = '<p style="color:var(--tx3)">Memuat...</p>';
  document.getElementById('p-foot').innerHTML = '';

  const res = await fetch('/pos/orders/' + id, { headers: { 'Accept': 'application/json' } });
  const o = await res.json();
  document.getElementById('p-ttl').textContent = o.order_number;
  document.getElementById('p-sub').textContent = o.created_at;

  let html = `
    <div class="dv-row"><span>Pelanggan</span><strong>${esc(o.customer_name)}</strong></div>
    <div class="dv-row"><span>Telepon</span><strong>${esc(o.customer_phone)}</strong></div>
    ${o.customer_address ? `<div class="dv-row"><span>Alamat</span><strong>${esc(o.customer_address)}</strong></div>` : ''}
    ${o.notes ? `<div class="dv-row"><span>Catatan</span><strong>${esc(o.notes)}</strong></div>` : ''}
    <div class="dv-row"><span>Status</span><span class="st st-${o.status}">${esc(o.status)}</span></div>
    <table class="item-tbl"><thead><tr><th>Produk</th><th>Qty</th><th>Stok</th></tr></thead><tbody>
    ${(o.items||[]).map(i => `<tr><td>${esc(i.product_name)}</td><td>${i.qty} ${esc(i.unit)}</td><td>${i.stock ?? '—'}</td></tr>`).join('')}
    </tbody></table>`;
  document.getElementById('p-body').innerHTML = html;

  let foot = '';
  if (['pending','processing'].includes(o.status)) {
    foot += `<button class="pf-btn pf-go" onclick="loadOrder(${id})">Muat ke Keranjang</button>`;
    foot += `<button class="pf-btn pf-rd" onclick="cancelOrder(${id})">Tolak</button>`;
  }
  foot += `<a href="/dashboard" class="pf-btn pf-ghost">Ke Kasir</a>`;
  document.getElementById('p-foot').innerHTML = foot;
}

function closeDetail() {
  document.getElementById('ov').classList.remove('on');
  document.getElementById('panel').classList.remove('on');
}

async function loadOrder(id) {
  const res = await fetch('/pos/orders/' + id + '/load', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
  });
  const data = await res.json();
  if (data.status !== 'success') { alert(data.message || 'Gagal'); return; }
  window.location.href = '/dashboard';
}

async function cancelOrder(id) {
  if (!confirm('Batalkan pesanan ini?')) return;
  const res = await fetch('/pos/orders/' + id + '/cancel', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
  });
  const data = await res.json();
  if (data.status !== 'success') { alert(data.message || 'Gagal'); return; }
  location.reload();
}
</script>
</body>
</html>
