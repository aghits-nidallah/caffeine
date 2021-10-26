<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.order.index', [
            'orders' => auth()->user()->orders()->where('payment_file_path', '!=', NULL)->orderBy('is_accepted', 'asc')->get(),
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
        //
    }

    /**
        return $user->role === 'admin'
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, Checkout $order)
    {
        Gate::authorize('update', $order);

        $request->validate([
            'expedition_note' => ['required', 'string'],
        ]);

        try {
            $order->update([
                'is_accepted' => true,
                'expedition_note' => $request->expedition_note,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'success' => false,
                'message' => config('app.update_failed_message') . $e->getMessage(),
            ]);
        }

        try {
            $order->product()->update([
                'stock' => $order->product->stock - $order->quantity,
            ]);
        } catch (\Exception $e) {
            // Revert to the initial state
            $order->update([
                'is_accepted' => false,
                'expedition_note' => null,
            ]);

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
