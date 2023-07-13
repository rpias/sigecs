<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/* CONTROLADORES */
use App\Http\Controllers\UnidadController;

/* MODELOS */
use App\Edificio;


/* LIBRERIAS */
use Carbon\Carbon;

//session_start();

class FacturasController extends Controller
{

    public function index()
    {
        $edificios = Edificio::all();
        $menu = $this->getMenuPorRol(session('idRol'));
        return view('facturas.createfactura')->with(compact('edificios'))->with('menu_str', $menu);
    }

    public function formasPago()
    {
        $sql = "call SP_Formas_Pago()";
        $formasPago = DB::select($sql);

        return $formasPago;
    }


    public static function crearFacturasPorCondominio($id_condominio)
    {
        // id_condominio INT, 
        // f_emitido DATE,
        // f_venc DATE,
        // f_limite INT,
        // mes INT,
        // anio INT

        $sql = "call SP_Facturar_Unidades()";
        $query = DB::select($sql);
        $query = collect($query);

        // foreach ($datos as $dato) {
        //     $est = new estadistica;
        //     $est->id_usuario = $id_usuario;
        //     $est->anio = $dato->Año;
        //     $est->mes = $dato->MesNum;
        //     $est->importe = $dato->Total;
        //     $est->IP = $ip;
        // }


        // $sql = "call SP_AgregarFactura_Por_Unidad()";
        // $query = DB::select($sql);
        // $query = collect($query);
    }


    public function create(Request $request)
    {
        // $id_usuario = Auth::id();
        // $id = $request->select_unidad;
        // $deuda_recibida = $request->txt_deuda_actual;

        // DB::beginTransaction();

        // try{

        //     // Obtengo las facturas que incluyen el convenio
        //     $sql = "call SP_Facturas_ListarFacturasPendienes_PorIdUnidad(?)";
        //     $dt_facturas_por_unidad = DB::select($sql, array($id));
        //     $importe_total = 0;

        //     // verifico que el importe
        //     foreach ($dt_facturas_por_unidad as $factura){
        //         $importe_total = $importe_total + $factura->monto;
        //     }

        //     if($importe_total == $deuda_recibida){
        //         // puedo comenzar el convenio
        //         //echo "<br /> Comenzar a Guardar el Convenio ";

        //         // Guardo un Convenio
        //         // recibo la info que viajo
        //         $datos_convenio=array();
        //         $datos_convenio['id_unidad']=$request->select_unidad;
        //         $datos_convenio['fecha']=$request->txt_fecha;
        //         $datos_convenio['importe_adelanto']=$request->txt_entrega_cta;
        //         $datos_convenio['importe_total']=$request->txt_total_a_financiar;
        //         $datos_convenio['cantidad_cuotas']=$request->txt_cantidad_cuotas;
        //         $datos_convenio['importe_cuota']=$request->txt_importe_cuota;
        //         $datos_convenio['id_usuario']=$id_usuario;
        //         $convenio_insertado = DB::table('convenios')->insert($datos_convenio);

        //         if($convenio_insertado == true){

        //             // Obtengo el IDentificador del convenio creado
        //             $id_convenio_creado = DB::getPdo()->lastInsertId();
        //             $obs = "Convenio : " . $id_convenio_creado;
        //             // crear un recibo por cada factura que comprende el convenio

        //             foreach ($dt_facturas_por_unidad as $factura){

        //                 // Creo Recibo ==================================
        //                 $id_factura =  $factura->idfactura;
        //                 $monto = $factura->monto;

        //                 $forma_pago = 5;// Config::get('constant.FORMA_PAGO_CONVENIO');

        //                 // datos del recibo
        //                 $datos_recibo=array();
        //                 $datos_recibo['nro_recibo']=0;
        //                 $datos_recibo['id_factura']=$id_factura;
        //                 $datos_recibo['id_forma_pago']=$forma_pago;
        //                 $datos_recibo['serie_recibo']='';
        //                 $datos_recibo['importe']=$monto;
        //                 $datos_recibo['obs']=$obs;
        //                 $datos_recibo['id_usuario']=$id_usuario;
        //                 $recibo_insertado = DB::table('recibos')->insert($datos_recibo);

        //                 // ===============================================

        //                 // cambiar a pendiente = false, cada factura
        //                 $updates = DB::table('facturas')
        //                 ->where('id_factura', '=', $id_factura)
        //                 ->update([
        //                     'pendiente' => 0
        //                 ]);

        //             }

        //             // Ingreso las nuevas facturas correspondientes al convenio

        //             $fecha_emitido = $request->txt_fecha;
        //             $id_concepto = 2;
        //             $factura_pendiente = true;

        //             for($i=0;$i<$request->txt_cantidad_cuotas;$i++){

        //                 $datos_facturas_convenio=array();
        //                 $datos_facturas_convenio['id_unidad']=$request->select_unidad;
        //                 $datos_facturas_convenio['id_concepto']=$id_concepto;
        //                 $datos_facturas_convenio['fecha_emitido']=$fecha_emitido;
        //                 $datos_facturas_convenio['fecha_vencimiento']=$fecha_emitido;
        //                 $datos_facturas_convenio['fecha_limite']=$fecha_emitido;
        //                 $datos_facturas_convenio['importe']=$request->txt_importe_cuota;
        //                 $datos_facturas_convenio['pendiente']=$factura_pendiente;
        //                 $datos_facturas_convenio['obs']=$obs;
        //                 $datos_facturas_convenio['id_usuario']=$id_usuario;

        //                 $factura_convenio_insertada = DB::table('facturas')->insert($datos_facturas_convenio);
        //             }
        //         }
        //     }

        //    // DB::commit(); 
        //     return back()->with('exito','Convenio creado satisfactoriamente');

        // } catch (Exception $e) { 
        //     DB::rollback(); 
        //     return back()->with('error','ERROR al guardar regisro: ' .  $e->getMessage() );
        // } 


        // si tiene entrega se le suma el mes en curso que corresponde pagar 
        // y paga la primera cuota (acotar la entrega)

        // si no tiene entrega, se suma el hasta el mes en curso - 1 
        // y paga el mismo dia el mes en curso + la primera cuota del convenio

        // Cantidad de cuotas
        // Hasta 50.000 en 30 cuotas
        // de 51.000 a 100.000 60 cuotas
        // 101.000 en adelante 72 cuotas

        // Recargo
        // Solo si no tenia convenios previos

        // 1 - Cancelar todas las facturas que incluyen el Convenio
        // 2 - Crear todas las facturas que incluyen el convenio (1 por cada cuota)


    }
}
