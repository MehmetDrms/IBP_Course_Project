<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_id',
        'product_id'
    ];
    public $timestamps = false;
    public function getModel(){
        return $this->hasOne('App\Models\CarModel', 'id', 'model_id');
    }
}
