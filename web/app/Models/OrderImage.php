<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'src',
        'order_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
