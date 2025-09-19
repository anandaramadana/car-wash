@extends('components.app')
@section('title', 'Riwayat Booking - Car Wash')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">Riwayat Booking</h2>

    @if($bookings->isEmpty())
        <div class="alert alert-info">Anda belum pernah melakukan booking.</div>
    @else
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Layanan</th>
                    <th>Mobil</th>
                    <th>Tanggal Booking</th>
                    <th>Status</th>
                    <th>Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $i => $booking)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $booking->service->jenis }}</td>
                    <td>
                        @if($booking->car)
                            {{ $booking->car->merk }} - {{ $booking->car->model }} ({{ $booking->car->plat_no }})
                        @else
                            <em>Guest Car</em>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d M Y') }}</td>
                    <td>
                        <span class="badge
                            @if($booking->status=='Pending') bg-warning
                            @elseif($booking->status=='Proses') bg-primary
                            @elseif($booking->status=='Selesai') bg-success
                            @else bg-danger @endif">
                            {{ $booking->status }}
                        </span>
                    </td>
                    <td>
                        @if($booking->payment)
                            <span class="badge
                                @if($booking->payment->status=='Telah Dibayar') bg-success
                                @elseif($booking->payment->status=='Belum Dibayar') bg-warning
                                @else bg-danger @endif">
                                {{ $booking->payment->status }}
                            </span>
                        @else
                            <span class="badge bg-secondary">-</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection

