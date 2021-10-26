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
     * Indicates the component should be rendered as buyer or the seller.
     *
     * @var bool
     */
    public $show_as_seller;

    /**
     * Create a new component instance.
     *
     * @param \App\Models\Checkout $checkout
     * @param bool $show_as_seller
     * @return void
     */
    public function __construct(Checkout $checkout, $showAsSeller = false)
    {
        $this->checkout = $checkout;
        $this->show_as_seller = $showAsSeller;
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
