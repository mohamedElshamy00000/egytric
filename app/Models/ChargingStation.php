<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
class ChargingStation extends Model
{
    use HasFactory;
    protected $table = 'charging_stations';
    protected $fillable = ['name', 'latitude', 'description', 'kw', 'longitude', 'address', 'status'];

}
