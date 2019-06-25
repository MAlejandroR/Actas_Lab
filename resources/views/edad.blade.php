@extends ('layout')

@section ('contenido')

    <div class="informacion">
        <fieldset>
            <legend>Gestión sesiones por request</legend>
            <form action="edad1" method="POST">
                @csrf
                <input type="text" name="edad" id="">
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



