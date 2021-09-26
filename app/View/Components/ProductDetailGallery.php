<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProductDetailGallery extends Component
{
    /**
     * The product instance.
     *
     * @var \App\Models\Product $product
     */
    public $product;

    /**
     * Create a new component instance.
     *
     * @param \App\Models\Product $product
     * @return void
     */
    public function __construct($product)
    {
        $this->product = $product;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product-detail-gallery', [
            'product' => $this->product,
        ]);
    }
}
