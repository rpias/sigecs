@extends('layouts.layout')

@section('titulo')
Consultar Registro de Sucesos
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
}
?>">

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
        <div class="box-content">
            {{ csrf_field() }}
            <br />
            <div class="box box-primary">
                <div id='table_responsive' style='min-height: 700px;'>

                    <div class="form-row">
                        <h4>Consultar registros entre fechas</h4>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label for="txt_fecha_ini">Fecha Inicial</label>
                            <input id="txt_fecha_ini" name="txt_fecha_ini" class="form-control" 
                            type="date" min="2010-01-01" require value="<?php echo date("Y-m-d"); ?>" />
                        </div>
                        <div class="col">
                            <label for="txt_fecha_fin">Fecha Final</label>
                            <input id="txt_fecha_fin" name="txt_fecha_fin" class="form-control" 
                            type="date" min="2010-01-01" require value="<?php echo date("Y-m-d"); ?>" />
                        </div>

                        <div class="col">
                            <label for="select_tipo">Tipo registro</label>
                            <select id="select_tipo" name="select_tipo" class="form-control">
                                <option value="0">Todos</option>
                                <option value="1">MODIFICAR RECIBO</option>
                                <option value="2">CREAR RECIBO</option>
                                <option value="3">ELIMINAR RECIBO</option>
                            </select>
                        </div>

                    </div>

                    <br />


                    <div class="form-row">
                        <div class="col">
                            <label for="txt_nro_recibo">Número recibo</label>
                            <input id="txt_nro_recibo" name="txt_nro_recibo" class="form-control" require value="0" />
                        </div>
                    </div>

                    <br />
                    <div class="form-row">
                        <div class="col">
                            <button type="submit" style="width: 95%" class="btn btn-info" 
                            id="btn_buscar_registros">Buscar registros</button>
                        </div>
                        <div class="col">
                            <button type="submit" style="width: 95%" 
                            class="btn btn-success" id="btn_buscar_historia">Buscar Historia de un recibo</button>
                        </div>
                    </div>
                    <br />
                    <div class="form-row">
                        <h4>Lista de registros</h4>
                    </div>

                    <div class="form-row" >
                    <div class="col">
                        <table class="table table-bordered" id="tabla_registros" style="width: 100% !important;">
                            <thead>
                                <th>Id </th>
                                <th>Usuario</th>
                                <th>Serie</th>
                                <th>Nro. Rec.</th>
                                <th>Nro. Rec.</th>
                                <th>Edificio</th>
                            </thead>
                        </table>
                    </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<div class="modal" id="agregarMovimientosModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Movimiento Expediente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p></p>

                <div class="form-row">
                    <div class="col">
                        <label for="txt_obs_mov">Descripción Movimiento</label>
                        <input id="txt_obs_mov" name="txt_obs" class="form-control" />
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')

<!-- Propios de SIGECS -->
<script src="{{ asset ('js/registro/registro_sucesos.js')}}"></script>

@endsection