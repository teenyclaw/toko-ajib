@if(empty($cart))
  <div class="cart-drawer-empty">
    <p>Keranjang masih kosong.</p>
    <p class="cart-drawer-empty-sub">Tambah produk dari katalog.</p>
  </div>
@else
  <ul class="cart-drawer-list">
    @foreach($cart as $id => $item)
      <li class="cart-drawer-line" data-id="{{ $id }}">
        <div class="cart-drawer-line-main">
          <div class="cart-drawer-line-info">
            <span class="cart-drawer-line-name">{{ $item['name'] }}</span>
            @php $unit = $item['unit'] ?? 'pcs'; @endphp
            <span class="cart-drawer-line-meta">{{ \App\Support\OrderUnits::label($unit) }}@if(!empty($item['note'])) — {{ $item['note'] }}@endif</span>
          </div>
          <span class="cart-drawer-line-qty">x{{ $item['qty'] }}</span>
        </div>
        <div class="cart-drawer-line-actions">
          <button type="button" class="cart-qty-btn" data-action="minus" data-id="{{ $id }}" aria-label="Kurangi">−</button>
          <span class="cart-qty-num">{{ $item['qty'] }}</span>
          <button type="button" class="cart-qty-btn" data-action="plus" data-id="{{ $id }}" data-max="{{ $item['stock'] ?? 9999 }}" aria-label="Tambah">+</button>
          <button type="button" class="cart-remove-btn" data-id="{{ $id }}" aria-label="Hapus">×</button>
        </div>
      </li>
    @endforeach
  </ul>
@endif
