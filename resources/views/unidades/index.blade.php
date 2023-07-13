@extends('layouts.layout')

@section('titulo')
Mantenimiento de Unidades
@endsection

@section('encabezados')

<meta name="csrf-token" content="{{ csrf_token() }}" />

@endsection

@section('menu')
{{!! $menu_str !!}}
@endsection

@section('contenido')

<form class="form-horizontal" action="{{ url('guardar_vehiculo') }}" method="post">

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
    <div class="form-row">

        <div class="col-2">
            <button type="button" class="btn btn-success" id="btn_listar_titulares">
                Listar titulares por Unidad
            </button>
        </div>@extends('layouts.layout')

@section('titulo')
Mantenimiento de Unidades
@endsection

@section('encabezados')

<meta name="csrf-token" content="{{ csrf_token() }}" />

@endsection

@section('menu')
{{!! $menu_str !!}}
@endsection

@section('contenido')

<form class="form-horizontal" action="{{ url('guardar_vehiculo') }}" method="post">

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
    <div class="form-row">

        <div class="col-2">
            <button type="button" class="btn btn-success" id="btn_listar_titulares">
                Listar titulares por Unidad
            </button>
        </div>

        <div class="col-3">
            <a href="{{ route('titulares.pdf') }}" target="_blank" class="btn btn-outline-danger">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-file-pdf" viewBox="0 0 16 16">
                    <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z" />
                    <path d="M4.603 12.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.701 19.701 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.187-.012.395-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.065.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.716 5.716 0 0 1-.911-.95 11.642 11.642 0 0 0-1.997.406 11.311 11.311 0 0 1-1.021 1.51c-.29.35-.608.655-.926.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.27.27 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.647 12.647 0 0 1 1.01-.193 11.666 11.666 0 0 1-.51-.858 20.741 20.741 0 0 1-.5 1.05zm2.446.45c.15.162.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.881 3.881 0 0 0-.612-.053zM8.078 5.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z" />
                </svg>
                Descargar Lista Titulares en PDF
            </a>
        </div>

        <!-- https://icons.getbootstrap.com/icons/file-pdf/ -->
        <div class="col-3">
            <a href="{{ route('vehiculos.pdf') }}" target="_blank" class="btn btn-outline-danger">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-file-pdf" viewBox="0 0 16 16">
                    <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z" />
                    <path d="M4.603 12.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.701 19.701 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.187-.012.395-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.065.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.716 5.716 0 0 1-.911-.95 11.642 11.642 0 0 0-1.997.406 11.311 11.311 0 0 1-1.021 1.51c-.29.35-.608.655-.926.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.27.27 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.647 12.647 0 0 1 1.01-.193 11.666 11.666 0 0 1-.51-.858 20.741 20.741 0 0 1-.5 1.05zm2.446.45c.15.162.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.881 3.881 0 0 0-.612-.053zM8.078 5.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z" />
                </svg>
                Descargar Lista Vehículos en PDF
            </a>
        </div>

        <div class="col-4">
            <a href="{{ route('unidades_escrituradas.pdf') }}" target="_blank" class="btn btn-outline-danger">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-file-pdf" viewBox="0 0 16 16">
                    <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z" />
                    <path d="M4.603 12.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.701 19.701 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.187-.012.395-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.065.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.716 5.716 0 0 1-.911-.95 11.642 11.642 0 0 0-1.997.406 11.311 11.311 0 0 1-1.021 1.51c-.29.35-.608.655-.926.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.27.27 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.647 12.647 0 0 1 1.01-.193 11.666 11.666 0 0 1-.51-.858 20.741 20.741 0 0 1-.5 1.05zm2.446.45c.15.162.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.881 3.881 0 0 0-.612-.053zM8.078 5.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z" />
                </svg>
                Descargar Lista Unidades Escrituradas en PDF
            </a>
        </div>

        <div class="col">&nbsp;</div>
        <div class="col">&nbsp;</div>
        <div class="col">&nbsp;</div>
    </div>

    <div class="form-row">
        <div class="col">
            <table class="table table-bordered" id="tabla_titulares_unidad" style='width: 100% !important;'>
                <thead>
                    <thead>
                        <th>Edificio</th>
                        <th>Unidad</th>
                        <th>Cédula</th>
                        <th>Nombre Completo</th>
                        <th>Figura Recibo</th>
                        <th>Figura Padron</th>
                    </thead>
                </thead>
            </table>
        </div>
    </div>


    <div id="accordion" class="hide">

        <!-- CARD-ACCORDION TITULARES -->

        <div class="card">
            <div class="card-header">
                <a class="collapsed card-link" data-toggle="collapse" href="#collapseCuatro">
                    <b> Saldo inicial por unidad </b>
                </a>
            </div>
            <div id="collapseCuatro" class="collapse" data-parent="#accordion">
                <div class="card-body">
                    <div class="form-row">

                        <div class="col">
                            <label for="txt_fecha">Fecha Saldo Inicial</label>
                            <input id="txt_fecha" name="txt_fecha" class="form-control" type="date" min="2010-01-01" require value="<?php echo date("Y-m-d"); ?>" />
                        </div>

                        <div class="col">
                            <label for="txt_importe">Importe</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$U</span>
                                </div>
                                <input type="number" min="0" max="99999999" id="txt_importe" name="txt_importe" class="form-control" require value="0" aria-label="Amount (to the nearest dollar)" style="color: red; font-weight: bold; width: 12rem;">
                            </div>
                        </div>

                        <div class="col">
                            <label for="txt_importe">Importe Intereses</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$U</span>
                                </div>
                                <input type="number" min="0" max="99999999" id="txt_interes" name="txt_interes" class="form-control" require value="0" aria-label="Amount (to the nearest dollar)" style="color: red; font-weight: bold; width: 12rem;">
                            </div>
                        </div>

                        <div class="col">

                            <label for="txt_importe">&nbsp;&nbsp;&nbsp;</label>
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-primary" name="btn_mod_saldo_ini" id="btn_mod_saldo_ini">Modificar Saldo Inicial</button>
                            </div>
                        </div>

                    </div>
                    <br />

                </div>
            </div>
        </div>

        <!-- FIN CARD-ACCORDION TITULARES -->

        <!-- CARD-ACCORDION TITULARES -->

        <div class="card">
            <div class="card-header">
                <a class="collapsed card-link" data-toggle="collapse" href="#collapseTres">
                    <b>Titulares e Integrantes de la Unidad</b>
                </a>
            </div>
            <div id="collapseTres" class="collapse" data-parent="#accordion">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col">
                            <button type="button" class="btn btn-primary hide" data-toggle="modal" name="btn_agregar_titular" id="btn_agregar_titular" data-target="#titularModal" data-whatever="@mdo">Agregar Titular</button>
                        </div>

                    </div>
                    <br />
                    <div class="form-row">
                        <div class="col">
                            <table class="table table-bordered" id="tabla_titulares" style='width: 100% !important;'>
                                <thead>
                                    <th>id</th>
                                    <th>Id Titular</th>
                                    <th>Unidad</th>
                                    <th>Cédula</th>
                                    <th>Nombre Completo</th>
                                    <th>Sexo</th>
                                    <th>Fecha Nac.</th>
                                    <th>Figura Recibo</th>
                                    <th>Figura Padron</th>
                                    <th class="text-center"> Eliminar </th>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- FIN CARD-ACCORDION TITULARES -->


        <!-- CARD-ACCORDION VEHICULOS -->

        <div class="card">
            <div class="card-header">
                <a class="collapsed card-link" data-toggle="collapse" href="#collapseDos">
                    <b>Vehículos por Unidad</b>
                </a>
            </div>
            <div id="collapseDos" class="collapse" data-parent="#accordion">
                <div class="card-body">

                    <div class="form-row">
                        <div class="col">
                            <button type="button" class="btn btn-primary hide" data-toggle="modal" name="btn_agregar_vehiculos" id="btn_agregar_vehiculos" data-target="#vehiculosModal" data-whatever="@mdo">Agregar Vehículo</button>
                        </div>

                    </div>
                    <br />
                    <div class="form-row">
                        <div class="col">
                            <table class="table table-bordered" id="tabla_vehiculos" style='width: 100% !important;'>
                                <thead>
                                    <th>Id</th>
                                    <th>Tipo</th>
                                    <th>Matrícula</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Año</th>
                                    <th>Obs</th>
                                    <th class="text-center"> Eliminar </th>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- FIN CARD-ACCORDION VEHICULOS -->


        <!-- CARD-ACCORDION MOVIMIENTOS  -->

        <div class="card">
            <div class="card-header">
                <a class="card-link" data-toggle="collapse" href="#collapseOne">
                    <b>Movimientos Registrales por Unidad</b>
                </a>
            </div>
            <div id="collapseOne" class="collapse" data-parent="#accordion">
                <div class="card-body">

                    <br />
                    <div class="form-row">
                        <div class="col">
                            <button type="button" class="btn btn-primary hide" data-toggle="modal" name="btn_agregar_movimiento" id="btn_agregar_movimiento" data-target="#movimientosModal" data-whatever="@mdo">Agregar Movimiento</button>
                        </div>

                        <div class="col">

                        </div>
                    </div>
                    <br />
                    <div class="form-row">
                        <div class="col">
                            <table class="table table-bordered" id="tabla_movimientos" style='width: 100% !important;'>
                                <thead>
                                    <th>Id</th>
                                    <th>Tipo Movimiento Registral</th>
                                    <th>Fecha Movimiento Registral</th>
                                    <th>Obs</th>
                                    <th class="text-center"> Eliminar </th>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- FIN CARD-ACCORDION MOVIMIENTOS  -->


    </div> <!-- FIN ACCORDION -->


