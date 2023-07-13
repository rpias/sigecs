<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Condominio;
class CondominioController extends Controller
{
    public function index(){

        //$condominio = Post::all();
        //return view('condominio.index', compact('condominio'));

        return view('condominios.index');

    }


    public function create(){

        return view('condominios.create');

    }

    public function store(Request $request){

           \App\Condominio::create([
                'nombre' => $request['txtnombre'],
                'direccion' => $request['txtdireccion'],
                'telefono' => $request['txttelefono'],
            ]);

            return "Nombre: " . $request['txtnombre'] . " - Direccion: " . $request['txtdireccion'] . " - Telefono: " . $request['txttelefono'];
            //return "Condominio Registrado Satisfactoriamente";

    }
}
