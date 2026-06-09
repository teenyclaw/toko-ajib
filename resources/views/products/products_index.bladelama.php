<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Produk — POS</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
--bg:#0a0a0c;--bg2:#111113;--bg3:#18181b;--bg4:#202024;--bg5:#28282d;
--b:rgba(255,255,255,.06);--b2:rgba(255,255,255,.10);--b3:rgba(255,255,255,.16);
--t:#eeeae3;--t2:#96938d;--t3:#525050;
--g:#c8a24a;--g2:#e6c367;--g3:#f0d080;
--gd:rgba(200,162,74,.10);--gd2:rgba(200,162,74,.18);--gd3:rgba(200,162,74,.28);
--gr:#3ecf8e;--grd:rgba(62,207,142,.10);
--r:#f87171;--rd:rgba(248,113,113,.10);
--am:#f59e0b;--amd:rgba(245,158,11,.10);
--bl:#60a5fa;--bld:rgba(96,165,250,.10);
--rr:12px;--rs:8px;--rx:6px;
--fn:'DM Sans',sans-serif;--mo:'DM Mono',monospace;
--sh:0 4px 24px rgba(0,0,0,.5);--shl:0 12px 48px rgba(0,0,0,.6)
}
html,body{height:100%;overflow:hidden}
body{font-family:var(--fn);background:var(--bg);color:var(--t);font-size:14px;line-height:1.5;-webkit-font-smoothing:antialiased}
.app{display:grid;grid-template-columns:220px 1fr;height:100vh}
.main{display:flex;flex-direction:column;overflow:hidden;min-width:0}

