@extends('layouts.layout')

@section('titulo')
Movimientos
@endsection

@section('menu')
{{!! $menu_str !!}}
@endsection

@section('contenido')

<div class="card uper" style="display: 
<?php
if (!$errors->any()) {
    echo "none";
} else {
    echo "inline";
} ?>">

    <div class="card-header">
    </div>
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">x </button>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
        @endif
    </div>
</div>

@if(session()->has('exito'))
<div id="exito" class="alert alert-success alert-block col-lg-10">
    <button type="button" class="close" data-dismiss="alert">x </button>
    <strong>{{session('exito')}}</strong>
</div>
@endif

@if(session()->has('eliminado'))
<div id="eliminado" class="alert alert-success alert-block col-lg-10">
    <button type="button" class="close" data-dismiss="alert">x </button>
    <strong>{{session('eliminado')}}</strong>
</div>
@endif

@if(session()->has('error'))
<div id="error" class="alert alert-success alert-block col-lg-10">
    <button type="button" class="close" data-dismiss="alert">x </button>
    <strong>{{session('error')}}</strong>
</div>
@endif

<div class="row-fluid sortable">
    <div class="box span12">

        <div class="box-header" data-original-title>
            <h2><i class="halfling-icon edit"></i><span class="break"></span></h2>
            <div class="box span12">
                <a href="#" class="btn-setting"><i class="halfling-icon wrench"></i></a>
                <a href="#" class="btn-setting"><i class="halfling-icon chevron-up"></i></a>
                <a href="#" class="btn-setting"><i class="halfling-icon remove"></i></a>
            </div>

        </div>

        <div class="form-row">
            <div class="col-sm-3">
                <label for="txt_fecha_mov_buscar">Fecha mov.</label>
                <input id="txt_fecha_mov_buscar" name="txt_fecha_mov_buscar" class="form-control" 
                type="date" min="2010-01-01" require value="<?php echo date("Y-m-d"); ?>" />
            </div>
            <div class="form grpup col-sm-6">
                <label for="btn_buscar" class="text-white-50">Boton Buscar</label>
                <button type="submit" style="width: 95%" class="btn btn-success" id="btn_buscar">Buscar Movimientos</button>
            </div>
        </div>

        <form id="frm_mov" class="form-horizontal" action="{{ url('guardar_movimiento') }}" method="post">
            {{ csrf_field() }}

            <input type="hidden" id="hd_id_movimiento" name="hd_id_movimiento" />
            <input type="hidden" id="hd_eliminar" name="hd_eliminar" />

            <br />

            <div class="form-row">
                <div class="col">
                    {!!Form::label('Rubro')!!}
                    <select id="select_rubro" name="" class="form-control">
                        <option value="0">Seleccione Rubro</option>
                        @foreach ($rubros as $rubro)
                        <option value="{{$rubro->id_rubro}}">{{$rubro->nombre}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    {!!Form::label('Sub Rubro')!!}
                    <select id="select_sub_rubro" name="select_sub_rubro" require class="form-control"></select>
                </div>
            </div>

            <br />
            <div class="box box-primary">
                <div id='table_responsive' style='min-height: 700px;'>

                    <div class="form-row">
                        <div class="col-sm-3">
                            <label for="txt_fecha_mov">Fecha mov.</label>
                            <input id="txt_fecha_mov" name="txt_fecha_mov" class="form-control" 
                            type="date" min="2010-01-01" require value="<?php echo date("Y-m-d"); ?>" />
                        </div>

                        <div class="col-sm-9">
                            <label for="txt_detalle">Detalle</label>
                            <input id="txt_detalle" name="txt_detalle" class="form-control" 
                            type="text" placeholder="Detalle el objeto de gasto (Nombre comercio, categoria específica no registrada)" />
                        </div>

                    </div>
                    <br />
                    <div class="form-row">
                        <div class="col-sm-3">
                            <label for="txt_fecha_doc">Fecha doc.</label>
                            <input id="txt_fecha_doc" name="txt_fecha_doc" class="form-control" 
                            type="date" min="2010-01-01" require value="<?php echo date("Y-m-d"); ?>" />
                        </div>
                        <div class="col">
                            <label for="txt_nro_doc">Número doc.</label>
                            <input id="txt_nro_doc" name="txt_nro_doc" class="form-control" 
                            type="number" min="1" max="99999999" require value="0" />
                        </div>

                        <div class="col">
                            <label for="txt_importe">Importe</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$U</span>
                                </div>
                                <input type="number" min="1" max="99999999" id="txt_importe" 
                                name="txt_importe" class="form-control" placeholder="Utilice . (punto) como separador decimal">
                            </div>
                        </div>

                    </div>

                    <br />

                    <div class="form-row">
                        <div class="col">
                            <label for="txt_obs">Observaciones</label>
                            <input id="txt_obs" name="txt_obs" class="form-control" />
                        </div>
                    </div>

                    <br />

                    <div class="form-row">
                        <div class="col">
                            <button type="submit" style="width: 95%" class="btn btn-success" id="btn_agregar">Ingresar Mov.</button>
                        </div>
                        <div class="col">
                            <button type="submit" style="width: 95%" class="btn btn-warning" id="btn_modificar">Modificar Mov.</button>
                        </div>
                        <div class="col">
                            <button type="submit" style="width: 95%" class="btn btn-danger" id="btn_eliminar">Eliminar Mov.</button>
                        </div>
                        <div class="col"></div>
                        <div class="col"></div>
                        <div class="col"></div>

                    </div>

                    <br />

                    <div class="form-row">
                        <table class="table table-bordered" id="tabla_mov" style='width: 100% !important;'>
                            <thead>
                                <th>Id </th>
                                <th>Rubro</th>
                                <th>Fecha mov. </th>
                                <th>Nro. doc.</th>
                                <th>Detalle</th>
                                <th>Importe</th>
                                <th>Obs</th>
                                <th class="text-center"> Acciones </th>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        </form>

    </div>
</div>
</div>

@endsection

@section('scripts')

<!-- Propios de SIGECS -->
<script src="{{ asset ('js/contable/movimientos.js')}}"></script>

@endsection