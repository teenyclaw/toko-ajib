<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Struk #{{ $sale->invoice }}</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }

:root {
    --bg: #faf9f7;
    --text: #1a1a1a;
    --text2: #666;
    --text3: #999;
    --border: #e8e5e0;
    --gold: #b8860b;
    --mono: 'DM Mono', monospace;
    --sans: 'DM Sans', sans-serif;
}

body { font-family: var(--sans); background: var(--bg); color: var(--text); -webkit-font-smoothing: antialiased; }

.page { max-width: 340px; margin: 0 auto; background: white; min-height: 100vh; }

.receipt-screen { padding: 32px 24px; }

/* HEADER */
.receipt-header { text-align: center; margin-bottom: 24px; }
.store-icon { width: 40px; height: 40px; background: var(--text); border-radius: 10px; margin: 0 auto 10px; display: flex; align-items: center; justify-content: center; }
.store-icon svg { width: 22px; height: 22px; color: white; }
.store-name { font-size: 18px; font-weight: 600; letter-spacing: -0.3px; }
.store-sub { font-size: 11px; color: var(--text3); letter-spacing: 1.5px; text-transform: uppercase; margin-top: 2px; }

/* DIVIDER */
.divider { border: none; border-top: 1px dashed var(--border); margin: 18px 0; }
.divider-solid { border: none; border-top: 1px solid var(--border); margin: 18px 0; }

/* META */
.meta-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 7px; }
.meta-label { font-size: 11.5px; color: var(--text3); }
.meta-val { font-size: 12px; font-family: var(--mono); color: var(--text2); }
.meta-val.inv { color: var(--text); font-weight: 500; }

/* ITEMS */
.items-header { display: grid; grid-template-columns: 1fr 40px 80px; gap: 8px; font-size: 10px; color: var(--text3); text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 10px; font-weight: 500; }
.items-header span:last-child { text-align: right; }

.item-row { display: grid; grid-template-columns: 1fr 40px 80px; gap: 8px; margin-bottom: 9px; align-items: start; }
.item-name { font-size: 13px; color: var(--text); font-weight: 500; line-height: 1.3; }
.item-unit { font-size: 11px; color: var(--text3); font-family: var(--mono); margin-top: 2px; }
.item-qty { font-size: 12.5px; font-family: var(--mono); color: var(--text2); text-align: center; padding-top: 1px; }
.item-total { font-size: 12.5px; font-family: var(--mono); color: var(--text); text-align: right; padding-top: 1px; }

/* SUMMARY */
.summary { margin-top: 14px; }
.summary-row { display: flex; justify-content: space-between; margin-bottom: 8px; }
.summary-label { font-size: 12.5px; color: var(--text2); }
.summary-val { font-size: 12.5px; font-family: var(--mono); color: var(--text2); }

.total-row { background: var(--text); border-radius: 8px; padding: 12px 14px; display: flex; justify-content: space-between; align-items: center; margin: 14px 0; }
.total-label-w { font-size: 12px; color: rgba(255,255,255,0.6); font-weight: 500; }
.total-val-w { font-size: 17px; font-family: var(--mono); color: white; font-weight: 500; }

