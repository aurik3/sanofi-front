<div class="container feel-container">
    <h1 class="text-{{ $color1 }}"> {{ $title }} </h1>
    <br/>
    <div class="card-deck">
            <div class="card {{ $color1 }}-card">
                <img class="card-img-top" src="{{ $card1['image'] }}" alt="{{ $card1['image'] }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $card1['title'] }}</h5>
                    <p class="card-text">{{ $card1['description'] }}</p>

                </div>
                <div class="card-footer">
                    <a href="{{ $card1['href'] }}" class="btn btn-{{ $color1 }}">Ver más</a>
                </div>
            </div>
            <div class="card {{ $color2 }}-card">
                <img class="card-img-top" src="{{ $card2['image'] }}" alt="{{ $card1['image'] }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $card2['title'] }}</h5>
                    <p class="card-text">{{ $card2['description'] }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ $card1['href'] }}" class="btn btn-{{ $color2 }}">Ver más</a>
                </div>
            </div>
            <div class="card {{ $color3 }}-card">
                <img class="card-img-top" src="{{ $card3['image'] }}" alt="{{ $card1['image'] }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $card3['title'] }}</h5>
                    <p class="card-text">{{ $card3['description'] }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ $card1['href'] }}" class="btn btn-{{ $color3 }}">Ver más</a>
                </div>
            </div>
    </div>
</div>
