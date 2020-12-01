<div class="container-fluid" style="margin: 4vh 0">
    @foreach($elements as $element)
        <div class="news-container">
            <img src="{{ $element['img'] }}" class="img-fluid w-100" alt="Noticia">
            <div class="overlay">
                <div class="text">
                    {!! $element['title'] !!}
                </div>
            </div>
        </div>
    @endforeach
</div>
