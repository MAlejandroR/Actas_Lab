<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SesionesRequest extends Controller
{

    public function index(Request $r){
        if (!$r->session()->exists("accesos"))
             $r->session()->put('accesos',0);

        switch ($_POST['submit']){
            case 'Iniciar':
                $this->init($r);
                break;
            case 'Sumar':
                $this->add_acceso($r);
                break;
            case 'Restar':
                $this->sub_acceso($r);
                break;
            case 'Borrar':
                $this->destroy($r);
                break;
        }
        $a=$r->session()->get("accesos");
        $opc=$_POST['submit'] ?? "nada";

        return view ("sesion",['accesos'=>$a,"opc"=>$opc]);

    }

    public function sub_acceso(Request $request){
        $acceso=$request->session()->get("accesos");
        $acceso--;
        $request->session()->put('accesos',$acceso);

    }
    public function add_acceso(Request $request){
        $acceso=$request->session()->get("accesos");
        $acceso+=1;
        $request->session()->put('accesos', $acceso);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
     $request->session()->get("accesos");
    }

    public function destroy(Request $request)
    {
        $request->session()->remove("accesos");
        //
    }
    public function init(Request $request)
    {
        $request->session()->put("accesos", 1);
        $a = $request->session()->get("accesos");

        //
    }










}
