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
    <div class="informacion">

        <h1>Vamos a generar un fichero xls con las notas de alumnos</h1>

        <!-- vista presentación aplicación controlado con variable bue "first"  -->
        <fieldset class="presentacion">
            <form action="gestion_excell.php" method="POST">
                @csrf
                <ul>
                    <li>
                        Esta aplicación permitirá mostrar un informe de matrícula por alumno
                        de un determinado ciclo.
                    </li>
                    <li>
                        Para ello se necesitan dos ficheros xls
                        <ol>
                            <li>
                                Documento de actilla de notas (disponible para tutores en sigad)
                            </li>
                            <li>
                                Documento de certificado de notas (facilitado por jefatura)
                            </li>
                        </ol>
                    </li>
                    <li>Además deberás de establecer las siglas para los módulos a partir de un formulario que se te facilitará</li>
                </ul>

                <input class=presentacion type="submit" value="Siguiente">

            </form>
        </fieldset>
        <form action="ActasBorrarSesion" method="POST">
            @csrf
            <input type="submit" value="Borrar variables de sesión " name="submit">
        </form>

    </div>
@stop

@section('pie')

    <div class="footer-copyright text-center py-3">
        © 2019 Copyright: CPIFP Los Enlaces DPTO Informática Manuel Romero
    </div>
@stop



