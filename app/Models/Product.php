<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['nombre', 'descripción', 'precio', 'product_type_id'];

    public function type()
    {
        return $this->belongsTo(ProductType::class, 'product_type_id'); //dudas<-----------------------
    }
}


