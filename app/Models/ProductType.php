<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    protected $table = 'product_types';

    protected $fillable = [
        'name'
    ];

    protected $attributes = [
        'created_at' => null,
        'updated_at' => null,
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'product_type_id');
    }
}