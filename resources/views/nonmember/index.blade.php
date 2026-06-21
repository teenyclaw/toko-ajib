<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Harga Non-Pelanggan — POS AJIB</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
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
  --am:#f59e0b;--amd:rgba(245,158,11,.09);
  --bl:#60a5fa;--bld:rgba(96,165,250,.09);
  --pu:#a78bfa;--pud:rgba(167,139,250,.10);
  --rr:12px;--rs:8px;--rx:6px;
  --fn:'DM Sans',sans-serif;--mo:'DM Mono',monospace;
  --shl:0 8px 40px rgba(0,0,0,.6)
}
html,body{height:100%;overflow:hidden}
body{font-family:var(--fn);background:var(--bg);color:var(--tx);font-size:14px;line-height:1.5;-webkit-font-smoothing:antialiased}
.app{display:grid;grid-template-columns:216px 1fr;height:100vh}
.main{display:flex;flex-direction:column;overflow:hidden}

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

/* TOPBAR */
.topbar{height:52px;padding:0 22px;border-bottom:1px solid var(--bd);background:var(--bg2);display:flex;align-items:center;gap:10px;flex-shrink:0}
.tb-ttl{font-size:14.5px;font-weight:500;flex:1}

/* LAYOUT — 2 col */
.content{flex:1;overflow:hidden;display:grid;grid-template-columns:320px 1fr;gap:0}

/* LEFT PANEL — control */
.ctrl-panel{background:var(--bg2);border-right:1px solid var(--bd);display:flex;flex-direction:column;overflow-y:auto}
.ctrl-panel::-webkit-scrollbar{width:3px}
.ctrl-panel::-webkit-scrollbar-thumb{background:var(--bg5);border-radius:2px}
.ctrl-body{padding:20px 20px;flex:1}

/* RIGHT — table */
.tbl-area{display:flex;flex-direction:column;overflow:hidden}
.tbl-top{padding:10px 20px;border-bottom:1px solid var(--bd);display:flex;align-items:center;gap:8px;flex-shrink:0;background:var(--bg)}
.fi-s{flex:1;max-width:240px;background:var(--bg3);border:1px solid var(--bd2);color:var(--tx);border-radius:var(--rs);padding:7px 11px;font-family:var(--fn);font-size:13px;outline:none;transition:border .14s}
.fi-s:focus{border-color:var(--go)}
.fi-s::placeholder{color:var(--tx3)}
.fi-c{min-width:150px;background:var(--bg3);border:1px solid var(--bd2);color:var(--tx);border-radius:var(--rs);padding:7px 11px;font-family:var(--fn);font-size:13px;outline:none;appearance:none;cursor:pointer}
.fi-c:focus{border-color:var(--go)}

.tw{flex:1;overflow-y:auto;min-height:0}
.tw::-webkit-scrollbar{width:4px}
.tw::-webkit-scrollbar-thumb{background:var(--bg5);border-radius:2px}
table{width:100%;border-collapse:collapse}
thead{position:sticky;top:0;z-index:9;background:var(--bg2)}
thead th{font-size:10px;color:var(--tx3);text-transform:uppercase;letter-spacing:.8px;font-weight:500;padding:9px 14px;text-align:left;border-bottom:1px solid var(--bd);white-space:nowrap}
tbody tr{border-bottom:1px solid var(--bd);transition:background .1s}
tbody tr:hover{background:rgba(255,255,255,.018)}
tbody tr.changed{background:rgba(201,164,78,.04)}
tbody td{padding:10px 14px;vertical-align:middle;font-size:12.5px;color:var(--tx2)}
.c-nm{font-size:13px;font-weight:500;color:var(--tx)}
.c-cat{display:inline-block;font-size:10px;background:var(--bg4);color:var(--tx3);padding:2px 7px;border-radius:4px;border:1px solid var(--bd2)}
.c-price{font-family:var(--mo);font-size:12.5px;color:var(--tx);font-weight:500}
.c-nm-price{font-family:var(--mo);font-size:13px;font-weight:600;transition:color .3s}
.c-nm-price.member{color:var(--go)}
.c-nm-price.nonmember{color:var(--pu)}
.c-nm-price.higher{color:var(--rd)}
.price-diff{font-size:10px;font-family:var(--mo);margin-top:2px;display:flex;align-items:center;gap:3px}
.diff-up{color:var(--rd)}.diff-zero{color:var(--tx3)}
.arrow-up{font-size:8px}

