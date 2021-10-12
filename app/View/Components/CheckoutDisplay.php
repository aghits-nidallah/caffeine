<?php

namespace App\View\Components;

use App\Models\Checkout;
use Illuminate\View\Component;

class CheckoutDisplay extends Component
{
    /**
     * The checkout instance.
     *
     * @var \App\Models\Checkout
     */
    public $checkout;

    /**
     * Create a new component instance.
     *
     * @param \App\Models\Checkout $checkout
     * @return void
     */
    public function __construct(Checkout $checkout)
    {
        $this->checkout = $checkout;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.checkout-display');
    }
}
