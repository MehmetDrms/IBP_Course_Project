<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand',
        'model',
        'start',
        'end',
    ];
    public $timestamps = false;
    public function getBrand(){
        return $this->hasOne('App\Models\CarBrand', 'id', 'brand');
    }
}
