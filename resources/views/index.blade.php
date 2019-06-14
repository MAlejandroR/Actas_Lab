@extends ('layout')



@section('contenido')
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif
    <div class="informacion">
Aqui está la información de cómo usar la web
        <form action="">
            <input type="submit" value="Acceder">
            <input type="submit" value="Borrar datos de sesión">

        </form>
    </div>
@stop
@section('pie')

    <div class="footer-copyright text-center py-3">
        © 2019 Copyright: CPIFP Los Enlaces DPTO Informática Manuel Romero
       
    </div>



@stop



