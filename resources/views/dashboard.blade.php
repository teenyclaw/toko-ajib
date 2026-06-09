<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Kasir — POS AJIB</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --bg:#09090b;--bg2:#111114;--bg3:#18181c;--bg4:#202025;--bg5:#2a2a30;
  --bd:rgba(255,255,255,.055);--bd2:rgba(255,255,255,.09);--bd3:rgba(255,255,255,.15);
  --tx:#ede9e2;--tx2:#938f88;--tx3:#4e4c49;
  --go:#c9a44e;--go2:#e4bf6a;
  --gd:rgba(201,164,78,.09);--gd2:rgba(201,164,78,.17);--gd3:rgba(201,164,78,.27);
  --gn:#3ecf8e;--gnd:rgba(62,207,142,.09);
  --rd:#f87171;--rdd:rgba(248,113,113,.09);
  --pu:#a78bfa;--pud:rgba(167,139,250,.10);
  --rr:12px;--rs:8px;--rx:6px;
  --fn:'DM Sans',sans-serif;--mo:'DM Mono',monospace;
  --shl:0 8px 40px rgba(0,0,0,.6)
}
html,body{height:100%;overflow:hidden}
body{font-family:var(--fn);background:var(--bg);color:var(--tx);font-size:14px;line-height:1.5;-webkit-font-smoothing:antialiased}
.app{display:grid;grid-template-columns:216px 1fr 340px;height:100vh;overflow:hidden}

/* SIDEBAR */
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

/* MAIN */
.main{display:flex;flex-direction:column;overflow:hidden;background:var(--bg)}
.topbar{padding:0 22px;height:52px;border-bottom:1px solid var(--bd);display:flex;align-items:center;gap:12px;flex-shrink:0;background:var(--bg2)}
.topbar-ttl{font-size:14.5px;font-weight:500;flex:1}
.clock{font-family:var(--mo);font-size:12px;color:var(--tx3);background:var(--bg3);padding:4px 10px;border-radius:6px;border:1px solid var(--bd)}

/* PRICE MODE INDICATOR */
.price-mode{display:flex;align-items:center;gap:6px;padding:5px 12px;border-radius:20px;font-size:12px;font-weight:500;transition:all .3s}
.pm-member{background:var(--gd);color:var(--go);border:1px solid var(--gd2)}
.pm-nonmember{background:var(--pud);color:var(--pu);border:1px solid rgba(167,139,250,.25)}
.pm-dot{width:6px;height:6px;border-radius:50%;flex-shrink:0}
.pm-member .pm-dot{background:var(--go)}
.pm-nonmember .pm-dot{background:var(--pu)}

