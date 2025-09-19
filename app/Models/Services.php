<?php

namespace App\Models;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Services extends Model
{
    use HasFactory;
    protected $table = 'services';
    protected $guards = [];

    protected $fillable= [
        'id',
        'jenis',
        'desc',
        'harga',
    ];

    public function booking()
    {
        return $this->hasMany(Booking::class, 'service_id');
    }
}
