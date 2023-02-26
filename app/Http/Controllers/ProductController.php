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

    public function find($id)
    {
        if(!$product = Product::findOrFail($id))
            return response()->json(['error' => 'Produto não encontrado!']);


        return response()->json($product);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:40'],
            'description' => ['max:2000'],
            'marca' => ['string', 'min:2', 'max:40'],
            'altura' => ['required', 'numeric'],
            'largura' => ['required', 'numeric'],
            'comprimento' => ['required', 'numeric'],
            'peso' => ['required', 'numeric'],
            'valor' => ['required', 'numeric'],
            'images' => ['array', 'max:10'],
            'images.*' => ['image', 'max:2048'],
            'category_id' => ['required', 'numeric'],
        ]);

        $product = Product::create([
            'name' => $request->name,
            'url_name' => Str::kebab($request->name),
            'description' => $request->description,
            'marca' => $request->marca,
            'altura' => $request->altura,
            'largura' => $request->largura,
            'comprimento' => $request->comprimento,
            'peso' => $request->peso,
            'valor' => $request->valor,
            'category_id' => $request->category_id,
        ]);

        $product->url_name = Str::kebab($request->name) . '-' . $product->id;
        $product->save();

        foreach ($request->file('images') as $imageFile) {
            $path = $imageFile->store('products');

            $image = new Image;
            $image->url_name = $path;
            $image->product_id = $product->id;
            $image->save();
        }

        return response()->json($product);
    }

    public function update($id, Request $request)
    {
        if(!$product = Product::findOrFail($id))
            return response()->json(['error' => 'Produto não encontrado!']);

        $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:40'],
            'description' => ['max:2000'],
            'marca' => ['string', 'min:2', 'max:40'],
            'altura' => ['required', 'numeric'],
            'largura' => ['required', 'numeric'],
            'comprimento' => ['required', 'numeric'],
            'peso' => ['required', 'numeric'],
            'valor' => ['required', 'numeric'],
            'images' => ['array', 'max:10'],
            'images.*' => ['image', 'max:2048'],
            'category_id' => ['required', 'numeric'],
        ]);

        $product->update([
            'name' => $request->name,
            'url_name' => Str::kebab($request->name),
            'description' => $request->description,
            'marca' => $request->marca,
            'altura' => $request->altura,
            'largura' => $request->largura,
            'comprimento' => $request->comprimento,
            'peso' => $request->peso,
            'valor' => $request->valor,
            'category_id' => $request->category_id,
        ]);

        foreach ($request->file('images') as $imageFile) {
            $path = $imageFile->store('products');

            $image = new Image;
            $image->url_name = $path;
            $image->product_id = $product->id;
            $image->save();
        }

        return response()->json(Product::findAllProducts());
    }

    public function destroy($id, Request $request)
    {
        if(!$product = Product::findOrFail($id))
            return response()->json(['error' => 'Produto não encontrado!']);

        $product->destroy($id);

        return response()->json(Product::findAllProducts());
    }
}
