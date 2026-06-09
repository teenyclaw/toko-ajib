<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Produk — POS AJIB</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --bg:#09090b;--bg2:#111114;--bg3:#18181c;--bg4:#202025;--bg5:#2a2a30;
  --bd:rgba(255,255,255,.055);--bd2:rgba(255,255,255,.09);--bd3:rgba(255,255,255,.14);
  --tx:#ede9e2;--tx2:#938f88;--tx3:#4e4c49;
  --go:#c9a44e;--go2:#e4bf6a;--go3:#f2d080;
  --gd:rgba(201,164,78,.09);--gd2:rgba(201,164,78,.16);--gd3:rgba(201,164,78,.26);
  --gn:#3ecf8e;--gnd:rgba(62,207,142,.09);
  --rd:#f87171;--rdd:rgba(248,113,113,.09);
  --am:#f59e0b;--amd:rgba(245,158,11,.09);
  --bl:#60a5fa;--bld:rgba(96,165,250,.09);
  --rr:12px;--rs:8px;--rx:6px;
  --f:'DM Sans',sans-serif;--m:'DM Mono',monospace;
  --sh:0 2px 16px rgba(0,0,0,.45);--shl:0 8px 40px rgba(0,0,0,.6)
}
html,body{height:100%;overflow:hidden}
body{font-family:var(--f);background:var(--bg);color:var(--tx);font-size:14px;line-height:1.5;-webkit-font-smoothing:antialiased}
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

