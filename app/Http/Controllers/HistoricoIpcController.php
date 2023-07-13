<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\HistoricoIpc;
use Carbon\Carbon;
use Exception;


class HistoricoIpcController extends Controller
{
  
    public function index()
    {
        $menu = $this->getMenuPorRol(session('idRol'));
        return view('mantenimiento.historico_ipc.index')->with('menu_str',$menu);
    }

    public function store_indice(Request $request)
    {
        try{

            $id_usuario = Auth::user()->id;
            $fecha =  Carbon::now()->locale('sp_ES');
            $indice = new HistoricoIpc;
            $indice->mes = $request->mes;
            $indice->anio = $request->anio;
            $indice->indice = $request->v_indice;
            $indice->valor_mensual = $request->v_mensual;
            $indice->acumulado_anio = $request->v_anual;
            $indice->acumulado_12_meses = $request->v_12m;

            if($indice->save()){
                $id_creado = $indice->id;
            }

            if($id_creado > 0)

                return response()->json([
                    "status"=> "ok",
                    "mensaje"=> "Índice Agregado Satisfactoriamente!"
                ]);

            else
                return response()->json([
                    "status"=> "ERROR",
                    "mensaje"=> "Los datos del Índice NO se lograron ingresar"
                ]);
                    


        }catch (Exception $e) {
            DB::rollback();
            return response()->json([
                "status"=> "error",
                "mensaje"=> $e->getMessage()
            ]);
        }
    }

    public function update_indice(Request $request)
    {
        try{

            $id_usuario = Auth::user()->id;
            $fecha =  Carbon::now()->locale('es_UY');
           
            $indice = HistoricoIpc::find($request->id_indice);
            $indice->mes = $request->mes;
            $indice->anio = $request->anio;
            $indice->indice = $request->v_indice;
            $indice->valor_mensual = $request->v_mensual;
            $indice->acumulado_anio = $request->v_anual;
            $indice->acumulado_12_meses = $request->v_12m;


            if($indice->update()){
                $id_creado = $indice->id;
            }

            return response()->json([
                "status"=> "ok",
                "mensaje"=> "Índice Modificado Satisfactoriamente!"
            ]);

        }catch (Exception $e) {
            DB::rollback();
            return response()->json([
                "status"=> "error",
                "mensaje"=> $e->getMessage()
            ]);
        }
    }

    public function remove_indice(Request $request)
    {
        try{
            $id_usuario = Auth::user()->id;
            $fecha =  Carbon::now()->locale('es_UY');
            $indice = HistoricoIpc::find($request->id_indice);

            
            if($indice->delete()){
                $id_creado = $indice->id;
            }
            return response()->json([
                "status"=> "ok",
                "mensaje"=> "PeÍndice Eliminado Satisfactoriamente!"
            ]);

        }catch (Exception $e) {
            DB::rollback();
            return response()->json([
                "status"=> "error",
                "mensaje"=> $e->getMessage()
            ]);
        }
    }

    public function get_IndicePorId(Request $request)
    {
        if($request->ajax()){
            try{
                $persona = Persona::where('activo', 1)
                ->where('cedula', $request->cedula)
                ->get();
                return response()->json([
                    "datos_persona"=> $persona,
                    "cantidad_encotrada"=> count($persona)
                ]);

            } catch (Exception $e) {
                DB::rollback();
                return response()->json([
                    "status"=> "error",
                    "mensaje"=> $e->getMessage()
                ]);
            }
        }
    }

    public function get_indices()
    {
        try{
            $sql = "call SP_Historico_IPC()";
            return response()->json(DB::select($sql));
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                "status"=> "error",
                "mensaje"=> $e->getMessage()
            ]);
        }
    }
}
