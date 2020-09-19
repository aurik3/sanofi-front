@extends('layouts.base')
@section('page_title', 'Inicio')
@section('body_content')
    <div class="page-container">
        <x-carousel />
        <x-button-bar type="landing" />
        <x-descriptor type="about"/>
        <x-feel-cards />
        <x-brand-list />
    </div>
@endsection
