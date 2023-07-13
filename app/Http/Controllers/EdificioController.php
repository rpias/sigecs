<?php

namespace App\Http\Controllers;

use App\Edificio;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class EdificioController extends Controller
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
     * Muestra los Edificios por Condominio
     *
     * @return \Illuminate\Http\Response
     */
    public function edificiosPorCondominio($id)
    {
        $sql = "call SP_Edificios_Por_Condominio(?)";
        return DB::select($sql, array($id));
       
    }

    public function Reporte_PDF_Edificios(){
       
        $edificios = Edificio::get();
        $cantidad_registros = count($edificios);
        $pdf = PDF::loadView('reportes.listadoEdificios', ['edificios' => $edificios, 
        'cantidad_registros' => $cantidad_registros]);
  
        return $pdf->download('listado_edificios.pdf');

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
     * @param  \App\Edificio  $edificio
     * @return \Illuminate\Http\Response
     */
    public function show(Edificio $edificio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Edificio  $edificio
     * @return \Illuminate\Http\Response
     */
    public function edit(Edificio $edificio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Edificio  $edificio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Edificio $edificio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Edificio  $edificio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Edificio $edificio)
    {
        //
    }
}
