<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Edificio;
use App\Unidad;
use App\Persona;
use App\Titulares;
use App\Unidad_Titular;
use App\RegistroSuceso;
use Carbon\Carbon;
use Exception;
use PDF;

class UnidadController extends Controller
{
    public function index()
    {
        $edificios = Edificio::all();
        $menu = $this->getMenuPorRol(session('idRol'));
        return view('unidades.index')->with(compact('edificios'))->with('menu_str', $menu);
    }

    // <editor-fold defaultstate="collapsed" desc="RECIBOS - SALDO INICIAL">

    public function saldoInicial($id)
    {
        $unidad = Unidad::where('id_unidad', $id)->get();
        return response()->json($unidad);
    }

    public function guardarSaldoInicial(Request $request)
    {
        if ($request->ajax()) {
            try {
                $id_usuario = Auth::user()->id;

                $datos_saldo_ini = array();
                $datos_saldo_ini['saldo_inicial'] = $request->importe;
                $datos_saldo_ini['saldo_inicial_interes'] = $request->interes;
                DB::beginTransaction();
                DB::table('unidades')
                    ->where('id_unidad', $request->id_unidad)
                    ->update($datos_saldo_ini);
                DB::commit();

                $registro = new RegistroSuceso;
                $registro->id_usuario = $id_usuario;
                $registro->SP = "MODIFICAR SALDO INICIAL";
                $registro->parametros = json_encode($datos_saldo_ini);
                $registro->IP = $this->getUserIpAddr();
                $registro->save();

                return response()->json([
                    "id_unidad" => $request->id_unidad,
                    "status" => "ok",
                    "mensaje" => "El Saldo Inicial se Actualizó Correctamente"
                ]);
            } catch (Exception $e) {
                DB::rollback();
                return response()->json([
                    "status" => "error",
                    "mensaje" => $e->getMessage()
                ]);
            }
        }
    }

    // </editor-fold>

    public function unidadesPorEdificio($id)
    {
        $sql = "call SP_Unidades_PorTorre(?)";
        return response()->json(DB::select($sql, array($id)));
    }

    public static function facturasPorUnidad($id)
    {
        $sql = "call SP_Facturas_ListarFacturasPendienes_PorIdUnidad(?)";
        $query = DB::select($sql, array($id));
        $query = collect($query);
        return datatables()->of($query)->make(true);
    }

    // <editor-fold defaultstate="collapsed" desc="RECIBOS - UNIDAD">

    public static function recibosPorUnidad($id)
    {
        $sql = "call SP_Recibos_Por_Unidad(?)";
        $query = DB::select($sql, array($id));
        $query = collect($query);
        return datatables()->of($query)->make(true);
    }

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="MOVIMIENTOS REGISTRALES - UNIDAD">

    public function reportePDF_UnidadesEscrituradas()
    {
        set_time_limit(600);
        ini_set('memory_limit', '1024M');
        $sql = "call SP_ListarUnidadesEscrituradas()";
        $unidades = DB::select($sql);
        $cantidad_registros = count($unidades);
        $pdf = PDF::loadView('reportes.listadoUnidadesEscrituradas', [
            'unidades' => $unidades,
            'cantidad_registros' => $cantidad_registros
        ]);
        return $pdf->download('listado_unidades_escrituradas.pdf');
    }



