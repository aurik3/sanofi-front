@extends('layouts.base')
@section('page_title', 'Mi Sanofi')
@section('hide_login', true)
@section('body_content')
    <div class="page-container">
        <x-carousel />
        <x-button-bar type="home" />
        <div class="row" style="margin: 3vh 3vw 3vh 3vw;">
            <div class="col-12 col-lg-8">
                <x-your-indicators />
            </div>
            <div class="col-12 col-lg-4">
                <x-event-overview />
            </div>
        </div>
        <x-feel-cards type="home" title="Noticias"/>
        <div class="row"></div>
    </div>

@endsection
@section('custom_scripts')
    @yield('component_scripts')
@endsection
