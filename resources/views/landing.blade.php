@extends('layouts.base')
@section('page_title', 'Inicio')
@section('hide_logout', true)
@section('body_content')
    <div class="page-container">
        <x-carousel />
        <x-button-bar type="landing" />
        <x-descriptor type="about"/>
        <x-feel-cards type="landing" title="¿Cómo quieres sentirte hoy?"/>
        <x-brand-list />
    </div>
@endsection

