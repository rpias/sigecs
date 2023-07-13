@extends('layouts.layout')

@section('titulo')
   Mantenimiento de histórico de valores IPC
@endsection

@section('encabezados')

<meta name="csrf-token" content="{{ csrf_token() }}" />

<style>


</style>


@endsection

@section('menu')
  {{!! $menu_str !!}}
@endsection

@section('contenido')

<form class="form-horizontal" action="{{ url('guardar_ipc') }}" method="post">

    <input id="h_estado" name="h_estado" type="hidden" value="alta">
    <input id="h_id_indice" name="h_id_persona" type="hidden" value="">
    
    <div class="form-row">
        <div class="col">
            <button type="button" class="btn btn-primary" data-toggle="modal"
            name="btn_agregar_indice" id="btn_agregar_indice"
            data-target="#historicoModal" data-whatever="@mdo">Agregar Índice IPC</button>
        </div>

    </div>
    <br />
    <div class="form-row">
        <div class="col">
            <table class="table table-bordered" id="tabla_historico"
            style='width: 100% !important;'>
                <thead>
                    <thead>
                        <th>Mes</th>
                        <th>Año</th>
                        <th>Índice</th>
                        <th>Valor Mensual</th>
                        <th>Valor Acumulado Año</th>
                        <th>Valor Acumulado 12 Meses</th>
                        <th class="text-center"> Eliminar </th>
                    </thead>
                </thead>
            </table>
        </div>
    </div>

</form>


<!-- MODAL PERSONAS -->
<div class="modal fade"  id="historicoModal"
tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">

         
          <h5 class="modal-title" id="label_titulo_historico">Datos Valor IPC</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>

            <div class="alert alert-warning" role="alert">
                Utilice punto "." como separador de decimales.
            </div>

            <div id="mensaje" class="alert hide">
                <button type="button" class="close" data-dismiss="alert">x </button>
                <strong class="respuesta"></strong><span class="mensaje_alerta"></span>
            </div>

            <div class="row">

            <div class="col">
                    <div class="form-group">
                        <label for="txt_mes" class="col-form-label">Mes - Formato (1,2,3,...12):</label>
                        <input type="numeric" class="form-control" required name="txt_mes" id="txt_mes">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                    <div class="form-group">
                        <label for="txt_anio" class="col-form-label">Año:</label>
                        <input type="numeric" class="form-control" required name="txt_anio" id="txt_anio">
                    </div>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                    <label for="txt_indice" class="col-form-label">Índice:</label>
                        <input type="numeric" class="form-control" required name="txt_indice" id="txt_indice">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label for="txt_v_mensual" class="col-form-label">Valor mensual:</label>
                        <input type="numeric" class="form-control" required name="txt_v_mensual" id="txt_v_mensual">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                    <label for="txt_v_anual" class="col-form-label">Valor anual:</label>
                        <input type="numeric" class="form-control" required name="txt_v_anual" id="txt_v_anual">
                    </div>
                </div>


                <div class="col">
                    <div class="form-group">
                    <label for="txt_v_12m" class="col-form-label">Valor 12 meses:</label>
                        <input type="numeric" class="form-control" required name="txt_v_12m" id="txt_v_12m">
                    </div>
                </div>


            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" id="btn_guardar_indice" class="btn btn-success">Guardar Índice</button>
          <button type="button" id="btn_mod_indice" class="btn btn-primary">Modificadar Índice</button>
          <button type="button" id="btn_eliminar_indice" class="btn btn-danger">Eliminar Índice</button>
        </div>
      </div>
    </div>
  </div>

<!-- FIN MODAL PERSONAS -->

@endsection



@section('scripts')

    <!-- Propios de SIGECS -->

    <script src="{{ asset ('js/mantenimiento/historico_ipc.js')}}"></script>


@endsection
