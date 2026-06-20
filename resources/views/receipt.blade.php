<style>
body {
    font-family: monospace;
    width: 300px;
    margin: auto;
}
table {
    font-size: 12px;
}
@media print {
    button, a {
        display: none;
    }
}
</style>

<h2>STRUK PEMBELIAN</h2>

<p>Pelanggan: {{ $sale->customer->name ?? 'Umum' }}</p>

<hr>

<table width="100%">
    <tr>
        <th align="left">Produk</th>
        <th>Qty</th>
        <th align="right">Total</th>
    </tr>

    {{-- Ganti @foreach($cart as $item) dengan: --}}
@foreach($sale->items as $item)
<tr>
    <td>{{ $item->name ?? $item->product?->name ?? '-' }}</td>
    <td align="center">{{ $item->qty }}</td>
    <td align="right">
        {{ number_format($item->price * $item->qty, 0, ',', '.') }}
    </td>
</tr>
@endforeach
</table>

<hr>

<h3>Total: Rp {{ number_format($total,0,',','.') }}</h3>
<p>Bayar: Rp {{ number_format($sale->paid,0,',','.') }}</p>
<p>Kembalian: Rp {{ number_format($sale->change,0,',','.') }}</p>

<br>

<button onclick="window.print()">🖨️ Print</button>
<a href="/products">Kembali</a>

<script>
window.onload = function() {
    window.print();
}
</script>