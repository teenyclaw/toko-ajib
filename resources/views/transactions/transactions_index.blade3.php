<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Transaksi — POS</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
:root {
    --bg: #0d0d0f; --bg2: #141416; --bg3: #1c1c1f; --bg4: #242428;
    --border: rgba(255,255,255,0.07); --border2: rgba(255,255,255,0.12);
    --text: #f0ede8; --text2: #9b9891; --text3: #5c5a56;
    --gold: #c9a84c; --gold2: #e8c96a; --gold-dim: rgba(201,168,76,0.12);
    --green: #3ecf8e; --green-dim: rgba(62,207,142,0.12);
    --red: #f87171; --radius: 12px; --radius-sm: 8px;
    --font: 'DM Sans', sans-serif; --mono: 'DM Mono', monospace;
}
html, body { height: 100%; }
body { font-family: var(--font); background: var(--bg); color: var(--text); font-size: 14px; -webkit-font-smoothing: antialiased; }
.app { display: grid; grid-template-columns: 220px 1fr; height: 100vh; overflow: hidden; }

/* SIDEBAR same as dashboard */
.sidebar { background: var(--bg2); border-right: 1px solid var(--border); display: flex; flex-direction: column; }
.sidebar-logo { padding: 24px 20px 20px; border-bottom: 1px solid var(--border); }
.logo-mark { display: flex; align-items: center; gap: 10px; }
.logo-icon { width: 32px; height: 32px; background: var(--gold); border-radius: 8px; display: flex; align-items: center; justify-content: center; }
.logo-icon svg { width: 18px; height: 18px; color: #0d0d0f; }
.logo-text { font-size: 15px; font-weight: 600; color: var(--text); }
.logo-sub { font-size: 10px; color: var(--text3); letter-spacing: 0.8px; text-transform: uppercase; }
.nav { padding: 12px 10px; flex: 1; }
.nav-section { font-size: 10px; color: var(--text3); letter-spacing: 1px; text-transform: uppercase; padding: 16px 10px 6px; font-weight: 500; }
.nav-item { display: flex; align-items: center; gap: 10px; padding: 9px 10px; border-radius: var(--radius-sm); color: var(--text2); text-decoration: none; font-size: 13.5px; transition: all 0.15s; margin-bottom: 2px; }
.nav-item:hover { background: var(--bg3); color: var(--text); }
.nav-item.active { background: var(--gold-dim); color: var(--gold); }
.nav-icon { width: 16px; height: 16px; flex-shrink: 0; opacity: 0.7; }
.nav-item.active .nav-icon { opacity: 1; }
.sidebar-footer { padding: 16px; border-top: 1px solid var(--border); }
.user-card { display: flex; align-items: center; gap: 10px; padding: 8px 10px; border-radius: var(--radius-sm); cursor: pointer; }
.avatar { width: 30px; height: 30px; border-radius: 50%; background: var(--gold-dim); display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 500; color: var(--gold); flex-shrink: 0; }
.user-name { font-size: 13px; font-weight: 500; }
.user-role { font-size: 11px; color: var(--text3); }

/* MAIN */
.main { display: flex; flex-direction: column; overflow: hidden; }
.topbar { padding: 16px 28px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; flex-shrink: 0; }
.topbar-title { font-size: 16px; font-weight: 500; }

/* STATS */
.stats-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; padding: 20px 28px; border-bottom: 1px solid var(--border); flex-shrink: 0; }
.stat-card { background: var(--bg2); border: 1px solid var(--border); border-radius: var(--radius); padding: 16px 18px; }
.stat-label { font-size: 11px; color: var(--text3); text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 8px; font-weight: 500; }
.stat-val { font-size: 22px; font-weight: 600; font-family: var(--mono); letter-spacing: -0.5px; }
.stat-val.gold { color: var(--gold); }
.stat-val.green { color: var(--green); }
.stat-sub { font-size: 11px; color: var(--text3); margin-top: 4px; }

