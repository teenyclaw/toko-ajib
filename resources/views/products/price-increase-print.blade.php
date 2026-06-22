<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Info Kenaikan Harga — {{ $date }}</title>
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }

body {
  font-family: 'DM Sans', sans-serif;
  background: #faf9f7;
  color: #1a1a1a;
}

.page { max-width: 400px; margin: 0 auto; background: #fff; min-height: 100vh; }

.screen-view { padding: 28px 24px; }
.screen-title { font-size: 18px; font-weight: 600; text-align: center; margin-bottom: 4px; }
.screen-date { font-size: 12px; color: #666; text-align: center; margin-bottom: 20px; }
.screen-item { padding: 10px 0; border-bottom: 1px solid #e8e5e0; }
.screen-name { font-weight: 500; font-size: 14px; margin-bottom: 4px; }
.screen-row { display: flex; justify-content: space-between; font-size: 13px; color: #444; font-family: 'DM Mono', monospace; }
.screen-row span:last-child { font-weight: 500; color: #1a1a1a; }

.print-actions { padding: 16px 24px; border-top: 1px solid #e8e5e0; display: flex; gap: 10px; }
.btn { flex: 1; padding: 10px; border-radius: 8px; font-size: 13px; font-weight: 500; cursor: pointer; text-align: center; border: none; }
.btn-primary { background: #1a1a1a; color: #fff; }
.btn-secondary { background: #fff; color: #666; border: 1px solid #e8e5e0; }

.receipt-thermal { display: none; }

@media print {
  @page { size: 58mm auto; margin: 1.5mm 1mm; }

  html, body {
    width: 58mm;
    margin: 0;
    padding: 0;
    background: #fff !important;
  }

  .print-actions,
  .screen-view { display: none !important; }

  .page { max-width: none; width: 58mm; margin: 0; min-height: 0; }

  .receipt-thermal {
    display: block !important;
    width: 56mm;
    font-family: 'Courier New', Courier, monospace;
    font-size: 11px;
    font-weight: 600;
    color: #000;
    -webkit-font-smoothing: none;
    line-height: 1.35;
  }

  .t-header { text-align: center; margin-bottom: 6px; }
  .t-name { font-size: 13px; font-weight: 700; }
  .t-sub { font-size: 9px; letter-spacing: 1px; margin-top: 2px; }
  .t-meta { font-size: 10px; margin-bottom: 3px; text-align: center; }
  .t-hr { border: none; border-top: 1px dashed #000; margin: 6px 0; }
  .t-item { margin-bottom: 6px; }
  .t-item-name { font-size: 11px; font-weight: 700; word-break: break-word; }
  .t-row { display: flex; justify-content: space-between; font-size: 10px; margin-top: 2px; gap: 4px; }
  .t-footer { text-align: center; font-size: 10px; margin-top: 6px; font-weight: 400; }
}
</style>
</head>
<body>

<div class="page">

  <div class="screen-view">
    <div class="screen-title">INFO KENAIKAN HARGA</div>
    <div class="screen-title" style="font-size:14px;margin-bottom:2px">TOKO AJIB</div>
    <div class="screen-date">Tanggal: {{ $date }}</div>

    @foreach($items as $item)
    <div class="screen-item">
      <div class="screen-name">{{ $item['name'] }}</div>
      <div class="screen-row"><span>Jual Pcs</span><span>{{ number_format($item['harga_jual_pcs'], 0, ',', '.') }}</span></div>
      <div class="screen-row"><span>Jual Dus</span><span>{{ number_format($item['harga_jual_dus'], 0, ',', '.') }}</span></div>
    </div>
    @endforeach
  </div>

  <div class="receipt-thermal">
    <div class="t-header">
      <div class="t-name">TOKO AJIB</div>
      <div class="t-sub">INFO KENAIKAN HARGA</div>
    </div>
    <hr class="t-hr">
    <div class="t-meta">Tanggal: {{ $date }}</div>
    <hr class="t-hr">

    @foreach($items as $item)
    <div class="t-item">
      <div class="t-item-name">{{ $item['name'] }}</div>
      <div class="t-row"><span>Jual Pcs</span><span>{{ number_format($item['harga_jual_pcs'], 0, ',', '.') }}</span></div>
      <div class="t-row"><span>Jual Dus</span><span>{{ number_format($item['harga_jual_dus'], 0, ',', '.') }}</span></div>
    </div>
    @endforeach

    <hr class="t-hr">
    <div class="t-footer">{{ count($items) }} produk</div>
  </div>

  <div class="print-actions">
    <button class="btn btn-primary" onclick="window.print()">Cetak Struk</button>
    <button class="btn btn-secondary" onclick="window.close()">Tutup</button>
  </div>
</div>

<script>
window.onload = function() { window.print(); };
</script>
</body>
</html>
