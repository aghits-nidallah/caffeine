<?php

namespace App\View\Components;

use App\Models\Cart;
use Illuminate\View\Component;

class CartDisplay extends Component
{
    /**
     * The cart instance.
     * 
     * @var \App\Models\Cart $cart
     */
    public $cart;
    
    /**
     * Create a new component instance.
     *
     * @param \App\Models\Cart $cart
     * @return void
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cart-display', [
            'cart' => $this->cart,
        ]);
    }
}
