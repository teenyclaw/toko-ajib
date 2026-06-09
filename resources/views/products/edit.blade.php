<!DOCTYPE html>
<h2>Edit Produk</h2>

<form method="POST" action="/products/{{ $product->id }}">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ $product->name }}"><br>

    <select name="category_id">
        @foreach($categories as $c)
            <option value="{{ $c->id }}"
                {{ $product->category_id == $c->id ? 'selected' : '' }}>
                {{ $c->name }}
            </option>
        @endforeach
    </select><br>

    <input type="number" name="stock" value="{{ $product->stock }}"><br>

    <input type="number" name="harga_beli_dus" value="{{ $product->harga_beli_dus }}"><br>

    <input type="number" name="harga_jual_dus" value="{{ $product->harga_jual_dus }}"><br>

    <input type="number" name="harga_jual_pcs" value="{{ $product->harga_jual_pcs }}"><br>

    <button>Update</button>
</form>

</html>