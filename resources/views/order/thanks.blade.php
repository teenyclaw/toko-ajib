@extends('order.layout')

@section('title', 'Pesanan Diterima')

@section('content')
<div class="thanks-box">
  <div class="thanks-icon">✓</div>
  <h1 class="page-title">Pesanan Diterima</h1>
  <p class="page-sub">Terima kasih! Pesanan Anda sedang menunggu konfirmasi dari {{ $storeName ?? 'toko' }}.</p>
  <div class="order-no">{{ $order->order_number }}</div>
</div>

<div class="summary">
  <div class="summary-row" style="margin-bottom:8px">
    <span>Nama</span>
    <strong>{{ $order->customer_name }}</strong>
  </div>
  <div class="summary-row" style="margin-bottom:8px">
    <span>Telepon</span>
    <strong>{{ $order->customer_phone }}</strong>
  </div>
  @if($order->customer_address)
    <div class="summary-row" style="margin-bottom:8px">
      <span>Alamat</span>
      <strong style="max-width:60%;text-align:right">{{ $order->customer_address }}</strong>
    </div>
  @endif
</div>

<div class="item-list">
  <div class="sec-label" style="font-size:10px;color:var(--tx3);letter-spacing:.8px;text-transform:uppercase;margin-bottom:8px">Detail Pesanan</div>
  @foreach($order->items as $item)
    <div class="item-row">
      <span>
        {{ $item->product_name }}
        @if($item->note)
          <span class="item-note">({{ $item->note }})</span>
        @endif
      </span>
      <span>{{ $item->qty }} {{ \App\Support\OrderUnits::label($item->unit) }}</span>
    </div>
  @endforeach
</div>

@if($storeWhatsAppUrl ?? null)
  <a href="{{ $storeWhatsAppUrl }}" target="_blank" class="btn btn-primary" style="background:#25D366;margin-bottom:10px">
    Kirim Pesanan ke WhatsApp Toko
  </a>
  <p style="font-size:12px;color:var(--tx2);text-align:center;margin-bottom:12px">Tekan tombol di atas agar toko segera menerima detail pesanan Anda.</p>
@else
  <p style="font-size:12px;color:var(--tx2);text-align:center;margin-bottom:12px">Simpan nomor pesanan <strong>{{ $order->order_number }}</strong> — toko akan menghubungi Anda.</p>
@endif

<button type="button" class="btn btn-ghost" onclick="copyOrderNumber()" style="margin-bottom:10px">Salin Nomor Pesanan</button>

<a href="{{ route('order.catalog') }}" class="btn btn-primary">Pesan Lagi</a>
@endsection

@push('scripts')
<script>
function copyOrderNumber() {
  const text = @json($order->order_number);
  navigator.clipboard.writeText(text).then(() => alert('Nomor pesanan disalin: ' + text)).catch(() => {
    prompt('Salin nomor pesanan:', text);
  });
}
</script>
@endpush
