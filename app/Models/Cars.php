<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Cars extends Model
{
    use HasFactory;
    protected $table = 'cars';
    protected $guards = [];

    protected $fillable= [
        'id',
        'user_id',
        'merk',
        'model',
        'plat_no',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function booking()
    {
        return $this->hasMany(Booking::class, 'car_id');
    }
}