.change-row { background: #f0faf5; border: 1px solid #c6eedd; border-radius: 8px; padding: 11px 14px; display: flex; justify-content: space-between; align-items: center; }
.change-label { font-size: 12px; color: #2d7a54; }
.change-val { font-family: var(--mono); font-size: 14px; color: #2d7a54; font-weight: 500; }

/* CUSTOMER */
.customer-box { display: flex; align-items: center; gap: 10px; background: #f9f8f6; border: 1px solid var(--border); border-radius: 8px; padding: 10px 12px; margin-bottom: 18px; }
.customer-avatar { width: 30px; height: 30px; border-radius: 50%; background: var(--text); display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 600; color: white; flex-shrink: 0; }
.customer-name { font-size: 13px; font-weight: 500; }
.customer-sub { font-size: 11px; color: var(--text3); }

/* FOOTER */
.receipt-footer { text-align: center; margin-top: 24px; }
.thank-you { font-size: 14px; font-weight: 500; margin-bottom: 4px; }
.footer-note { font-size: 11px; color: var(--text3); }
.barcode { font-family: var(--mono); font-size: 9px; color: var(--border); margin-top: 12px; letter-spacing: 3px; }

/* PRINT ACTIONS */
.print-actions { padding: 20px 24px; border-top: 1px solid var(--border); display: flex; gap: 10px; }
.btn { flex: 1; padding: 11px; border-radius: 8px; font-family: var(--sans); font-size: 13.5px; font-weight: 500; cursor: pointer; text-align: center; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 7px; transition: all 0.15s; }
.btn-primary { background: var(--text); color: white; border: none; }
.btn-primary:hover { background: #333; }
.btn-secondary { background: white; color: var(--text2); border: 1px solid var(--border); }
.btn-secondary:hover { background: var(--bg); }
.btn svg { width: 15px; height: 15px; }

/* Thermal layout — hidden on screen */
.receipt-thermal { display: none; }

@media print {
    @page {
        size: 58mm auto;
        margin: 1.5mm 1mm;
    }

    html, body {
        width: 58mm;
        margin: 0;
        padding: 0;
        background: #fff !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    .print-actions,
    .receipt-screen {
        display: none !important;
    }

    .page {
        max-width: none;
        width: 58mm;
        margin: 0;
        min-height: 0;
        background: #fff;
    }

    .receipt-thermal {
        display: block !important;
        width: 56mm;
        padding: 0;
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
    .t-meta { font-size: 10px; margin-bottom: 3px; }
    .t-hr { border: none; border-top: 1px dashed #000; margin: 6px 0; }
    .t-item { margin-bottom: 5px; }
    .t-item-name { font-size: 11px; font-weight: 700; word-break: break-word; }
    .t-item-line {
        display: flex;
        justify-content: space-between;
        font-size: 10px;
        margin-top: 1px;
        gap: 4px;
    }
    .t-row {
        display: flex;
        justify-content: space-between;
        font-size: 10px;
        margin-bottom: 3px;
        gap: 4px;
    }
    .t-total {
        font-size: 12px;
        font-weight: 700;
        text-align: center;
        margin: 6px 0;
    }
    .t-footer { text-align: center; font-size: 11px; font-weight: 700; margin-top: 4px; }
    .t-note { text-align: center; font-size: 9px; margin-top: 4px; font-weight: 400; }
}
</style>
</head>
<body>

@php $customerName = $sale->customer->name ?? 'Umum'; @endphp

<div class="page">

    {{-- Tampilan layar (cantik) --}}
    <div class="receipt-screen">

        <div class="receipt-header">
            <div class="store-icon">
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M3 3h7v7H3V3zm0 11h7v7H3v-7zm11-11h7v7h-7V3zm4 11h-1v3h-3v1h3v3h1v-3h3v-1h-3v-3z"/></svg>
            </div>
            <div class="store-name">TOKO AJIB</div>
            <div class="store-sub">Point of Sale</div>
        </div>

        <hr class="divider">

        <div class="meta-row">
            <span class="meta-label">Invoice</span>
            <span class="meta-val inv">{{ $sale->invoice }}</span>
        </div>
        <div class="meta-row">
            <span class="meta-label">Tanggal</span>
            <span class="meta-val">{{ $sale->created_at->format('d M Y, H:i') }}</span>
        </div>

        <hr class="divider">

        <div class="customer-box">
            <div class="customer-avatar">{{ strtoupper(substr($customerName, 0, 1)) }}</div>
            <div>
                <div class="customer-name">{{ $customerName }}</div>
                <div class="customer-sub">Pelanggan</div>
            </div>
        </div>

        <div class="items-header">
            <span>Produk</span>
            <span style="text-align:center">Qty</span>
            <span>Total</span>
        </div>

        @foreach($sale->items as $item)
        <div class="item-row">
            <div>
                <div class="item-name">{{ $item->name ?? $item->product?->name ?? '—' }}</div>
                <div class="item-unit">Rp {{ number_format($item->price, 0, ',', '.') }} / pcs</div>
            </div>
            <div class="item-qty">{{ $item->qty }}</div>
            <div class="item-total">{{ number_format($item->price * $item->qty, 0, ',', '.') }}</div>
        </div>
        @endforeach

        <hr class="divider-solid">

        <div class="summary">
            <div class="summary-row">
                <span class="summary-label">Subtotal ({{ $sale->items->count() }} item)</span>
                <span class="summary-val">{{ number_format($sale->total, 0, ',', '.') }}</span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Diskon</span>
                <span class="summary-val">0</span>
            </div>
        </div>

        <div class="total-row">
            <span class="total-label-w">Total</span>
            <span class="total-val-w">Rp {{ number_format($sale->total, 0, ',', '.') }}</span>
        </div>

        <div class="summary-row" style="margin-bottom:10px">
            <span class="summary-label">Dibayar</span>
            <span class="summary-val">Rp {{ number_format($sale->paid, 0, ',', '.') }}</span>
        </div>

        <div class="change-row">
            <span class="change-label">Kembalian</span>
            <span class="change-val">Rp {{ number_format($sale->change, 0, ',', '.') }}</span>
        </div>

        <hr class="divider">

        <div class="receipt-footer">
            <div class="thank-you">Terima kasih!</div>
            <div class="footer-note">Barang yang sudah dibeli tidak dapat dikembalikan.</div>
            <div class="barcode">{{ str_pad($sale->id, 12, '0', STR_PAD_LEFT) }}</div>
        </div>

    </div>

    {{-- Tampilan print thermal 58mm --}}
    <div class="receipt-thermal">
        <div class="t-header">
            <div class="t-name">TOKO AJIB</div>
            <div class="t-sub">POINT OF SALE</div>
        </div>

        <hr class="t-hr">

        <div class="t-meta">Invoice: {{ $sale->invoice }}</div>
        <div class="t-meta">Tanggal: {{ $sale->created_at->format('d/m/Y H:i') }}</div>
        <div class="t-meta">Pelanggan: {{ $customerName }}</div>

        <hr class="t-hr">

        @foreach($sale->items as $item)
        <div class="t-item">
            <div class="t-item-name">{{ $item->name ?? $item->product?->name ?? '—' }}</div>
            <div class="t-item-line">
                <span>{{ $item->qty }} x {{ number_format($item->price, 0, ',', '.') }}</span>
                <span>{{ number_format($item->price * $item->qty, 0, ',', '.') }}</span>
            </div>
        </div>
        @endforeach

        <hr class="t-hr">

        <div class="t-row">
            <span>Subtotal</span>
            <span>{{ number_format($sale->total, 0, ',', '.') }}</span>
        </div>
        <div class="t-row">
            <span>Bayar</span>
            <span>{{ number_format($sale->paid, 0, ',', '.') }}</span>
        </div>
        <div class="t-row">
            <span>Kembalian</span>
            <span>{{ number_format($sale->change, 0, ',', '.') }}</span>
        </div>

        <div class="t-total">TOTAL: Rp {{ number_format($sale->total, 0, ',', '.') }}</div>

        <hr class="t-hr">

        <div class="t-footer">TERIMA KASIH</div>
        <div class="t-note">Barang yang sudah dibeli tidak dapat dikembalikan</div>
    </div>

    <div class="print-actions">
        <button class="btn btn-primary" onclick="window.print()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
            Cetak Struk
        </button>
        <a href="/dashboard" class="btn btn-secondary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Kembali
        </a>
    </div>
</div>

<script>
window.onload = function() { window.print(); }
</script>
</body>
</html>
