<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Carousel extends Component
{

    public $images;
    public $captions;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type = 'default')
    {

        switch ($type) {

            case 'vital':
                $this -> images = [asset('img/progs/vital/slide.png')];
                $this -> captions = ['<h1>Programa Vital</h1>',];
            break;

            case 'amigos':
                $this -> images = [asset('img/progs/amigos/slide.png')];
                $this -> captions = ['<h1>Amigos de Corazón</h1>',];
                break;

            default:
                $this -> images = [asset('img/hslid1.jpg'), asset('img/hslid2.jpg')];
                $this -> captions = [
                    '<h1>Title</h1><br/><h2>Lorem ipsum dolor sit amet consecteur</h2>',
                    '<h1>Title</h1><br/><h2>Lorem ipsum dolor sit amet consecteur</h2>'
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

        return view('components.carousel');
    }
}
