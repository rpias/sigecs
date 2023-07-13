<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidOrderException;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cobranza;
use App\estadistica;
use App\Edificio;
use App\ConceptoFactura;
use App\FormaPago;
use App\RegistroSuceso;
use Datatables;
use PDF;

/* LIBRERIAS */
use Carbon\Carbon;
use PhpParser\Node\Stmt\TryCatch;

class CobranzaController extends Controller
{

    // index de la vista create.blade.php
    public function ingreso_recibos()
    {
        session(['eliminado' => null]);
        $edificios = Edificio::all();
        $conceptos = ConceptoFactura::where('se_muestra', 1)->get();
        $fpagos = FormaPago::all();
        $menu = $this->getMenuPorRol(session('idRol'));

        return view('cobranza.recibos.create')
            ->with('edificios', $edificios)
            ->with('fpagos', $fpagos)
            ->with('menu_str', $menu)
            ->with('conceptos', $conceptos);
    }

    public static function ultimoPagoPorUnidad()
    {
        $sql = "call SP_ListarUltimoPagoPorUnidad()";
        $query = DB::select($sql);
        $query = collect($query);
        return datatables()->of($query)->make(true);
    }

    public function store_recibo()
    {
        $request = json_decode(json_encode($_POST));
        $id_usuario = Auth::user()->id;
        // $fecha =  Carbon::now()->format('Y-m-d H:i:s');
        $fecha =  Carbon::now()->locale('es_UY');

        // Eliminar Recibo
        if ($request->hd_eliminar == 1) {

            try {

                $recibo = Cobranza::find($request->hd_id_recibo);
                $nro_recibo = $recibo->nro_recibo;

                $datos_recibo = array();
                $datos_recibo['habilitado'] = 0;
                $datos_recibo['id_usuario_mod'] = $id_usuario;
                $datos_recibo['nro_recibo'] = $nro_recibo;
                $datos_recibo['modificado'] = $fecha;

                DB::beginTransaction();
                DB::table('recibos')
                    ->where('id_recibo', $request->hd_id_recibo)
                    ->update($datos_recibo);
                DB::commit();

                $this->guardarLog($id_usuario, "ELIMINAR RECIBO", json_encode($datos_recibo));

                echo "Recibo Eliminado Satisfactoriamente";
            } catch (Exception $e) {
                DB::rollback();
                $error = 'ERROR al guardar registro: ' .  $e->getMessage();
                session(['error' => $error]);
                echo $error;
            }
        } else {

            if ($request->hd_id_recibo) { // Modifico Recibo
                try {
                    $id_unidad = $request->select_unidad;
                    $nro_recibo = $request->txt_nro_recibo;
                    $id_concepto = $request->select_concepto;
                    $id_fpago = $request->select_forma_pago;
                    $fecha_recibo = $request->txt_fecha;
                    $mes = $request->txt_mes_cuota;
                    $anio = $request->select_anio;

                    $importe_gc = $request->txt_importe;
                    $importe_interes = $request->txt_interes;
                    $importe_total = $request->txt_total;

                    $serie = $request->select_serie;
                    $obs = $request->txt_obs;
                    $titular = $request->txt_titular;

                    // datos del recibo
                    $datos_recibo = array();
                    $datos_recibo['id_unidad'] = $id_unidad;
                    $datos_recibo['nro_recibo'] = $nro_recibo;
                    $datos_recibo['id_factura'] = 0;
                    $datos_recibo['id_forma_pago'] = $id_fpago;
                    $datos_recibo['id_concepto_factura'] = $id_concepto;
                    $datos_recibo['serie_recibo'] = $serie;

                    $datos_recibo['precio_gc'] = $importe_gc;
                    $datos_recibo['recargo'] = $importe_interes;
                    $datos_recibo['importe'] = $importe_total;

                    $datos_recibo['fecha'] = $fecha_recibo;
                    $datos_recibo['mes'] = $mes;
                    $datos_recibo['anio'] = $anio;
                    $datos_recibo['obs'] = $obs;
                    $datos_recibo['titular'] = $titular;
                    $datos_recibo['id_usuario_mod'] = $id_usuario;
                    $datos_recibo['modificado'] = $fecha;

                    DB::beginTransaction();
                    DB::table('recibos')
                        ->where('id_recibo', $request->hd_id_recibo)
                        ->update($datos_recibo);
                    DB::commit();

                    $this->guardarLog($id_usuario, "MODIFICAR RECIBO", json_encode($datos_recibo));

                    echo 'Recibo Modificado satisfactoriamente';
                } catch (Exception $e) {
                    DB::rollback();
                    $error = 'ERROR al guardar registro: ' .  $e->getMessage();
                    session(['error' => $error]);
                    echo $error;
                }
            } else { // Creo Recibo

                $datos_recibo = array();
                try {

                    $id_usuario = Auth::user()->id;
                    $id_unidad = $request->select_unidad;

           
                    
                    $id_concepto = $request->select_concepto;
                    $id_fpago = $request->select_forma_pago;
                    $fecha_recibo = $request->txt_fecha;
                    $mes = $request->txt_mes_cuota;
                    $anio = $request->select_anio;

                    $importe_gc = $request->txt_importe;
                    $importe_interes = $request->txt_interes;
                    $importe_total = $request->txt_total;

                    $serie = $request->select_serie;
                    $obs = $request->txt_obs;
                    $titular = $request->txt_titular;


                    // datos del recibo

                    // ========================================
                    // crear numero de recibo segun serie
                    // para que al crear recibo no se pisen 
                    // si existen dos peticiones paralelas
                    // ========================================
                    $nro_recibo = 0;
                    $serie = $request->select_serie;
                    if($serie == "B"){
                       
                    $sql = "call SP_Numero_Recibo_Por_Serie_Crear_Recibo(?)";
                    $obj = DB::select($sql, array($serie));
                    $nro_recibo = $obj[0]->numero;

                }else{
                        $nro_recibo = $request->txt_nro_recibo; // Si falla, dejar solo esto
                    }
                   // ========================================
                   // ========================================
                  
                    $datos_recibo['id_unidad'] = $id_unidad;
                    $datos_recibo['nro_recibo'] = $nro_recibo;
                    $datos_recibo['id_factura'] = 0;
                    $datos_recibo['id_forma_pago'] = $id_fpago;
                    $datos_recibo['id_concepto_factura'] = $id_concepto;
                    $datos_recibo['serie_recibo'] = $serie;

                    $datos_recibo['precio_gc'] = $importe_gc;
                    $datos_recibo['recargo'] = $importe_interes;
                    $datos_recibo['importe'] = $importe_total;

                    $datos_recibo['fecha'] = $fecha_recibo;
                    $datos_recibo['mes'] = $mes;
                    $datos_recibo['anio'] = $anio;
                    $datos_recibo['obs'] = $obs;
                    $datos_recibo['titular'] = $titular;
                    $datos_recibo['id_usuario'] = $id_usuario;

                    DB::beginTransaction();

                    $recibo_insertado = DB::table('recibos')->insert($datos_recibo);
                    // Obtengo el IDentificador del registro creado
                    $id_recibo_creado = DB::getPdo()->lastInsertId();

                    DB::commit();

                    $this->guardarLog($id_usuario, "AGREGAR RECIBO", json_encode($datos_recibo));
                    
                    $arr_return = array(
                        'mensaje' => "Recibo Ingresado satisfactoriamente",
                        'id_recibo' => $id_recibo_creado,
                    );

                    return response()->json($arr_return);

                } catch (\Exception $e) {

                    DB::rollback();

                    $arr_return = array(
                        'mensaje' => "Error :: " .  $e->getMessage(),
                        'id_recibo' => 0,
                    );
                    
                    return response()->json($arr_return);
                    //return back()->with('error', 'ERROR al guardar registro: ' .  $e->getMessage());
                }
            }
        }
    }

