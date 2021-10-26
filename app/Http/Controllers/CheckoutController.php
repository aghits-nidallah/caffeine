<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('checkout.index', [
            'checkouts' => auth()->user()->checkout,
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
        $products_in_cart = auth()->user()->cart()->with('store')->get();

        try {
            $products_in_cart->each(function($product) {
                auth()->user()->checkout()->create([
                    'product_id' => $product->product_id,
                    'store_id' => $product->store->id,
                    'quantity' => $product->quantity,
                ]);
            });
            auth()->user()->cart()->delete();
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
     * Display the specified resource.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checkout $checkout)
    {
        Gate::authorize('update', $checkout);

        $request->validate([
            'payment_receipt' => ['required', 'mimes:jpg,jpeg,png,pdf'],
        ]);

        try {
            $checkout->update([
                'payment_file_path' => $request->file('payment_receipt')->storeAs(
                    'checkout_payments/' . $checkout->id,
                    $request->file('payment_receipt')->getClientOriginalName(),
                    'public'
                ),
                'is_accepted' => false,
            ]);
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
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checkout $checkout)
    {
        Gate::authorize('delete', $checkout);

        try {
            $checkout->delete();
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
