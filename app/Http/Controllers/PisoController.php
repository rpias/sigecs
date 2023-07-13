<?php

namespace App\Http\Controllers;

use App\Piso;
use Illuminate\Http\Request;

class PisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


     /**
     * Muestra los Pisos por Edificio
     *
     * @return \Illuminate\Http\Response
     */
    public function pisosPorEdificio($id)
    {
        $sql = "call SP_Pisos_Por_Edificio(?)";
        return DB::select($sql, array($id));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Piso  $piso
     * @return \Illuminate\Http\Response
     */
    public function show(Piso $piso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Piso  $piso
     * @return \Illuminate\Http\Response
     */
    public function edit(Piso $piso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Piso  $piso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Piso $piso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Piso  $piso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Piso $piso)
    {
        //
    }
}
