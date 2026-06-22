@extends('order.layout')

@section('title', 'Katalog')

@section('cartDrawer')
@include('order.partials.cart-drawer', ['cart' => $cart])
@endsection

@push('styles')
<style>
.search-box{position:relative;margin:16px 0}
.search-box input{
  width:100%;padding:11px 14px 11px 40px;border-radius:var(--rs);
  background:var(--bg3);border:1px solid var(--bd2);color:var(--tx);font-size:14px;
}
.search-box input:focus{outline:none;border-color:var(--go)}
.search-icon{
  position:absolute;left:14px;top:50%;transform:translateY(-50%);
  width:16px;height:16px;color:var(--tx3);pointer-events:none;
}
.search-meta{font-size:12px;color:var(--tx3);margin:-8px 0 12px;min-height:18px}
.product-card[hidden]{display:none!important}
.search-empty{display:none;text-align:center;padding:32px 16px;color:var(--tx2)}
.search-empty.show{display:block}
</style>
@endpush

@section('content')
<h1 class="page-title">Pesan Produk</h1>
<p class="page-sub">Pilih produk yang ingin dipesan. Harga akan dikonfirmasi saat pesanan diproses.</p>

<div class="search-box">
  <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
    <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
  </svg>
  <input type="search" id="product-search" placeholder="Cari produk..." autocomplete="off" value="{{ $search ?? '' }}">
</div>
<div class="search-meta" id="search-meta"></div>

@if($products->isEmpty())
  <div class="empty">
    <p>Belum ada produk tersedia untuk pemesanan online.</p>
  </div>
@else
  <div class="search-empty" id="search-empty">
    <p>Produk tidak ditemukan.</p>
  </div>
  <div class="product-list" id="product-list">
    @foreach($products as $product)
      @php
        $stock = (int) $product->stock;
        $stockClass = $stock <= 0 ? 'stock-out' : ($stock <= 5 ? 'stock-low' : 'stock-ok');
        $stockLabel = $stock <= 0 ? 'Habis' : ('Stok: ' . $stock);
      @endphp
      <div class="product-card" data-name="{{ mb_strtolower($product->name) }}">
        <div class="product-info">
          <div class="product-name">{{ $product->name }}</div>
          <div class="product-meta">
            @if($product->category)
              {{ $product->category->name }} ·
            @endif
            <span class="{{ $stockClass }}">{{ $stockLabel }}</span>
          </div>
          @if($stock > 0)
            <form method="POST" action="{{ route('order.cart.add') }}" class="qty-row add-to-cart-form">
              @csrf
              <input type="hidden" name="product_id" value="{{ $product->id }}">
              <div class="product-add-fields">
                <div class="qty-row">
                  <input type="number" name="qty" value="1" min="1" max="{{ $stock }}" aria-label="Jumlah">
                  <select name="unit" aria-label="Satuan">
                    @foreach(\App\Support\OrderUnits::all() as $unit)
                      <option value="{{ $unit }}">{{ \App\Support\OrderUnits::label($unit) }}</option>
                    @endforeach
                  </select>
                  <button type="submit" class="btn btn-primary btn-sm">+ Keranjang</button>
                </div>
                <input type="text" name="note" class="note-input" placeholder="Catatan item (opsional)" maxlength="500" aria-label="Catatan item">
              </div>
            </form>
          @endif
        </div>
      </div>
    @endforeach
  </div>
@endif
@endsection

@push('scripts')
<script>
(function () {
  const input = document.getElementById('product-search');
  const meta  = document.getElementById('search-meta');
  const empty = document.getElementById('search-empty');
  const cards = document.querySelectorAll('.product-card');

  if (!input || !cards.length) return;

  function filterProducts() {
    const q = input.value.trim().toLowerCase();
    let visible = 0;

    cards.forEach(function (card) {
      const name = card.dataset.name || '';
      const match = q === '' || name.includes(q);
      card.hidden = !match;
      if (match) visible++;
    });

    if (empty) empty.classList.toggle('show', q !== '' && visible === 0);
    if (meta) meta.textContent = q === '' ? '' : visible + ' produk ditemukan';
  }

  input.addEventListener('input', filterProducts);
  input.addEventListener('search', filterProducts);
  filterProducts();
})();
</script>
@endpush
