<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion', 
        'precio',
        'product_type_id'
    ];

    public function type()
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }
}