@extends('layouts.layout')

@section('titulo')
   Gestión de Cobranza
@endsection

@section('menu')
{{!! $menu_str !!}}
@endsection

@section('contenido')


<div class="form-row">
    <table class="table table-bordered" id="tabla-pagos" 
    style='width: 100% !important;'>
            <thead>
                    <th>Id </th>
                    <th>Serie</th>
                    <th>Nro </th>
                    <th>Fecha </th>
                    <th>Edificio</th>
                    <th>Unidad</th>
                    <th>Id Concepto</th>
                    <th>Concepto</th>
                    <th>Id Forma Pago</th>
                    <th>Forma Pago</th>
                    <th>Importe</th>
                    <th>Mes</th>
                    <th>Año</th>
                    <th>Titular</th>
                    <th>Obs</th>
                    
            </thead>
        </table>

</div>


@endsection


@section('scripts')

    <!-- Propios de SIGECS -->
    <script src="{{ asset ('js/cobranza/create.js')}}"></script>
  

@endsection