    public function store_movimiento_registral(Request $request)
    {
        if ($request->ajax()) {

            try {
                $id_usuario = Auth::user()->id;
                $datos_mov_reg = array();
                $datos_mov_reg['id_tipo_mov_registral'] = $request->id_tipo_mov_registral;
                $datos_mov_reg['fecha'] = $request->fecha_mov_registral;
                $datos_mov_reg['obs'] = $request->obs;
                $datos_mov_reg['id_usuario'] = $id_usuario;

                DB::beginTransaction();
                DB::table('movimientos_registrales')->insert($datos_mov_reg);
                $id_mov_reg_creado = DB::getPdo()->lastInsertId();
                DB::commit();

                $datos_unidad_mov_reg = array();
                $datos_unidad_mov_reg['id_unidad'] = $request->id_unidad;
                $datos_unidad_mov_reg['id_movimiento_registral'] = $id_mov_reg_creado;
                $datos_unidad_mov_reg['id_usuario'] = $id_usuario;

                DB::beginTransaction();
                DB::table('unidades_mov_registrales')->insert($datos_unidad_mov_reg);
                DB::commit();

                return response()->json([
                    "status" => "ok",
                    "id_mov_reg_ingresado" => $id_mov_reg_creado,
                    "mensaje" => "El Movimiento Registral se ha Agregado Satisfactoriamente!"
                ]);
            } catch (Exception $e) {
                DB::rollback();
                return response()->json([
                    "status" => "error",
                    "mensaje" => $e->getMessage()
                ]);
            }
        }
    }

    public function store_persona_mov_reg(Request $request)
    {
        if ($request->ajax()) {

            try {
                $id_usuario = Auth::user()->id;

                // verificar existencia de Cedula en la tabla Persona
                // Si existe traer su id_persona
                // Si NO Existe Agregar Persona a la Tabla Persona
                // y obtener el Id_Persona_Creado
                // Relacionar id_persona a id_mov_reg

                $persona = Persona::where('activo', 1)
                    ->where('cedula', $request->cedula)
                    ->get();

                $cantidad_registros = count($persona);
                if ($cantidad_registros > 0) {

                    $datos_persona_mov_reg = array();
                    $datos_persona_mov_reg['id_movimiento_registral'] = $request->id_movimiento_reg;
                    $datos_persona_mov_reg['id_persona'] = $persona[0]->id_persona;
                    $datos_persona_mov_reg['id_usuario'] = $id_usuario;
                    DB::beginTransaction();
                    DB::table('personas_mov_registrales')->insert($datos_persona_mov_reg);
                    DB::commit();
                } else {

                    $datos_persona = array();
                    $datos_persona['cedula'] = $request->cedula;
                    $datos_persona['primer_nombre'] = strtoupper($request->primer_nombre);
                    $datos_persona['segundo_nombre'] = strtoupper($request->segundo_nombre);
                    $datos_persona['primer_apellido'] = strtoupper($request->primer_apellido);
                    $datos_persona['segundo_apellido'] = strtoupper($request->segundo_apellido);
                    $datos_persona['sexo'] = $request->sexo;

                    if ($request->fecha_nac != "")
                        $datos_persona['fecha_nac'] = $request->fecha_nac;
                    else
                        $datos_persona['fecha_nac'] = "19000101";


                    $datos_persona['obs'] = $request->obs;
                    $datos_persona['id_usuario'] = $id_usuario;
                    // Ingreso la Persona
                    DB::beginTransaction();
                    DB::table('personas')->insert($datos_persona);
                    $id_persona_creada = DB::getPdo()->lastInsertId();
                    DB::commit();

                    $datos_persona_mov_reg = array();
                    $datos_persona_mov_reg['id_movimiento_registral'] = $request->id_movimiento_reg;
                    $datos_persona_mov_reg['id_persona'] = $id_persona_creada;
                    $datos_persona_mov_reg['id_usuario'] = $id_usuario;
                    // Ingreso la Relacion Persona - MovReg
                    DB::beginTransaction();
                    DB::table('personas_mov_registrales')->insert($datos_persona_mov_reg);
                    DB::commit();

                    return response()->json([
                        "status" => "ok",
                        "id_persona_ingresada" => $id_persona_creada,
                        "mensaje" => "La Persona se ha Agregado Satisfactoriamente!"
                    ]);
                }
            } catch (Exception $e) {
                DB::rollback();
                return response()->json([
                    "status" => "error",
                    "mensaje" => $e->getMessage()
                ]);
            }
        }
    }

