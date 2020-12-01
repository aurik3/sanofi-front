<div class="container-fluid indicator-container">
    <h2 class="text-green"> Tus Indicadores </h2>
    <br/>
    <div class="row">
        <div class="col-12 col-lg-7">
            <div id="lg-chart" style="height: 28vh">
            </div>
        </div>
        <div class="col-lg-5 justify-content-center align-content-center">
            <h5 class="text-blue">
                Tus visitas esta semana
            </h5>
            <br/>
            <div class="row justify-content-center align-content-center">
                <div class="col-2">
                    <span class="dot purple-stroke"></span>
                </div>
                <div class="col-4">
                    <span class="dot-text">Planeadas</span>
                </div>
            </div>
            <div class="row justify-content-center align-content-center">
                <div class="col-2">
                    <span class="dot pink-stroke"></span>
                </div>
                <div class="col-4">
                    <span class="dot-text">Autorizadas</span>
                </div>
            </div>
            <br/>
        </div>
    </div>
    <div class="row justify-content-center" style="margin-top: 2vh; margin-bottom: 2vh">
        <h4 class="text-blue"> Tu Agenda para hoy </h4>
    </div>
    <div class="row justify-content-center">
        @foreach($appointments as $appointment)
        <div class="col-4 col-lg-3">
            <h5 class="text-black"> {{ $appointment["hour"] }} </h5>
            <h6> {{ $appointment["patient"] }} </h6>
            <h6> {{ $appointment["address"] }} </h6>
        </div>
        @endforeach
    </div>
</div>
@section('component_scripts')
    <script type="text/javascript">
        const chart1 = new Chartisan({
            el: '#lg-chart',
            url: "@chart('visits_chart')",
            hooks: new ChartisanHooks()
            .legend(false)
            .colors(['#591C98', '#C00E62'])
            .tooltip()
            .axis(false)
            .datasets(['pie'])
        });
    </script>
@endsection