/* SIDEBAR */
.sb{background:var(--bg2);border-right:1px solid var(--b);display:flex;flex-direction:column}
.sb-logo{padding:22px 18px 18px;border-bottom:1px solid var(--b)}
.lm{display:flex;align-items:center;gap:10px}
.li{width:32px;height:32px;background:var(--g);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.li svg{width:17px;height:17px;color:#0a0a0c}
.lt{font-size:15px;font-weight:600;letter-spacing:-.3px}
.ls{font-size:10px;color:var(--t3);letter-spacing:.8px;text-transform:uppercase;margin-top:1px}
.nav{padding:10px 8px;flex:1;overflow-y:auto}
.nl{font-size:10px;color:var(--t3);letter-spacing:1px;text-transform:uppercase;padding:14px 10px 5px;font-weight:500}
.na{display:flex;align-items:center;gap:9px;padding:9px 10px;border-radius:var(--rs);color:var(--t2);text-decoration:none;font-size:13.5px;transition:all .15s;margin-bottom:1px}
.na:hover{background:var(--bg3);color:var(--t)}
.na.on{background:var(--gd);color:var(--g)}
.ni{width:15px;height:15px;flex-shrink:0;opacity:.65}
.na.on .ni{opacity:1}
.sb-ft{padding:14px;border-top:1px solid var(--b)}
.ur{display:flex;align-items:center;gap:9px;padding:7px 9px;border-radius:var(--rs)}
.av{width:28px;height:28px;border-radius:50%;background:var(--gd);display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:600;color:var(--g);flex-shrink:0;border:1px solid var(--gd2)}
.un{font-size:13px;font-weight:500}
.uro{font-size:11px;color:var(--t3)}

/* TOPBAR */
.topbar{padding:0 24px;height:56px;border-bottom:1px solid var(--b);display:flex;align-items:center;gap:12px;flex-shrink:0;background:var(--bg2)}
.tb-title{font-size:15px;font-weight:500;flex:1}
.tbtn{display:inline-flex;align-items:center;gap:7px;padding:8px 14px;border-radius:var(--rs);font-family:var(--fn);font-size:13px;font-weight:500;cursor:pointer;transition:all .15s;border:none;white-space:nowrap}
.tbtn svg{width:14px;height:14px}
.bg{background:var(--bg4);color:var(--t2);border:1px solid var(--b2)!important}
.bg:hover{background:var(--bg5);color:var(--t)}
.bgo{background:var(--g);color:#0a0a0c;font-weight:600}
.bgo:hover{background:var(--g2)}

/* STATS */
.stats{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;padding:16px 24px;border-bottom:1px solid var(--b);flex-shrink:0}
.sc{background:var(--bg2);border:1px solid var(--b);border-radius:var(--rr);padding:14px 16px}
.sc-l{font-size:10.5px;color:var(--t3);text-transform:uppercase;letter-spacing:.8px;font-weight:500;margin-bottom:6px}
.sc-v{font-size:21px;font-weight:600;font-family:var(--mo);letter-spacing:-.5px}
.sc-v.g{color:var(--g)}.sc-v.gr{color:var(--gr)}.sc-v.r{color:var(--r)}.sc-v.am{color:var(--am)}
.sc-s{font-size:11px;color:var(--t3);margin-top:3px}

/* FILTER */
.fbar{padding:12px 24px;border-bottom:1px solid var(--b);display:flex;align-items:center;gap:10px;flex-shrink:0}
.fi{background:var(--bg3);border:1px solid var(--b2);color:var(--t);border-radius:var(--rs);padding:8px 12px;font-family:var(--fn);font-size:13px;outline:none;transition:border .15s}
.fi:focus{border-color:var(--g)}
.fi::placeholder{color:var(--t3)}
.fi-s{flex:1;max-width:280px}
.fi-c{min-width:160px;appearance:none;cursor:pointer}
.fbttn{background:var(--bg3);border:1px solid var(--b2);color:var(--t2);border-radius:var(--rs);padding:8px 14px;font-size:13px;font-family:var(--fn);cursor:pointer;transition:all .15s}
.fbttn:hover{background:var(--bg4);color:var(--t)}

/* TABLE */
.tw{flex:1;overflow-y:auto;min-height:0}
.tw::-webkit-scrollbar{width:4px}
.tw::-webkit-scrollbar-thumb{background:var(--bg5);border-radius:2px}
table{width:100%;border-collapse:collapse}
thead{position:sticky;top:0;z-index:10;background:var(--bg2)}
thead th{font-size:10.5px;color:var(--t3);text-transform:uppercase;letter-spacing:.8px;font-weight:500;padding:10px 14px;text-align:left;border-bottom:1px solid var(--b);white-space:nowrap}
thead th:last-child{text-align:right}
tbody tr{border-bottom:1px solid var(--b);transition:background .1s}
tbody tr:hover{background:var(--bg2)}
tbody tr.editing{background:rgba(200,162,74,.04);outline:1px solid var(--gd2);outline-offset:-1px}
tbody td{padding:11px 14px;vertical-align:middle;font-size:13px;color:var(--t2)}
.cn{font-size:13.5px;font-weight:500;color:var(--t)}
.cs{font-size:11px;color:var(--t3);margin-top:2px}
.cm{font-family:var(--mo);font-size:12.5px}
.cp{font-family:var(--mo);font-size:13px;color:var(--t);font-weight:500}
.cb{display:inline-block;font-size:10.5px;background:var(--bg4);color:var(--t3);padding:2px 8px;border-radius:4px;border:1px solid var(--b2)}
.sn{font-family:var(--mo);font-size:13px;font-weight:500}
.sok{color:var(--gr)}.slow{color:var(--am)}.snil{color:var(--r)}
.mp{display:inline-flex;align-items:center;gap:4px;font-size:11px;font-family:var(--mo);padding:3px 7px;border-radius:4px;background:var(--bg4);color:var(--t2);border:1px solid var(--b)}
.mp.pct{background:var(--bld);color:var(--bl);border-color:rgba(96,165,250,.15)}
.mp.nom{background:var(--amd);color:var(--am);border-color:rgba(245,158,11,.15)}

/* INLINE EDIT */
.ie{background:var(--bg4);border:1px solid var(--b3);color:var(--t);border-radius:var(--rx);padding:6px 9px;font-family:var(--mo);font-size:12.5px;outline:none;transition:border .15s;width:100%;min-width:80px}
.ie:focus{border-color:var(--g);box-shadow:0 0 0 2px var(--gd2)}
.ie-sm{min-width:60px}
.ies-row{display:flex;gap:5px;margin-top:5px}
.ib{padding:5px 10px;border-radius:var(--rx);font-family:var(--fn);font-size:12px;font-weight:600;cursor:pointer;border:none;transition:all .12s}
.ib-s{background:var(--g);color:#0a0a0c}
.ib-s:hover{background:var(--g2)}
.ib-c{background:var(--bg5);color:var(--t2);border:1px solid var(--b2)!important}

/* ROW ACTIONS */
.ra{display:flex;gap:5px;justify-content:flex-end;opacity:0;transition:opacity .15s}
tbody tr:hover .ra{opacity:1}
.rb{width:28px;height:28px;border:1px solid var(--b2);background:var(--bg4);color:var(--t2);border-radius:var(--rx);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .15s}
.rb svg{width:13px;height:13px}
.rb:hover{background:var(--bg5);color:var(--t);border-color:var(--b3)}
.rb.e:hover{border-color:rgba(200,162,74,.4);color:var(--g);background:var(--gd)}
.rb.d:hover{border-color:rgba(248,113,113,.3);color:var(--r);background:var(--rd)}
.rb.m:hover{border-color:rgba(96,165,250,.3);color:var(--bl);background:var(--bld)}
.rb.k:hover{border-color:rgba(62,207,142,.3);color:var(--gr);background:var(--grd)}

/* PAGINATION */
.pgbar{padding:10px 24px;border-top:1px solid var(--b);display:flex;align-items:center;gap:8px;flex-shrink:0;background:var(--bg2)}
.pg-i{font-size:12px;color:var(--t3);flex:1}
.pgl a,.pgl span{display:inline-flex;align-items:center;justify-content:center;min-width:30px;height:30px;padding:0 6px;border-radius:var(--rx);font-size:12px;font-family:var(--mo);text-decoration:none;color:var(--t2);background:var(--bg3);border:1px solid var(--b);transition:all .15s;margin-left:4px}
.pgl a:hover{background:var(--bg4);color:var(--t)}
.pgl span.active{background:var(--gd);color:var(--g);border-color:var(--gd3)}

/* PANEL */
.ov{position:fixed;inset:0;background:rgba(0,0,0,.55);z-index:50;opacity:0;pointer-events:none;transition:opacity .25s;backdrop-filter:blur(3px)}
.ov.open{opacity:1;pointer-events:all}
.panel{position:fixed;top:0;right:0;bottom:0;width:480px;background:var(--bg2);border-left:1px solid var(--b2);z-index:51;transform:translateX(100%);transition:transform .3s cubic-bezier(.4,0,.2,1);display:flex;flex-direction:column;box-shadow:var(--shl)}
.panel.open{transform:translateX(0)}
.ph{padding:20px 24px 18px;border-bottom:1px solid var(--b);display:flex;align-items:flex-start;gap:12px;flex-shrink:0}
.pi{width:36px;height:36px;border-radius:9px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.pi svg{width:18px;height:18px}
.pi-g{background:var(--gd);color:var(--g);border:1px solid var(--gd2)}
.pi-b{background:var(--bld);color:var(--bl);border:1px solid rgba(96,165,250,.2)}
.pi-gr{background:var(--grd);color:var(--gr);border:1px solid rgba(62,207,142,.2)}
.pt{font-size:15px;font-weight:500}
.ps{font-size:12px;color:var(--t3);margin-top:2px}
.pc{margin-left:auto;width:28px;height:28px;background:var(--bg4);border:1px solid var(--b2);color:var(--t2);border-radius:var(--rx);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .15s;flex-shrink:0}
.pc:hover{background:var(--bg5);color:var(--t)}
.pc svg{width:13px;height:13px}
.pb{flex:1;overflow-y:auto;padding:20px 24px}
.pb::-webkit-scrollbar{width:3px}
.pb::-webkit-scrollbar-thumb{background:var(--bg5);border-radius:2px}
.pf{padding:16px 24px;border-top:1px solid var(--b);display:flex;gap:10px;flex-shrink:0}
.pfb{flex:1;padding:11px;border-radius:var(--rs);font-family:var(--fn);font-size:13.5px;font-weight:600;cursor:pointer;transition:all .15s;display:flex;align-items:center;justify-content:center;gap:8px;border:none}
.pfb svg{width:15px;height:15px}
.pfc{background:var(--bg4);color:var(--t2);border:1px solid var(--b2)!important;font-weight:400;flex:.6}
.pfc:hover{background:var(--bg5);color:var(--t)}
.pfs{background:var(--g);color:#0a0a0c}
.pfs:hover{background:var(--g2)}

/* FORM in panel */
.fg{margin-bottom:16px}
.fg:last-child{margin-bottom:0}
.fl{font-size:11px;color:var(--t3);text-transform:uppercase;letter-spacing:.7px;font-weight:500;display:block;margin-bottom:7px}
.fi2{width:100%;background:var(--bg3);border:1px solid var(--b2);color:var(--t);border-radius:var(--rs);padding:10px 13px;font-family:var(--fn);font-size:13.5px;outline:none;transition:border .15s}
.fi2:focus{border-color:var(--g);box-shadow:0 0 0 2px var(--gd)}
.fi2::placeholder{color:var(--t3)}
.r2{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.tt{display:flex;border:1px solid var(--b2);border-radius:var(--rs);overflow:hidden}
.tto{flex:1;padding:9px 12px;text-align:center;font-size:12.5px;cursor:pointer;transition:all .15s;color:var(--t3);background:var(--bg3);border:none;font-family:var(--fn)}
.tto:hover{color:var(--t2);background:var(--bg4)}
.tto.on{background:var(--gd);color:var(--g);font-weight:500}
.tto+.tto{border-left:1px solid var(--b2)}

/* Section card in panel */
.scard{background:var(--bg3);border:1px solid var(--b);border-radius:var(--rr);padding:16px;margin-bottom:14px}
.scard-h{display:flex;align-items:center;gap:8px;margin-bottom:14px}
.scard-i{width:24px;height:24px;border-radius:6px;display:flex;align-items:center;justify-content:center}
.scard-i svg{width:13px;height:13px}
.si-g{background:var(--gd);color:var(--g)}
.si-b{background:var(--bld);color:var(--bl)}
.scard-t{font-size:12.5px;font-weight:500}

/* Preview box */
.pvb{background:var(--bg3);border:1px solid var(--b2);border-radius:var(--rs);padding:14px 16px;margin-top:12px}
.pvr{display:flex;justify-content:space-between;align-items:center;margin-bottom:7px}
.pvr:last-child{margin-bottom:0}
.pvl{font-size:11.5px;color:var(--t3)}
.pvv{font-family:var(--mo);font-size:14px;font-weight:500;color:var(--g);transition:color .2s}
.pvv.upd{color:var(--gr)}

/* Toast */
.toast{position:fixed;bottom:24px;right:24px;background:var(--bg3);border:1px solid var(--b2);border-radius:var(--rr);padding:12px 16px 12px 14px;display:flex;align-items:center;gap:10px;font-size:13.5px;transform:translateY(80px);opacity:0;transition:all .3s cubic-bezier(.34,1.56,.64,1);z-index:200;min-width:240px;box-shadow:var(--shl)}
.toast.show{transform:translateY(0);opacity:1}
.td{width:7px;height:7px;border-radius:50%;flex-shrink:0}
.toast.ok .td{background:var(--gr)}
.toast.err .td{background:var(--r)}

/* Confirm */
.conf-ov{position:fixed;inset:0;background:rgba(0,0,0,.65);z-index:100;display:none;align-items:center;justify-content:center;backdrop-filter:blur(4px)}
.conf-ov.open{display:flex}
.conf-box{background:var(--bg2);border:1px solid var(--b2);border-radius:16px;padding:28px;max-width:340px;width:90%;box-shadow:var(--shl)}
.conf-icon{width:44px;height:44px;background:var(--rd);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px}
.conf-icon svg{width:20px;height:20px;color:var(--r)}
.conf-t{font-size:15px;font-weight:500;text-align:center;margin-bottom:8px}
.conf-m{font-size:13px;color:var(--t2);text-align:center;margin-bottom:22px;line-height:1.6}
.conf-btns{display:flex;gap:10px}
.conf-btns button{flex:1;padding:10px;border-radius:var(--rs);font-family:var(--fn);font-size:13.5px;font-weight:500;cursor:pointer;transition:all .15s}
.cb-c{background:var(--bg4);color:var(--t2);border:1px solid var(--b2)!important}
.cb-c:hover{background:var(--bg5)}
.cb-d{background:var(--r);color:white;border:none;font-weight:600}
.cb-d:hover{background:#ef4444}

/* Spinner */
.spin{width:15px;height:15px;border:2px solid rgba(10,10,12,.25);border-top-color:#0a0a0c;border-radius:50%;animation:spn .6s linear infinite;display:inline-block}
@keyframes spn{to{transform:rotate(360deg)}}
@keyframes hl{0%,100%{background:transparent}50%{background:rgba(200,162,74,.08)}}
.hl{animation:hl .8s ease}

/* Empty */
.empty{text-align:center;padding:80px 0;color:var(--t3)}
.empty svg{width:48px;height:48px;opacity:.2;margin:0 auto 14px;display:block}
</style>
</head>
<body>
<div class="app">

<!-- SIDEBAR -->
<aside class="sb">
<div class="sb-logo"><div class="lm"><div class="li"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M3 3h7v7H3V3zm0 11h7v7H3v-7zm11-11h7v7h-7V3zm4 11h-1v3h-3v1h3v3h1v-3h3v-1h-3v-3z"/></svg></div><div><div class="lt">TOKO AJIB</div><div class="ls">Point of Sale</div></div></div></div>
<nav class="nav">
<div class="nl">Utama</div>
<a href="/dashboard" class="na"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="2" width="9" height="9" rx="2"/><rect x="13" y="2" width="9" height="9" rx="2"/><rect x="2" y="13" width="9" height="9" rx="2"/><rect x="13" y="13" width="9" height="9" rx="2"/></svg>Kasir</a>
<a href="/products" class="na on"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/></svg>Produk</a>
<a href="/transactions" class="na"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 12h6M9 16h4"/></svg>Transaksi</a>
<a href="/customers" class="na"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="8" cy="7" r="4"/><path d="M2 21v-2a4 4 0 014-4h4a4 4 0 014 4v2"/><path d="M19 8v6M22 11h-6"/></svg>Pelanggan</a>
<div class="nl">Sistem</div>
<a href="/import" class="na"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg>Import CSV</a>
</nav>
<div class="sb-ft"><div class="ur"><div class="av">{{ substr(auth()->user()->name??'A',0,1) }}</div><div><div class="un">{{ auth()->user()->name??'Admin' }}</div><div class="uro">Kasir</div></div></div></div>
</aside>

<!-- MAIN -->
<main class="main">

<!-- TOPBAR -->
<div class="topbar">
<div class="tb-title">Manajemen Produk</div>
<button class="tbtn bg" onclick="openPanel('bulk')">
<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
Update Margin Kategori
</button>
<button class="tbtn bgo" onclick="openPanel('add')">
<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
Tambah Produk
</button>
</div>

<!-- STATS -->
<div class="stats">
<div class="sc"><div class="sc-l">Total Produk</div><div class="sc-v g">{{ $products->total() }}</div><div class="sc-s">{{ $products->total() }} SKU terdaftar</div></div>
<div class="sc"><div class="sc-l">Stok Aman</div><div class="sc-v gr">{{ $products->getCollection()->where('stock','>',10)->count() }}</div><div class="sc-s">stok &gt; 10 unit</div></div>
<div class="sc"><div class="sc-l">Stok Menipis</div><div class="sc-v am">{{ $products->getCollection()->whereBetween('stock',[1,10])->count() }}</div><div class="sc-s">1 – 10 unit tersisa</div></div>
<div class="sc"><div class="sc-l">Stok Habis</div><div class="sc-v r">{{ $products->getCollection()->where('stock','<=',0)->count() }}</div><div class="sc-s">stok = 0</div></div>
</div>

<!-- FILTER -->
<form method="GET" action="/products">
<div class="fbar">
<input class="fi fi-s" type="text" name="search" placeholder="🔍  Cari nama produk..." value="{{ request('search') }}">
<select class="fi fi-c" name="category_id" onchange="this.form.submit()">
<option value="">Semua Kategori</option>
@foreach($categories as $cat)
<option value="{{ $cat->id }}" {{ request('category_id')==$cat->id?'selected':'' }}>{{ $cat->name }}</option>
@endforeach
</select>
<button type="submit" class="fbttn">Cari</button>
@if(request('search')||request('category_id'))
<a href="/products" style="font-size:12px;color:var(--t3);text-decoration:none;padding:4px 6px">✕ Reset</a>
@endif
<div style="flex:1"></div>
<span style="font-size:12px;color:var(--t3)">{{ $products->total() }} produk</span>
</div>
</form>

<!-- TABLE -->
<div class="tw">
@if($products->isEmpty())
<div class="empty"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/></svg><p style="font-size:14px;color:var(--t2)">Tidak ada produk ditemukan</p></div>
@else
<table>
<thead><tr>
<th style="width:200px">Nama Produk</th>
<th>Kategori</th>
<th>Harga Modal</th>
<th>Qty/Dus</th>
<th>Margin Dus</th>
<th>Harga Dus</th>
<th>Margin PCS</th>
<th>Harga PCS</th>
<th>Stok</th>
<th style="text-align:right;width:130px">Aksi</th>
</tr></thead>
<tbody id="tbody">
@foreach($products as $p)
<tr id="row-{{ $p->id }}" data-id="{{ $p->id }}">
<td><div class="cn">{{ $p->name }}</div></td>
<td><span class="cb">{{ $p->category->name??'—' }}</span></td>
<td>
  <div class="md-disp-{{ $p->id }}">
    <div class="cp" id="mv-{{ $p->id }}">Rp {{ number_format($p->harga_beli_dus,0,',','.') }}</div>
    <div class="cs">per dus</div>
  </div>
  <div class="md-edit-{{ $p->id }}" style="display:none">
    <input class="ie" type="number" id="mi-{{ $p->id }}" value="{{ $p->harga_beli_dus }}">
    <div class="ies-row"><button class="ib ib-s" onclick="saveModal({{ $p->id }})">Simpan</button><button class="ib ib-c" onclick="cancelME({{ $p->id }})">Batal</button></div>
  </div>
</td>
<td><span class="cm">{{ $p->qty_per_dus }}</span></td>
<td><span class="mp {{ $p->margin_dus_type=='percent'?'pct':'nom' }}" id="mdp-{{ $p->id }}">{{ $p->margin_dus }}{{ $p->margin_dus_type=='percent'?'%':' rp' }}</span></td>
<td><div class="cp" id="hd-{{ $p->id }}">Rp {{ number_format($p->harga_jual_dus,0,',','.') }}</div></td>
<td><span class="mp {{ $p->margin_pcs_type=='percent'?'pct':'nom' }}" id="mpp-{{ $p->id }}">{{ $p->margin_pcs }}{{ $p->margin_pcs_type=='percent'?'%':' rp' }}</span></td>
<td><div class="cp" id="hp-{{ $p->id }}">Rp {{ number_format($p->harga_jual_pcs,0,',','.') }}</div></td>
<td>
  <div class="sk-disp-{{ $p->id }}">
    <span class="sn {{ $p->stock>10?'sok':($p->stock>0?'slow':'snil') }}" id="sv-{{ $p->id }}">{{ $p->stock }}</span>
  </div>
  <div class="sk-edit-{{ $p->id }}" style="display:none">
    <input class="ie ie-sm" type="number" id="si-{{ $p->id }}" value="{{ $p->stock }}" min="0">
    <div class="ies-row"><button class="ib ib-s" onclick="saveStok({{ $p->id }})">OK</button><button class="ib ib-c" onclick="cancelSE({{ $p->id }})">✕</button></div>
  </div>
</td>
<td>
<div class="ra">
<button class="rb m" title="Edit Harga Modal" onclick="toggleME({{ $p->id }})"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg></button>
<button class="rb e" title="Update Margin" onclick="openMarginPanel({{ $p->id }},'{{ addslashes($p->name) }}',{{ $p->margin_dus }},'{{ $p->margin_dus_type }}',{{ $p->margin_pcs }},'{{ $p->margin_pcs_type }}',{{ $p->harga_beli_dus }},{{ $p->qty_per_dus }})"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L4.22 13.45l-1.06 3.77 3.77-1.06 8.84-8.84a5.5 5.5 0 000-7.71z"/></svg></button>
<button class="rb k" title="Update Stok" onclick="toggleSE({{ $p->id }})"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/></svg></button>
<button class="rb d" title="Hapus" onclick="confirmDel({{ $p->id }},'{{ addslashes($p->name) }}')"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg></button>
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
<div class="pg-i">Menampilkan {{ $products->firstItem()??0 }}–{{ $products->lastItem()??0 }} dari {{ $products->total() }} produk</div>
<div class="pgl">{{ $products->onEachSide(1)->links('pagination::simple-tailwind') }}</div>
</div>

</main>
</div>

<!-- ══ PANEL: TAMBAH PRODUK ══════════════════════════════ -->
<div class="ov" id="ov-add" onclick="closePanel('add')"></div>
<div class="panel" id="panel-add">
<div class="ph">
  <div class="pi pi-g"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 5v14M5 12h14"/></svg></div>
  <div><div class="pt">Tambah Produk Baru</div><div class="ps">Harga jual dihitung otomatis dari margin</div></div>
  <button class="pc" onclick="closePanel('add')"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg></button>
</div>
<div class="pb">

  <div class="scard">
    <div class="scard-h"><div class="scard-i si-g"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/></svg></div><span class="scard-t">Info Dasar</span></div>
    <div class="fg"><label class="fl">Nama Barang</label><input class="fi2" type="text" id="an" placeholder="Contoh: Indomie Goreng"></div>
    <div class="r2">
      <div class="fg"><label class="fl">Kategori</label>
        <select class="fi2" id="ac" onchange="loadCatMargins(this.value)">
          <option value="">— Pilih —</option>
          @foreach($categories as $cat)<option value="{{ $cat->id }}">{{ $cat->name }}</option>@endforeach
        </select>
      </div>
      <div class="fg"><label class="fl">Stok Awal</label><input class="fi2" style="font-family:var(--mo)" type="number" id="ask" value="0" min="0"></div>
    </div>
  </div>

  <div class="scard">
    <div class="scard-h"><div class="scard-i si-b"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg></div><span class="scard-t">Harga Modal</span></div>
    <div class="r2">
      <div class="fg"><label class="fl">Harga Beli / Dus</label><input class="fi2" style="font-family:var(--mo)" type="number" id="ahb" placeholder="48000" oninput="pvAdd()"></div>
      <div class="fg"><label class="fl">Qty per Dus (pcs)</label><input class="fi2" style="font-family:var(--mo)" type="number" id="aqt" value="1" min="1" oninput="pvAdd()"></div>
    </div>
  </div>

  <div class="scard">
    <div class="scard-h"><div class="scard-i si-g"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg></div><span class="scard-t">Margin &amp; Harga Jual</span></div>
    <div class="fg">
      <label class="fl">Margin Harga Dus</label>
      <div class="r2" style="align-items:flex-end;gap:8px">
        <input class="fi2" style="font-family:var(--mo)" type="number" id="amd" value="10" oninput="pvAdd()">
        <div class="tt">
          <button type="button" class="tto on" id="amd-p" onclick="setT('a','d','percent')">%</button>
          <button type="button" class="tto" id="amd-n" onclick="setT('a','d','nominal')">Rp</button>
        </div>
      </div>
    </div>
    <div class="fg">
      <label class="fl">Margin Harga PCS</label>
      <div class="r2" style="align-items:flex-end;gap:8px">
        <input class="fi2" style="font-family:var(--mo)" type="number" id="amp" value="15" oninput="pvAdd()">
        <div class="tt">
          <button type="button" class="tto on" id="amp-p" onclick="setT('a','p','percent')">%</button>
          <button type="button" class="tto" id="amp-n" onclick="setT('a','p','nominal')">Rp</button>
        </div>
      </div>
    </div>
    <div class="pvb">
      <div style="font-size:10.5px;color:var(--t3);text-transform:uppercase;letter-spacing:.7px;margin-bottom:10px;font-weight:500">Kalkulasi Harga Jual</div>
      <div class="pvr"><span class="pvl">Harga Jual Dus</span><span class="pvv" id="apd">Rp —</span></div>
      <div class="pvr"><span class="pvl">Harga Jual PCS</span><span class="pvv" id="app">Rp —</span></div>
      <div class="pvr" style="margin-top:8px;border-top:1px solid var(--b);padding-top:8px">
        <span style="font-size:10.5px;color:var(--t3)">Modal per PCS</span>
        <span style="font-family:var(--mo);font-size:12px;color:var(--t3)" id="apm">Rp —</span>
      </div>
    </div>
  </div>

</div>
<div class="pf">
  <button class="pfb pfc" onclick="closePanel('add')">Batal</button>
  <button class="pfb pfs" id="ab" onclick="submitAdd()">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>Simpan Produk
  </button>
</div>
</div>

<!-- ══ PANEL: UPDATE MARGIN ════════════════════════════ -->
<div class="ov" id="ov-margin" onclick="closePanel('margin')"></div>
<div class="panel" id="panel-margin">
<div class="ph">
  <div class="pi pi-g"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L4.22 13.45l-1.06 3.77 3.77-1.06 8.84-8.84a5.5 5.5 0 000-7.71z"/></svg></div>
  <div><div class="pt" id="mpt">Update Margin</div><div class="ps">Harga jual diperbarui otomatis</div></div>
  <button class="pc" onclick="closePanel('margin')"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg></button>
</div>
<input type="hidden" id="mpid">
<div class="pb">
  <div class="scard">
    <div class="scard-h"><div class="scard-i si-g"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg></div><span class="scard-t">Margin Harga Dus</span></div>
    <div class="r2" style="align-items:flex-end;gap:8px">
      <div class="fg" style="margin-bottom:0"><label class="fl">Nilai Margin</label><input class="fi2" style="font-family:var(--mo)" type="number" id="mmd" value="10" oninput="pvMargin()"></div>
      <div class="tt"><button type="button" class="tto on" id="mmd-p" onclick="setT('m','d','percent')">%</button><button type="button" class="tto" id="mmd-n" onclick="setT('m','d','nominal')">Rp</button></div>
    </div>
  </div>
  <div class="scard">
    <div class="scard-h"><div class="scard-i si-b"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg></div><span class="scard-t">Margin Harga PCS</span></div>
    <div class="r2" style="align-items:flex-end;gap:8px">
      <div class="fg" style="margin-bottom:0"><label class="fl">Nilai Margin</label><input class="fi2" style="font-family:var(--mo)" type="number" id="mmp" value="15" oninput="pvMargin()"></div>
      <div class="tt"><button type="button" class="tto on" id="mmp-p" onclick="setT('m','p','percent')">%</button><button type="button" class="tto" id="mmp-n" onclick="setT('m','p','nominal')">Rp</button></div>
    </div>
  </div>
  <div class="pvb">
    <div style="font-size:10.5px;color:var(--t3);text-transform:uppercase;letter-spacing:.7px;margin-bottom:10px;font-weight:500">Preview Setelah Update</div>
    <div class="pvr"><span class="pvl">Harga Jual Dus</span><span class="pvv" id="mpd">—</span></div>
    <div class="pvr"><span class="pvl">Harga Jual PCS</span><span class="pvv" id="mpp">—</span></div>
  </div>
</div>
<div class="pf">
  <button class="pfb pfc" onclick="closePanel('margin')">Batal</button>
  <button class="pfb pfs" id="mb" onclick="submitMargin()">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>Terapkan Margin
  </button>
</div>
</div>

<!-- ══ PANEL: BULK MARGIN ══════════════════════════════ -->
<div class="ov" id="ov-bulk" onclick="closePanel('bulk')"></div>
<div class="panel" id="panel-bulk">
<div class="ph">
  <div class="pi pi-gr"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg></div>
  <div><div class="pt">Update Margin per Kategori</div><div class="ps">Semua produk dalam kategori diperbarui</div></div>
  <button class="pc" onclick="closePanel('bulk')"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg></button>
</div>
<div class="pb">
  <div class="scard">
    <div class="fg"><label class="fl">Pilih Kategori</label>
      <select class="fi2" id="bc">
        <option value="">— Pilih Kategori —</option>
        @foreach($categories as $cat)<option value="{{ $cat->id }}">{{ $cat->name }}</option>@endforeach
      </select>
    </div>
  </div>
  <div class="scard">
    <div class="scard-h"><div class="scard-i si-g"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg></div><span class="scard-t">Margin Baru untuk Kategori</span></div>
    <div class="fg">
      <label class="fl">Margin Dus</label>
      <div class="r2" style="align-items:flex-end;gap:8px">
        <input class="fi2" style="font-family:var(--mo)" type="number" id="bmd" value="10">
        <div class="tt"><button type="button" class="tto on" id="bmd-p" onclick="setT('b','d','percent')">%</button><button type="button" class="tto" id="bmd-n" onclick="setT('b','d','nominal')">Rp</button></div>
      </div>
    </div>
    <div class="fg">
      <label class="fl">Margin PCS</label>
      <div class="r2" style="align-items:flex-end;gap:8px">
        <input class="fi2" style="font-family:var(--mo)" type="number" id="bmp" value="15">
        <div class="tt"><button type="button" class="tto on" id="bmp-p" onclick="setT('b','p','percent')">%</button><button type="button" class="tto" id="bmp-n" onclick="setT('b','p','nominal')">Rp</button></div>
      </div>
    </div>
  </div>
  <div style="background:var(--amd);border:1px solid rgba(245,158,11,.2);border-radius:var(--rs);padding:12px 14px;font-size:12.5px;color:var(--am);display:flex;gap:9px;align-items:flex-start">
    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:1px"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
    <span>Aksi ini memperbarui margin semua produk dalam kategori yang dipilih dan tidak bisa di-undo.</span>
  </div>
</div>
<div class="pf">
  <button class="pfb pfc" onclick="closePanel('bulk')">Batal</button>
  <button class="pfb pfs" id="bb" onclick="submitBulk()" style="background:var(--gr);color:#0a0a0c">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>Terapkan ke Semua
  </button>
</div>
</div>

<!-- ══ CONFIRM DELETE ═══════════════════════════════════ -->
<div class="conf-ov" id="cov">
<div class="conf-box">
  <div class="conf-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg></div>
  <div class="conf-t">Hapus Produk?</div>
  <div class="conf-m" id="cdm">Produk ini akan dihapus permanen.</div>
  <div class="conf-btns">
    <button class="cb-c" onclick="closeCov()">Batal</button>
    <button class="cb-d" id="cdb" onclick="execDel()">Hapus</button>
  </div>
</div>
</div>

<!-- TOAST -->
<div class="toast" id="toast"><div class="td"></div><span id="tm"></span></div>

<script>
const CSR='{{ csrf_token() }}';
const Rp=n=>'Rp '+new Intl.NumberFormat('id-ID').format(Math.round(n));
const T={a:{d:'percent',p:'percent'},m:{d:'percent',p:'percent'},b:{d:'percent',p:'percent'}};

function setT(px,wh,ty){
    T[px][wh]=ty;
    document.getElementById(`${px}m${wh}-p`).classList.toggle('on',ty==='percent');
    document.getElementById(`${px}m${wh}-n`).classList.toggle('on',ty==='nominal');
    if(px==='a')pvAdd();
    if(px==='m')pvMargin();
}

function openPanel(n){document.getElementById('ov-'+n).classList.add('open');document.getElementById('panel-'+n).classList.add('open');}
function closePanel(n){document.getElementById('ov-'+n).classList.remove('open');document.getElementById('panel-'+n).classList.remove('open');}

function calc(hbd,qty,md,mdt,mp,mpt){
    hbd=parseFloat(hbd)||0;qty=parseInt(qty)||1;md=parseFloat(md)||0;mp=parseFloat(mp)||0;
    const hd=mdt==='percent'?hbd*(1+md/100):hbd+md;
    const hbp=qty>0?hd/qty:0;
    const hpp=mpt==='percent'?hbp*(1+mp/100):hbp+mp;
    return{hd,hpp,hbp};
}

function pvAdd(){
    const{hd,hpp,hbp}=calc(g('ahb').value,g('aqt').value,g('amd').value,T.a.d,g('amp').value,T.a.p);
    g('apd').textContent=Rp(hd);g('app').textContent=Rp(hpp);g('apm').textContent=Rp(hbp);
}

let mCtx={};
function openMarginPanel(id,nm,md,mdt,mp,mpt,hbd,qty){
    mCtx={id,hbd,qty};
    g('mpid').value=id;g('mpt').textContent=nm;
    g('mmd').value=md;g('mmp').value=mp;
    setT('m','d',mdt);setT('m','p',mpt);
    pvMargin();openPanel('margin');
}
function pvMargin(){
    const{hd,hpp}=calc(mCtx.hbd,mCtx.qty,g('mmd').value,T.m.d,g('mmp').value,T.m.p);
    g('mpd').textContent=Rp(hd);g('mpp').textContent=Rp(hpp);
}

async function loadCatMargins(catId){
    if(!catId)return;
    try{const r=await fetch(`/products/category-margins/${catId}`);const d=await r.json();
    g('amd').value=d.margin_dus;g('amp').value=d.margin_pcs;
    setT('a','d',d.margin_dus_type);setT('a','p',d.margin_pcs_type);pvAdd();}catch(e){}
}

async function submitAdd(){
    const btn=g('ab');const nm=g('an').value.trim();const cat=g('ac').value;const hbd=g('ahb').value;const qty=g('aqt').value;
    if(!nm){toast('Nama barang wajib diisi','err');return;}
    if(!cat){toast('Pilih kategori','err');return;}
    if(!hbd||parseFloat(hbd)<=0){toast('Isi harga modal','err');return;}
    btn.disabled=true;btn.innerHTML='<div class="spin"></div> Menyimpan...';
    try{
        const r=await api('POST','/products',{name:nm,category_id:cat,harga_beli_dus:hbd,qty_per_dus:qty,margin_dus:g('amd').value,margin_dus_type:T.a.d,margin_pcs:g('amp').value,margin_pcs_type:T.a.p,stock:g('ask').value});
        if(r.status==='success'){closePanel('add');toast(r.message,'ok');setTimeout(()=>location.reload(),800);}
        else toast(r.message||'Gagal','err');
    }finally{btn.disabled=false;btn.innerHTML='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg> Simpan Produk';}
}

async function submitMargin(){
    const btn=g('mb');const id=g('mpid').value;
    btn.disabled=true;btn.innerHTML='<div class="spin"></div> Memproses...';
    try{
        const r=await api('POST',`/products/${id}/update-margin`,{margin_dus:g('mmd').value,margin_dus_type:T.m.d,margin_pcs:g('mmp').value,margin_pcs_type:T.m.p});
        if(r.status==='success'){
            updPrices(id,r.harga_jual_dus,r.harga_jual_pcs);
            updPills(id,g('mmd').value,T.m.d,g('mmp').value,T.m.p);
            closePanel('margin');toast(r.message,'ok');
        }
    }finally{btn.disabled=false;btn.innerHTML='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg> Terapkan Margin';}
}

async function submitBulk(){
    const catId=g('bc').value;
    if(!catId){toast('Pilih kategori dulu','err');return;}
    const btn=g('bb');btn.disabled=true;btn.innerHTML='<div class="spin"></div> Memproses...';
    try{
        const r=await api('POST','/products/update-margin-by-category',{category_id:catId,margin_dus:g('bmd').value,margin_dus_type:T.b.d,margin_pcs:g('bmp').value,margin_pcs_type:T.b.p});
        if(r.status==='success'){closePanel('bulk');toast(r.message,'ok');setTimeout(()=>location.reload(),1000);}
    }finally{btn.disabled=false;btn.innerHTML='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg> Terapkan ke Semua';}
}

// INLINE: HARGA MODAL
function toggleME(id){
    const disp=document.querySelector(`.md-disp-${id}`);const edit=document.querySelector(`.md-edit-${id}`);const row=g(`row-${id}`);
    if(edit.style.display==='none'){disp.style.display='none';edit.style.display='block';row.classList.add('editing');g(`mi-${id}`).focus();}
    else cancelME(id);
}
function cancelME(id){document.querySelector(`.md-disp-${id}`).style.display='block';document.querySelector(`.md-edit-${id}`).style.display='none';g(`row-${id}`).classList.remove('editing');}
async function saveModal(id){
    const val=g(`mi-${id}`).value;if(!val||parseFloat(val)<=0){toast('Harga tidak valid','err');return;}
    try{
        const r=await api('POST',`/products/${id}/update-modal`,{harga_beli_dus:val});
        if(r.status==='success'){
            g(`mv-${id}`).textContent=Rp(parseFloat(val));
            updPrices(id,r.harga_jual_dus,r.harga_jual_pcs);
            cancelME(id);hl(id);toast(r.message,'ok');
        }
    }catch(e){toast('Gagal menyimpan','err');}
}

// INLINE: STOK
function toggleSE(id){
    const disp=document.querySelector(`.sk-disp-${id}`);const edit=document.querySelector(`.sk-edit-${id}`);const row=g(`row-${id}`);
    if(edit.style.display==='none'){disp.style.display='none';edit.style.display='block';row.classList.add('editing');g(`si-${id}`).focus();}
    else cancelSE(id);
}
function cancelSE(id){document.querySelector(`.sk-disp-${id}`).style.display='block';document.querySelector(`.sk-edit-${id}`).style.display='none';g(`row-${id}`).classList.remove('editing');}
async function saveStok(id){
    const val=parseInt(g(`si-${id}`).value);if(isNaN(val)||val<0){toast('Stok tidak valid','err');return;}
    try{
        const r=await api('POST',`/products/${id}/update-stock`,{stock:val});
        if(r.status==='success'){
            const el=g(`sv-${id}`);el.textContent=val;el.className='sn '+(val>10?'sok':val>0?'slow':'snil');
            cancelSE(id);toast(r.message,'ok');
        }
    }catch(e){toast('Gagal menyimpan','err');}
}

// DELETE
let delId=null;
function confirmDel(id,nm){delId=id;g('cdm').textContent=`"${nm}" akan dihapus permanen.`;g('cov').classList.add('open');}
function closeCov(){g('cov').classList.remove('open');delId=null;}
async function execDel(){
    if(!delId)return;const btn=g('cdb');btn.disabled=true;btn.textContent='Menghapus...';
    try{
        const r=await api('DELETE',`/products/${delId}`,{});
        if(r.status==='success'){
            const row=g(`row-${delId}`);row.style.transition='opacity .3s,transform .3s';row.style.opacity='0';row.style.transform='translateX(20px)';
            setTimeout(()=>row.remove(),300);closeCov();toast(r.message,'ok');
        }
    }finally{btn.disabled=false;btn.textContent='Hapus';}
}

// HELPERS
function updPrices(id,hd,hp){
    const de=g(`hd-${id}`),pe=g(`hp-${id}`);
    if(de){de.textContent=Rp(hd);de.style.color='var(--gr)';setTimeout(()=>de.style.color='',1500);}
    if(pe){pe.textContent=Rp(hp);pe.style.color='var(--gr)';setTimeout(()=>pe.style.color='',1500);}
    hl(id);
}
function updPills(id,md,mdt,mp,mpt){
    const dp=g(`mdp-${id}`),pp=g(`mpp-${id}`);
    if(dp){dp.textContent=md+(mdt==='percent'?'%':' rp');dp.className='mp '+(mdt==='percent'?'pct':'nom');}
    if(pp){pp.textContent=mp+(mpt==='percent'?'%':' rp');pp.className='mp '+(mpt==='percent'?'pct':'nom');}
}
function hl(id){const r=g(`row-${id}`);if(r){r.classList.remove('hl');void r.offsetWidth;r.classList.add('hl');}}
function g(id){return document.getElementById(id);}
async function api(m,u,b){const r=await fetch(u,{method:m,headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSR},body:JSON.stringify(b)});return r.json();}
function toast(msg,type='ok'){const t=g('toast');g('tm').textContent=msg;t.className=`toast ${type} show`;clearTimeout(t._t);t._t=setTimeout(()=>t.classList.remove('show'),2800);}
document.addEventListener('keydown',e=>{if(e.key==='Escape'){['add','margin','bulk'].forEach(n=>closePanel(n));closeCov();}});
document.addEventListener('keydown',e=>{
    if(e.key!=='Enter')return;const t=e.target;
    if(t.id&&t.id.startsWith('mi-'))saveModal(t.id.replace('mi-',''));
    if(t.id&&t.id.startsWith('si-'))saveStok(t.id.replace('si-',''));
});
</script>
</body>
</html>
