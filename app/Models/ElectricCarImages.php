<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectricCarImages extends Model
{
    use HasFactory;

    protected $fillable = ['electric_car_id','image_path', 'is_primary', 'order'];

    protected $casts = [
        'is_primary' => 'boolean',
        'order' => 'integer',
    ];

    public function electricCar()
    {
        return $this->belongsTo(ElectricCar::class);
    }
}
