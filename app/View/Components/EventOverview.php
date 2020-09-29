<?php

namespace App\View\Components;

use Illuminate\View\Component;

class EventOverview extends Component
{

    public $elements;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this -> elements = [
            [
                'img' => asset('img/stk1.png'),
                'title' => 'Capacitación <br/> 23 - Feb <br/> Oficina Sanofi'
            ],
            [
                'img' => asset('img/stk2.png'),
                'title' => 'Capacitación <br/> 23 - Feb <br/> Oficina Sanofi'
            ],
            [
                'img' => asset('img/stk3.png'),
                'title' => 'Capacitación <br/> 23 - Feb <br/> Oficina Sanofi'
            ]
        ];

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.event-overview');
    }
}
