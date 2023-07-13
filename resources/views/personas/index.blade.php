@extends('layouts.layout')

@section('titulo')
   Mantenimiento de Personas
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

<form class="form-horizontal" action="{{ url('guardar_persona') }}" method="post">

    <input id="h_estado" name="h_estado" type="hidden" value="alta">
    <input id="h_id_persona" name="h_id_persona" type="hidden" value="">
    
    <div class="form-row">
        <div class="col">
            <button type="button" class="btn btn-primary" data-toggle="modal"
            name="btn_agregar_persona" id="btn_agregar_persona"
            data-target="#personasModal" data-whatever="@mdo">Agregar Persona</button>
        </div>

    </div>
    <br />
    <div class="form-row">
        <div class="col">
            <table class="table table-bordered" id="tabla_personas"
            style='width: 100% !important;'>
                <thead>
                    <thead>
                        <th>Cédula</th>
                        <th>Primer Nombre</th>
                        <th>Segundo Nombre</th>
                        <th>Primer Apellido</th>
                        <th>Segundo Apellido</th>
                        <th>Sexo</th>
                        <th>Fecha Nac.</th>
                        <th>Obs</th>
                        <th class="text-center"> Eliminar </th>
                    </thead>
                </thead>
            </table>
        </div>
    </div>

</form>


<!-- MODAL PERSONAS -->
<div class="modal fade"  id="personasModal"
tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">

          <h5 class="modal-title" id="label_titulo_personas">Datos de la Persona</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>

            <div id="mensaje" class="alert hide">
                <button type="button" class="close" data-dismiss="alert">x </button>
                <strong class="respuesta"></strong><span class="mensaje_alerta"></span>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="txt_cedula" class="col-form-label">Cedula:</label>
                        <input type="text" class="form-control" required name="txt_cedula" id="txt_cedula">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="txt_primer_nombre" class="col-form-label">Primer Nombre:</label>
                        <input type="text" class="form-control" required name="txt_primer_nombre" id="txt_primer_nombre">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="txt_segundo_nombre" class="col-form-label">Segundo Nombre:</label>
                        <input type="text" class="form-control" name="txt_segundo_nombre" id="txt_segundo_nombre">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="txt_primer_apellido" class="col-form-label">Primer Apellido:</label>
                        <input type="text" class="form-control" required name="txt_primer_apellido" id="txt_primer_apellido">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="txt_segundo_apellido" class="col-form-label">Segundo Apellido:</label>
                        <input type="text" class="form-control" name="txt_segundo_apellido" id="txt_segundo_apellido">
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="cbo_sexo" class="col-form-label">Sexo:</label>
                        <select class="form-control" id="cbo_sexo" name="cbo_sexo">
                            <option>F</option>
                            <option>M</option>
                          </select>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="txt_fecha_nac" class="col-form-label">Fecha Nacimiento:</label>
                        <input type="date" class="form-control" name="txt_fecha_nac" id="txt_fecha_nac">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="txt_persona_obs" class="col-form-label">Observaciones:</label>
                <textarea type="text" class="form-control" name="txt_persona_obs" id="txt_persona_obs"></textarea>
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" id="btn_guardar_persona" class="btn btn-success">Guardar Persona</button>
          <button type="button" id="btn_mod_persona" class="btn btn-primary">Modificadar Persona</button>
          <button type="button" id="btn_eliminar_persona" class="btn btn-danger">Eliminar Persona</button>
        </div>
      </div>
    </div>
  </div>

<!-- FIN MODAL PERSONAS -->

@endsection



@section('scripts')

    <!-- Propios de SIGECS -->

    <script src="{{ asset ('js/mantenimiento/personas.js')}}"></script>


@endsection