/* SEARCH */
.search-area{padding:14px 22px;border-bottom:1px solid var(--bd);flex-shrink:0}
/* Select2 override */
.select2-container--default .select2-selection--single{background:var(--bg3)!important;border:1px solid var(--bd2)!important;border-radius:var(--rs)!important;height:40px!important;display:flex!important;align-items:center!important;padding-left:12px!important}
.select2-container--default .select2-selection--single .select2-selection__rendered{color:var(--tx)!important;font-family:var(--fn)!important;font-size:13px!important;line-height:40px!important;padding-left:0!important}
.select2-container--default .select2-selection--single .select2-selection__placeholder{color:var(--tx3)!important}
.select2-container--default .select2-selection--single .select2-selection__arrow{height:40px!important}
.select2-dropdown{background:var(--bg3)!important;border:1px solid var(--bd2)!important;border-radius:var(--rs)!important;box-shadow:0 8px 32px rgba(0,0,0,.5)!important}
.select2-container--default .select2-results__option{color:var(--tx2)!important;font-family:var(--fn)!important;font-size:13px!important;padding:8px 12px!important}
.select2-container--default .select2-results__option--highlighted{background:var(--bg4)!important;color:var(--tx)!important}
.select2-container--default .select2-search--dropdown .select2-search__field{background:var(--bg4)!important;border:1px solid var(--bd2)!important;color:var(--tx)!important;font-family:var(--fn)!important;border-radius:6px!important;padding:7px 10px!important}
.price-type-row{display:flex;gap:8px;margin-top:10px}
.price-btn{flex:1;padding:7px;border:1px solid var(--bd2);background:var(--bg3);color:var(--tx2);border-radius:var(--rs);cursor:pointer;font-family:var(--fn);font-size:12px;font-weight:500;transition:all .14s}
.price-btn.on{background:var(--gd);border-color:var(--go);color:var(--go)}
.price-btn:hover:not(.on){background:var(--bg4);color:var(--tx)}
.add-btn{width:100%;margin-top:10px;padding:9px;background:var(--go);color:#09090b;border:none;border-radius:var(--rs);cursor:pointer;font-family:var(--fn);font-size:13px;font-weight:600;display:flex;align-items:center;justify-content:center;gap:6px;transition:all .14s}
.add-btn:hover{background:var(--go2)}
.add-btn:active{transform:scale(.98)}
.add-btn svg{width:14px;height:14px}

/* PRODUCT GRID */
.product-area{flex:1;overflow-y:auto;padding:14px 22px}
.product-area::-webkit-scrollbar{width:4px}
.product-area::-webkit-scrollbar-thumb{background:var(--bg4);border-radius:2px}
.sec-label{font-size:10px;color:var(--tx3);letter-spacing:.8px;text-transform:uppercase;font-weight:500;margin-bottom:10px}
.product-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(120px,1fr));gap:8px}
.p-card{background:var(--bg2);border:1px solid var(--bd);border-radius:var(--rr);padding:12px 10px;cursor:pointer;transition:all .14s;position:relative;overflow:hidden}
.p-card:hover{border-color:var(--bd2);transform:translateY(-1px)}
.p-card:active{transform:scale(.97)}
.p-card-cat{font-size:9.5px;color:var(--tx3);margin-bottom:5px;text-transform:uppercase;letter-spacing:.4px}
.p-card-name{font-size:12.5px;font-weight:500;color:var(--tx);line-height:1.3;margin-bottom:7px}
/* Harga member */
.p-card-price{font-size:11.5px;font-family:var(--mo);color:var(--go)}
/* Harga non-member */
.p-card-price-nm{font-size:11.5px;font-family:var(--mo);color:var(--pu);display:none}
.nm-mode .p-card-price{display:none}
.nm-mode .p-card-price-nm{display:block}
.p-card-stock{position:absolute;top:8px;right:8px;font-size:9.5px;background:var(--bg4);color:var(--tx3);padding:1px 5px;border-radius:3px;font-family:var(--mo)}
.p-card-stock.low{color:var(--rd)}

/* CART PANEL */
.cart-panel{background:var(--bg2);border-left:1px solid var(--bd);display:flex;flex-direction:column;overflow:hidden}
.cart-header{padding:16px 18px 14px;border-bottom:1px solid var(--bd);display:flex;align-items:center;justify-content:space-between;flex-shrink:0}
.cart-ttl{font-size:14px;font-weight:500}
.cart-count{background:var(--gd);color:var(--go);font-size:11px;font-family:var(--mo);font-weight:500;padding:2px 8px;border-radius:20px;border:1px solid var(--gd2)}

/* CUSTOMER SECTION */
.cust-section{padding:12px 18px;border-bottom:1px solid var(--bd);flex-shrink:0}
.sec-ttl{font-size:10px;color:var(--tx3);text-transform:uppercase;letter-spacing:.7px;font-weight:500;margin-bottom:6px}
.cust-select{width:100%;background:var(--bg3);border:1px solid var(--bd2);color:var(--tx);border-radius:var(--rs);padding:8px 11px;font-family:var(--fn);font-size:13px;appearance:none;cursor:pointer;outline:none;transition:border .14s}
.cust-select:focus{border-color:var(--go)}
.cust-select option{background:var(--bg3)}

/* DEBT WARNING */
.debt-warn{margin:0 18px 0;padding:9px 12px;background:var(--rdd);border:1px solid rgba(248,113,113,.2);border-radius:var(--rs);font-size:11.5px;color:var(--rd);display:none;align-items:flex-start;gap:7px;line-height:1.4}
.debt-warn.show{display:flex}
.debt-warn svg{width:13px;height:13px;flex-shrink:0;margin-top:1px}

