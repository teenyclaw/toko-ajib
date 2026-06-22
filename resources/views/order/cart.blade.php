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
      <div class="cart-item-meta">
        Qty: {{ $item['qty'] }} {{ \App\Support\OrderUnits::label($unit) }}
        @if(!empty($item['note']))
          · {{ $item['note'] }}
        @endif
      </div>
      <div class="cart-actions">
        <form method="POST" action="{{ route('order.cart.update', $id) }}" style="display:flex;gap:8px;align-items:center">
          @csrf
          @method('PATCH')
          <input type="number" name="qty" value="{{ $item['qty'] }}" min="1" max="{{ $item['stock'] ?? 9999 }}" style="width:64px;padding:8px;text-align:center;background:var(--bg3);border:1px solid var(--bd2);border-radius:var(--rs);color:var(--tx)">
          <button type="submit" class="btn btn-ghost btn-sm">Update</button>
        </form>
        <form method="POST" action="{{ route('order.cart.remove', $id) }}" onsubmit="return confirm('Hapus item ini?')">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-ghost btn-sm" style="color:var(--rd)">Hapus</button>
        </form>
      </div>
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
