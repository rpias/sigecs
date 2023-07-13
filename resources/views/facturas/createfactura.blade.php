@extends('layouts.layout')

@section('titulo')
   Facturas
@endsection

@section('encabezados')


@endsection

@section('menu')
{{!! $menu_str !!}}
@endsection

@section('contenido')


@if(session()->has('exito'))
 <strong>{{session('exito')}}</strong>
    <div class="alert alert-success alert-block col-lg-10 ">
        <button type="button" class="close" data-dismiss="alert">x </button>
        <strong>{{session('exito')}}</strong>
    </div>
@endif

@if(session()->has('error'))
<div class="alert alert-success alert-block col-lg-10 ">
        <button type="button" class="close" data-dismiss="alert">x </button>
        <strong>{{session('error')}}</strong>
    </div>
@endif


<form class="form-horizontal" action="{{ url('/crear-factura') }}" method="post">
    {{ csrf_field() }}
    <div class="form-row">
        <div class="col">
            {!!Form::label('Edificio')!!}
            <select id="select_edificio" name="select_edificio" class="form-control">
                <option value="">Seleccione Edificio</option>
                @foreach ($edificios as $edificio)
                    <option value="{{ $edificio->id_edificio}}">{{ $edificio->nombre}}</option>
                @endforeach
            </select> 
        </div>

        <div class="col">
            {!!Form::label('Unidad')!!}
            <select id="select_unidad" name="select_unidad" class="form-control"></select> 
        </div>

    </div>

    <br /><br />

    <div class="form-row">

        <div class="col">
            <label for="txt_fecha">Fecha Convenio</label>
            <input id="txt_fecha" name="txt_fecha" class="form-control" 
            type="date" min="2000-01-01" require
            value="<?php echo date("Y-m-d");?>" />
                
        </div>

        <div class="col">
            <label for="txt_deuda_actual">Deuda Actual</label>
            
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">$U</span>
                </div>
                <input type="number" id="txt_deuda_actual" 
                name="txt_deuda_actual" require
                value="0"
                class="form-control currency">
                <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                </div>
            </div>

        </div>
        
    </div>

    <div class="form-row">

        <div class="col">
            <label for="txt_entrega_cta">Entrega a Cuenta</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">$U</span>
                </div>
                <input type="text" id="txt_entrega_cta" name="txt_entrega_cta" 
                class="form-control" require  value="0" min="500"
                aria-label="Amount (to the nearest dollar)">
                <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                </div>
            </div>
        </div>

        <div class="col">
            <label for="txt_total_a_financiar">Total a Financiar</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">$U</span>
                </div>
                <input type="text" id="txt_total_a_financiar" name="txt_total_a_financiar" 
                class="form-control" require  value="0"
                aria-label="Amount (to the nearest dollar)">
                <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                </div>
            </div>
        </div>
        
    </div>

    <div class="form-row">

        <div class="col">
            <label for="txt_cantidad_cuotas">Cantidad de Cuotas</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"></span>
                </div>
                <input type="text" id="txt_cantidad_cuotas" name="txt_cantidad_cuotas" 
                class="form-control" require  value="0" 
                aria-label="Amount (to the nearest dollar)">
                <div class="input-group-append">
                    <span class="input-group-text"></span>
                </div>
            </div>
        </div>

        <div class="col">
            <label for="txt_importe_cuota">Importe de la Cuota</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">$U</span>
                </div>
                <input type="text" id="txt_importe_cuota" name="txt_importe_cuota" 
                class="form-control" require  value="0"
                aria-label="Amount (to the nearest dollar)">
                <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                </div>
            </div>
        </div>
        
    </div>

    <div class="form-row">
            <div class="col">
                <label for="txt_obs">Observacionres</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"></span>
                    </div>
                    <input type="text" id="txt_obs" name="txt_obs" class="form-control" aria-label="Amount (to the nearest dollar)">
                    <div class="input-group-append">
                        <span class="input-group-text"></span>
                    </div>
                </div>
            </div>
    </div>

    <br />

    <div class="form-group">
        <button type="submit" class="btn btn-primary mb-2">Crear Convenio</button>
        
    </div>

</form>  

</a>


@endsection

@section('scripts')
  
    <!-- Propios de SIGECS -->
    <script src="{{ asset ('js/cobranza/create.js')}}"></script>
    <script src="{{ asset ('js/facturas/facturas.js')}}"></script>

@endsection