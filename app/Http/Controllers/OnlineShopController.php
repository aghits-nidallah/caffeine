<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class OnlineShopController extends Controller
{
    /**
     * Show the index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newest_products = Product::orderBy('created_at', 'desc')->where('stock', '!=', 0)->take(16)->get();
        $store_recommendations = Store::take(8)->inRandomOrder()->get();
        $popular_products = Product::inRandomOrder()->where('stock', '!=', 0)->take(16)->get();

        return view('index', [
            'newest_products' => $newest_products,
            'store_recommendations' => $store_recommendations,
            'popular_products' => $popular_products,
        ]);
    }

    /**
     * Show the product detail.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function product(Product $product)
    {
        return view('product', [
            'product' => $product
        ]);
    }
}
