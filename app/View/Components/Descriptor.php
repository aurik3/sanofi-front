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
                $this -> content = 'Somos una empresa diversificada centrada en la salud humana; operamos en todo el mundo y transformamos la innovación científica en soluciones de atención médica, ofrecemos soluciones de salud innovadoras en una amplia gama de afecciones de salud: ya sea una afección común como un resfriado, alergias, problemas digestivos o afecciones graves tales como el cáncer o la esclerosis múltiple; decenas de miles que viven con dermatitis atópica; o millones de personas con afecciones crónicas, como diabetes o enfermedades cardiovasculares. ';
            break;
            case 'vital1':
                $this -> title = 'Población Objetivo';
                $this -> content = 'Pacientes con diabetes que requieran tratamiento con insulina o Agonista de GLP1 de Sanofi.';
            break;
            case 'amigos1':
                $this -> title = 'Población Objetivo';
                $this -> content = 'Terapia complementaria para Hipercolesterolemia familiar heterocigótica y pacientes con hipercolesterolemia mas enfermedad coronaria o cerebrovascular manifiesta.';
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
