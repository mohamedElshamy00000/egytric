<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectricCar extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'year' => 'integer',
        'msrp' => 'decimal:2',
        'offer_price' => 'decimal:2',
        'range' => 'integer',
        'battery_capacity' => 'decimal:1',
        'horsepower' => 'integer',
        'acceleration' => 'float',
        'mpge_city' => 'integer',
        'mpge_highway' => 'integer',
        'charging_time_ac' => 'integer',
        'charging_time_dc' => 'integer',
        'mileage' => 'integer',
        'features' => 'array',
        'charging_ports' => 'array',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->brand} {$this->model} {$this->year}";
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function order()
    {
        return $this->hasMany(CarOrder::class);
    }

    public function images()
    {
        return $this->hasMany(ElectricCarImages::class);
    }

    public function ratings()
    {
        return $this->hasMany(CarRating::class);
    }

    public function getDiscountAttribute()
    {
        if ($this->offer_price) {
            return $this->msrp - $this->offer_price;
        }
        return 0;
    }

    public function getDiscountPercentageAttribute()
    {
        if ($this->offer_price && $this->msrp > 0) {
            return round(($this->msrp - $this->offer_price) / $this->msrp * 100, 2);
        }
        return 0;
    }
}
