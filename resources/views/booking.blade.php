@extends('components.app')
@section('title', 'Booking - Car Wash')

@section('content')
<div class="container py-5">

    <h2 class="mb-4 fw-bold">Form Booking</h2>

    <form id="bookingForm">
        @csrf

        @guest
        <div class="mb-3">
            <label class="form-label">Nama Pemesan</label>
            <input type="text" name="nama_customer" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Merk Mobil</label>
            <input type="text" name="merk_mobil_customer" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Model Mobil</label>
            <input type="text" name="model_mobil_customer" class="form-control" required>
        </div>
        @endguest

        @auth
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <div class="mb-3">
            <label class="form-label">Nama Pemesan</label>
            <input type="text" class="form-control" value="{{ auth()->user()->nama }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Mobil</label>
            <select name="car_id" class="form-select" required>
                @foreach ($cars as $car)
                    <option value="{{ $car->id }}">{{ $car->merk }} - {{ $car->model }} ({{ $car->plat_no }})</option>
                @endforeach
            </select>
        </div>
        @endauth

        <div class="mb-3">
            <label class="form-label">Layanan</label>
            <select name="service_id" class="form-select" required>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}"
                        {{ isset($selectedServiceId) && $selectedServiceId == $service->id ? 'selected' : '' }}>
                        {{ $service->jenis }} - Rp{{ number_format($service->harga, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tanggal_booking" class="form-label">Tanggal Booking</label>
            <input type="date" name="tanggal_booking" id="tanggal_booking" class="form-control" min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Metode Pembayaran</label>
            <select name="metode" id="paymentMethod" class="form-select" required>
                <option value="Tunai">Tunai</option>
                <option value="Transfer">Transfer</option>
                <option value="E-wallet">E-wallet</option>
            </select>
        </div>

        <button type="submit" id="btnPesan" class="btn btn-primary px-4 fw-bold">Pesan</button>
        <a href="/" class="btn btn-secondary px-4 fw-bold">Kembali</a>
    </form>
</div>

<!-- Modal Metode Pembayaran Transfer & E-Wallet -->
<div class="modal fade" id="qrisModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-4 text-center">
      <h4 class="fw-bold">💳 Silakan Scan QRIS</h4>
      <img src="{{ asset('assets/img/qris.png') }}" alt="QRIS" class="img-fluid my-3 text-center" style="max-width:300px;">
      <button type="button" id="btnSimulasiBayar" class="btn btn-success px-4">Simulasi Telah Membayar</button>
    </div>
  </div>
</div>

<!-- Modal Berhasil Melakukan Pemesanan -->
<div class="modal fade" id="successModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-4 text-center">
      <h4 class="fw-bold">✅ Pesanan Berhasil Dibuat</h4>
      <p class="mt-2">Terima kasih telah melakukan booking car wash.</p>
      <button type="button" class="btn btn-success px-4" data-bs-dismiss="modal">OK</button>
    </div>
  </div>
</div>
@endsection
