<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $dia = date('d'); //numero de dia que es hoy 
        $mes = date('m'); //numero del mes de hoy 
        $ano = date('Y'); //numero del año de hoy 
        $hoy_unix = mktime(0, 0, 0, $mes, $dia, $ano); //el dia de hoy en formato unix 
        $dias_restar = 90;
        $dia_resul = $hoy_unix - ($dias_restar * 24 * 60 * 60); //dias * horas * minutos * segundos. 
        $fecha_limite = date('d/m/Y', $dia_resul);
        $dia_resul = date('Ymd', $dia_resul);

        $sql = "call SP_Cantidad_Atrasados(?)";
        $dt_morosidad = DB::select($sql, array($dia_resul));
        $cantidad = $dt_morosidad[0]->cantidad;
        $sub_total = ($cantidad * 100);
        $total = ($sub_total / 1476);
        $total = number_format($total, 2);

        $id_usuario = Auth::user()->id;
        // $user = User::find($id_usuario);

        $sql = "call SP_Max_Rol_Por_Usuario(?)";
        $dt = DB::select($sql, array($id_usuario));
        $id_rol = $dt[0]->id_rol;
        session()->put('idRol', $id_rol);
        $menu = $this->getMenuPorRol(session('idRol'));

         return view('index')
             ->with('morosidad', $total)
             ->with('menu_str', $menu)
             ->with('fecha_limite', $fecha_limite);

    }
}