/* SECTION CARD */
.sc{background:var(--bg3);border:1px solid var(--bd);border-radius:var(--rr);padding:16px;margin-bottom:14px}
.sc:last-child{margin-bottom:0}
.sc-head{display:flex;align-items:center;gap:8px;margin-bottom:14px}
.sc-ico{width:26px;height:26px;border-radius:6px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.sc-ico svg{width:13px;height:13px}
.sco-pu{background:var(--pud);color:var(--pu)}
.sco-go{background:var(--gd);color:var(--go)}
.sco-am{background:var(--amd);color:var(--am)}
.sc-ttl{font-size:12.5px;font-weight:500;color:var(--tx2)}

/* FORM */
.fg{margin-bottom:14px}
.fg:last-child{margin-bottom:0}
.fl{font-size:10.5px;color:var(--tx3);text-transform:uppercase;letter-spacing:.7px;font-weight:500;display:block;margin-bottom:6px}
.fi2{width:100%;background:var(--bg4);border:1px solid var(--bd2);color:var(--tx);border-radius:var(--rs);padding:9px 12px;font-family:var(--mo);font-size:13px;outline:none;transition:border .14s}
.fi2:focus{border-color:var(--go);box-shadow:0 0 0 2px var(--gd)}
.fi2::placeholder{color:var(--tx3)}
.r2{display:grid;grid-template-columns:1fr auto;gap:8px;align-items:flex-start}

/* TYPE TOGGLE */
.tt{display:flex;border:1px solid var(--bd2);border-radius:var(--rs);overflow:hidden;height:38px}
.tto{flex:1;padding:0 10px;font-size:12px;cursor:pointer;transition:all .14s;color:var(--tx3);background:var(--bg4);border:none;font-family:var(--fn);display:flex;align-items:center;justify-content:center;white-space:nowrap}
.tto:hover{color:var(--tx2);background:var(--bg5)}
.tto.on{background:var(--pud);color:var(--pu);font-weight:500}
.tto+.tto{border-left:1px solid var(--bd2)}

/* PREVIEW BOX */
.pvb{background:var(--bg4);border:1px solid var(--bd2);border-radius:var(--rs);padding:12px 14px;margin-top:10px}
.pvb-ttl{font-size:9.5px;color:var(--tx3);text-transform:uppercase;letter-spacing:.7px;font-weight:500;margin-bottom:8px}
.pvr{display:flex;justify-content:space-between;align-items:center;margin-bottom:5px}
.pvr:last-child{margin-bottom:0}
.pv-lbl{font-size:11px;color:var(--tx3)}
.pv-val{font-family:var(--mo);font-size:13px;font-weight:500;color:var(--pu);transition:color .2s}
.pv-val.updated{color:var(--gn)}
.pv-diff{font-family:var(--mo);font-size:10.5px;color:var(--rd)}

/* APPLY BUTTONS */
.apply-btn{width:100%;padding:11px;border-radius:var(--rs);font-family:var(--fn);font-size:13px;font-weight:600;cursor:pointer;transition:all .14s;display:flex;align-items:center;justify-content:center;gap:7px;border:none;margin-bottom:8px}
.apply-btn:last-child{margin-bottom:0}
.apply-btn svg{width:14px;height:14px}
.ab-all{background:var(--pu);color:#09090b}
.ab-all:hover{background:#b8a0fc}
.ab-cat{background:var(--bg4);color:var(--tx2);border:1px solid var(--bd2)!important}
.ab-cat:hover{background:var(--bg5);color:var(--tx)}
.ab-all:disabled,.ab-cat:disabled{background:var(--bg4);color:var(--tx3);cursor:not-allowed;transform:none}

/* NONMEMBER BANNER */
.nm-banner{background:linear-gradient(135deg,var(--pud),rgba(167,139,250,.05));border:1px solid rgba(167,139,250,.2);border-radius:var(--rs);padding:12px 14px;margin-bottom:16px}
.nm-banner-ttl{font-size:12px;font-weight:500;color:var(--pu);margin-bottom:4px;display:flex;align-items:center;gap:6px}
.nm-banner-ttl svg{width:14px;height:14px}
.nm-banner-sub{font-size:11.5px;color:var(--tx3);line-height:1.5}

/* STATS */
.ctrl-stats{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:16px}
.cst{background:var(--bg4);border:1px solid var(--bd);border-radius:var(--rs);padding:10px 12px;text-align:center}
.cst-v{font-family:var(--mo);font-size:18px;font-weight:600;letter-spacing:-.5px}
.cst-v.pu{color:var(--pu)}.cst-v.go{color:var(--go)}
.cst-l{font-size:10px;color:var(--tx3);margin-top:2px;text-transform:uppercase;letter-spacing:.7px}

/* DIFF INDICATOR */
.diff-badge{display:inline-flex;align-items:center;gap:3px;font-size:10.5px;font-family:var(--mo);padding:2px 6px;border-radius:4px}
.db-up{background:var(--rdd);color:var(--rd);border:1px solid rgba(248,113,113,.15)}
.db-zero{background:var(--bg4);color:var(--tx3);border:1px solid var(--bd)}

/* LOADING overlay */
.loading-overlay{position:absolute;inset:0;background:rgba(9,9,11,.7);display:none;align-items:center;justify-content:center;z-index:20;backdrop-filter:blur(2px)}
.loading-overlay.on{display:flex}
.loading-box{background:var(--bg2);border:1px solid var(--bd2);border-radius:var(--rr);padding:24px 32px;text-align:center}
.loading-box p{font-size:13px;color:var(--tx2);margin-top:10px}

/* TOAST */
.toast{position:fixed;bottom:22px;right:22px;background:var(--bg3);border:1px solid var(--bd2);border-radius:var(--rr);padding:11px 15px 11px 13px;display:flex;align-items:center;gap:9px;font-size:13px;transform:translateY(70px);opacity:0;transition:all .28s cubic-bezier(.34,1.56,.64,1);z-index:200;min-width:230px;box-shadow:var(--shl)}
.toast.on{transform:translateY(0);opacity:1}
.t-dot{width:6px;height:6px;border-radius:50%;flex-shrink:0}
.toast.ok .t-dot{background:var(--gn)}
.toast.err .t-dot{background:var(--rd)}
.toast.info .t-dot{background:var(--am)}

/* misc */
.spin{width:13px;height:13px;border:2px solid rgba(9,9,11,.25);border-top-color:#09090b;border-radius:50%;animation:sp .55s linear infinite;display:inline-block;flex-shrink:0}
.spin-lg{width:32px;height:32px;border:3px solid rgba(167,139,250,.2);border-top-color:var(--pu);border-radius:50%;animation:sp .7s linear infinite;display:inline-block}
@keyframes sp{to{transform:rotate(360deg)}}
@keyframes hl{0%,100%{background:transparent}40%{background:rgba(167,139,250,.06)}}
.hl{animation:hl .7s ease}
.sep{border:none;border-top:1px solid var(--bd);margin:14px 0}
</style>
</head>
<body>
<div class="app">

@include('partials.sidebar', ['active' => 'nonmember'])

<!-- MAIN -->
<main class="main">

<!-- TOPBAR -->
<div class="topbar">
  <div class="tb-ttl">Harga Khusus Non-Pelanggan</div>
  <span style="font-size:11.5px;color:var(--tx3);background:var(--pud);color:var(--pu);padding:4px 10px;border-radius:20px;border:1px solid rgba(167,139,250,.2)">
    {{ $products->count() }} produk terdaftar
  </span>
</div>

<!-- CONTENT -->
<div class="content" style="position:relative">

  <!-- LOADING OVERLAY -->
  <div class="loading-overlay" id="loading-overlay">
    <div class="loading-box">
      <div class="spin-lg" style="margin:0 auto"></div>
      <p id="loading-msg">Memperbarui harga...</p>
    </div>
  </div>

  <!-- LEFT: CONTROL PANEL -->
  <div class="ctrl-panel">
    <div class="ctrl-body">

      <!-- BANNER INFO -->
      <div class="nm-banner">
        <div class="nm-banner-ttl">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/><line x1="18" y1="8" x2="23" y2="13"/><line x1="23" y1="8" x2="18" y2="13"/></svg>
          Harga Non-Pelanggan
        </div>
        <div class="nm-banner-sub">
          Harga ini diterapkan saat pembeli <strong style="color:var(--tx2)">tidak terdaftar</strong> sebagai pelanggan. Ubah margin di bawah → semua produk langsung terupdate.
        </div>
      </div>

      <!-- STATS -->
      @php
        $withNm = $products->where('harga_nonmember_pcs','>',0)->count();
      @endphp
      <div class="ctrl-stats">
        <div class="cst">
          <div class="cst-v go">{{ $products->count() }}</div>
          <div class="cst-l">Total Produk</div>
        </div>
        <div class="cst">
          <div class="cst-v pu">{{ $withNm }}</div>
          <div class="cst-l">Sudah Diset</div>
        </div>
      </div>

      <!-- MARGIN DUS -->
      <div class="sc">
        <div class="sc-head">
          <div class="sc-ico sco-pu"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/></svg></div>
          <span class="sc-ttl">Tambahan Margin Dus</span>
        </div>
        <div class="fg">
          <label class="fl">Nilai Tambahan di Atas Harga Member</label>
          <div class="r2">
            <input class="fi2" type="number" id="nm-md" value="{{ $currentMargins['margin_nonmember_dus'] }}" min="0" step="0.1" oninput="pvLive()">
            <div class="tt">
              <button type="button" class="tto {{ $currentMargins['margin_nonmember_dus_type']=='percent'?'on':'' }}" id="nm-md-p" onclick="setTy('d','percent')">%</button>
              <button type="button" class="tto {{ $currentMargins['margin_nonmember_dus_type']=='nominal'?'on':'' }}" id="nm-md-n" onclick="setTy('d','nominal')">Rp</button>
            </div>
          </div>
        </div>
      </div>

      <!-- MARGIN PCS -->
      <div class="sc">
        <div class="sc-head">
          <div class="sc-ico sco-pu"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/></svg></div>
          <span class="sc-ttl">Tambahan Margin PCS</span>
        </div>
        <div class="fg">
          <label class="fl">Nilai Tambahan di Atas Harga Member</label>
          <div class="r2">
            <input class="fi2" type="number" id="nm-mp" value="{{ $currentMargins['margin_nonmember_pcs'] }}" min="0" step="0.1" oninput="pvLive()">
            <div class="tt">
              <button type="button" class="tto {{ $currentMargins['margin_nonmember_pcs_type']=='percent'?'on':'' }}" id="nm-mp-p" onclick="setTy('p','percent')">%</button>
              <button type="button" class="tto {{ $currentMargins['margin_nonmember_pcs_type']=='nominal'?'on':'' }}" id="nm-mp-n" onclick="setTy('p','nominal')">Rp</button>
            </div>
          </div>
        </div>
      </div>

      <!-- PREVIEW CONTOH -->
      <div class="sc">
        <div class="sc-head">
          <div class="sc-ico sco-am"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></div>
          <span class="sc-ttl">Preview Perubahan (Produk Pertama)</span>
        </div>
        @php $first = $products->first(); @endphp
        @if($first)
        <div style="font-size:11px;color:var(--tx3);margin-bottom:8px">{{ $first->name }}</div>
        <div class="pvb">
          <div class="pvb-ttl">Harga Member → Non-Member</div>
          <div class="pvr">
            <span class="pv-lbl">Harga Dus Member</span>
            <span style="font-family:var(--mo);font-size:12px;color:var(--go)">Rp {{ number_format($first->harga_jual_dus,0,',','.') }}</span>
          </div>
          <div class="pvr">
            <span class="pv-lbl">Harga Dus Non-Member</span>
            <span class="pv-val" id="pv-dus">Rp {{ number_format($first->harga_nonmember_dus,0,',','.') }}</span>
          </div>
          <div style="border-top:1px solid var(--bd);margin:8px 0"></div>
          <div class="pvr">
            <span class="pv-lbl">Harga PCS Member</span>
            <span style="font-family:var(--mo);font-size:12px;color:var(--go)">Rp {{ number_format($first->harga_jual_pcs,0,',','.') }}</span>
          </div>
          <div class="pvr">
            <span class="pv-lbl">Harga PCS Non-Member</span>
            <span class="pv-val" id="pv-pcs">Rp {{ number_format($first->harga_nonmember_pcs,0,',','.') }}</span>
          </div>
        </div>
        @endif
      </div>

      <!-- FILTER KATEGORI untuk apply per kategori -->
      <div class="sc">
        <div class="sc-head">
          <div class="sc-ico sco-go"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg></div>
          <span class="sc-ttl">Terapkan</span>
        </div>

        <div class="fg">
          <label class="fl">Pilih Kategori (untuk apply per kategori)</label>
          <select class="fi2" id="cat-select" style="font-family:var(--fn)" onchange="pvLive()">
            <option value="">— Semua Kategori —</option>
            @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
          </select>
        </div>

        <!-- WARNING -->
        <div style="background:var(--amd);border:1px solid rgba(245,158,11,.2);border-radius:var(--rs);padding:10px 12px;font-size:11.5px;color:var(--am);display:flex;gap:8px;align-items:flex-start;margin-bottom:12px">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:1px"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
          Perubahan akan langsung disimpan ke semua produk yang dipilih.
        </div>

        <button class="apply-btn ab-all" id="btn-all" onclick="applyAll()">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>
          Terapkan ke Semua Produk
        </button>
        <button class="apply-btn ab-cat" id="btn-cat" onclick="applyByCategory()">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>
          Terapkan ke Kategori Dipilih
        </button>
      </div>

    </div>
  </div>

  <!-- RIGHT: TABLE -->
  <div class="tbl-area">
    <div class="tbl-top">
      <input class="fi-s" type="text" id="search-inp" placeholder="🔍  Cari produk..." oninput="filterTable()">
      <select class="fi-c" id="cat-filter" onchange="filterTable()">
        <option value="">Semua Kategori</option>
        @foreach($categories as $cat)
        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
      </select>
      <div style="flex:1"></div>
      <span style="font-size:11.5px;color:var(--tx3)" id="count-label">{{ $products->count() }} produk</span>
    </div>
    <div class="tw">
      <table>
        <thead>
          <tr>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Harga Dus Member</th>
            <th>Harga Dus Non-Member</th>
            <th>Harga PCS Member</th>
            <th>Harga PCS Non-Member</th>
          </tr>
        </thead>
        <tbody id="tbody">
          @foreach($products as $p)
          <tr id="prow-{{ $p->id }}"
              data-name="{{ strtolower($p->name) }}"
              data-cat="{{ $p->category_id }}"
              data-hbd="{{ $p->harga_beli_dus }}"
              data-qty="{{ $p->qty_per_dus }}"
              data-mdus="{{ $p->margin_dus }}"
              data-mdust="{{ $p->margin_dus_type }}"
              data-hjd="{{ $p->harga_jual_dus }}"
              data-hjp="{{ $p->harga_jual_pcs }}">
            <td><div class="c-nm">{{ $p->name }}</div></td>
            <td><span class="c-cat">{{ $p->category->name ?? '—' }}</span></td>
            <td><div class="c-price">Rp {{ number_format($p->harga_jual_dus,0,',','.') }}</div></td>
            <td>
              <div class="c-nm-price nonmember" id="nmd-{{ $p->id }}">
                Rp {{ number_format($p->harga_nonmember_dus ?: $p->harga_jual_dus, 0, ',', '.') }}
              </div>
              @php $diffDus = $p->harga_nonmember_dus - $p->harga_jual_dus; @endphp
              <div class="price-diff" id="diffd-{{ $p->id }}">
                @if($diffDus > 0)
                  <span class="diff-badge db-up">+{{ number_format($diffDus,0,',','.') }}</span>
                @else
                  <span class="diff-badge db-zero">Sama</span>
                @endif
              </div>
            </td>
            <td><div class="c-price">Rp {{ number_format($p->harga_jual_pcs,0,',','.') }}</div></td>
            <td>
              <div class="c-nm-price nonmember" id="nmp-{{ $p->id }}">
                Rp {{ number_format($p->harga_nonmember_pcs ?: $p->harga_jual_pcs, 0, ',', '.') }}
              </div>
              @php $diffPcs = $p->harga_nonmember_pcs - $p->harga_jual_pcs; @endphp
              <div class="price-diff" id="diffp-{{ $p->id }}">
                @if($diffPcs > 0)
                  <span class="diff-badge db-up">+{{ number_format($diffPcs,0,',','.') }}</span>
                @else
                  <span class="diff-badge db-zero">Sama</span>
                @endif
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

</div><!-- .content -->
</main>
</div><!-- .app -->

<!-- TOAST -->
<div class="toast" id="toast"><div class="t-dot"></div><span id="t-msg"></span></div>

<script>
const CSRF = '{{ csrf_token() }}';
const Rp   = n => 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.round(n));
const Num  = n => new Intl.NumberFormat('id-ID').format(Math.round(n));
const g    = id => document.getElementById(id);

// State
const T = { d: '{{ $currentMargins["margin_nonmember_dus_type"] }}', p: '{{ $currentMargins["margin_nonmember_pcs_type"] }}' };

// Data produk dari server (untuk kalkulasi live)
const allProducts = @json($productData);

@php $first = $products->first(); @endphp
const firstProduct = {
    hbd: {{ $first?->harga_beli_dus ?? 0 }},
    qty: {{ $first?->qty_per_dus ?? 1 }},
    mdus: {{ $first?->margin_dus ?? 0 }},
    mdusTy: '{{ $first?->margin_dus_type ?? "percent" }}',
    hjd: {{ $first?->harga_jual_dus ?? 0 }},
    hjp: {{ $first?->harga_jual_pcs ?? 0 }},
};

// ── TYPE TOGGLE ──────────────────────────────────────────
function setTy(wh, ty) {
    T[wh] = ty;
    g(`nm-m${wh}-p`).classList.toggle('on', ty === 'percent');
    g(`nm-m${wh}-n`).classList.toggle('on', ty === 'nominal');
    pvLive();
}

// ── KALKULASI ────────────────────────────────────────────
function calcNmPrice(hjd, hjp, nmMdus, nmMdusTy, nmMpcs, nmMpcsTy) {
    nmMdus = parseFloat(nmMdus) || 0;
    nmMpcs = parseFloat(nmMpcs) || 0;
    const hNmDus = nmMdusTy === 'percent' ? hjd * (1 + nmMdus/100) : hjd + nmMdus;
    const hNmPcs = nmMpcsTy === 'percent' ? hjp * (1 + nmMpcs/100) : hjp + nmMpcs;
    return { hNmDus: Math.ceil(hNmDus), hNmPcs: Math.ceil(hNmPcs) };
}

// ── PREVIEW LIVE (tabel + preview box) ───────────────────
let pvTimer;
function pvLive() {
    clearTimeout(pvTimer);
    pvTimer = setTimeout(_doPreview, 80);
}

function _doPreview() {
    const md   = g('nm-md').value;
    const mp   = g('nm-mp').value;
    const catFilter = g('cat-filter').value;
    const catSel    = g('cat-select').value;

    // Update preview box (produk pertama)
    const { hNmDus: fpDus, hNmPcs: fpPcs } = calcNmPrice(
        firstProduct.hjd, firstProduct.hjp, md, T.d, mp, T.p
    );
    const pvDus = g('pv-dus'); const pvPcs = g('pv-pcs');
    if (pvDus) { pvDus.textContent = Rp(fpDus); pvDus.classList.add('updated'); setTimeout(()=>pvDus.classList.remove('updated'),800); }
    if (pvPcs) { pvPcs.textContent = Rp(fpPcs); pvPcs.classList.add('updated'); setTimeout(()=>pvPcs.classList.remove('updated'),800); }

    // Update semua baris tabel secara realtime
    allProducts.forEach(p => {
        const row = g('prow-'+p.id);
        if (!row) return;

        // Jika ada filter kategori di tabel, hanya update yang sesuai
        const { hNmDus, hNmPcs } = calcNmPrice(p.hjd, p.hjp, md, T.d, mp, T.p);

        // Harga dus nonmember
        const ndEl = g('nmd-'+p.id);
        if (ndEl) {
            ndEl.textContent = Rp(hNmDus);
            ndEl.style.color = hNmDus > p.hjd ? 'var(--pu)' : 'var(--tx3)';
        }
        // Harga pcs nonmember
        const npEl = g('nmp-'+p.id);
        if (npEl) {
            npEl.textContent = Rp(hNmPcs);
            npEl.style.color = hNmPcs > p.hjp ? 'var(--pu)' : 'var(--tx3)';
        }
        // Diff badge dus
        const ddEl = g('diffd-'+p.id);
        if (ddEl) {
            const diff = hNmDus - p.hjd;
            ddEl.innerHTML = diff > 0
                ? `<span class="diff-badge db-up">+${Num(diff)}</span>`
                : `<span class="diff-badge db-zero">Sama</span>`;
        }
        // Diff badge pcs
        const dpEl = g('diffp-'+p.id);
        if (dpEl) {
            const diff = hNmPcs - p.hjp;
            dpEl.innerHTML = diff > 0
                ? `<span class="diff-badge db-up">+${Num(diff)}</span>`
                : `<span class="diff-badge db-zero">Sama</span>`;
        }
    });
}

// ── APPLY ALL ────────────────────────────────────────────
async function applyAll() {
    if (!confirm(`Update harga non-member untuk SEMUA ${allProducts.length} produk?`)) return;
    showLoading(`Memperbarui ${allProducts.length} produk...`);
    try {
        const r = await callApi('POST', '/nonmember/update-all', getPayload());
        if (r.status === 'success') {
            highlightAll();
            showToast(r.message, 'ok');
        } else showToast(r.message || 'Gagal', 'err');
    } catch(e) { showToast('Gagal terhubung ke server', 'err'); }
    finally { hideLoading(); }
}

// ── APPLY BY CATEGORY ────────────────────────────────────
async function applyByCategory() {
    const catId = g('cat-select').value;
    if (!catId) { showToast('Pilih kategori terlebih dahulu', 'info'); return; }
    const catName = g('cat-select').options[g('cat-select').selectedIndex].text;
    if (!confirm(`Update harga non-member untuk semua produk di kategori "${catName}"?`)) return;
    showLoading(`Memperbarui produk kategori ${catName}...`);
    try {
        const r = await callApi('POST', '/nonmember/update-by-category', { ...getPayload(), category_id: catId });
        if (r.status === 'success') {
            highlightAll(catId);
            showToast(r.message, 'ok');
        } else showToast(r.message || 'Gagal', 'err');
    } catch(e) { showToast('Gagal terhubung ke server', 'err'); }
    finally { hideLoading(); }
}

function getPayload() {
    return {
        margin_nonmember_dus:      parseFloat(g('nm-md').value) || 0,
        margin_nonmember_dus_type: T.d,
        margin_nonmember_pcs:      parseFloat(g('nm-mp').value) || 0,
        margin_nonmember_pcs_type: T.p,
    };
}

function highlightAll(catId = null) {
    allProducts.forEach(p => {
        if (catId && String(p.cat_id) !== String(catId)) return;
        const row = g('prow-'+p.id);
        if (row) { row.classList.remove('hl'); void row.offsetWidth; row.classList.add('hl'); }
    });
}

// ── FILTER TABLE ─────────────────────────────────────────
function filterTable() {
    const q   = g('search-inp').value.toLowerCase();
    const cat = g('cat-filter').value;
    const rows = document.querySelectorAll('#tbody tr');
    let visible = 0;
    rows.forEach(row => {
        const nm = row.dataset.name || '';
        const rc = row.dataset.cat  || '';
        const show = (!q || nm.includes(q)) && (!cat || rc === cat);
        row.style.display = show ? '' : 'none';
        if (show) visible++;
    });
    g('count-label').textContent = visible + ' produk';
}

// ── UTILS ─────────────────────────────────────────────────
function showLoading(msg='Memproses...') {
    g('loading-msg').textContent = msg;
    g('loading-overlay').classList.add('on');
}
function hideLoading() { g('loading-overlay').classList.remove('on'); }

async function callApi(method, url, body) {
    const r = await fetch(url, {
        method,
        headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN':CSRF, 'Accept':'application/json' },
        body: JSON.stringify(body),
    });
    return r.json();
}

function showToast(msg, type='ok') {
    const t = g('toast'); g('t-msg').textContent = msg;
    t.className = `toast ${type} on`;
    clearTimeout(t._t);
    t._t = setTimeout(() => t.classList.remove('on'), 2800);
}

// Init preview on load
pvLive();
</script>
</body>
</html>