    //Funcion que genera un pdf de los pagos de las unidades mediante un id de torre
    public function pdf_pagos()
    {
        $torre = (int)$_GET['torre']; //Obtengo el id de la torre
        $morosos = null; //Instancio la variable para almacenar el ultimo pago de cada unidad
        $fecha_Actual = date("Ymd"); //Obtengo la fecha actual
        if ($torre < 1) //Esto es para dejar por defecto la torre 1 en caso de que no se seleccione ninguna
        {
            $torre = 1;
        }
        $sql = "call SP_Atrasados_Por_Torre_Orden_Unidad(?,?)"; //Consulta para obtener los pagos atrasados de las unidades de la torre
        $morosos = DB::select($sql, array($torre, $fecha_Actual)); //Ejecuto la consulta
        if ($morosos != null) //Si la consulta devuelve algo
        {
            try {
                $fecha_Actual = date("d/m/Y");
                $mes_Actual = (int)date("m");
                $anio_Actual = (int)date("Y");
                $data = [
                    'morosos' => $morosos,
                    'fecha_Actual' => $fecha_Actual,
                    'mes_Actual' => $mes_Actual,
                    'anio_Actual' => $anio_Actual
                ];

                $pdf = PDF::loadView('cobranza.pdf_pagos', $data);
                return $pdf->stream();
            } catch (\Exception $e) //TODO: almacenar Exception en un log
            {
                return back()->with('error', 'ERROR al generar el PDF: ');
            }
        }
        return back()->with('error', 'No hay morosos para la torre seleccionada');
    }

