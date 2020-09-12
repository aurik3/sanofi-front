<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="{{ route('home') }}">
        <img class="nav-logo" src="{{ asset('img/sanofi-color.svg') }}" alt="Sanofi" />
    </a>
    @if(empty($__env->yieldContent('hide_login')))
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="#" class="btn btn-login">
                <i class="far fa-user-circle"></i>
                Ingreso
            </a>
        </li>
    </ul>
    @endif
</nav>
