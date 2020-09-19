<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FeelCards extends Component {

    public $card1;
    public $card2;
    public $card3;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct() {

        $this -> card1 = [
            'image' => asset('img/stk1.png'),
            'title' => 'Afinidad: Entiende la vida',
            'description' => 'Lorem ipsum dolor it asimet, consecteur adispiscing elit, sed diam nonummy nibh eusimod linciduml il laoreet magna aliquam erat volutpat.',
            'href' => ''
        ];

        $this -> card2 = [
            'image' => asset('img/stk2.png'),
            'title' => 'Mejor Bienestar',
            'description' => 'Lorem ipsum dolor it asimet, consecteur adispiscing elit, sed diam nonummy nibh eusimod linciduml il laoreet magna aliquam erat volutpat.',
            'href' => ''
        ];

        $this -> card3 = [
            'image' => asset('img/stk3.png'),
            'title' => 'Salud al día',
            'description' => 'Lorem ipsum dolor it asimet, consecteur adispiscing elit, sed diam nonummy nibh eusimod linciduml il laoreet magna aliquam erat volutpat.',
            'href' => ''
        ];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.feel-cards');
    }
}
