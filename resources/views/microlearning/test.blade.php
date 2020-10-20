@extends('layouts.base')
@section('page_title', 'Microlearning Test')
@section('hide_login', true)
@section('body_content')
    <div style="margin-top: 10vh">
        <x-micro-form label="Test Component" query="cf_3046 cf_1546 cf_2210 cf_1548 cf_1843 cf_1789 cf_1823"/>
    </div>
@endsection
@section('custom_scripts')
    @yield('component_scripts')
@endsection
