<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tittle',
        'location',
        'price',
        'paymentSchedule',
        'size',
        'place',
        'text',
        'shortText',
    ];

    protected $hidden = [
        'isActive',
        'created_at',
        'closed_at',
        'updated_at'
    ];
}
