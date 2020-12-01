@extends('layouts.base')
@section('page_title', 'Programa Vital')
@section('hide_login', true)
@section('hide_logout', true)
@section('body_content')
<div class="page-container">
    <x-carousel type="vital" />
    <x-descriptor type="vital1"/>
    <div class="container brand-list">
        <h2 class="text-pink">
            Terapias disponibles
        </h2>
        <br/>
        <a href="#">
            <img class="brand-logo-lg program-button" src="{{ asset('img/progs/vital/Apidra.png') }}" alt="Apidra" />
        </a>
        <a href="#">
            <img class="brand-logo-lg program-button" src="{{ asset('img/progs/vital/Lantus.png') }}" alt="Lantus" />
        </a>
        <a href="#">
            <img class="brand-logo-lg program-button" src="{{ asset('img/progs/vital/Toujeo.png') }}" alt="Toujeo" />
        </a>
    </div>
    <div class="jumbotron descriptor" style="background-color: #fff9f9">
        <h2 class="text-pink">
            Servicios Ofrecidos
        </h2>
        <hr class="my-4">
        <div class="lead d-none d-lg-block" style="padding: 0 15vw 0 15vw !important;">
            <div class="card-deck">
                <div class="card">
                    <div class="card-body">
                        Según el perfil de riesgo, educación orientada en: generalidades de la Enfermedad, tratamiento, Seguridad en el producto, hábitos de vida saludable.
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        Seguimiento a los pacientes por medio de Titulación y Charlas educativas grupales en Nutrición, ejercicio, técnica de aplicación, enfermedad y tratamiento, Pie diabético, automonitoreo.
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        Entrenamientos en patología, producto y técnica de aplicación a personal de salud.
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        Retroalimentación a médicos e instituciones en la evolución de los pacientes.
                    </div>
                </div>
            </div>
        </div>
        <div class="d-lg-none" >
            <a class="btn btn-yellow" data-toggle="collapse" href="#a" role="button" aria-expanded="false" aria-controls="a" style="width: 75%">
                Ver más
            </a>
            <div class="collapse" id="a" style="text-align: justify !important;">
                <div class="lead" style="padding: 5vh 5vw 0 5vh !important;">
                    <ul>
                        <li>Según el perfil de riesgo, educación orientada en: generalidades de la Enfermedad, tratamiento, Seguridad en el producto, hábitos de vida saludable.</li>
                        <li>Seguimiento a los pacientes por medio de Titulación y Charlas educativas grupales en Nutrición, ejercicio, técnica de aplicación, enfermedad y tratamiento, Pie diabético, automonitoreo.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('custom_scripts')
    @yield('component_scripts')
@endsection
