@php
    $active     = $active ?? '';
    $isAdmin    = auth()->user()->role === 'admin';
    $sidebarId  = $sidebarId ?? null;
    $useNavText = $useNavText ?? false;
    $roleLabel  = $isAdmin ? 'Admin' : 'Kasir';

    $link = function (string $key, string $href, string $label, string $icon, bool $adminOnly = false) use ($active, $useNavText) {
        if ($adminOnly && auth()->user()->role !== 'admin') {
            return '';
        }
        $on = $active === $key ? ' on' : '';
        $text = $useNavText ? '<span class="nav-txt">' . e($label) . '</span>' : e($label);
        return <<<HTML
<a href="{$href}" class="nav-a{$on}" title="{$label}">
  {$icon}
  {$text}
</a>
HTML;
    };

    $iconGrid = '<svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="2" width="9" height="9" rx="2"/><rect x="13" y="2" width="9" height="9" rx="2"/><rect x="2" y="13" width="9" height="9" rx="2"/><rect x="13" y="13" width="9" height="9" rx="2"/></svg>';
    $iconOrder = '<svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>';
    $iconSettings = '<svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="3"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>';
    $iconProduct = '<svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/></svg>';
    $iconTx = '<svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 12h6M9 16h4"/></svg>';
    $iconCustomer = '<svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="8" cy="7" r="4"/><path d="M2 21v-2a4 4 0 014-4h4a4 4 0 014 4v2"/><path d="M19 8v6M22 11h-6"/></svg>';
    $iconNonMember = '<svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/><line x1="18" y1="8" x2="23" y2="13"/><line x1="23" y1="8" x2="18" y2="13"/></svg>';
    $iconImport = '<svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg>';
    $iconUsers = '<svg class="ni" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>';
@endphp

<aside class="sb"@if($sidebarId) id="{{ $sidebarId }}"@endif>
<div class="sb-logo">
  <div class="logo">
    <div class="logo-ico"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M3 3h7v7H3V3zm0 11h7v7H3v-7zm11-11h7v7h-7V3zm4 11h-1v3h-3v1h3v3h1v-3h3v-1h-3v-3z"/></svg></div>
    @if($useNavText)
    <div class="logo-txt"><div class="logo-name">TOKO AJIB</div><div class="logo-tag">Point of Sale</div></div>
    @else
    <div><div class="logo-name">TOKO AJIB</div><div class="logo-tag">Point of Sale</div></div>
    @endif
  </div>
</div>
<nav class="nav">
  <div class="nav-sec">Utama</div>
  {!! $link('dashboard', '/dashboard', 'Kasir', $iconGrid) !!}
  {!! $link('online-orders', '/online-orders', 'Pesanan Online', $iconOrder) !!}
  @if($isAdmin)
  {!! $link('settings-order', '/settings/order', 'Pengaturan Order', $iconSettings, true) !!}
  {!! $link('products', '/products', 'Produk', $iconProduct, true) !!}
  {!! $link('transactions', '/transactions', 'Transaksi', $iconTx, true) !!}
  {!! $link('customers', '/customers', 'Pelanggan', $iconCustomer, true) !!}
  {!! $link('nonmember', '/nonmember', 'Harga Non-Member', $iconNonMember, true) !!}
  <div class="nav-sec">Sistem</div>
  {!! $link('settings-users', '/settings/users', 'Pengguna', $iconUsers, true) !!}
  {!! $link('import', '/import', 'Import CSV', $iconImport, true) !!}
  @endif
</nav>
<div class="sb-foot">
  <div class="u-row">
    <div class="uav">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</div>
    <div class="u-meta @if($useNavText) u-info @endif">
      <div class="u-nm">{{ auth()->user()->name ?? 'User' }}</div>
      <div class="u-rl">{{ $roleLabel }}</div>
    </div>
    <form method="POST" action="{{ route('logout') }}" class="u-out">
      @csrf
      <button type="submit" class="btn-logout" title="Keluar">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
          <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/>
          <polyline points="16 17 21 12 16 7"/>
          <line x1="21" y1="12" x2="9" y2="12"/>
        </svg>
        @if($useNavText)<span class="btn-logout-txt">Keluar</span>@endif
      </button>
    </form>
  </div>
</div>
</aside>

@once
<style>
.sb-foot .u-row{align-items:center}
.sb-foot .u-meta{flex:1;min-width:0}
.sb-foot .u-nm{overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.sb-foot .u-out{margin:0;padding:0;flex-shrink:0}
.sb-foot .btn-logout{display:inline-flex;align-items:center;justify-content:center;gap:5px;padding:6px;border-radius:var(--rs,8px);border:1px solid var(--bd2,rgba(255,255,255,.1));background:transparent;color:var(--tx3,#4e4c49);cursor:pointer;font-family:inherit;font-size:11px;font-weight:500;transition:color .14s,border-color .14s,background .14s}
.sb-foot .btn-logout:hover{color:var(--rd,#f87171);border-color:rgba(248,113,113,.25);background:var(--rdd,rgba(248,113,113,.12))}
.sb-foot .btn-logout svg{width:14px;height:14px;flex-shrink:0}
.sb-foot .btn-logout-txt{line-height:1}
</style>
@endonce
