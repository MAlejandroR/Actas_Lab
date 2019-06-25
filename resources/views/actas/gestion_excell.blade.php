@extends ('layout')

@section('contenido')
<div id="app">
    <fieldset class="presentacion2">
        <legend>Notas importantes</legend>
            {!! $msj !!}
    </fieldset>


    <!--Formulario para aportar nuevos ficheros-->
  <!--  <template v-if="ficheros">-->
        <fieldset>
            <legend>Ficheros de certificados y actillas</legend>
            <form action="cargar_ficheros" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="actilla">Excel Actilla de grupo</label>
                <input type="file" name="actilla" id="actilla">
                <br/>
                <label for="certificado">Excel Certificados de alumnos grupo</label>
                <input type="file" name="certificado" id="certificado">
                <br/>
                <br/>
                <hr/>
                <input type="submit" class="" value="Cargar ficheros" name="submit">
            </form>
        </fieldset>
    <!--</template>-->
    <template v-if="siglas_asignadas">
        <fieldset>
            <legend>Siglas asignadas</legend>

            @if($siglas_asignadas === "true")
                @foreach ($modulo_obj->getMerge() as $codigo => $modulo) {
                {{$modulo['nombre']}}  -- {{$modulo['sigla']}} <br/>
                @endforeach
            @endif

            Si quieres cambiarlas debes presionar el botón correspondiente
            <button @click="btn_asignacion()" class=presentacion>Reasignar siglas de módulos</button>


    </template>

    <!-- Formulario para vincular siglas con módulos -->
    <template v-else="siglas_asignadas">
        <fieldset>
            <legend>Selecciona códigos</legend>
            <form action="gestion_excell.php" method="POST">

                @if (isset($codigos)):
                {{$n = 0}}
                @foreach ($codigos as $codigo => $nombre):
                echo "$nombre";
                {{$n++}};

                <select @click="valida(<?php echo $n ?>)" v-if="keys[<?php echo($n - 1) ?>]"
                        name={{siglas[$codigo]}}
                                v-model="keys[{{$n}}]">
                    <option v-for="sigla in siglas">
                        {{ sigla.name }}
                    </option>
                </select>
                <br/>
                @endforeach;
                @endif;
                <!--son las 10 siglas-->
            <!--                <input type="hidden" value='<?php //echo serialize($siglas) ?>' name =siglas>
                e<input type="hidden" value='{{serialize($codigos)}} ' name=codigos>-->
                <input type="submit" value="Asignar siglas" name="submit">

            </form>
        </fieldset>

    </template>
    <fieldset>
        <legend>Selecciona Las acciones para generar el informe</legend>
        <form action="gestion_excell.php" method="POST">
            <fieldset>
                <legend>Color fondo de celdas</legend>
                Color Matriculado &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="color" disabled value="#ffffff"
                                                                             name='c_matricula' id="">
                <br/>
                Color aprobado&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="color" disabled
                                                                                                 value="#00FF00"
                                                                                                 name='c_aprobado'
                                                                                                 id="">
                <br/>
                Color No matriculado&nbsp;&nbsp;&nbsp;<input type="color" value="#9c9c9c" disabled name='c_pendiente'
                                                             id="">
                <br/>
            </fieldset>
            <br/>
            <label for="submit">Generamos el informe descargando una xls</label>
            <input type="submit" class="" value="generar" name="submit">
            <br/>
            <label for="submit">Mostrar el informe en una tabla en la pantalla </label>
            <input type="submit" value="visualiza" name="submit">
        </form>
    </fieldset>


    <!--Formulario para asignar siglas -->
</div>
@stop
@section ('script')
<script>
    var app;
    app = new Vue({
        el: '#app',
        data: {
            ficheros:{{$ficheros}},
            siglas_modulos: true,
            selecciona_codigos: "",
            siglas_asignadas: <?php echo $siglas_asignadas ?>,
            msj_ficheros: 'Mostrar formulario',
            siglas:<?php echo isset($siglas) ? genera_array_siglas($siglas) : "false" ?>,
            codigos:<?php echo isset($siglas) ? genera_array_objetos_codigos($codigos) : "false"?>,
            modulos_establecidos: false,

            keys: [true,<?php if (isset($codigos))
                for ($a = 1; $a <= count($codigos); $a++) {
                    echo "''";
                    if ($a < count($codigos))
                        echo ",";
                }
                ?>],
            imagen: [
                'http://blog.nubecolectiva.com/wp-content/uploads/2018/10/img_destacada_blog_devs-9-950x305.png'
            ],
            isLoad: false,
            /* crearImagen() {
                 this.cargarImagen()
             },*/
        },
        methods: {
            btn_ficheros() {
                if (this.ficheros === false) {
                    this.ficheros = true;
                    this.msj_ficheros = "Ocultar formulario";
                } else {
                    this.ficheros = false;
                    this.msj_ficheros = "Mostrar formulario";

                }
            },//end function
            valida: function (n, event) {
//                alert ("Leído "+eval("this.key"+n));
                var c;
                for (c = 0; c < n; c++) {
                    var a = this.keys[c]
                    var b = this.keys[n]
                    if (a == b) {
                        alert("Este valor" + b + " ya ha sido usado");
                        this.keys[n] = null;
                    }
                }//End for
                if (n == this.keys.length)
                    this.modulos_establecidos = true;
            },//end funciton
            btn_asignacion: function () {
                this.siglas_asignadas = false;
                this.selecciona_codigos = true;
            },

            esperarTiempo() {
                setTimeout(function () {
                    this.isLoad = true
                }.bind(this), 3000);
            },
        },
        //end methods
    });
</script>
@stop