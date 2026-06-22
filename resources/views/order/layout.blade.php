<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Pesan Online') — Toko Ajib</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --bg:#09090b;--bg2:#111114;--bg3:#18181c;--bg4:#202025;
  --bd:rgba(255,255,255,.06);--bd2:rgba(255,255,255,.1);
  --tx:#ede9e2;--tx2:#938f88;--tx3:#4e4c49;
  --go:#c9a44e;--go2:#e4bf6a;--gd:rgba(201,164,78,.12);
  --gn:#3ecf8e;--gnd:rgba(62,207,142,.12);
  --rd:#f87171;--rdd:rgba(248,113,113,.12);
  --rr:12px;--rs:8px;
  --fn:'DM Sans',sans-serif;--mo:'DM Mono',monospace;
  --cart-w:300px;
}
body{font-family:var(--fn);background:var(--bg);color:var(--tx);font-size:14px;line-height:1.5;min-height:100vh}
a{color:inherit;text-decoration:none}
.top{
  position:sticky;top:0;z-index:60;
  background:rgba(9,9,11,.92);backdrop-filter:blur(8px);
  border-bottom:1px solid var(--bd);
  padding:14px 16px;display:flex;align-items:center;gap:12px;
}
.top-brand{font-size:15px;font-weight:600;flex:1}
.top-brand span{color:var(--go)}
.cart-link{
  display:flex;align-items:center;gap:6px;
  padding:7px 12px;border-radius:var(--rs);
  background:var(--bg3);border:1px solid var(--bd2);font-size:13px;
  cursor:pointer;font-family:var(--fn);color:inherit;
}
.cart-link:hover{border-color:var(--go);color:var(--go)}
.badge{
  min-width:20px;height:20px;padding:0 6px;border-radius:10px;
  background:var(--go);color:#09090b;font-size:11px;font-weight:600;
  display:inline-flex;align-items:center;justify-content:center;
}
.badge[hidden]{display:none!important}
.wrap{max-width:640px;margin:0 auto;padding:0 16px 32px}
.order-shell{max-width:980px;margin:0 auto;display:grid;grid-template-columns:minmax(0,1fr) var(--cart-w);min-height:calc(100vh - 53px)}
.order-main{padding:0 16px 32px;min-width:0}
.alert{padding:12px 14px;border-radius:var(--rs);margin:16px 0;font-size:13px}
.alert-success{background:var(--gnd);color:var(--gn);border:1px solid rgba(62,207,142,.25)}
.alert-error{background:var(--rdd);color:var(--rd);border:1px solid rgba(248,113,113,.25)}
.page-title{font-size:18px;font-weight:600;margin:20px 0 6px}
.page-sub{color:var(--tx2);font-size:13px;margin-bottom:16px}
.btn{
  display:inline-flex;align-items:center;justify-content:center;gap:6px;
  padding:11px 16px;border-radius:var(--rs);border:none;cursor:pointer;
  font-family:var(--fn);font-size:14px;font-weight:600;transition:all .14s;
}
.btn-primary{background:var(--go);color:#09090b;width:100%}
.btn-primary:hover{background:var(--go2)}
.btn-ghost{background:var(--bg3);color:var(--tx);border:1px solid var(--bd2);width:100%}
.btn-ghost:hover{border-color:var(--go);color:var(--go)}
.btn-sm{padding:8px 12px;font-size:13px;width:auto}
.field{margin-bottom:14px}
.field label{display:block;font-size:12px;color:var(--tx2);margin-bottom:6px}
.field input,.field textarea{
  width:100%;padding:11px 12px;border-radius:var(--rs);
  background:var(--bg3);border:1px solid var(--bd2);color:var(--tx);
  font-family:var(--fn);font-size:14px;
}
.field input:focus,.field textarea:focus{outline:none;border-color:var(--go)}
.field textarea{min-height:80px;resize:vertical}
.search-box{margin:16px 0}
.search-box input{
  width:100%;padding:11px 14px;border-radius:var(--rs);
  background:var(--bg3);border:1px solid var(--bd2);color:var(--tx);font-size:14px;
}
.search-box input:focus{outline:none;border-color:var(--go)}
.product-list{display:flex;flex-direction:column;gap:10px}
.product-card{
  background:var(--bg2);border:1px solid var(--bd);border-radius:var(--rr);
  padding:14px;display:flex;gap:12px;align-items:flex-start;
}
.product-info{flex:1;min-width:0}
.product-name{font-weight:500;margin-bottom:4px}
.product-meta{font-size:12px;color:var(--tx2)}
.stock-ok{color:var(--gn)}.stock-low{color:var(--go)}.stock-out{color:var(--rd)}
.qty-row{display:flex;align-items:center;gap:8px;margin-top:10px;flex-wrap:wrap}
.qty-row input{
  width:64px;padding:8px;text-align:center;
  background:var(--bg3);border:1px solid var(--bd2);border-radius:var(--rs);color:var(--tx);
}
.qty-row select{
  padding:8px 10px;background:var(--bg3);border:1px solid var(--bd2);border-radius:var(--rs);color:var(--tx);font-size:13px;
}
.product-add-fields{display:flex;flex-direction:column;gap:8px;margin-top:10px}
.note-input{
  width:100%;padding:8px 10px;background:var(--bg3);border:1px solid var(--bd2);border-radius:var(--rs);color:var(--tx);font-size:13px;
}
.note-input:focus{outline:none;border-color:var(--go)}
.cart-drawer-line-info{flex:1;min-width:0}
.cart-drawer-line-meta{display:block;font-size:11px;color:var(--tx2);margin-top:3px;line-height:1.35}
.item-note{display:block;font-size:11px;color:var(--tx2);margin-top:2px}
.cart-item{margin-bottom:12px;padding:14px;background:var(--bg2);border:1px solid var(--bd);border-radius:var(--rr)}
.cart-item-name{font-weight:500;margin-bottom:4px}
.cart-item-meta{font-size:12px;color:var(--tx2);margin-bottom:10px}
.cart-actions{display:flex;gap:8px;flex-wrap:wrap}
.summary{background:var(--bg2);border:1px solid var(--bd);border-radius:var(--rr);padding:16px;margin:16px 0}
.summary-row{display:flex;justify-content:space-between;font-size:13px;color:var(--tx2)}
.summary-row strong{color:var(--tx)}
.thanks-box{text-align:center;padding:32px 16px}
.thanks-icon{width:56px;height:56px;border-radius:50%;background:var(--gd);color:var(--go);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:24px}
.order-no{font-family:var(--mo);color:var(--go);font-size:15px;margin:8px 0 16px}
.item-list{text-align:left;margin:20px 0}
.item-row{display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid var(--bd);font-size:13px}
.empty{text-align:center;padding:48px 16px;color:var(--tx2)}
.empty p{margin-bottom:16px}
.cart-backdrop{display:none;position:fixed;inset:0;background:rgba(0,0,0,.55);z-index:70;backdrop-filter:blur(2px)}
.cart-backdrop.show{display:block}
.cart-drawer{
  background:var(--bg2);border-left:1px solid var(--bd);
  display:flex;flex-direction:column;min-height:calc(100vh - 53px);
  position:sticky;top:53px;align-self:start;max-height:calc(100vh - 53px);
}
.cart-drawer-head{
  padding:16px 16px 12px;border-bottom:1px solid var(--bd);
  display:flex;align-items:center;justify-content:space-between;flex-shrink:0;
}
.cart-drawer-title{font-size:15px;font-weight:600}
.cart-drawer-close{
  display:none;width:32px;height:32px;border-radius:var(--rs);
  background:var(--bg3);border:1px solid var(--bd2);color:var(--tx2);cursor:pointer;
  align-items:center;justify-content:center;padding:0;
}
.cart-drawer-body{flex:1;overflow-y:auto;padding:12px 16px}
.cart-drawer-foot{padding:14px 16px 18px;border-top:1px solid var(--bd);flex-shrink:0}
.cart-drawer-empty{text-align:center;padding:32px 12px;color:var(--tx2);font-size:13px}
.cart-drawer-empty-sub{font-size:12px;color:var(--tx3);margin-top:6px}
.cart-drawer-list{list-style:none;display:flex;flex-direction:column;gap:10px}
.cart-drawer-line{
  background:var(--bg3);border:1px solid var(--bd);border-radius:var(--rs);padding:12px;
}
.cart-drawer-line-main{display:flex;justify-content:space-between;gap:10px;align-items:flex-start;margin-bottom:8px}
.cart-drawer-line-name{font-weight:500;font-size:13px;line-height:1.35;flex:1}
.cart-drawer-line-qty{font-family:var(--mo);font-size:13px;color:var(--go);white-space:nowrap}
.cart-drawer-line-actions{display:flex;align-items:center;gap:6px}
.cart-qty-btn{
  width:28px;height:28px;border-radius:6px;border:1px solid var(--bd2);
  background:var(--bg4);color:var(--tx2);cursor:pointer;font-size:15px;line-height:1;
}
.cart-qty-btn:hover{border-color:var(--go);color:var(--go)}
.cart-qty-num{min-width:24px;text-align:center;font-family:var(--mo);font-size:13px}
.cart-remove-btn{
  margin-left:auto;width:28px;height:28px;border-radius:6px;border:1px solid transparent;
  background:transparent;color:var(--tx3);cursor:pointer;font-size:18px;line-height:1;
}
.cart-remove-btn:hover{color:var(--rd);background:var(--rdd)}
.cart-drawer-summary{display:flex;justify-content:space-between;font-size:13px;color:var(--tx2);margin-bottom:12px}
.cart-drawer-summary strong{color:var(--tx);font-family:var(--mo)}
.toast-order{
  position:fixed;bottom:20px;left:50%;transform:translateX(-50%) translateY(80px);
  background:var(--bg3);border:1px solid var(--bd2);border-radius:var(--rr);
  padding:10px 16px;font-size:13px;opacity:0;transition:all .25s;z-index:100;pointer-events:none;
  box-shadow:0 8px 32px rgba(0,0,0,.5);max-width:90vw;text-align:center;
}
.toast-order.show{opacity:1;transform:translateX(-50%) translateY(0)}
@media(max-width:767px){
  .order-shell{grid-template-columns:1fr;display:block}
  .cart-drawer{
    position:fixed;top:0;right:0;bottom:0;width:min(var(--cart-w),92vw);
    z-index:80;transform:translateX(100%);transition:transform .25s ease;
    max-height:none;min-height:0;border-left:1px solid var(--bd2);
    box-shadow:-8px 0 40px rgba(0,0,0,.55);
  }
  .cart-drawer.open{transform:translateX(0)}
  .cart-drawer-close{display:inline-flex}
  .cart-drawer-head{padding-top:18px}
}
</style>
@stack('styles')
</head>
<body>
<header class="top">
  <a href="{{ route('order.catalog') }}" class="top-brand"><span>{{ $storeBrandName ?? 'Toko Ajib' }}</span></a>
  @hasSection('cartDrawer')
    <button type="button" class="cart-link" id="cart-toggle-btn" aria-expanded="false">
      Keranjang
      <span class="badge" id="cart-badge" @if(($cartCount ?? 0) <= 0) hidden @endif>{{ $cartCount ?? 0 }}</span>
    </button>
  @else
    <a href="{{ route('order.catalog') }}" class="cart-link">
      Keranjang
      @if(($cartCount ?? 0) > 0)
        <span class="badge">{{ $cartCount }}</span>
      @endif
    </a>
  @endif
</header>

@hasSection('cartDrawer')
<div class="cart-backdrop" id="cart-backdrop"></div>
<div class="order-shell">
  <div class="order-main">
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert alert-error">{{ session('error') }}</div>
    @endif
    @yield('content')
  </div>
  @yield('cartDrawer')
</div>
<div class="toast-order" id="order-toast"></div>
@else
<div class="wrap">
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="alert alert-error">{{ session('error') }}</div>
  @endif
  @yield('content')
</div>
@endif

@stack('scripts')
@hasSection('cartDrawer')
@include('order.partials.order-cart-js')
@endif
</body>
</html>