</form>

<!-- MODAL VEHICULOS -->
<div class="modal fade" id="vehiculosModal" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="label_titulo_vehiculos">Mantenimiento de Datos del Vehículo</h5>
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

                    <div class="form-group">
                        <label for="select_tipo_vehiculo" class="col-form-label">Tipo Vehículo:</label>
                        <select name="select_tipo_vehiculo" id="select_tipo_vehiculo" class="form-control">
                        </select>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="txt_matricula" class="col-form-label">Matricula:</label>
                                <input type="text" class="form-control" name="txt_matricula" id="txt_matricula">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="txt_marca" class="col-form-label">Marca:</label>
                                <input type="text" class="form-control" name="txt_marca" id="txt_marca">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="txt_modelo" class="col-form-label">Modelo:</label>
                                <input type="text" class="form-control" name="txt_modelo" id="txt_modelo">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="txt_anio" class="col-form-label">Año:</label>
                                <input type="number" class="form-control" name="txt_anio" id="txt_anio">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="txt_obs_vehiculo" class="col-form-label">Observaciones:</label>
                        <textarea type="text" class="form-control" name="txt_obs_vehiculo" id="txt_obs_vehiculo"></textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btn_agregar_vehiculo" class="btn btn-primary">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<!-- FIN MODAL VEHICULOS -->

