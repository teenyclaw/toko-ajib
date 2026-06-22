@extends('order.layout')

@section('title', 'Checkout')

@section('content')
<h1 class="page-title">Data Pemesan</h1>
<p class="page-sub">Isi kontak agar kami bisa menghubungi Anda.</p>

<div class="summary" style="margin-top:0">
  @foreach($cart as $item)
    @php $unit = $item['unit'] ?? 'pcs'; @endphp
    <div class="item-row">
      <span>
        {{ $item['name'] }}
        @if(!empty($item['note']))
          <span class="item-note">({{ $item['note'] }})</span>
        @endif
      </span>
      <span>{{ $item['qty'] }} {{ \App\Support\OrderUnits::label($unit) }}</span>
    </div>
  @endforeach
</div>

<form method="POST" action="{{ route('order.checkout.store') }}">
  @csrf
  <div class="field">
    <label for="name">Nama *</label>
    <input type="text" id="name" name="name" value="{{ old('name') }}" required maxlength="255">
    @error('name')<div style="color:var(--rd);font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
  </div>
  <div class="field">
    <label for="phone">No. WhatsApp / Telepon *</label>
    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required maxlength="30" placeholder="08xxxxxxxxxx">
    @error('phone')<div style="color:var(--rd);font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
  </div>
  <div class="field">
    <label for="address">Alamat pengiriman</label>
    <textarea id="address" name="address" placeholder="Opsional">{{ old('address') }}</textarea>
    @error('address')<div style="color:var(--rd);font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
  </div>
  <div class="field">
    <label for="notes">Catatan pesanan</label>
    <textarea id="notes" name="notes" placeholder="Opsional">{{ old('notes') }}</textarea>
    @error('notes')<div style="color:var(--rd);font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
  </div>
  <button type="submit" class="btn btn-primary">Kirim Pesanan</button>
  <div style="margin-top:10px">
    <a href="{{ route('order.catalog', ['cart' => 'open']) }}" class="btn btn-ghost">Kembali ke Keranjang</a>
  </div>
</form>
@endsection
