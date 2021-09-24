<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart.index', [
            'carts' => Cart::where('user_id', auth()->id())->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'product_id' => ['required', 'integer', 'exists:products,id'],
        ]);

        try {
            Cart::create($request->only([
                'user_id', 'product_id',
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
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        Gate::authorize('update', $cart);

        $request->validate([
            'quantity' => ['required', 'integer', 'gt:0', 'lte:max_quantity'],
        ]);

        try {
            $cart->update($request->only('quantity'));
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
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        Gate::authorize('delete', $cart);

        try {
            $cart->delete();
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
