@extends('layouts.base')
@section('page_title', 'Mi Sanofi')
@section('hide_login', true)
@section('body_content')
    <div class="page-container">
        <x-carousel />
        <x-button-bar type="home" />
        <div class="row d-none d-lg-block" style="margin: 3vh 3vw 3vh 3vw;">
            <div class="col-6">
                <x-your-indicators />
            </div>
        </div>
        <div class="row d-lg-none" style="margin: 3vh 3vw 3vh 3vw;">
            <x-your-indicators/>
        </div>

        <x-feel-cards type="home" title="Noticias"/>
    </div>

@endsection
@section('custom_scripts')
    <script type="text/javascript">
        $( document ).ready(() => {
            var data = {
                series: [
                    {value: 82, className: "purple-stroke"},
                    {value: 18, className: "pink-stroke"}
                ]
            };

            var sum = function(a, b) { return a.value + b.value };

            new Chartist.Pie('.ct-chart', data, {
                labelInterpolationFnc: function(value) {
                    return Math.round(value / data.series.reduce(sum) * 100) + '%';
                }
            });
            new Chartist.Pie('.ct-chart2', data, {
                labelInterpolationFnc: function(value) {
                    return Math.round(value / data.series.reduce(sum) * 100) + '%';
                }
            });
        })

    </script>
@endsection
