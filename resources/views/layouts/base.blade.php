<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title> Sanofi @if(!empty($__env->yieldContent('page_title'))) - @yield('page_title') @endif</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/chartist/0.11.4/chartist.min.css" rel="stylesheet" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" rel="stylesheet" />
    </head>
    <body @if(!empty($__env->yieldContent('body_class'))) class="@yield('body_class')" @endif >
        <x-navbar />
        <main role="main">
            @yield('body_content')
        </main>
        <x-base-footer />
        <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
        <script src="https://kit.fontawesome.com/720bef5612.js" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
        <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/i18n/defaults-es_ES.min.js"></script>
        @yield('custom_scripts')
    </body>
</html>