    public function index()
    {
        $menu = $this->getMenuPorRol($_SESSION['idRol']);

        return view('cobranza.index')->with('menu_str', $menu);
    }

    public function index_estadistica()
    {
        $menu = $this->getMenuPorRol(session('idRol'));
        return view('cobranza.estadistica')->with('menu_str', $menu);
    }

    public function datos_estadistica()
    {
        $sql = "call SP_Datos_Estadistica_Cobranza()";
        $datos = DB::select($sql, array());
        $id_usuario = Auth::user()->id;
        $ip = $this->getUserIpAddr();

        foreach ($datos as $dato) {
            $est = new estadistica;
            $est->id_usuario = $id_usuario;
            $est->anio = $dato->Año;
            $est->mes = $dato->MesNum;
            $est->importe = $dato->Total;
            $est->IP = $ip;
            $est->save();
        }

        return  response()->json(DB::select($sql, array()));;
    }

    public function consulta_recibos_index()
    {
        $menu = $this->getMenuPorRol(session('idRol'));
        return view('cobranza.recibos.consulta')->with('menu_str', $menu);
    }

    public function index_morosidad()
    {
        session(['exito' => null]);
        $edificios = Edificio::all();
        $total = 0;
        $dias = "";
        $fecha_limite = null;
        $dt_morosidad = null;
        $menu = $this->getMenuPorRol(session('idRol'));
        return view('cobranza.morosidad')
            ->with('edificios', $edificios)
            ->with('dt_morosos', $dt_morosidad)
            ->with('morosidad', $total)
            ->with('dias', $dias)
            ->with('menu_str', $menu)
            ->with('fecha_limite', $fecha_limite);
    }

    public function consuta_recibos(Request $request)
    {
        if ($request['txt_fecha_ini'] && $request['txt_fecha_fin']) {
            $fecha_ini = $request['txt_fecha_ini'];
            $fecha_fin = $request['txt_fecha_fin'];
            $dt_recibos = null;
            $sql = "";
            $registros = 0;

            if (isset($request['chk_anulados']) && $request['chk_anulados'] == "1")
                $sql = "call SP_Recibos_Por_Fecha_Con_Anulados(?,?)";
            else
                $sql = "call SP_Recibos_Por_Fecha(?,?)";

            $dt_recibos = DB::select($sql, array($fecha_ini, $fecha_fin));

            if ($dt_recibos != null)
                $registros = count($dt_recibos);

            $menu = $this->getMenuPorRol(session('idRol'));
            return view('cobranza.recibos.consulta')
                ->with('registros', $registros)
                ->with('menu_str', $menu)
                ->with('dt_recibos', $dt_recibos);
        }
    }

    public function morosidad(Request $request)
    {
        $torre = $request['select_edificio'];
        $dias =  $request['select_dias'];
        $fecha_Actual = date("Ymd");
        $fecha_Limite = strtotime('-' . $dias . 'day', strtotime($fecha_Actual));
        $fecha_Limite_Formateada = date('d/m/Y', $fecha_Limite);
        $fecha_Limite = date('Ymd', $fecha_Limite);
        $dt_morosidad = null;

        if ($torre < 1) {
            $sql = "call SP_Atrasados_Por_Fecha(?)";
            $dt_morosidad = DB::select($sql, array($fecha_Limite));
            $sql_unidades = 'SELECT * FROM unidades';
            $dt_unidades_por_torre = DB::select($sql_unidades);
            $total_unidades = count($dt_unidades_por_torre);
        } else {
            $sql = "call SP_Atrasados_Por_Torre(?,?)";
            $dt_morosidad = DB::select($sql, array($torre, $fecha_Limite));
            $sql_unidades = "call SP_Unidades_PorTorre(?)";
            $dt_unidades_por_torre = DB::select($sql_unidades, array($torre));
            $total_unidades = count($dt_unidades_por_torre);
        }

        $cantidad_morosos = count($dt_morosidad);
        $sub_total = ($cantidad_morosos * 100);
        $total = ($sub_total / $total_unidades);
        $total = number_format($total, 2);
        $edificios = Edificio::all();
        $menu = $this->getMenuPorRol(session('idRol'));

        return view('cobranza.morosidad')
            ->with('edificios', $edificios)
            ->with('dt_morosos', $dt_morosidad)
            ->with('morosidad', $total)
            ->with('dias', $dias)
            ->with('menu_str', $menu)
            ->with('fecha_limite', $fecha_Limite_Formateada);
    }

