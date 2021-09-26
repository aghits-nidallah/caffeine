<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $file_upload_error_message;

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
            'picture.*' => ['nullable', 'mimes:jpg,jpeg,png'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'stock' => ['required', 'integer'],
            'price' => ['required', 'integer'],
        ]);

        try {
            $product = Product::create($request->only([
                'user_id', 'name', 'description', 'stock', 'price'
            ]));

            $this->upload_product_pictures($request, $product);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'success' => false,
                'message' => config('app.store_failed_message') . $e->getMessage() . $this->file_upload_error_message,
            ]);
        }

        return redirect()->back()->with([
            'success' => true,
            'message' => config('app.store_success_message') . $this->file_upload_error_message,
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
            'picture.*' => ['mimes:jpg,jpeg,png'],
            'name' => ['string', 'max:255'],
            'description' => ['string'],
            'stock' => ['integer'],
            'price' => ['integer'],
            'active' => ['boolean'],
        ]);

        $this->upload_product_pictures($request, $product);

        try {
            $product->update($request->only([
                'name', 'description', 'stock', 'price', 'active'
            ]));
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'success' => false,
                'message' => config('app.update_failed_message') . $e->getMessage() . $this->file_upload_error_message,
            ]);
        }

        return redirect()->back()->with([
            'success' => true,
            'message' => config('app.update_success_message') . $this->file_upload_error_message,
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
            $product->pictures()->delete();
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

    /**
     * Upload the product's pictures.
     *
     * @ref \App\Http\Controllers\ProductController.php@119
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return void
     */
    private function upload_product_pictures(Request $request, Product $product)
    {
        if ($request->hasFile('picture')) {
            foreach ($request->file('picture') as $key => $value) {
                $picture = $request->file('picture')[$key];
                $extension = $picture->getClientOriginalExtension();
                $picture_data = [
                    $key,
                    $picture->getClientOriginalName(),
                    str_replace('.', '', microtime(true)) . '.' . $extension,
                ];

                try {
                    if ($product->pictures()->where('order', $key)->exists()) {
                        $this->update_product_pictures($request, $product, $picture_data);
                        continue;
                    }

                    $this->store_product_pictures($request, $product, $picture_data);
                } catch (\Exception $e) {
                    $this->file_upload_error_message = " Beberapa gambar tidak bisa diupload: " . $e->getMessage();
                }
            }
            return;
        }
    }

    /**
     * Sub function of [upload_product_pictures()], update the existing data on
     * database.
     *
     * @ref \App\Http\Controllers\ProductController.php@185
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @param array $picture_data
     * @return void
     */
    private function update_product_pictures(Request $request, Product $product, $picture_data)
    {
        [$key, $original_name, $new_filename] = $picture_data;

        $old_picture = 'public/product_pictures/' . $product->pictures()->where('order', $key)->first()->storage_name;

        if (Storage::exists($old_picture)) {
            Storage::delete($old_picture);
        }

        $product->pictures()->where('order', $key)->update([
            'storage_name' => $new_filename,
            'original_name' => $original_name,
        ]);

        $request->file('picture')[$key]->storePubliclyAs('public/product_pictures/', $new_filename);
    }

    /**
     * Sub function of [upload_product_pictures()], store the data to database.
     *
     * @ref \App\Http\Controllers\ProductController.php@189
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @param array $picture_data
     * @return void
     */
    private function store_product_pictures(Request $request, Product $product, $picture_data)
    {
        [$order, $original_name, $new_filename] = $picture_data;
        $request->file('picture')[$order]->storePubliclyAs('public/product_pictures/', $new_filename);
        $product->pictures()->create([
            'order' => $order,
            'product_id' => $product->id,
            'storage_name' => $new_filename,
            'original_name' => $original_name,
        ]);
    }
}
