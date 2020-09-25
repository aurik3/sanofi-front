<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="{{ route('landing') }}">
        <img class="nav-logo" src="{{ asset('img/sanofi-color.svg') }}" alt="Sanofi" />
    </a>
    @if(empty($__env->yieldContent('hide_login')))
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="{{ route('login') }}" class="btn btn-login">
                <i class="far fa-user-circle"></i>
                Ingreso
            </a>
        </li>
    </ul>
    @endif
    @if(empty($__env->yieldContent('hide_logout')))
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <form action="{{ route('m-logout') }}" method="POST">
                    {{ csrf_field() }}
                    <button class="btn btn-login" type="submit">
                        <i class="far fa-key"></i>
                        Salir
                    </button>
                </form>
            </li>
        </ul>
    @endif
</nav>