    public static function movimientosRegistralesPorUnidad($id)
    {
        $sql = "call SP_Movimientos_Registrales_Por_Unidad(?)";
        $query = DB::select($sql, array($id));
        $query = collect($query);
        return datatables()->of($query)->make(true);
    }

    public function update_movimientos_registrales(Request $request)
    {
        if ($request->ajax()) {

            try {
                // ACTUALIZAR MOVIMIENTOS REGISTRALES activo = false
                $id_usuario = Auth::user()->id;
                $fecha =  Carbon::now()->locale('es_UY');

                $datos_mov_reg = array();
                $datos_mov_reg['activo'] = 0;
                $datos_mov_reg['modificado'] = $fecha->isoFormat('YYYY-MM-DD HH:mm:ss');
                $datos_mov_reg['id_usuario'] = $id_usuario;

                DB::beginTransaction();
                DB::table('movimientos_registrales')
                    ->where('id_movimiento_registral',  $request->id_mov_registral)
                    ->update($datos_mov_reg);
                DB::commit();

                // ACTUALIZAR UNIDAD-MOV_REG activo = false
                $datos_unidad_mov_reg = array();
                $datos_unidad_mov_reg['activo'] = 0;
                $datos_unidad_mov_reg['modificado'] = $fecha->isoFormat('YYYY-MM-DD HH:mm:ss');
                $datos_unidad_mov_reg['id_usuario'] = $id_usuario;

                DB::beginTransaction();
                DB::table('unidades_mov_registrales')
                    ->where('id_unidad', $request->id_unidad)
                    ->where('id_movimiento_registral', $request->id_mov_registral)
                    ->update($datos_unidad_mov_reg);
                DB::commit();

                return response()->json([
                    "status" => "ok",
                    "mensaje" => "El Movimiento Registral se ha Eliminado Correctamente"
                ]);
            } catch (Exception $e) {
                DB::rollback();
                return response()->json([
                    "status" => "error",
                    "mensaje" => $e->getMessage()
                ]);
            }
        }
    }

    public function tiposMovimientosRegistrales()
    {
        $sql = "call SP_TiposMovimientosRegistralesActivos()";
        return response()->json(DB::select($sql, array()));
    }

    // </editor-fold>


    // <editor-fold defaultstate="collapsed" desc="TITULARES - UNIDAD">

    public function listar_titularesUnidades()
    {

        $sql = "call SP_ListarTitularesUnidades()";
        $query = DB::select($sql);
        $query = collect($query);
        return datatables()->of($query)->make(true);
    }

    public function reportePDF_titularesUnidades()
    {

        set_time_limit(1000);
        ini_set('memory_limit', '2048M');
        $sql = "call SP_ListarTitularesUnidades()";
        $titulares = DB::select($sql);
        $cantidad_registros = count($titulares);
        $pdf = PDF::loadView('reportes.listadoTitularesUnidad', [
            'titulares' => $titulares,
            'cantidad_registros' => $cantidad_registros
        ]);
        return $pdf->download('listado_titulares_unidad.pdf');
    }

    public function titularesPorUnidad($id)
    {
        $sql = "call SP_Titulares_Por_Unidad_Mant(?)";
        $titularesUnidad = DB::select($sql, array($id));

        return $titularesUnidad;
    }

