<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FeelCards extends Component {

    public $card1;
    public $card2;
    public $card3;
    public $color1;
    public $color2;
    public $color3;
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $title) {

        $this ->  title = $title;

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

        switch ($type) {
            case "home":
                $this -> color1 = "green";
                $this -> color2 = "blue";
                $this -> color3 = "green";
            break;
            default:
                $this -> color1 = "purple";
                $this -> color2 = "pink";
                $this -> color3 = "yellow";
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
        return view('components.feel-cards');
    }
}
