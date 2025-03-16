<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarRating extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function car()
    {
        return $this->belongsTo(ElectricCar::class, 'electric_car_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
