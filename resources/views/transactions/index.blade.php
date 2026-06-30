<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Transaksi — POS AJIB</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --bg:#09090b;--bg2:#111114;--bg3:#18181c;--bg4:#202025;--bg5:#2a2a30;
  --bd:rgba(255,255,255,.055);--bd2:rgba(255,255,255,.09);--bd3:rgba(255,255,255,.15);
  --tx:#ede9e2;--tx2:#938f88;--tx3:#4e4c49;
  --go:#c9a44e;--go2:#e4bf6a;--go3:#f2d080;
  --gd:rgba(201,164,78,.09);--gd2:rgba(201,164,78,.17);--gd3:rgba(201,164,78,.27);
  --gn:#3ecf8e;--gnd:rgba(62,207,142,.09);
  --rd:#f87171;--rdd:rgba(248,113,113,.09);
  --am:#f59e0b;--amd:rgba(245,158,11,.09);
  --bl:#60a5fa;--bld:rgba(96,165,250,.09);
  --pu:#a78bfa;--pud:rgba(167,139,250,.09);
  --rr:12px;--rs:8px;--rx:6px;
  --fn:'DM Sans',sans-serif;--mo:'DM Mono',monospace;
  --sh:0 2px 16px rgba(0,0,0,.45);--shl:0 8px 40px rgba(0,0,0,.6)
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

