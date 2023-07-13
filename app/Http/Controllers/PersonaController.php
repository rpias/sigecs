<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Persona;
use Carbon\Carbon;
use Exception;

class PersonaController extends Controller
{
    public function index()
    {
        $menu = $this->getMenuPorRol(session('idRol'));
        return view('personas.index')->with('menu_str',$menu);
    }

    public function store_persona(Request $request)
    {
        try{

            $id_usuario = Auth::user()->id;
            $fecha =  Carbon::now()->locale('sp_ES');
            $persona = new Persona;
            $persona->cedula = $request->cedula;
            $persona->primer_nombre = strtoupper($request->primer_nombre);
            $persona->segundo_nombre = strtoupper($request->segundo_nombre);
            $persona->primer_apellido = strtoupper($request->primer_apellido);
            $persona->segundo_apellido = strtoupper($request->segundo_apellido);
            $persona->sexo = $request->sexo;
            
            if( $request->fecha_nac != "")
                $persona->fecha_nac = $request->fecha_nac;
            else
                $persona->fecha_nac = "19000101";

            $persona->obs = $request->obs;
            $persona->activo = 1;
            $persona->id_usuario = $id_usuario;
            $persona->actuallizado = $fecha->isoFormat('YYYY-MM-DD HH:mm:ss');

            if($persona->save()){
                $id_persona_creada = $persona->id_persona;
            }

            if($id_persona_creada > 0)

                return response()->json([
                    "status"=> "ok",
                    "mensaje"=> "Persona Agregada Satisfactoriamente!"
                ]);

            else
                return response()->json([
                    "status"=> "ERROR",
                    "mensaje"=> "Los datos de la Persona se lograron ingresar"
                ]);
                    


        }catch (Exception $e) {
            DB::rollback();
            return response()->json([
                "status"=> "error",
                "mensaje"=> $e->getMessage()
            ]);
        }
    }

    public function update_persona(Request $request)
    {
        try{

            $id_usuario = Auth::user()->id;
            $fecha =  Carbon::now()->locale('es_UY');
            $persona = Persona::find($request->id_persona);
            $persona->cedula = $request->cedula;
            $persona->primer_nombre = strtoupper($request->primer_nombre);
            $persona->segundo_nombre = strtoupper($request->segundo_nombre);
            $persona->primer_apellido = strtoupper($request->primer_apellido);
            $persona->segundo_apellido = strtoupper($request->segundo_apellido);
            $persona->sexo = $request->sexo;
            $persona->fecha_nac = $request->fecha_nac;
            $persona->obs = $request->obs;
            $persona->activo = 1;
            $persona->id_usuario = $id_usuario;
            $persona->actuallizado = $fecha->isoFormat('YYYY-MM-DD HH:mm:ss');
            if($persona->save()){
                $id_persona_creada = $persona->id_persona;
            }

            return response()->json([
                "status"=> "ok",
                "mensaje"=> "Persona Modificada Satisfactoriamente!"
            ]);

        }catch (Exception $e) {
            DB::rollback();
            return response()->json([
                "status"=> "error",
                "mensaje"=> $e->getMessage()
            ]);
        }
    }

    public function remove_persona(Request $request)
    {
        try{
            $id_usuario = Auth::user()->id;
            $fecha =  Carbon::now()->locale('es_UY');
            $persona = Persona::find($request->id_persona);
            $persona->activo = 0;
            $persona->id_usuario = $id_usuario;
            $persona->actuallizado = $fecha->isoFormat('YYYY-MM-DD HH:mm:ss');
            if($persona->save()){
                $id_persona_creada = $persona->id_persona;
            }
            return response()->json([
                "status"=> "ok",
                "mensaje"=> "Persona Eliminada Satisfactoriamente!"
            ]);

        }catch (Exception $e) {
            DB::rollback();
            return response()->json([
                "status"=> "error",
                "mensaje"=> $e->getMessage()
            ]);
        }
    }

    public function get_PersonaPorCedula(Request $request)
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

    public function get_Personas()
    {
        try{
            $sql = "call SP_Personas_Activas()";
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
