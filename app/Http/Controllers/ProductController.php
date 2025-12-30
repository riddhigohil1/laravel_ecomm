<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductListResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index() 
    {
        $products = Product::query()
                    ->active()
                    ->paginate(5);

         return Inertia::render('home', [
                'products'=>ProductListResource::collection($products)
            ]
        );
    }

     public function show(Product $product)
    {
        return Inertia::render('Product/Show', [
            'product' => new ProductResource($product),
            'variationOptions' => request('options', [])
        ]);
    }
}
