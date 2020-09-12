@extends('layouts.base')
@section('page_title', 'Login')
@section('hide_login', 'true')
@section('body_content')
    <div class="container d-flex h-100" style="height: 100%">
        <div class="container text-center justify-content-center login-container">
            <div class="row">
                <div class="col-1 d-none d-lg-block"></div>
                <div class="col-11">
                    <h1 class="text-purple">
                        Iniciar Sesión
                    </h1>
                </div>
            </div>
            <form action="" method="post">
                <div class="row justify-content-center">
                    <div class="col-1 d-none d-lg-block">
                        <i class="fal fa-user fa-3x text-purple login-icon"></i>
                    </div>
                    <div class="col-md-5 col-sm-11">
                        <div class="form-group has-feedback">
                            <label for="username"> Usuario </label>
                            <input type="text" name="username" id="username" class="form-control input-lg" required />
                        </div>
                    </div>
                </div>
                <br/>
                <div class="row justify-content-center">
                    <div class="col-1 d-none d-lg-block">
                        <i class="fal fa-key fa-3x text-purple login-icon"></i>
                    </div>
                    <div class="col-md-5 col-sm-11">
                        <div class="form-group">
                            <label for="password"> Contraseña </label>
                            <input type="password" name="password" id="password" class="form-control input-lg" required />
                        </div>
                    </div>
                </div>
                <br/>
                <div class="d-none d-lg-block">
                    <div class="row justify-content-center">
                        <div class="col-1"></div>
                        <div class="col-2">
                            <div class="custom-control custom-checkbox custom-checkbox-green">
                                <input type="checkbox" class="custom-control-input custom-control-input-purple" id="remember" name="remember">
                                <label class="custom-control-label" for="remember"> Recordar contraseña </label>
                            </div>
                        </div>
                        <div class="col-2">
                            <a href="#" class="">
                                Olvidé mi contraseña
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center d-lg-none">
                    <div class="col-12">
                        <div class="custom-control custom-checkbox custom-checkbox-green">
                            <input type="checkbox" class="custom-control-input custom-control-input-purple" id="remember" name="remember">
                            <label class="custom-control-label" for="remember"> Recordar contraseña </label>
                        </div>
                    </div>
                </div>
                <br/>
                <div class="row justify-content-center d-lg-none">
                    <div class="col-12">
                        <a href="#" class="">
                            Olvidé mi contraseña
                        </a>
                    </div>
                </div>
                <br/>
                <div class="row justify-content-center">
                    <div class="col-1"></div>
                    <div class="col-md-4 col-sm-8">
                        <button class="btn btn-purple btn-lg" type="submit"> Ingresar </button>
                    </div>
                    <div class="col-1 d-lg-none"></div>
                </div>
            </form>
        </div>
    </div>
@endsection