    public static function ultimoPagoPorCondominio($id)
    {
        $sql = "call SP_Recibos_Por_Unidad(?)";
        $query = DB::select($sql, array($id));
        $query = collect($query);
        return DataTables::of($query)->make(true);
    }

    public static function getNumeroReciboSerie($serie)
    {
        $sql = "call SP_Numero_Recibo_Por_Serie(?,?)";
        return response()->json(DB::select($sql, array($serie, 0)));
    }

    public function precioPorUnidad($id)
    {
        $sql = "call SP_Importe_Por_Unidad(?)";
        return response()->json(DB::select($sql, array($id)));
    }

    public function precioPorUnidadMesAnio($id_unidad, $mes, $anio)
    {
        $errores = [];
        try {

            $mes_sin_cero = $mes;
            if ($mes < 10) {
                $mes = "0" . $mes;
            }

            $fecha_recibo = $anio . $mes . "01";
            // trer monto del gasto comun del mes y anio recibido
            $sql = "call SP_Importe_Por_Unidad_Fecha(?,?)";
            $valor_gc = DB::select($sql, array($id_unidad, $fecha_recibo));

            // == Buscar valor IPC por Fecha de Recibo ==============================
            // ======================================================================

            // sumar un mes al mes del recibo 
            //sumo 1 mes

            $fecha_para_calculo_de_ipc = date("d-m-Y", strtotime($fecha_recibo . "+ 1 month"));

            $errores[] = ["fecha_para_calculo_de_ipc" => $fecha_para_calculo_de_ipc];

            //obtengo el mes

            $mes_para_calculo_de_ipc = Carbon::parse($fecha_para_calculo_de_ipc)->format('n');

            $errores[] = ["mes_para_calculo_de_ipc_antes_del_cambio" => $mes_para_calculo_de_ipc];
            $errores[] = ["mes recibido por parametro" => $mes_sin_cero];

            if ($mes_para_calculo_de_ipc > $mes_sin_cero) {

                $fecha_para_calculo_de_ipc = date("d-m-Y", strtotime($fecha_recibo));
                $mes_para_calculo_de_ipc = Carbon::parse($fecha_para_calculo_de_ipc)->format('n');
            }

            $errores[] = ["mes_para_calculo_de_ipc_despues_del_cambio" => $mes_para_calculo_de_ipc];

            //obtengo el año

            $anio_para_calculo_de_ipc = Carbon::parse($fecha_para_calculo_de_ipc)->format('Y');
            $errores[] = ["anio_para_calculo_de_ipc" => $anio_para_calculo_de_ipc];

            //  $mes_para_calculo_de_ipc = $mes_sin_cero;


            $sql = "call SP_Valor_IPC_Fecha(?,?)"; // trer monto de el gasto comun del mes y anio recibido
            $valor_ipc_recibo = DB::select($sql, array($mes_para_calculo_de_ipc, $anio_para_calculo_de_ipc));

            // si el valor es superior al ultimo mes ipd guardado 
            // deberia pasar el ultimo mes que exista en historico IPC


            $errores[] = ["valor_ipc_recibo" => $valor_ipc_recibo];

            // ======================================================================
            // ======================================================================

            $sql = "call SP_Valor_IPC_Fecha(?,?)"; // trer monto de el gasto comun del mes y anio recibido
            $valor_ipc_hoy = DB::select($sql, array(0, 0));
            $errores[] = ["valor_ipc_hoy" => $valor_ipc_hoy];

            // Si IPC $valor_ipc_hoy == $valor_ipc_recibo
            // busco el valor del mes anterior al recibo


            // if ($valor_ipc_hoy[0]->valor ==  $valor_ipc_recibo[0]->valor) {

            //     $sql = "call SP_Valor_IPC_Fecha(?,?)"; // trer monto de el gasto comun del mes y anio recibido
            //     $mes_calculo = 0;
            //     $anio_calculo = 0;
            //     if (($mes_sin_cero - 1) == 0) {
            //         $mes_calculo = 12;
            //         $anio_calculo = $anio - 1;
            //     } else {
            //         $mes_calculo = ($mes_sin_cero - 1);
            //     }

            //     $valor_ipc_recibo = DB::select($sql, array($mes_calculo, $anio_calculo));
            //     $errores[] = ["valor_ipc_recibo cuando son iguales los IPCs" => $valor_ipc_recibo];
            // }

            // =============================================
            // 1:: Promedio IPC hoy/recibo
            // =============================================

            $val_ipc_hoy = number_format($valor_ipc_hoy[0]->valor, 2, '.', '');
            $val_ipc_recibo = number_format($valor_ipc_recibo[0]->valor, 2, '.', '');
            $promedio_ipc = number_format((($val_ipc_hoy / $val_ipc_recibo) - 1), 3, '.', ''); // 0.035

            $errores[] = ["promedio_ipc" => $promedio_ipc];

            // =============================================
            // 2:: Importe = Preio GC * Promedio
            // =============================================

            // 3290                 *           0.035

            $gc_ipc = $valor_gc[0]->valor * $promedio_ipc;

            $errores[] = ["gc_ipc" => $gc_ipc];

            // =============================================

            // =============================================
            // 3:: Preio GC + Promedio
            // =============================================

            $importe =  $gc_ipc + $valor_gc[0]->valor;

            $errores[] = ["importe" => $importe];

            // =============================================

            // =============================================
            // 4:: 1% de (PC GC) + (GC * (P-1))
            // =============================================

            $porcentaje = ($importe * 0.01);

            $errores[] = ["porcentaje" => $porcentaje];

            // =============================================

            // =============================================
            // 5:: (PC GC) + (GC * (P-1)) + 1%
            // =============================================

            $total = $gc_ipc + $porcentaje;

            $errores[] = ["total" => $total];

            // =============================================

            // redondear a sin decimales
            $arr_total = array(

                'valor' => round(strval(number_format(($valor_gc[0]->valor + $total), 2, '.', ''))),
                'valor_porcentaje' => strval(number_format($porcentaje, 2, '.', '')),
                'fecha_para_calculo_ipc' => $fecha_para_calculo_de_ipc,
                'mes_para_calculo_ipc' => $mes_para_calculo_de_ipc,
                'anio_para_calculo_ipc' => $anio_para_calculo_de_ipc,
                'valor_ipc_del_recibo' => strval(number_format($valor_ipc_recibo[0]->valor, 2, '.', '')),
                'valor_ipc_actual' => strval(number_format($valor_ipc_hoy[0]->valor, 2, '.', '')),
                'valor_ipc_promedio' => strval(number_format($promedio_ipc, 3, '.', '')),
                'gc_ipc' => strval(number_format($gc_ipc, 3, '.', '')),
                'valor_gc_mes_recibo' => strval(number_format($valor_gc[0]->valor, 2, '.', '')),
            );

            return response()->json($arr_total);
        } catch (\Throwable $th) {
            return response()->json($errores);
        }
    }

