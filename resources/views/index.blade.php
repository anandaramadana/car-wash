@extends('components.app')
@section('title', 'Home - Car Wash')

@section('content')
<section class="hero-title d-flex justify-content-center align-items-center text-center mb-4 mt-5">
    <div class="container">
        <h1 class="hero-text">
            <strong>KLIK TOMBOL DIBAWAH UNTUK MENAMPILKAN</strong><br>
            <span class="fw-light">DESAIN DARI</span> <strong>ERD DIAGRAM</strong>
        </h1>

        <div class="text-center mt-5">
            <button type="button" class="btn btn-dark text-light fw-bold px-5 py-2" data-bs-toggle="modal" data-bs-target="#erdModal">
                ERD Diagram
            </button>
        </div>
    </div>
</section>

<!-- Modal ERD Diagram -->
<div class="modal fade" id="erdModal" tabindex="-1" aria-labelledby="erdModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content rounded-4 shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="erdModalLabel">ERD Diagram</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset('assets/img/erd-diagram.png') }}" alt="ERD Diagram" class="img-fluid rounded">
            </div>
        </div>
    </div>
</div>

<section id="booking" class="booking-section py-5 mb-4">
    <div class="container">

        <div class="row align-items-start mb-5">
            <div class="col-md-6">
                <h1 class="fw-bold">TESTIMONI <br>PEMESANAN CUCI MOBIL</h1>
            </div>
        </div>

        <div class="row g-4">
            @foreach ($service as $item)
            <div class="col-md-4">
                <div class="booking-card">
                    <div class="card-img">
                        <img src="{{ asset('assets/img/' . $item->gambar) }}" class="img-fluid" alt="Service 1">
                        <div class="overlay">
                            <a href="{{ route('booking', ['service_id' => $item->id]) }}" class="btn-location">
                                <i class="bi bi-calendar-check-fill"></i> Booking
                            </a>
                        </div>
                    </div>
                    <div class="card-body text-center mt-3">
                        <h5 class="fw-bold mb-1">{{ $item->jenis }}</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>
@endsection
