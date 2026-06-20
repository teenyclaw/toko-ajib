<aside class="cart-drawer" id="cart-drawer" aria-label="Keranjang pesanan">
  <div class="cart-drawer-head">
    <div class="cart-drawer-title">Keranjang</div>
    <button type="button" class="cart-drawer-close" id="cart-drawer-close" aria-label="Tutup keranjang">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
    </button>
  </div>
  <div class="cart-drawer-body" id="cart-drawer-body">
    @include('order.partials.cart-drawer-items', ['cart' => $cart ?? []])
  </div>
  <div class="cart-drawer-foot" id="cart-drawer-foot">
    @include('order.partials.cart-drawer-foot', ['cart' => $cart ?? []])
  </div>
</aside>
