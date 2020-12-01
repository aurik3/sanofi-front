<div class="btn-group btn-bar d-flex" role="group" aria-label="Botones">
    @foreach($buttons as $button)
        <a href="{{ $button['href'] }}" class="btn btn-{{ $button['color'] }} w-100"> {{ $button['description'] }} </a>
    @endforeach
</div>
