<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $fillable = [
        'name',
        'price',
        'stock',
        'sku',
        'image',
        'status',
        'description',
        "average_rating",
        'category_id',
        'brand_id',
        'phone',
        'address',
        'email',
        'website',
        'short_description'
    ];

    public static function Rules($productId = null){
        return [
            'photo'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'name'     => 'required|string|max:255',
            'sku'      => 'nullable|unique:products,sku,'. $productId,
            'price'    => 'required|numeric|min:0',
            'category' => 'nullable|exists:categories,id',
            'brand'    => 'nullable|exists:brands,id',
        ];
    }

    public function reviews()
    {
        return $this->hasMany(Review::class); // One product has many reviews
    }
}
