<?php

namespace App\Http\Controllers;

use App\MovimientoContable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\RegistroSuceso;
use App\Rubros;
use Datatables;
use PDF;

/* LIBRERIAS */
use Carbon\Carbon;

session_start();

class MovimientoContableController extends Controller
{
    
    public function index()
    {
        $menu = $this->getMenuPorRol(session('idRol'));
        $rubros = Rubros::where('habilitado', 1)
            ->where('es_padre', 1)
            ->get();

        return view('contable.movimientos')
            ->with('menu_str', $menu)
            ->with('rubros', $rubros);
    }

    public function subRubrosPorRubro($id)
    {
        //$sql = "call SP_Unidades_PorTorre(?)";
        return response()->json(Rubros::where('habilitado', 1)
            ->where('es_padre', 0)
            ->where('id_padre', $id)
            ->get());
    }

    public function guardar_movimiento(Request $request)
    {

        // Eliminar Movimiento
        if ($request->hd_eliminar == 1) {

            try {
                $id_usuario = Auth::user()->id;

                if ($request->hd_id_movimiento > 0) {

                    $fecha =  Carbon::now()->locale('es_UY');
                    $datos_recibo = array();
                    $datos_recibo['habilitado'] = 0;
                    $datos_recibo['id_usuario_mod'] = $id_usuario;
                    $datos_recibo['modificado'] = $fecha;

                    DB::beginTransaction();
                    DB::table('contable_movimientos')
                        ->where('id_movimiento', $request->hd_id_movimiento)
                        ->update($datos_recibo);
                    DB::commit();

                    $registro = new RegistroSuceso;
                    $registro->id_usuario = $id_usuario;
                    $registro->SP = "ELIMINAR MOVIMIENTO";
                    $registro->parametros = json_encode($datos_recibo);
                    $registro->IP = $this->getUserIpAddr();
                    $registro->save();

                    return back()->with('exito', 'Movimiento Eliminado Satisfactoriamente');
                } else {

                    $error = 'ERROR al guardar registro: el Id_movimiento esta vacío';
                    session(['error' => $error]);
                }
            } catch (Exception $e) {

                DB::rollback();
                $error = 'ERROR al guardar registro: ' .  $e->getMessage();
                session(['error' => $error]);
            }
        } else {

            // VALIDAR 
            $oMovimiento = new MovimientoContable();

            $validatedData = $request->validate($oMovimiento->reglas, $oMovimiento->mensajes);

            if ($request->hd_id_recibo) { // Modifico Recibo
                try {
                    $id_usuario = Auth::user()->id;
                    $fecha =  Carbon::now()->locale('es_UY');


                    $id_sub_rubro = $request->select_sub_rubro;
                    $fecha_mov = $request->txt_fecha_mov;
                    $detalle = $request->txt_detalle;
                    $fecha_doc = $request->txt_fecha_doc;
                    $nro_doc = $request->txt_nro_doc;
                    $importe = $request->txt_importe;
                    $obs = $request->txt_obs;

                    // datos del recibo
                    $datos = array();
                    $datos['id_rubro'] = $id_sub_rubro;
                    $datos['fecha_mov'] = $fecha_mov;
                    $datos['fecha_doc'] = $fecha_doc;
                    $datos['nro_doc'] = $nro_doc;
                    $datos['detalle'] = $detalle;
                    $datos['importe'] = $importe;
                    $datos['obs'] = $obs;
                    $datos['modificado'] = $fecha;
                    $datos['id_usuario_mod'] = $id_usuario;

                    DB::beginTransaction();
                    DB::table('contable_movimientos')
                        ->where('id_movimiento', $request->hd_id_movimiento)
                        ->update($datos);
                    DB::commit();

                    $registro = new RegistroSuceso;
                    $registro->id_usuario = $id_usuario;
                    $registro->SP = "MODIFICAR MOVIMIENTO";
                    $registro->parametros = json_encode($datos);
                    $registro->IP = $this->getUserIpAddr();
                    $registro->save();

                    //echo "MODIFIQUE UN RECIBO ";
                    return back()->with('exito', 'Movimiento Modificado Satisfactoriamente');

                } catch (Exception $e) {

                    DB::rollback();
                    return back()->with('error', 'ERROR al guardar registro: ' .  $e->getMessage());

                }

            } else { // Creo Recibo

                try {

                    $id_usuario = Auth::user()->id;
                    $fecha =  Carbon::now()->locale('es_UY');

                    $id_sub_rubro = $request->select_sub_rubro;
                    $fecha_mov = $request->txt_fecha_mov;
                    $detalle = $request->txt_detalle;
                    $fecha_doc = $request->txt_fecha_doc;
                    $nro_doc = $request->txt_nro_doc;
                    $importe = $request->txt_importe;
                    $obs = $request->txt_obs;

                    // datos del recibo
                    $datos = array();
                    $datos['id_rubro'] = $id_sub_rubro;
                    $datos['fecha_mov'] = $fecha_mov;
                    $datos['fecha_doc'] = $fecha_doc;
                    $datos['nro_doc'] = $nro_doc;
                    $datos['detalle'] = $detalle;
                    $datos['importe'] = $importe;
                    $datos['obs'] = $obs;
                    $datos['modificado'] = $fecha;
                    $datos['id_usuario_mod'] = $id_usuario;

                    DB::beginTransaction();
                    $movimiento_insertado = DB::table('contable_movimientos')->insert($datos);
                    // Obtengo el IDentificador del registro creado
                    $id_movimiento_creado = DB::getPdo()->lastInsertId();

                    DB::commit();

                    $registro = new RegistroSuceso;
                    $registro->id_usuario = $id_usuario;
                    $registro->SP = "CREAR MOVIMIENTO";
                    $registro->parametros = json_encode($datos);
                    $registro->IP = $this->getUserIpAddr();
                    $registro->save();
                    
                    return back()->with('exito', 'Movimiento Ingresado satisfactoriamente');

                } catch (Exception $e) {

                    DB::rollback();
                    return back()->with('error', 'ERROR al guardar registro: ' .  $e->getMessage());
                }
            }
        }
    }

}