    public function store_titular_a_unidad(Request $request)
    {
        if ($request->ajax()) {

            try {

                $id_usuario = Auth::user()->id;
                $fecha =  Carbon::now()->locale('es_UY');
                $pertenece_recibo = 0;
                $pertenece_padron = 0;

                // verificar existencia de Cedula en la tabla Persona
                // Si existe traer su id_persona
                // verificar si exite en la Tabla Titulares
                // Solo agrego la Relacion con la Unidad

                if ($request->figura_recibo == "SI") {
                    $pertenece_recibo = 1;
                }

                if ($request->figura_padron == "SI") {
                    $pertenece_padron = 1;
                }

                // Busco si EXISTE la PERSONA en la DB
                $personas = Persona::where('activo', 1)->where('cedula', '=', $request->cedula)->get();
                $cantidad_personas = $personas->count();

                if ($cantidad_personas > 0) { // La Persona EXISTE, solo registrar la Relacion

                    // Busco si existe la PERSONA como TITULAR
                    $id_persona_encontrada =  $personas[0]->id_persona;
                    $titulares = Titulares::where('activo', 1)
                        ->where('id_persona', '=', $id_persona_encontrada)->get();

                    $cantidad_titular = $titulares->count();

                    if ($cantidad_titular > 0) { // La Persona ExISTE como TITULAR, registrar UNIDAD_TITULAR

                        $id_titular_encontrado =  $titulares[0]->id_titular;

                        // Verifico si ya no existe como TITULAR de esta UNIDAD
                        $unidad_titulares = Unidad_Titular::where('activo', 1)
                            ->where('id_unidad', '=', $request->id_unidad)
                            ->where('id_titular', '=', $id_titular_encontrado)->get();
                        $cantidad_unidad_titular = $unidad_titulares->count();

                        if ($cantidad_unidad_titular > 0) { // EXISTE la relacion TITULAR-UNIDAD

                            // Modifico solo la RELACION
                            $unidad_titular = Unidad_Titular::find($unidad_titulares[0]->id_unidad_titular);
                            $unidad_titular->id_titular = $id_titular_encontrado;
                            $unidad_titular->id_unidad = $request->id_unidad;
                            $unidad_titular->pertenece_recibo = $pertenece_recibo;
                            $unidad_titular->pertenece_padron = $pertenece_padron;
                            $unidad_titular->obs = $request->obs;
                            $unidad_titular->activo = 1;
                            $unidad_titular->modificado = $fecha->isoFormat('YYYY-MM-DD HH:mm:ss');
                            $unidad_titular->id_usuario = $id_usuario;
                            $unidad_titular->save();
                        } else { // Existe TITULAR, Agrego RELACION TITULAR-UNIDAD

                            // Registrar UNIDAD_TITULAR
                            $unidad_titular = new Unidad_Titular;
                            $unidad_titular->id_titular = $id_titular_encontrado;
                            $unidad_titular->id_unidad = $request->id_unidad;
                            $unidad_titular->pertenece_recibo = $pertenece_recibo;
                            $unidad_titular->pertenece_padron = $pertenece_padron;
                            $unidad_titular->obs = $request->obs;
                            $unidad_titular->activo = 1;
                            $unidad_titular->modificado = $fecha->isoFormat('YYYY-MM-DD HH:mm:ss');
                            $unidad_titular->id_usuario = $id_usuario;
                            $unidad_titular->save();
                        }
                    } else { // La Persona NO EXISTE como TITULAR

                        // Registrar PERSONA como TITULAR
                        $titular = new Titulares;
                        $titular->id_persona = $id_persona_encontrada;
                        $titular->id_usuario = $id_usuario;
                        $titular->activo = 1;
                        if ($titular->save()) {
                            $id_titular_creado =  $titular->id_titular;
                        }

                        // Registrar UNIDAD_TITULAR
                        $unidad_titular = new Unidad_Titular;
                        $unidad_titular->id_titular = $id_titular_creado;
                        $unidad_titular->id_unidad = $request->id_unidad;
                        $unidad_titular->pertenece_recibo = $pertenece_recibo;
                        $unidad_titular->pertenece_padron = $pertenece_padron;
                        $unidad_titular->obs = $request->obs;
                        $unidad_titular->activo = 1;
                        $unidad_titular->modificado = $fecha->isoFormat('YYYY-MM-DD HH:mm:ss');
                        $unidad_titular->id_usuario = $id_usuario;
                        $unidad_titular->save();
                    }
                } else {  // La Persona NOOO EXISTE, registrar PERSONA - TITULAR - UNIDAD_TITULAR

                    $persona = new Persona;
                    $persona->cedula = $request->cedula;
                    $persona->primer_nombre = strtoupper($request->primer_nombre);
                    $persona->segundo_nombre = strtoupper($request->segundo_nombre);
                    $persona->primer_apellido = strtoupper($request->primer_apellido);
                    $persona->segundo_apellido = strtoupper($request->segundo_apellido);
                    $persona->sexo = $request->sexo;

                    if ($request->fecha_nac != "")
                        $persona->fecha_nac = $request->fecha_nac;
                    else
                        $persona->fecha_nac = "19000101";

                    $persona->obs = $request->obs;
                    $persona->activo = 1;
                    $persona->id_usuario = $id_usuario;
                    $persona->actuallizado = $fecha->isoFormat('YYYY-MM-DD HH:mm:ss');
                    if ($persona->save()) {
                        $id_persona_creada = $persona->id_persona;
                    }

                    $titular = new Titulares;
                    $titular->id_persona = $id_persona_creada;
                    $titular->id_usuario = $id_usuario;
                    $titular->activo = 1;
                    if ($titular->save()) {
                        $id_titular_creado =  $titular->id_titular;
                    }

                    $unidad_titular = new Unidad_Titular;
                    $unidad_titular->id_titular = $id_titular_creado;
                    $unidad_titular->id_unidad = $request->id_unidad;
                    $unidad_titular->pertenece_recibo = $pertenece_recibo;
                    $unidad_titular->pertenece_padron = $pertenece_padron;
                    $unidad_titular->obs = $request->obs;
                    $unidad_titular->activo = 1;
                    $unidad_titular->modificado = $fecha->isoFormat('YYYY-MM-DD HH:mm:ss');
                    $unidad_titular->id_usuario = $id_usuario;
                    $unidad_titular->save();
                }
                return response()->json([
                    "status" => "ok",
                    "mensaje" => "Titular o Integrante Agregado Satisfactoriamente!"
                ]);
            } catch (Exception $e) {
                DB::rollback();
                return response()->json([
                    "status" => "error",
                    "mensaje" => $e->getMessage()
                ]);
            }
        }
    }

