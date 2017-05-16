@extends('adminlte::layouts.auth')

@section('htmlheader_title')
    Login
@endsection

@section('content')

    <div class="smart-wrap">
        <div class="smart-forms smart-container wrap-3">


            <div class="form-header header-black">
                <h4><i class="fa fa-sign-in"></i>Inicio de sesión</h4>
            </div><!-- end .form-header section -->

            <div class="col-sm-12"  align="center">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops! </strong> Error de acceso<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <form action="{{ url('/login') }}" method="POST" id="contact">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-body theme-black">

                    <div class="spacer-b30">
                        <div class="tagline"><span>Acceso al sistema</span></div><!-- .tagline -->
                    </div>

                    <div class="section">
                        <label class="field prepend-icon">
                            <input type="text" name="email" id="email" class="gui-input" value="{{old('email')}}" placeholder="Ingrese el usuario">
                            <span class="field-icon"><i class="fa fa-user"></i></span>
                        </label>
                    </div><!-- end section -->

                    <div class="section">
                        <label class="field prepend-icon">
                            <input type="password" name="password" id="password" class="gui-input" placeholder="Ingrese la contraseña">
                            <span class="field-icon"><i class="fa fa-lock"></i></span>
                        </label>
                    </div><!-- end section -->

                    <div class="section">
                        <label class="switch switch-black block">
                            <input type="checkbox" name="remember" id="remember" >
                            <span class="switch-label" for="remember" data-on="SI" data-off="NO"></span>
                            <span> Recordarme ?</span>
                        </label>
                    </div><!-- end section -->

                </div><!-- end .form-body section -->
                <div class="form-footer">
                    <button type="submit" class="button btn-black">Iniciar</button>
                </div><!-- end .form-footer section -->
            </form>

        </div><!-- end .smart-forms section -->
    </div><!-- end .smart-wrap section -->

    <div></div><!-- end section -->

    </body>


@endsection
