<?php

namespace App\Http\Controllers;

use App\RegistroSuceso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class RegistroSucesoController extends Controller
{
    public function index()
    {
        $menu = $this->getMenuPorRol(session('idRol'));
        return view('registro_sucesos.consultas')
            ->with('menu_str', $menu);
    }

    public function get_registros(Request $request)
    {

        //print_r($request);
    
        if ($request->ajax()) {

            try {
                $id_usuario = Auth::user()->id;
              
                $tipo = "'" . $request->tipo . "'";
                $fecha_ini = "'" . $request->fecha_ini . " 00:00:00" . "'";
                $fecha_fin = "'" . $request->fecha_fin . " 23:59:00" . "'";

                $sql = "call SP_ListarRegistros(" . $tipo . "," . $fecha_ini . "," . $fecha_fin . ")";
                $query = DB::select($sql);
                $query = collect($query);

               return datatables()->of($query)->make(true);

            } catch (Exception $e) {

                return response()->json([
                   "status" => "error",
                   "mensaje" => $e->getMessage()
                ]);
            }
        }
        
    }

    public function get_historia_recibo(Request $request)
    {
    
        if ($request->ajax()) {

            try {
                $id_usuario = Auth::user()->id;
              
                $nro_recibo = "'" . $request->nro_recibo . "'";
               
                $sql = "call SP_ListarRegistros_HistoriaRecibo(" . $nro_recibo . ")";
                $query = DB::select($sql);
                $query = collect($query);

               return datatables()->of($query)->make(true);

            } catch (Exception $e) {

                return response()->json([
                   "status" => "error",
                   "mensaje" => $e->getMessage()
                ]);
            }
        }
        
    }
}
