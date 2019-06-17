<?php

namespace App\Http\Controllers;


class SesionesHelper extends Controller
{

    public function index()
    {
        if (!session()->exists("accesos"))
            session(['accesos' => 0]);

        switch ($_POST['submit']) {
            case 'Iniciar':
                $this->init();
                break;
            case 'Sumar':
                $this->add_acceso();
                break;
            case 'Restar':
                $this->sub_acceso();
                break;
            case 'Borrar':
                $this->destroy();
                break;
        }
        $a = session("accesos");
        $opc = $_POST['submit'] ?? "nada";

        return view("sesion", ['accesos' => $a, "opc" => $opc]);

    }

    public function init()
    {
        session(["accesos"=> 1]);
        $a = session("accesos");


        //
    }

    public function add_acceso()
    {
        $acceso = session("accesos");
        $acceso += 1;
        session(['accesos'=> $acceso]);
    }

    public function sub_acceso()
    {
        $acceso = session("accesos");
        $acceso--;
        session(['accesos' => $acceso]);

    }

    public function destroy()
    {
        session("accesos",0);
        //
    }


}
