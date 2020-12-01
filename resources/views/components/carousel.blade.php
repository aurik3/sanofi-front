<div id="carousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @for($i = 0; $i < count($images); $i++)
            <li data-target="#carousel" data-slide-to="{{ $i }}" @if($i == 0) class="active" @endif></li>
        @endfor
    </ol>
    <div class="carousel-inner">
        @for($i = 0; $i < count($images); $i++)
            <div class="carousel-item @if($i == 0) active @endif">
                <img class="d-block w-100" src="{{ $images[$i] }}" alt="Slide" />
                <div class="carousel-caption d-none d-md-block snf-caption">
                    {!! $captions[$i] !!}
                </div>
            </div>
        @endfor
    </div>
    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