/* PERIOD TABS */
.period-bar{padding:10px 22px;border-bottom:1px solid var(--bd);display:flex;align-items:center;gap:10px;flex-shrink:0;background:var(--bg)}
.p-tabs{display:flex;background:var(--bg3);border:1px solid var(--bd2);border-radius:var(--rs);padding:3px;gap:2px}
.p-tab{padding:6px 14px;border-radius:var(--rx);font-size:12.5px;font-weight:500;cursor:pointer;transition:all .14s;color:var(--tx3);background:transparent;border:none;font-family:var(--fn)}
.p-tab:hover{color:var(--tx2)}
.p-tab.on{background:var(--bg4);color:var(--tx);box-shadow:0 1px 4px rgba(0,0,0,.3)}
.p-input{background:var(--bg3);border:1px solid var(--bd2);color:var(--tx);border-radius:var(--rs);padding:6px 11px;font-family:var(--fn);font-size:13px;outline:none;transition:border .14s;cursor:pointer}
.p-input:focus{border-color:var(--go)}
.p-apply{background:var(--go);color:#09090b;border:none;border-radius:var(--rs);padding:7px 14px;font-family:var(--fn);font-size:12.5px;font-weight:600;cursor:pointer;transition:all .14s}
.p-apply:hover{background:var(--go2)}

/* STATS */
.stats{display:grid;grid-template-columns:repeat(4,1fr);gap:10px;padding:14px 22px;border-bottom:1px solid var(--bd);flex-shrink:0}
.stat{background:var(--bg2);border:1px solid var(--bd);border-radius:var(--rr);padding:12px 14px}
.stat-l{font-size:10px;color:var(--tx3);text-transform:uppercase;letter-spacing:.8px;font-weight:500;margin-bottom:5px}
.stat-v{font-size:20px;font-weight:600;font-family:var(--mo);letter-spacing:-.5px}
.sv-go{color:var(--go)}.sv-gn{color:var(--gn)}.sv-pu{color:var(--pu)}.sv-bl{color:var(--bl)}
.stat-s{font-size:10.5px;color:var(--tx3);margin-top:2px}

/* TABLE */
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
.c-inv{font-family:var(--mo);font-size:12px;color:var(--go);font-weight:500}
.c-cust{display:flex;align-items:center;gap:7px}
.c-av{width:24px;height:24px;border-radius:50%;background:var(--gd);border:1px solid var(--gd2);display:flex;align-items:center;justify-content:center;font-size:9.5px;font-weight:600;color:var(--go);flex-shrink:0}
.c-nm{font-size:13px;font-weight:500;color:var(--tx)}
.c-time{font-size:11px;color:var(--tx3);font-family:var(--mo)}
.c-items{font-size:11.5px;color:var(--tx3)}
.c-price{font-family:var(--mo);font-size:13px;color:var(--tx);font-weight:500}
.badge-ok{display:inline-flex;align-items:center;gap:4px;font-size:10.5px;padding:2px 8px;border-radius:20px;background:var(--gnd);color:var(--gn);border:1px solid rgba(62,207,142,.18);font-weight:500}
.badge-dot{width:5px;height:5px;border-radius:50%;background:var(--gn)}

/* ROW ACTIONS */
.ra{display:flex;gap:4px;justify-content:flex-end;opacity:0;transition:opacity .14s}
tbody tr:hover .ra{opacity:1}
.rb{width:26px;height:26px;border:1px solid var(--bd2);background:var(--bg4);color:var(--tx2);border-radius:var(--rx);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .14s}
.rb svg{width:12px;height:12px}
.rb:hover{background:var(--bg5);color:var(--tx);border-color:var(--bd3)}
.rb.rg:hover{border-color:rgba(201,164,78,.4);color:var(--go);background:var(--gd)}
.rb.rp:hover{border-color:rgba(96,165,250,.3);color:var(--bl);background:var(--bld)}
.rb.rd:hover{border-color:rgba(248,113,113,.3);color:var(--rd);background:var(--rdd)}

/* EMPTY */
.empty{text-align:center;padding:64px 0}
.empty svg{width:44px;height:44px;opacity:.14;margin:0 auto 12px;display:block}

/* ── OVERLAY + PANEL ── */
.ov{position:fixed;inset:0;background:rgba(0,0,0,.6);z-index:40;opacity:0;pointer-events:none;transition:opacity .24s;backdrop-filter:blur(3px)}
.ov.on{opacity:1;pointer-events:all}
.panel{position:fixed;top:0;right:0;bottom:0;width:520px;background:var(--bg2);border-left:1px solid var(--bd2);z-index:41;transform:translateX(100%);transition:transform .28s cubic-bezier(.4,0,.2,1);display:flex;flex-direction:column;box-shadow:var(--shl)}
.panel.on{transform:translateX(0)}
.p-head{padding:18px 22px 16px;border-bottom:1px solid var(--bd);display:flex;align-items:flex-start;gap:11px;flex-shrink:0}
.p-ico{width:34px;height:34px;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.p-ico svg{width:17px;height:17px}
.pi-go{background:var(--gd);color:var(--go);border:1px solid var(--gd2)}
.pi-bl{background:var(--bld);color:var(--bl);border:1px solid rgba(96,165,250,.2)}
.p-ttl{font-size:14.5px;font-weight:500}
.p-sub{font-size:11.5px;color:var(--tx3);margin-top:2px;font-family:var(--mo)}
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
.pf-print{background:var(--bld);color:var(--bl);border:1px solid rgba(96,165,250,.25)!important;flex:.7}
.pf-print:hover{background:rgba(96,165,250,.16)}

/* form in panel */
.fg{margin-bottom:14px}
.fg:last-child{margin-bottom:0}
.fl{font-size:10.5px;color:var(--tx3);text-transform:uppercase;letter-spacing:.7px;font-weight:500;display:block;margin-bottom:6px}
.fi2{width:100%;background:var(--bg3);border:1px solid var(--bd2);color:var(--tx);border-radius:var(--rs);padding:9px 12px;font-family:var(--fn);font-size:13px;outline:none;transition:border .14s}
.fi2:focus{border-color:var(--go);box-shadow:0 0 0 2px var(--gd)}
.fi2::placeholder{color:var(--tx3)}
.fi2-mono{font-family:var(--mo)}
.r2{display:grid;grid-template-columns:1fr 1fr;gap:10px}

/* section card */
.sc{background:var(--bg3);border:1px solid var(--bd);border-radius:var(--rr);padding:14px;margin-bottom:12px}
.sc:last-child{margin-bottom:0}
.sc-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:12px}
.sc-ttl{font-size:12px;font-weight:500;color:var(--tx2);display:flex;align-items:center;gap:6px}
.sc-ttl svg{width:13px;height:13px;color:var(--go)}

/* items editor */
.item-row{display:grid;grid-template-columns:1fr 70px 100px 24px;gap:6px;align-items:center;margin-bottom:7px}
.item-row:last-child{margin-bottom:0}
.ie{background:var(--bg4);border:1px solid var(--bd2);color:var(--tx);border-radius:var(--rx);padding:6px 8px;font-family:var(--mo);font-size:12px;outline:none;width:100%;transition:border .14s}
.ie:focus{border-color:var(--go)}
.ie-sel{background:var(--bg4);border:1px solid var(--bd2);color:var(--tx);border-radius:var(--rx);padding:6px 8px;font-family:var(--fn);font-size:12px;outline:none;width:100%;appearance:none;cursor:pointer}
.ie-sel:focus{border-color:var(--go)}
.ie-del{width:24px;height:24px;background:transparent;border:1px solid transparent;color:var(--tx3);border-radius:var(--rx);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .14s;padding:0}
.ie-del:hover{background:var(--rdd);border-color:rgba(248,113,113,.2);color:var(--rd)}
.ie-del svg{width:12px;height:12px}
.add-item-btn{display:flex;align-items:center;gap:6px;background:transparent;border:1px dashed var(--bd2);color:var(--tx3);border-radius:var(--rs);padding:7px 12px;font-size:12px;font-family:var(--fn);cursor:pointer;width:100%;justify-content:center;transition:all .14s;margin-top:8px}
.add-item-btn:hover{border-color:var(--go);color:var(--go);background:var(--gd)}
.add-item-btn svg{width:13px;height:13px}
.item-header{display:grid;grid-template-columns:1fr 70px 100px 24px;gap:6px;margin-bottom:7px}
.ih{font-size:9.5px;color:var(--tx3);text-transform:uppercase;letter-spacing:.7px;font-weight:500}

/* summary stripe */
.summ{background:var(--bg2);border:1px solid var(--bd2);border-radius:var(--rs);padding:12px 14px}
.summ-row{display:flex;justify-content:space-between;align-items:center;margin-bottom:6px}
.summ-row:last-child{margin-bottom:0}
.summ-lbl{font-size:12px;color:var(--tx2)}
.summ-val{font-family:var(--mo);font-size:12.5px;color:var(--tx2)}
.summ-total{background:var(--gd);border:1px solid var(--gd2);border-radius:var(--rs);padding:10px 14px;display:flex;justify-content:space-between;align-items:center;margin:8px 0}
.st-lbl{font-size:12.5px;color:var(--go);font-weight:500}
.st-val{font-family:var(--mo);font-size:17px;font-weight:600;color:var(--go)}
.summ-change{background:var(--gnd);border:1px solid rgba(62,207,142,.15);border-radius:var(--rs);padding:9px 14px;display:flex;justify-content:space-between;align-items:center}
.sc-lbl{font-size:12px;color:var(--gn)}
.sc-val{font-family:var(--mo);font-size:14px;color:var(--gn);font-weight:500}

/* DETAIL VIEW (read mode) */
.dv-meta{display:grid;grid-template-columns:1fr 1fr;gap:0;border:1px solid var(--bd);border-radius:var(--rr);overflow:hidden;margin-bottom:12px}
.dv-cell{padding:12px 14px;border-right:1px solid var(--bd);border-bottom:1px solid var(--bd)}
.dv-cell:nth-child(2n){border-right:none}
.dv-cell:nth-last-child(-n+2){border-bottom:none}
.dv-lbl{font-size:10px;color:var(--tx3);text-transform:uppercase;letter-spacing:.7px;margin-bottom:4px;font-weight:500}
.dv-val{font-size:13px;font-weight:500;color:var(--tx)}
.dv-val.mono{font-family:var(--mo)}

.dv-items table{width:100%}
.dv-items thead th{font-size:10px;color:var(--tx3);text-transform:uppercase;letter-spacing:.7px;padding:0 10px 8px;border-bottom:1px solid var(--bd)}
.dv-items tbody td{padding:9px 10px;border-bottom:1px solid var(--bd);font-size:12.5px;color:var(--tx2)}
.dv-items tbody tr:last-child td{border-bottom:none}

/* TOAST */
.toast{position:fixed;bottom:22px;right:22px;background:var(--bg3);border:1px solid var(--bd2);border-radius:var(--rr);padding:11px 15px 11px 13px;display:flex;align-items:center;gap:9px;font-size:13px;transform:translateY(70px);opacity:0;transition:all .28s cubic-bezier(.34,1.56,.64,1);z-index:100;min-width:230px;box-shadow:var(--shl)}
.toast.on{transform:translateY(0);opacity:1}
.t-dot{width:6px;height:6px;border-radius:50%;flex-shrink:0}
.toast.ok .t-dot{background:var(--gn)}
.toast.err .t-dot{background:var(--rd)}

/* CONFIRM */
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

/* misc */
.spin{width:13px;height:13px;border:2px solid rgba(9,9,11,.25);border-top-color:#09090b;border-radius:50%;animation:sp .55s linear infinite;display:inline-block;flex-shrink:0}
@keyframes sp{to{transform:rotate(360deg)}}
.sep{border:none;border-top:1px solid var(--bd);margin:12px 0}
.btn-sm{display:inline-flex;align-items:center;gap:5px;padding:5px 11px;border-radius:var(--rx);font-family:var(--fn);font-size:12px;font-weight:500;cursor:pointer;transition:all .14s;border:none}
.btn-sm svg{width:12px;height:12px}
.bsm-go{background:var(--go);color:#09090b}
.bsm-go:hover{background:var(--go2)}
.bsm-ghost{background:var(--bg4);color:var(--tx2);border:1px solid var(--bd2)!important}
.bsm-ghost:hover{background:var(--bg5);color:var(--tx)}
</style>
@include('partials.admin-shell-mobile-styles')
</head>
<body>
@include('partials.admin-shell-mobile-body-start')

@include('partials.sidebar', ['active' => 'transactions', 'sidebarId' => 'sb'])

<!-- MAIN -->
<main class="main">

<!-- TOPBAR -->
<div class="topbar">
  @include('partials.sb-toggle')
  <div class="tb-ttl">Riwayat Transaksi</div>
</div>

<!-- PERIOD BAR -->
<form method="GET" action="/transactions" id="period-form">
<div class="period-bar">
  <div class="p-tabs">
    <button type="button" class="p-tab {{ $period=='daily'?'on':'' }}" onclick="setPeriod('daily')">Harian</button>
    <button type="button" class="p-tab {{ $period=='weekly'?'on':'' }}" onclick="setPeriod('weekly')">Mingguan</button>
    <button type="button" class="p-tab {{ $period=='monthly'?'on':'' }}" onclick="setPeriod('monthly')">Bulanan</button>
  </div>
  <input type="hidden" name="period" id="inp-period" value="{{ $period }}">

  <div id="wrap-daily"   style="{{ $period!='daily'?'display:none':'' }}">
    <input class="p-input" type="date" name="date"  id="inp-date"  value="{{ $date }}"  onchange="this.form.submit()">
  </div>
  <div id="wrap-weekly"  style="{{ $period!='weekly'?'display:none':'' }}">
    <input class="p-input" type="week" name="week"  id="inp-week"  value="{{ $week }}"  onchange="this.form.submit()">
  </div>
  <div id="wrap-monthly" style="{{ $period!='monthly'?'display:none':'' }}">
    <input class="p-input" type="month" name="month" id="inp-month" value="{{ $month }}" onchange="this.form.submit()">
  </div>

  <div style="flex:1"></div>
  <span style="font-size:11.5px;color:var(--tx3)">{{ $sales->count() }} transaksi</span>
</div>
</form>

<!-- STATS -->
<div class="stats">
  <div class="stat">
    <div class="stat-l">Total Omzet</div>
    <div class="stat-v sv-go">{{ number_format($totalOmzet,0,',','.') }}</div>
    <div class="stat-s">Rp dalam periode ini</div>
  </div>
  <div class="stat">
    <div class="stat-l">Transaksi</div>
    <div class="stat-v sv-gn">{{ $sales->count() }}</div>
    <div class="stat-s">invoice tercatat</div>
  </div>
  <div class="stat">
    <div class="stat-l">Rata-rata</div>
    <div class="stat-v sv-pu">{{ $sales->count()>0?number_format($totalOmzet/$sales->count(),0,',','.'):'0' }}</div>
    <div class="stat-s">Rp per transaksi</div>
  </div>
  <div class="stat">
    <div class="stat-l">Total Item</div>
    <div class="stat-v sv-bl">{{ $sales->sum(fn($s)=>$s->items->count()) }}</div>
    <div class="stat-s">item terjual</div>
  </div>
</div>

<!-- TABLE -->
<div class="tw">
@if($sales->isEmpty())
<div class="empty">
  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/></svg>
  <p style="font-size:13.5px;color:var(--tx2)">Belum ada transaksi</p>
  <p style="font-size:11.5px;color:var(--tx3);margin-top:5px">Coba pilih periode yang berbeda</p>
</div>
@else
<table>
<thead>
<tr>
  <th>Invoice</th>
  <th>Pelanggan</th>
  <th>Waktu</th>
  <th>Item</th>
  <th>Status</th>
  <th>Total</th>
  <th style="text-align:right">Aksi</th>
</tr>
</thead>
<tbody id="tbody">
@foreach($sales as $s)
<tr id="row-{{ $s->id }}" onclick="openDetail({{ $s->id }})">
  <td><div class="c-inv">{{ $s->invoice }}</div></td>
  <td>
    <div class="c-cust">
      <div class="c-av">{{ strtoupper(substr($s->customer->name??'U',0,1)) }}</div>
      <span class="c-nm">{{ $s->customer->name??'Umum' }}</span>
    </div>
  </td>
  <td><div class="c-time">{{ $s->created_at->format('d M Y') }}<br>{{ $s->created_at->format('H:i') }}</div></td>
  <td><span class="c-items">{{ $s->items->count() }} produk</span></td>
  <td><span class="badge-ok"><span class="badge-dot"></span>Lunas</span></td>
  <td><div class="c-price" id="total-{{ $s->id }}">Rp {{ number_format($s->total,0,',','.') }}</div></td>
  <td onclick="event.stopPropagation()">
    <div class="ra">
      <button class="rb rg" title="Edit Transaksi" onclick="openEdit({{ $s->id }})">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L4.22 13.45l-1.06 3.77 3.77-1.06 8.84-8.84a5.5 5.5 0 000-7.71z"/></svg>
      </button>
      <button class="rb rp" title="Print Struk" onclick="printInvoice({{ $s->id }})">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
      </button>
      <button class="rb rd" title="Hapus" onclick="askDelete({{ $s->id }},'{{ $s->invoice }}')">
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

</main>
</div>

<!-- ═══════ PANEL DETAIL (read-only) ═══════════════════════ -->
<div class="ov" id="ov-detail" onclick="closePanel('detail')"></div>
<div class="panel" id="panel-detail">
  <div class="p-head">
    <div class="p-ico pi-bl"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 12h6M9 16h4"/></svg></div>
    <div><div class="p-ttl">Detail Transaksi</div><div class="p-sub" id="d-inv">—</div></div>
    <button class="p-cls" onclick="closePanel('detail')"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg></button>
  </div>
  <div class="p-body" id="detail-body">
    <div style="text-align:center;padding:40px 0;color:var(--tx3)">Memuat...</div>
  </div>
  <div class="p-foot">
    <button class="pf-btn pf-cancel" onclick="closePanel('detail')">Tutup</button>
    <button class="pf-btn pf-print" id="d-print-btn" onclick="printFromDetail()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
      Print Struk
    </button>
    <button class="pf-btn pf-save" id="d-edit-btn" onclick="switchToEdit()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L4.22 13.45l-1.06 3.77 3.77-1.06 8.84-8.84a5.5 5.5 0 000-7.71z"/></svg>
      Edit Transaksi
    </button>
  </div>
</div>

<!-- ═══════ PANEL EDIT ══════════════════════════════════════ -->
<div class="ov" id="ov-edit" onclick="closePanel('edit')"></div>
<div class="panel" id="panel-edit">
  <div class="p-head">
    <div class="p-ico pi-go"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L4.22 13.45l-1.06 3.77 3.77-1.06 8.84-8.84a5.5 5.5 0 000-7.71z"/></svg></div>
    <div><div class="p-ttl">Edit Transaksi</div><div class="p-sub" id="e-inv">—</div></div>
    <button class="p-cls" onclick="closePanel('edit')"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg></button>
  </div>
  <input type="hidden" id="e-id">
  <div class="p-body">

    <!-- PELANGGAN + BAYAR -->
    <div class="sc">
      <div class="sc-head"><div class="sc-ttl"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="8" cy="7" r="4"/><path d="M2 21v-2a4 4 0 014-4h4a4 4 0 014 4v2"/></svg>Info Pembayaran</div></div>
      <div class="r2">
        <div class="fg">
          <label class="fl">Pelanggan</label>
          <select class="fi2" id="e-cust">
            <option value="">— Umum —</option>
            @foreach($customers as $c)
            <option value="{{ $c->id }}">{{ $c->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="fg">
          <label class="fl">Uang Bayar</label>
          <input class="fi2 fi2-mono" type="number" id="e-paid" oninput="recalc()">
        </div>
      </div>
    </div>

    <!-- ITEMS -->
    <div class="sc">
      <div class="sc-head">
        <div class="sc-ttl"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/></svg>Item Transaksi</div>
      </div>
      <div class="item-header">
        <div class="ih">Produk</div><div class="ih">Qty</div><div class="ih">Harga</div><div></div>
      </div>
      <div id="items-wrap"></div>
      <button class="add-item-btn" onclick="addItem()">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
        Tambah Item
      </button>
    </div>

    <!-- SUMMARY -->
    <div class="summ">
      <div class="summ-row"><span class="summ-lbl">Subtotal</span><span class="summ-val" id="e-sub">Rp 0</span></div>
    </div>
    <div class="summ-total"><span class="st-lbl">Total</span><span class="st-val" id="e-total">Rp 0</span></div>
    <div class="summ-row" style="padding:0 2px;margin-bottom:6px"><span class="summ-lbl">Dibayar</span><span class="summ-val" id="e-paid-disp">Rp 0</span></div>
    <div class="summ-change"><span class="sc-lbl">Kembalian</span><span class="sc-val" id="e-change">Rp 0</span></div>

  </div>
  <div class="p-foot">
    <button class="pf-btn pf-cancel" onclick="closePanel('edit')">Batal</button>
    <button class="pf-btn pf-print" id="e-saveprint-btn" onclick="saveAndPrint()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
      Simpan & Print
    </button>
    <button class="pf-btn pf-save" id="e-save-btn" onclick="submitEdit(false)">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>
      Simpan
    </button>
  </div>
</div>

<!-- CONFIRM DELETE -->
<div class="conf" id="conf">
  <div class="conf-box">
    <div class="conf-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg></div>
    <div class="conf-ttl">Hapus Transaksi?</div>
    <div class="conf-msg" id="conf-msg">Transaksi ini akan dihapus permanen.</div>
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

// All products for dropdown
const allProducts = @json($products->map(fn($p)=>['id'=>$p->id,'name'=>$p->name,'price'=>$p->harga_jual_pcs]));

// ─── PERIOD SWITCHING ──────────────────────────────────
function setPeriod(p) {
  g('inp-period').value = p;
  ['daily','weekly','monthly'].forEach(x => {
    const w = g('wrap-'+x);
    if (w) w.style.display = x===p ? '' : 'none';
  });
  document.querySelectorAll('.p-tab').forEach((t,i) => {
    t.classList.toggle('on', ['daily','weekly','monthly'][i] === p);
  });
  g('period-form').submit();
}

// ─── PANEL ─────────────────────────────────────────────
let currentId = null;

function openPanel(n) { g('ov-'+n).classList.add('on'); g('panel-'+n).classList.add('on'); }
function closePanel(n) { g('ov-'+n).classList.remove('on'); g('panel-'+n).classList.remove('on'); }

// ─── DETAIL PANEL ──────────────────────────────────────
async function openDetail(id) {
  currentId = id;
  g('detail-body').innerHTML = '<div style="text-align:center;padding:40px 0;color:var(--tx3)">Memuat...</div>';
  openPanel('detail');
  try {
    const r = await callApi('GET', `/transactions/${id}/detail`, null);
    if (r.status !== 'success') return;
    const s = r.sale;
    g('d-inv').textContent = s.invoice;
    g('detail-body').innerHTML = `
      <div class="dv-meta">
        <div class="dv-cell"><div class="dv-lbl">Invoice</div><div class="dv-val mono">${s.invoice}</div></div>
        <div class="dv-cell"><div class="dv-lbl">Tanggal</div><div class="dv-val">${s.created_at}</div></div>
        <div class="dv-cell"><div class="dv-lbl">Pelanggan</div><div class="dv-val">${s.customer}</div></div>
        <div class="dv-cell"><div class="dv-lbl">Total Item</div><div class="dv-val">${s.items.length} produk</div></div>
      </div>
      <div class="sc dv-items">
        <div class="sc-head"><div class="sc-ttl"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="13" height="13"><path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/></svg>Item</div></div>
        <table>
          <thead><tr><th>Produk</th><th style="text-align:center">Qty</th><th style="text-align:right">Harga</th><th style="text-align:right">Subtotal</th></tr></thead>
          <tbody>
            ${s.items.map(i=>`<tr>
              <td>${i.name}</td>
              <td style="text-align:center;font-family:var(--mo)">${i.qty}</td>
              <td style="text-align:right;font-family:var(--mo)">${Rp(i.price)}</td>
              <td style="text-align:right;font-family:var(--mo);color:var(--tx)">${Rp(i.total)}</td>
            </tr>`).join('')}
          </tbody>
        </table>
      </div>
      <div style="height:12px"></div>
      <div class="summ-total"><span class="st-lbl">Total</span><span class="st-val">${Rp(s.total)}</span></div>
      <div class="summ" style="margin-top:8px">
        <div class="summ-row"><span class="summ-lbl">Dibayar</span><span class="summ-val">${Rp(s.paid)}</span></div>
      </div>
      <div class="summ-change" style="margin-top:8px"><span class="sc-lbl">Kembalian</span><span class="sc-val">${Rp(s.change)}</span></div>
    `;
  } catch(e) { showToast('Gagal memuat detail', 'err'); }
}

function printFromDetail() {
  if (currentId) window.open(`/transactions/${currentId}/print`, '_blank');
}
function printInvoice(id) {
  window.open(`/transactions/${id}/print`, '_blank');
}
function switchToEdit() {
  closePanel('detail');
  setTimeout(() => openEdit(currentId), 100);
}

// ─── EDIT PANEL ────────────────────────────────────────
async function openEdit(id) {
  currentId = id;
  openPanel('edit');
  try {
    const r = await callApi('GET', `/transactions/${id}/detail`, null);
    if (r.status !== 'success') return;
    const s = r.sale;
    g('e-id').value     = s.id;
    g('e-inv').textContent = s.invoice;
    g('e-cust').value   = s.customer_id ?? '';
    g('e-paid').value   = s.paid;

    // Render items
    g('items-wrap').innerHTML = '';
    s.items.forEach(item => appendItemRow(item.product_id, item.qty, item.price));
    recalc();
  } catch(e) { showToast('Gagal memuat data', 'err'); }
}

// Build product options
function buildProductOptions(selectedId) {
  return allProducts.map(p =>
    `<option value="${p.id}" data-price="${p.price}" ${p.id==selectedId?'selected':''}>${p.name}</option>`
  ).join('');
}

let itemIdx = 0;
function appendItemRow(productId=null, qty=1, price=null) {
  const idx = itemIdx++;
  const wrap = g('items-wrap');
  const div = document.createElement('div');
  div.className = 'item-row';
  div.id = `item-row-${idx}`;
  const defaultPrice = price ?? (productId ? (allProducts.find(p=>p.id==productId)?.price??0) : 0);
  div.innerHTML = `
    <select class="ie-sel" id="item-prod-${idx}" onchange="onProductChange(${idx})">
      <option value="">— Pilih —</option>
      ${buildProductOptions(productId)}
    </select>
    <input class="ie" type="number" id="item-qty-${idx}" value="${qty}" min="1" oninput="recalc()">
    <input class="ie" type="number" id="item-price-${idx}" value="${defaultPrice}" min="0" oninput="recalc()">
    <button class="ie-del" onclick="removeItem(${idx})"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg></button>
  `;
  wrap.appendChild(div);
  recalc();
}

function addItem() { appendItemRow(); }

function onProductChange(idx) {
  const sel = g(`item-prod-${idx}`);
  const opt = sel.options[sel.selectedIndex];
  const price = opt.getAttribute('data-price') ?? 0;
  g(`item-price-${idx}`).value = price;
  recalc();
}

function removeItem(idx) {
  const el = g(`item-row-${idx}`);
  if (el) el.remove();
  recalc();
}

function getItems() {
  const rows = g('items-wrap').querySelectorAll('.item-row');
  return Array.from(rows).map(row => {
    const idx = row.id.replace('item-row-','');
    return {
      product_id: g(`item-prod-${idx}`)?.value,
      qty:        parseInt(g(`item-qty-${idx}`)?.value)  || 1,
      price:      parseFloat(g(`item-price-${idx}`)?.value) || 0,
    };
  }).filter(i => i.product_id);
}

function recalc() {
  const items   = getItems();
  const total   = items.reduce((s,i) => s + i.price*i.qty, 0);
  const paid    = parseFloat(g('e-paid').value) || 0;
  const change  = paid - total;
  g('e-sub').textContent      = Rp(total);
  g('e-total').textContent    = Rp(total);
  g('e-paid-disp').textContent = Rp(paid);
  g('e-change').textContent   = change >= 0 ? Rp(change) : '⚠ Kurang ' + Rp(Math.abs(change));
  g('e-change').style.color   = change >= 0 ? 'var(--gn)' : 'var(--rd)';
}

async function submitEdit(andPrint=false) {
  const id     = g('e-id').value;
  const items  = getItems();
  const paid   = parseFloat(g('e-paid').value) || 0;
  const custId = g('e-cust').value;

  if (!items.length)    { showToast('Tambahkan minimal 1 item', 'err'); return; }
  if (paid <= 0)        { showToast('Isi uang bayar', 'err'); return; }

  const total = items.reduce((s,i) => s+i.price*i.qty, 0);
  if (paid < total)     { showToast('Uang bayar kurang dari total', 'err'); return; }

  setBtn('e-save-btn', true, 'Menyimpan...');
  setBtn('e-saveprint-btn', true, 'Memproses...');

  try {
    const r = await callApi('POST', `/transactions/${id}/update`, {
      customer_id: custId || null,
      paid, items,
    });
    if (r.status === 'success') {
      showToast(r.message, 'ok');
      // Update row di tabel
      const totalEl = g(`total-${id}`);
      if (totalEl) totalEl.textContent = Rp(total);
      closePanel('edit');
      if (andPrint) window.open(`/transactions/${r.sale_id}/print`, '_blank');
    } else showToast(r.message || 'Gagal menyimpan', 'err');
  } finally {
    setBtn('e-save-btn', false, '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg> Simpan');
    setBtn('e-saveprint-btn', false, '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg> Simpan & Print');
  }
}

function saveAndPrint() { submitEdit(true); }

// ─── DELETE ────────────────────────────────────────────
let delId = null;
function askDelete(id, inv) {
  delId = id;
  g('conf-msg').textContent = `Invoice "${inv}" akan dihapus permanen. Stok produk akan dikembalikan.`;
  g('conf').classList.add('on');
}
function closeConf() { g('conf').classList.remove('on'); delId=null; }
async function execDelete() {
  if (!delId) return;
  const btn = g('conf-yes');
  btn.disabled=true; btn.textContent='Menghapus...';
  try {
    const r = await callApi('DELETE', `/transactions/${delId}`, {});
    if (r.status==='success') {
      const row = g(`row-${delId}`);
      if (row) { row.style.transition='opacity .25s,transform .25s'; row.style.opacity='0'; row.style.transform='translateX(16px)'; setTimeout(()=>row.remove(),260); }
      closeConf(); showToast(r.message, 'ok');
    }
  } finally { btn.disabled=false; btn.textContent='Hapus'; }
}

// ─── UTILS ─────────────────────────────────────────────
function setBtn(id, loading, html) {
  const el = g(id); if (!el) return;
  el.disabled = loading;
  el.innerHTML = loading ? '<div class="spin"></div>&nbsp;' + (html.includes('Menyimpan')||html.includes('Memproses') ? html : '') : html;
  if (loading) el.innerHTML = '<div class="spin"></div>';
}

async function callApi(method, url, body) {
  const opts = { method, headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSR} };
  if (body !== null) opts.body = JSON.stringify(body);
  const r = await fetch(url, opts);
  return r.json();
}

function showToast(msg, type='ok') {
  const t = g('toast'); g('t-msg').textContent = msg;
  t.className = `toast ${type} on`;
  clearTimeout(t._t);
  t._t = setTimeout(() => t.classList.remove('on'), 2800);
}

document.addEventListener('keydown', e => {
  if (e.key==='Escape') ['detail','edit'].forEach(n=>closePanel(n));
});
</script>
@include('partials.admin-shell-mobile-scripts')
</body>
</html>
