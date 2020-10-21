@extends('layouts.base')
@section('page_title', 'Microlearning Test')
@section('hide_login', true)
@section('body_content')
    <div class="container" style="margin-top: 10%">
        <div class="card">
            <div class="card-header text-center">
                <h1 class="text-purple" style="margin-top: 1vh"> <i class="fad fa-code"></i> </h1>
                <h4 class="text-purple"> Sanofi DevTools </h4>
                <h2 class="text-purple" style="margin: 1vh 1vw"> <strong>Generación de campos</strong> </h2>
            </div>
            <div class="card-body">
                <div class="container" style="padding-left: 2vw; padding-right: 2vw">
                    <form action="{{ route('microtest') }}" method="post">
                        @csrf
                        <br/>
                        <div class="input-group input-group-lg mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="lab-addon"> <i class="fad fa-tags"></i> &nbsp; Etiqueta &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                            </div>
                            <input type="text" name="label" id="label" class="form-control" placeholder="Datos generales de [ENFERMEDAD]..." aria-label="label" aria-describedby="lab-addon">
                        </div>
                        <div class="input-group input-group-lg mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="lab-field"> <i class="fad fa-project-diagram"></i> &nbsp; Componentes </span>
                            </div>
                            <input type="text" name="fields" id="fields" class="form-control" placeholder="cf_3046, cf_2014...." aria-label="Fields" aria-describedby="lab-field">
                        </div>
                        <br/>
                        <div class="row text-center justify-content-center">
                            <div class="col-6">
                                <button type="submit" class="btn btn-purple btn-lg"> Enviar petición </button>
                            </div>
                        </div>
                        <br/>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom_scripts')
    @yield('component_scripts')
@endsection
