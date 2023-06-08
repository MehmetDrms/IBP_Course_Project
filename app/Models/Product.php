<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'picture1',
        'picture2',
        'picture3',
        'category'
    ];
    public function getModel(){
        return $this->hasMany('App\Models\ProductModel', 'product_id', 'id');
    }

}
