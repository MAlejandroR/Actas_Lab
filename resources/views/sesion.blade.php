@extends ('layout')

@section ('contenido')
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
    @if(isset($accesos))
        <h2>{{$accesos}} accesos realizados</h2>
    @endif
    @if(isset($opc))
        <h2>Opcion {{$opc}}</h2>
    @endif

    <div class="informacion">
        <fieldset>
            <legend>Gestión sesiones por request</legend>
            <form action="sesion_request" method="POST">
                @csrf
                <input type="submit" value="Iniciar" name="submit">
                <input type="submit" value="Sumar" name="submit">
                <input type="submit" value="Restar" name="submit">
                <input type="submit" value="Borrar" name="submit">
            </form>
        </fieldset>

    </div>
    <div class="informacion">
        <fieldset>
            <legend>GEstión sesiones por helper</legend>
            <form action="sesion_helper" method="POST">
                @csrf
                <input type="submit" value="Iniciar" name="submit">
                <input type="submit" value="Sumar" name="submit">
                <input type="submit" value="Restar" name="submit">
                <input type="submit" value="Borrar" name="submit">
            </form>
        </fieldset>

    </div>
@stop

@section('pie')

    <div class="footer-copyright text-center py-3">
        © 2019 Copyright: CPIFP Los Enlaces DPTO Informática Manuel Romero
    </div>
@stop



