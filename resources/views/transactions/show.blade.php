<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Detail Transaksi — POS</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
:root {
    --bg: #0d0d0f; --bg2: #141416; --bg3: #1c1c1f; --bg4: #242428;
    --border: rgba(255,255,255,0.07); --border2: rgba(255,255,255,0.12);
    --text: #f0ede8; --text2: #9b9891; --text3: #5c5a56;
    --gold: #c9a84c; --gold2: #e8c96a; --gold-dim: rgba(201,168,76,0.12);
    --green: #3ecf8e; --green-dim: rgba(62,207,142,0.1);
    --radius: 12px; --radius-sm: 8px;
    --font: 'DM Sans', sans-serif; --mono: 'DM Mono', monospace;
}
html, body { height: 100%; }
body { font-family: var(--font); background: var(--bg); color: var(--text); font-size: 14px; -webkit-font-smoothing: antialiased; }
.app { display: grid; grid-template-columns: 220px 1fr; height: 100vh; overflow: hidden; }

/* SIDEBAR */
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
.user-card { display: flex; align-items: center; gap: 10px; padding: 8px 10px; border-radius: var(--radius-sm); }
.avatar { width: 30px; height: 30px; border-radius: 50%; background: var(--gold-dim); display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 500; color: var(--gold); flex-shrink: 0; }
.user-name { font-size: 13px; font-weight: 500; }
.user-role { font-size: 11px; color: var(--text3); }

/* MAIN */
.main { display: flex; flex-direction: column; overflow: hidden; }
.topbar { padding: 16px 28px; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 14px; flex-shrink: 0; }
.back-btn { display: flex; align-items: center; gap: 6px; color: var(--text3); text-decoration: none; font-size: 13px; transition: color 0.15s; }
.back-btn:hover { color: var(--text); }
.back-btn svg { width: 15px; height: 15px; }
.topbar-divider { width: 1px; height: 16px; background: var(--border2); }
.topbar-title { font-size: 15px; font-weight: 500; flex: 1; }
.topbar-actions { display: flex; gap: 10px; }
.action-btn { display: inline-flex; align-items: center; gap: 7px; padding: 8px 14px; border-radius: var(--radius-sm); font-size: 13px; font-weight: 500; font-family: var(--font); text-decoration: none; cursor: pointer; transition: all 0.15s; }
.btn-outline { background: var(--bg3); color: var(--text2); border: 1px solid var(--border2); }
.btn-outline:hover { background: var(--bg4); color: var(--text); }
.btn-gold { background: var(--gold); color: #0d0d0f; border: none; }
.btn-gold:hover { background: var(--gold2); }
.action-btn svg { width: 14px; height: 14px; }

/* CONTENT */
.content { flex: 1; overflow-y: auto; padding: 24px 28px; }
.content::-webkit-scrollbar { width: 4px; }
.content::-webkit-scrollbar-thumb { background: var(--bg4); border-radius: 2px; }

.detail-grid { display: grid; grid-template-columns: 1fr 340px; gap: 20px; align-items: start; }

.card { background: var(--bg2); border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; margin-bottom: 16px; }
.card-header { padding: 16px 20px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
.card-title { font-size: 13.5px; font-weight: 500; }

/* META GRID */
.meta-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0; }
.meta-item { padding: 16px 20px; border-bottom: 1px solid var(--border); border-right: 1px solid var(--border); }
.meta-item:nth-child(2n) { border-right: none; }
.meta-item:nth-last-child(-n+2) { border-bottom: none; }
.meta-label { font-size: 11px; color: var(--text3); text-transform: uppercase; letter-spacing: 0.7px; font-weight: 500; margin-bottom: 6px; }
.meta-val { font-size: 14px; font-weight: 500; color: var(--text); }
.meta-val.mono { font-family: var(--mono); }
.meta-val.gold { color: var(--gold); }
.meta-val.green { color: var(--green); }

.badge-lunas { display: inline-flex; align-items: center; gap: 5px; font-size: 12px; padding: 4px 10px; border-radius: 20px; background: var(--green-dim); color: var(--green); border: 1px solid rgba(62,207,142,0.2); font-weight: 500; }
.badge-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--green); }

/* ITEMS TABLE */
table { width: 100%; border-collapse: collapse; }
thead th { font-size: 11px; color: var(--text3); text-transform: uppercase; letter-spacing: 0.7px; font-weight: 500; padding: 0 20px 10px; text-align: left; border-bottom: 1px solid var(--border); }
thead th:last-child { text-align: right; }
tbody tr { border-bottom: 1px solid var(--border); }
tbody tr:last-child { border-bottom: none; }
tbody td { padding: 14px 20px; font-size: 13.5px; color: var(--text2); vertical-align: middle; }
.item-name { font-weight: 500; color: var(--text); font-size: 13.5px; }
.item-category { font-size: 11.5px; color: var(--text3); margin-top: 2px; }
.qty-pill { display: inline-flex; align-items: center; justify-content: center; background: var(--bg4); color: var(--text2); font-family: var(--mono); font-size: 12.5px; padding: 4px 10px; border-radius: 6px; }
.price-mono { font-family: var(--mono); font-size: 13px; color: var(--text); text-align: right; }

