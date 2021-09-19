<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AlertSuccess extends Component
{
    /**
     * The alert's title
     * 
     * @var string
     */
    public $title;
    
    /**
     * Create a new component instance.
     *
     * @param string $title
     * @return void
     */
    public function __construct($title = 'Berhasil!')
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert-success', [
            'title' => $this->title,
        ]);
    }
}
