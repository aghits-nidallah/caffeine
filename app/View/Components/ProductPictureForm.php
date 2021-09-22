<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\View\Component;

class ProductPictureForm extends Component
{
    /**
     * The counter used to generate how many pictures.
     * 
     * @var int $counter
     */
    public $counter;

    /**
     * The picture urls.
     * 
     * @var string[] $picture_urls
     */
    public $picture_urls;
    
    /**
     * Indicates this component is readonly.
     * 
     * @var bool $readonly
     */
    public $readonly;
    
    /**
     * Create a new component instance.
     *
     * @param int $counter
     * @param \App\Models\Product $product
     * @return void
     */
    public function __construct($counter = 5, Product $product = null, $readonly = false)
    {
        $this->counter = $counter;
        $this->readonly = $readonly;

        if ($product) {
            foreach ($product->pictures as $picture) {
                $this->picture_urls[$picture->order] = $picture->picture_url;
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product-picture-form', [
            'counter' => $this->counter,
            'readonly' => $this->readonly,
            'picture_urls' => $this->picture_urls,
        ]);
    }
}
