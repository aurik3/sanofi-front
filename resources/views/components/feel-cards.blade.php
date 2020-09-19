<div class="container feel-container">
    <h1 class="text-purple"> ¿Cómo quieres sentirte hoy? </h1>
    <br/>
    <div class="card-deck">
            <div class="card purple-card">
                <img class="card-img-top" src="{{ $card1['image'] }}" alt="{{ $card1['image'] }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $card1['title'] }}</h5>
                    <p class="card-text">{{ $card1['description'] }}</p>

                </div>
                <div class="card-footer">
                    <a href="{{ $card1['href'] }}" class="btn btn-purple">Ver más</a>
                </div>
            </div>
            <div class="card pink-card">
                <img class="card-img-top" src="{{ $card2['image'] }}" alt="{{ $card1['image'] }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $card2['title'] }}</h5>
                    <p class="card-text">{{ $card2['description'] }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ $card1['href'] }}" class="btn btn-pink">Ver más</a>
                </div>
            </div>
            <div class="card yellow-card">
                <img class="card-img-top" src="{{ $card3['image'] }}" alt="{{ $card1['image'] }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $card3['title'] }}</h5>
                    <p class="card-text">{{ $card3['description'] }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ $card1['href'] }}" class="btn btn-yellow">Ver más</a>
                </div>
            </div>
    </div>
</div>
