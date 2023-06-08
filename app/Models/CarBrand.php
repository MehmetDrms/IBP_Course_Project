<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarBrand extends Model
{
    use HasFactory;
    protected $fillable = ['brand'];
    public $timestamps = false;

    public function getModels(){
        return $this->hasMany('App\Models\CarModel', 'brand', 'id');
    }
}
