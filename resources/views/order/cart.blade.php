@extends('order.layout')

@section('title', 'Keranjang')

@section('content')
<h1 class="page-title">Keranjang Pesanan</h1>
<p class="page-sub">Periksa item sebelum checkout.</p>

@if(empty($cart))
  <div class="empty">
    <p>Keranjang masih kosong.</p>
    <a href="{{ route('order.catalog') }}" class="btn btn-primary">Lihat Katalog</a>
  </div>
@else
  @foreach($cart as $id => $item)
    @php $unit = $item['unit'] ?? 'pcs'; @endphp
    <div class="cart-item">
      <div class="cart-item-name">{{ $item['name'] }}</div>
      <form method="POST" action="{{ route('order.cart.update', $id) }}" class="cart-item-form">
        @csrf
        @method('PATCH')
        <div class="cart-item-fields">
          <label class="cart-field">
            <span>Qty</span>
            <input type="number" name="qty" value="{{ $item['qty'] }}" min="1" max="{{ $item['stock'] ?? 9999 }}">
          </label>
          <label class="cart-field">
            <span>Satuan</span>
            <select name="unit">
              @foreach(\App\Support\OrderUnits::all() as $u)
                <option value="{{ $u }}" @selected($unit === $u)>{{ \App\Support\OrderUnits::label($u) }}</option>
              @endforeach
            </select>
          </label>
        </div>
        <label class="cart-field cart-field-full">
          <span>Catatan item</span>
          <input type="text" name="note" value="{{ $item['note'] ?? '' }}" placeholder="Opsional" maxlength="500">
        </label>
        <div class="cart-actions">
          <button type="submit" class="btn btn-ghost btn-sm">Simpan</button>
        </div>
      </form>
      <form method="POST" action="{{ route('order.cart.remove', $id) }}" onsubmit="return confirm('Hapus item ini?')" class="cart-remove-form">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-ghost btn-sm" style="color:var(--rd)">Hapus</button>
      </form>
    </div>
  @endforeach

  <div class="summary">
    <div class="summary-row">
      <span>Total item</span>
      <strong>{{ collect($cart)->sum('qty') }} item</strong>
    </div>
  </div>

  <a href="{{ route('order.checkout') }}" class="btn btn-primary">Lanjut Checkout</a>
  <div style="margin-top:10px">
    <a href="{{ route('order.catalog') }}" class="btn btn-ghost">+ Tambah Produk</a>
  </div>
@endif
@endsection

@push('styles')
<style>
.cart-item-form{margin-bottom:8px}
.cart-item-fields{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:8px}
.cart-field{display:flex;flex-direction:column;gap:4px;flex:1;min-width:120px}
.cart-field span{font-size:11px;color:var(--tx2)}
.cart-field input,.cart-field select{
  padding:8px 10px;background:var(--bg3);border:1px solid var(--bd2);border-radius:var(--rs);color:var(--tx);font-size:13px;
}
.cart-field-full{width:100%;margin-bottom:8px}
.cart-remove-form{margin-top:-4px}
</style>
@endpush