<!-- MODAL MOVIMIENTOS -->
<div class="modal fade" id="movimientosModal" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true" style="overflow-y: scroll;">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="width: 120%">
            <div class="modal-header">
                <h5 class="modal-title" id="label_titulo_movimiento">Datos del Movimiento</h5>
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
                                <label for="select_tipo_mov_reg" class="col-form-label">Tipo Movimiento Registral:</label>
                                <select name="select_tipo_mov_reg" id="select_tipo_mov_reg" class="form-control">
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="txt_fecha" class="col-form-label">Fecha:</label>
                                <input type="date" class="form-control" name="txt_fecha" id="txt_fecha">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="tabla_personas_inv" class="col-form-label">Personas involucradas:</label>
                                <table class="table table-bordered" id="tabla_personas_inv" style='width: 100% !important;'>
                                    <thead>
                                        <th>Cédula</th>
                                        <th>P.Nombre</th>
                                        <th>S.Nombre</th>
                                        <th>P.Apellido</th>
                                        <th>S.Apellido</th>
                                        <th>Sexo</th>
                                        <th>Fecha Nac.</th>
                                        <th>Obs</th>
                                        <th class="text-center"> Eliminar </th>
                                    </thead>
                                </table>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-primary" data-toggle="modal" name="btn_agregar_persona" id="btn_agregar_persona" data-target="#personasModal" data-whatever="@mdo">Agregar Persona</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="txt_obs" class="col-form-label">Observaciones:</label>
                                <textarea type="text" class="form-control" name="txt_obs" id="txt_obs"></textarea>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btn_agregar_mov_reg" class="btn btn-primary">Guardar Movimiento Registral</button>
            </div>
        </div>
    </div>
</div>

<!-- FIN MODAL VEHICULOS -->


<!-- MODAL PERSONAS -->
<div class="modal fade" id="personasModal" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true">

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
                <button type="button" id="btn_guardar_persona" class="btn btn-primary">Guardar Persona</button>
            </div>
        </div>
    </div>
</div>

