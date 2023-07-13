@extends('layouts.layout')

@section('titulo')
Convenios
@endsection

@section('encabezados')


@endsection

@section('menu')
{{!! $menu_str !!}}
@endsection

@section('contenido')

<!--
EJEMPLO DE IMPRIMIR  CONSTANTE EN LA VISTA
<h1><strong>Valor: {{ config('constants.FORMA_PAGO_CONVENIO') }} -- {{ config('constants.FECHA_HOY') }}</strong></h1>
-->

@if(session()->has('exito'))

<strong>{{session('exito')}}</strong>
<div class="alert alert-success alert-block col-lg-10 ">
    <button type="button" class="close" data-dismiss="alert">x </button>
    <strong>{{session('exito')}}</strong>
</div>
@endif

@if(session()->has('error'))
<div class="alert alert-danger alert-block col-lg-10 ">
    <button type="button" class="close" data-dismiss="alert">x </button>
    <strong>{{session('error')}}</strong>
</div>
@endif

<form id="form-convenio" class="form-horizontal">
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
            <select id="select_unidad" name="select_unidad" class="form-control form-data"></select>
        </div>

        <div class="col">
            <label for="txt_titulares_unidad">Titulares unidad</label>
            <select id="select_titulares_unidad" name="select_titulares_unidad" class="form-control form-data"></select>
        </div>

        <div class="col">
            <label for="txt_fecha">Fecha Convenio</label>
            <input id="txt_fecha" name="txt_fecha" class="form-control form-data" type="date" min="2000-01-01" require value="<?php echo date("Y-m-d"); ?>" />

        </div>

    </div>

    <br /><br />

    <div class="form-row">

        <div class="col">
            <label for="txt_deuda_actual">Deuda Actual</label>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">$U</span>
                </div>
                <input type="number" id="txt_deuda_actual" name="txt_deuda_actual" require value="0" class="form-control currency form-data" readonly />
            </div>

        </div>

        <div class="col">
            <label for="txt_total_a_financiar">Total a Financiar</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">$U</span>
                </div>
                <input type="number" id="txt_total_a_financiar" name="txt_total_a_financiar" class="form-control form-data" require value="0" readonly>
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
                <input type="number" id="txt_entrega_cta" name="txt_entrega_cta" class="form-control form-data" require value="0" min="0" readonly />
            </div>
        </div>

        <div class="col">
            <label for="txt_formas_pago">Forma Pago</label>
            <select id="select_formas_pago" name="select_formas_pago" class="form-control form-data"></select>
        </div>

        <div class="col">
            <label for="txt_cantidad_cuotas">Cantidad de Cuotas</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"></span>
                </div>
                <input type="number" id="txt_cantidad_cuotas" name="txt_cantidad_cuotas" class="form-control form-data" require value="1" min="1" readonly />
            </div>
        </div>

        <div class="col">
            <label for="txt_importe_cuota">Importe de la Cuota</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">$U</span>
                </div>
                <input type="number" id="txt_importe_cuota" name="txt_importe_cuota" class="form-control form-data" require value="0" readonly>
            </div>
        </div>

    </div>

    <div class="form-row">
        <div class="col">
            <label for="txtTipoConvenio">Tipo de convenio</label>
            <div class="input-group mb-3">
                <select id="tipo_convenio" name="tipo_convenio" class="form-control form-data">
                    <option selected="selected" value="comun">Común</option>
                    <option value="refinanciado">Refinanciado</option>
                </select>
            </div>
        </div>

        <div class="col">
            <label for="txt_importe_cuota_refinanciado">Importe Cuota Refinanciado</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">$U</span>
                </div>
                <input type="number" id="txt_importe_cuota_refinanciado" name="txt_importe_cuota_refinanciado" class="form-control form-data" require value="0" readonly>
            </div>
        </div>

        <div class="col">
            <label for="txt_cuotas_refinanciado">Cuotas Refinanciado</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"></span>
                </div>
                <input type="number" id="txt_cuotas_refinanciado" name="txt_cuotas_refinanciado" class="form-control form-data" require value="1" min="1" readonly />
            </div>
        </div>

        <div class="col">
            <label for="txt_total_refinanciado">Total refinanciado</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">$U</span>
                </div>
                <input type="number" id="txt_total_refinanciado" name="txt_total_refinanciado" class="form-control form-data" require value="0" readonly>
            </div>
        </div>

    </div>

    <div class="form-row">
        <div class="col">
            <label for="txt_obs">Observaciones</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"></span>
                </div>
                <input type="text" id="txt_obs" name="txt_obs" class="form-control form-data" aria-label="Amount (to the nearest dollar)">
                <div class="input-group-append">
                    <span class="input-group-text"></span>
                </div>
            </div>
        </div>
    </div>

    <br />

    <div class="form-group">
        <button type="button" onclick="crearConvenio()" ; return false class="btn btn-primary mb-2">Crear Convenio</button>
    </div>
    <span id="message"></span>

    <div class="form-row">
        <div id='table_responsive' style='min-height: 700px;'>
            <table class="table_responsive table-bordered" hidden="true" id="tabla-convenios" style='width: 100% !important;'>
                <thead>
                    <th>Id</th>
                    <th>Fecha Convenio</th>
                    <th>Edificio</th>
                    <th>Unidad</th>
                    <th>Deuda Total</th>
                    <th>Adelanto</th>
                    <th>Cuotas</th>
                    <th>Importe Cuota</th>
                    <th>Refinanciado</th>
                    <th>Importe Refinanciado</th>
                    <th>Cuotas Refinanciado</th>
                    <th>Estado</th>
                    <th class="text-center"> Imprimir </th>

                </thead>
            </table>
        </div>
    </div>

</form>



@endsection

@section('scripts')

<!-- Propios de SIGECS -->
<!-- <script src="{{ asset ('js/cobranza/recibos.js')}}"></script> -->
<script src="{{ asset ('js/facturas/convenios.js')}}"></script>

@endsection