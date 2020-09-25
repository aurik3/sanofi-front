@extends('layouts.base')
@section('page_title', 'Mi Sanofi')
@section('hide_login', true)
@section('body_content')
    <div class="page-container">
        <x-carousel />
        <x-button-bar type="home" />
    </div>

@endsection
