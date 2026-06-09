<h2>Detail Transaksi</h2>

<h3>{{ $sale->invoice }}</h3>

<table border="1" cellpadding="8">
    <tr>
        <th>Produk</th>
        <th>Qty</th>
        <th>Harga</th>
        <th>Subtotal</th>
    </tr>

    @foreach($sale->items as $item)
    <tr>
        <td>{{ $item->product->name }}</td>
        <td>{{ $item->qty }}</td>
        <td>{{ $item->price }}</td>
        <td>{{ $item->subtotal }}</td>
    </tr>
    @endforeach
</table>

<h3>Total: {{ $sale->total }}</h3>