<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\DataTables\StoreDataTable;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StoreDataTable $dataTable)
    {
        Gate::authorize('viewAny');

        return $dataTable->render('dashboard.store.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return auth()->user()->store
            ? redirect()->route('dashboard.store.show', auth()->user()->store->id)
            : view('dashboard.store.create');
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
            'name' => ['required', 'string', 'max:255']
        ]);

        try {
            Store::create($request->only(['user_id', 'name']));
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
     * @param  \App\Models\Store  $store
     * @param  \App\DataTables\ProductDataTable  $dataTable
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store, ProductDataTable $dataTable)
    {
        Gate::authorize('view', $store);
        
        $dataTable->user_id = auth()->user()->id;
        return $dataTable->render('dashboard.store.show', [
            'store' => $store
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        Gate::authorize('update', $store);

        return view('dashboard.store.edit', [
            'store' => $store,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        Gate::authorize('update', $store);

        try {
            $store->update($request->only([
                'name', 'description',
            ]));

            if ($request->hasFile('picture')) {
                $this->store_asset($request, $store, 'picture', '/public/store_pictures/');
            }

            if ($request->hasFile('banner')) {
                $this->store_asset($request, $store, 'banner', '/public/store_banners/');
            }
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
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        Gate::authorize('delete', $store);

        try {
            $store->delete();
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

    public function restore(Store $store)
    {
        // TODO: Restore store
        // try {
        //     $store->withTrashed()->restore();
        // } catch (\Exception $e) {
        //     return redirect()->back()->with([
        //         'success' => false,
        //         'message' => config('app.delete_failed_message') . $e->getMessage(),
        //     ]);
        // }

        // return redirect()->back()->with([
        //     'success' => true,
        //     'message' => config('app.delete_success_message'),
        // ]);
    }
    
    /**
     * Store picture to local storage and save the information to database.
     * 
     * @param Request $request
     * @param Store $store
     * @param string $field
     * @param string $storagePath
     * @return void
     */
    private function store_asset(Request $request, Store $store, string $field, string $storagePath)
    {
        $extension = "." . $request->file($field)->getClientOriginalExtension();
        $new_filename = str_replace('.', '', microtime(true)) . $extension;
        
        $request->file($field)->storePubliclyAs($storagePath, $new_filename);

        $store->update([
            $field => $new_filename,
        ]);
    }
}