    public function update_titular_a_unidad(Request $request)
    {
        if ($request->ajax()) {
            try {
                $id_usuario = Auth::user()->id;
                $fecha =  Carbon::now()->locale('es_UY');
                // ACTUALIZAR RELACION UNIDAD-TITULAR activo = false
                $unidad_titular = Unidad_Titular::find($request->id_unidad_titular);
                $unidad_titular->activo = 0;
                $unidad_titular->modificado = $fecha->isoFormat('YYYY-MM-DD HH:mm:ss');
                $unidad_titular->id_usuario = $id_usuario;
                $unidad_titular->save();

                return response()->json([
                    "status" => "ok",
                    "mensaje" => "El Titular se ha Eliminado Correctamente"
                ]);
            } catch (Exception $e) {
                DB::rollback();
                return response()->json([
                    "status" => "error",
                    "mensaje" => $e->getMessage()
                ]);
            }
        }
    }

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="VEHICULOS - UNIDAD">

    public function tiposVehiculosActivos()
    {
        $sql = "call SP_TiposVehiculosActivos()";
        return response()->json(DB::select($sql, array()));
    }

    public function reportePDF_vehiculosUnidades()
    {
        set_time_limit(300);
        ini_set('memory_limit', '1024M');
        $sql = "call SP_ListarVehiculosUnidades()";
        $vehiculos = DB::select($sql);
        $cantidad_registros = count($vehiculos);
        $pdf = PDF::loadView('reportes.listadoVehiculos', [
            'vehiculos' => $vehiculos,
            'cantidad_registros' => $cantidad_registros
        ]);
        return $pdf->download('listado_vehiculos_unidad.pdf');
    }

