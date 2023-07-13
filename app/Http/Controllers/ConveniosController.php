<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Persona;
use App\Convenio;



/* CONTROLADORES */
use App\Http\Controllers\UnidadController;


/* MODELOS */
use App\Edificio;
use App\Piso;
use App\Departamento;
use App\Convenios;
use App\Unidad;
use Datatables;
use Session;
use PDF;

/* LIBRERIAS */
use Carbon\Carbon;

class ConveniosController extends Controller
{

    public function index_convenios()
    {
        $edificios = Edificio::all();
        $menu = $this->getMenuPorRol(session('idRol'));
        return view('facturas.createconvenio')
            ->with(compact('edificios'))
            ->with('menu_str', $menu);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function crear_convenio()
    {

        $convenio = json_decode(json_encode($_POST));

        try {
            if (!$this->convenioValido($convenio)) //Si el convenio no es valido
            {
                echo '<div class="alert alert-danger" role="alert">
                Error, Verifique que los datos ingresados sean correctos
               </div>';
            }
            if ($convenio->tipo_convenio == 1 && !$this->refinanciadoValido($convenio)) //Si es refinanciado y no es valido
            {
                echo '<div class="alert alert-danger" role="alert">
               Error, Verifique los datos del refinanciado
               </div>';
                exit();
            }
            $titular = Persona::find($convenio->select_titulares_unidad);
            $sql_convenios_activos = DB::select('SELECT * FROM convenios WHERE id_unidad = ? AND estado_convenio = "ACTIVO"', array($convenio->select_unidad));
            $cantidad_activos = count($sql_convenios_activos);
            if ($cantidad_activos == 0) {
                $id_usuario = Auth::user()->id; //Obtengo el id del usuario que esta creando el convenio
                $sql = "call SP_AgregarConvenioUnidad(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $query = DB::select($sql, array(
                    $convenio->select_unidad, $convenio->txt_fecha, $convenio->txt_entrega_cta, $convenio->txt_deuda_actual,
                    $convenio->txt_cantidad_cuotas, $convenio->txt_importe_cuota, $convenio->txt_obs, $id_usuario, $convenio->tipo_convenio, 
                    $convenio->txt_importe_cuota_refinanciado, $convenio->txt_cuotas_refinanciado, $convenio->select_formas_pago, 
                    $this->datosTitular($titular), $titular->cedula
                ));
                $query = collect($query);
                //$this->guardarLog($id_usuario, 'CREAR CONVENIO', $convenio);
                echo '<div class="alert alert-success" role="alert">
               Convenio creado con exito
               </div>';
                exit();
            } else {
                echo '<div class="alert alert-danger" role="alert">
               Error, la unidad ya tiene un convenio activo
               </div>';
                exit();
            }
        } catch (Exception $e) {
            //$this->guardarLog(Auth::user()->id, 'Ocurrio la excepcion: ' . $e .  ' al crear el convenio: ', $convenio);
            echo '<div class="alert alert-danger" role="alert">
               Error, ocurrio un error inesperado
               </div>';
        }
    }

    private function convenioValido($convenio)
    {
        if (
            $convenio->txt_deuda_actual <= 0 || $convenio->txt_total_a_financiar <= 0 || $convenio->txt_cantidad_cuotas < 1
            || $convenio->txt_importe_cuota <= 0 || $convenio->txt_entrega_cta < 0 || $convenio->select_titulares_unidad == null
        ) //Si los numeros no son validos o si no hay ningun titular
        {
            return false;
        }
        if ($convenio->txt_obs == null) //Si no tiene observaciones, le asigno un string vacio
        {
            $convenio->txt_obs = "";
        }
        if ($convenio->tipo_convenio == "refinanciado") //Si es refinanciado
        {
            $convenio->tipo_convenio = 1;
        } else {
            $convenio->tipo_convenio = 0;
        }
        return true;
    }

    private function refinanciadoValido($convenio)
    {
        if ($convenio->txt_importe_cuota_refinanciado <= 0 || $convenio->txt_cuotas_refinanciado < 1 || $convenio->txt_total_refinanciado <= 0) {
            return false;
        }
        return true;
    }

    private function datosTitular($titular)
    {
        return $titular->primer_apellido . ' ' . $titular->segundo_apellido . ' ' . $titular->primer_nombre . ' ' . $titular->segundo_nombre;
    }

    public function pdf_convenio()
    {
        $id_convenio = $_GET['idConvenio']; //Obtengo el id del convenio
        $convenio = Convenio::find($id_convenio);
        $diaConvenio = date('d', strtotime($convenio->fecha));
        $mesConvenio = date('m', strtotime($convenio->fecha));
        $anioConvenio = date('Y', strtotime($convenio->fecha));
        $mesConvenio = $this->obtener_mes((int)$mesConvenio);
        $data = [
            'diaConvenio' => $diaConvenio,
            'mesConvenio' => $mesConvenio,
            'anioConvenio' => $anioConvenio,
            'convenio' => $convenio
        ];
        $pdf = PDF::loadView('facturas.pdf_convenio', $data);
        return $pdf->stream();
    }

    private function obtener_mes($mes)
    {
        switch ($mes) {
            case 1:
                return 'Enero';
                break;
            case 2:
                return 'Febrero';
                break;
            case 3:
                return 'Marzo';
                break;
            case 4:
                return 'Abril';
                break;
            case 5:
                return 'Mayo';
                break;
            case 6:
                return 'Junio';
                break;
            case 7:
                return 'Julio';
                break;
            case 8:
                return 'Agosto';
                break;
            case 9:
                return 'Septiembre';
                break;
            case 10:
                return 'Octubre';
                break;
            case 11:
                return 'Noviembre';
                break;
            case 12:
                return 'Diciembre';
                break;
        }
    }


    /**
     * Muestra los Convenios por Unidad
     *
     * @return \Illuminate\Http\Response
     */
    public function conveniosPorUnidad($id)
    {
        $sql = "call SP_Convenios_Por_Unidad(?)";
        $query = DB::select($sql, array($id));
        $query = collect($query);
        return datatables()->of($query)->make(true);
    }

    public function deudaUnidad($id_unidad)
    {
        $sql = "call SP_Deuda_Unidad(?)"; //El importe total de las facturas impagas
        $deudaTotal = DB::select($sql, array($id_unidad));

        return $deudaTotal[0]->deuda_total;
    }



    /**
     * Muestra las Facturas por Departamento
     *
     * @return \Illuminate\Http\Response
     */
    public function totalFacturasPendientesPorUnidad($id)
    {
        $sql = "call SP_Facturas_TotalDeuda_PorIdUnidad(?)";
        return DB::select($sql, array($id));
    }

    public function store(Request $request)
    {
        // $id_usuario = Auth::user()->getId();

        //  print_r($request);

        /*
        $this->validate($request,[ 'id_unidad'=>'required', 
                                    'fecha'=>'required', 
                                    'cant_cuotas'=>'required', 
                                    'importe_cuota'=>'required', 
                                    'importe_total'=>'required',
                                    'importe_adelanto'=>'required',
                                    'id_usuario'=>'required']);
        */
        //Convenios::create($request->all());
        // return redirect()->route('facturas.createconvenio')->with('success','Registro creado satisfactoriamente');

    }
}
