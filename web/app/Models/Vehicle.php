<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color',
        'other',
        'car_brand',
        'issue_year',
        'model',
        'plate_number',
        'image'
    ];

    protected $hidden = [
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function vehicle() {
//        return $this->hasMany('App/')
    }
}
