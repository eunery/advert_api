<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'tittle',
        'location',
        'price',
        'payment_schedule',
        'size',
        'place',
        'text',
        'short_text',
    ];

    protected $hidden = [
        'created_at',
        'closed_at',
        'updated_at'
    ];

    protected $visible = [
        'is_active',
        'is_confirmed',
        'user_created',
        'user_accepted',
    ];
}
