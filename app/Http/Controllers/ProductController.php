<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    //

    public function index()
    {
        return response()->json(Product::findAllProducts());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:40'],
            'category_id' => ['required', 'numeric'],
            'description' => ['max:2000'],
            'images' => ['required', 'array', 'max:10'],
            'images.*' => ['image', 'max:2048'], // cada imagem deve ser um arquivo de imagem com até 2MB
        ]);

        $product = Product::create([
            'name' => $request->name,
            'url_name' => Str::kebab($request->name),
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);

        foreach ($request->file('images') as $imageFile) {
            $path = $imageFile->store('products');

            $image = new Image;
            $image->url_name = $path;
            $image->product_id = $product->id;
            $image->save();
        }

        return response()->json($product);
    }
}
