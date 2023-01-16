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
        'payment_schedule',
        'size',
        'place',
        'text',
        'shortText',
    ];

    protected $hidden = [
        'is_active',
        'created_at',
        'closed_at',
        'updated_at'
    ];
}