/* FILTER */
.filter-bar { padding: 16px 28px; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 12px; flex-shrink: 0; }
.filter-input { background: var(--bg3); border: 1px solid var(--border2); color: var(--text); border-radius: var(--radius-sm); padding: 8px 12px; font-family: var(--font); font-size: 13px; outline: none; transition: border 0.15s; }
.filter-input:focus { border-color: var(--gold); }
.filter-label { font-size: 12px; color: var(--text3); }
.filter-btn { background: var(--gold); color: #0d0d0f; border: none; border-radius: var(--radius-sm); padding: 8px 16px; font-family: var(--font); font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.15s; }
.filter-btn:hover { background: var(--gold2); }

/* TABLE */
.table-wrap { flex: 1; overflow-y: auto; padding: 0 28px 24px; }
.table-wrap::-webkit-scrollbar { width: 4px; }
.table-wrap::-webkit-scrollbar-thumb { background: var(--bg4); border-radius: 2px; }
table { width: 100%; border-collapse: collapse; margin-top: 16px; }
thead th { font-size: 11px; color: var(--text3); text-transform: uppercase; letter-spacing: 0.8px; font-weight: 500; padding: 0 14px 10px; text-align: left; border-bottom: 1px solid var(--border); }
thead th:last-child { text-align: right; }
tbody tr { border-bottom: 1px solid var(--border); transition: background 0.1s; }
tbody tr:hover { background: var(--bg2); }
tbody td { padding: 14px; font-size: 13.5px; color: var(--text2); vertical-align: middle; }
tbody td:first-child { color: var(--text); font-weight: 500; font-family: var(--mono); font-size: 12.5px; }
.badge { display: inline-flex; align-items: center; gap: 5px; font-size: 11.5px; padding: 4px 9px; border-radius: 20px; font-weight: 500; }
.badge-green { background: var(--green-dim); color: var(--green); border: 1px solid rgba(62,207,142,0.2); }
.amount { font-family: var(--mono); font-size: 13.5px; color: var(--text); font-weight: 500; }
.action-btns { display: flex; gap: 8px; justify-content: flex-end; }
.action-btn { padding: 6px 12px; border-radius: 6px; font-size: 12px; font-family: var(--font); font-weight: 500; text-decoration: none; display: inline-flex; align-items: center; gap: 5px; transition: all 0.15s; cursor: pointer; }
.btn-view { background: var(--bg4); color: var(--text2); border: 1px solid var(--border2); }
.btn-view:hover { background: var(--bg3); color: var(--text); }
.btn-print { background: var(--gold-dim); color: var(--gold); border: 1px solid rgba(201,168,76,0.25); }
.btn-print:hover { background: rgba(201,168,76,0.2); }
.btn svg { width: 13px; height: 13px; }
.empty-state { text-align: center; padding: 60px 0; color: var(--text3); }
.empty-icon { font-size: 40px; margin-bottom: 12px; opacity: 0.3; }
</style>
</head>
<body>
<div class="app">
    <aside class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-mark">
                <div class="logo-icon"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M3 3h7v7H3V3zm0 11h7v7H3v-7zm11-11h7v7h-7V3zm4 11h-1v3h-3v1h3v3h1v-3h3v-1h-3v-3z"/></svg></div>
                <div><div class="logo-text">TOKO AJIB</div><div class="logo-sub">Point of Sale</div></div>
            </div>
        </div>
        <nav class="nav">
            <div class="nav-section">Utama</div>
            <a href="/dashboard" class="nav-item">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="2" width="9" height="9" rx="2"/><rect x="13" y="2" width="9" height="9" rx="2"/><rect x="2" y="13" width="9" height="9" rx="2"/><rect x="13" y="13" width="9" height="9" rx="2"/></svg>
                Kasir
            </a>
            <a href="/products" class="nav-item">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/></svg>
                Produk
            </a>
            <a href="/transactions" class="nav-item active">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 12h6M9 16h4"/></svg>
                Transaksi
            </a>
            <a href="/customers" class="nav-item">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="8" cy="7" r="4"/><path d="M2 21v-2a4 4 0 014-4h4a4 4 0 014 4v2"/><path d="M19 8v6M22 11h-6"/></svg>
                Pelanggan
            </a>
            <div class="nav-section">Sistem</div>
            <a href="/import" class="nav-item">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg>
                Import CSV
            </a>
        </nav>
        <div class="sidebar-footer">
            <div class="user-card">
                <div class="avatar">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</div>
                <div><div class="user-name">{{ auth()->user()->name ?? 'Admin' }}</div><div class="user-role">Admin</div></div>
            </div>
        </div>
    </aside>

    <main class="main">
        <div class="topbar">
            <div class="topbar-title">Riwayat Transaksi</div>
        </div>

        <!-- STATS -->
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-label">Total Omzet</div>
                <div class="stat-val gold">Rp {{ number_format($totalOmzet, 0, ',', '.') }}</div>
                <div class="stat-sub">{{ $sales->count() }} transaksi</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Transaksi Hari Ini</div>
                <div class="stat-val green">{{ $sales->filter(fn($s) => $s->created_at->isToday())->count() }}</div>
                <div class="stat-sub">dari total {{ $sales->count() }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Rata-rata / Transaksi</div>
                <div class="stat-val" style="color:var(--text)">
                    Rp {{ $sales->count() > 0 ? number_format($totalOmzet / $sales->count(), 0, ',', '.') : '0' }}
                </div>
                <div class="stat-sub">nilai rata-rata</div>
            </div>
        </div>

        <!-- FILTER -->
        <form method="GET" action="/transactions">
            <div class="filter-bar">
                <span class="filter-label">Filter tanggal:</span>
                <input type="date" name="date" class="filter-input" value="{{ request('date') }}">
                <button type="submit" class="filter-btn">Tampilkan</button>
                @if(request('date'))
                <a href="/transactions" style="font-size:12px; color:var(--text3); text-decoration:none;">✕ Reset</a>
                @endif
            </div>
        </form>

        <!-- TABLE -->
        <div class="table-wrap">
            @if($sales->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">📋</div>
                    <div style="font-size:14px; color:var(--text2)">Belum ada transaksi</div>
                </div>
            @else
            <table>
                <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>Pelanggan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th style="text-align:right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sales as $sale)
                    <tr>
                        <td>{{ $sale->invoice }}</td>
                        <td style="color:var(--text)">{{ $sale->customer->name ?? 'Umum' }}</td>
                        <td>{{ $sale->created_at->format('d M Y, H:i') }}</td>
                        <td><span class="badge badge-green">
                            <span style="width:5px;height:5px;border-radius:50%;background:var(--green);display:inline-block"></span>
                            Lunas
                        </span></td>
                        <td><span class="amount">Rp {{ number_format($sale->total, 0, ',', '.') }}</span></td>
                        <td>
                            <div class="action-btns">
                                <a href="/transactions/{{ $sale->id }}" class="action-btn btn-view">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    Detail
                                </a>
                                <a href="/transactions/{{ $sale->id }}/print" target="_blank" class="action-btn btn-print">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                                    Print
                                </a>
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
</body>
</html>
