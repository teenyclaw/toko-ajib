{{-- ============================================================
     CUSTOMERS: resources/views/customers/index.blade.php
     IMPORT:    resources/views/import/index.blade.php
     Kedua file ini menggunakan layout yang sama, 
     copy sesuai kebutuhan.
     ============================================================ --}}

{{-- =================== CUSTOMERS INDEX ====================== --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pelanggan — POS</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
:root {
    --bg: #0d0d0f; --bg2: #141416; --bg3: #1c1c1f; --bg4: #242428;
    --border: rgba(255,255,255,0.07); --border2: rgba(255,255,255,0.12);
    --text: #f0ede8; --text2: #9b9891; --text3: #5c5a56;
    --gold: #c9a84c; --gold2: #e8c96a; --gold-dim: rgba(201,168,76,0.12);
    --green: #3ecf8e; --radius: 12px; --radius-sm: 8px;
    --font: 'DM Sans', sans-serif; --mono: 'DM Mono', monospace;
}
html, body { height: 100%; }
body { font-family: var(--font); background: var(--bg); color: var(--text); font-size: 14px; -webkit-font-smoothing: antialiased; }
.app { display: grid; grid-template-columns: 220px 1fr; height: 100vh; overflow: hidden; }
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

.main { display: flex; flex-direction: column; overflow: hidden; }
.topbar { padding: 16px 28px; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 12px; flex-shrink: 0; }
.topbar-title { font-size: 16px; font-weight: 500; flex: 1; }

.content-area { flex: 1; overflow-y: auto; padding: 24px 28px; display: grid; grid-template-columns: 340px 1fr; gap: 24px; align-items: start; }
.content-area::-webkit-scrollbar { width: 4px; }
.content-area::-webkit-scrollbar-thumb { background: var(--bg4); border-radius: 2px; }

.card { background: var(--bg2); border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; }
.card-header { padding: 16px 20px; border-bottom: 1px solid var(--border); }
.card-title { font-size: 13.5px; font-weight: 500; }
.card-sub { font-size: 12px; color: var(--text3); margin-top: 2px; }
.card-body { padding: 20px; }

.form-group { margin-bottom: 16px; }
.form-label { font-size: 11.5px; color: var(--text3); text-transform: uppercase; letter-spacing: 0.7px; font-weight: 500; display: block; margin-bottom: 7px; }
.form-input { width: 100%; background: var(--bg3); border: 1px solid var(--border2); color: var(--text); border-radius: var(--radius-sm); padding: 10px 13px; font-family: var(--font); font-size: 13.5px; outline: none; transition: border 0.15s; }
.form-input:focus { border-color: var(--gold); }
.form-input::placeholder { color: var(--text3); }
.submit-btn { width: 100%; padding: 11px; background: var(--gold); color: #0d0d0f; border: none; border-radius: var(--radius-sm); cursor: pointer; font-family: var(--font); font-size: 13.5px; font-weight: 600; transition: all 0.15s; }
.submit-btn:hover { background: var(--gold2); }

.alert-success { background: rgba(62,207,142,0.1); border: 1px solid rgba(62,207,142,0.2); color: var(--green); border-radius: var(--radius-sm); padding: 10px 14px; font-size: 13px; margin-bottom: 16px; }
.alert-error { background: rgba(248,113,113,0.1); border: 1px solid rgba(248,113,113,0.2); color: #f87171; border-radius: var(--radius-sm); padding: 10px 14px; font-size: 13px; margin-bottom: 16px; }

table { width: 100%; border-collapse: collapse; }
thead th { font-size: 11px; color: var(--text3); text-transform: uppercase; letter-spacing: 0.8px; font-weight: 500; padding: 0 14px 10px; text-align: left; border-bottom: 1px solid var(--border); }
tbody tr { border-bottom: 1px solid var(--border); transition: background 0.1s; }
tbody tr:hover { background: var(--bg3); }
tbody td { padding: 13px 14px; font-size: 13.5px; color: var(--text2); }
.cust-name { font-weight: 500; color: var(--text); display: flex; align-items: center; gap: 10px; }
.cust-avatar { width: 28px; height: 28px; border-radius: 50%; background: var(--gold-dim); display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 500; color: var(--gold); flex-shrink: 0; }
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
            <a href="/transactions" class="nav-item"><svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 12h6M9 16h4"/></svg>Transaksi</a>
            <a href="/customers" class="nav-item active"><svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="8" cy="7" r="4"/><path d="M2 21v-2a4 4 0 014-4h4a4 4 0 014 4v2"/><path d="M19 8v6M22 11h-6"/></svg>Pelanggan</a>
            <div class="nav-section">Sistem</div>
            <a href="/import" class="nav-item"><svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg>Import CSV</a>
        </nav>
        <div class="sidebar-footer">
            <div class="user-card">
                <div class="avatar">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</div>
                <div><div class="user-name">{{ auth()->user()->name ?? 'Admin' }}</div><div class="user-role">Kasir</div></div>
            </div>
        </div>
    </aside>

    <main class="main">
        <div class="topbar">
            <div class="topbar-title">Manajemen Pelanggan</div>
        </div>

        <div class="content-area">
            <!-- FORM -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Tambah Pelanggan</div>
                    <div class="card-sub">Isi form untuk menambah data baru</div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert-success">{{ session('success') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="alert-error">{{ $errors->first() }}</div>
                    @endif

                    <form method="POST" action="/customers">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-input" placeholder="Nama pelanggan" required value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">No. Handphone</label>
                            <input type="text" name="phone" class="form-input" placeholder="08xx-xxxx-xxxx" value="{{ old('phone') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Alamat</label>
                            <input type="text" name="address" class="form-input" placeholder="Alamat (opsional)" value="{{ old('address') }}">
                        </div>
                        <button type="submit" class="submit-btn">Simpan Pelanggan</button>
                    </form>
                </div>
            </div>

            <!-- TABLE -->
            <div class="card">
                <div class="card-header" style="display:flex; justify-content:space-between; align-items:center">
                    <div>
                        <div class="card-title">Daftar Pelanggan</div>
                        <div class="card-sub">{{ $customers->count() }} pelanggan terdaftar</div>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>No. HP</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $c)
                        <tr>
                            <td>
                                <div class="cust-name">
                                    <div class="cust-avatar">{{ strtoupper(substr($c->name, 0, 1)) }}</div>
                                    {{ $c->name }}
                                </div>
                            </td>
                            <td style="font-family:var(--mono); font-size:13px">{{ $c->phone ?: '—' }}</td>
                            <td>{{ $c->address ?: '—' }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="3" style="text-align:center; color:var(--text3); padding:32px">Belum ada pelanggan</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
</body>
</html>
