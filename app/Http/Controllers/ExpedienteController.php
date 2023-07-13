<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Expediente;
use App\Edificio;



/* LIBRERIAS */
use Carbon\Carbon;

class ExpedienteController extends Controller
{

    public function expedientes_index()
    {
        $edificios = Edificio::all();
        $menu = $this->getMenuPorRol(session('idRol'));
        session(['eliminado' => null]);
        return view('cobranza.expedientes.create')
        ->with('edificios', $edificios)
        ->with('menu_str',$menu);
    }


    public function guardar_expediente(Request $request)
    {
        if($request->hd_eliminar == 1){

            try{
                $id_usuario = Auth::user()->id;
                $datos_expediente=array();
                $datos_expediente['habilitado']=0;
                $datos_expediente['id_usuario']=$id_usuario;

                DB::beginTransaction();
                DB::table('expedientes')
                    ->where('id_expediente', $request->hd_id_expediente)
                    ->update($datos_expediente);
                DB::commit();

                return back()->with('exito','Expediente Eliminado Satisfactoriamente');

            } catch (Exception $e) {
                DB::rollback();
                $error = 'ERROR al guardar registro: ' .  $e->getMessage();
                session(['error' => $error]);

            }

        }else{

               // VALIDAR
        $oExpedienteModel = new Expediente();

        $validatedData = $request->validate($oExpedienteModel->reglas, $oExpedienteModel->mensajes);

        if($request->hd_id_expediente){ // Modifico Expediente
            try{

                // Datos del Expediente
                $datos_expediente=array();
                $datos_expediente['id_unidad'] = $request->select_unidad;
                $datos_expediente['nro_expediente'] = $request->txt_nro_exp;
                $datos_expediente['fecha_ingreso_anv'] = $request->txt_fecha_anv;
                $datos_expediente['fecha_expediente'] = $request->txt_fecha_exp;
                $datos_expediente['fecha_deuda'] = $request->txt_fecha_deuda;
                $datos_expediente['importe_total_reclamado'] =  $request->txt_importe;
                // Agregado 07/10/2020
                $datos_expediente['id_estado'] =  $request->select_estado;
                $datos_expediente['fecha_cierre'] =  $request->txt_fecha_clausura;
                $datos_expediente['nro_convenio_resolucion'] =  $request->txt_nro_convenio;
                // --
                $datos_expediente['obs'] =  $request->txt_obs;
                $datos_expediente['id_usuario'] = Auth::user()->id;

                DB::beginTransaction();
                DB::table('expedientes')
                    ->where('id_expediente', $request->hd_id_expediente)
                    ->update($datos_expediente);
                DB::commit();

                //echo "MODIFIQUE UN RECIBO ";
                return back()->with('exito','Expediente Modificado satisfactoriamente');

            } catch (Exception $e) {
                DB::rollback();
                return back()->with('error','ERROR al Modificar registro de expediente: ' .  $e->getMessage() );
            }

        }else{ // Creo Recibo

            try{
                 // Datos del Expediente
                 $datos_expediente=array();
                 $datos_expediente['id_unidad'] = $request->select_unidad;
                 $datos_expediente['nro_expediente'] = $request->txt_nro_exp;
                 $datos_expediente['fecha_ingreso_anv'] = $request->txt_fecha_anv;
                 $datos_expediente['fecha_expediente'] = $request->txt_fecha_exp;
                 $datos_expediente['fecha_deuda'] = $request->txt_fecha_deuda;
                 $datos_expediente['importe_total_reclamado'] =  $request->txt_importe;
                 $datos_expediente['obs'] =  $request->txt_obs;
                 $datos_expediente['id_usuario'] = Auth::user()->id;

                 DB::beginTransaction();

                 $recibo_insertado = DB::table('expedientes')->insert($datos_expediente);

                 // Obtengo el IDentificador del registro creado
                 $id_expediente_creado = DB::getPdo()->lastInsertId();

                 DB::commit();

                 return back()->with('exito','Expediente Ingresado satisfactoriamente');


            } catch (Exception $e) {
                DB::rollback();
                return back()->with('error','ERROR al guardar registro de Expediente: ' .  $e->getMessage() );
            }

        }

        }

    }




}
