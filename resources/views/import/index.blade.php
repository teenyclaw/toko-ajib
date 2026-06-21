<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Import CSV — POS</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
:root {
    --bg: #0d0d0f; --bg2: #141416; --bg3: #1c1c1f; --bg4: #242428;
    --border: rgba(255,255,255,0.07); --border2: rgba(255,255,255,0.12);
    --text: #f0ede8; --text2: #9b9891; --text3: #5c5a56;
    --gold: #c9a84c; --gold2: #e8c96a; --gold-dim: rgba(201,168,76,0.12);
    --green: #3ecf8e; --green-dim: rgba(62,207,142,0.1);
    --red: #f87171; --radius: 12px; --radius-sm: 8px;
    --font: 'DM Sans', sans-serif; --mono: 'DM Mono', monospace;
}
html, body { height: 100%; }
body { font-family: var(--font); background: var(--bg); color: var(--text); font-size: 14px; -webkit-font-smoothing: antialiased; }
.app { display: grid; grid-template-columns: 216px 1fr; height: 100vh; overflow: hidden; }
.sb { background: var(--bg2); border-right: 1px solid var(--border); display: flex; flex-direction: column; }
.sb-logo { padding: 20px 16px 18px; border-bottom: 1px solid var(--border); }
.logo { display: flex; align-items: center; gap: 10px; }
.logo-ico { width: 30px; height: 30px; background: var(--gold); border-radius: 7px; display: flex; align-items: center; justify-content: center; }
.logo-ico svg { width: 16px; height: 16px; color: #0d0d0f; }
.logo-name { font-size: 14px; font-weight: 600; color: var(--text); }
.logo-tag { font-size: 9.5px; color: var(--text3); letter-spacing: 0.9px; text-transform: uppercase; }
.nav { padding: 8px 6px; flex: 1; }
.nav-sec { font-size: 9.5px; color: var(--text3); letter-spacing: 1px; text-transform: uppercase; padding: 14px 10px 5px; }
.nav-a { display: flex; align-items: center; gap: 9px; padding: 8px 10px; border-radius: var(--radius-sm); color: var(--text2); text-decoration: none; font-size: 13px; margin-bottom: 1px; }
.nav-a:hover { background: var(--bg3); color: var(--text); }
.nav-a.on { background: var(--gold-dim); color: var(--gold); }
.ni { width: 14px; height: 14px; opacity: 0.6; }
.nav-a.on .ni { opacity: 1; }
.sb-foot { padding: 12px 14px; border-top: 1px solid var(--border); }
.u-row { display: flex; align-items: center; gap: 8px; }
.uav { width: 26px; height: 26px; border-radius: 50%; background: var(--gold-dim); display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: 600; color: var(--gold); }
.u-nm { font-size: 12.5px; font-weight: 500; }
.u-rl { font-size: 10.5px; color: var(--text3); }

.main { display: flex; flex-direction: column; overflow: hidden; }
.topbar { padding: 16px 28px; border-bottom: 1px solid var(--border); flex-shrink: 0; }
.topbar-title { font-size: 16px; font-weight: 500; }

.content-area { flex: 1; overflow-y: auto; padding: 28px; display: grid; grid-template-columns: 420px 1fr; gap: 24px; align-items: start; }

.card { background: var(--bg2); border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; }
.card-header { padding: 16px 20px; border-bottom: 1px solid var(--border); }
.card-title { font-size: 13.5px; font-weight: 500; }
.card-sub { font-size: 12px; color: var(--text3); margin-top: 2px; }
.card-body { padding: 20px; }

.dropzone { border: 1.5px dashed var(--border2); border-radius: var(--radius); padding: 32px; text-align: center; cursor: pointer; transition: all 0.2s; position: relative; margin-bottom: 20px; }
.dropzone:hover, .dropzone.drag { border-color: var(--gold); background: var(--gold-dim); }
.dropzone input[type=file] { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; }
.dz-icon { width: 36px; height: 36px; margin: 0 auto 10px; color: var(--text3); }
.dz-icon svg { width: 100%; height: 100%; }
.dz-text { font-size: 13.5px; font-weight: 500; color: var(--text2); }
.dz-sub { font-size: 12px; color: var(--text3); margin-top: 4px; }
.dz-file-name { font-size: 12.5px; font-family: var(--mono); color: var(--gold); margin-top: 8px; display: none; }

.form-label { font-size: 11.5px; color: var(--text3); text-transform: uppercase; letter-spacing: 0.7px; font-weight: 500; display: block; margin-bottom: 7px; }
.form-select { width: 100%; background: var(--bg3); border: 1px solid var(--border2); color: var(--text); border-radius: var(--radius-sm); padding: 10px 13px; font-family: var(--font); font-size: 13.5px; outline: none; appearance: none; cursor: pointer; margin-bottom: 16px; }
.form-input { width: 100%; background: var(--bg3); border: 1px solid var(--border2); color: var(--text); border-radius: var(--radius-sm); padding: 10px 13px; font-family: var(--font); font-size: 13.5px; outline: none; margin-bottom: 16px; transition: border 0.15s; }
.form-input:focus { border-color: var(--gold); }
.submit-btn { width: 100%; padding: 12px; background: var(--gold); color: #0d0d0f; border: none; border-radius: var(--radius-sm); cursor: pointer; font-family: var(--font); font-size: 14px; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 8px; transition: all 0.15s; }
.submit-btn:hover { background: var(--gold2); }
.submit-btn svg { width: 15px; height: 15px; }

.alert { border-radius: var(--radius-sm); padding: 12px 16px; font-size: 13px; margin-bottom: 16px; display: flex; align-items: flex-start; gap: 10px; }
.alert-success { background: var(--green-dim); border: 1px solid rgba(62,207,142,0.2); color: var(--green); }
.alert-error { background: rgba(248,113,113,0.08); border: 1px solid rgba(248,113,113,0.2); color: var(--red); }
.alert svg { width: 15px; height: 15px; flex-shrink: 0; margin-top: 1px; }

/* CSV GUIDE */
.col-table { width: 100%; border-collapse: collapse; }
.col-table thead th { font-size: 10.5px; color: var(--text3); text-transform: uppercase; letter-spacing: 0.7px; padding: 0 12px 8px; text-align: left; border-bottom: 1px solid var(--border); }
.col-table tbody tr { border-bottom: 1px solid var(--border); }
.col-table tbody td { padding: 9px 12px; font-size: 12.5px; color: var(--text2); vertical-align: middle; }
.col-name { font-family: var(--mono); font-size: 12px; color: var(--gold); background: var(--gold-dim); padding: 2px 7px; border-radius: 4px; }
.req-badge { font-size: 10px; padding: 2px 7px; border-radius: 4px; font-weight: 500; }
.req-y { background: rgba(248,113,113,0.1); color: var(--red); }
.req-n { background: var(--bg4); color: var(--text3); }

.example-wrap { margin-top: 16px; background: var(--bg3); border-radius: var(--radius-sm); padding: 14px 16px; }
.example-label { font-size: 10.5px; color: var(--text3); text-transform: uppercase; letter-spacing: 0.7px; margin-bottom: 8px; font-weight: 500; }
.example-code { font-family: var(--mono); font-size: 11px; color: var(--text2); line-height: 1.8; overflow-x: auto; white-space: pre; }
</style>
</head>
<body>
<div class="app">
    @include('partials.sidebar', ['active' => 'import'])

    <main class="main">
        <div class="topbar">
            <div class="topbar-title">Import Produk CSV</div>
        </div>

        <div class="content-area">
            <!-- FORM -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Upload File CSV</div>
                    <div class="card-sub">Format: UTF-8, separator koma</div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        {{ session('success') }}
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="alert alert-error">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        {{ session('error') }}
                    </div>
                    @endif

                    <form method="POST" action="/import" enctype="multipart/form-data" id="import-form">
                        @csrf

                        <div class="dropzone" id="dropzone">
                            <input type="file" name="file" accept=".csv,.txt" id="file-input" required onchange="onFileChange(this)">
                            <div class="dz-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="18" x2="12" y2="12"/><line x1="9" y1="15" x2="12" y2="12"/><line x1="15" y1="15" x2="12" y2="12"/></svg></div>
                            <div class="dz-text">Klik atau drag file CSV</div>
                            <div class="dz-sub">Maksimal 10MB, format .csv</div>
                            <div class="dz-file-name" id="file-name"></div>
                        </div>

                        <label class="form-label">Mode Import</label>
                        <select name="mode" class="form-select">
                            <option value="all">Semua Kategori</option>
                            <option value="per_kategori">Per Kategori</option>
                        </select>

                        <label class="form-label">Filter Kategori (opsional)</label>
                        <input type="text" name="category" class="form-input" placeholder="Kosongkan jika semua kategori">

                        <button type="submit" class="submit-btn">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg>
                            Mulai Import
                        </button>
                    </form>
                </div>
            </div>

            <!-- GUIDE -->
            <div>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Panduan Kolom CSV</div>
                        <div class="card-sub">Header harus persis seperti di bawah</div>
                    </div>
                    <table class="col-table">
                        <thead>
                            <tr><th>Kolom</th><th>Keterangan</th><th>Wajib</th></tr>
                        </thead>
                        <tbody>
                            <tr><td><span class="col-name">name</span></td><td style="font-size:12.5px; color:var(--text2)">Nama produk</td><td><span class="req-badge req-y">Wajib</span></td></tr>
                            <tr><td><span class="col-name">category</span></td><td style="font-size:12.5px; color:var(--text2)">Nama kategori</td><td><span class="req-badge req-n">Opsional</span></td></tr>
                            <tr><td><span class="col-name">harga_beli_dus</span></td><td style="font-size:12.5px; color:var(--text2)">Harga beli per dus</td><td><span class="req-badge req-y">Wajib</span></td></tr>
                            <tr><td><span class="col-name">qty_per_dus</span></td><td style="font-size:12.5px; color:var(--text2)">Jumlah pcs dalam 1 dus</td><td><span class="req-badge req-y">Wajib</span></td></tr>
                            <tr><td><span class="col-name">margin_dus</span></td><td style="font-size:12.5px; color:var(--text2)">Margin harga dus</td><td><span class="req-badge req-n">Opsional</span></td></tr>
                            <tr><td><span class="col-name">margin_dus_type</span></td><td style="font-size:12.5px; color:var(--text2)">percent / nominal</td><td><span class="req-badge req-n">Opsional</span></td></tr>
                            <tr><td><span class="col-name">margin_pcs</span></td><td style="font-size:12.5px; color:var(--text2)">Margin harga pcs</td><td><span class="req-badge req-n">Opsional</span></td></tr>
                            <tr><td><span class="col-name">margin_pcs_type</span></td><td style="font-size:12.5px; color:var(--text2)">percent / nominal</td><td><span class="req-badge req-n">Opsional</span></td></tr>
                            <tr><td><span class="col-name">stock</span></td><td style="font-size:12.5px; color:var(--text2)">Stok awal</td><td><span class="req-badge req-n">Opsional</span></td></tr>
                        </tbody>
                    </table>
                    <div style="padding: 16px 20px">
                        <div class="example-wrap">
                            <div class="example-label">Contoh baris CSV</div>
                            <div class="example-code">name,category,harga_beli_dus,qty_per_dus,margin_dus,margin_dus_type,stock
Indomie Goreng,Mie Instan,48000,40,15,percent,200
Aqua 600ml,Minuman,18000,24,10,percent,500</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
function onFileChange(input) {
    const name = input.files[0]?.name;
    const el = document.getElementById('file-name');
    el.textContent = name || '';
    el.style.display = name ? 'block' : 'none';
}

const dz = document.getElementById('dropzone');
dz.addEventListener('dragover', e => { e.preventDefault(); dz.classList.add('drag'); });
dz.addEventListener('dragleave', () => dz.classList.remove('drag'));
dz.addEventListener('drop', e => { e.preventDefault(); dz.classList.remove('drag'); });
</script>
</body>
</html>
