<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Pengaturan Pesanan Online — POS AJIB</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{--bg:#09090b;--bg2:#111114;--bg3:#18181c;--bg4:#202025;--bd:rgba(255,255,255,.06);--bd2:rgba(255,255,255,.1);--tx:#ede9e2;--tx2:#938f88;--tx3:#4e4c49;--go:#c9a44e;--go2:#e4bf6a;--gd:rgba(201,164,78,.12);--gn:#3ecf8e;--gnd:rgba(62,207,142,.12);--rr:12px;--rs:8px;--fn:'DM Sans',sans-serif;--mo:'DM Mono',monospace}
html,body{min-height:100%}
body{font-family:var(--fn);background:var(--bg);color:var(--tx);font-size:14px;line-height:1.5}
.app{display:grid;grid-template-columns:216px 1fr;min-height:100vh}
.sb{background:var(--bg2);border-right:1px solid var(--bd);display:flex;flex-direction:column}
.sb-logo{padding:20px 16px 18px;border-bottom:1px solid var(--bd)}
.logo{display:flex;align-items:center;gap:10px}
.logo-ico{width:30px;height:30px;background:var(--go);border-radius:7px;display:flex;align-items:center;justify-content:center}
.logo-ico svg{width:16px;height:16px;color:#09090b}
.logo-name{font-size:14px;font-weight:600}
.logo-tag{font-size:9.5px;color:var(--tx3);text-transform:uppercase;letter-spacing:.9px}
.nav{padding:8px 6px;flex:1}
.nav-sec{font-size:9.5px;color:var(--tx3);text-transform:uppercase;letter-spacing:1px;padding:14px 10px 5px}
.nav-a{display:flex;align-items:center;gap:9px;padding:8px 10px;border-radius:var(--rs);color:var(--tx2);text-decoration:none;font-size:13px;margin-bottom:1px}
.nav-a:hover{background:var(--bg3);color:var(--tx)}
.nav-a.on{background:var(--gd);color:var(--go)}
.ni{width:14px;height:14px;opacity:.6}
.nav-a.on .ni{opacity:1}
.sb-foot{padding:12px 14px;border-top:1px solid var(--bd)}
.u-row{display:flex;align-items:center;gap:8px}
.uav{width:26px;height:26px;border-radius:50%;background:var(--gd);border:1px solid rgba(201,164,78,.17);display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:600;color:var(--go)}
.u-nm{font-size:12.5px;font-weight:500}
.u-rl{font-size:10.5px;color:var(--tx3)}
.main{padding:0 0 40px}
.topbar{height:52px;padding:0 22px;border-bottom:1px solid var(--bd);background:var(--bg2);display:flex;align-items:center;gap:10px}
.tb-ttl{font-size:14.5px;font-weight:500;flex:1}
.wrap{max-width:720px;padding:24px 22px}
.alert{padding:12px 14px;border-radius:var(--rs);margin-bottom:16px;background:var(--gnd);color:var(--gn);border:1px solid rgba(62,207,142,.25);font-size:13px}
.card{background:var(--bg2);border:1px solid var(--bd);border-radius:var(--rr);padding:20px;margin-bottom:16px}
.card-ttl{font-size:13px;font-weight:600;margin-bottom:4px}
.card-sub{font-size:12px;color:var(--tx2);margin-bottom:16px}
.field{margin-bottom:14px}
.field label{display:block;font-size:12px;color:var(--tx2);margin-bottom:6px}
.field input,.field textarea{width:100%;padding:11px 12px;border-radius:var(--rs);background:var(--bg3);border:1px solid var(--bd2);color:var(--tx);font-family:var(--fn);font-size:14px}
.field input:focus,.field textarea:focus{outline:none;border-color:var(--go)}
.field textarea{min-height:80px;resize:vertical}
.btn{display:inline-flex;align-items:center;justify-content:center;gap:6px;padding:10px 16px;border-radius:var(--rs);border:none;cursor:pointer;font-family:var(--fn);font-size:13px;font-weight:600;text-decoration:none;transition:all .14s}
.btn-primary{background:var(--go);color:#09090b}
.btn-primary:hover{background:var(--go2)}
.btn-ghost{background:var(--bg3);color:var(--tx2);border:1px solid var(--bd2)}
.btn-ghost:hover{border-color:var(--go);color:var(--go)}
.btn-wa{background:#25D366;color:#fff}
.btn-wa:hover{filter:brightness(1.05)}
.btn-row{display:flex;gap:8px;flex-wrap:wrap;margin-top:12px}
.link-box{display:flex;gap:8px;align-items:center;margin-top:10px}
.link-box input{flex:1;padding:10px 12px;border-radius:var(--rs);background:var(--bg3);border:1px solid var(--bd2);color:var(--tx);font-family:var(--mo);font-size:12px}
.qr-wrap{display:flex;flex-direction:column;align-items:center;gap:10px;margin-top:16px;padding:16px;background:var(--bg3);border-radius:var(--rs);border:1px solid var(--bd)}
#qrcode{background:#fff;padding:10px;border-radius:8px}
.qr-hint{font-size:11px;color:var(--tx3);text-align:center}
</style>
</head>
<body>
<div class="app">
@include('partials.sidebar', ['active' => 'settings-order'])

<main class="main">
<div class="topbar">
  <div class="tb-ttl">Pengaturan Pesanan Online</div>
  <a href="/dashboard" class="btn btn-ghost" style="padding:7px 12px">← Kasir</a>
</div>

<div class="wrap">
  @if(session('success'))
    <div class="alert">{{ session('success') }}</div>
  @endif

  <form method="POST" action="{{ route('settings.order') }}">
    @csrf
    <div class="card">
      <div class="card-ttl">Informasi Toko</div>
      <div class="card-sub">Digunakan di struk WhatsApp dan halaman pesanan pelanggan.</div>
      <div class="field">
        <label for="store_name">Nama Toko</label>
        <input type="text" id="store_name" name="store_name" value="{{ old('store_name', $settings->store_name) }}" required maxlength="255">
      </div>
      <div class="field">
        <label for="store_whatsapp">No. WhatsApp Toko</label>
        <input type="tel" id="store_whatsapp" name="store_whatsapp" value="{{ old('store_whatsapp', $settings->store_whatsapp) }}" placeholder="08xxxxxxxxxx" maxlength="30">
        <div style="font-size:11px;color:var(--tx3);margin-top:4px">Pelanggan akan mengirim konfirmasi pesanan ke nomor ini.</div>
      </div>
      <div class="field">
        <label for="catalog_share_message">Pesan bagikan katalog</label>
        <textarea id="catalog_share_message" name="catalog_share_message" placeholder="Halo! Silakan pesan produk kami...">{{ old('catalog_share_message', $settings->catalog_share_message) }}</textarea>
      </div>
      <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
    </div>
  </form>

  <div class="card">
    <div class="card-ttl">Link Katalog Pelanggan</div>
    <div class="card-sub">Bagikan link ini ke pelanggan via WhatsApp, status WA, atau cetak QR.</div>
    <div class="link-box">
      <input type="text" id="catalog-url" value="{{ $catalogUrl }}" readonly>
      <button type="button" class="btn btn-ghost" onclick="copyCatalogUrl()">Salin</button>
    </div>
    <div class="btn-row">
      <a href="{{ $shareUrl }}" target="_blank" class="btn btn-wa">Bagikan via WhatsApp</a>
      <a href="{{ $catalogUrl }}" target="_blank" class="btn btn-ghost">Buka Katalog</a>
    </div>
    <div class="qr-wrap">
      <div id="qrcode"></div>
      <div class="qr-hint">Scan untuk buka katalog pesanan online</div>
    </div>
  </div>
</div>
</main>
</div>

<script>
const catalogUrl = @json($catalogUrl);

new QRCode(document.getElementById('qrcode'), {
  text: catalogUrl,
  width: 180,
  height: 180,
  colorDark: '#000000',
  colorLight: '#ffffff',
  correctLevel: QRCode.CorrectLevel.M,
});

function copyCatalogUrl() {
  const input = document.getElementById('catalog-url');
  input.select();
  input.setSelectionRange(0, 99999);
  navigator.clipboard.writeText(catalogUrl).then(() => {
    alert('Link katalog disalin!');
  }).catch(() => {
    document.execCommand('copy');
    alert('Link katalog disalin!');
  });
}
</script>
</body>
</html>
