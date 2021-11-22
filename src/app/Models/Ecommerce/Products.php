<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
        'sku', 'slug', 'name', 'description', 'images_id', 'price', 'quantity'
    ];

}
