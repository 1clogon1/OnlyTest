<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentCar extends Model
{
    use HasFactory;

    protected $table = 'rent_car';
    protected $fillable = [
        'auto_id',
        'worker_id',
        'rent_from',
        'rent_before',
    ];
}
