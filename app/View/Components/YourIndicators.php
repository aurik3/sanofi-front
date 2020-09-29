<?php

namespace App\View\Components;

use Illuminate\View\Component;

class YourIndicators extends Component
{

    public $appointments;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct() {

        $this -> appointments = [
            [
                "hour" => "8:00AM",
                "patient" => "Ana María Pérez",
                "address" => "CL 15 # 72B-25"
            ],
            [
                "hour" => "10:00AM",
                "patient" => "Ana María Pérez",
                "address" => "CR 1 # 15-25"
            ],
            [
                "hour" => "2:00PM",
                "patient" => "Mary Mora",
                "address" => "AV 68 # 24-15"
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
        return view('components.your-indicators');
    }
}
