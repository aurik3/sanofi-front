@extends('layouts.base')
@section('page_title', 'Microlearning Test')
@section('hide_login', true)
@section('body_content')
    <div class="container" style="margin-top: 10vh">
        <x-micro-form label="{{ $label }}" query="{{ $fields }}" />
    </div>
@endsection
@section('custom_scripts')
    @yield('component_scripts')
@endsection