/* ── TOPBAR ── */
.topbar{height:52px;padding:0 22px;border-bottom:1px solid var(--bd);background:var(--bg2);display:flex;align-items:center;gap:10px;flex-shrink:0}
.tb-ttl{font-size:14.5px;font-weight:500;flex:1}
.btn{display:inline-flex;align-items:center;gap:6px;padding:7px 13px;border-radius:var(--rs);font-family:var(--f);font-size:12.5px;font-weight:500;cursor:pointer;transition:all .14s;white-space:nowrap;border:none}
.btn svg{width:13px;height:13px}
.btn-ghost{background:var(--bg4);color:var(--tx2);border:1px solid var(--bd2)!important}
.btn-ghost:hover{background:var(--bg5);color:var(--tx)}
.btn-gold{background:var(--go);color:#09090b;font-weight:600}
.btn-gold:hover{background:var(--go2)}
.btn-gold:active{transform:scale(.98)}

/* ── STATS ── */
.stats{display:grid;grid-template-columns:repeat(4,1fr);gap:10px;padding:14px 22px;border-bottom:1px solid var(--bd);flex-shrink:0}
.stat{background:var(--bg2);border:1px solid var(--bd);border-radius:var(--rr);padding:12px 14px}
.stat-l{font-size:10px;color:var(--tx3);text-transform:uppercase;letter-spacing:.8px;font-weight:500;margin-bottom:5px}
.stat-v{font-size:20px;font-weight:600;font-family:var(--m);letter-spacing:-.5px}
.stat-v.go{color:var(--go)}.stat-v.gn{color:var(--gn)}.stat-v.am{color:var(--am)}.stat-v.rd{color:var(--rd)}
.stat-s{font-size:10.5px;color:var(--tx3);margin-top:2px}

/* ── FILTER BAR ── */
.fbar{padding:10px 22px;border-bottom:1px solid var(--bd);display:flex;align-items:center;gap:8px;flex-shrink:0;background:var(--bg)}
.fi{background:var(--bg3);border:1px solid var(--bd2);color:var(--tx);border-radius:var(--rs);padding:7px 11px;font-family:var(--f);font-size:13px;outline:none;transition:border .14s}
.fi:focus{border-color:var(--go)}
.fi::placeholder{color:var(--tx3)}
.fi-search{flex:1;max-width:260px}
.fi-cat{min-width:150px;appearance:none;cursor:pointer}
.fi-btn{background:var(--bg3);border:1px solid var(--bd2)!important;color:var(--tx2);border-radius:var(--rs);padding:7px 13px;font-size:13px;font-family:var(--f);cursor:pointer;transition:all .14s}
.fi-btn:hover{background:var(--bg4);color:var(--tx)}

/* ── TABLE ── */
.tw{flex:1;overflow-y:auto;min-height:0}
.tw::-webkit-scrollbar{width:4px}
.tw::-webkit-scrollbar-thumb{background:var(--bg5);border-radius:2px}
table{width:100%;border-collapse:collapse}
thead{position:sticky;top:0;z-index:9;background:var(--bg2)}
thead th{font-size:10px;color:var(--tx3);text-transform:uppercase;letter-spacing:.8px;font-weight:500;padding:9px 13px;text-align:left;border-bottom:1px solid var(--bd);white-space:nowrap}
thead th:last-child{text-align:right}
tbody tr{border-bottom:1px solid var(--bd);transition:background .1s}
tbody tr:hover{background:rgba(255,255,255,.018)}
tbody tr.editing{background:rgba(201,164,78,.035);outline:1px solid var(--gd2);outline-offset:-1px}
tbody td{padding:10px 13px;vertical-align:middle;font-size:12.5px;color:var(--tx2)}
.c-nm{font-size:13px;font-weight:500;color:var(--tx);line-height:1.3}
.c-sub{font-size:10.5px;color:var(--tx3);margin-top:1px}
.c-cat{display:inline-block;font-size:10px;background:var(--bg4);color:var(--tx3);padding:2px 7px;border-radius:4px;border:1px solid var(--bd2)}
.c-price{font-family:var(--m);font-size:12.5px;color:var(--tx);font-weight:500;transition:color .3s}
.c-price.flash{color:var(--gn)}
.c-mono{font-family:var(--m);font-size:12px}
.sn{font-family:var(--m);font-size:13px;font-weight:500}
.s-ok{color:var(--gn)}.s-lw{color:var(--am)}.s-no{color:var(--rd)}

/* margin pill */
.mp{display:inline-flex;align-items:center;font-size:10.5px;font-family:var(--m);padding:2px 6px;border-radius:4px}
.mp.pct{background:var(--bld);color:var(--bl);border:1px solid rgba(96,165,250,.15)}
.mp.nom{background:var(--amd);color:var(--am);border:1px solid rgba(245,158,11,.15)}
.mp.def{background:var(--bg4);color:var(--tx3);border:1px solid var(--bd)}

/* inline edit */
.ie{background:var(--bg4);border:1px solid var(--bd3);color:var(--tx);border-radius:var(--rx);padding:5px 8px;font-family:var(--m);font-size:12px;outline:none;width:100%;min-width:75px;transition:border .14s}
.ie:focus{border-color:var(--go);box-shadow:0 0 0 2px var(--gd2)}
.ie-sm{min-width:55px}
.ie-row{display:flex;gap:5px;margin-top:4px}
.ib{padding:4px 9px;border-radius:var(--rx);font-family:var(--f);font-size:11.5px;font-weight:600;cursor:pointer;transition:all .12s;border:none}
.ib-s{background:var(--go);color:#09090b}
.ib-s:hover{background:var(--go2)}
.ib-c{background:var(--bg5);color:var(--tx2);border:1px solid var(--bd2)!important;font-weight:400}

/* row actions */
.ra{display:flex;gap:4px;justify-content:flex-end;opacity:0;transition:opacity .14s}
tbody tr:hover .ra,.ra.vis{opacity:1}
.rb{width:26px;height:26px;border:1px solid var(--bd2);background:var(--bg4);color:var(--tx2);border-radius:var(--rx);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .14s}
.rb svg{width:12px;height:12px}
.rb:hover{background:var(--bg5);color:var(--tx);border-color:var(--bd3)}
.rb.rg:hover{border-color:rgba(201,164,78,.4);color:var(--go);background:var(--gd)}
.rb.rd:hover{border-color:rgba(248,113,113,.3);color:var(--rd);background:var(--rdd)}
.rb.rb:hover{border-color:rgba(96,165,250,.3);color:var(--bl);background:var(--bld)}
.rb.rk:hover{border-color:rgba(62,207,142,.3);color:var(--gn);background:var(--gnd)}

/* pagination */
.pgbar{padding:9px 22px;border-top:1px solid var(--bd);display:flex;align-items:center;flex-shrink:0;background:var(--bg2)}
.pg-info{font-size:11.5px;color:var(--tx3);flex:1}
.pg-links{display:flex;gap:4px}
.pg-links a,.pg-links span{display:inline-flex;align-items:center;justify-content:center;min-width:28px;height:28px;padding:0 5px;border-radius:var(--rx);font-size:12px;font-family:var(--m);text-decoration:none;color:var(--tx2);background:var(--bg3);border:1px solid var(--bd);transition:all .14s}
.pg-links a:hover{background:var(--bg4);color:var(--tx)}
.pg-links span.active{background:var(--gd);color:var(--go);border-color:var(--gd3)}

/* ── OVERLAY + PANEL ── */
.ov{position:fixed;inset:0;background:rgba(0,0,0,.58);z-index:40;opacity:0;pointer-events:none;transition:opacity .24s;backdrop-filter:blur(3px)}
.ov.on{opacity:1;pointer-events:all}
.panel{position:fixed;top:0;right:0;bottom:0;width:460px;background:var(--bg2);border-left:1px solid var(--bd2);z-index:41;transform:translateX(100%);transition:transform .28s cubic-bezier(.4,0,.2,1);display:flex;flex-direction:column;box-shadow:var(--shl)}
.panel.on{transform:translateX(0)}

.p-head{padding:18px 22px 16px;border-bottom:1px solid var(--bd);display:flex;align-items:flex-start;gap:11px;flex-shrink:0}
.p-ico{width:34px;height:34px;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.p-ico svg{width:17px;height:17px}
.pi-go{background:var(--gd);color:var(--go);border:1px solid var(--gd2)}
.pi-bl{background:var(--bld);color:var(--bl);border:1px solid rgba(96,165,250,.2)}
.pi-gn{background:var(--gnd);color:var(--gn);border:1px solid rgba(62,207,142,.2)}
.p-ttl{font-size:14.5px;font-weight:500}
.p-sub{font-size:11.5px;color:var(--tx3);margin-top:2px}
.p-cls{margin-left:auto;width:26px;height:26px;background:var(--bg4);border:1px solid var(--bd2);color:var(--tx2);border-radius:var(--rx);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .14s;flex-shrink:0}
.p-cls:hover{background:var(--bg5);color:var(--tx)}
.p-cls svg{width:12px;height:12px}

.p-body{flex:1;overflow-y:auto;padding:18px 22px}
.p-body::-webkit-scrollbar{width:3px}
.p-body::-webkit-scrollbar-thumb{background:var(--bg5);border-radius:2px}
.p-foot{padding:14px 22px;border-top:1px solid var(--bd);display:flex;gap:8px;flex-shrink:0}
.pf-btn{flex:1;padding:10px;border-radius:var(--rs);font-family:var(--f);font-size:13px;font-weight:600;cursor:pointer;transition:all .14s;display:flex;align-items:center;justify-content:center;gap:7px;border:none}
.pf-btn svg{width:14px;height:14px}
.pf-cancel{background:var(--bg4);color:var(--tx2);border:1px solid var(--bd2)!important;font-weight:400;flex:.55}
.pf-cancel:hover{background:var(--bg5);color:var(--tx)}
.pf-save{background:var(--go);color:#09090b}
.pf-save:hover{background:var(--go2)}

/* form */
.fg{margin-bottom:14px}
.fg:last-child{margin-bottom:0}
.fl{font-size:10.5px;color:var(--tx3);text-transform:uppercase;letter-spacing:.7px;font-weight:500;display:block;margin-bottom:6px}
.fi2{width:100%;background:var(--bg3);border:1px solid var(--bd2);color:var(--tx);border-radius:var(--rs);padding:9px 12px;font-family:var(--f);font-size:13px;outline:none;transition:border .14s}
.fi2:focus{border-color:var(--go);box-shadow:0 0 0 2px var(--gd)}
.fi2::placeholder{color:var(--tx3)}
.fi2-mono{font-family:var(--m)}
.r2{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.r3{display:grid;grid-template-columns:1fr 1fr 1fr;gap:8px}

/* type toggle */
.tt{display:flex;border:1px solid var(--bd2);border-radius:var(--rs);overflow:hidden;height:38px}
.tto{flex:1;padding:0 12px;text-align:center;font-size:12px;cursor:pointer;transition:all .14s;color:var(--tx3);background:var(--bg3);border:none;font-family:var(--f);display:flex;align-items:center;justify-content:center}
.tto:hover{color:var(--tx2);background:var(--bg4)}
.tto.on{background:var(--gd);color:var(--go);font-weight:500}
.tto+.tto{border-left:1px solid var(--bd2)}

/* section card */
.sc{background:var(--bg3);border:1px solid var(--bd);border-radius:var(--rr);padding:14px;margin-bottom:12px}
.sc:last-child{margin-bottom:0}
.sc-head{display:flex;align-items:center;gap:7px;margin-bottom:12px}
.sc-ico{width:22px;height:22px;border-radius:5px;display:flex;align-items:center;justify-content:center}
.sc-ico svg{width:12px;height:12px}
.sco-go{background:var(--gd);color:var(--go)}
.sco-bl{background:var(--bld);color:var(--bl)}
.sc-ttl{font-size:12px;font-weight:500;color:var(--tx2)}

/* preview box */
.pvb{background:var(--bg2);border:1px solid var(--bd2);border-radius:var(--rs);padding:12px 14px;margin-top:10px}
.pvb-ttl{font-size:9.5px;color:var(--tx3);text-transform:uppercase;letter-spacing:.7px;font-weight:500;margin-bottom:8px}
.pvr{display:flex;justify-content:space-between;align-items:center;margin-bottom:5px}
.pvr:last-child{margin-bottom:0}
.pv-lbl{font-size:11px;color:var(--tx3)}
.pv-val{font-family:var(--m);font-size:13px;font-weight:500;color:var(--go);transition:color .2s}
.pv-val.gn{color:var(--gn)}
.pv-sub{font-size:10px;color:var(--tx3);font-family:var(--m)}

/* divider */
.sep{border:none;border-top:1px solid var(--bd);margin:14px 0}

/* toast */
.toast{position:fixed;bottom:22px;right:22px;background:var(--bg3);border:1px solid var(--bd2);border-radius:var(--rr);padding:11px 15px 11px 13px;display:flex;align-items:center;gap:9px;font-size:13px;transform:translateY(70px);opacity:0;transition:all .28s cubic-bezier(.34,1.56,.64,1);z-index:100;min-width:230px;box-shadow:var(--shl)}
.toast.on{transform:translateY(0);opacity:1}
.t-dot{width:6px;height:6px;border-radius:50%;flex-shrink:0}
.toast.ok .t-dot{background:var(--gn)}
.toast.err .t-dot{background:var(--rd)}

/* confirm */
.conf{position:fixed;inset:0;background:rgba(0,0,0,.65);z-index:60;display:none;align-items:center;justify-content:center;backdrop-filter:blur(4px)}
.conf.on{display:flex}
.conf-box{background:var(--bg2);border:1px solid var(--bd2);border-radius:14px;padding:26px;max-width:320px;width:90%;box-shadow:var(--shl)}
.conf-ico{width:42px;height:42px;background:var(--rdd);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 14px}
.conf-ico svg{width:19px;height:19px;color:var(--rd)}
.conf-ttl{font-size:14.5px;font-weight:500;text-align:center;margin-bottom:7px}
.conf-msg{font-size:12.5px;color:var(--tx2);text-align:center;margin-bottom:20px;line-height:1.6}
.conf-btns{display:flex;gap:8px}
.conf-btns button{flex:1;padding:9px;border-radius:var(--rs);font-family:var(--f);font-size:13px;font-weight:500;cursor:pointer;transition:all .14s}
.c-no{background:var(--bg4);color:var(--tx2);border:1px solid var(--bd2)!important}
.c-no:hover{background:var(--bg5)}
.c-yes{background:var(--rd);color:#fff;border:none;font-weight:600}
.c-yes:hover{background:#ef4444}

/* spinner */
.spin{width:13px;height:13px;border:2px solid rgba(9,9,11,.25);border-top-color:#09090b;border-radius:50%;animation:sp .55s linear infinite;display:inline-block;flex-shrink:0}
@keyframes sp{to{transform:rotate(360deg)}}
@keyframes hl{0%,100%{background:transparent}40%{background:rgba(201,164,78,.07)}}
.hl{animation:hl .75s ease}

/* empty */
.empty{text-align:center;padding:64px 0}
.empty svg{width:44px;height:44px;opacity:.15;margin:0 auto 12px;display:block}
</style>
</head>
<body>
<div class="app">

<!-- SIDEBAR -->
<aside class="sb">
<div class="sb-logo">
  <div class="logo">
    <div class="logo-ico"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M3 3h7v7H3V3zm0 11h7v7H3v-7zm11-11h7v7h-7V3zm4 11h-1v3h-3v1h3v3h1v-3h3v-1h-3v-3z"/></svg></div>
    <div><div class="logo-name">TOKO AJIB</div><div class="logo-tag">Point of Sale</div></div>
  </div>
</div>
<nav class="nav">
  <div class="nav-sec">Utama</div>
  <a href="/dashboard" class="nav-a">
    <svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="2" width="9" height="9" rx="2"/><rect x="13" y="2" width="9" height="9" rx="2"/><rect x="2" y="13" width="9" height="9" rx="2"/><rect x="13" y="13" width="9" height="9" rx="2"/></svg>Kasir
  </a>
  <a href="/products" class="nav-a on">
    <svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/></svg>Produk
  </a>
  <a href="/transactions" class="nav-a">
    <svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 12h6M9 16h4"/></svg>Transaksi
  </a>
  <a href="/customers" class="nav-a">
    <svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="8" cy="7" r="4"/><path d="M2 21v-2a4 4 0 014-4h4a4 4 0 014 4v2"/><path d="M19 8v6M22 11h-6"/></svg>Pelanggan
  </a>
  <div class="nav-sec">Sistem</div>
  <a href="/import" class="nav-a">
    <svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg>Import CSV
  </a>
</nav>
<div class="sb-foot">
  <div class="u-row">
    <div class="uav">{{ substr(auth()->user()->name??'A',0,1) }}</div>
    <div><div class="u-nm">{{ auth()->user()->name??'Admin' }}</div><div class="u-rl">Kasir</div></div>
  </div>
</div>
</aside>

<!-- MAIN -->
<main class="main">

<!-- TOPBAR -->
<div class="topbar">
  <div class="tb-ttl">Manajemen Produk</div>
  <button class="btn btn-ghost" onclick="openPanel('bulk')">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
    Margin per Kategori
  </button>
  <button class="btn btn-gold" onclick="openPanel('add')">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
    Tambah Produk
  </button>
</div>

<!-- STATS -->
<div class="stats">
  <div class="stat">
    <div class="stat-l">Total SKU</div>
    <div class="stat-v go">{{ $products->total() }}</div>
    <div class="stat-s">produk terdaftar</div>
  </div>
  <div class="stat">
    <div class="stat-l">Stok Aman</div>
    <div class="stat-v gn">{{ $products->getCollection()->where('stock','>',10)->count() }}</div>
    <div class="stat-s">stok &gt; 10 unit</div>
  </div>
  <div class="stat">
    <div class="stat-l">Stok Menipis</div>
    <div class="stat-v am">{{ $products->getCollection()->whereBetween('stock',[1,10])->count() }}</div>
    <div class="stat-s">1 – 10 unit tersisa</div>
  </div>
  <div class="stat">
    <div class="stat-l">Stok Habis</div>
    <div class="stat-v rd">{{ $products->getCollection()->where('stock','<=',0)->count() }}</div>
    <div class="stat-s">stok = 0</div>
  </div>
</div>

<!-- FILTER -->
<form method="GET" action="/products">
<div class="fbar">
  <input class="fi fi-search" type="text" name="search" placeholder="🔍  Cari nama produk..." value="{{ request('search') }}">
  <select class="fi fi-cat" name="category_id" onchange="this.form.submit()">
    <option value="">Semua Kategori</option>
    @foreach($categories as $cat)
    <option value="{{ $cat->id }}" {{ request('category_id')==$cat->id?'selected':'' }}>{{ $cat->name }}</option>
    @endforeach
  </select>
  <button type="submit" class="fi-btn">Cari</button>
  @if(request('search')||request('category_id'))
  <a href="/products" style="font-size:11.5px;color:var(--tx3);text-decoration:none;padding:3px 5px">✕ Reset</a>
  @endif
  <div style="flex:1"></div>
  <span style="font-size:11.5px;color:var(--tx3)">{{ $products->total() }} produk</span>
</div>
</form>

<!-- TABLE -->
<div class="tw">
@if($products->isEmpty())
<div class="empty">
  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/></svg>
  <p style="font-size:13.5px;color:var(--tx2)">Belum ada produk</p>
  <p style="font-size:11.5px;color:var(--tx3);margin-top:5px">Klik "Tambah Produk" untuk mulai</p>
</div>
@else
<table>
<thead>
<tr>
  <th style="min-width:180px">Nama Produk</th>
  <th>Kategori</th>
  <th>Harga Modal</th>
  <th>Qty/Dus</th>
  <th>Margin Dus</th>
  <th>Harga Dus</th>
  <th>Margin PCS</th>
  <th>Harga PCS</th>
  <th>Stok</th>
  <th style="min-width:116px;text-align:right">Aksi</th>
</tr>
</thead>
<tbody id="tbody">
@foreach($products as $p)
<tr id="row-{{ $p->id }}">

  {{-- NAMA --}}
  <td>
    <div class="c-nm">{{ $p->name }}</div>
  </td>

  {{-- KATEGORI --}}
  <td><span class="c-cat">{{ $p->category->name ?? '—' }}</span></td>

  {{-- HARGA MODAL (inline edit) --}}
  <td id="modal-cell-{{ $p->id }}">
    <div id="modal-disp-{{ $p->id }}">
      <div class="c-price" id="modal-val-{{ $p->id }}">Rp {{ number_format($p->harga_beli_dus,0,',','.') }}</div>
      <div class="c-sub">per dus</div>
    </div>
    <div id="modal-edit-{{ $p->id }}" style="display:none">
      <input class="ie" type="number" id="modal-inp-{{ $p->id }}" value="{{ $p->harga_beli_dus }}"
        onkeydown="if(event.key==='Enter')saveModal({{ $p->id }});if(event.key==='Escape')cancelModal({{ $p->id }})">
      <div class="ie-row">
        <button class="ib ib-s" onclick="saveModal({{ $p->id }})">Simpan</button>
        <button class="ib ib-c" onclick="cancelModal({{ $p->id }})">Batal</button>
      </div>
    </div>
  </td>

  {{-- QTY --}}
  <td><span class="c-mono">{{ $p->qty_per_dus }}</span></td>

  {{-- MARGIN DUS --}}
  <td>
    <span class="mp {{ $p->margin_dus_type=='percent'?'pct':($p->margin_dus>0?'nom':'def') }}" id="mpd-{{ $p->id }}">
      {{ $p->margin_dus }}{{ $p->margin_dus_type=='percent'?'%':' rp' }}
    </span>
  </td>

  {{-- HARGA DUS --}}
  <td><div class="c-price" id="hdus-{{ $p->id }}">Rp {{ number_format($p->harga_jual_dus,0,',','.') }}</div></td>

  {{-- MARGIN PCS --}}
  <td>
    <span class="mp {{ $p->margin_pcs_type=='percent'?'pct':($p->margin_pcs>0?'nom':'def') }}" id="mpp-{{ $p->id }}">
      {{ $p->margin_pcs }}{{ $p->margin_pcs_type=='percent'?'%':' rp' }}
    </span>
  </td>

  {{-- HARGA PCS --}}
  <td><div class="c-price" id="hpcs-{{ $p->id }}">Rp {{ number_format($p->harga_jual_pcs,0,',','.') }}</div></td>

  {{-- STOK (inline edit) --}}
  <td id="stok-cell-{{ $p->id }}">
    <div id="stok-disp-{{ $p->id }}">
      <span class="sn {{ $p->stock>10?'s-ok':($p->stock>0?'s-lw':'s-no') }}" id="stok-val-{{ $p->id }}">{{ $p->stock }}</span>
    </div>
    <div id="stok-edit-{{ $p->id }}" style="display:none">
      <input class="ie ie-sm" type="number" id="stok-inp-{{ $p->id }}" value="{{ $p->stock }}" min="0"
        onkeydown="if(event.key==='Enter')saveStok({{ $p->id }});if(event.key==='Escape')cancelStok({{ $p->id }})">
      <div class="ie-row">
        <button class="ib ib-s" onclick="saveStok({{ $p->id }})">OK</button>
        <button class="ib ib-c" onclick="cancelStok({{ $p->id }})">✕</button>
      </div>
    </div>
  </td>

  {{-- AKSI --}}
  <td>
    <div class="ra" id="ra-{{ $p->id }}">
      {{-- Edit harga modal --}}
      <button class="rb rb" title="Edit Harga Modal" onclick="toggleModal({{ $p->id }})">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
      </button>
      {{-- Edit margin --}}
      <button class="rb rg" title="Update Margin"
        onclick="openMarginPanel({{ $p->id }},'{{ addslashes($p->name) }}',{{ $p->margin_dus }},'{{ $p->margin_dus_type }}',{{ $p->margin_pcs }},'{{ $p->margin_pcs_type }}',{{ $p->harga_beli_dus }},{{ $p->qty_per_dus }})">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L4.22 13.45l-1.06 3.77 3.77-1.06 8.84-8.84a5.5 5.5 0 000-7.71z"/></svg>
      </button>
      {{-- Edit stok --}}
      <button class="rb rk" title="Update Stok" onclick="toggleStok({{ $p->id }})">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/></svg>
      </button>
      {{-- Hapus --}}
      <button class="rb rd" title="Hapus" onclick="askDelete({{ $p->id }},'{{ addslashes($p->name) }}')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
      </button>
    </div>
  </td>
</tr>
@endforeach
</tbody>
</table>
@endif
</div>

<!-- PAGINATION -->
<div class="pgbar">
  <div class="pg-info">{{ $products->firstItem()??0 }} – {{ $products->lastItem()??0 }} dari {{ $products->total() }} produk</div>
  <div class="pg-links">{{ $products->onEachSide(1)->links('pagination::simple-tailwind') }}</div>
</div>

</main>
</div><!-- .app -->

<!-- ═══════════════════════════════════════════════
     PANEL — TAMBAH PRODUK
════════════════════════════════════════════════ -->
<div class="ov" id="ov-add" onclick="closePanel('add')"></div>
<div class="panel" id="panel-add">
  <div class="p-head">
    <div class="p-ico pi-go"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 5v14M5 12h14"/></svg></div>
    <div><div class="p-ttl">Tambah Produk Baru</div><div class="p-sub">Harga jual dihitung otomatis dari margin</div></div>
    <button class="p-cls" onclick="closePanel('add')"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg></button>
  </div>
  <div class="p-body">

    <div class="sc">
      <div class="sc-head"><div class="sc-ico sco-go"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/></svg></div><span class="sc-ttl">Info Dasar</span></div>
      <div class="fg">
        <label class="fl">Nama Barang</label>
        <input class="fi2" type="text" id="a-nm" placeholder="Contoh: Indomie Goreng">
      </div>
      <div class="r2">
        <div class="fg">
          <label class="fl">Kategori</label>
          <select class="fi2" id="a-cat" onchange="loadCatMargin(this.value)">
            <option value="">— Pilih —</option>
            @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="fg">
          <label class="fl">Stok Awal</label>
          <input class="fi2 fi2-mono" type="number" id="a-stk" value="0" min="0">
        </div>
      </div>
    </div>

    <div class="sc">
      <div class="sc-head"><div class="sc-ico sco-bl"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg></div><span class="sc-ttl">Harga Modal</span></div>
      <div class="r2">
        <div class="fg">
          <label class="fl">Harga Beli / Dus</label>
          <input class="fi2 fi2-mono" type="number" id="a-hbd" placeholder="48000" oninput="pvAdd()">
        </div>
        <div class="fg">
          <label class="fl">Qty per Dus</label>
          <input class="fi2 fi2-mono" type="number" id="a-qty" value="1" min="1" oninput="pvAdd()">
        </div>
      </div>
    </div>

    <div class="sc">
      <div class="sc-head"><div class="sc-ico sco-go"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg></div><span class="sc-ttl">Margin &amp; Harga Jual</span></div>

      <div class="fg">
        <label class="fl">Margin Harga Dus</label>
        <div class="r2" style="gap:8px;align-items:flex-start">
          <input class="fi2 fi2-mono" type="number" id="a-md" value="10" oninput="pvAdd()">
          <div class="tt">
            <button type="button" class="tto on" id="a-md-p" onclick="setTy('a','d','percent')">%</button>
            <button type="button" class="tto"    id="a-md-n" onclick="setTy('a','d','nominal')">Rp</button>
          </div>
        </div>
      </div>
      <div class="fg">
        <label class="fl">Margin Harga PCS</label>
        <div class="r2" style="gap:8px;align-items:flex-start">
          <input class="fi2 fi2-mono" type="number" id="a-mp" value="15" oninput="pvAdd()">
          <div class="tt">
            <button type="button" class="tto on" id="a-mp-p" onclick="setTy('a','p','percent')">%</button>
            <button type="button" class="tto"    id="a-mp-n" onclick="setTy('a','p','nominal')">Rp</button>
          </div>
        </div>
      </div>

      <div class="pvb">
        <div class="pvb-ttl">Preview Kalkulasi Harga Jual</div>
        <div class="pvr"><span class="pv-lbl">Harga Jual Dus</span><span class="pv-val" id="a-prd">Rp —</span></div>
        <div class="pvr"><span class="pv-lbl">Harga Jual PCS</span><span class="pv-val" id="a-prp">Rp —</span></div>
        <hr class="sep" style="margin:8px 0">
        <div class="pvr"><span class="pv-lbl" style="font-size:10px">Modal per PCS</span><span class="pv-sub" id="a-prs">Rp —</span></div>
      </div>
    </div>

  </div>
  <div class="p-foot">
    <button class="pf-btn pf-cancel" onclick="closePanel('add')">Batal</button>
    <button class="pf-btn pf-save" id="a-btn" onclick="submitAdd()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>Simpan Produk
    </button>
  </div>
</div>

<!-- ═══════════════════════════════════════════════
     PANEL — UPDATE MARGIN (per produk)
════════════════════════════════════════════════ -->
<div class="ov" id="ov-margin" onclick="closePanel('margin')"></div>
<div class="panel" id="panel-margin">
  <div class="p-head">
    <div class="p-ico pi-go"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L4.22 13.45l-1.06 3.77 3.77-1.06 8.84-8.84a5.5 5.5 0 000-7.71z"/></svg></div>
    <div><div class="p-ttl" id="m-ttl">Update Margin</div><div class="p-sub">Harga jual diperbarui otomatis</div></div>
    <button class="p-cls" onclick="closePanel('margin')"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg></button>
  </div>
  <input type="hidden" id="m-id">
  <div class="p-body">
    <div class="sc">
      <div class="sc-head"><div class="sc-ico sco-go"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg></div><span class="sc-ttl">Margin Harga Dus</span></div>
      <div class="r2" style="gap:8px;align-items:flex-start">
        <div class="fg" style="margin:0"><label class="fl">Nilai Margin</label><input class="fi2 fi2-mono" type="number" id="m-md" oninput="pvMargin()"></div>
        <div class="tt" style="margin-top:18px">
          <button type="button" class="tto on" id="m-md-p" onclick="setTy('m','d','percent')">%</button>
          <button type="button" class="tto"    id="m-md-n" onclick="setTy('m','d','nominal')">Rp</button>
        </div>
      </div>
    </div>
    <div class="sc">
      <div class="sc-head"><div class="sc-ico sco-bl"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg></div><span class="sc-ttl">Margin Harga PCS</span></div>
      <div class="r2" style="gap:8px;align-items:flex-start">
        <div class="fg" style="margin:0"><label class="fl">Nilai Margin</label><input class="fi2 fi2-mono" type="number" id="m-mp" oninput="pvMargin()"></div>
        <div class="tt" style="margin-top:18px">
          <button type="button" class="tto on" id="m-mp-p" onclick="setTy('m','p','percent')">%</button>
          <button type="button" class="tto"    id="m-mp-n" onclick="setTy('m','p','nominal')">Rp</button>
        </div>
      </div>
    </div>
    <div class="pvb">
      <div class="pvb-ttl">Preview Setelah Disimpan</div>
      <div class="pvr"><span class="pv-lbl">Harga Jual Dus</span><span class="pv-val" id="m-prd">—</span></div>
      <div class="pvr"><span class="pv-lbl">Harga Jual PCS</span><span class="pv-val" id="m-prp">—</span></div>
    </div>
  </div>
  <div class="p-foot">
    <button class="pf-btn pf-cancel" onclick="closePanel('margin')">Batal</button>
    <button class="pf-btn pf-save" id="m-btn" onclick="submitMargin()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>Terapkan Margin
    </button>
  </div>
</div>

<!-- ═══════════════════════════════════════════════
     PANEL — MARGIN MASSAL (per kategori)
════════════════════════════════════════════════ -->
<div class="ov" id="ov-bulk" onclick="closePanel('bulk')"></div>
<div class="panel" id="panel-bulk">
  <div class="p-head">
    <div class="p-ico pi-gn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg></div>
    <div><div class="p-ttl">Margin per Kategori</div><div class="p-sub">Update semua produk dalam 1 kategori</div></div>
    <button class="p-cls" onclick="closePanel('bulk')"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg></button>
  </div>
  <div class="p-body">
    <div class="sc">
      <div class="fg"><label class="fl">Pilih Kategori</label>
        <select class="fi2" id="b-cat">
          <option value="">— Pilih Kategori —</option>
          @foreach($categories as $cat)
          <option value="{{ $cat->id }}">{{ $cat->name }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="sc">
      <div class="sc-head"><div class="sc-ico sco-go"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg></div><span class="sc-ttl">Margin Baru</span></div>
      <div class="fg">
        <label class="fl">Margin Dus</label>
        <div class="r2" style="gap:8px;align-items:flex-start">
          <input class="fi2 fi2-mono" type="number" id="b-md" value="10">
          <div class="tt">
            <button type="button" class="tto on" id="b-md-p" onclick="setTy('b','d','percent')">%</button>
            <button type="button" class="tto"    id="b-md-n" onclick="setTy('b','d','nominal')">Rp</button>
          </div>
        </div>
      </div>
      <div class="fg">
        <label class="fl">Margin PCS</label>
        <div class="r2" style="gap:8px;align-items:flex-start">
          <input class="fi2 fi2-mono" type="number" id="b-mp" value="15">
          <div class="tt">
            <button type="button" class="tto on" id="b-mp-p" onclick="setTy('b','p','percent')">%</button>
            <button type="button" class="tto"    id="b-mp-n" onclick="setTy('b','p','nominal')">Rp</button>
          </div>
        </div>
      </div>
    </div>
    <div style="background:var(--amd);border:1px solid rgba(245,158,11,.2);border-radius:var(--rs);padding:11px 13px;font-size:12px;color:var(--am);display:flex;gap:8px;align-items:flex-start">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:1px"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
      Semua produk dalam kategori yang dipilih akan diperbarui. Aksi ini tidak bisa di-undo.
    </div>
  </div>
  <div class="p-foot">
    <button class="pf-btn pf-cancel" onclick="closePanel('bulk')">Batal</button>
    <button class="pf-btn pf-save" id="b-btn" onclick="submitBulk()" style="background:var(--gn);color:#09090b">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>Terapkan ke Semua
    </button>
  </div>
</div>

<!-- CONFIRM DELETE -->
<div class="conf" id="conf">
  <div class="conf-box">
    <div class="conf-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg></div>
    <div class="conf-ttl">Hapus Produk?</div>
    <div class="conf-msg" id="conf-msg">Produk ini akan dihapus permanen.</div>
    <div class="conf-btns">
      <button class="c-no" onclick="closeConf()">Batal</button>
      <button class="c-yes" id="conf-yes" onclick="execDelete()">Hapus</button>
    </div>
  </div>
</div>

<!-- TOAST -->
<div class="toast" id="toast"><div class="t-dot"></div><span id="t-msg"></span></div>

<script>
const CSR = '{{ csrf_token() }}';
const Rp  = n => 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.round(n));
const g   = id => document.getElementById(id);

// Margin type state
const T = { a:{d:'percent',p:'percent'}, m:{d:'percent',p:'percent'}, b:{d:'percent',p:'percent'} };

// ─── TYPE TOGGLE ───────────────────────────────────────
function setTy(px, wh, ty) {
  T[px][wh] = ty;
  g(`${px}-m${wh}-p`).classList.toggle('on', ty === 'percent');
  g(`${px}-m${wh}-n`).classList.toggle('on', ty === 'nominal');
  if (px === 'a') pvAdd();
  if (px === 'm') pvMargin();
}

// ─── PANEL OPEN / CLOSE ────────────────────────────────
function openPanel(n) {
  g('ov-'+n).classList.add('on');
  g('panel-'+n).classList.add('on');
}
function closePanel(n) {
  g('ov-'+n).classList.remove('on');
  g('panel-'+n).classList.remove('on');
}

// ─── PRICE CALCULATOR ──────────────────────────────────
function calc(hbd, qty, md, mdt, mp, mpt) {
  hbd = parseFloat(hbd)||0; qty = parseInt(qty)||1;
  md  = parseFloat(md)||0;  mp  = parseFloat(mp)||0;
  const hd  = mdt==='percent' ? hbd*(1+md/100) : hbd+md;
  const hbp = qty>0 ? hd/qty : 0;
  const hp  = mpt==='percent' ? hbp*(1+mp/100) : hbp+mp;
  return { hd, hp, hbp };
}

// ─── ADD PANEL ─────────────────────────────────────────
function openPanel_add() {
  ['a-nm','a-hbd'].forEach(id => g(id).value='');
  g('a-qty').value='1'; g('a-stk').value='0'; g('a-cat').value='';
  g('a-md').value='10'; g('a-mp').value='15';
  setTy('a','d','percent'); setTy('a','p','percent');
  g('a-prd').textContent='Rp —'; g('a-prp').textContent='Rp —'; g('a-prs').textContent='Rp —';
}

async function loadCatMargin(catId) {
  if (!catId) return;
  try {
    const r = await fetch(`/products/category-margins/${catId}`);
    const d = await r.json();
    g('a-md').value = d.margin_dus;
    g('a-mp').value = d.margin_pcs;
    setTy('a','d', d.margin_dus_type);
    setTy('a','p', d.margin_pcs_type);
    pvAdd();
  } catch(e) {}
}

function pvAdd() {
  const { hd, hp, hbp } = calc(g('a-hbd').value, g('a-qty').value, g('a-md').value, T.a.d, g('a-mp').value, T.a.p);
  g('a-prd').textContent = Rp(hd);
  g('a-prp').textContent = Rp(hp);
  g('a-prs').textContent = Rp(hbp);
}

async function submitAdd() {
  const nm = g('a-nm').value.trim();
  const cat = g('a-cat').value;
  const hbd = g('a-hbd').value;
  if (!nm)  { showToast('Nama barang wajib diisi', 'err'); return; }
  if (!cat) { showToast('Pilih kategori terlebih dahulu', 'err'); return; }
  if (!hbd || parseFloat(hbd) <= 0) { showToast('Isi harga modal terlebih dahulu', 'err'); return; }

  setBtn('a-btn', true, 'Menyimpan...');
  try {
    const r = await callApi('POST', '/products', {
      name: nm, category_id: cat,
      harga_beli_dus: hbd, qty_per_dus: g('a-qty').value,
      margin_dus: g('a-md').value, margin_dus_type: T.a.d,
      margin_pcs: g('a-mp').value, margin_pcs_type: T.a.p,
      stock: g('a-stk').value,
    });
    if (r.status === 'success') {
      closePanel('add'); showToast(r.message, 'ok');
      setTimeout(() => location.reload(), 700);
    } else showToast(r.message || 'Gagal menyimpan', 'err');
  } finally { setBtn('a-btn', false, '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>Simpan Produk'); }
}

// ─── MARGIN PANEL (per produk) ─────────────────────────
let mCtx = {};
function openMarginPanel(id, nm, md, mdt, mp, mpt, hbd, qty) {
  mCtx = { id, hbd, qty };
  g('m-id').value = id;
  g('m-ttl').textContent = nm;
  g('m-md').value = md; g('m-mp').value = mp;
  setTy('m','d', mdt); setTy('m','p', mpt);
  pvMargin();
  openPanel('margin');
}

function pvMargin() {
  const { hd, hp } = calc(mCtx.hbd, mCtx.qty, g('m-md').value, T.m.d, g('m-mp').value, T.m.p);
  g('m-prd').textContent = Rp(hd);
  g('m-prp').textContent = Rp(hp);
}

async function submitMargin() {
  const id = g('m-id').value;
  setBtn('m-btn', true, 'Memproses...');
  try {
    const r = await callApi('POST', `/products/${id}/update-margin`, {
      margin_dus: g('m-md').value, margin_dus_type: T.m.d,
      margin_pcs: g('m-mp').value, margin_pcs_type: T.m.p,
    });
    if (r.status === 'success') {
      flashPrices(id, r.harga_jual_dus, r.harga_jual_pcs);
      updPills(id, g('m-md').value, T.m.d, g('m-mp').value, T.m.p);
      closePanel('margin'); showToast(r.message, 'ok');
    }
  } finally { setBtn('m-btn', false, '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>Terapkan Margin'); }
}

// ─── BULK MARGIN ───────────────────────────────────────
async function submitBulk() {
  const catId = g('b-cat').value;
  if (!catId) { showToast('Pilih kategori terlebih dahulu', 'err'); return; }
  setBtn('b-btn', true, 'Memproses...');
  try {
    const r = await callApi('POST', '/products/update-margin-category', {
      category_id: catId,
      margin_dus: g('b-md').value, margin_dus_type: T.b.d,
      margin_pcs: g('b-mp').value, margin_pcs_type: T.b.p,
    });
    if (r.status === 'success') {
      closePanel('bulk'); showToast(r.message, 'ok');
      setTimeout(() => location.reload(), 900);
    }
  } finally { setBtn('b-btn', false, '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>Terapkan ke Semua'); }
}

// ─── INLINE: HARGA MODAL ───────────────────────────────
function toggleModal(id) {
  const disp = g(`modal-disp-${id}`), edit = g(`modal-edit-${id}`), row = g(`row-${id}`);
  if (edit.style.display === 'none') {
    disp.style.display = 'none'; edit.style.display = 'block';
    row.classList.add('editing');
    g(`modal-inp-${id}`).focus(); g(`modal-inp-${id}`).select();
    g(`ra-${id}`).classList.add('vis');
  } else cancelModal(id);
}
function cancelModal(id) {
  g(`modal-disp-${id}`).style.display = 'block';
  g(`modal-edit-${id}`).style.display = 'none';
  g(`row-${id}`).classList.remove('editing');
  g(`ra-${id}`).classList.remove('vis');
}
async function saveModal(id) {
  const val = g(`modal-inp-${id}`).value;
  if (!val || parseFloat(val) <= 0) { showToast('Harga modal tidak valid', 'err'); return; }
  try {
    const r = await callApi('POST', `/products/${id}/update-modal`, { harga_beli_dus: val });
    if (r.status === 'success') {
      g(`modal-val-${id}`).textContent = Rp(parseFloat(val));
      flashPrices(id, r.harga_jual_dus, r.harga_jual_pcs);
      cancelModal(id);
      showToast(r.message, 'ok');
    }
  } catch(e) { showToast('Gagal menyimpan', 'err'); }
}

// ─── INLINE: STOK ──────────────────────────────────────
function toggleStok(id) {
  const disp = g(`stok-disp-${id}`), edit = g(`stok-edit-${id}`), row = g(`row-${id}`);
  if (edit.style.display === 'none') {
    disp.style.display = 'none'; edit.style.display = 'block';
    row.classList.add('editing');
    g(`stok-inp-${id}`).focus(); g(`stok-inp-${id}`).select();
    g(`ra-${id}`).classList.add('vis');
  } else cancelStok(id);
}
function cancelStok(id) {
  g(`stok-disp-${id}`).style.display = 'block';
  g(`stok-edit-${id}`).style.display = 'none';
  g(`row-${id}`).classList.remove('editing');
  g(`ra-${id}`).classList.remove('vis');
}
async function saveStok(id) {
  const val = parseInt(g(`stok-inp-${id}`).value);
  if (isNaN(val) || val < 0) { showToast('Nilai stok tidak valid', 'err'); return; }
  try {
    const r = await callApi('POST', `/products/${id}/update-stock`, { stock: val });
    if (r.status === 'success') {
      const el = g(`stok-val-${id}`);
      el.textContent = val;
      el.className = 'sn ' + (val>10?'s-ok':val>0?'s-lw':'s-no');
      cancelStok(id); showToast(r.message, 'ok');
    }
  } catch(e) { showToast('Gagal menyimpan', 'err'); }
}

// ─── DELETE ────────────────────────────────────────────
let delId = null;
function askDelete(id, nm) {
  delId = id;
  g('conf-msg').textContent = `"${nm}" akan dihapus permanen dan tidak bisa dikembalikan.`;
  g('conf').classList.add('on');
}
function closeConf() { g('conf').classList.remove('on'); delId = null; }
async function execDelete() {
  if (!delId) return;
  const btn = g('conf-yes');
  btn.disabled = true; btn.textContent = 'Menghapus...';
  try {
    const r = await callApi('DELETE', `/products/${delId}`, {});
    if (r.status === 'success') {
      const row = g(`row-${delId}`);
      row.style.transition = 'opacity .25s,transform .25s';
      row.style.opacity = '0'; row.style.transform = 'translateX(16px)';
      setTimeout(() => row.remove(), 260);
      closeConf(); showToast(r.message, 'ok');
    }
  } finally { btn.disabled=false; btn.textContent='Hapus'; }
}

// ─── HELPERS ───────────────────────────────────────────
function flashPrices(id, hd, hp) {
  [['hdus-'+id, hd], ['hpcs-'+id, hp]].forEach(([elId, val]) => {
    const el = g(elId);
    if (!el) return;
    el.textContent = Rp(val);
    el.classList.add('flash');
    setTimeout(() => el.classList.remove('flash'), 1400);
  });
  const row = g('row-'+id);
  if (row) { row.classList.remove('hl'); void row.offsetWidth; row.classList.add('hl'); }
}

function updPills(id, md, mdt, mp, mpt) {
  const dp = g(`mpd-${id}`), pp = g(`mpp-${id}`);
  if (dp) { dp.textContent = md+(mdt==='percent'?'%':' rp'); dp.className='mp '+(mdt==='percent'?'pct':'nom'); }
  if (pp) { pp.textContent = mp+(mpt==='percent'?'%':' rp'); pp.className='mp '+(mpt==='percent'?'pct':'nom'); }
}

function setBtn(id, loading, html) {
  const el = g(id);
  el.disabled = loading;
  el.innerHTML = loading ? '<div class="spin"></div> ' + html : html;
}

async function callApi(method, url, body) {
  const r = await fetch(url, {
    method,
    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSR },
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

// ─── KEYBOARD ──────────────────────────────────────────
document.addEventListener('keydown', e => {
  if (e.key === 'Escape') {
    ['add','margin','bulk'].forEach(n => closePanel(n));
    closeConf();
  }
});

// Reset add panel when opened
document.getElementById('panel-add').addEventListener('transitionend', e => {
  if (e.propertyName === 'transform' && document.getElementById('panel-add').classList.contains('on')) {
    openPanel_add();
    setTimeout(() => g('a-nm').focus(), 50);
  }
});
</script>
</body>
</html>