<!-- FIN MODAL PERSONAS -->

<!-- MODAL TITULARES -->
<div class="modal fade" id="titularModal" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="label_titulo_personas">Datos del Titular o Integrante</h5>
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
                                <label for="txt_cedula_titular" class="col-form-label">Cedula:</label>
                                <input type="text" class="form-control" required name="txt_cedula_titular" id="txt_cedula_titular">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="cbo_titular" class="col-form-label">Es titular ?:</label>
                                <select class="form-control" id="cbo_titular" name="cbo_titular">
                                    <option>SI</option>
                                    <option>NO</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="txt_primer_nombre_titular" class="col-form-label">Primer Nombre:</label>
                                <input type="text" class="form-control" required name="txt_primer_nombre_titular" id="txt_primer_nombre_titular">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="txt_segundo_nombre_titular" class="col-form-label">Segundo Nombre:</label>
                                <input type="text" class="form-control" name="txt_segundo_nombre_titular" id="txt_segundo_nombre_titular">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="txt_primer_apellido_titular" class="col-form-label">Primer Apellido:</label>
                                <input type="text" class="form-control" required name="txt_primer_apellido_titular" id="txt_primer_apellido_titular">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="txt_segundo_apellido_titular" class="col-form-label">Segundo Apellido:</label>
                                <input type="text" class="form-control" name="txt_segundo_apellido_titular" id="txt_segundo_apellido_titular">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="cbo_sexo_titular" class="col-form-label">Sexo:</label>
                                <select class="form-control" id="cbo_sexo_titular" name="cbo_sexo_titular">
                                    <option>F</option>
                                    <option>M</option>
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="txt_fecha_nac_titular" class="col-form-label">Fecha Nacimiento:</label>
                                <input type="date" class="form-control" name="txt_fecha_nac_titular" id="txt_fecha_nac_titular">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="cbo_figura_recibo" class="col-form-label">Figura en Recibo de Pago:</label>
                                <select class="form-control" id="cbo_figura_recibo" name="cbo_figura_recibo">
                                    <option>SI</option>
                                    <option>NO</option>
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="cbo_figura_padron" class="col-form-label">Figura en Padron:</label>
                                <select class="form-control" id="cbo_figura_padron" name="cbo_figura_padron">
                                    <option>SI</option>
                                    <option>NO</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="txt_titular_obs" class="col-form-label">Observaciones:</label>
                        <textarea type="text" class="form-control" name="txt_titular_obs" id="txt_titular_obs"></textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btn_guardar_titular" class="btn btn-primary">Guardar Titular</button>
            </div>
        </div>
    </div>
</div>

<!-- FIN MODAL TITULARES -->


@endsection

@section('scripts')

<!-- Propios de SIGECS -->

<script src="{{ asset ('js/mantenimiento/unidades.js')}}"></script>


