<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Descriptor extends Component
{

    public $title;
    public $content;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type)
    {
        switch ($type) {
            case 'about':
                $this -> title = '¿Quiénes sómos?';
                $this -> content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque velit lectus, efficitur non sem ut, tempor mattis elit. In cursus condimentum lacus, ut mattis est congue id. Duis interdum varius eleifend. Aliquam commodo volutpat ipsum, ac congue risus dapibus id. Aliquam dapibus ut metus et placerat. Pellentesque ornare ante id velit volutpat, eget tincidunt lectus egestas. Donec vulputate libero ligula, vitae bibendum dolor malesuada at.';
            break;
            default:
                $this -> title = 'Descriptor title';
                $this -> content = 'Descriptor content';
            break;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.descriptor');
    }
}
