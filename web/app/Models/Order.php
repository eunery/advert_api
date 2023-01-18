<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
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
        'is_confirmed',
        'user_created',
        'user_accepted',
        'created_at',
        'closed_at',
        'updated_at'
    ];
}
