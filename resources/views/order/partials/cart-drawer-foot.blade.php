@if(!empty($cart))
  <div class="cart-drawer-summary">
    <span>Total item</span>
    <strong>{{ collect($cart)->sum('qty') }} item</strong>
  </div>
  <a href="{{ route('order.checkout') }}" class="btn btn-primary">Lanjut Checkout</a>
@endif
