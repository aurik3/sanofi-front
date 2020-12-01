<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ButtonBar extends Component
{

    public $buttons;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type)
    {
        switch ($type) {
            case 'landing':
                $this -> buttons = [
                    [
                      'href' => route('prog.vital'),
                      'color' => 'purple',
                      'description' => 'Programa Vital'
                    ],
                    [
                        'href' => route('prog.amigos'),
                        'color' => 'pink',
                        'description' => 'Amigos de Corazón'
                    ]
                ];
            break;
            case 'home':
                $this -> buttons = [
                    [
                        'href' => "#",
                        'color' => 'blue',
                        'description' => 'Indicadores'
                    ],
                    [
                        'href' => "#",
                        'color' => 'green',
                        'description' => 'Eventos'
                    ],
                    [
                        'href' => "#",
                        'color' => 'green',
                        'description' => 'Noticias'
                    ]
                ];
                break;
            default:
                $this -> buttons = [
                    [
                        'href' => "#",
                        'color' => 'purple',
                        'description' => 'TITLE'
                    ],
                    [
                        'href' => "#",
                        'color' => 'pink',
                        'description' => 'TITLE'
                    ],
                    [
                        'href' => "#",
                        'color' => 'yellow',
                        'description' => 'TITLE'
                    ]
                ];
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
        return view('components.button-bar');
    }
}
