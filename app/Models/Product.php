<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url_name',
        'category_id',
        'description',
        'marca',
        'altura',
        'largura',
        'comprimento',
        'peso',
        'valor',
        'category_id'
    ];

    public function images()
    {
        return $this->hasMany(Image::class, 'product_id');
    }

    public static function findAllProducts()
    {
        $allProducts = Product::all();

        foreach ($allProducts as $product){
            $images = Image::all();

            $productImages = $images->where('product_id', $product->id)->values();

            $product->images = $productImages;
        }

        return $allProducts;
    }
}