@endsection

        <div class="col-3">
            <a href="{{ route('titulares.pdf') }}" class="btn btn-outline-danger">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-file-pdf" viewBox="0 0 16 16">
                    <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z" />
                    <path d="M4.603 12.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.701 19.701 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.187-.012.395-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.065.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.716 5.716 0 0 1-.911-.95 11.642 11.642 0 0 0-1.997.406 11.311 11.311 0 0 1-1.021 1.51c-.29.35-.608.655-.926.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.27.27 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.647 12.647 0 0 1 1.01-.193 11.666 11.666 0 0 1-.51-.858 20.741 20.741 0 0 1-.5 1.05zm2.446.45c.15.162.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.881 3.881 0 0 0-.612-.053zM8.078 5.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z" />
                </svg>
                Descargar Lista Titulares en PDF
            </a>
        </div>

        <!-- https://icons.getbootstrap.com/icons/file-pdf/ -->
        <div class="col-3">
            <a href="{{ route('vehiculos.pdf') }}" class="btn btn-outline-danger">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-file-pdf" viewBox="0 0 16 16">
                    <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z" />
                    <path d="M4.603 12.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.701 19.701 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.187-.012.395-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.065.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.716 5.716 0 0 1-.911-.95 11.642 11.642 0 0 0-1.997.406 11.311 11.311 0 0 1-1.021 1.51c-.29.35-.608.655-.926.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.27.27 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.647 12.647 0 0 1 1.01-.193 11.666 11.666 0 0 1-.51-.858 20.741 20.741 0 0 1-.5 1.05zm2.446.45c.15.162.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.881 3.881 0 0 0-.612-.053zM8.078 5.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z" />
                </svg>
                Descargar Lista Vehículos en PDF
            </a>
        </div>

        <div class="col-4">
            <a href="{{ route('unidades_escrituradas.pdf') }}" class="btn btn-outline-danger">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-file-pdf" viewBox="0 0 16 16">
                    <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z" />
                    <path d="M4.603 12.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.701 19.701 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.187-.012.395-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.065.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.716 5.716 0 0 1-.911-.95 11.642 11.642 0 0 0-1.997.406 11.311 11.311 0 0 1-1.021 1.51c-.29.35-.608.655-.926.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.27.27 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.647 12.647 0 0 1 1.01-.193 11.666 11.666 0 0 1-.51-.858 20.741 20.741 0 0 1-.5 1.05zm2.446.45c.15.162.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.881 3.881 0 0 0-.612-.053zM8.078 5.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z" />
                </svg>
                Descargar Lista Unidades Escrituradas en PDF
            </a>
        </div>

        <div class="col">&nbsp;</div>
        <div class="col">&nbsp;</div>
        <div class="col">&nbsp;</div>
    </div>

    <div class="form-row">
        <div class="col">
            <table class="table table-bordered" id="tabla_titulares_unidad" style='width: 100% !important;'>
                <thead>
                    <thead>
                        <th>Edificio</th>
                        <th>Unidad</th>
                        <th>Cédula</th>
                        <th>Nombre Completo</th>
                        <th>Figura Recibo</th>
                        <th>Figura Padron</th>
                    </thead>
                </thead>
            </table>
        </div>
    </div>


    <div id="accordion" class="hide">

        <!-- CARD-ACCORDION TITULARES -->

        <div class="card">
            <div class="card-header">
                <a class="collapsed card-link" data-toggle="collapse" href="#collapseCuatro">
                    <b> Saldo inicial por unidad </b>
                </a>
            </div>
            <div id="collapseCuatro" class="collapse" data-parent="#accordion">
                <div class="card-body">
                    <div class="form-row">

                        <div class="col">
                            <label for="txt_fecha">Fecha Saldo Inicial</label>
                            <input id="txt_fecha" name="txt_fecha" class="form-control" type="date" min="2010-01-01" require value="<?php echo date("Y-m-d"); ?>" />
                        </div>

                        <div class="col">
                            <label for="txt_importe">Importe</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$U</span>
                                </div>
                                <input type="number" min="0" max="99999999" id="txt_importe" name="txt_importe" class="form-control" require value="0" aria-label="Amount (to the nearest dollar)" style="color: red; font-weight: bold; width: 12rem;">
                            </div>
                        </div>

                        <div class="col">
                            <label for="txt_importe">Importe Intereses</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$U</span>
                                </div>
                                <input type="number" min="0" max="99999999" id="txt_interes" name="txt_interes" class="form-control" require value="0" aria-label="Amount (to the nearest dollar)" style="color: red; font-weight: bold; width: 12rem;">
                            </div>
                        </div>

                        <div class="col">

                            <label for="txt_importe">&nbsp;&nbsp;&nbsp;</label>
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-primary" name="btn_mod_saldo_ini" id="btn_mod_saldo_ini">Modificar Saldo Inicial</button>
                            </div>
                        </div>

                    </div>
                    <br />

                </div>
            </div>
        </div>

        <!-- FIN CARD-ACCORDION TITULARES -->

        <!-- CARD-ACCORDION TITULARES -->

        <div class="card">
            <div class="card-header">
                <a class="collapsed card-link" data-toggle="collapse" href="#collapseTres">
                    <b>Titulares e Integrantes de la Unidad</b>
                </a>
            </div>
            <div id="collapseTres" class="collapse" data-parent="#accordion">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col">
                            <button type="button" class="btn btn-primary hide" data-toggle="modal" name="btn_agregar_titular" id="btn_agregar_titular" data-target="#titularModal" data-whatever="@mdo">Agregar Titular</button>
                        </div>

                    </div>
                    <br />
                    <div class="form-row">
                        <div class="col">
                            <table class="table table-bordered" id="tabla_titulares" style='width: 100% !important;'>
                                <thead>
                                    <th>id</th>
                                    <th>Id Titular</th>
                                    <th>Unidad</th>
                                    <th>Cédula</th>
                                    <th>Nombre Completo</th>
                                    <th>Sexo</th>
                                    <th>Fecha Nac.</th>
                                    <th>Figura Recibo</th>
                                    <th>Figura Padron</th>
                                    <th class="text-center"> Eliminar </th>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- FIN CARD-ACCORDION TITULARES -->


        <!-- CARD-ACCORDION VEHICULOS -->

        <div class="card">
            <div class="card-header">
                <a class="collapsed card-link" data-toggle="collapse" href="#collapseDos">
                    <b>Vehículos por Unidad</b>
                </a>
            </div>
            <div id="collapseDos" class="collapse" data-parent="#accordion">
                <div class="card-body">

                    <div class="form-row">
                        <div class="col">
                            <button type="button" class="btn btn-primary hide" data-toggle="modal" name="btn_agregar_vehiculos" id="btn_agregar_vehiculos" data-target="#vehiculosModal" data-whatever="@mdo">Agregar Vehículo</button>
                        </div>

                    </div>
                    <br />
                    <div class="form-row">
                        <div class="col">
                            <table class="table table-bordered" id="tabla_vehiculos" style='width: 100% !important;'>
                                <thead>
                                    <th>Id</th>
                                    <th>Tipo</th>
                                    <th>Matrícula</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Año</th>
                                    <th>Obs</th>
                                    <th class="text-center"> Eliminar </th>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- FIN CARD-ACCORDION VEHICULOS -->


        <!-- CARD-ACCORDION MOVIMIENTOS  -->

        <div class="card">
            <div class="card-header">
                <a class="card-link" data-toggle="collapse" href="#collapseOne">
                    <b>Movimientos Registrales por Unidad</b>
                </a>
            </div>
            <div id="collapseOne" class="collapse" data-parent="#accordion">
                <div class="card-body">

                    <br />
                    <div class="form-row">
                        <div class="col">
                            <button type="button" class="btn btn-primary hide" data-toggle="modal" name="btn_agregar_movimiento" id="btn_agregar_movimiento" data-target="#movimientosModal" data-whatever="@mdo">Agregar Movimiento</button>
                        </div>

                        <div class="col">

                        </div>
                    </div>
                    <br />
                    <div class="form-row">
                        <div class="col">
                            <table class="table table-bordered" id="tabla_movimientos" style='width: 100% !important;'>
                                <thead>
                                    <th>Id</th>
                                    <th>Tipo Movimiento Registral</th>
                                    <th>Fecha Movimiento Registral</th>
                                    <th>Obs</th>
                                    <th class="text-center"> Eliminar </th>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- FIN CARD-ACCORDION MOVIMIENTOS  -->


    </div> <!-- FIN ACCORDION -->


