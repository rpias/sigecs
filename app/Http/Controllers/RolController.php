<?php

namespace App\Http\Controllers;

use App\User;
use App\Rol;
use App\UsuarioRol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Exception;
use Closure;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_usuario = Auth::user()->id;
        $user = User::find($id_usuario);
        return view('roles')->with(compact('user'));
    }

    public function index_post(Request $request)
    {
        $id_rol = $request->id_rol;
        session(['idRol' => $id_rol]);
    }
   

    public function index_post_bk(Request $request)
    {
        $id_rol = $request->id_rol;
        session(['idRol' => ""]);
        session(['menu' => ""]);
        session(['idRol' => $id_rol]);

        $sql = "call SP_ListarMenuPadresPorRol(?)";
        $dt_menu_padres = DB::select($sql, array($id_rol)); 
        $str_menu = "";
        $str_menu .= '<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">';

        foreach($dt_menu_padres as $menu_padres)
        {
            $str_menu .= '<li class="nav-item has-treeview">';
            $str_menu .= '  <a href="" class="nav-link">
                                <i class="' . $menu_padres->icono . '"></i>
                                    <p>
                                        ' . $menu_padres->menu . '
                                         <i class="right fa fa-angle-left"></i>
                                    </p>
                            </a>
                        <ul class="nav nav-treeview">';

            $sql = "call SP_ListarMenuHijosPorRol(?,?)";
            $dt_menu_hijos = DB::select($sql, array($id_rol, $menu_padres->id_menu)); 

            foreach($dt_menu_hijos as $menu_hijo)
            {
                $str_menu .= '<li class="nav-item">
                                <a href="'. $menu_hijo->ruta . '" class="nav-link">
                                    <i class="'. $menu_hijo->icono .'"></i>
                                    <p>'. $menu_hijo->menu .'</p>
                                </a>
                              </li>';
            }
            $str_menu .= '</ul></li>';
        }
        $str_menu .= '</ul>';
        session(['menu' => $str_menu]);
    }
   
}
