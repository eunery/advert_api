<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_brand',
        'model',
        'color',
        'other',
        'issue_year',
        'plate_number',
        'user_id',
    ];

    protected $hidden = [
        'is_confirmed',
        'created_at',
        'updated_at'
    ];

    public function vehicle() {
//        return $this->hasMany('App/')
    }
}