</form>

<!-- MODAL VEHICULOS -->
<div class="modal fade" id="vehiculosModal" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="label_titulo_vehiculos">Mantenimiento de Datos del Vehículo</h5>
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

                    <div class="form-group">
                        <label for="select_tipo_vehiculo" class="col-form-label">Tipo Vehículo:</label>
                        <select name="select_tipo_vehiculo" id="select_tipo_vehiculo" class="form-control">
                        </select>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="txt_matricula" class="col-form-label">Matricula:</label>
                                <input type="text" class="form-control" name="txt_matricula" id="txt_matricula">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="txt_marca" class="col-form-label">Marca:</label>
                                <input type="text" class="form-control" name="txt_marca" id="txt_marca">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="txt_modelo" class="col-form-label">Modelo:</label>
                                <input type="text" class="form-control" name="txt_modelo" id="txt_modelo">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="txt_anio" class="col-form-label">Año:</label>
                                <input type="number" class="form-control" name="txt_anio" id="txt_anio">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="txt_obs_vehiculo" class="col-form-label">Observaciones:</label>
                        <textarea type="text" class="form-control" name="txt_obs_vehiculo" id="txt_obs_vehiculo"></textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btn_agregar_vehiculo" class="btn btn-primary">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<!-- FIN MODAL VEHICULOS -->

