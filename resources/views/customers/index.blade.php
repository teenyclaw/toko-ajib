<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Pelanggan — POS AJIB</title>
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
  --rr:12px;--rs:8px;--rx:6px;
  --fn:'DM Sans',sans-serif;--mo:'DM Mono',monospace;
  --shl:0 8px 40px rgba(0,0,0,.6)
}
html,body{height:100%;overflow:hidden}
body{font-family:var(--fn);background:var(--bg);color:var(--tx);font-size:14px;line-height:1.5;-webkit-font-smoothing:antialiased}
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
.btn{display:inline-flex;align-items:center;gap:6px;padding:7px 13px;border-radius:var(--rs);font-family:var(--fn);font-size:12.5px;font-weight:600;cursor:pointer;transition:all .14s;white-space:nowrap;border:none}
.btn svg{width:13px;height:13px}
.btn-gold{background:var(--go);color:#09090b}
.btn-gold:hover{background:var(--go2)}
.stats{display:grid;grid-template-columns:repeat(4,1fr);gap:10px;padding:14px 22px;border-bottom:1px solid var(--bd);flex-shrink:0}
.stat{background:var(--bg2);border:1px solid var(--bd);border-radius:var(--rr);padding:12px 14px}
.stat-l{font-size:10px;color:var(--tx3);text-transform:uppercase;letter-spacing:.8px;font-weight:500;margin-bottom:5px}
.stat-v{font-size:20px;font-weight:600;font-family:var(--mo);letter-spacing:-.5px}
.sv-go{color:var(--go)}.sv-gn{color:var(--gn)}.sv-rd{color:var(--rd)}.sv-am{color:var(--am)}
.stat-s{font-size:10.5px;color:var(--tx3);margin-top:2px}
.fbar{padding:10px 22px;border-bottom:1px solid var(--bd);display:flex;align-items:center;gap:8px;flex-shrink:0}
.fi{background:var(--bg3);border:1px solid var(--bd2);color:var(--tx);border-radius:var(--rs);padding:7px 11px;font-family:var(--fn);font-size:13px;outline:none;transition:border .14s}
.fi:focus{border-color:var(--go)}
.fi::placeholder{color:var(--tx3)}
.tw{flex:1;overflow-y:auto;min-height:0}
.tw::-webkit-scrollbar{width:4px}
.tw::-webkit-scrollbar-thumb{background:var(--bg5);border-radius:2px}
table{width:100%;border-collapse:collapse}
thead{position:sticky;top:0;z-index:9;background:var(--bg2)}
thead th{font-size:10px;color:var(--tx3);text-transform:uppercase;letter-spacing:.8px;font-weight:500;padding:9px 14px;text-align:left;border-bottom:1px solid var(--bd);white-space:nowrap}
thead th:last-child{text-align:right}
tbody tr{border-bottom:1px solid var(--bd);transition:background .1s;cursor:pointer}
tbody tr:hover{background:rgba(255,255,255,.018)}
tbody td{padding:11px 14px;vertical-align:middle;font-size:12.5px;color:var(--tx2)}
.c-av{width:32px;height:32px;border-radius:50%;background:var(--gd);border:1px solid var(--gd2);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:600;color:var(--go);flex-shrink:0}
.c-av.debt{background:var(--rdd);border-color:rgba(248,113,113,.25);color:var(--rd)}
.c-nm-wrap{display:flex;align-items:center;gap:8px}
.c-nm{font-size:13px;font-weight:500;color:var(--tx)}
.c-ph{font-family:var(--mo);font-size:12px;color:var(--tx3)}
.c-addr{font-size:11.5px;color:var(--tx3);max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.db-badge{display:inline-flex;align-items:center;gap:4px;font-size:10.5px;padding:3px 8px;border-radius:20px;font-weight:500}
.db-red{background:var(--rdd);color:var(--rd);border:1px solid rgba(248,113,113,.2)}
.db-ok{background:var(--gnd);color:var(--gn);border:1px solid rgba(62,207,142,.18)}
.debt-amount{font-family:var(--mo);font-size:12.5px;color:var(--rd);font-weight:500}
.ra{display:flex;gap:4px;justify-content:flex-end;opacity:0;transition:opacity .14s}
tbody tr:hover .ra{opacity:1}
.rb{width:26px;height:26px;border:1px solid var(--bd2);background:var(--bg4);color:var(--tx2);border-radius:var(--rx);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .14s}
.rb svg{width:12px;height:12px}
.rb:hover{background:var(--bg5);color:var(--tx);border-color:var(--bd3)}
.rb.rg:hover{border-color:rgba(201,164,78,.4);color:var(--go);background:var(--gd)}
.rb.rd:hover{border-color:rgba(248,113,113,.3);color:var(--rd);background:var(--rdd)}
.rb.rbl:hover{border-color:rgba(96,165,250,.3);color:var(--bl);background:var(--bld)}
.empty{text-align:center;padding:64px 0}
.empty svg{width:44px;height:44px;opacity:.14;margin:0 auto 12px;display:block}
.ov{position:fixed;inset:0;background:rgba(0,0,0,.6);z-index:40;opacity:0;pointer-events:none;transition:opacity .24s;backdrop-filter:blur(3px)}
.ov.on{opacity:1;pointer-events:all}
.panel{position:fixed;top:0;right:0;bottom:0;width:460px;background:var(--bg2);border-left:1px solid var(--bd2);z-index:41;transform:translateX(100%);transition:transform .28s cubic-bezier(.4,0,.2,1);display:flex;flex-direction:column;box-shadow:var(--shl)}
.panel.on{transform:translateX(0)}
.panel.wide{width:520px}
.p-head{padding:18px 22px 16px;border-bottom:1px solid var(--bd);display:flex;align-items:flex-start;gap:11px;flex-shrink:0}
.p-ico{width:34px;height:34px;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.p-ico svg{width:17px;height:17px}
.pi-go{background:var(--gd);color:var(--go);border:1px solid var(--gd2)}
.pi-bl{background:var(--bld);color:var(--bl);border:1px solid rgba(96,165,250,.2)}
.p-ttl{font-size:14.5px;font-weight:500}
.p-sub{font-size:11.5px;color:var(--tx3);margin-top:2px}
.p-cls{margin-left:auto;width:26px;height:26px;background:var(--bg4);border:1px solid var(--bd2);color:var(--tx2);border-radius:var(--rx);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .14s;flex-shrink:0}
.p-cls:hover{background:var(--bg5);color:var(--tx)}
.p-cls svg{width:12px;height:12px}
.p-body{flex:1;overflow-y:auto;padding:18px 22px}
.p-body::-webkit-scrollbar{width:3px}
.p-body::-webkit-scrollbar-thumb{background:var(--bg5);border-radius:2px}
.p-foot{padding:14px 22px;border-top:1px solid var(--bd);display:flex;gap:8px;flex-shrink:0}
.pf-btn{flex:1;padding:10px;border-radius:var(--rs);font-family:var(--fn);font-size:13px;font-weight:600;cursor:pointer;transition:all .14s;display:flex;align-items:center;justify-content:center;gap:7px;border:none}
.pf-btn svg{width:14px;height:14px}
.pf-cancel{background:var(--bg4);color:var(--tx2);border:1px solid var(--bd2)!important;font-weight:400;flex:.5}
.pf-cancel:hover{background:var(--bg5);color:var(--tx)}
.pf-save{background:var(--go);color:#09090b}
.pf-save:hover{background:var(--go2)}
.pf-save:disabled{background:var(--bg4);color:var(--tx3);cursor:not-allowed}
.fg{margin-bottom:14px}
.fg:last-child{margin-bottom:0}
.fl{font-size:10.5px;color:var(--tx3);text-transform:uppercase;letter-spacing:.7px;font-weight:500;display:block;margin-bottom:6px}
.fi2{width:100%;background:var(--bg3);border:1px solid var(--bd2);color:var(--tx);border-radius:var(--rs);padding:9px 12px;font-family:var(--fn);font-size:13px;outline:none;transition:border .14s}
.fi2:focus{border-color:var(--go);box-shadow:0 0 0 2px var(--gd)}
.fi2::placeholder{color:var(--tx3)}
.sc{background:var(--bg3);border:1px solid var(--bd);border-radius:var(--rr);padding:14px;margin-bottom:12px}
.sc:last-child{margin-bottom:0}
.debt-banner{background:linear-gradient(135deg,rgba(248,113,113,.08),rgba(248,113,113,.03));border:1px solid rgba(248,113,113,.2);border-radius:var(--rs);padding:12px 14px;display:flex;align-items:center;gap:12px;margin-bottom:14px}
.db-icon{width:34px;height:34px;background:var(--rdd);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.db-icon svg{width:17px;height:17px;color:var(--rd)}
.db-label{font-size:11px;color:var(--tx3);margin-bottom:2px}
.db-value{font-family:var(--mo);font-size:18px;font-weight:600;color:var(--rd);letter-spacing:-.5px}
.cp-row{display:flex;align-items:center;gap:12px;padding:14px;background:var(--bg3);border:1px solid var(--bd);border-radius:var(--rr);margin-bottom:14px}
.cp-av{width:42px;height:42px;border-radius:50%;background:var(--gd);border:2px solid var(--gd2);display:flex;align-items:center;justify-content:center;font-size:16px;font-weight:700;color:var(--go);flex-shrink:0}
.cp-av.hd{background:var(--rdd);border-color:rgba(248,113,113,.3);color:var(--rd)}
.cp-name{font-size:15px;font-weight:600;color:var(--tx)}
.cp-phone{font-size:12px;color:var(--tx3);font-family:var(--mo);margin-top:2px}
.cp-meta{flex:1}
.debt-card{background:var(--bg2);border:1px solid var(--bd2);border-radius:var(--rs);padding:13px 14px;margin-bottom:8px}
.debt-card:last-child{margin-bottom:0}
.debt-card.paid-card{opacity:.5}
.dc-top{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:8px}
.dc-inv{font-family:var(--mo);font-size:11.5px;color:var(--go);font-weight:500}
.dc-date{font-size:10.5px;color:var(--tx3)}
.dc-amounts{display:grid;grid-template-columns:1fr 1fr 1fr;gap:8px;margin-bottom:10px}
.dca{text-align:center;padding:8px;background:var(--bg3);border-radius:var(--rx)}
.dca-l{font-size:9.5px;color:var(--tx3);text-transform:uppercase;letter-spacing:.6px;margin-bottom:3px}
.dca-v{font-family:var(--mo);font-size:13px;font-weight:500}
.dca-v.rd{color:var(--rd)}.dca-v.gn{color:var(--gn)}.dca-v.am{color:var(--am)}
.debt-note-box{background:var(--bg4);border:1px solid var(--bd2);border-radius:var(--rx);padding:8px 10px;font-size:12px;color:var(--tx2);line-height:1.5;margin-bottom:8px;display:flex;gap:7px;align-items:flex-start}
.debt-note-box svg{width:13px;height:13px;color:var(--am);flex-shrink:0;margin-top:1px}
.pay-bar{display:flex;gap:6px;align-items:center}
.pay-inp{flex:1;background:var(--bg4);border:1px solid var(--bd2);color:var(--tx);border-radius:var(--rx);padding:6px 9px;font-family:var(--mo);font-size:12.5px;outline:none;transition:border .14s}
.pay-inp:focus{border-color:var(--gn)}
.pay-btn{background:var(--gn);color:#09090b;border:none;border-radius:var(--rx);padding:6px 12px;font-size:12px;font-weight:600;font-family:var(--fn);cursor:pointer;transition:all .14s}
.pay-btn:hover{background:#34d87e}
.note-toggle{background:transparent;border:1px solid var(--bd2);color:var(--tx3);border-radius:var(--rx);padding:5px 9px;font-size:11px;font-family:var(--fn);cursor:pointer;transition:all .14s}
.note-toggle:hover{color:var(--tx);border-color:var(--bd3)}
.note-wrap{margin-top:8px;display:none}
.note-wrap.show{display:block}
.note-ta{width:100%;background:var(--bg4);border:1px solid var(--bd2);color:var(--tx);border-radius:var(--rx);padding:8px 10px;font-family:var(--fn);font-size:12.5px;outline:none;resize:vertical;min-height:60px;transition:border .14s}
.note-ta:focus{border-color:var(--go)}
.note-save-btn{margin-top:5px;background:var(--go);color:#09090b;border:none;border-radius:var(--rx);padding:5px 12px;font-size:12px;font-weight:600;font-family:var(--fn);cursor:pointer}
.sb2{display:inline-flex;align-items:center;gap:4px;font-size:10px;padding:2px 7px;border-radius:20px;font-weight:500}
.sb-unpaid{background:var(--rdd);color:var(--rd);border:1px solid rgba(248,113,113,.2)}
.sb-partial{background:var(--amd);color:var(--am);border:1px solid rgba(245,158,11,.2)}
.sb-paid{background:var(--gnd);color:var(--gn);border:1px solid rgba(62,207,142,.2)}
.no-debt{text-align:center;padding:24px 0;color:var(--tx3)}
.conf{position:fixed;inset:0;background:rgba(0,0,0,.65);z-index:60;display:none;align-items:center;justify-content:center;backdrop-filter:blur(4px)}
.conf.on{display:flex}
.conf-box{background:var(--bg2);border:1px solid var(--bd2);border-radius:14px;padding:26px;max-width:320px;width:90%;box-shadow:var(--shl)}
.conf-ico{width:42px;height:42px;background:var(--rdd);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 14px}
.conf-ico svg{width:19px;height:19px;color:var(--rd)}
.conf-ttl{font-size:14.5px;font-weight:500;text-align:center;margin-bottom:7px}
.conf-msg{font-size:12.5px;color:var(--tx2);text-align:center;margin-bottom:20px;line-height:1.6}
.conf-btns{display:flex;gap:8px}
.conf-btns button{flex:1;padding:9px;border-radius:var(--rs);font-family:var(--fn);font-size:13px;font-weight:500;cursor:pointer;transition:all .14s}
.c-no{background:var(--bg4);color:var(--tx2);border:1px solid var(--bd2)!important}
.c-no:hover{background:var(--bg5)}
.c-yes{background:var(--rd);color:#fff;border:none;font-weight:600}
.c-yes:hover{background:#ef4444}
.toast{position:fixed;bottom:22px;right:22px;background:var(--bg3);border:1px solid var(--bd2);border-radius:var(--rr);padding:11px 15px 11px 13px;display:flex;align-items:center;gap:9px;font-size:13px;transform:translateY(70px);opacity:0;transition:all .28s cubic-bezier(.34,1.56,.64,1);z-index:200;min-width:230px;box-shadow:var(--shl)}
.toast.on{transform:translateY(0);opacity:1}
.t-dot{width:6px;height:6px;border-radius:50%;flex-shrink:0}
.toast.ok .t-dot{background:var(--gn)}
.toast.err .t-dot{background:var(--rd)}
.toast.info .t-dot{background:var(--am)}
.spin{width:14px;height:14px;border:2px solid rgba(9,9,11,.25);border-top-color:#09090b;border-radius:50%;animation:sp .55s linear infinite;display:inline-block}
@keyframes sp{to{transform:rotate(360deg)}}
@keyframes hl{0%,100%{background:transparent}40%{background:rgba(201,164,78,.06)}}
.hl{animation:hl .7s ease}
</style>
</head>
<body>
<div class="app">
<aside class="sb">
<div class="sb-logo"><div class="logo"><div class="logo-ico"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M3 3h7v7H3V3zm0 11h7v7H3v-7zm11-11h7v7h-7V3zm4 11h-1v3h-3v1h3v3h1v-3h3v-1h-3v-3z"/></svg></div><div><div class="logo-name">TOKO AJIB</div><div class="logo-tag">Point of Sale</div></div></div></div>
<nav class="nav">
  <div class="nav-sec">Utama</div>
  <a href="/dashboard" class="nav-a"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="2" width="9" height="9" rx="2"/><rect x="13" y="2" width="9" height="9" rx="2"/><rect x="2" y="13" width="9" height="9" rx="2"/><rect x="13" y="13" width="9" height="9" rx="2"/></svg>Kasir</a>
  <a href="/products" class="nav-a"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/></svg>Produk</a>
  <a href="/transactions" class="nav-a"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 12h6M9 16h4"/></svg>Transaksi</a>
  <a href="/customers" class="nav-a on"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="8" cy="7" r="4"/><path d="M2 21v-2a4 4 0 014-4h4a4 4 0 014 4v2"/><path d="M19 8v6M22 11h-6"/></svg>Pelanggan</a>
  <a href="/nonmember" class="nav-a"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/><line x1="18" y1="8" x2="23" y2="13"/><line x1="23" y1="8" x2="18" y2="13"/></svg>Harga Non-Member</a>
  <div class="nav-sec">Sistem</div>
  <a href="/import" class="nav-a"><svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg>Import CSV</a>
</nav>
<div class="sb-foot"><div class="u-row"><div class="uav">{{ substr(auth()->user()->name??'A',0,1) }}</div><div><div class="u-nm">{{ auth()->user()->name??'Admin' }}</div><div class="u-rl">Admin</div></div></div></div>
</aside>

<main class="main">
<div class="topbar">
  <div class="tb-ttl">Manajemen Pelanggan</div>
  <button class="btn btn-gold" onclick="openAddPanel()">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>Tambah Pelanggan
  </button>
</div>

@php
  $total   = $customers->count();
  $withDebt= $customers->where('total_debt','>',0)->count();
  $totalDbt= $customers->sum('total_debt');
  $clean   = $total - $withDebt;
@endphp
<div class="stats">
  <div class="stat"><div class="stat-l">Total Pelanggan</div><div class="stat-v sv-go">{{ $total }}</div><div class="stat-s">terdaftar</div></div>
  <div class="stat"><div class="stat-l">Ada Piutang</div><div class="stat-v sv-rd">{{ $withDebt }}</div><div class="stat-s">pelanggan</div></div>
  <div class="stat"><div class="stat-l">Total Piutang</div><div class="stat-v sv-am" style="font-size:15px">{{ number_format($totalDbt,0,',','.') }}</div><div class="stat-s">Rp belum terbayar</div></div>
  <div class="stat"><div class="stat-l">Lunas</div><div class="stat-v sv-gn">{{ $clean }}</div><div class="stat-s">tidak ada utang</div></div>
</div>

<form method="GET" action="/customers" id="sf">
<div class="fbar">
  <input class="fi" style="flex:1;max-width:280px" type="text" name="search" id="si"
    placeholder="🔍  Cari nama atau nomor HP..." value="{{ request('search') }}"
    oninput="clearTimeout(window._st);window._st=setTimeout(()=>document.getElementById('sf').submit(),500)">
  <div style="flex:1"></div>
  <span style="font-size:11.5px;color:var(--tx3)">{{ $total }} pelanggan</span>
</div>
</form>

<div class="tw">
@if($customers->isEmpty())
<div class="empty">
  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><circle cx="8" cy="7" r="4"/><path d="M2 21v-2a4 4 0 014-4h4a4 4 0 014 4v2"/><path d="M19 8v6M22 11h-6"/></svg>
  <p style="font-size:13.5px;color:var(--tx2)">Belum ada pelanggan</p>
</div>
@else
<table>
<thead><tr><th>Nama</th><th>No. HP</th><th>Alamat</th><th>Status</th><th>Total Piutang</th><th style="text-align:right">Aksi</th></tr></thead>
<tbody id="tbody">
@foreach($customers as $c)
@php $hd = $c->total_debt > 0; @endphp
<tr id="row-{{ $c->id }}" onclick="openDetail({{ $c->id }})">
  <td><div class="c-nm-wrap"><div class="c-av {{ $hd?'debt':'' }}">{{ strtoupper(substr($c->name,0,1)) }}</div><span class="c-nm">{{ $c->name }}</span></div></td>
  <td><span class="c-ph">{{ $c->phone ?: '—' }}</span></td>
  <td><span class="c-addr">{{ $c->address ?? '—' }}</span></td>
  <td>@if($hd)<span class="db-badge db-red"><span style="width:5px;height:5px;border-radius:50%;background:var(--rd);display:inline-block"></span>Ada Utang</span>@else<span class="db-badge db-ok"><span style="width:5px;height:5px;border-radius:50%;background:var(--gn);display:inline-block"></span>Lunas</span>@endif</td>
  <td>@if($hd)<span class="debt-amount">Rp {{ number_format($c->total_debt,0,',','.') }}</span>@else<span style="color:var(--tx3);font-size:12px">—</span>@endif</td>
  <td onclick="event.stopPropagation()">
    <div class="ra">
      <button class="rb rbl" onclick="openDetail({{ $c->id }})"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></button>
      <button class="rb rg" onclick="openEditPanel({{ $c->id }},{{ json_encode($c->name) }},{{ json_encode($c->phone??'') }},{{ json_encode($c->address??'') }})"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L4.22 13.45l-1.06 3.77 3.77-1.06 8.84-8.84a5.5 5.5 0 000-7.71z"/></svg></button>
      <button class="rb rd" onclick="askDelete({{ $c->id }},{{ json_encode($c->name) }},{{ $hd?'true':'false' }})"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg></button>
    </div>
  </td>
</tr>
@endforeach
</tbody>
</table>
@endif
</div>
</main>
</div>

<!-- PANEL TAMBAH -->
<div class="ov" id="ov-add" onclick="closePanel('add')"></div>
<div class="panel" id="panel-add">
  <div class="p-head">
    <div class="p-ico pi-go"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="8" cy="7" r="4"/><path d="M2 21v-2a4 4 0 014-4h4a4 4 0 014 4v2"/><path d="M19 8v6M22 11h-6"/></svg></div>
    <div><div class="p-ttl">Tambah Pelanggan</div><div class="p-sub">Isi informasi pelanggan baru</div></div>
    <button class="p-cls" onclick="closePanel('add')"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg></button>
  </div>
  <div class="p-body">
    <div class="sc">
      <div class="fg"><label class="fl">Nama Lengkap <span style="color:var(--rd)">*</span></label><input class="fi2" type="text" id="a-name" placeholder="Contoh: Budi Santoso"></div>
      <div class="fg"><label class="fl">Nomor HP</label><input class="fi2" style="font-family:var(--mo)" type="text" id="a-phone" placeholder="08xx-xxxx-xxxx"></div>
      <div class="fg"><label class="fl">Alamat</label><textarea class="fi2" id="a-addr" rows="3" style="resize:vertical;min-height:72px" placeholder="Alamat lengkap (opsional)"></textarea></div>
    </div>
  </div>
  <div class="p-foot">
    <button class="pf-btn pf-cancel" onclick="closePanel('add')">Batal</button>
    <button class="pf-btn pf-save" id="a-btn" onclick="submitAdd()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>Simpan Pelanggan
    </button>
  </div>
</div>

<!-- PANEL EDIT -->
<div class="ov" id="ov-edit" onclick="closePanel('edit')"></div>
<div class="panel" id="panel-edit">
  <div class="p-head">
    <div class="p-ico pi-go"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L4.22 13.45l-1.06 3.77 3.77-1.06 8.84-8.84a5.5 5.5 0 000-7.71z"/></svg></div>
    <div><div class="p-ttl" id="e-ttl">Edit Pelanggan</div><div class="p-sub">Perbarui data</div></div>
    <button class="p-cls" onclick="closePanel('edit')"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg></button>
  </div>
  <input type="hidden" id="e-id">
  <div class="p-body">
    <div class="sc">
      <div class="fg"><label class="fl">Nama Lengkap <span style="color:var(--rd)">*</span></label><input class="fi2" type="text" id="e-name"></div>
      <div class="fg"><label class="fl">Nomor HP</label><input class="fi2" style="font-family:var(--mo)" type="text" id="e-phone"></div>
      <div class="fg"><label class="fl">Alamat</label><textarea class="fi2" id="e-addr" rows="3" style="resize:vertical;min-height:72px"></textarea></div>
    </div>
  </div>
  <div class="p-foot">
    <button class="pf-btn pf-cancel" onclick="closePanel('edit')">Batal</button>
    <button class="pf-btn pf-save" id="e-btn" onclick="submitEdit()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>Simpan Perubahan
    </button>
  </div>
</div>

<!-- PANEL DETAIL -->
<div class="ov" id="ov-detail" onclick="closePanel('detail')"></div>
<div class="panel wide" id="panel-detail">
  <div class="p-head">
    <div class="p-ico pi-bl"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="8" cy="7" r="4"/><path d="M2 21v-2a4 4 0 014-4h4a4 4 0 014 4v2"/></svg></div>
    <div><div class="p-ttl" id="d-ttl">Detail Pelanggan</div><div class="p-sub" id="d-sub">Riwayat utang</div></div>
    <button class="p-cls" onclick="closePanel('detail')"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg></button>
  </div>
  <div class="p-body" id="detail-body"><div style="text-align:center;padding:40px 0;color:var(--tx3)">Memuat...</div></div>
  <div class="p-foot">
    <button class="pf-btn pf-cancel" onclick="closePanel('detail')">Tutup</button>
    <button class="pf-btn pf-save" style="flex:.55" onclick="switchToEdit()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L4.22 13.45l-1.06 3.77 3.77-1.06 8.84-8.84a5.5 5.5 0 000-7.71z"/></svg>Edit Data
    </button>
  </div>
</div>

<!-- CONFIRM -->
<div class="conf" id="conf">
  <div class="conf-box">
    <div class="conf-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg></div>
    <div class="conf-ttl">Hapus Pelanggan?</div>
    <div class="conf-msg" id="conf-msg">Pelanggan ini akan dihapus permanen.</div>
    <div class="conf-btns">
      <button class="c-no" onclick="closeConf()">Batal</button>
      <button class="c-yes" id="conf-yes" onclick="execDelete()">Hapus</button>
    </div>
  </div>
</div>

<div class="toast" id="toast"><div class="t-dot"></div><span id="t-msg"></span></div>

<script>
// ─── CSRF: baca dari meta tag — solusi paling reliable ───
const CSRF = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
const Rp   = n => 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.round(n));
const g    = id => document.getElementById(id);
let currentId = null;

// Semua fetch pakai fungsi ini — header sudah lengkap
async function post(url, data) {
    const r = await fetch(url, {
        method:  'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept':       'application/json',
            'X-CSRF-TOKEN': CSRF,
        },
        body: JSON.stringify(data),
    });
    if (r.status === 419) {
        // CSRF expired — refresh token otomatis
        await refreshCsrf();
        return post(url, data); // retry sekali
    }
    return r.json();
}

async function del(url) {
    const r = await fetch(url, {
        method:  'DELETE',
        headers: { 'Accept':'application/json', 'X-CSRF-TOKEN': CSRF },
    });
    if (r.status === 419) { await refreshCsrf(); return del(url); }
    return r.json();
}

async function get(url) {
    const r = await fetch(url, {
        headers: { 'Accept':'application/json', 'X-CSRF-TOKEN': CSRF },
    });
    return r.json();
}

// Auto-refresh CSRF token jika expired
async function refreshCsrf() {
    try {
        const r = await fetch('/sanctum/csrf-cookie');
        const newToken = document.querySelector('meta[name="csrf-token"]')?.content;
        if (newToken) CSRF = newToken; // update
    } catch(e) {}
}

// PANEL
function openPanel(n) { g('ov-'+n).classList.add('on'); g('panel-'+n).classList.add('on'); }
function closePanel(n) { g('ov-'+n).classList.remove('on'); g('panel-'+n).classList.remove('on'); }

// ADD
function openAddPanel() {
    ['a-name','a-phone','a-addr'].forEach(id => g(id).value='');
    resetBtn('a-btn', '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="14" height="14"><path d="M12 5v14M5 12h14"/></svg>Simpan Pelanggan');
    openPanel('add');
    setTimeout(() => g('a-name').focus(), 300);
}

async function submitAdd() {
    const name = g('a-name').value.trim();
    if (!name) { showToast('Nama wajib diisi', 'err'); g('a-name').focus(); return; }
    loadBtn('a-btn');
    try {
        const r = await post('/customers', { name, phone: g('a-phone').value.trim(), address: g('a-addr').value.trim() });
        if (r.status === 'success') {
            closePanel('add');
            showToast(r.message || 'Pelanggan ditambahkan', 'ok');
            appendRow(r.customer);
        } else {
            const msg = r.message || (r.errors ? Object.values(r.errors).flat().join(', ') : 'Gagal');
            showToast(msg, 'err');
        }
    } catch(e) { showToast('Gagal terhubung ke server', 'err'); console.error(e); }
    finally { resetBtn('a-btn', '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="14" height="14"><path d="M12 5v14M5 12h14"/></svg>Simpan Pelanggan'); }
}

function appendRow(c) {
    const tbody = g('tbody');
    if (!tbody) { location.reload(); return; }
    document.querySelector('.empty') && (document.querySelector('.empty').style.display='none');
    const tr = document.createElement('tr');
    tr.id = 'row-'+c.id;
    tr.onclick = () => openDetail(c.id);
    tr.innerHTML = `
      <td><div class="c-nm-wrap"><div class="c-av">${esc(c.name).charAt(0).toUpperCase()}</div><span class="c-nm">${esc(c.name)}</span></div></td>
      <td><span class="c-ph">${esc(c.phone||'—')}</span></td>
      <td><span class="c-addr">${esc(c.address||'—')}</span></td>
      <td><span class="db-badge db-ok"><span style="width:5px;height:5px;border-radius:50%;background:var(--gn);display:inline-block"></span>Lunas</span></td>
      <td><span style="color:var(--tx3);font-size:12px">—</span></td>
      <td onclick="event.stopPropagation()"><div class="ra">
        <button class="rb rbl" onclick="openDetail(${c.id})"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></button>
        <button class="rb rg" onclick="openEditPanel(${c.id},${JSON.stringify(c.name)},${JSON.stringify(c.phone||'')},${JSON.stringify(c.address||'')})"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L4.22 13.45l-1.06 3.77 3.77-1.06 8.84-8.84a5.5 5.5 0 000-7.71z"/></svg></button>
        <button class="rb rd" onclick="askDelete(${c.id},${JSON.stringify(c.name)},false)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg></button>
      </div></td>`;
    tbody.insertBefore(tr, tbody.firstChild);
    tr.classList.add('hl'); setTimeout(()=>tr.classList.remove('hl'),800);
}

// EDIT
function openEditPanel(id, name, phone, address) {
    currentId = id;
    g('e-id').value=id; g('e-ttl').textContent='Edit: '+name;
    g('e-name').value=name; g('e-phone').value=phone||''; g('e-addr').value=address||'';
    resetBtn('e-btn','<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="14" height="14"><path d="M20 6L9 17l-5-5"/></svg>Simpan Perubahan');
    openPanel('edit');
    setTimeout(()=>g('e-name').focus(),300);
}
async function submitEdit() {
    const id=g('e-id').value; const name=g('e-name').value.trim();
    if (!name) { showToast('Nama wajib diisi','err'); return; }
    loadBtn('e-btn');
    try {
        const r = await post(`/customers/${id}/update`,{ name, phone:g('e-phone').value.trim(), address:g('e-addr').value.trim() });
        if (r.status==='success') {
            closePanel('edit'); showToast(r.message||'Diperbarui','ok');
            const row=g('row-'+id);
            if(row){ row.querySelector('.c-nm').textContent=name; row.querySelector('.c-ph').textContent=g('e-phone').value||'—'; row.querySelector('.c-addr').textContent=g('e-addr').value||'—'; row.classList.add('hl'); setTimeout(()=>row.classList.remove('hl'),700); }
        } else showToast(r.message||'Gagal','err');
    } catch(e) { showToast('Gagal','err'); }
    finally { resetBtn('e-btn','<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="14" height="14"><path d="M20 6L9 17l-5-5"/></svg>Simpan Perubahan'); }
}
function switchToEdit() {
    if (!currentId) return;
    const row=g('row-'+currentId);
    const nm=row?.querySelector('.c-nm')?.textContent?.trim()??'';
    const ph=row?.querySelector('.c-ph')?.textContent?.trim()??'';
    closePanel('detail'); setTimeout(()=>openEditPanel(currentId,nm,ph,''),180);
}

// DETAIL
async function openDetail(id) {
    currentId=id;
    g('detail-body').innerHTML='<div style="text-align:center;padding:40px 0;color:var(--tx3)">Memuat...</div>';
    openPanel('detail');
    try {
        const r = await get(`/customers/${id}/detail`);
        if (r.status!=='success') { showToast('Gagal memuat','err'); return; }
        const c=r.customer;
        g('d-ttl').textContent=c.name;
        g('d-sub').textContent=c.total_debt>0?'Piutang: '+Rp(c.total_debt):'Tidak ada piutang';
        const stM={unpaid:'sb-unpaid',partial:'sb-partial',paid:'sb-paid'};
        const stL={unpaid:'Belum Lunas',partial:'Cicilan',paid:'Lunas'};
        const banner=c.total_debt>0?`<div class="debt-banner"><div class="db-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg></div><div><div class="db-label">Total Piutang Aktif</div><div class="db-value">${Rp(c.total_debt)}</div></div></div>`:'';
        const cards=c.debts.length===0?`<div class="no-debt" style="text-align:center;padding:24px 0;color:var(--tx3)"><p style="font-size:12.5px">Tidak ada riwayat utang</p></div>`:c.debts.map(d=>{
            const ip=d.status==='paid';
            return `<div class="debt-card ${ip?'paid-card':''}" id="dc-${d.id}">
              <div class="dc-top"><div><div class="dc-inv">${d.invoice}</div><div class="dc-date">${d.created_at}</div></div><span class="sb2 ${stM[d.status]}">${stL[d.status]}</span></div>
              <div class="dc-amounts">
                <div class="dca"><div class="dca-l">Utang</div><div class="dca-v rd">${Rp(d.amount)}</div></div>
                <div class="dca"><div class="dca-l">Terbayar</div><div class="dca-v gn">${Rp(d.paid)}</div></div>
                <div class="dca"><div class="dca-l">Sisa</div><div class="dca-v am" id="rem-${d.id}">${Rp(d.remaining)}</div></div>
              </div>
              <div class="debt-note-box"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg><span id="nt-${d.id}" style="${!d.note?'font-style:italic;color:var(--tx3)':''}">${d.note||'Belum ada catatan'}</span></div>
              ${!ip?`<div class="pay-bar"><input class="pay-inp" type="number" id="pi-${d.id}" placeholder="Nominal bayar..." min="1"><button class="pay-btn" onclick="payDebt(${d.id})">💳 Bayar</button><button class="note-toggle" onclick="toggleNote(${d.id})">📝 Catatan</button></div>
              <div class="note-wrap" id="nw-${d.id}"><textarea class="note-ta" id="ni-${d.id}">${d.note||''}</textarea><button class="note-save-btn" onclick="saveNote(${d.id})">Simpan</button></div>`:''}
            </div>`;
        }).join('');
        g('detail-body').innerHTML=`
          <div class="cp-row"><div class="cp-av ${c.total_debt>0?'hd':''}">${c.name.charAt(0).toUpperCase()}</div>
          <div class="cp-meta"><div class="cp-name">${esc(c.name)}</div><div class="cp-phone">${c.phone||'Tidak ada nomor HP'}</div>${c.address?`<div style="font-size:12px;color:var(--tx3);margin-top:1px">${esc(c.address)}</div>`:''}</div></div>
          ${banner}
          <div class="sc"><div style="font-size:12px;font-weight:500;color:var(--tx2);margin-bottom:12px">Riwayat Utang (${c.debts.length})</div>${cards}</div>`;
    } catch(e) { showToast('Gagal memuat data','err'); console.error(e); }
}

// PAY
async function payDebt(id) {
    const inp=g(`pi-${id}`); const amt=parseFloat(inp?.value);
    if(!amt||amt<=0){showToast('Masukkan nominal','err');return;}
    try {
        const r=await post(`/debts/${id}/pay`,{pay_amount:amt});
        if(r.status==='success'){
            showToast(r.message,'ok');
            const el=g(`rem-${id}`); if(el) el.textContent=Rp(r.remaining);
            if(r.debt_status==='paid') setTimeout(()=>openDetail(currentId),500);
            if(inp) inp.value='';
        } else showToast(r.message||'Gagal','err');
    } catch(e){showToast('Gagal','err');}
}

// NOTE
function toggleNote(id){const w=g(`nw-${id}`);w.classList.toggle('show');if(w.classList.contains('show'))g(`ni-${id}`)?.focus();}
async function saveNote(id){
    const note=g(`ni-${id}`)?.value??'';
    try{
        const r=await post(`/debts/${id}/note`,{note});
        if(r.status==='success'){const el=g(`nt-${id}`);if(el){el.textContent=note||'Belum ada catatan';el.style.fontStyle=note?'':'italic';}g(`nw-${id}`)?.classList.remove('show');showToast('Catatan disimpan','ok');}
    }catch(e){showToast('Gagal','err');}
}

// DELETE
let delId=null;
function askDelete(id,name,hasDebt){
    if(hasDebt){showToast('Tidak bisa hapus — pelanggan masih memiliki utang aktif','err');return;}
    delId=id; g('conf-msg').textContent=`"${name}" akan dihapus permanen.`; g('conf').classList.add('on');
}
function closeConf(){g('conf').classList.remove('on');delId=null;}
async function execDelete(){
    if(!delId)return; const btn=g('conf-yes'); btn.disabled=true; btn.textContent='Menghapus...';
    try{
        const r=await del(`/customers/${delId}`);
        if(r.status==='success'){const row=g('row-'+delId);if(row){row.style.transition='opacity .25s,transform .25s';row.style.opacity='0';row.style.transform='translateX(16px)';setTimeout(()=>row.remove(),260);}closeConf();showToast(r.message,'ok');}
        else showToast(r.message||'Gagal hapus','err');
    }finally{btn.disabled=false;btn.textContent='Hapus';}
}

// UTILS
function loadBtn(id){const el=g(id);if(!el)return;el.disabled=true;el.innerHTML='<div class="spin"></div>';}
function resetBtn(id,html){const el=g(id);if(!el)return;el.disabled=false;el.innerHTML=html;}
function showToast(msg,type='ok'){const t=g('toast');g('t-msg').textContent=msg;t.className=`toast ${type} on`;clearTimeout(t._t);t._t=setTimeout(()=>t.classList.remove('on'),2800);}
function esc(s){return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');}
document.addEventListener('keydown',e=>{if(e.key==='Escape')['add','edit','detail'].forEach(n=>closePanel(n));});
g('panel-add').addEventListener('transitionend',e=>{if(e.propertyName==='transform'&&g('panel-add').classList.contains('on'))setTimeout(()=>g('a-name').focus(),50);});
</script>
</body>
</html>
