<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of all the Products.
     */
    public function index(): View
    {
        return view('pages.products', [
            'products' => Product::all()
        ]);
    }

    /**
     * Display the specified Product.
     */
    public function show(Product $product): View
    {
        return view('pages.product', [
            'product' => Product::firstWhere('id', $product->id)
        ]);
    }
}
