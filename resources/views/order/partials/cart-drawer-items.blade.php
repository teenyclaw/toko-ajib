@if(empty($cart))
  <div class="cart-drawer-empty">
    <p>Keranjang masih kosong.</p>
    <p class="cart-drawer-empty-sub">Tambah produk dari katalog.</p>
  </div>
@else
  <ul class="cart-drawer-list">
    @foreach($cart as $id => $item)
      @php $unit = $item['unit'] ?? 'pcs'; @endphp
      <li class="cart-drawer-line" data-line-key="{{ $id }}">
        <div class="cart-drawer-line-main">
          <div class="cart-drawer-line-info">
            <span class="cart-drawer-line-name">{{ $item['name'] }}</span>
          </div>
          <span class="cart-drawer-line-qty">x{{ $item['qty'] }}</span>
        </div>
        <div class="cart-drawer-line-edit">
          <select class="cart-unit-select" data-line-key="{{ $id }}" aria-label="Satuan">
            @foreach(\App\Support\OrderUnits::all() as $u)
              <option value="{{ $u }}" @selected($unit === $u)>{{ \App\Support\OrderUnits::label($u) }}</option>
            @endforeach
          </select>
          <input type="text" class="cart-note-input" data-line-key="{{ $id }}" value="{{ $item['note'] ?? '' }}" placeholder="Catatan item" maxlength="500" aria-label="Catatan item">
        </div>
        <div class="cart-drawer-line-actions">
          <button type="button" class="cart-qty-btn" data-action="minus" data-line-key="{{ $id }}" aria-label="Kurangi">−</button>
          <span class="cart-qty-num">{{ $item['qty'] }}</span>
          <button type="button" class="cart-qty-btn" data-action="plus" data-line-key="{{ $id }}" data-max="{{ $item['stock'] ?? 9999 }}" aria-label="Tambah">+</button>
          <button type="button" class="cart-remove-btn" data-line-key="{{ $id }}" aria-label="Hapus">×</button>
        </div>
      </li>
    @endforeach
  </ul>
@endif
