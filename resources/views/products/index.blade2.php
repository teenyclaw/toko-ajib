<!DOCTYPE html>
<h2>Data Produk</h2>

<form method="GET">
    <input type="text" name="search" placeholder="Cari produk...">
    <button>Cari</button>
</form>

<table border="1" cellpadding="8">
    <tr>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Stok</th>
        <th>Harga Beli Dus</th>
        <th>Harga Jual Dus</th>
        <th>Harga Jual Pcs</th>
        <th>Aksi</th>
    </tr>

    @foreach($products as $p)
    <tr>
        <td>{{ $p->name }}</td>
        <td>{{ $p->category->name ?? '-' }}</td>
        <td>{{ $p->stock }}</td>
        <td>{{ $p->harga_beli_dus }}</td>
        <td>{{ $p->harga_jual_dus }}</td>
        <td>{{ $p->harga_jual_pcs }}</td>
        <td>
            <a href="/products/{{ $p->id }}/edit">Edit</a>
        <form method="POST" action="/cart/add">
    @csrf
    <input type="hidden" name="product_id" value="{{ $p->id }}">
    <button>+ Cart</button>
</form>
</td>
    </tr>
    @endforeach
</table>

{{ $products->links() }}
<form method="POST" action="/checkout">
    @csrf
    <button>Bayar</button>
</form>
</html>