/* SUMMARY PANEL */
.summary-section { padding: 16px 20px; }
.summary-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; }
.summary-label { font-size: 13px; color: var(--text2); }
.summary-val { font-family: var(--mono); font-size: 13px; color: var(--text2); }
.summary-divider { border: none; border-top: 1px solid var(--border); margin: 12px 0; }
.total-highlight { background: var(--gold-dim); border-radius: var(--radius-sm); padding: 14px 16px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; border: 1px solid rgba(201,168,76,0.2); }
.total-hl-label { font-size: 13px; font-weight: 500; color: var(--gold); }
.total-hl-val { font-family: var(--mono); font-size: 18px; font-weight: 600; color: var(--gold); }
.change-highlight { background: var(--green-dim); border-radius: var(--radius-sm); padding: 12px 16px; display: flex; justify-content: space-between; align-items: center; border: 1px solid rgba(62,207,142,0.15); }
.change-hl-label { font-size: 13px; color: var(--green); }
.change-hl-val { font-family: var(--mono); font-size: 15px; font-weight: 500; color: var(--green); }

/* CUSTOMER CARD */
.cust-row { display: flex; align-items: center; gap: 12px; padding: 16px 20px; }
.cust-avatar { width: 38px; height: 38px; border-radius: 50%; background: var(--gold-dim); border: 1px solid rgba(201,168,76,0.2); display: flex; align-items: center; justify-content: center; font-size: 15px; font-weight: 600; color: var(--gold); flex-shrink: 0; }
.cust-name { font-size: 14px; font-weight: 500; color: var(--text); }
.cust-sub { font-size: 12px; color: var(--text3); margin-top: 2px; }
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
            <a href="/dashboard" class="nav-item"><svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="2" width="9" height="9" rx="2"/><rect x="13" y="2" width="9" height="9" rx="2"/><rect x="2" y="13" width="9" height="9" rx="2"/><rect x="13" y="13" width="9" height="9" rx="2"/></svg>Kasir</a>
            <a href="/products" class="nav-item"><svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/></svg>Produk</a>
            <a href="/transactions" class="nav-item active"><svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 12h6M9 16h4"/></svg>Transaksi</a>
            <a href="/customers" class="nav-item"><svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="8" cy="7" r="4"/><path d="M2 21v-2a4 4 0 014-4h4a4 4 0 014 4v2"/><path d="M19 8v6M22 11h-6"/></svg>Pelanggan</a>
            <div class="nav-section">Sistem</div>
            <a href="/import" class="nav-item"><svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg>Import CSV</a>
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
            <a href="/transactions" class="back-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                Kembali
            </a>
            <div class="topbar-divider"></div>
            <div class="topbar-title">{{ $sale->invoice }}</div>
            <div class="topbar-actions">
                <a href="/transactions/{{ $sale->id }}/print" target="_blank" class="action-btn btn-gold">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                    Cetak Struk
                </a>
            </div>
        </div>

        <div class="content">
            <div class="detail-grid">

                <!-- LEFT COLUMN -->
                <div>
                    <!-- META -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Informasi Transaksi</div>
                            <span class="badge-lunas"><span class="badge-dot"></span>Lunas</span>
                        </div>
                        <div class="meta-grid">
                            <div class="meta-item">
                                <div class="meta-label">Invoice</div>
                                <div class="meta-val mono">{{ $sale->invoice }}</div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-label">Tanggal</div>
                                <div class="meta-val">{{ $sale->created_at->format('d M Y') }}</div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-label">Waktu</div>
                                <div class="meta-val mono">{{ $sale->created_at->format('H:i:s') }}</div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-label">Jumlah Item</div>
                                <div class="meta-val">{{ $sale->items->count() }} produk</div>
                            </div>
                        </div>
                    </div>

                    <!-- ITEMS TABLE -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Daftar Produk</div>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Qty</th>
                                    <th>Harga Satuan</th>
                                    <th style="text-align:right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sale->items as $item)
                                <tr>
                                    <td>
                                        <div class="item-name">{{ $item->product->name ?? '—' }}</div>
                                        <div class="item-category">{{ $item->product->category->name ?? '' }}</div>
                                    </td>
                                    <td><span class="qty-pill">{{ $item->qty }}</span></td>
                                    <td style="font-family:var(--mono); font-size:13px; color:var(--text2)">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="price-mono">Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- RIGHT COLUMN -->
                <div>
                    <!-- CUSTOMER -->
                    <div class="card" style="margin-bottom:16px">
                        <div class="card-header">
                            <div class="card-title">Pelanggan</div>
                        </div>
                        @php $customerName = $sale->customer->name ?? 'Umum'; @endphp
                        <div class="cust-row">
                            <div class="cust-avatar">{{ strtoupper(substr($customerName, 0, 1)) }}</div>
                            <div>
                                <div class="cust-name">{{ $customerName }}</div>
                                <div class="cust-sub">
                                    {{ $sale->customer->phone ?? 'Tidak ada nomor HP' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SUMMARY -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Ringkasan Pembayaran</div>
                        </div>
                        <div class="summary-section">
                            <div class="summary-row">
                                <span class="summary-label">Subtotal</span>
                                <span class="summary-val">Rp {{ number_format($sale->total, 0, ',', '.') }}</span>
                            </div>
                            <div class="summary-row">
                                <span class="summary-label">Diskon</span>
                                <span class="summary-val">—</span>
                            </div>
                            <hr class="summary-divider">
                            <div class="total-highlight">
                                <span class="total-hl-label">Total</span>
                                <span class="total-hl-val">Rp {{ number_format($sale->total, 0, ',', '.') }}</span>
                            </div>
                            <div class="summary-row" style="margin-bottom:10px">
                                <span class="summary-label">Dibayar</span>
                                <span class="summary-val" style="color:var(--text)">Rp {{ number_format($sale->paid, 0, ',', '.') }}</span>
                            </div>
                            <div class="change-highlight">
                                <span class="change-hl-label">Kembalian</span>
                                <span class="change-hl-val">Rp {{ number_format($sale->change, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
</div>
</body>
</html>