/* CART ITEMS */
.cart-items{flex:1;overflow-y:auto;padding:6px 0}
.cart-items::-webkit-scrollbar{width:3px}
.cart-items::-webkit-scrollbar-thumb{background:var(--bg4)}
.cart-empty{display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;gap:8px;color:var(--tx3)}
.cart-empty svg{width:36px;height:36px;opacity:.2}
.cart-empty p{font-size:12.5px}
.cart-item{padding:10px 18px;border-bottom:1px solid var(--bd);display:flex;align-items:center;gap:8px;cursor:pointer;transition:background .1s}
.cart-item:hover{background:var(--bg3)}
.ci-info{flex:1;min-width:0}
.ci-name{font-size:13px;font-weight:500;color:var(--tx);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.ci-price{font-size:11px;color:var(--tx3);font-family:var(--mo);margin-top:1px}
.ci-total{font-size:13px;font-family:var(--mo);color:var(--tx);font-weight:500;flex-shrink:0}
.qty-ctrl{display:flex;align-items:center;gap:5px;flex-shrink:0}
.qty-btn{width:22px;height:22px;border:1px solid var(--bd2);background:var(--bg4);color:var(--tx2);border-radius:6px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .1s;font-size:14px}
.qty-btn:hover{border-color:var(--go);color:var(--go);background:var(--gd)}
.qty-num{font-family:var(--mo);font-size:12.5px;color:var(--tx);min-width:18px;text-align:center}

/* CART FOOTER */
.cart-footer{padding:14px 18px;border-top:1px solid var(--bd);flex-shrink:0}
.total-row{display:flex;justify-content:space-between;align-items:baseline;margin-bottom:12px}
.total-label{font-size:12px;color:var(--tx3)}
.total-amount{font-size:22px;font-weight:600;font-family:var(--mo);color:var(--tx);letter-spacing:-.5px}
.pay-wrap{position:relative;margin-bottom:8px}
.pay-prefix{position:absolute;left:11px;top:50%;transform:translateY(-50%);font-size:12px;color:var(--tx3);font-family:var(--mo);pointer-events:none}
.pay-input{width:100%;background:var(--bg3);border:1px solid var(--bd2);color:var(--tx);border-radius:var(--rs);padding:9px 12px 9px 32px;font-family:var(--mo);font-size:14px;outline:none;transition:border .14s}
.pay-input:focus{border-color:var(--go)}
.pay-input::placeholder{color:var(--tx3);font-size:12.5px;font-family:var(--fn)}
.change-row{display:flex;justify-content:space-between;background:var(--gnd);border:1px solid rgba(62,207,142,.18);border-radius:var(--rs);padding:7px 11px;margin-bottom:10px;opacity:0;transition:opacity .2s}
.change-row.show{opacity:1}
.change-label{font-size:11.5px;color:var(--gn)}
.change-val{font-family:var(--mo);font-size:13px;color:var(--gn);font-weight:500}

/* DEBT INPUT (muncul saat bayar kurang) */
.debt-input-section{background:var(--rdd);border:1px solid rgba(248,113,113,.2);border-radius:var(--rs);padding:10px 12px;margin-bottom:10px;display:none}
.debt-input-section.show{display:block}
.debt-input-section .dl{font-size:10.5px;color:var(--rd);text-transform:uppercase;letter-spacing:.6px;font-weight:500;margin-bottom:7px;display:flex;align-items:center;gap:5px}
.debt-input-section .dl svg{width:12px;height:12px}
.debt-note-inp{width:100%;background:var(--bg4);border:1px solid rgba(248,113,113,.2);color:var(--tx);border-radius:var(--rx);padding:7px 10px;font-family:var(--fn);font-size:12px;outline:none;transition:border .14s;resize:none;min-height:52px}
.debt-note-inp:focus{border-color:var(--rd)}
.debt-note-inp::placeholder{color:var(--tx3)}
.debt-amount-disp{font-family:var(--mo);font-size:13px;color:var(--rd);font-weight:500;margin-top:5px}

.pay-btn{width:100%;padding:12px;background:var(--go);color:#09090b;border:none;border-radius:var(--rr);cursor:pointer;font-family:var(--fn);font-size:14px;font-weight:600;display:flex;align-items:center;justify-content:center;gap:7px;transition:all .14s}
.pay-btn:hover{background:var(--go2)}
.pay-btn:active{transform:scale(.98)}
.pay-btn:disabled{background:var(--bg4);color:var(--tx3);cursor:not-allowed;transform:none}
.pay-btn svg{width:15px;height:15px}

/* MODAL edit item */
.modal-ov{position:fixed;inset:0;background:rgba(0,0,0,.65);z-index:50;display:none;align-items:center;justify-content:center;backdrop-filter:blur(4px)}
.modal-ov.on{display:flex}
.modal{background:var(--bg2);border:1px solid var(--bd2);border-radius:14px;width:340px;padding:22px;box-shadow:var(--shl)}
.modal-ttl{font-size:14.5px;font-weight:500;margin-bottom:4px}
.modal-sub{font-size:12px;color:var(--tx3);margin-bottom:18px}
.modal-close{position:absolute;top:0;right:0} /* handled via button */
.m-fg{margin-bottom:14px}
.m-fl{font-size:10.5px;color:var(--tx3);text-transform:uppercase;letter-spacing:.7px;font-weight:500;display:block;margin-bottom:6px}
.m-fi{width:100%;background:var(--bg3);border:1px solid var(--bd2);color:var(--tx);border-radius:var(--rs);padding:9px 12px;font-family:var(--mo);font-size:14px;outline:none;transition:border .14s}
.m-fi:focus{border-color:var(--go)}
.price-opts{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:14px}
.price-opt{border:1px solid var(--bd2);background:var(--bg3);border-radius:var(--rs);padding:9px 11px;cursor:pointer;transition:all .14s}
.price-opt.sel{border-color:var(--go);background:var(--gd)}
.price-opt-lbl{font-size:10px;color:var(--tx3);text-transform:uppercase;letter-spacing:.5px;margin-bottom:3px}
.price-opt.sel .price-opt-lbl{color:var(--go);opacity:.7}
.price-opt-val{font-family:var(--mo);font-size:13.5px;font-weight:500;color:var(--tx)}
.price-opt.sel .price-opt-val{color:var(--go)}
.modal-btns{display:flex;gap:8px;margin-top:16px}
.mb-cancel{flex:1;padding:9px;background:var(--bg4);border:1px solid var(--bd2);color:var(--tx2);border-radius:var(--rs);cursor:pointer;font-family:var(--fn);font-size:13px;transition:all .14s}
.mb-cancel:hover{background:var(--bg5);color:var(--tx)}
.mb-save{flex:2;padding:9px;background:var(--go);border:none;color:#09090b;border-radius:var(--rs);cursor:pointer;font-family:var(--fn);font-size:13px;font-weight:600;transition:all .14s}
.mb-save:hover{background:var(--go2)}

/* TOAST */
.toast{position:fixed;bottom:22px;right:22px;background:var(--bg3);border:1px solid var(--bd2);border-radius:var(--rr);padding:11px 15px 11px 13px;display:flex;align-items:center;gap:9px;font-size:13px;transform:translateY(70px);opacity:0;transition:all .28s cubic-bezier(.34,1.56,.64,1);z-index:200;min-width:230px;box-shadow:var(--shl)}
.toast.on{transform:translateY(0);opacity:1}
.t-dot{width:6px;height:6px;border-radius:50%;flex-shrink:0}
.toast.ok .t-dot{background:var(--gn)}
.toast.err .t-dot{background:var(--rd)}
.toast.info .t-dot{background:var(--pu)}
.spin{width:14px;height:14px;border:2px solid rgba(9,9,11,.25);border-top-color:#09090b;border-radius:50%;animation:sp .55s linear infinite;display:inline-block}
@keyframes sp{to{transform:rotate(360deg)}}
</style>
</head>
<body>
<div class="app">

<!-- SIDEBAR -->
<aside class="sb">
<div class="sb-logo"><div class="logo"><div class="logo-ico"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M3 3h7v7H3V3zm0 11h7v7H3v-7zm11-11h7v7h-7V3zm4 11h-1v3h-3v1h3v3h1v-3h3v-1h-3v-3z"/></svg></div><div><div class="logo-name">TOKO AJIB</div><div class="logo-tag">Point of Sale</div></div></div></div>
<nav class="nav">
  <div class="nav-sec">Utama</div>
  <a href="/dashboard" class="nav-a on"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="2" width="9" height="9" rx="2"/><rect x="13" y="2" width="9" height="9" rx="2"/><rect x="2" y="13" width="9" height="9" rx="2"/><rect x="13" y="13" width="9" height="9" rx="2"/></svg>Kasir</a>
  <a href="/products" class="nav-a"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/></svg>Produk</a>
  <a href="/transactions" class="nav-a"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 12h6M9 16h4"/></svg>Transaksi</a>
  <a href="/customers" class="nav-a"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="8" cy="7" r="4"/><path d="M2 21v-2a4 4 0 014-4h4a4 4 0 014 4v2"/><path d="M19 8v6M22 11h-6"/></svg>Pelanggan</a>
  <a href="/nonmember" class="nav-a"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/><line x1="18" y1="8" x2="23" y2="13"/><line x1="23" y1="8" x2="18" y2="13"/></svg>Harga Non-Member</a>
  <div class="nav-sec">Sistem</div>
  <a href="/import" class="nav-a"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg>Import CSV</a>
</nav>
<div class="sb-foot"><div class="u-row"><div class="uav">{{ substr(auth()->user()->name??'A',0,1) }}</div><div><div class="u-nm">{{ auth()->user()->name??'Admin' }}</div><div class="u-rl">Kasir</div></div></div></div>
</aside>

<!-- MAIN -->
<main class="main">
  <div class="topbar">
    <div class="topbar-ttl">Kasir</div>
    <div class="price-mode pm-member" id="price-mode">
      <span class="pm-dot"></span>
      <span id="price-mode-txt">Harga Member</span>
    </div>
    <div class="clock" id="clock">--:--</div>
  </div>

  <!-- SEARCH -->
  <div class="search-area">
    <select id="product-select" style="width:100%">
      <option value="">Cari & tambah produk...</option>
      @foreach($products as $p)
      <option value="{{ $p->id }}"
        data-pcs="{{ $p->harga_jual_pcs }}"
        data-dus="{{ $p->harga_jual_dus }}"
        data-nm-pcs="{{ isset($p->harga_nonmember_pcs) && $p->harga_nonmember_pcs ? $p->harga_nonmember_pcs : $p->harga_jual_pcs }}"
        data-nm-dus="{{ isset($p->harga_nonmember_dus) && $p->harga_nonmember_dus ? $p->harga_nonmember_dus : $p->harga_jual_dus }}">
        {{ $p->name }}
      </option>
      @endforeach
    </select>
    <div class="price-type-row">
      <button class="price-btn on" id="btn-pcs" onclick="setPriceType('pcs')">Satuan (PCS)</button>
      <button class="price-btn" id="btn-dus" onclick="setPriceType('dus')">Per Dus</button>
    </div>
    <button class="add-btn" onclick="addToCart()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
      Tambah ke Keranjang
    </button>
  </div>

  <!-- PRODUCT GRID -->
  <div class="product-area">
    <div class="sec-label">Klik produk untuk tambah ke keranjang</div>
    <div class="product-grid" id="product-grid">
      @foreach($products as $p)
      <div class="p-card"
        @php
          $nmPcs = isset($p->harga_nonmember_pcs) && $p->harga_nonmember_pcs ? $p->harga_nonmember_pcs : $p->harga_jual_pcs;
          $nmDus = isset($p->harga_nonmember_dus) && $p->harga_nonmember_dus ? $p->harga_nonmember_dus : $p->harga_jual_dus;
        @endphp
        onclick="quickAdd({{ $p->id }}, {{ $p->harga_jual_pcs }}, {{ $p->harga_jual_dus }}, {{ $nmPcs }}, {{ $nmDus }})"
        data-id="{{ $p->id }}" data-cat="{{ $p->category_id }}">
        <div class="p-card-stock {{ $p->stock <= 5 ? 'low' : '' }}">{{ $p->stock }}</div>
        <div class="p-card-cat">{{ $p->category->name ?? '—' }}</div>
        <div class="p-card-name">{{ $p->name }}</div>
        <div class="p-card-price">Rp {{ number_format($p->harga_jual_pcs,0,',','.') }}</div>
        <div class="p-card-price-nm">Rp {{ number_format($nmPcs,0,',','.') }}</div>
      </div>
      @endforeach
    </div>
  </div>
</main>

<!-- CART PANEL -->
<aside class="cart-panel">
  <div class="cart-header">
    <div class="cart-ttl">Keranjang</div>
    <div class="cart-count" id="cart-count">0 item</div>
  </div>

  <!-- PELANGGAN -->
  <div class="cust-section">
    <div class="sec-ttl">Pelanggan</div>
    <select id="customer" class="cust-select" onchange="onCustomerChange()">
      <option value="">— Tanpa Pelanggan (Non-Member) —</option>
      @foreach($customers as $c)
      <option value="{{ $c->id }}" data-debt="{{ $c->total_debt ?? 0 }}">
        {{ $c->name }}{{ ($c->total_debt ?? 0) > 0 ? ' ⚠ Ada Utang' : '' }}
      </option>
      @endforeach
    </select>
  </div>

  <!-- DEBT WARNING -->
  <div class="debt-warn" id="debt-warn">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
    <span id="debt-warn-msg">Pelanggan ini memiliki utang aktif.</span>
  </div>

  <!-- CART ITEMS -->
  <div class="cart-items" id="cart-list">
    <div class="cart-empty">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
      <p>Keranjang kosong</p>
    </div>
  </div>

  <!-- CART FOOTER -->
  <div class="cart-footer">
    <div class="total-row">
      <div class="total-label">Total Bayar</div>
      <div class="total-amount">Rp <span id="grand-total">0</span></div>
    </div>
    <div class="pay-wrap">
      <div class="pay-prefix">Rp</div>
      <input type="number" id="paid" class="pay-input" placeholder="Nominal uang bayar" oninput="calcChange()">
    </div>
    <div class="change-row" id="change-row">
      <span class="change-label">Kembalian</span>
      <span class="change-val" id="change-val">Rp 0</span>
    </div>
    <!-- DEBT INPUT — muncul saat bayar kurang -->
    <div class="debt-input-section" id="debt-input-section">
      <div class="dl">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        Pembayaran Kurang — Akan Dicatat Sebagai Utang
      </div>
      <div class="debt-amount-disp" id="debt-amount-disp">Kekurangan: Rp 0</div>
      <textarea class="debt-note-inp" id="debt-note" rows="2" placeholder="Catatan utang (opsional)..." style="margin-top:7px"></textarea>
    </div>
    <button class="pay-btn" id="pay-btn" onclick="checkout()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
      Bayar & Cetak Struk
    </button>
  </div>
</aside>
</div>

<!-- MODAL EDIT ITEM -->
<div class="modal-ov" id="modal-ov">
  <div class="modal">
    <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:4px">
      <div class="modal-ttl" id="modal-name">Nama Produk</div>
      <button onclick="closeModal()" style="background:none;border:none;color:var(--tx3);cursor:pointer;padding:2px">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
      </button>
    </div>
    <div class="modal-sub">Edit qty &amp; harga</div>
    <input type="hidden" id="modal-id">
    <div class="price-opts">
      <div class="price-opt" id="opt-pcs" onclick="selectOpt('pcs')">
        <div class="price-opt-lbl">Harga PCS</div>
        <div class="price-opt-val" id="opt-pcs-val">—</div>
      </div>
      <div class="price-opt" id="opt-dus" onclick="selectOpt('dus')">
        <div class="price-opt-lbl">Harga Dus</div>
        <div class="price-opt-val" id="opt-dus-val">—</div>
      </div>
    </div>
    <div class="m-fg">
      <label class="m-fl">Jumlah (Qty)</label>
      <input class="m-fi" type="number" id="modal-qty" min="1" oninput="onQtyChange()">
    </div>
    <div class="m-fg">
      <label class="m-fl">Harga Manual</label>
      <input class="m-fi" type="number" id="modal-price">
    </div>
    <div class="modal-btns">
      <button class="mb-cancel" onclick="closeModal()">Batal</button>
      <button class="mb-save" onclick="saveModal()">Simpan</button>
    </div>
  </div>
</div>

<!-- TOAST -->
<div class="toast" id="toast"><div class="t-dot"></div><span id="t-msg"></span></div>

<script>
@verbatim

const CSRF = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
const Rp   = n => new Intl.NumberFormat('id-ID').format(Math.round(n));
const g    = id => document.getElementById(id);

let priceType   = 'pcs';   // 'pcs' | 'dus'
let isMember    = false;   // apakah pelanggan dipilih
let grandTotal  = 0;
let currentItem = {};

// ── CLOCK ──────────────────────────────────────────────
setInterval(() => { g('clock').textContent = new Date().toLocaleTimeString('id-ID',{hour:'2-digit',minute:'2-digit',second:'2-digit'}); }, 1000);

// ── SELECT2 ────────────────────────────────────────────
$(document).ready(function() {
    $('#product-select').select2({ placeholder:'Cari produk...', width:'100%', dropdownParent:$('.search-area') });
    $('#product-select').on('select2:select', () => addToCart());
    loadCart();
});

// ── PRICE TYPE ─────────────────────────────────────────
function setPriceType(t) {
    priceType = t;
    g('btn-pcs').classList.toggle('on', t==='pcs');
    g('btn-dus').classList.toggle('on', t==='dus');
}

// ── CUSTOMER CHANGE ────────────────────────────────────
function onCustomerChange() {
    const sel  = g('customer');
    const opt  = sel.options[sel.selectedIndex];
    isMember   = !!sel.value;
    const debt = parseFloat(opt?.dataset?.debt ?? 0);

    // Update price mode indicator
    const pm = g('price-mode');
    pm.className = 'price-mode ' + (isMember ? 'pm-member' : 'pm-nonmember');
    g('price-mode-txt').textContent = isMember ? 'Harga Member' : 'Harga Non-Member';

    // Update product grid label
    const grid = g('product-grid');
    if (isMember) grid.classList.remove('nm-mode');
    else          grid.classList.add('nm-mode');

    // Debt warning
    const warn = g('debt-warn');
    if (isMember && debt > 0) {
        g('debt-warn-msg').textContent = `Pelanggan ini memiliki utang aktif: Rp ${Rp(debt)}`;
        warn.classList.add('show');
    } else {
        warn.classList.remove('show');
    }

    showToast(isMember ? '🟢 Mode Harga Member aktif' : '🟣 Mode Harga Non-Member aktif', 'info');
}

// ── ADD TO CART ────────────────────────────────────────
function getPrice(option) {
    if (isMember) {
        return priceType === 'pcs'
            ? option.dataset.pcs
            : option.dataset.dus;
    } else {
        return priceType === 'pcs'
            ? option.dataset.nmPcs
            : option.dataset.nmDus;
    }
}

function addToCart() {
    const sel = document.getElementById('product-select');
    const id  = sel.value;
    if (!id) return;
    const opt   = sel.options[sel.selectedIndex];
    const price = getPrice(opt);
    doAdd(id, price);
    $('#product-select').val(null).trigger('change');
}

function quickAdd(id, pricePcs, priceDus, nmPcs, nmDus) {
    const price = isMember
        ? (priceType==='pcs' ? pricePcs : priceDus)
        : (priceType==='pcs' ? nmPcs    : nmDus);
    doAdd(id, price);
}

function doAdd(id, price) {
    fetch('/cart/add', {
        method:'POST',
        headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'Accept':'application/json'},
        body: JSON.stringify({ product_id:id, price }),
    }).then(r=>r.json()).then(d => {
        if (d.status==='success') { loadCart(); showToast('Produk ditambahkan','ok'); }
        else showToast(d.message||'Gagal','err');
    });
}

// ── LOAD CART ──────────────────────────────────────────
function loadCart() {
    fetch('/cart-data').then(r=>r.json()).then(data => {
        grandTotal = data.grandTotal;
        const items = data.cart;
        const count = Object.keys(items).length;

        g('cart-count').textContent = count + ' item';
        g('grand-total').textContent = Rp(grandTotal);
        calcChange();

        const el = g('cart-list');
        if (count === 0) {
            el.innerHTML = `<div class="cart-empty"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg><p>Keranjang kosong</p></div>`;
            return;
        }

        let html = '';
        for (let id in items) {
            const item = items[id];
            html += `<div class="cart-item" onclick="openModal(${id})">
                <div class="ci-info">
                  <div class="ci-name">${item.name}</div>
                  <div class="ci-price">${item.qty} × Rp ${Rp(item.price)}</div>
                </div>
                <div class="qty-ctrl" onclick="event.stopPropagation()">
                  <button class="qty-btn" onclick="updateQty(${id},'minus')">−</button>
                  <span class="qty-num">${item.qty}</span>
                  <button class="qty-btn" onclick="updateQty(${id},'plus')">+</button>
                </div>
                <div class="ci-total">Rp ${Rp(item.price*item.qty)}</div>
            </div>`;
        }
        el.innerHTML = html;
    });
}

function updateQty(id, action) {
    fetch(`/cart/update/${id}/${action}`).then(r=>r.json()).then(() => loadCart());
}

// ── CHANGE CALC ────────────────────────────────────────
function calcChange() {
    const paid    = parseInt(g('paid').value) || 0;
    const change  = paid - grandTotal;
    const deficit = grandTotal - paid;

    // Kembalian
    const cr = g('change-row');
    if (paid > 0 && change >= 0) {
        g('change-val').textContent = 'Rp ' + Rp(change);
        cr.classList.add('show');
    } else {
        cr.classList.remove('show');
    }

    // Debt section — tampil kalau bayar kurang & ada pelanggan
    const ds = g('debt-input-section');
    const custId = g('customer').value;
    if (paid > 0 && paid < grandTotal && custId) {
        g('debt-amount-disp').textContent = 'Kekurangan: Rp ' + Rp(deficit);
        ds.classList.add('show');
    } else if (paid > 0 && paid < grandTotal && !custId) {
        ds.classList.remove('show');
        // Hint pilih pelanggan
    } else {
        ds.classList.remove('show');
    }
}

// ── CHECKOUT ───────────────────────────────────────────
async function checkout() {
    const paid    = parseInt(g('paid').value) || 0;
    const custId  = g('customer').value;
    const deficit = grandTotal - paid;
    const btn     = g('pay-btn');

    if (!paid)   { showToast('Masukkan nominal uang bayar','err'); return; }
    if (!custId) { showToast('Pilih pelanggan terlebih dahulu','err'); return; }
    if (paid < grandTotal && !custId) {
        showToast('Pilih pelanggan untuk mencatat kekurangan sebagai utang','err'); return;
    }

    btn.disabled = true;
    btn.innerHTML = '<div class="spin"></div>';

    try {
        const res = await fetch('/checkout-ajax', {
            method:'POST',
            headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'Accept':'application/json'},
            body: JSON.stringify({
                paid,
                customer_id: custId,
                debt_note:   deficit > 0 ? (g('debt-note').value || `Kekurangan pembayaran`) : null,
            }),
        });
        const data = await res.json();
        if (data.status==='error') { showToast(data.message,'err'); return; }

        // Buka struk
        window.open('/receipt/'+data.sale_id, '_blank');
        // Notifikasi utang
        if (data.has_debt) {
            showToast(`Transaksi berhasil. Utang Rp ${Rp(data.debt_amount)} dicatat.`, 'info');
        } else {
            showToast('Transaksi berhasil!','ok');
        }
        // Reset
        loadCart();
        g('paid').value = '';
        g('debt-note').value = '';
        g('change-row').classList.remove('show');
        g('debt-input-section').classList.remove('show');
    } catch(e) { showToast('Gagal terhubung ke server','err'); console.error(e); }
    finally {
        btn.disabled = false;
        btn.innerHTML = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" width="15" height="15"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg> Bayar & Cetak Struk`;
    }
}

// ── MODAL EDIT ─────────────────────────────────────────
function openModal(id) {
    fetch('/cart-data').then(r=>r.json()).then(data => {
        const item = data.cart[id];
        if (!item) return;
        currentItem = item;

        g('modal-id').value   = id;
        g('modal-name').textContent = item.name;
        g('modal-qty').value  = item.qty;
        g('modal-price').value = item.price;
        g('opt-pcs-val').textContent = 'Rp '+Rp(item.harga_pcs||0);
        g('opt-dus-val').textContent = 'Rp '+Rp(item.harga_dus||0);

        const isPcs = item.price == item.harga_pcs;
        g('opt-pcs').classList.toggle('sel', isPcs);
        g('opt-dus').classList.toggle('sel', !isPcs);

        g('opt-pcs').onclick = () => { g('modal-price').value = currentItem.harga_pcs||0; g('opt-pcs').classList.add('sel'); g('opt-dus').classList.remove('sel'); };
        g('opt-dus').onclick = () => { g('modal-price').value = currentItem.harga_dus||0; g('opt-dus').classList.add('sel'); g('opt-pcs').classList.remove('sel'); };

        g('modal-ov').classList.add('on');
    });
}
function closeModal() { g('modal-ov').classList.remove('on'); }
function onQtyChange() {
    const qty = parseInt(g('modal-qty').value)||1;
    if (qty >= 12) { g('modal-price').value = currentItem.harga_dus||0; g('opt-dus').classList.add('sel'); g('opt-pcs').classList.remove('sel'); }
    else           { g('modal-price').value = currentItem.harga_pcs||0; g('opt-pcs').classList.add('sel'); g('opt-dus').classList.remove('sel'); }
}
function selectOpt(type) {
    g('opt-pcs').classList.toggle('sel', type==='pcs');
    g('opt-dus').classList.toggle('sel', type==='dus');
    g('modal-price').value = type==='pcs' ? (currentItem.harga_pcs||0) : (currentItem.harga_dus||0);
}
function saveModal() {
    fetch('/cart/update-manual', {
        method:'POST',
        headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'Accept':'application/json'},
        body: JSON.stringify({ id:g('modal-id').value, qty:g('modal-qty').value, price:g('modal-price').value }),
    }).then(()=>{ closeModal(); loadCart(); showToast('Keranjang diperbarui','ok'); });
}

// ── TOAST ──────────────────────────────────────────────
function showToast(msg, type='ok') {
    const t=g('toast'); g('t-msg').textContent=msg;
    t.className=`toast ${type} on`;
    clearTimeout(t._t); t._t=setTimeout(()=>t.classList.remove('on'),2800);
}

// Close modal on ESC
document.addEventListener('keydown', e => { if(e.key==='Escape') closeModal(); });

@endverbatim
</script>
</body>
</html>
