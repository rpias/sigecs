@extends('layouts.layout')

@section('titulo')
   Ingreso de Expedientes por Unidad
@endsection

@section('menu')
{{!! $menu_str !!}}
@endsection

@section('contenido')

    <div class="card uper" style="display: <?php if(!$errors->any()){ echo "none";} else { echo "inline"; } ?>">
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
     <div id="exito" class="alert alert-success alert-block col-lg-10" >
        <button type="button" class="close" data-dismiss="alert">x </button>
        <strong>{{session('exito')}}</strong>
    </div>
@endif

@if(session()->has('eliminado'))
     <div id="eliminado" class="alert alert-success alert-block col-lg-10" >
        <button type="button" class="close" data-dismiss="alert">x </button>
        <strong>{{session('eliminado')}}</strong>
    </div>
@endif

@if(session()->has('error'))
<div id="error" class="alert alert-success alert-block col-lg-10" >
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
            <form class="form-horizontal" action="{{ url('guardar_expediente') }}" method="post">
            {{ csrf_field() }}

            <input type="hidden" id="hd_id_expediente" name="hd_id_expediente" />
            <input type="hidden" id="hd_eliminar" name="hd_eliminar" />

            <div class="form-row">
                <div class="col">
                    {!!Form::label('Edificio')!!}
                    <select id="select_edificio" name="" class="form-control">
                        <option value="0">Seleccione Edificio</option>
                        @foreach ($edificios as $edificio)
                            <option value="{{$edificio->id_edificio}}">{{ $edificio->nombre}}</option>
                        @endforeach
                    </select> 
                </div>

                <div class="col">
                    {!!Form::label('Unidad')!!}
                    <select id="select_unidad" name="select_unidad" require class="form-control"></select> 
                </div>
            </div>
          
            <br /> 
            <div class="box box-primary">
                <div id='table_responsive' style='min-height: 700px;' >
              
                    <div class="form-row">
                            <div class="col">
                                <label for="txt_fecha_anv">Fecha Ingresado ANV</label>
                                <input id="txt_fecha_anv" name="txt_fecha_anv" class="form-control" 
                                type="date" min="2010-01-01" require
                                value="<?php echo date("Y-m-d");?>" />
                            </div>

                            <div class="col">
                                <label for="txt_fecha_exp">Fecha Expediente</label>
                                <input id="txt_fecha_exp" name="txt_fecha_exp" class="form-control" 
                                type="date" min="2010-01-01" require
                                value="<?php echo date("Y-m-d");?>" />
                            </div>

                            <div class="col">
                                <label for="txt_fecha_deuda">Fecha Deuda</label>
                                <input id="txt_fecha_deuda" name="txt_fecha_deuda" class="form-control" 
                                type="date" min="2010-01-01" require
                                value="<?php echo date("Y-m-d");?>" />
                            </div>
                    
                        </div>
                       
                        <br />

                    <div class="form-row">
                        <div class="col">
                                <label for="txt_nro_exp">Número Expediente</label>
                                <input id="txt_nro_exp" name="txt_nro_exp" class="form-control" 
                                require value="0" />
                        </div>
                         
                        <div class="col">
                            <label for="txt_importe">Importe</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$U</span>
                                </div>
                                <input type="number" min="1" max="99999999" 
                                id="txt_importe" name="txt_importe" 
                                class="form-control" require  value="0"
                                aria-label="Amount (to the nearest dollar)">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br />
                    <div class="form-row">
                        <div class="col">
                            <label for="select_estado">Estado del Expediente</label>
                            <select id="select_estado" name="select_estado" class="form-control">
                                <option value="1">ACTIVO</option>
                                <option value="0">CLAUSURADO</option>
                            </select>
                        </div>

                        <div class="col">
                            <label for="txt_fecha_clausura">Fecha Clausura</label>
                            <input id="txt_fecha_clausura" name="txt_fecha_clausura" class="form-control" 
                            type="date" min="2010-01-01" require
                            value="<?php echo date("Y-m-d");?>" />
                        </div>

                        <div class="col">
                            <label for="txt_nro_convenio">Número Convenio Generado</label>
                            <input id="txt_nro_convenio" name="txt_nro_convenio" class="form-control" 
                            require value="0" />
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
                            <button type="buton"  style="width: 95%"  class="btn btn-primary" id="btn_listar">Listar Exp. Activos</button>
                        </div>
                       
                        <div class="col">
                            <button type="submit"  style="width: 95%"  class="btn btn-success" id="btn_agregar">Ingresar Expediente</button>
                        </div>
                        <div class="col">
                            <button type="submit"  style="width: 95%"  class="btn btn-info" id="btn_modificar">Modificar Expediente</button>
                        </div>

                        <div class="col">
                            <button type="button" class="btn btn-secondary" id="btn_agregar_mov" style="width: 95%" 
                            data-toggle="modal" data-target="#agregarMovimientosModal">
                            Agregar Movimiento
                            </button>
                        </div>

                        <div class="col">
                            <button type="submit"  style="width: 95%"  class="btn btn-secondary" id="btn_eliminar">Eliminar Expediente</button>
                        </div>

                        <div class="col">
                            <button type="button"  style="width: 95%"  class="btn btn-primary" id="btn_cerrar">Cerrrar Expediente</button>
                        </div>
                        
                    </div>

                    <br />
        
                    <div class="form-row">
                        <table class="table table-bordered" id="tabla_expedientes" 
                        style='width: 100% !important;'>
                        <thead>
                                <th>Id </th>
                                <th>Unidad</th>
                                <th>Edificio </th>
                                <th>Nro. Exp.</th>
                                <th>Fecha ANV</th>
                                <th>Fecha Exp.</th>
                                <th>Fecha Deuda</th>
                                <th>Importe</th>
                                <th>IdEstado</th>
                                <th>Estado</th>
                                <th>Fecha clausura</th>
                                <th>Convenio Nro</th>
                                <th>Observaciones</th>
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
    <script src="{{ asset ('js/cobranza/expedientes.js')}}"></script>
  
    

@endsection