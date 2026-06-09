<body>
    <h2>Keranjang</h2>

@if(session('error'))
    <div style="background:red; color:white; padding:10px; margin-bottom:10px;">
        {{ session('error') }}
    </div>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>Nama</th>
        <th>Harga</th>
        <th>Qty</th>
        <th>Total</th>
        <th>Aksi</th>
    </tr>

    @php $grandTotal = 0; @endphp

    @foreach($cart as $id => $item)
    @php 
        $total = $item['price'] * $item['qty'];
        $grandTotal += $total;
    @endphp

    <tr>
        <td>{{ $item['name'] }}</td>
        <td>{{ number_format($item['price'],0,',','.') }}</td>
        <td>
    <button onclick="updateCart({{ $id }}, 'minus')">➖</button>
    <span id="qty-{{ $id }}">{{ $item['qty'] }}</span>
    <button onclick="updateCart({{ $id }}, 'plus')">➕</button>
    </td>
        <td id="total-{{ $id }}">
    {{ number_format($item['price'] * $item['qty'],0,',','.') }}
    </td>
        <td>
    <a href="/cart/delete/{{ $id }}">❌ Hapus</a>
        </td>
    </tr>
    @endforeach
</table>

<h3>Total: <span id="grand-total">
    {{ number_format($grandTotal,0,',','.') }}
</span></h3>
<form method="POST" action="/checkout">
    @csrf

    <input type="number" name="paid" placeholder="Uang bayar" required>

    <button type="submit">Bayar</button>
</form>
@if(session('success'))
    <div style="color: green;">
        {{ session('success') }}
    </div>
@endif

<script>
function updateCart(id, action) {
    fetch(`/cart/${action}/${id}`)
    .then(res => res.json())
    .then(data => {

        // update qty
        if(data[id]) {
            document.getElementById('qty-' + id).innerText = data[id].qty;
        } else {
            location.reload(); // kalau item kehapus
        }

        // reload total (simple dulu)
        location.reload();
    });
}
</script>
<script>
function formatRupiah(angka) {
    return new Intl.NumberFormat('id-ID').format(angka);
}

function updateCart(id, action) {
    fetch(`/cart/${action}/${id}`)
    .then(res => res.json())
    .then(data => {

        let cart = data.cart;

        if(cart[id]) {
            // update qty
            document.getElementById('qty-' + id).innerText = cart[id].qty;

            // update total per item
            document.getElementById('total-' + id).innerText =
                formatRupiah(cart[id].total);
        } else {
            location.reload(); // kalau item habis
        }

        // update grand total
        document.getElementById('grand-total').innerText =
            formatRupiah(data.grandTotal);
    });
}
</script>
</body>