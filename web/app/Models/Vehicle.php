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
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $visible = [
        'user_id',
        'is_confirmed',
    ];

    public function vehicle() {
//        return $this->hasMany('App/')
    }
}