<!-- MODAL MOVIMIENTOS -->
<div class="modal fade" id="movimientosModal" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true" style="overflow-y: scroll;">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="width: 120%">
            <div class="modal-header">
                <h5 class="modal-title" id="label_titulo_movimiento">Datos del Movimiento</h5>
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
                                <label for="select_tipo_mov_reg" class="col-form-label">Tipo Movimiento Registral:</label>
                                <select name="select_tipo_mov_reg" id="select_tipo_mov_reg" class="form-control">
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="txt_fecha" class="col-form-label">Fecha:</label>
                                <input type="date" class="form-control" name="txt_fecha" id="txt_fecha">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="tabla_personas_inv" class="col-form-label">Personas involucradas:</label>
                                <table class="table table-bordered" id="tabla_personas_inv" style='width: 100% !important;'>
                                    <thead>
                                        <th>Cédula</th>
                                        <th>P.Nombre</th>
                                        <th>S.Nombre</th>
                                        <th>P.Apellido</th>
                                        <th>S.Apellido</th>
                                        <th>Sexo</th>
                                        <th>Fecha Nac.</th>
                                        <th>Obs</th>
                                        <th class="text-center"> Eliminar </th>
                                    </thead>
                                </table>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-primary" data-toggle="modal" name="btn_agregar_persona" id="btn_agregar_persona" data-target="#personasModal" data-whatever="@mdo">Agregar Persona</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="txt_obs" class="col-form-label">Observaciones:</label>
                                <textarea type="text" class="form-control" name="txt_obs" id="txt_obs"></textarea>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btn_agregar_mov_reg" class="btn btn-primary">Guardar Movimiento Registral</button>
            </div>
        </div>
    </div>
</div>

<!-- FIN MODAL VEHICULOS -->


<!-- MODAL PERSONAS -->
<div class="modal fade" id="personasModal" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true">

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
                <button type="button" id="btn_guardar_persona" class="btn btn-primary">Guardar Persona</button>
            </div>
        </div>
    </div>
</div>

<!-- FIN MODAL PERSONAS -->

<!-- MODAL TITULARES -->
<div class="modal fade" id="titularModal" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="label_titulo_personas">Datos del Titular o Integrante</h5>
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
                                <label for="txt_cedula_titular" class="col-form-label">Cedula:</label>
                                <input type="text" class="form-control" required name="txt_cedula_titular" id="txt_cedula_titular">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="cbo_titular" class="col-form-label">Es titular ?:</label>
                                <select class="form-control" id="cbo_titular" name="cbo_titular">
                                    <option>SI</option>
                                    <option>NO</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="txt_primer_nombre_titular" class="col-form-label">Primer Nombre:</label>
                                <input type="text" class="form-control" required name="txt_primer_nombre_titular" id="txt_primer_nombre_titular">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="txt_segundo_nombre_titular" class="col-form-label">Segundo Nombre:</label>
                                <input type="text" class="form-control" name="txt_segundo_nombre_titular" id="txt_segundo_nombre_titular">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="txt_primer_apellido_titular" class="col-form-label">Primer Apellido:</label>
                                <input type="text" class="form-control" required name="txt_primer_apellido_titular" id="txt_primer_apellido_titular">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="txt_segundo_apellido_titular" class="col-form-label">Segundo Apellido:</label>
                                <input type="text" class="form-control" name="txt_segundo_apellido_titular" id="txt_segundo_apellido_titular">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="cbo_sexo_titular" class="col-form-label">Sexo:</label>
                                <select class="form-control" id="cbo_sexo_titular" name="cbo_sexo_titular">
                                    <option>F</option>
                                    <option>M</option>
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="txt_fecha_nac_titular" class="col-form-label">Fecha Nacimiento:</label>
                                <input type="date" class="form-control" name="txt_fecha_nac_titular" id="txt_fecha_nac_titular">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="cbo_figura_recibo" class="col-form-label">Figura en Recibo de Pago:</label>
                                <select class="form-control" id="cbo_figura_recibo" name="cbo_figura_recibo">
                                    <option>SI</option>
                                    <option>NO</option>
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="cbo_figura_padron" class="col-form-label">Figura en Padron:</label>
                                <select class="form-control" id="cbo_figura_padron" name="cbo_figura_padron">
                                    <option>SI</option>
                                    <option>NO</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="txt_titular_obs" class="col-form-label">Observaciones:</label>
                        <textarea type="text" class="form-control" name="txt_titular_obs" id="txt_titular_obs"></textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btn_guardar_titular" class="btn btn-primary">Guardar Titular</button>
            </div>
        </div>
    </div>
</div>

<!-- FIN MODAL TITULARES -->


@endsection

@section('scripts')

<!-- Propios de SIGECS -->

<script src="{{ asset ('js/mantenimiento/unidades.js')}}"></script>


@endsection