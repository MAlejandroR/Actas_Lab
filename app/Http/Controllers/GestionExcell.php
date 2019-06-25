<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use  PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\Alumno;

class GestionExcell extends Controller
{
    private $certificado = null;
    private $actilla = null;

    //
    public function cargar_ficheros(Request $r)
    {
        $this->copiar_ficheros($r);
        $ruta = $this->obtener_ruta();
        $file = "$ruta/storage/app/$this->actilla";
        $this->cargar_alumnos($file);


        //Solo si he aportado los dos ficheros
        /*        if (!(empty($actilla['name'])) || !(empty($certificado['name']))) {
                    $alumno_obj = new Alumno();
                    $certificado_obj = new Ficheros();
                    $modulo_obj = new Modulo();
                }
        */
    }

    /**
     * @param Request $r
     * @return false|string
     */
    public function copiar_ficheros(Request $r)
    {
        $actilla = $r->file('actilla');
        $nombre = $actilla->getClientOriginalName();
        $path = $r->file('actilla')->storeAs('actillas', $nombre);
        $this->actilla = "actillas/$nombre";
        $certificado = $r->file('certificado');
        $nombre = $certificado->getClientOriginalName();
        $path = $r->file('certificado')->storeAs('certificados', $nombre);
        $this->certificado = "actillas/$nombre";
    }

    /**
     * @return string trata de obetener la dir del proyecto
     */
    private function obtener_ruta()
    {
        $vendorDir = dirname(dirname(__FILE__));
        $baseDir = dirname($vendorDir);
        $baseDir = dirname($baseDir);
        return ($baseDir);
    }

    /**
     * A partir del fichero de actilla
     * cargamos los alumnos (apellido, nombre de la la columna
     *
     */
    private function cargar_alumnos(String $fichero){
        $alumno = new Alumno();
        $excell = $this->get_excell($fichero);
        $filas = $excell->getHighestRow();
        for ($f = 0; $f < $filas; $f++) {
            //Obtengo el valor de las celdas de la columna B = 2
            //En esta columna está la información
            $valor = $excell->getCellByColumnAndRow(2, $f)->getValue();
            if (is_numeric((int)$valor)) { //Esto es que esta fila nos interesa
                //sacamos el nombre de esta fila
                $nombre = $excell->getCellByColumnAndRow(3, $f)->getValue();
                if ((!is_null($nombre)) and (strpos($nombre, "Apellidos") === false)) {
                    //En este caso tengo un alumno, leo sus datos y lo grabo en la BD
                    $nombre = trim(Str::before($nombre,'('));
                    $n=trim(Str::before($nombre, ","));
                    $a=trim(Str::after($nombre, ","));
                    var_dump($n. "----");
                    var_dump($a. "<hr />");
                    $alumno = new Alumno();
                    $alumno->nombre = $n;
                    $alumno->apellido= $a;
                    $alumno->save();
                    unset ($alumno);
                }

            }
        }
    }

    private function get_excell(string $file)
    {
        $sheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
        //preparo el fichero para trabajar con él
        $worksheet = $sheet->getActiveSheet();
        return ($worksheet);

    }



//$actilla = $r->file('actilla')->getPath();
//var_dump($actilla);

    public
    function index()
    {
        $argumentos = $this->inicializa_variables_vista();
        return view("actas/gestion_excell", $argumentos);
    }

    /**
     * @return array valores por defecto para la plantilla
     */
    private
    function inicializa_variables_vista(): array
    {
        $argumentos['msj'] = <<<FIN
    <h3>Actulamente no hay ficheros cargados para hacer el informe,</h3>
    <h4>o los cargados no son correctos.</h4>
             Para generar el informe se necesitan dos ficheros xls:
                <ol>
                    <li>
                        Documento de actilla de notas (disponible para tutores en sigad).
                    </li>
                    <li>
                        Documento de certificado de notas (facilitado por jefatura).
                    </li>
                </ol>
            Por favor, aporta estos ficheros en el menú inferior, para poder seguir.
FIN;
        $argumentos['siglas_asignadas'] = false;
        $argumentos['codigos'] = [];
        $argumentos['ficheros'] = true;
        return $argumentos;
    }

    /**
     * @param $col son letras de columnas de excell
     * Devuelve el entero A..Z AB AC .. 1..
     *
     */

    private function translate_letter_to_number(string $letter)
    {

        $letras = ord('Z') - ord('A') + 1; //son las letras del abecedario
        if (ord($letter) <= 'Z')
            $retorno = ((ord($letter) - ord('A')) + 1);
        else {
            $retorno1 = $letras + (ord($letter[0]) - ord('A'));//Valor de la primera letra
            //echo "construyendo valor $retorno1<br />";
            $retorno2 = ord($letter[1]) - ord('A');
            //echo "construyendo valor $col[1] - $retorno2<br />";
            $retorno = $retorno1 + $retorno2;
        }
        return $retorno;

    }
}
