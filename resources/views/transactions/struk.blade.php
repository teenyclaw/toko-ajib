<style>
@media print {
    button {
        display: none;
    }
}
</style>
<h2 style="text-align:center;">TOKO SAYA</h2>
<p style="text-align:center;">Jl. Contoh No.1</p>

<hr>

<p>Invoice: {{ $sale->invoice }}</p>
<p>Tanggal: {{ $sale->created_at }}</p>

<hr>

<table width="100%">
    @foreach($sale->items as $item)
    <tr>
        <td>{{ $item->product->name }}</td>
    </tr>
    <tr>
        <td>
            {{ $item->qty }} x {{ number_format($item->price) }}
            = {{ number_format($item->subtotal) }}
        </td>
    </tr>
    @endforeach
</table>

<hr>
<hr>

<p>Total: Rp {{ number_format($sale->total) }}</p>
<p>Bayar: Rp {{ number_format($sale->paid) }}</p>
<p>Kembalian: Rp {{ number_format($sale->change) }}</p>

<h3>Total: Rp {{ number_format($sale->total) }}</h3>

<p style="text-align:center;">Terima Kasih 🙏</p>

<button onclick="window.print()">Print</button>