    public static function vehiculosPorUnidad($id)
    {
        $sql = "call SP_Vehiculos_Por_Unidad(?)";
        $query = DB::select($sql, array($id));
        $query = collect($query);
        return datatables()->of($query)->make(true);
    }

    public function store_vehiculo(Request $request)
    {
        if ($request->ajax()) {
            try {
                $id_usuario = Auth::user()->id;
                $datos_vehiculo = array();
                $datos_vehiculo['id_tipo_vehiculo'] = $request->tipo;
                $datos_vehiculo['matricula'] = strtoupper($request->matricula);
                $datos_vehiculo['marca'] = strtoupper($request->marca);
                $datos_vehiculo['modelo'] = strtoupper($request->modelo);
                $datos_vehiculo['anio'] = $request->anio;
                $datos_vehiculo['obs'] = $request->obs;
                $datos_vehiculo['id_usuario'] = $id_usuario;

                DB::beginTransaction();

                $recibo_insertado = DB::table('vehiculos')->insert($datos_vehiculo);
                // Obtengo el IDentificador del registro creado
                $id_vehiculo_creado = DB::getPdo()->lastInsertId();

                DB::commit();

                $datos_unidad_vehiculo = array();
                $datos_unidad_vehiculo['id_unidad'] = $request->id_unidad;
                $datos_unidad_vehiculo['id_vehiculo'] = $id_vehiculo_creado;
                $datos_unidad_vehiculo['id_usuario'] = $id_usuario;

                DB::beginTransaction();

                DB::table('unidades_vehiculos')->insert($datos_unidad_vehiculo);

                DB::commit();

                return response()->json([
                    "status" => "ok",
                    "mensaje" => "El vehículo se ha Agregado Satisfactoriamente!"
                ]);
            } catch (Exception $e) {
                DB::rollback();
                return response()->json([
                    "status" => "error",
                    "mensaje" => $e->getMessage()
                ]);
            }
        }
    }

    public function update_vehiculo(Request $request)
    {
        if ($request->ajax()) {
            try {
                // ACTUALIZAR VEHICULO activo = false
                $id_usuario = Auth::user()->id;
                $datos_vehiculo = array();
                $fecha =  Carbon::now()->locale('sp_ES');
                $datos_vehiculo['activo'] = 0;
                $datos_vehiculo['modificado'] = $fecha->isoFormat('YYYY-MM-DD HH:mm:ss');
                $datos_vehiculo['id_usuario'] = $id_usuario;

                DB::beginTransaction();
                DB::table('vehiculos')
                    ->where('id_vehiculo',  $request->id_vehiculo)
                    ->update($datos_vehiculo);
                DB::commit();

                // ACTUALIZAR UNIDAD-VEHICULO activo = false

                DB::beginTransaction();
                DB::table('unidades_vehiculos')
                    ->where('id_unidad', $request->id_unidad)
                    ->where('id_vehiculo', $request->id_vehiculo)
                    ->update($datos_vehiculo);
                DB::commit();

                return response()->json([
                    "status" => "ok",
                    "mensaje" => "El vehículo se ha Eliminado Correctamente"
                ]);
            } catch (Exception $e) {
                DB::rollback();
                return response()->json([
                    "status" => "error",
                    "mensaje" => $e->getMessage()
                ]);
            }
        }
    }

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="EXPEDIENTES - UNIDAD">

    public static function expedientesPorUnidad($id)
    {
        if ($id > 0) {

            $sql = "call SP_Expedientes_Por_Unidad(?)";
            $query = DB::select($sql, array($id));
        } else {
            $sql = "call SP_Expedientes_Activos()";
            $query = DB::select($sql, array());
        }
        $query = collect($query);
        return datatables()->of($query)->make(true);
    }

    // </editor-fold>
    public function Reporte_PDF_FacturasPorUnidad()
    {
    }
}