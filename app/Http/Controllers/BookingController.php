<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create(Request $request)
    {
        $services = Services::all();
        $cars = [];

        if (Auth::check()) {
            $cars = Cars::where('user_id', Auth::id())->get();
        }

        return view('booking', [
            'services' => $services,
            'cars' => $cars,
            'selectedServiceId' => $request->service_id
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'tanggal_booking' => 'required|date',
            'metode' => 'required|in:Tunai,Transfer,E-wallet',
        ]);

        $booking = new Booking();

        if (Auth::check() && Auth::user()->role === 'member') {
            $booking->user_id = Auth::id();
            $booking->car_id = $request->car_id;
        }
        else {
            $request->validate([
                'nama_customer' => 'required|string',
                'merk_mobil_customer' => 'required|string',
                'model_mobil_customer' => 'required|string',
            ]);
            $booking->nama_customer = $request->nama_customer;
            $booking->merk_mobil_customer = $request->merk_mobil_customer;
            $booking->model_mobil_customer = $request->model_mobil_customer;
        }

        $booking->service_id = $request->service_id;
        $booking->tanggal_booking = $request->tanggal_booking;

        if ($request->metode == 'Tunai') {
            $booking->status = 'Pending';
        } else {
            $booking->status = 'Proses';
        }

        $booking->save();

        $service = Services::find($request->service_id);

        $payment = new Payment();
        $payment->booking_id = $booking->id;
        $payment->total = $service->harga;
        $payment->metode = $request->metode;

        if ($request->metode == 'Tunai') {
        $payment->status = 'Belum Dibayar';
        } else {
            $payment->status = 'Telah Dibayar';
        }

        $payment->save();

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil dibuat',
        ]);
    }

    public function riwayat()
    {
        $bookings = Booking::with(['service', 'car', 'payment'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('riwayat', compact('bookings'));
    }

}
