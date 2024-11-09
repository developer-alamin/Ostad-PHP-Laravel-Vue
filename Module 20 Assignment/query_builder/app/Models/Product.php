<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';
    protected $fillable = [
        'product_id',
        'name',
        'description',
        'price',
        'stock',
        'image'
    ];

    public static function validationRules()
    {
        return [
            'product_id'         => 'required|string|unique:products',
            'name'               => 'required|string',
            'description'        => 'nullable',
            'price'              => 'required',
            'stock'              => 'nullable|integer',
            'image'              => 'nullable|string',  
        ];
    }

    
}
