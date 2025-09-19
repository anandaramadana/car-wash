<?php

namespace App\Models;

use App\Models\Cars;
use App\Models\User;
use App\Models\Payment;
use App\Models\Services;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $guards = [];

    protected $fillable= [
        'id',
        'user_id',
        'car_id',
        'nama_customer',
        'merk_mobil_customer',
        'model_mobil_customer',
        'service_id',
        'tanggal_booking',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function car()
    {
        return $this->belongsTo(Cars::class, 'car_id');
    }

    public function service()
    {
        return $this->belongsTo(Services::class, 'service_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'booking_id');
    }
}
