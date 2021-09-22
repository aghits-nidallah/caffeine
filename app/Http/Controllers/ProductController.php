<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // TODO: this
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'stock' => ['required', 'integer'],
            'price' => ['required', 'integer'],
        ]);

        try {
            Product::create($request->only([
                'user_id', 'name', 'description', 'stock', 'price'
            ]));
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'success' => false,
                'message' => config('app.store_failed_message') . $e->getMessage(),
            ]);
        }

        return redirect()->back()->with([
            'success' => true,
            'message' => config('app.store_success_message'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('dashboard.product.show', [
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        Gate::authorize('update', $product);
        
        return view('dashboard.product.edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        Gate::authorize('update', $product);

        $request->validate([
            'name' => ['string', 'max:255'],
            'description' => ['string'],
            'stock' => ['integer'],
            'price' => ['integer'],
            'active' => ['boolean'],
        ]);

        try {
            $product->update($request->only([
                'name', 'description', 'stock', 'price', 'active'
            ]));
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'success' => false,
                'message' => config('app.update_failed_message') . $e->getMessage(),
            ]);
        }

        return redirect()->back()->with([
            'success' => true,
            'message' => config('app.update_success_message'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Gate::authorize('delete', $product);
        
        try {
            $product->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'success' => false,
                'message' => config('app.delete_failed_message') . $e->getMessage(),
            ]);
        }

        return redirect()->back()->with([
            'success' => true,
            'message' => config('app.delete_success_message'),
        ]);
    }
}