    public function nombreTitularPorUnidad($id)
    {
        $sql = "call SP_NombreTitular_Por_Unidad(?)";
        return response()->json(DB::select($sql, array($id)));
    }

    /*Funcion que genera el pdf de un recibo mediante un idRecibo*/
    public function pdf_recibo()
    {
        $id_Recibo = $_GET['idRecibo']; //Obtengo el id del recibo
        $sql = "call SP_Recibo_Por_Id(?)"; //Consulta para obtener el recibo
        $recibo = DB::select($sql, array($id_Recibo)); //Ejecuto la consulta
        if ($recibo != null) {
            try {
                $dia_Actual = (int)date("d"); //Obtengo el dia actual
                $mes_Actual = (int)date("m"); //Obtengo el mes actual
                $anio_Actual = (int)date("Y"); //Obtengo el año actual
                $texto_Monto = $this->numerosATexto($recibo[0]->importe, "PESOS"); //Convierto el monto a texto
                $data = [
                    'recibo' => $recibo,
                    'texto_Monto' => $texto_Monto,
                    'dia_Actual' => $dia_Actual,
                    'mes_Actual' => $mes_Actual,
                    'anio_Actual' => $anio_Actual
                ];

                $pdf = PDF::loadView('cobranza.recibos.pdf_recibo', $data); //Cargo la vista
                //return $pdf->download('Recibo_' . $recibo[0]->edificio . "_" . $recibo[0]->unidad . "_" . $recibo[0]->serie_recibo . $recibo[0]->nro_recibo . '.pdf'); //Descarga el pdf

                return $pdf->stream();
            } catch (Exception $e) //TODO: Guardar la exception en un log
            {
                return redirect()->back()->with('error', 'No se pudo generar el PDF del recibo');
            }
        }
        return back()->with('error', 'No se encontró el recibo'); //Si no se encuentra el recibo
    }

    public function create()
    {
        $edificios = Edificio::all();
        $menu = $this->getMenuPorRol(session('idRol'));
        return view('cobranza.create')->with(compact('edificios'))->with('menu_str', $menu);
    }
}// Fin Clase