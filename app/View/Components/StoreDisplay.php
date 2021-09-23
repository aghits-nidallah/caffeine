<?php

namespace App\View\Components;

use App\Models\Store;
use Illuminate\View\Component;

class StoreDisplay extends Component
{
    /**
     * The store instance.
     * 
     * @var \App\Models\Store $store
     */
    public $store;
    
    /**
     * Create a new component instance.
     *
     * @param \App\Models\Store $store
     * @return void
     */
    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.store-display', [
            'store' => $this->store,
        ]);
    }
}
