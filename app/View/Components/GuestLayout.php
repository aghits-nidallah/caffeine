<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GuestLayout extends Component
{
    /**
     * Indicate if header is should be rendered.
     * 
     * @var bool $show_header
     */
    public $show_header;

    /**
     * Indicate if footer is should be rendered.
     * 
     * @var bool $show_footer
     */
    public $show_footer;

    /**
     * Constructor
     * 
     * @param bool $showHeader
     * @param bool $showFooter
     * @return void
     */
    public function __construct($showHeader = false, $showFooter = false)
    {
        $this->show_header = $showHeader;
        $this->show_footer = $showFooter;
    }
    
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.guest', [
            'show_header' => $this->show_header,
            'show_footer' => $this->show_footer,
        ]);
    }
}
