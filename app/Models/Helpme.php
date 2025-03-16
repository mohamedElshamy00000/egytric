<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Helpme extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'city',
        'area',
        'use_car_to_travel',
        'property_type',
        'selected_brands',
        'price_range',
        'comment',
        'status',
        'is_quote_request',
        'car_id',
        'is_favorite',
        'quote_requested_at'
    ];

    protected $casts = [
        'selected_brands' => 'array',
        'use_car_to_travel' => 'boolean',
        'is_quote_request' => 'boolean',
        'is_favorite' => 'boolean',
        'quote_requested_at' => 'datetime'
    ];

    public function brands(): BelongsToMany
    {
        return $this->belongsToMany(Brand::class, 'help_request_brands');
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(ElectricCar::class, 'car_id');
    }
}
